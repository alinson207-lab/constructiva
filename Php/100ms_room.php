<?php
// ============================================================
//  CONSTRUCTIVA · Generador de Salas y Tokens para 100ms
//  GET  /Php/100ms_room.php?topic=Clase-1&role=learner
//  GET  /Php/100ms_room.php?topic=charla-3&role=host
//
//  Roles reconocidos:
//    Desde el sistema → host   : admin, instructor, teacher
//    Desde el sistema → learner: estudiante (cualquier otro)
//
//  Flujo:
//    1. Genera Management Token (JWT HS256)
//    2. Busca sala por nombre — si no existe, la crea
//    3. Obtiene Room Codes — si ya existen los reutiliza (evita 409)
//    4. Devuelve prebuiltUrl + roomCode + subdomain
// ============================================================
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';

corsHeaders();

// ── Solo GET ──────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonError(405, 'Método no permitido');
}

// ── Auth ──────────────────────────────────────────────────────
$user = requireAuth();

// ── Parámetros ────────────────────────────────────────────────
$topicRaw  = trim($_GET['topic'] ?? 'Clase-Constructiva');
$roleInput = strtolower(trim($_GET['role'] ?? 'learner'));

// Sanitizar topic: solo alfanumérico + guiones, máx 40 chars
$topic = preg_replace('/[^a-zA-Z0-9\-]/', '-', $topicRaw);
$topic = preg_replace('/-+/', '-', $topic);
$topic = trim(substr($topic, 0, 40), '-');
if (empty($topic)) $topic = 'sala-constructiva';

// Determinar rol final en 100ms según el rol del sistema
// — El rol recibido por GET solo se honra si el usuario tiene permisos
$userRol = $user['rol'] ?? 'estudiante';
if (in_array($userRol, ['admin', 'instructor', 'teacher'], true)) {
    // Admin/instructor puede pedir cualquier rol; default → host
    $finalRole = in_array($roleInput, ['host', 'learner', 'guest', 'backstage'], true)
        ? $roleInput
        : 'host';
} else {
    // Estudiante siempre entra como learner, sin importar lo que pida
    $finalRole = 'learner';
}

// ── Validar credenciales HMS ──────────────────────────────────
if (
    !defined('HMS_ACCESS_KEY') || HMS_ACCESS_KEY === 'TU_APP_ACCESS_KEY' ||
    !defined('HMS_SECRET')     || HMS_SECRET      === 'TU_APP_SECRET'    ||
    !defined('HMS_TEMPLATE_ID')|| HMS_TEMPLATE_ID === 'TU_TEMPLATE_ID'   ||
    !defined('HMS_SUBDOMAIN')  || HMS_SUBDOMAIN   === 'tu-subdominio.app.100ms.live'
) {
    jsonError(503, '100ms no está configurado. Completa HMS_ACCESS_KEY, HMS_SECRET, HMS_TEMPLATE_ID y HMS_SUBDOMAIN en config.php.');
}

// ── 1. Management Token (JWT HS256) ──────────────────────────
$iat = time();
$exp = $iat + 3600; // válido 1 hora

$jwtHeader  = base64url_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
$jwtPayload = base64url_encode(json_encode([
    'access_key' => HMS_ACCESS_KEY,
    'type'       => 'management',
    'version'    => 2,
    'jti'        => bin2hex(random_bytes(16)),
    'iat'        => $iat,
    'nbf'        => $iat,
    'exp'        => $exp,
]));
$jwtSignature   = base64url_encode(hash_hmac('sha256', "$jwtHeader.$jwtPayload", HMS_SECRET, true));
$managementToken = "$jwtHeader.$jwtPayload.$jwtSignature";

// ── 2. Buscar o crear sala ────────────────────────────────────
$roomId = null;

// Primero intenta buscar por nombre exacto
$searchRes = hmsRequest('GET', "/rooms?name=" . urlencode($topic), $managementToken);

if ($searchRes['status'] === 200) {
    $rooms = $searchRes['body']['data'] ?? [];
    // Buscar coincidencia exacta (la API puede devolver resultados parciales)
    foreach ($rooms as $r) {
        if (($r['name'] ?? '') === $topic) {
            $roomId = $r['id'];
            break;
        }
    }
}

if (!$roomId) {
    // Crear sala nueva
    $createRes = hmsRequest('POST', '/rooms', $managementToken, [
        'name'        => $topic,
        'description' => 'Sala Constructiva — ' . $topic,
        'template_id' => HMS_TEMPLATE_ID,
    ]);

    if ($createRes['status'] >= 200 && $createRes['status'] < 300) {
        $roomId = $createRes['body']['id'] ?? null;
    } elseif ($createRes['status'] === 409) {
        // La sala ya existe con ese nombre pero la búsqueda no la encontró
        // Intentar buscar de nuevo con un pequeño delay lógico
        $retry = hmsRequest('GET', "/rooms?name=" . urlencode($topic), $managementToken);
        foreach (($retry['body']['data'] ?? []) as $r) {
            if (($r['name'] ?? '') === $topic) {
                $roomId = $r['id'];
                break;
            }
        }
        if (!$roomId) {
            jsonError(500, 'No se pudo resolver la sala existente. Error 100ms: ' . json_encode($createRes['body']));
        }
    } else {
        jsonError(500, 'Error al crear sala en 100ms: ' . json_encode($createRes['body']));
    }
}

if (!$roomId) {
    jsonError(500, 'No se pudo obtener un Room ID válido de 100ms.');
}

// ── 3. Room Codes — obtener o crear ──────────────────────────
// Primero intentamos GET (si ya existen, los reutilizamos y evitamos 409)
$getCodesRes = hmsRequest('GET', "/room-codes/room/$roomId", $managementToken);

$roomCodesData = [];

if ($getCodesRes['status'] === 200) {
    // Puede venir como array directo o dentro de 'data'
    $body = $getCodesRes['body'] ?? [];
    if (isset($body['data']) && is_array($body['data'])) {
        $roomCodesData = $body['data'];
    } elseif (is_array($body) && isset($body[0])) {
        $roomCodesData = $body;
    }
}

// Si no existen todavía, los creamos con POST
if (empty($roomCodesData)) {
    $postCodesRes = hmsRequest('POST', "/room-codes/room/$roomId", $managementToken);
    if ($postCodesRes['status'] >= 200 && $postCodesRes['status'] < 300) {
        $body = $postCodesRes['body'] ?? [];
        if (isset($body['data']) && is_array($body['data'])) {
            $roomCodesData = $body['data'];
        } elseif (is_array($body) && isset($body[0])) {
            $roomCodesData = $body;
        }
    } else {
        jsonError(500, 'Error al obtener Room Codes: ' . json_encode($postCodesRes['body']));
    }
}

if (empty($roomCodesData)) {
    jsonError(500, 'No se pudieron obtener Room Codes para esta sala.');
}

// ── 4. Seleccionar el código del rol correcto ─────────────────
$myRoomCode = null;

// Búsqueda exacta por rol
foreach ($roomCodesData as $rc) {
    if (($rc['role'] ?? '') === $finalRole) {
        $myRoomCode = $rc['code'];
        break;
    }
}

// Fallback #1: si no hay código para ese rol exacto, buscar 'learner' para estudiantes
if (!$myRoomCode && $finalRole !== 'learner') {
    foreach ($roomCodesData as $rc) {
        if (($rc['role'] ?? '') === 'learner') {
            $myRoomCode = $rc['code'];
            break;
        }
    }
}

// Fallback #2: tomar el primer código disponible
if (!$myRoomCode && count($roomCodesData) > 0) {
    $myRoomCode = $roomCodesData[0]['code'];
}

if (!$myRoomCode) {
    jsonError(500, 'No se encontró un Room Code válido. Roles disponibles: ' .
        implode(', ', array_column($roomCodesData, 'role')));
}

// ── 5. Construir prebuilt URL ─────────────────────────────────
$subdomain   = HMS_SUBDOMAIN;
$prebuiltUrl = "https://{$subdomain}/meeting/{$myRoomCode}";

// ── 6. Responder ──────────────────────────────────────────────
jsonOk([
    'topic'       => $topic,
    'role'        => $finalRole,
    'roomId'      => $roomId,
    'roomCode'    => $myRoomCode,
    'subdomain'   => $subdomain,
    'prebuiltUrl' => $prebuiltUrl,
    // Todos los códigos disponibles (útil para el admin)
    'allCodes'    => array_map(fn($rc) => [
        'role' => $rc['role'] ?? '?',
        'code' => $rc['code'] ?? '',
    ], $roomCodesData),
]);

// ============================================================
//  HELPERS
// ============================================================

/**
 * Ejecuta una petición cURL a la API de 100ms.
 */
function hmsRequest(string $method, string $endpoint, string $token, ?array $data = null): array {
    $url = 'https://api.100ms.live/v2' . $endpoint;
    $ch  = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_CONNECTTIMEOUT => 8,
    ]);

    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $rawBody  = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr  = curl_error($ch);
    curl_close($ch);

    if ($curlErr) {
        // Error de red — devolver estructura de error uniforme
        return ['status' => 0, 'body' => ['error' => 'cURL error: ' . $curlErr]];
    }

    $decoded = json_decode($rawBody, true);
    if ($decoded === null) {
        $decoded = ['raw' => $rawBody];
    }

    return ['status' => $httpCode, 'body' => $decoded];
}

/**
 * Codifica en base64url sin padding.
 */
function base64url_encode(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}