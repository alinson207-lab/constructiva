<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Live | Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <script src="/Js/cv-session.js"></script>
  <style>
    :root {
      --teal:    #0aab96;
      --teal2:   #089882;
      --bg:      #0a1614;
      --bg2:     #0f1f1d;
      --bg3:     #152522;
      --surface: #1a2e2b;
      --border:  rgba(10,171,150,.15);
      --text:    #e8f4f2;
      --muted:   rgba(232,244,242,.45);
      --danger:  #e05555;
      --sh:      0 8px 32px rgba(0,0,0,.4);
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth}
    body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;flex-direction:column}

    /* ── TOPBAR ── */
    .bar{
      height:58px;background:rgba(15,31,29,.95);
      backdrop-filter:blur(12px);
      border-bottom:1px solid var(--border);
      display:flex;align-items:center;padding:0 2rem;
      justify-content:space-between;position:sticky;top:0;z-index:100;
    }
    .bar img{height:28px;width:auto}
    .bar-r{display:flex;align-items:center;gap:.8rem}
    .bar-lnk{
      display:flex;align-items:center;gap:.35rem;
      color:var(--muted);text-decoration:none;font-size:.82rem;font-weight:500;
      padding:.3rem .75rem;border-radius:8px;transition:all .15s;
    }
    .bar-lnk:hover{background:rgba(255,255,255,.06);color:var(--text)}
    .bar-lnk.active{color:var(--teal)}

    /* ── LIVE BADGE ── */
    .live-badge{
      display:inline-flex;align-items:center;gap:.4rem;
      background:rgba(220,50,50,.15);border:1px solid rgba(220,50,50,.3);
      color:#ff6b6b;border-radius:100px;
      padding:.22rem .75rem;font-size:.72rem;font-weight:700;
      font-family:'Syne',sans-serif;letter-spacing:.05em;
    }
    .live-dot{
      width:7px;height:7px;border-radius:50%;background:#ff4444;
      animation:pulse 1.4s ease-in-out infinite;
    }
    @keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.8)}}

    .offline-badge{
      display:inline-flex;align-items:center;gap:.4rem;
      background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);
      color:var(--muted);border-radius:100px;
      padding:.22rem .75rem;font-size:.72rem;font-weight:600;
      font-family:'Syne',sans-serif;
    }

    /* ── HERO LABEL ── */
    .page-label{
      font-size:.65rem;font-weight:700;letter-spacing:.14em;
      color:var(--teal);text-transform:uppercase;margin-bottom:.35rem;
    }
    .page-title{
      font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;
      line-height:1.2;color:var(--text);
    }
    .page-title em{font-style:normal;color:var(--teal)}

    /* ── LAYOUT PRINCIPAL ── */
    .live-wrap{
      display:grid;
      grid-template-columns:1fr 360px;
      gap:1.4rem;
      padding:2rem 2.4rem 4rem;
      max-width:1400px;
      margin:0 auto;
      width:100%;
      flex:1;
    }

    /* ── COLUMNA IZQUIERDA ── */
    .col-left{}

    /* Player */
    .player-wrap{
      position:relative;width:100%;
      padding-top:56.25%; /* 16:9 */
      background:#000;border-radius:14px;overflow:hidden;
      box-shadow:var(--sh);margin-bottom:1.4rem;
    }
    .player-wrap iframe{
      position:absolute;inset:0;width:100%;height:100%;border:none;
    }
    .player-offline{
      position:absolute;inset:0;
      display:flex;flex-direction:column;align-items:center;justify-content:center;
      gap:1rem;background:#0d1a18;
    }
    .player-offline-icon{font-size:3.5rem;opacity:.4}
    .player-offline h3{
      font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;
      color:rgba(232,244,242,.5);
    }
    .player-offline p{font-size:.82rem;color:rgba(232,244,242,.3);text-align:center;max-width:300px;line-height:1.6}

    /* Info card */
    .info-card{
      background:var(--bg2);border:1px solid var(--border);
      border-radius:14px;padding:1.5rem 1.8rem;
    }
    .info-header{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;margin-bottom:.8rem}
    .info-titulo{font-family:'Syne',sans-serif;font-size:1.2rem;font-weight:800;color:var(--text);line-height:1.3}
    .info-desc{font-size:.85rem;color:var(--muted);line-height:1.7;margin-bottom:1rem}
    .info-meta{display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap}
    .info-meta-item{display:flex;align-items:center;gap:.4rem;font-size:.78rem;color:var(--muted)}
    .info-meta-item svg{flex-shrink:0;color:var(--teal)}

    /* ── COLUMNA DERECHA ── */
    .col-right{}

    /* Chat */
    .chat-card{
      background:var(--bg2);border:1px solid var(--border);
      border-radius:14px;overflow:hidden;
      height:600px;display:flex;flex-direction:column;
    }
    .chat-header{
      padding:1rem 1.4rem;border-bottom:1px solid var(--border);
      display:flex;align-items:center;justify-content:space-between;
      flex-shrink:0;
    }
    .chat-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem;color:var(--text)}
    .chat-frame{flex:1;border:none;background:#000}
    .chat-offline{
      flex:1;display:flex;flex-direction:column;
      align-items:center;justify-content:center;
      gap:.7rem;color:var(--muted);font-size:.82rem;text-align:center;
      padding:1.5rem;
    }
    .chat-offline svg{opacity:.3}

    /* Próximas sesiones / placeholder */
    .next-card{
      background:var(--bg2);border:1px solid var(--border);
      border-radius:14px;padding:1.5rem 1.8rem;margin-top:1.2rem;
    }
    .next-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem;color:var(--text);margin-bottom:1rem}
    .next-item{
      display:flex;align-items:center;gap:.8rem;
      padding:.7rem 0;border-bottom:1px solid var(--border);
    }
    .next-item:last-child{border-bottom:none;padding-bottom:0}
    .next-icon{
      width:36px;height:36px;border-radius:8px;
      background:rgba(10,171,150,.1);border:1px solid var(--border);
      display:flex;align-items:center;justify-content:center;flex-shrink:0;
      font-size:1rem;
    }
    .next-info{}
    .next-name{font-size:.82rem;font-weight:500;color:var(--text)}
    .next-sub{font-size:.72rem;color:var(--muted);margin-top:.1rem}

    /* ── LOADING ── */
    .page-loader{
      position:fixed;inset:0;background:var(--bg);
      display:flex;align-items:center;justify-content:center;
      z-index:999;transition:opacity .4s;
    }
    .page-loader.hide{opacity:0;pointer-events:none}
    .sp{width:32px;height:32px;border:3px solid var(--border);border-top-color:var(--teal);border-radius:50%;animation:spi .7s linear infinite}
    @keyframes spi{to{transform:rotate(360deg)}}

    /* ── BTN ── */
    .btn-p{
      display:inline-flex;align-items:center;gap:.4rem;
      background:var(--teal);color:#fff;
      font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem;
      padding:.5rem 1.1rem;border-radius:100px;border:none;
      cursor:pointer;transition:all .18s;text-decoration:none;
    }
    .btn-p:hover{background:var(--teal2);transform:translateY(-1px)}

    /* ── RESPONSIVE ── */
    @media(max-width:900px){
      .live-wrap{grid-template-columns:1fr;padding:1.4rem 1rem 4rem}
      .chat-card{height:480px}
    }
  </style>
</head>
<body>

<div class="page-loader" id="loader"><div class="sp"></div></div>

<!-- TOPBAR -->
<header class="bar">
  <a href="/"><img src="/Img/Logo aqua.png" alt="Constructiva"></a>
  <div class="bar-r">
    <a href="/" class="bar-lnk">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      Inicio
    </a>
    <a href="/dashboard" class="bar-lnk" id="bar-dashboard" style="display:none">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Mi Espacio
    </a>
    <div id="bar-badge"></div>
  </div>
</header>

<!-- CONTENIDO PRINCIPAL -->
<div class="live-wrap" id="live-wrap" style="display:none">

  <!-- COLUMNA IZQUIERDA -->
  <div class="col-left">

    <!-- Player -->
    <div class="player-wrap" id="player-wrap">
      <div class="player-offline" id="player-offline">
        <div class="player-offline-icon">📡</div>
        <h3>Sin transmisión activa</h3>
        <p>No hay ningún live en este momento. Vuelve pronto o suscríbete para recibir notificaciones.</p>
      </div>
    </div>

    <!-- Info -->
    <div class="info-card">
      <div class="info-header">
        <div>
          <div class="page-label">Transmisión en vivo</div>
          <div class="info-titulo" id="live-titulo">Cargando...</div>
        </div>
        <div id="live-status-badge"></div>
      </div>
      <p class="info-desc" id="live-desc"></p>
      <div class="info-meta">
        <div class="info-meta-item">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          <span id="live-hora">—</span>
        </div>
        <div class="info-meta-item">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
          YouTube Live
        </div>
        <a href="https://www.youtube.com/@ConstructivaExperience" target="_blank" rel="noopener" class="info-meta-item" style="color:var(--teal);text-decoration:none">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Ver en YouTube
        </a>
      </div>
    </div>
  </div>

  <!-- COLUMNA DERECHA -->
  <div class="col-right">

    <!-- Chat -->
    <div class="chat-card" id="chat-card">
      <div class="chat-header">
        <div class="chat-title">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:.3rem"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
          Chat en vivo
        </div>
        <span id="chat-badge"></span>
      </div>
      <div id="chat-content" style="flex:1;display:flex;flex-direction:column">
        <div class="chat-offline" id="chat-offline">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
          <p>El chat estará disponible<br>cuando comience el live.</p>
        </div>
      </div>
    </div>

    <!-- Próximas charlas -->
    <div class="next-card" id="next-card" style="display:none">
      <div class="next-title">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline;vertical-align:middle;margin-right:.3rem;color:var(--teal)"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Próximas sesiones
      </div>
      <div id="next-list"></div>
    </div>

  </div>
</div>

<script>
(async () => {

  // Mostrar botón Mi Espacio si hay sesión
  const user = CVSession?.getUser?.();
  if (user) {
    const db = document.getElementById('bar-dashboard');
    if (db) db.style.display = 'flex';
  }

  // Hora actual formateada
  function horaActual() {
    const now = new Date();
    const dias = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
    const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
    return `${dias[now.getDay()]} ${now.getDate()} ${meses[now.getMonth()]} · ${now.toLocaleTimeString('es-DO', {hour:'2-digit',minute:'2-digit'})}`;
  }

  document.getElementById('live-hora').textContent = horaActual();
  setInterval(() => {
    document.getElementById('live-hora').textContent = horaActual();
  }, 30000);

  // Cargar configuración del live
  try {
    const r = await fetch('/Php/live.php');
    const j = await r.json();

    if (!j.ok) throw new Error('Error al cargar');

    const cfg = j.data;

    // Título y descripción
    document.getElementById('live-titulo').textContent = cfg.titulo || 'Live Constructiva';
    document.getElementById('live-desc').textContent   = cfg.descripcion || '';
    document.title = (cfg.titulo || 'Live') + ' | Constructiva';

    const statusBadge = document.getElementById('live-status-badge');
    const barBadge    = document.getElementById('bar-badge');

    if (cfg.activo && cfg.youtube_id) {
      // ── LIVE ACTIVO ──────────────────────────────────────

      // Badge topbar
      barBadge.innerHTML = `<span class="live-badge"><span class="live-dot"></span>EN VIVO</span>`;
      statusBadge.innerHTML = `<span class="live-badge"><span class="live-dot"></span>EN VIVO</span>`;

      // Reproductor
      const playerWrap = document.getElementById('player-wrap');
      playerWrap.innerHTML = `
        <iframe
          src="https://www.youtube.com/embed/${cfg.youtube_id}?autoplay=1&rel=0&modestbranding=1"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
          title="${cfg.titulo}">
        </iframe>`;

      // Chat
      if (cfg.mostrar_chat) {
        const chatContent = document.getElementById('chat-content');
        chatContent.innerHTML = `
          <iframe
            class="chat-frame"
            src="https://www.youtube.com/live_chat?v=${cfg.youtube_id}&embed_domain=${location.hostname}"
            title="Chat en vivo">
          </iframe>`;

        document.getElementById('chat-badge').innerHTML =
          `<span class="live-badge" style="font-size:.62rem"><span class="live-dot"></span>Activo</span>`;
      }

      // Link "Ver en YouTube"
      const ytLink = document.querySelector('.info-meta a[href*="youtube"]');
      if (ytLink) ytLink.href = `https://www.youtube.com/watch?v=${cfg.youtube_id}`;

    } else {
      // ── SIN LIVE ─────────────────────────────────────────
      barBadge.innerHTML = `<span class="offline-badge">Sin transmisión</span>`;
      statusBadge.innerHTML = `<span class="offline-badge">Sin transmisión</span>`;
    }

    // Cargar próximas charlas
    try {
      const rc = await fetch('/Php/charla.php');
      const jc = await rc.json();
      if (jc.ok && jc.data?.historial?.length) {
        const nextCard = document.getElementById('next-card');
        const nextList = document.getElementById('next-list');
        nextCard.style.display = 'block';
        const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        nextList.innerHTML = jc.data.historial.slice(0,3).map(h => {
          const fd = new Date(h.fecha_sesion);
          return `<div class="next-item">
            <div class="next-icon">🎬</div>
            <div class="next-info">
              <div class="next-name">${h.titulo}</div>
              <div class="next-sub">${fd.getDate()} ${meses[fd.getMonth()]} · ${h.sesion_label || 'Sesión '+h.sesion_numero}
                ${h.link_grabacion ? ` · <a href="${h.link_grabacion}" target="_blank" rel="noopener" style="color:var(--teal);text-decoration:none">Ver grabación</a>` : ''}
              </div>
            </div>
          </div>`;
        }).join('');
      }
    } catch(e) {}

  } catch(e) {
    document.getElementById('live-titulo').textContent = 'Live Constructiva';
    document.getElementById('live-status-badge').innerHTML =
      `<span class="offline-badge">Sin transmisión</span>`;
  }

  // Mostrar página
  document.getElementById('live-wrap').style.display = 'grid';
  const loader = document.getElementById('loader');
  loader.classList.add('hide');
  setTimeout(() => loader.style.display = 'none', 400);

})();
</script>
</body>
</html>