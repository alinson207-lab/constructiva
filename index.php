<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Constructiva — Aprende. Construye. Transforma.</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
 <link rel="stylesheet" href="/Css/index.css?v=1.7.4">
<link rel="stylesheet" href="/Css/player.css?v=1.7.4">
<link rel="stylesheet" href="/Css/responsive.css?v=1.7.4">
  <script src="/Js/cv-session.js"></script>
</head>
<body>

<!-- Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursor-ring"></div>

<!-- NAV -->
<nav id="navbar">
  <img src="/Img/Logo aqua.png" alt="" width="170px" height="auto">
  <div class="nav-inner-pill">
    <ul class="nav-links">
      <li class="nav-dropdown">
        <a href="#cursos" class="nav-dropdown-toggle">
          Cursos
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="nav-dropdown-menu">
          <a href="/cursos/revit" class="nav-dropdown-item">
            <span class="dd-icon"><img src="Img/Revi.png" alt="" width="50"></span>
            <div><div class="dd-title">BIM · Revit</div><div class="dd-sub">Evita demoliciones en obra</div></div>
          </a>
          <a href="/cursos/ms-project" class="nav-dropdown-item">
            <span class="dd-icon"><img src="Img/Project.png" alt="" width="50"></span>
            <div><div class="dd-title">Ms Project</div><div class="dd-sub">Cronograma de obra</div></div>
          </a>
          <a href="/cursos/ia" class="nav-dropdown-item">
            <span class="dd-icon"><img src="Img/IA.png" alt="" width="50"></span>
            <div><div class="dd-title">Inteligencia Artificial</div><div class="dd-sub">Aumenta tu productividad</div></div>
          </a>
          <a href="/cursos/marca" class="nav-dropdown-item">
            <span class="dd-icon"><img src="Img/Marcap.png" alt="" width="50"></span>
            <div><div class="dd-title">Marca Personal</div><div class="dd-sub">Para ingenieros y arquitectos</div></div>
          </a>
          <a href="/cursos/neuro" class="nav-dropdown-item">
            <span class="dd-icon"><img src="Img/Neuro.png" alt="" width="50"></span>
            <div><div class="dd-title">Neurocomunicación</div><div class="dd-sub">Comunicación estratégica</div></div>
          </a>
        </div>
      </li>
      <li><a href="https://constructiva.edu.do/Experience/">Constructiva Experience</a></li>
      <li class="nav-dropdown">
  <a href="#" class="nav-dropdown-toggle">
    Eventos
    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
  </a>
  <div class="nav-dropdown-menu">
    <a href="/live" class="nav-dropdown-item">
      <span class="dd-icon">🔴</span>
      <div><div class="dd-title">Live</div><div class="dd-sub">Transmisión en vivo</div></div>
    </a>
    <a href="/Calendario" class="nav-dropdown-item">
      <span class="dd-icon">📅</span>
      <div><div class="dd-title">Calendario</div><div class="dd-sub">Próximas sesiones</div></div>
    </a>
  </div>
</li>
      <li><a href="https://chat.whatsapp.com/JB8l2wJBMMf2uxTm3Y9ZS4" target="_blank">Comunidad</a></li>
      <li id="nav-auth-li">
        <a href="/login" class="nav-cta" id="nav-login-btn">Iniciar Sesión</a>
        <div class="nav-user-dropdown" id="nav-user-dropdown" style="display:none">
          <button class="nav-user-trigger" id="nav-user-trigger" type="button" aria-expanded="false">
            <span class="nu-avatar" id="nu-avatar">👤</span>
            <span class="nu-name" id="nu-name">Usuario</span>
            <svg class="nu-chevron" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="nu-menu" id="nu-menu">
            <a href="/perfil" class="nu-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>Mi Perfil
            </a>
            <a href="/dashboard" class="nu-item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>Mi Espacio
            </a>
            <div class="nu-divider"></div>
            <button class="nu-item nu-logout" type="button" onclick="CVSession.logout()">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>Cerrar sesión
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>

<!-- HERO -->
<section class="hero" id="home">

  <!-- Contenido izquierdo -->
  <div class="hero-content">
    <div class="hero-badge">
      <span></span>
      Constructiva Experience
    </div>


    
    <h1>
      Learn.<br>
      <em>Apply.</em><br>
      Lead.
    </h1>
    <p class="hero-sub">
      5 workshops intensivos online en vivo para ingenieros y arquitectos.
      Más de 14 horas prácticas, certificado digital y físico incluido.
    </p>
    <div class="hero-actions">
      <a href="/programa-completo" class="btn-primary">
        Ver todos los cursos
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#como-funciona" class="btn-ghost">
        <span class="play-icon">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="5,3 19,12 5,21"/></svg>
        </span>
        Cómo funciona
      </a>
    </div>
    <div class="hero-stats">
      <div class="stat-item">
        <div class="stat-num"><span>5</span></div>
        <div class="stat-label">Workshops</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span>14 h+</span></div>
        <div class="stat-label">Prácticas</div>
      </div>
      <div class="stat-item">
        <div class="stat-num"><span>5 sem</span></div>
        <div class="stat-label">Duración</div>
      </div>
    </div>
  </div><!-- /hero-content -->

  <!-- ═══════════════════════════════════════════════
       COUNTDOWN — hijo directo de .hero
       position:absolute center en el CSS
  ════════════════════════════════════════════════ -->
  <!--<div class="hero-countdown" id="heroCountdownWrap">
    <p class="countdown-label">
      <span class="countdown-dot"></span>
      Disponible desde:
    </p>
    <div class="countdown-timer" id="heroCountdown">
      <div class="countdown-unit">
        <span class="countdown-num" id="cdDays">00</span>
        <span class="countdown-unit-label">días</span>
      </div>
      <span class="countdown-sep">:</span>
      <div class="countdown-unit">
        <span class="countdown-num" id="cdHours">00</span>
        <span class="countdown-unit-label">horas</span>
      </div>
      <span class="countdown-sep">:</span>
      <div class="countdown-unit">
        <span class="countdown-num" id="cdMins">00</span>
        <span class="countdown-unit-label">min</span>
      </div>
      <span class="countdown-sep">:</span>
      <div class="countdown-unit">
        <span class="countdown-num" id="cdSecs">00</span>
        <span class="countdown-unit-label">seg</span>
      </div>
    </div>
    <p class="countdown-date" id="cdDate">31 MAR · 8:00 PM</p>
    <p class="countdown-available" id="cdAvailable" style="display:none;">¡Ya disponible! 🎉</p>
  </div>
  -->

  <!-- Mockup Card -->
  <div class="hero-visual">
    <div class="course-card-mockup">
      <div class="card-top">
        <video class="card-video" src="/Videos/introconstructiva.mp4" autoplay muted loop playsinline id="heroVideo"></video>
        <div class="card-progress" id="heroProgress">
          <div class="card-progress-fill" id="heroProgressFill"></div>
        </div>
        <div class="card-controls">
          <button class="ctrl-btn playing" id="heroPlayBtn" title="Pausar">
            <svg class="icon-play" width="14" height="14" viewBox="0 0 24 24" fill="white"><polygon points="5,3 19,12 5,21"/></svg>
            <svg class="icon-pause" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
          </button>
          <button class="ctrl-btn" id="heroSoundBtn" title="Activar sonido">
            <svg class="icon-muted" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polygon points="11,5 6,9 2,9 2,15 6,15 11,19"/><line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/></svg>
            <svg class="icon-sound" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polygon points="11,5 6,9 2,9 2,15 6,15 11,19"/><path d="M15.54 8.46a5 5 0 0 1 0 7.07"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/></svg>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="card-tag">⚡ Intro Constructiva</div>
        <div class="card-title">5 pilares fundamentales para ingenieros y arquitectos</div>
        <div class="card-meta">
          <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>+14 horas</span>
          <span><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16l6-3 6 3V4a2 2 0 0 0-2-2z"/></svg>5 workshops</span>
        </div>
        <div class="progress-bar"><div class="progress-fill"></div></div>
        <div class="card-footer">
          <div style="display:flex;align-items:center;gap:.7rem">
            <div class="avatars">
              <div></div>
              <div style="background:linear-gradient(135deg,#5de6d4,#18b0a0)"></div>
              <div style="background:linear-gradient(135deg,#12796e,#5de6d4)"></div>
            </div>
            <span class="card-enrolled">+1.2k inscritos</span>
          </div>
          <span style="font-family:'Syne',sans-serif;font-weight:800;color:#5de6d4;font-size:.95rem">Gratis</span>
        </div>
      </div>
    </div>
    <div class="pill pill-1"><span class="pill-dot"></span>Certificado digital y físico</div>
    <div class="pill pill-2">🎓 23 MAR – 22 ABR · Online en vivo</div>
  </div><!-- /hero-visual -->

</section>

<!-- MARQUEE -->
<div class="marquee-section">
  <div class="marquee-track" id="marqueeTrack">
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>BIM · Revit</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Ms Project</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Inteligencia Artificial</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Marca Personal</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Neurocomunicación</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Online en Vivo</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Certificado Digital & Físico</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Bonus: Inglés 1 on 1</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Descuento Fundador</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>BIM · Revit</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Ms Project</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Inteligencia Artificial</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Marca Personal</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Neurocomunicación</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Online en Vivo</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Certificado Digital & Físico</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Bonus: Inglés 1 on 1</div>
    <div class="marquee-item"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>Descuento Fundador</div>
  </div>
</div>

<!-- FEATURED COURSES -->
<section class="courses" id="cursos">
  <div class="reveal">
    <div class="section-label">Constructiva Experience</div>
    <h2 class="section-title">Los 5 Workshops<br>del programa</h2>
    <p class="section-sub">+14 horas prácticas · 5 semanas · Online en vivo · Certificado digital y físico incluido.</p>
  </div>
 <div class="courses-grid">
    <a href="/cursos/revit" class="course-tile reveal">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#0d4a46,#12796e);padding:0;overflow:hidden"><img src="Img/Revitp.jpeg" alt="BIM Revit" style="width:100%;height:100%;object-fit:cover;opacity:.85"></div><span class="tile-badge">⚡ Workshop 1</span><span class="tile-level">Intermedio</span></div>
      <div class="tile-body"><div class="tile-category">BIM · Revit</div><div class="tile-title">Evita demoliciones en obra con BIM-Revit</div><div class="tile-author">Constructiva Experience</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>En vivo</span><span class="tile-price" style="color:var(--mint)">Ver más</span></div></div>
    </a>
    <a href="/cursos/ms-project" class="course-tile reveal">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#0a2a4a,#0d6aad);padding:0;overflow:hidden"><img src="Img/Msprojectp.jpeg" alt="Ms Project" style="width:100%;height:100%;object-fit:cover;opacity:.85"></div><span class="tile-badge">📌 Workshop 2</span><span class="tile-level">Intermedio</span></div>
      <div class="tile-body"><div class="tile-category">Ms Project</div><div class="tile-title">El poder del cronograma de obra con Ms Project</div><div class="tile-author">Constructiva Experience</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>En vivo</span><span class="tile-price" style="color:var(--mint)">Ver más</span></div></div>
    </a>
    <a href="/cursos/ia" class="course-tile reveal">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#2a1a0a,#8f5a0d);padding:0;overflow:hidden"><img src="Img/IAp.jpeg" alt="Inteligencia Artificial" style="width:100%;height:100%;object-fit:cover;opacity:.85"></div><span class="tile-badge">🔥 Workshop 3</span><span class="tile-level">Todos los niveles</span></div>
      <div class="tile-body"><div class="tile-category">Inteligencia Artificial</div><div class="tile-title">IA para aumentar la productividad en ingeniería</div><div class="tile-author">Constructiva Experience</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>En vivo</span><span class="tile-price" style="color:var(--mint)">Ver más</span></div></div>
    </a>
    <a href="/cursos/marca" class="course-tile reveal">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#2a1a3e,#5c2e8f);padding:0;overflow:hidden"><img src="Img/Marcapp.jpeg" alt="Marca Personal" style="width:100%;height:100%;object-fit:cover;opacity:.85"></div><span class="tile-badge">✨ Workshop 4</span><span class="tile-level">Todos los niveles</span></div>
      <div class="tile-body"><div class="tile-category">Marca Personal</div><div class="tile-title">Marca Personal para ingenieros y arquitectos</div><div class="tile-author">Constructiva Experience</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>En vivo</span><span class="tile-price" style="color:var(--mint)">Ver más</span></div></div>
    </a>
    <a href="/cursos/neuro" class="course-tile reveal">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#1a2e1a,#2e7a3e);padding:0;overflow:hidden"><img src="Img/neurop.jpeg" alt="Neurocomunicación" style="width:100%;height:100%;object-fit:cover;opacity:.85"></div><span class="tile-badge">🎯 Workshop 5</span><span class="tile-level">Todos los niveles</span></div>
      <div class="tile-body"><div class="tile-category">Neurocomunicación</div><div class="tile-title">Neurocomunicación Estratégica para profesionales</div><div class="tile-author">Constructiva Experience</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>En vivo</span><span class="tile-price" style="color:var(--mint)">Ver más</span></div></div>
    </a>
    <a href="/bonus" class="course-tile reveal" style="border:1.5px dashed var(--border-light);background:var(--bg-soft);">
      <div class="tile-thumb"><div class="tile-thumb-bg" style="background:linear-gradient(135deg,#0f3a30,#16705a)"><img src="Img/Bonus.png" alt="" width="200"></div><span class="tile-badge" style="background:rgba(93,230,180,.2);color:#0d9a6a">🎁 Bonus</span><span class="tile-level">Incluido</span></div>
      <div class="tile-body"><div class="tile-category" style="color:#0d9a6a">Bonus Exclusivo</div><div class="tile-title">1 on 1 Inglés Profesional para ingenieros</div><div class="tile-author">Incluido con el programa completo</div><div class="tile-footer"><div class="tile-rating"><span class="stars">★★★★★</span> 5.0</div><span class="tile-duration"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>Personalizado</span><span class="tile-price free">Gratis</span></div></div>
    </a>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="how" id="como-funciona">
  <div class="reveal">
    <div class="section-label">El proceso</div>
    <h2 class="section-title">Aprender nunca<br>fue tan simple</h2>
    <p class="section-sub">Cuatro pasos para transformar tu conocimiento en habilidades reales.</p>
  </div>
  <div class="how-grid">
    <div class="steps">
      <div class="step reveal"><div class="step-num">01</div><div class="step-content"><h3>Elige tu curso</h3><p>Explora más de 48 cursos en distintas áreas. Filtra por nivel, duración o categoría y encuentra el que mejor se adapte a tus objetivos.</p></div></div>
      <div class="step reveal"><div class="step-num">02</div><div class="step-content"><h3>Aprende en video</h3><p>Cada curso está dividido en módulos y capítulos en video. Pausa, repite y avanza a tu propio ritmo desde cualquier dispositivo.</p></div></div>
      <div class="step reveal"><div class="step-num">03</div><div class="step-content"><h3>Practica y aplica</h3><p>Completa ejercicios y proyectos prácticos diseñados para reforzar cada concepto aprendido con situaciones del mundo real.</p></div></div>
      <div class="step reveal"><div class="step-num">04</div><div class="step-content"><h3>Obtén tu certificado</h3><p>Al completar el curso recibes un certificado verificable que puedes compartir en tu LinkedIn o portafolio profesional.</p></div></div>
    </div>
    <div class="how-visual reveal">
      <div class="how-circle">
        <div class="orbit-dot">🎓</div>
        <div class="orbit-dot">📚</div>
        <div class="orbit-dot">✏️</div>
        <div class="orbit-dot">🏆</div>
        <div class="how-center">
          <div class="how-center-icon">🚀</div>
          <div class="how-center-label">Constructiva</div>
          <div class="how-center-sub">Tu futuro, hoy</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section class="cta-section">
  <div class="cta-inner reveal">
    <div class="cta-text">
      <h2>¿Listo para construir tu futuro?</h2>
      <p>Únete al programa Constructiva Experience. 5 workshops intensivos, +14 horas prácticas, certificado digital y físico. Descuentos de Fundador y Estudiantil disponibles.</p>
    </div>
    <div class="cta-actions">
      <a href="/register.php" class="btn-primary">Inscribirme ahora <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a>
      <span class="cta-note">23 MAR – 22 ABR · Cupos limitados</span>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <a href="#" class="footer-logo">constructiva<span>.</span></a>
      <p class="footer-desc">Programa intensivo de 5 workshops para ingenieros y arquitectos. Aprende BIM-Revit, Ms Project, IA, Marca Personal y Neurocomunicación. Construye tu futuro, hoy.</p>
      <div class="footer-socials">
        <a href="#" class="social-btn"><img src="Img/img/IG.png" width="25px"></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Workshops</h4>
      <ul>
        <li><a href="/cursos/revit">BIM · Revit</a></li>
        <li><a href="/cursos/ms-project">Ms Project</a></li>
        <li><a href="/cursos/ia">Inteligencia Artificial</a></li>
        <li><a href="/cursos/marca">Marca Personal</a></li>
        <li><a href="/cursos/neuro">Neurocomunicación</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>© 2026 Constructiva. constructiva.edu.do</span>
    <span>LEAD. APPLY. LEAD.</span>
  </div>
</footer>

<script src="Js/index.js"></script>
<?php include 'Php/router.php'; ?>

<script>
(function () {
  var target = new Date('2026-04-01T00:00:00Z');
  function pad(n) { return String(n).padStart(2, '0'); }
  function tick() {
    var diff = target - new Date();
    if (diff <= 0) {
      ['cdDays','cdHours','cdMins','cdSecs'].forEach(function(id) {
        document.getElementById(id).textContent = '00';
      });
      var t = document.getElementById('heroCountdown');
      var a = document.getElementById('cdAvailable');
      var d = document.getElementById('cdDate');
      if (t) t.classList.add('expired');
      if (a) a.style.display = 'block';
      if (d) d.style.display = 'none';
      clearInterval(timerInterval);
      return;
    }
    document.getElementById('cdDays').textContent  = pad(Math.floor(diff / 86400000));
    document.getElementById('cdHours').textContent = pad(Math.floor((diff % 86400000) / 3600000));
    document.getElementById('cdMins').textContent  = pad(Math.floor((diff % 3600000)  / 60000));
    document.getElementById('cdSecs').textContent  = pad(Math.floor((diff % 60000)    / 1000));
  }
  tick();
  var timerInterval = setInterval(tick, 1000);
})();

document.addEventListener('DOMContentLoaded', function () {
  const user = CVSession.getUser();
  if (user) {
    document.getElementById('nav-login-btn').style.display     = 'none';
    document.getElementById('nav-user-dropdown').style.display = 'block';
    document.getElementById('nu-avatar').textContent = user.avatar_emoji || '\u{1F464}';
    document.getElementById('nu-name').textContent   = user.nombre || 'Usuario';
  }
  const trigger = document.getElementById('nav-user-trigger');
  const menu    = document.getElementById('nu-menu');
  if (trigger && menu) {
    trigger.addEventListener('click', function (e) {
      e.stopPropagation();
      const open = trigger.getAttribute('aria-expanded') === 'true';
      trigger.setAttribute('aria-expanded', String(!open));
      menu.classList.toggle('nu-menu--open', !open);
    });
    document.addEventListener('click', function () {
      trigger.setAttribute('aria-expanded', 'false');
      menu.classList.remove('nu-menu--open');
    });
  }
});
</script>



<style>
.nav-user-dropdown { position: relative; display: inline-block; }
.nav-user-trigger {
  display: inline-flex; align-items: center; gap: .45rem;
  background: rgba(16,176,158,.10); border: 1.5px solid rgba(16,176,158,.28);
  border-radius: 100px; padding: .38rem .85rem .38rem .55rem;
  font-family: 'DM Sans', sans-serif; font-size: .83rem; font-weight: 500;
  color: var(--teal-vivid, #0db39e); cursor: pointer;
  transition: background .2s, border-color .2s, transform .15s;
  white-space: nowrap; outline: none;
}
.nav-user-trigger:hover { background: rgba(16,176,158,.18); border-color: rgba(16,176,158,.55); transform: translateY(-1px); }
.nu-avatar  { font-size: 1rem; line-height: 1; }
.nu-name    { max-width: 110px; overflow: hidden; text-overflow: ellipsis; }
.nu-chevron { opacity: .6; transition: transform .2s; flex-shrink: 0; }
.nav-user-trigger[aria-expanded="true"] .nu-chevron { transform: rotate(180deg); }
.nu-menu {
  display: none; position: absolute; top: calc(100% + 10px); right: 0;
  min-width: 190px; background: #0f1f1e; border: 1px solid rgba(16,176,158,.22);
  border-radius: 14px; padding: .5rem; box-shadow: 0 12px 40px rgba(0,0,0,.45);
  z-index: 9999; animation: nuFadeIn .18s ease;
}
.nu-menu--open { display: block; }
@keyframes nuFadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }
.nu-item {
  display: flex; align-items: center; gap: .55rem; width: 100%;
  padding: .6rem .85rem; border-radius: 8px;
  font-family: 'DM Sans', sans-serif; font-size: .84rem; font-weight: 450;
  color: rgba(255,255,255,.78); text-decoration: none; background: none; border: none;
  cursor: pointer; transition: background .15s, color .15s; text-align: left;
}
.nu-item:hover { background: rgba(16,176,158,.12); color: #0db39e; }
.nu-item svg   { flex-shrink: 0; opacity: .7; }
.nu-logout       { color: rgba(255,100,100,.8); }
.nu-logout:hover { background: rgba(255,80,80,.1); color: #ff6464; }
.nu-divider { height: 1px; background: rgba(255,255,255,.07); margin: .35rem .5rem; }
</style>
</body>
</html>