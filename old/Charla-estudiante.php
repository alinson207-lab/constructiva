<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Charla en Vivo · Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <!--
    =====================================================
    UBICACIÓN: /charla-estudiante.html  (raíz del proyecto)
    RUTAS CORREGIDAS:
      API   → php/charla.php       ✅
      Atrás → Homestudent.php      ✅
      Logo  → index.php            ✅
    =====================================================
  -->
  <style>
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    :root {
      --teal-deep:  #0a2e2e; --teal-mid:#0d4a46; --teal-vivid:#12796e;
      --mint:       #10b09e; --mint-light:#5de6d4;
      --bg:         #0f1a1a; --bg-panel:#111f1f; --bg-card:#162424;
      --border:     rgba(93,230,212,.1); --border-soft:rgba(93,230,212,.06);
      --text-white: #f0faf9; --text-muted:#5a8a86; --text-body:#8ab8b4;
    }
    html { scroll-behavior:smooth; }
    body { font-family:'DM Sans',sans-serif; background:var(--bg); color:var(--text-white); overflow-x:hidden; min-height:100vh; }

    .topnav { position:fixed; top:0; left:0; right:0; z-index:200; height:56px; background:rgba(10,30,30,.96); border-bottom:1px solid var(--border); backdrop-filter:blur(16px); display:flex; align-items:center; padding:0 1.5rem; gap:1rem; }
    .topnav-left { display:flex; align-items:center; gap:1rem; flex:1; min-width:0; }
    .back-btn { display:flex; align-items:center; gap:.4rem; color:var(--text-body); text-decoration:none; font-size:.82rem; font-weight:500; padding:.3rem .7rem; border-radius:8px; border:1px solid var(--border); transition:color .2s,border-color .2s,background .2s; flex-shrink:0; }
    .back-btn:hover { color:var(--mint-light); border-color:var(--mint); background:rgba(93,230,212,.05); }
    .nav-label { font-size:.82rem; color:var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .nav-label strong { color:var(--text-body); font-weight:500; }
    .sep { color:var(--border); margin:0 .2rem; }
    .topnav-center { flex:2; display:flex; justify-content:center; }
    .nav-logo { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:var(--teal-vivid); text-decoration:none; letter-spacing:-.02em; }
    .nav-logo span { color:var(--mint); }
    .topnav-right { display:flex; align-items:center; gap:.8rem; flex:1; justify-content:flex-end; }
    .live-badge { display:none; align-items:center; gap:.4rem; background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.3); border-radius:100px; padding:.3rem .8rem; font-size:.75rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:#f87171; }
    .live-badge.show { display:flex; }
    .live-dot { width:6px; height:6px; border-radius:50%; background:#ef4444; animation:blink 1.4s infinite; }
    @keyframes blink { 0%,100%{opacity:1}50%{opacity:.3} }

    .page-wrap { padding-top:56px; min-height:100vh; display:flex; flex-direction:column; }

    .hero { position:relative; overflow:hidden; padding:3.5rem 2rem 3rem; display:flex; flex-direction:column; align-items:center; text-align:center; background:linear-gradient(180deg,var(--teal-deep) 0%,var(--bg) 100%); border-bottom:1px solid var(--border); }
    .hero::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 20% 50%,rgba(93,230,212,.12),transparent 55%),radial-gradient(circle at 80% 30%,rgba(24,176,160,.08),transparent 50%); }
    .hero::after  { content:''; position:absolute; inset:0; background-image:linear-gradient(rgba(93,230,212,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(93,230,212,.03) 1px,transparent 1px); background-size:48px 48px; }
    .hero-inner { position:relative; z-index:1; max-width:660px; }
    .hero-tag { display:inline-flex; align-items:center; gap:.5rem; background:rgba(93,230,212,.08); border:1px solid rgba(93,230,212,.2); border-radius:100px; padding:.3rem 1rem; font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--mint-light); margin-bottom:1.2rem; }
    .hero-title { font-family:'Syne',sans-serif; font-weight:800; font-size:clamp(1.6rem,3.5vw,2.6rem); line-height:1.1; letter-spacing:-.04em; color:var(--text-white); margin-bottom:.8rem; }
    .hero-title span { color:var(--mint); }
    .hero-desc { font-size:.95rem; color:var(--text-body); line-height:1.75; font-weight:300; }

    .main-grid { display:grid; grid-template-columns:1fr 360px; flex:1; }
    .left-col { border-right:1px solid var(--border); padding:2.5rem; }
    .sidebar { background:var(--bg-panel); border-left:1px solid var(--border); padding:2rem 1.6rem; }

    .sec-label { font-family:'Syne',sans-serif; font-weight:800; font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; color:var(--mint); margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .sec-label::after { content:''; flex:1; height:1px; background:var(--border-soft); }

    .charla-card { background:var(--bg-card); border:1px solid var(--border); border-radius:20px; overflow:hidden; margin-bottom:2rem; }
    .card-head { padding:1.5rem 1.8rem 1.2rem; border-bottom:1px solid var(--border-soft); display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; }
    .sess-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--mint); margin-bottom:.4rem; }
    .card-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.15rem; color:var(--text-white); line-height:1.25; }
    .badge { flex-shrink:0; display:flex; align-items:center; gap:.35rem; padding:.3rem .8rem; border-radius:100px; font-size:.72rem; font-weight:700; letter-spacing:.05em; text-transform:uppercase; }
    .badge-upcoming { background:rgba(251,191,36,.1); border:1px solid rgba(251,191,36,.25); color:#fbbf24; }
    .badge-live     { background:rgba(239,68,68,.1);  border:1px solid rgba(239,68,68,.25);  color:#f87171; }
    .badge-done     { background:rgba(93,230,212,.08); border:1px solid var(--border); color:var(--text-muted); }
    .badge-dot { width:5px; height:5px; border-radius:50%; background:currentColor; }
    .badge-live .badge-dot { animation:blink 1.2s infinite; }

    .card-meta { display:flex; flex-wrap:wrap; gap:.8rem 1.5rem; padding:1rem 1.8rem; border-bottom:1px solid var(--border-soft); }
    .meta-item { display:flex; align-items:center; gap:.4rem; font-size:.8rem; color:var(--text-muted); }
    .meta-item svg { color:var(--mint); flex-shrink:0; }
    .meta-item strong { color:var(--text-body); }

    .card-body { padding:1.4rem 1.8rem; }
    .card-desc { font-size:.9rem; color:var(--text-body); line-height:1.75; font-weight:300; margin-bottom:1.5rem; }

    .join-area { display:flex; align-items:center; gap:.8rem; flex-wrap:wrap; }
    .join-btn { display:inline-flex; align-items:center; gap:.6rem; padding:.75rem 1.6rem; border-radius:12px; font-family:'Syne',sans-serif; font-weight:700; font-size:.9rem; text-decoration:none; border:none; cursor:pointer; transition:transform .2s,box-shadow .2s; }
    .join-btn:hover { transform:translateY(-2px); }
    .btn-zoom  { background:#2D8CFF; color:#fff; box-shadow:0 4px 20px rgba(45,140,255,.25); }
    .btn-meet  { background:#1a73e8; color:#fff; box-shadow:0 4px 20px rgba(26,115,232,.25); }
    .btn-teams { background:#5059C9; color:#fff; box-shadow:0 4px 20px rgba(80,89,201,.25); }
    .btn-webex { background:#00B33C; color:#fff; box-shadow:0 4px 20px rgba(0,179,60,.25); }
    .btn-otro  { background:var(--mint); color:var(--teal-deep); box-shadow:0 4px 20px rgba(16,176,158,.25); }

    .copy-btn { display:inline-flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; background:transparent; border:1px solid var(--border); color:var(--text-muted); font-size:.8rem; cursor:pointer; transition:border-color .2s,color .2s,background .2s; font-family:'DM Sans',sans-serif; }
    .copy-btn:hover { border-color:var(--mint); color:var(--mint-light); background:rgba(93,230,212,.05); }
    .copy-btn.ok { border-color:var(--mint); color:var(--mint); }

    .link-lock { display:flex; align-items:center; gap:.6rem; padding:.75rem 1rem; border-radius:10px; background:rgba(251,191,36,.06); border:1px solid rgba(251,191,36,.18); font-size:.82rem; color:#fbbf24; }

    .agenda-list { display:flex; flex-direction:column; gap:.5rem; margin-bottom:2rem; }
    .agenda-item { display:flex; align-items:flex-start; gap:1rem; padding:.9rem 1.1rem; border-radius:12px; background:var(--bg-card); border:1px solid var(--border-soft); }
    .agenda-time { font-family:'Syne',sans-serif; font-weight:700; font-size:.75rem; color:var(--mint); flex-shrink:0; min-width:52px; padding-top:.1rem; }
    .agenda-text strong { font-family:'Syne',sans-serif; font-weight:700; font-size:.85rem; color:var(--text-white); display:block; margin-bottom:.2rem; }
    .agenda-text span { font-size:.8rem; color:var(--text-muted); }

    .empty-state { text-align:center; padding:3rem 2rem; background:var(--bg-card); border:1px solid var(--border); border-radius:20px; margin-bottom:2rem; }
    .empty-icon  { font-size:2.5rem; margin-bottom:1rem; }
    .empty-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:var(--text-white); margin-bottom:.5rem; }
    .empty-desc  { font-size:.88rem; color:var(--text-muted); line-height:1.6; }

    .skel { background:linear-gradient(90deg,var(--bg-card) 25%,var(--bg-panel) 50%,var(--bg-card) 75%); background-size:200% 100%; border-radius:20px; animation:shim 1.5s infinite; height:180px; margin-bottom:2rem; }
    @keyframes shim { 0%{background-position:200% 0}100%{background-position:-200% 0} }

    .inst-card { background:var(--bg-card); border:1px solid var(--border); border-radius:16px; padding:1.4rem; margin-bottom:1.8rem; text-align:center; }
    .inst-av { width:68px; height:68px; border-radius:50%; background:linear-gradient(135deg,var(--teal-mid),var(--teal-vivid)); border:2px solid var(--mint); display:flex; align-items:center; justify-content:center; font-size:1.6rem; margin:0 auto 1rem; box-shadow:0 0 24px rgba(93,230,212,.2); }
    .inst-name { font-family:'Syne',sans-serif; font-weight:800; font-size:1rem; color:var(--text-white); margin-bottom:.25rem; }
    .inst-role { font-size:.78rem; color:var(--mint); font-weight:500; margin-bottom:.8rem; }
    .inst-bio  { font-size:.8rem; color:var(--text-muted); line-height:1.65; }

    .cd-card { background:var(--bg-card); border:1px solid var(--border); border-radius:16px; padding:1.4rem; margin-bottom:1.8rem; text-align:center; }
    .cd-label { font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--text-muted); margin-bottom:1rem; }
    .cd-row { display:flex; justify-content:center; gap:.5rem; }
    .cd-unit { text-align:center; }
    .cd-num { font-family:'Syne',sans-serif; font-weight:800; font-size:2rem; color:var(--text-white); background:var(--bg-panel); border:1px solid var(--border); border-radius:10px; padding:.3rem .6rem; min-width:52px; display:block; }
    .cd-sep { font-family:'Syne',sans-serif; font-weight:800; font-size:1.8rem; color:var(--mint); padding-top:.25rem; align-self:flex-start; }
    .cd-sub { font-size:.6rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-top:.3rem; display:block; }

    .qi-list { display:flex; flex-direction:column; gap:.6rem; margin-bottom:1.8rem; }
    .qi-item { display:flex; align-items:center; gap:.8rem; padding:.75rem 1rem; border-radius:10px; background:var(--bg-card); border:1px solid var(--border-soft); }
    .qi-icon { width:32px; height:32px; border-radius:8px; flex-shrink:0; background:rgba(93,230,212,.08); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-size:.9rem; }
    .qi-lbl { font-size:.7rem; color:var(--text-muted); }
    .qi-val { font-size:.85rem; color:var(--text-white); font-weight:500; }

    .past-list { display:flex; flex-direction:column; gap:.5rem; }
    .past-item { display:flex; align-items:center; gap:.8rem; padding:.7rem .9rem; border-radius:10px; background:var(--bg-card); border:1px solid var(--border-soft); text-decoration:none; transition:border-color .2s; }
    .past-item:hover { border-color:var(--border); }
    .past-num  { width:28px; height:28px; flex-shrink:0; border-radius:7px; background:rgba(93,230,212,.06); border:1px solid var(--border-soft); display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; font-size:.7rem; color:var(--text-muted); }
    .past-info { flex:1; min-width:0; }
    .past-tit  { font-size:.8rem; color:var(--text-body); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .past-date { font-size:.68rem; color:var(--text-muted); margin-top:.1rem; }
    .past-rec  { font-size:.68rem; color:var(--mint); font-weight:700; flex-shrink:0; }
    .past-norec{ font-size:.68rem; color:var(--text-muted); flex-shrink:0; }

    .toast { position:fixed; bottom:1.5rem; left:50%; transform:translateX(-50%) translateY(12px); background:var(--bg-card); border:1px solid var(--mint); border-radius:12px; padding:.75rem 1.4rem; display:flex; align-items:center; gap:.6rem; font-size:.85rem; color:var(--mint-light); font-weight:500; z-index:999; opacity:0; pointer-events:none; transition:opacity .25s,transform .25s; }
    .toast.show { opacity:1; transform:translateX(-50%) translateY(0); }

    @media(max-width:900px) {
      .main-grid { grid-template-columns:1fr; }
      .sidebar { border-left:none; border-top:1px solid var(--border); }
      .topnav-center { display:none; }
      .left-col { padding:1.5rem; }
    }
  </style>
</head>
<body>

<nav class="topnav">
  <div class="topnav-left">
    <a href="/dashboard" class="back-btn"><!-- ✅ raíz -->
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Inicio
    </a>
    <span class="nav-label">Constructiva <span class="sep">/</span> <strong>Charlas en Vivo</strong></span>
  </div>
  <div class="topnav-center">
    <a href="/" class="nav-logo">constructiva<span>.</span></a><!-- ✅ raíz -->
  </div>
  <div class="topnav-right">
    <div class="live-badge" id="liveBadge"><span class="live-dot"></span> En Vivo</div>
  </div>
</nav>

<div class="page-wrap">
  <div class="hero">
    <div class="hero-inner">
      <div class="hero-tag">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.869v6.262a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
        Sesiones en Vivo
      </div>
      <h1 class="hero-title">Charlas <span>Constructivas</span></h1>
      <p class="hero-desc">Sesiones en vivo donde resolvemos dudas, revisamos proyectos y profundizamos en los temas que transforman tu práctica profesional.</p>
    </div>
  </div>

  <div class="main-grid">
    <div class="left-col">
      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13,2 3,14 12,14 11,22 21,10 12,10"/></svg>
        Próxima sesión
      </div>
      <div id="loadArea"><div class="skel"></div></div>
      <div id="charlaBox" style="display:none"></div>
      <div id="agendaBox" style="display:none">
        <div class="sec-label">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          Agenda de la sesión
        </div>
        <div class="agenda-list">
          <div class="agenda-item"><div class="agenda-time">0:00</div><div class="agenda-text"><strong>Bienvenida y revisión de dudas</strong><span>Resolveremos preguntas pendientes de las lecciones grabadas</span></div></div>
          <div class="agenda-item"><div class="agenda-time">0:15</div><div class="agenda-text"><strong>Desarrollo del tema principal</strong><span>Práctica en vivo con ejemplos reales</span></div></div>
          <div class="agenda-item"><div class="agenda-time">0:50</div><div class="agenda-text"><strong>Revisión de proyectos de participantes</strong><span>Analizamos modelos enviados por la comunidad</span></div></div>
          <div class="agenda-item"><div class="agenda-time">1:15</div><div class="agenda-text"><strong>Preguntas abiertas y cierre</strong><span>Espacio libre para consultas y próximas entregas</span></div></div>
        </div>
      </div>
    </div>

    <div class="sidebar">
      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        Instructor
      </div>
      <div class="inst-card">
        <div class="inst-av" id="instEmoji">👨‍🏫</div>
        <div class="inst-name" id="instName">—</div>
        <div class="inst-role" id="instRole">Constructiva</div>
        <div class="inst-bio">Instructor certificado de la plataforma Constructiva.</div>
      </div>

      <div id="cdSection" style="display:none">
        <div class="sec-label">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
          Comienza en
        </div>
        <div class="cd-card">
          <div class="cd-label">Faltan para la sesión</div>
          <div class="cd-row">
            <div class="cd-unit"><span class="cd-num" id="cd-d">--</span><span class="cd-sub">Días</span></div>
            <div class="cd-sep">:</div>
            <div class="cd-unit"><span class="cd-num" id="cd-h">--</span><span class="cd-sub">Horas</span></div>
            <div class="cd-sep">:</div>
            <div class="cd-unit"><span class="cd-num" id="cd-m">--</span><span class="cd-sub">Mins</span></div>
          </div>
        </div>
      </div>

      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Detalles
      </div>
      <div class="qi-list">
        <div class="qi-item"><div class="qi-icon">📅</div><div><div class="qi-lbl">Fecha</div><div class="qi-val" id="qi-date">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">⏰</div><div><div class="qi-lbl">Hora (RD)</div><div class="qi-val" id="qi-time">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">🖥️</div><div><div class="qi-lbl">Plataforma</div><div class="qi-val" id="qi-plat">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">🎥</div><div><div class="qi-lbl">Grabación</div><div class="qi-val">Disponible 24h después</div></div></div>
      </div>

      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 109 9"/><polyline points="3,7 3,12 8,12"/></svg>
        Sesiones anteriores
      </div>
      <div class="past-list" id="pastList">
        <div style="font-size:.82rem;color:var(--text-muted);text-align:center;padding:1rem 0;">Cargando...</div>
      </div>
    </div>
  </div>
</div>

<div class="toast" id="toast">
  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20,6 9,17 4,12"/></svg>
  <span id="toastMsg">¡Listo!</span>
</div>

<script>
// ✅ RUTA CORREGIDA — php/ en lugar de /api/
const API = 'Php/charla.php';

const PI = { zoom:'📹', meet:'🎦', teams:'💼', webex:'🔵', otro:'🌐' };
const PN = { zoom:'Zoom', meet:'Google Meet', teams:'Microsoft Teams', webex:'Webex', otro:'Enlace en línea' };
const PB = { zoom:'btn-zoom', meet:'btn-meet', teams:'btn-teams', webex:'btn-webex', otro:'btn-otro' };

let link = null, timer = null;

async function init() {
  try {
    const r = await fetch(API, { credentials:'include' });
    const j = await r.json();
    if (!j.ok) { showErr(); return; }
    render(j.data.proxima);
    renderHist(j.data.historial);
  } catch { showErr(); }
}

function render(c) {
  document.getElementById('loadArea').style.display = 'none';
  const box = document.getElementById('charlaBox');
  box.style.display = 'block';

  if (!c) {
    box.innerHTML = `<div class="empty-state"><div class="empty-icon">📅</div><div class="empty-title">Próxima sesión por confirmar</div><div class="empty-desc">El instructor está preparando la próxima charla.<br>Recibirás una notificación cuando esté lista.</div></div>`;
    return;
  }

  const dt = new Date(c.fecha_sesion);
  const ds = dt.toLocaleDateString('es-DO',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
  const ts = dt.toLocaleTimeString('es-DO',{hour:'2-digit',minute:'2-digit'});
  link = c.link_reunion;

  const badgeMap = {
    en_vivo: `<div class="badge badge-live"><span class="badge-dot"></span>En Vivo</div>`,
    finalizada: `<div class="badge badge-done"><span class="badge-dot"></span>Finalizada</div>`,
    default: `<div class="badge badge-upcoming"><span class="badge-dot"></span>Próximamente</div>`
  };
  const badge = badgeMap[c.estado] || badgeMap.default;
  if (c.estado === 'en_vivo') document.getElementById('liveBadge').classList.add('show');

  const joinHtml = !link
    ? `<div class="link-lock">🔒 El enlace estará disponible 24h antes de la sesión</div>`
    : `<div class="join-area">
        <a href="${link}" target="_blank" rel="noopener" class="join-btn ${PB[c.plataforma]||'btn-otro'}">${PI[c.plataforma]||'🌐'} Unirme a la sesión</a>
        <button class="copy-btn" id="copyBtn" onclick="copyLink()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg>
          Copiar enlace
        </button>
       </div>`;

  box.innerHTML = `
    <div class="charla-card">
      <div class="card-head">
        <div><div class="sess-label">${c.sesion_label||'Sesión '+c.sesion_numero}</div><div class="card-title">${c.titulo}</div></div>
        ${badge}
      </div>
      <div class="card-meta">
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><strong>${cap(ds)}</strong></div>
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg><strong>${ts}</strong> · ${c.duracion_min} min</div>
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg><strong>${PN[c.plataforma]||'En línea'}</strong></div>
      </div>
      <div class="card-body">
        ${c.descripcion ? `<p class="card-desc">${c.descripcion}</p>` : ''}
        ${joinHtml}
      </div>
    </div>`;

  document.getElementById('agendaBox').style.display = 'block';
  document.getElementById('qi-date').textContent = dt.toLocaleDateString('es-DO',{weekday:'short',day:'numeric',month:'short',year:'numeric'});
  document.getElementById('qi-time').textContent = `${ts} · ${c.duracion_min} min`;
  document.getElementById('qi-plat').textContent = PN[c.plataforma]||'En línea';

  if (c.instructor_nombre)   document.getElementById('instName').textContent = c.instructor_nombre;
  if (c.instructor_emoji)    document.getElementById('instEmoji').textContent = c.instructor_emoji;
  if (c.instructor_profesion)document.getElementById('instRole').textContent  = c.instructor_profesion;

  if (c.estado === 'programada') { document.getElementById('cdSection').style.display='block'; startCD(dt); }
}

function renderHist(h) {
  const el = document.getElementById('pastList');
  if (!h || !h.length) { el.innerHTML=`<div style="font-size:.82rem;color:var(--text-muted);text-align:center;padding:1rem 0;">Aún no hay sesiones anteriores</div>`; return; }
  el.innerHTML = h.map(s => {
    const d = new Date(s.fecha_sesion).toLocaleDateString('es-DO',{day:'numeric',month:'short',year:'numeric'});
    return `<div class="past-item">
      <div class="past-num">${String(s.sesion_numero).padStart(2,'0')}</div>
      <div class="past-info"><div class="past-tit">${s.titulo}</div><div class="past-date">${d} · ${s.duracion_min} min</div></div>
      ${s.link_grabacion ? `<a href="${s.link_grabacion}" target="_blank" class="past-rec">▶ Ver</a>` : `<span class="past-norec">Sin grab.</span>`}
    </div>`;
  }).join('');
}

function showErr() {
  document.getElementById('loadArea').style.display='none';
  document.getElementById('charlaBox').style.display='block';
  document.getElementById('charlaBox').innerHTML=`<div class="empty-state"><div class="empty-icon">⚠️</div><div class="empty-title">No se pudo cargar la sesión</div><div class="empty-desc">Verifica tu conexión o intenta más tarde.</div></div>`;
}

function startCD(t) {
  if (timer) clearInterval(timer);
  function tick() {
    const d = t - new Date(); if (d<=0){clearInterval(timer);return;}
    document.getElementById('cd-d').textContent = String(Math.floor(d/86400000)).padStart(2,'0');
    document.getElementById('cd-h').textContent = String(Math.floor((d%86400000)/3600000)).padStart(2,'0');
    document.getElementById('cd-m').textContent = String(Math.floor((d%3600000)/60000)).padStart(2,'0');
  }
  tick(); timer = setInterval(tick, 30000);
}

function copyLink() {
  if (!link) return;
  navigator.clipboard.writeText(link).then(() => {
    const b = document.getElementById('copyBtn');
    if (b) { b.classList.add('ok'); b.textContent='✓ Copiado'; }
    showToast('¡Enlace copiado al portapapeles!');
    setTimeout(() => { if(b){b.classList.remove('ok'); b.innerHTML=`<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copiar enlace`;} }, 2500);
  });
}

function showToast(m) {
  const t = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = m;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2800);
}

function cap(s) { return s.charAt(0).toUpperCase()+s.slice(1); }

init();
</script>
</body>
</html>