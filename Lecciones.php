<?php
// ============================================================
//  CONSTRUCTIVA · Lecciones.php
//  Verifica autenticación + inscripción antes de servir
//  la página de lección con los datos correctos.
//
//  URL: /Lecciones.php?curso={slug}&leccion={id_workshop}
// ============================================================
require_once __DIR__ . '/Php/config.php';
require_once __DIR__ . '/Php/conexion_bd.php';

// ── 1. Autenticación ─────────────────────────────────────────
// Leer token desde cookie (httponly) o localStorage via cookie_js
$token = $_COOKIE['cv_token'] ?? null;

if (!$token) {
    // Sin sesión → redirigir al login
    header('Location: /login');
    exit;
}

// Validar token en BD
$stmtSes = $conexion->prepare("
    SELECT u.id, u.nombre, u.apellido, u.email,
           u.avatar_emoji, u.profesion, u.rol
    FROM sesiones s
    JOIN usuarios u ON u.id = s.usuario_id
    WHERE s.token = ?
      AND s.expira_en > NOW()
      AND u.activo = 1
    LIMIT 1
");
$stmtSes->execute([$token]);
$usuario = $stmtSes->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    // Sesión inválida → redirigir al login
    header('Location: /login');
    exit;
}

// Renovar sesión (sliding)
$minutos = defined('SESSION_SLIDING_MIN') ? SESSION_SLIDING_MIN : 10;
$nuevaExp = date('Y-m-d H:i:s', strtotime("+{$minutos} minutes"));
$conexion->prepare("UPDATE sesiones SET expira_en = ? WHERE token = ?")
         ->execute([$nuevaExp, $token]);

// ── 2. Parámetros de la URL ───────────────────────────────────
$cursoSlug  = trim($_GET['curso']   ?? '');
$leccionNum = max(1, (int)($_GET['leccion'] ?? 1));

if (empty($cursoSlug)) {
    header('Location: /dashboard');
    exit;
}

// ── 3. Verificar inscripción ──────────────────────────────────
$stmtCurso = $conexion->prepare("
    SELECT c.id, c.slug, c.nombre, c.emoji, c.color_hex,
           c.total_workshops, c.horas_totales,
           i.estado AS inscripcion_estado
    FROM cursos c
    JOIN inscripciones i ON i.curso_id = c.id AND i.usuario_id = ?
    WHERE c.slug = ? AND c.activo = 1
    LIMIT 1
");
$stmtCurso->execute([$usuario['id'], $cursoSlug]);
$curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

if (!$curso || $curso['inscripcion_estado'] === 'suspendido') {
    // No inscrito o suspendido → redirigir al dashboard
    header('Location: /dashboard');
    exit;
}

// ── 4. Obtener el workshop (lección) solicitado ───────────────
$stmtWS = $conexion->prepare("
    SELECT w.id, w.numero, w.titulo, w.descripcion, w.duracion_min,
           w.orden,
           COALESCE(pw.completado, 0)   AS completado,
           COALESCE(pw.porcentaje, 0)   AS porcentaje,
           COALESCE(pw.horas_vistas, 0) AS horas_vistas
    FROM workshops w
    LEFT JOIN progreso_workshop pw
           ON pw.workshop_id = w.id AND pw.usuario_id = ?
    WHERE w.curso_id = ? AND w.activo = 1
    ORDER BY w.orden ASC
");
$stmtWS->execute([$usuario['id'], $curso['id']]);
$workshops = $stmtWS->fetchAll(PDO::FETCH_ASSOC);

if (empty($workshops)) {
    // El curso no tiene workshops aún
    header('Location: /dashboard');
    exit;
}

// Seleccionar el workshop pedido (por número) o el primero disponible
$leccionActual = null;
foreach ($workshops as $ws) {
    if ((int)$ws['numero'] === $leccionNum) {
        $leccionActual = $ws;
        break;
    }
}
// Si no existe ese número, usar el primero
if (!$leccionActual) {
    $leccionActual = $workshops[0];
}

$totalLecciones = count($workshops);

// ── 5. Determinar modo: live o recorded ──────────────────────
// Por ahora las clases son en vivo (100ms).
// Cuando haya grabación, agrega columna `video_url` a workshops
// y cambia esto a: $modo = $leccionActual['video_url'] ? 'recorded' : 'live';
$modo     = 'live';
$videoUrl = ''; // $leccionActual['video_url'] ?? ''

// ── 6. Topic para 100ms (único por curso + workshop) ─────────
$hmsTopic = 'ws' . $leccionActual['id'] . '-' . $curso['slug'];

// ── 7. Etiqueta de semana/sección ────────────────────────────
$weekLabel = 'Workshop ' . $leccionActual['numero'];
if (!empty($leccionActual['descripcion'])) {
    // Si la descripción es corta, úsala como label
    if (mb_strlen($leccionActual['descripcion']) <= 60) {
        $weekLabel = $leccionActual['descripcion'];
    }
}

// ── 8. Navegación: anterior y siguiente ──────────────────────
$idxActual = array_search($leccionActual, $workshops);
$anterior  = $idxActual > 0 ? $workshops[$idxActual - 1] : null;
$siguiente = $idxActual < ($totalLecciones - 1) ? $workshops[$idxActual + 1] : null;

// ── Helper: escapar para data-* ───────────────────────────────
function esc(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= esc($leccionActual['titulo']) ?> · <?= esc($curso['nombre']) ?> · Constructiva</title>

  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="/Css/lecciones.css?v=1.1.0">
  <link rel="stylesheet" href="/Css/responsive.css?v=1.1.0">
  <script src="/Js/cv-session.js?v=1.1.0"></script>

  <style>
    :root { --hms-red: #ef4444; --hms-red-soft: rgba(239,68,68,.12); }

    .video-placeholder {
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      gap:.5rem; width:100%; height:100%;
      background:linear-gradient(160deg,#0d2020 0%,#0a1818 100%);
      cursor:pointer; border-radius:8px; text-align:center; padding:2rem;
      transition:background .2s; position:relative; overflow:hidden;
    }
    .video-placeholder::before {
      content:''; position:absolute; inset:0;
      background:radial-gradient(circle at 30% 50%,rgba(16,176,158,.12),transparent 60%);
    }
    .video-placeholder:hover { background:linear-gradient(160deg,#0f2828 0%,#0c1c1c 100%); }

    .vp-mode-tag {
      position:absolute; top:1rem; left:1rem;
      font-size:.65rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase;
      padding:.25rem .7rem; border-radius:100px;
    }
    .vp-mode-tag.live {
      background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.3); color:#f87171;
    }
    .vp-mode-tag.live::before {
      content:''; display:inline-block; width:6px; height:6px; border-radius:50%;
      background:#ef4444; margin-right:.4rem; vertical-align:middle;
      animation:blink-dot 1.2s infinite;
    }
    .vp-mode-tag.recorded {
      background:rgba(93,230,212,.1); border:1px solid rgba(93,230,212,.2); color:#5de6d4;
    }
    @keyframes blink-dot { 0%,100%{opacity:1}50%{opacity:.2} }

    .vp-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:rgba(93,230,212,.6); position:relative; z-index:1; }
    .vp-play {
      width:64px; height:64px; border-radius:50%;
      background:rgba(16,176,158,.15); border:2px solid rgba(93,230,212,.3);
      display:flex; align-items:center; justify-content:center;
      font-size:1.4rem; color:#5de6d4; transition:background .2s,transform .2s;
      position:relative; z-index:1; margin:.5rem 0;
    }
    .video-placeholder:hover .vp-play { background:rgba(16,176,158,.25); transform:scale(1.08); }
    .vp-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:#e8f5f3; position:relative; z-index:1; }
    .vp-sub { font-size:.8rem; color:rgba(138,184,180,.7); position:relative; z-index:1; }

    #hms-container { display:none; width:100%; height:100%; position:relative; }
    #hms-container iframe { width:100%; height:100%; border:none; display:block; }
    .hms-topbar {
      position:absolute; top:0; left:0; right:0; z-index:10;
      display:flex; align-items:center; justify-content:space-between; padding:.5rem .9rem;
      background:linear-gradient(180deg,rgba(0,0,0,.7) 0%,transparent 100%);
      pointer-events:none;
    }
    .hms-status-pill {
      display:flex; align-items:center; gap:.4rem;
      background:rgba(239,68,68,.2); border:1px solid rgba(239,68,68,.4);
      border-radius:100px; padding:.25rem .75rem;
      font-size:.68rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase;
      color:#f87171; pointer-events:none;
    }
    .hms-status-dot { width:6px; height:6px; border-radius:50%; background:#ef4444; animation:blink-dot 1.2s infinite; }
    .hms-leave-btn {
      background:rgba(239,68,68,.15); border:1px solid rgba(239,68,68,.35);
      color:#f87171; font-family:'Syne',sans-serif; font-weight:700; font-size:.72rem;
      padding:.3rem .8rem; border-radius:8px; cursor:pointer; transition:background .2s; pointer-events:all;
    }
    .hms-leave-btn:hover { background:rgba(239,68,68,.3); }

    #yt-container { display:none; width:100%; height:100%; position:relative; }
    #yt-container iframe { width:100%; height:100%; border:none; display:block; border-radius:8px; }
    .yt-close-btn {
      position:absolute; top:.6rem; right:.6rem;
      background:rgba(0,0,0,.6); border:1px solid rgba(255,255,255,.15);
      color:rgba(255,255,255,.8); font-size:.72rem; font-family:'Syne',sans-serif;
      font-weight:700; padding:.3rem .8rem; border-radius:8px; cursor:pointer; z-index:10;
    }

    /* Navegación entre lecciones */
    .lesson-nav {
      display:flex; align-items:center; justify-content:space-between;
      padding:1rem 1.5rem; border-top:1px solid rgba(0,0,0,.08); gap:.8rem; flex-wrap:wrap;
    }
    .lesson-nav-btn {
      display:inline-flex; align-items:center; gap:.5rem;
      font-family:'Syne',sans-serif; font-weight:700; font-size:.8rem;
      padding:.55rem 1.1rem; border-radius:100px; text-decoration:none;
      transition:opacity .15s, transform .15s;
    }
    .lesson-nav-btn:hover { opacity:.8; transform:translateY(-1px); }
    .btn-prev { background:rgba(0,0,0,.06); color:#555; }
    .btn-next { background:#0aab96; color:#fff; }
    .btn-disabled { opacity:.35; pointer-events:none; }

    @keyframes spin { to { transform:rotate(360deg); } }
    .spinning { animation:spin .9s linear infinite; display:inline-block; }
    .complete-btn.done { background:rgba(34,197,94,.12)!important; border-color:rgba(34,197,94,.35)!important; color:#22c55e!important; }
    .vp-error { color:#f87171; }
    .vp-retry { margin-top:.3rem; font-size:.78rem; color:rgba(93,230,212,.7); cursor:pointer; text-decoration:underline; background:none; border:none; font-family:'DM Sans',sans-serif; }
  </style>
</head>

<body
  data-lesson-id="<?= esc((string)$leccionActual['id']) ?>"
  data-lesson-title="<?= esc($leccionActual['titulo']) ?>"
  data-lesson-desc="<?= esc($leccionActual['descripcion'] ?? '') ?>"
  data-lesson-num="<?= esc((string)$leccionActual['numero']) ?>"
  data-lesson-total="<?= $totalLecciones ?>"
  data-course-title="<?= esc($curso['nombre']) ?>"
  data-course-slug="<?= esc($curso['slug']) ?>"
  data-week-label="<?= esc($weekLabel) ?>"
  data-workshop-num="<?= esc((string)$leccionActual['numero']) ?>"
  data-mode="<?= $modo ?>"
  data-video-url="<?= esc($videoUrl) ?>"
  data-hms-topic="<?= esc($hmsTopic) ?>"
  data-prev-num="<?= $anterior  ? $anterior['numero']  : '' ?>"
  data-next-num="<?= $siguiente ? $siguiente['numero'] : '' ?>"
  data-is-done="<?= $leccionActual['completado'] ? '1' : '0' ?>"
>

<!-- ── TOP NAV ─────────────────────────────────────────────── -->
<nav class="topnav">
  <div class="topnav-left">
    <a href="/dashboard" class="back-btn">← Dashboard</a>
    <span class="course-title-nav">
      <?= esc($curso['nombre']) ?> <span class="sep">/</span>
      <strong><?= esc($weekLabel) ?></strong>
    </span>
  </div>
  <div class="topnav-center">
    <a href="/" class="nav-logo-sm">constructiva<span>.</span></a>
  </div>
  <div class="topnav-right">
    <span class="progress-text">
      <strong><?= $leccionActual['numero'] ?></strong> / <?= $totalLecciones ?> lecciones
    </span>
    <button class="complete-btn<?= $leccionActual['completado'] ? ' done' : '' ?>"
            id="completeBtn" onclick="markDone()">
      <?= $leccionActual['completado'] ? 'Completada ✓' : 'Marcar completada' ?>
    </button>
  </div>
</nav>

<!-- ── LAYOUT ──────────────────────────────────────────────── -->
<div class="app-layout">
  <div>

    <!-- VIDEO AREA -->
    <div class="video-area">
      <div class="video-wrapper" id="videoWrapper" style="position:relative">

        <!-- PLACEHOLDER -->
        <div class="video-placeholder" id="videoPlaceholder" onclick="iniciarMedia()">
          <div class="vp-mode-tag <?= $modo ?>" id="vpModeTag">
            <?= $modo === 'live' ? 'En Vivo' : 'Grabado' ?>
          </div>
          <span class="vp-label" id="vpLabel">
            Workshop <?= $leccionActual['numero'] ?> · Lección <?= $leccionActual['numero'] ?>
          </span>
          <div class="vp-play" id="vpPlayIcon">▶</div>
          <div class="vp-title" id="vpTitle">
            <?= $modo === 'live' ? 'Entrar a clase en vivo' : 'Ver lección grabada' ?>
          </div>
          <div class="vp-sub" id="vpSub">
            <?= $modo === 'live'
                ? 'Haz clic para unirte · cámara y micrófono en el navegador'
                : 'Haz clic para reproducir el video' ?>
          </div>
        </div>

        <!-- CONTENEDOR 100ms -->
        <div id="hms-container">
          <div class="hms-topbar">
            <div class="hms-status-pill">
              <div class="hms-status-dot"></div>EN VIVO · 100ms
            </div>
            <button class="hms-leave-btn" onclick="salirSala()">✕ Salir</button>
          </div>
        </div>

        <!-- CONTENEDOR YouTube -->
        <div id="yt-container">
          <button class="yt-close-btn" onclick="cerrarVideo()">✕ Cerrar</button>
        </div>

      </div>
    </div>

    <!-- CONTENIDO -->
    <div class="content-area">
      <h1 class="lesson-title"><?= esc($leccionActual['titulo']) ?></h1>
      <?php if (!empty($leccionActual['descripcion'])): ?>
        <p class="lesson-desc"><?= esc($leccionActual['descripcion']) ?></p>
      <?php endif; ?>
    </div>

    <!-- NAVEGACIÓN ENTRE LECCIONES -->
    <div class="lesson-nav">
      <?php if ($anterior): ?>
        <a href="/Lecciones.php?curso=<?= urlencode($curso['slug']) ?>&leccion=<?= $anterior['numero'] ?>"
           class="lesson-nav-btn btn-prev">← Lección anterior</a>
      <?php else: ?>
        <span class="lesson-nav-btn btn-prev btn-disabled">← Lección anterior</span>
      <?php endif; ?>

      <span style="font-size:.78rem;color:var(--muted)">
        <?= $leccionActual['numero'] ?> de <?= $totalLecciones ?>
      </span>

      <?php if ($siguiente): ?>
        <a href="/Lecciones.php?curso=<?= urlencode($curso['slug']) ?>&leccion=<?= $siguiente['numero'] ?>"
           class="lesson-nav-btn btn-next">Siguiente lección →</a>
      <?php else: ?>
        <a href="/dashboard" class="lesson-nav-btn btn-next">Ver mis cursos ✓</a>
      <?php endif; ?>
    </div>

  </div>
</div>

<script>
// ── Datos del servidor ──────────────────────────────────────
const BD         = document.body.dataset;
const LESSON_ID  = BD.lessonId;
const MODE       = BD.mode || 'live';
const VIDEO_URL  = BD.videoUrl || '';
const HMS_TOPIC  = BD.hmsTopic;
const LESSON_NUM = BD.lessonNum;
const WEEK_LABEL = BD.weekLabel;
const WORKSHOP_NUM = BD.workshopNum;
const API_100MS  = '/Php/100ms_room.php';

// ── Token de sesión ─────────────────────────────────────────
function getToken() {
  const ls = localStorage.getItem('cv_token');
  if (ls) return ls;
  const c = document.cookie.split(';').map(x=>x.trim()).find(x=>x.startsWith('cv_token_js='));
  return c ? c.split('=')[1] : '';
}

function getUserName() {
  try {
    const u = JSON.parse(localStorage.getItem('cv_user') || '{}');
    if (u.nombre) return `${u.nombre} ${u.apellido||''}`.trim();
  } catch(_) {}
  return 'Estudiante';
}

// ── Dispatcher ──────────────────────────────────────────────
function iniciarMedia() {
  MODE === 'recorded' ? iniciarVideoGrabado() : iniciarClase100ms();
}

// ── Video grabado (YouTube) ─────────────────────────────────
function iniciarVideoGrabado() {
  const ytId = extraerYtId(VIDEO_URL);
  if (!ytId) { mostrarError('Video no disponible aún.', false); return; }
  const url = `https://www.youtube.com/embed/${ytId}?autoplay=1&rel=0&modestbranding=1`;
  document.getElementById('videoPlaceholder').style.display = 'none';
  const cont = document.getElementById('yt-container');
  cont.style.display = 'block';
  cont.querySelectorAll('iframe').forEach(f=>f.remove());
  const iframe = document.createElement('iframe');
  iframe.title = 'Lección grabada'; iframe.src = url;
  iframe.allow = 'accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture';
  iframe.allowFullscreen = true;
  cont.appendChild(iframe);
}
function cerrarVideo() {
  const c = document.getElementById('yt-container');
  c.style.display='none'; c.querySelectorAll('iframe').forEach(f=>f.remove());
  document.getElementById('videoPlaceholder').style.display='flex';
}
function extraerYtId(url) {
  const p = [/youtu\.be\/([a-zA-Z0-9_-]{11})/,/[?&]v=([a-zA-Z0-9_-]{11})/,/\/(?:embed|live|v)\/([a-zA-Z0-9_-]{11})/,/^([a-zA-Z0-9_-]{11})$/];
  for (const r of p) { const m=(url||'').match(r); if(m) return m[1]; }
  return null;
}

// ── Clase en vivo 100ms ─────────────────────────────────────
async function iniciarClase100ms() {
  mostrarCargando();
  try {
    const token = getToken();
    if (!token) throw new Error('No estás autenticado. Por favor inicia sesión.');

    const res = await fetch(
      `${API_100MS}?topic=${encodeURIComponent(HMS_TOPIC)}&role=learner`,
      { credentials:'include', headers:{'Authorization':'Bearer '+token} }
    );

    const ct = res.headers.get('content-type') || '';
    if (!ct.includes('application/json'))
      throw new Error(`Error del servidor (${res.status}). Verifica la configuración de 100ms.`);

    const json = await res.json();
    if (!json.ok) throw new Error(json.error || `Error ${res.status}`);

    let iframeUrl = json.data.prebuiltUrl || '';
    if (!iframeUrl && json.data.roomCode) {
      const sub = json.data.subdomain || '';
      iframeUrl = `https://${sub}/meeting/${json.data.roomCode}`;
    }
    if (!iframeUrl) throw new Error('El servidor no devolvió URL válida.');

    iframeUrl += (iframeUrl.includes('?')?'&':'?') + `name=${encodeURIComponent(getUserName())}`;

    document.getElementById('videoPlaceholder').style.display = 'none';
    const cont = document.getElementById('hms-container');
    cont.style.display = 'block';
    cont.querySelectorAll('iframe').forEach(f=>f.remove());
    const iframe = document.createElement('iframe');
    iframe.title = '100ms · Clase en Vivo'; iframe.src = iframeUrl;
    iframe.allow = 'camera;microphone;display-capture;fullscreen;autoplay;clipboard-write;web-share';
    cont.appendChild(iframe);

  } catch(err) {
    console.error('100ms error:', err);
    mostrarError(err.message || 'No se pudo conectar.');
  }
}

function salirSala() {
  const c = document.getElementById('hms-container');
  c.style.display='none'; c.querySelectorAll('iframe').forEach(f=>f.remove());
  restorePlaceholder();
}

// ── Estados del placeholder ─────────────────────────────────
function mostrarCargando() {
  const ph = document.getElementById('videoPlaceholder');
  ph.style.display='flex'; ph.onclick=null;
  document.getElementById('vpPlayIcon').innerHTML='<span class="spinning">⟳</span>';
  document.getElementById('vpTitle').textContent='Conectando…';
  document.getElementById('vpSub').textContent='Un momento, por favor';
}
function mostrarError(msg, retryable=true) {
  restorePlaceholder();
  document.getElementById('vpPlayIcon').textContent='⚠';
  document.getElementById('vpTitle').textContent=msg;
  document.getElementById('vpTitle').classList.add('vp-error');
  if (retryable) {
    const sub = document.getElementById('vpSub');
    sub.innerHTML='';
    const btn = document.createElement('button');
    btn.className='vp-retry'; btn.textContent='Intentar de nuevo';
    btn.onclick=e=>{e.stopPropagation();restorePlaceholder();iniciarMedia();};
    sub.appendChild(btn);
    document.getElementById('videoPlaceholder').onclick=null;
  }
}
function restorePlaceholder() {
  const ph = document.getElementById('videoPlaceholder');
  ph.style.display='flex'; ph.onclick=iniciarMedia;
  document.getElementById('vpPlayIcon').innerHTML='▶';
  document.getElementById('vpTitle').classList.remove('vp-error');
  document.getElementById('vpTitle').textContent = MODE==='live' ? 'Entrar a clase en vivo' : 'Ver lección grabada';
  document.getElementById('vpSub').textContent   = MODE==='live' ? 'Haz clic para unirte · sin instalaciones' : 'Haz clic para reproducir';
  document.getElementById('vpLabel').textContent = `Workshop ${WORKSHOP_NUM} · ${WEEK_LABEL}`;
}

// ── Marcar completada ───────────────────────────────────────
async function markDone() {
  const btn    = document.getElementById('completeBtn');
  const isDone = btn.classList.contains('done');
  btn.classList.toggle('done');
  const newState = btn.classList.contains('done');
  btn.textContent = newState ? 'Completada ✓' : 'Marcar completada';

  try {
    const token = getToken();
    if (!token) return;
    await fetch('/Php/progreso.php', {
      method:'POST', credentials:'include',
      headers:{'Content-Type':'application/json','Authorization':'Bearer '+token},
      body: JSON.stringify({ workshop_id: parseInt(LESSON_ID,10), completado: newState?1:0 })
    });
  } catch(_) {}
}

// ── Recuperar estado completada ─────────────────────────────
(function() {
  if (BD.isDone === '1') {
    const btn = document.getElementById('completeBtn');
    if (btn && !btn.classList.contains('done')) {
      btn.classList.add('done');
      btn.textContent = 'Completada ✓';
    }
  }
})();
</script>

</body>
</html>