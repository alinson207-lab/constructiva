<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ms Project: El poder del cronograma de obra — Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="/Css/revit.css">
  <link rel="stylesheet" href="/Css/video-player.css">
  <link rel="stylesheet" href="/Css/responsive.css">
  <script src="/Js/cv-session.js"></script>
</head>
<body>

<!-- Progress bar -->
<div class="progress-top" id="progressBar"></div>

<!-- Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAV -->
<nav>
  <a href="/"><img src="/Img/Logo aqua.png" alt="" width="150" height="auto"></a>
  <span>Ahorra 20% al inscribirte en el programa completo</span>
  <a href="/register.php" class="nav-cta-small">Inscribirme</a>
</nav>

<!-- HERO -->
<section class="course-hero">
  <div class="hero-left">
    <div class="breadcrumb">
      <a href="/">Inicio</a>
      <span>/</span>
      <a href="Programa-completo.php">Workshops</a>
      <span>/</span>
      <span style="color:rgba(255,255,255,.5)">Ms Project</span>
    </div>

    <div class="workshop-num">
      <span class="workshop-num-dot"></span>
      Workshop 02 · Constructiva Experience
    </div>

    <h1>
      El poder del<br>
      cronograma<br>
      <em>de obra</em>
    </h1>

    <p class="hero-desc">
     Al finalizar este taller serás capaz de comprender la lógica de un cronograma de obra, construir un cronograma básico, interpretar la ruta crítica y las restricciones de recursos para el proyecto.
    </p>

    <div class="hero-tags">
      <span class="tag">📅 Planificación de obra</span>
      <span class="tag">🏗️ Gestión de proyectos</span>
      <span class="tag">💻 Microsoft Project</span>
      <span class="tag">📊 Diagrama de Gantt</span>
      <span class="tag">⏱️ Control de tiempos</span>
    </div>

    <div class="hero-meta-row">
      <div class="meta-item">
        <div class="meta-val">+14<span>h</span></div>
        <div class="meta-lbl">Horas prácticas</div>
      </div>
      <div class="meta-item">
        <div class="meta-val">5<span> sem</span></div>
        <div class="meta-lbl">Duración</div>
      </div>
      <div class="meta-item">
        <div class="meta-val">Online</div>
        <div class="meta-lbl">En vivo</div>
      </div>
      <div class="meta-item">
        <div class="meta-val" style="color:#f5c842">★ 5.0</div>
        <div class="meta-lbl">Valoración</div>
      </div>
    </div>

    <div class="hero-actions">
      <a href="/register.php" class="btn-enroll">
        Inscribirme ahora
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#curriculum" class="btn-outline-white">
        Ver temario
      </a>
    </div>

    <div class="discount-banner">
      🏷️ Descuento Fundador disponible — Cupos limitados
    </div>
  </div>

  <!-- STICKY RIGHT CARD -->
  <div class="hero-right">
    <div class="sticky-card">
      <div class="sticky-video" id="videoContainer" data-player>
        <video
          class="card-video"
          src="/Videos/Project.mp4"
          poster="Img/instructor-msproject-poster.jpg"
          autoplay
          muted
          loop
          playsinline
          style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block;"
        ></video>

        <div class="card-controls-bar">
          <button class="ctrl-btn playing" data-play title="Pausar">
            <svg class="icon-play" width="16" height="16" viewBox="0 0 24 24" fill="white">
              <polygon points="5,3 19,12 5,21"/>
            </svg>
            <svg class="icon-pause" width="16" height="16" viewBox="0 0 24 24" fill="white">
              <rect x="5" y="3" width="4" height="18" rx="1"/>
              <rect x="15" y="3" width="4" height="18" rx="1"/>
            </svg>
          </button>

          <div class="card-progress-bar" data-progress-bar>
            <div class="card-progress-fill" data-progress-fill></div>
          </div>

          <span class="ctrl-time" data-time>0:00</span>

          <button class="ctrl-btn" data-sound title="Activar sonido">
            <svg class="icon-muted" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round">
              <polygon points="11,5 6,9 2,9 2,15 6,15 11,19" fill="white" stroke="none"/>
              <line x1="22" y1="9" x2="16" y2="15"/>
              <line x1="16" y1="9" x2="22" y2="15"/>
            </svg>
            <svg class="icon-sound" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round">
              <polygon points="11,5 6,9 2,9 2,15 6,15 11,19" fill="white" stroke="none"/>
              <path d="M15.54 8.46a5 5 0 0 1 0 7.07"/>
            </svg>
          </button>
        </div>
      </div>
      <div class="sticky-body">
        <div class="price-row">
          <span class="price-main">$33</span>
          <span class="price-original">$40</span>
          <span class="price-badge">20% OFF</span>
        </div>
        <div class="price-note">⏰ Precio Individual</div>
        <a href="/register.php" class="sticky-btn">Inscribirme al workshop</a>
        <a href="#curriculum" class="sticky-btn-ghost">Ver temario completo</a>
        <div class="sticky-includes">
          <div class="include-item"><span class="include-icon">🎓</span>Certificado digital y físico</div>
          <div class="include-item"><span class="include-icon">📺</span>Clases en vivo + grabaciones</div>
          <div class="include-item"><span class="include-icon">🔁</span>Acceso al material</div>
          <div class="include-item"><span class="include-icon">💬</span>Soporte directo con el instructor</div>
          <div class="include-item"><span class="include-icon">🎁</span>Bonus: Inglés Profesional 1 on 1</div>
          <div class="include-item"><span class="include-icon">📁</span>Recursos y archivos del proyecto</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT YOU'LL LEARN -->
<section class="section section-white" id="aprender">
  <div class="reveal">
    <div class="section-label">Lo que aprenderás</div>
    <h2 class="s-title">Habilidades que transforman<br>tu gestión de proyectos</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Pensamiento secuencial de obra</strong>Capacidad de descomponer un proyecto en actividades ordenadas lógicamente, asignando tiempos y dependencias que reflejen cómo se construye en la realidad.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Lectura estratégica de la ruta crítica</strong>Saber identificar qué actividades no pueden retrasarse sin afectar la entrega, y usar esa información para tomar decisiones antes de que los problemas escalen.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Gestión visual del plazo</strong>Traducir un cronograma digital en una herramienta de comunicación con el equipo, el cliente y los subcontratistas, convirtiendo datos en claridad operativa.</div>
    </div>
      </div>
</section>

<!-- CURRICULUM -->
<section class="section section-soft" id="curriculum">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">Temario</div>
    <h2 class="s-title">Contenido del workshop</h2>
    <p class="s-sub" style="margin:0 auto;">5 semanas · +14 horas · Clases en vivo todos los sábados de 9AM a 12PM</p>
  </div>

  <div class="curriculum-wrapper">

    <div class="module open reveal">
      <div class="module-header" onclick="toggleModule(this)">
        <div class="module-left">
          <div class="module-num">S1</div>
          <div>
            <div class="module-title">Sesión 1 — Fundamentos de planificación y Ms Project</div>
            <div class="module-count">6 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
           <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">¿Qué es realmente un cronograma de obra?</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
      
            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Relación entre actividades, tiempo y recursos</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Conociendo Ms Project</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Interfaz y funciones principales que se usan en obra</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Práctica básica en vivo</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

        <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Creación del proyecto. Configuración de calendarios. Actividades y dependencias. Ruta Crítica.</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

        </div>
      </div>
    </div>

    <div class="module reveal">
      <div class="module-header" onclick="toggleModule(this)">
        <div class="module-left">
          <div class="module-num">S2</div>
          <div>
            <div class="module-title">Sesión 2 — Actividades, dependencias y ruta crítica</div>
            <div class="module-count">5 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Estructuración del proyecto por fases. WBS y procesos</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Construcción del cronograma paso a paso</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Asignación de duraciones</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Secuencia lógica de trabajos</span></div>
          <div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Identificación de actividades críticas</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Introducción a recursos y nivelación básica</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Impacto en el plazo del proyecto</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Interpretación del cronograma para toma de decisiones</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          
        </div>
      </div>
    </div>

    

  </div>
</section>

<!-- INSTRUCTOR -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">El instructor</div>
    <h2 class="s-title">Aprende de un experto<br>con proyectos reales en obra</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar">
      <img src="/Img/img/Foto Nathalie Constructiva.png" alt="Instructor Ms Project"/>
    </div>
    <div>
      <div class="instructor-name">Nathalie Viñas</div>
      <div class="instructor-title">Ingeniera Civil | Planificación de Proyectos | Presupuestos de obras</div>
      <p class="instructor-bio">
        +5 años de experiencia en construcción de torres residenciales, encargada del depto. de presupuestos y planificación en Constructora Colón y Genao. Máster en Dirección y Gestión de Proyectos por la universidad de Nebrija.
      </p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">30<span>+</span></div>
          <div class="i-stat-lbl">Proyectos</div>
        </div>
        <div>
          <div class="i-stat-val">400<span>+</span></div>
          <div class="i-stat-lbl">Estudiantes</div>
        </div>
        <div>
          <div class="i-stat-val">★ 5.0</div>
          <div class="i-stat-lbl">Valoración</div>
        </div>
        <div>
          <div class="i-stat-val">PMP<span> ®</span></div>
          <div class="i-stat-lbl">Certificación</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- REQUIREMENTS 
<section class="section section-soft">
  <div class="reveal">
    <div class="section-label">Requisitos & Audiencia</div>
    <h2 class="s-title">¿Este workshop es para ti?</h2>
  </div>

  <div class="req-grid">
    <div class="reveal">
      <h3>✅ Este workshop es para ti si eres...</h3>
      <ul class="req-list">
        <li>Residente de obra o coordinador de proyectos de construcción</li>
        <li>Ingeniero o arquitecto que quiere dejar de hacer cronogramas en Excel</li>
        <li>Gerente de proyectos que necesita control real sobre sus obras</li>
        <li>Profesional independiente que quiere diferenciarse con herramientas PMI</li>
        <li>Estudiante de ingeniería o arquitectura que quiere entrar al mercado con ventaja</li>
      </ul>
    </div>
    <div class="reveal">
      <h3>📋 Lo que necesitas antes de comenzar</h3>
      <ul class="req-list">
        <li>Conocimiento básico de fases de construcción (cimentación, estructura, acabados)</li>
        <li>Computadora con Windows y Microsoft Project instalado (versión de prueba disponible)</li>
        <li>Conexión a internet para las clases en vivo</li>
        <li>Manejo básico de Excel (deseable, no excluyente)</li>
        <li>Ganas de eliminar el desorden en tus obras para siempre</li>
      </ul>
    </div>
  </div>
</section>-->

<!-- INCLUDES -->
<section class="section section-dark">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto;">
    <div class="section-label">¿Qué incluye?</div>
    <h2 class="s-title">Todo lo que obtienes<br>al inscribirte</h2>
  </div>

  <div class="includes-grid">
    <div class="include-box reveal">
      <div class="include-box-icon">📺</div>
      <div class="include-box-title">Clases en vivo</div>
      <div class="include-box-desc">Sábados de 9AM–12PM · Interacción directa con el instructor</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">🎬</div>
      <div class="include-box-title">Grabaciones HD</div>
      <div class="include-box-desc">Acceso a todas las grabaciones de las sesiones</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">🏆</div>
      <div class="include-box-title">Certificado</div>
      <div class="include-box-desc">Certificado digital y físico al completar el programa</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">📁</div>
      <div class="include-box-title">Archivos del proyecto</div>
      <div class="include-box-desc">Plantillas de Ms Project listas para usar en tus obras</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">💬</div>
      <div class="include-box-title">Soporte directo</div>
      <div class="include-box-desc">Acceso al instructor por WhatsApp durante el programa</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">👥</div>
      <div class="include-box-title">Comunidad</div>
      <div class="include-box-desc">Grupo privado con todos los participantes del programa</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">📊</div>
      <div class="include-box-title">Plantillas premium</div>
      <div class="include-box-desc">Cronogramas tipo para vivienda, edificios y urbanizaciones</div>
    </div>
    <div class="include-box reveal" style="border-style:dashed; border-color:rgba(245,200,66,.3)">
      <div class="include-box-icon">🎁</div>
      <div class="include-box-title" style="color:#f5c842">Bonus Exclusivo</div>
      <div class="include-box-desc">Sesión 1 on 1 de Inglés Profesional para ingenieros</div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section section-soft">
  <div class="reveal" style="text-align:center; max-width:580px; margin:0 auto;">
    <div class="section-label">Preguntas frecuentes</div>
    <h2 class="s-title">Todo lo que necesitas saber</h2>
  </div>

  <div class="faq-list">
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Qué versión de Microsoft Project se usa en el workshop?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Usamos Microsoft Project 2019 y 2021. Si no tienes licencia, te guiamos paso a paso para activar la versión de prueba gratuita de 30 días de Microsoft durante el workshop.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Necesito saber gestión de proyectos antes de entrar?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No. El workshop empieza desde los fundamentos de planificación de obras. Lo único útil es tener nociones básicas de cómo funciona una obra de construcción, lo cual la mayoría de ingenieros y arquitectos ya tienen.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Qué pasa si no puedo asistir a una clase en vivo?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Todas las sesiones son grabadas en HD y quedan disponibles dentro de las 24 horas siguientes. Tienes acceso a las grabaciones para verlas cuando quieras.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Las plantillas que entreguen sirven para proyectos reales?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí, todas las plantillas están diseñadas con casos reales del mercado dominicano: viviendas unifamiliares, edificios multifamiliares y proyectos de urbanización. Puedes adaptarlas directamente a tu próxima obra.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Tienen descuento estudiantil?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí. Hay un descuento especial para estudiantes universitarios con carnet vigente. Escríbenos por WhatsApp antes de inscribirte para aplicarlo.</p></div>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section class="bottom-cta" id="inscribirse">
  <div class="bottom-cta-content reveal">
    <div style="font-size:2.5rem;margin-bottom:1rem">📅</div>
    <h2>¿Listo para tomar el control<br>de tus obras?</h2>
    <p>Únete al workshop de Ms Project y aprende a planificar, controlar y entregar proyectos a tiempo con cronogramas profesionales. Cupos limitados.</p>
    <div class="bottom-cta-actions">
      <a href="/register.php" class="btn-enroll">
        Inscribirme ahora
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="https://wa.me/18294910540" class="btn-outline-white" style="border-color:rgba(255,255,255,.25)">
        💬 Consultar por WhatsApp
      </a>
    </div>
    <div class="bottom-note">🏷️ Descuento Fundador activo · 23 MAR – 22 ABR · Certificado digital y físico incluido</div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <a href="/" class="footer-logo-sm">constructiva<span>.</span></a>
  <span class="footer-note">© 2024 Constructiva · constructiva.edu.do · Todos los derechos reservados</span>
  <span class="footer-note" style="color:var(--mint)">Construye tu futuro, hoy.</span>
</footer>

<script>
  // Cursor
  const cursor = document.getElementById('cursor');
  const ring   = document.getElementById('cursorRing');
  let mx=0, my=0, rx=0, ry=0;
  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    cursor.style.transform = `translate(${mx-5}px,${my-5}px)`;
  });
  (function animRing(){
    rx += (mx-rx-16)*.1; ry += (my-ry-16)*.1;
    ring.style.transform = `translate(${rx}px,${ry}px)`;
    requestAnimationFrame(animRing);
  })();
  document.querySelectorAll('a,button').forEach(el => {
    el.addEventListener('mouseenter', ()=>{ ring.style.transform += ' scale(1.6)'; ring.style.opacity='.8'; });
    el.addEventListener('mouseleave', ()=>{ ring.style.opacity='.4'; });
  });

  // Progress bar
  const bar = document.getElementById('progressBar');
  window.addEventListener('scroll', ()=>{
    const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100;
    bar.style.width = pct + '%';
  });

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const obs = new IntersectionObserver(entries => {
    entries.forEach((e,i) => {
      if(e.isIntersecting){
        e.target.style.transitionDelay = (i%4)*.07+'s';
        e.target.classList.add('visible');
        obs.unobserve(e.target);
      }
    });
  }, {threshold:.1});
  reveals.forEach(r => obs.observe(r));

  // Toggle module
  function toggleModule(btn){
    const mod = btn.closest('.module');
    const isOpen = mod.classList.contains('open');
    document.querySelectorAll('.module.open').forEach(m => m.classList.remove('open'));
    if(!isOpen) mod.classList.add('open');
  }

  // Toggle FAQ
  function toggleFaq(btn){
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(f => f.classList.remove('open'));
    if(!isOpen) item.classList.add('open');
  }

  // Load video — eliminado, reemplazado por video-player.js
</script>

<script src="/Js/video-player.js" defer></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    CVSession.injectNav({
      type: 'course',
      ctaLabel: 'Inscribirme',
      ctaHref:  '#inscribirse',
    });
  });
</script>
</body>
</html>