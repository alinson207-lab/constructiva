<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Marca Personal: Para ingenieros y arquitectos — Constructiva</title>
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
      <a href="#">Workshops</a>
      <span>/</span>
      <span style="color:rgba(255,255,255,.5)">Marca Personal</span>
    </div>

    <div class="workshop-num">
      <span class="workshop-num-dot"></span>
      Workshop 04 · Constructiva Experience
    </div>

    <h1>
      Construye tu<br>
      <em>Marca Personal</em><br>
      como profesional
    </h1>

    <p class="hero-desc">
      Desarrollarás tu marca personal para destacar en la industria: crea un perfil único que comunique tu propuesta de valor profesional. Define tu nicho, haz networking estratégico y genera oportunidades.
    </p>

    <div class="hero-tags">
      <span class="tag">🏆 Posicionamiento profesional</span>
      <span class="tag">📱 LinkedIn & Redes sociales</span>
      <span class="tag">✍️ Contenido técnico</span>
      <span class="tag">🎯 Atracción de clientes</span>
      <span class="tag">🌐 Presencia digital</span>
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
          src="/Videos/Marcapersonal.mp4"
          poster="Img/instructor-marca-poster.jpg"
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
        <div class="price-note">⏰ Precio Fundador · Termina en 5 días</div>
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
    <h2 class="s-title">Habilidades que posicionan<br>tu nombre en el mercado</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Posicionamiento profesional diferenciado</strong>Definir con claridad qué te hace único en la industria y comunicarlo de forma que atraiga las oportunidades correctas sin parecer genérico.</div>
    </div>
    
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Perfil profesional que trabaja por ti</strong>- Construir una identidad digital (LinkedIn, bio, propuesta de valor) que comunique tu expertise sin necesidad de estar vendiéndote activamente.
- Networking con intención: Construir relaciones</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Networking con intención</strong>Construir relaciones profesionales de forma deliberada, usando tu perfil y tu mensaje como herramientas que generan oportunidades incluso cuando no estás presente.</div>
    </div>
    
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
            <div class="module-title">Sesión 1 — Identidad y propuesta de valor profesional</div>
            <div class="module-count">7 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cimientos: Quién eres y a quién le hablas</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
            
          
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Por qué la visibilidad importa más que el talento en la industria</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Los 3 mitos que frenan a los profesionales técnicos</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Tu identidad profesional: el Triángulo de Posicionamiento</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">La propuesta de valor profesional</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Los 5 elementos de un perfil profesional que trabaja por ti</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Diagnóstico en vivo de perfiles profesionales</span></div>
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
            <div class="module-title">Sesión 2 — LinkedIn y presencia digital estratégica</div>
            <div class="module-count">7 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Revisión y feedback grupal de perfiles optimizados</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Pilares de contenido: cómo elegir los temas que te posicionan como referente</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">La diferencia entre hablar de todo y posicionarte en algo</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">4 formatos de mensaje que funcionan para profesionales técnicos</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cómo convertir una experiencia real de proyecto en un mensaje que posiciona</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div>
                </div>
             <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Dónde posicionar tu marca: canales clave para profesionales de la construcción</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div>
                </div>
                <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Plan de implementación para posicionamiento de 4 semanas</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div>
                </div>   
        </div>
      </div>
    </div>

    

  </div>
</section>

<!-- INSTRUCTOR -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">El instructor</div>
    <h2 class="s-title">Aprende de quien ya construyó<br>una marca referente en RD</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar">
      <img src="/Img/img/Foto Genesis Constructiva.png" alt="Instructor Marca Personal"/>
    </div>
    <div>
      <div class="instructor-name">Genesis de la Cruz</div>
      <div class="instructor-title">Co-CEO Quanto | Ingeniera Civil | Experta en Innovación Corporativa</div>
      <p class="instructor-bio">
        Founder de Construccion099, la comunidad #1 de construcción en Rep. Dom. Master en Gestión y Auditoría de Calidad. Apasionada por la gestión de productividad en ejecución de obras.
      </p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">4.2K<span>+</span></div>
          <div class="i-stat-lbl">Seguidores</div>
        </div>
        <div>
          <div class="i-stat-val">100<span>+</span></div>
          <div class="i-stat-lbl">Estudiantes</div>
        </div>
        <div>
          <div class="i-stat-val">★ 5.0</div>
          <div class="i-stat-lbl">Valoración</div>
        </div>
        <div>
          <div class="i-stat-val">5<span> + años</span></div>
          <div class="i-stat-lbl">Trayectoria</div>
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
        <li>Ingeniero o arquitecto que siente que su trabajo no es reconocido como merece</li>
        <li>Profesional independiente que consigue clientes solo por referidos y quiere cambiar eso</li>
        <li>Recién graduado que quiere entrar al mercado con visibilidad y diferenciación</li>
        <li>Empleado que quiere posicionarse para mejores oportunidades laborales o ascensos</li>
        <li>Cualquier profesional técnico que quiere dejar de competir únicamente por precio</li>
      </ul>
    </div>
    <div class="reveal">
      <h3>📋 Lo que necesitas antes de comenzar</h3>
      <ul class="req-list">
        <li>Cuenta en LinkedIn (gratuita es suficiente — te ayudamos a crearla si no tienes)</li>
        <li>Smartphone con cámara para crear contenido visual de tus proyectos</li>
        <li>Al menos 1 proyecto del que puedas hablar (puede ser académico o profesional)</li>
        <li>Disposición para mostrarte como profesional en redes — el mayor reto es la mentalidad</li>
        <li>No se requiere experiencia en redes sociales ni diseño gráfico</li>
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
      <div class="include-box-desc"></div>
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
      <div class="include-box-icon">✍️</div>
      <div class="include-box-title">Plantillas de contenido</div>
      <div class="include-box-desc">30 plantillas de posts para LinkedIn, Instagram y YouTube</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">💬</div>
      <div class="include-box-title">Soporte directo</div>
      <div class="include-box-desc">Acceso a la instructora por WhatsApp durante el programa</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">👥</div>
      <div class="include-box-title">Comunidad</div>
      <div class="include-box-desc">Grupo privado con todos los participantes del programa</div>
    </div>
    <div class="include-box reveal">
      <div class="include-box-icon">🌐</div>
      <div class="include-box-title">Portafolio publicado</div>
      <div class="include-box-desc">Tu portafolio digital en línea al finalizar el workshop</div>
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
        ¿Este workshop sirve si soy muy privado y no me gusta mostrarme en redes?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Es el perfil más común entre nuestros estudiantes. El workshop te enseña a compartir tu trabajo de forma profesional y estratégica, sin necesidad de exponer tu vida personal. Hablaremos de proyectos, no de selfies. Muchos ingenieros reservados han construido marcas poderosas siendo auténticos con su estilo.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Necesito muchos seguidores para que esto funcione?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No. La marca personal no se trata de seguidores, se trata de las personas correctas. Muchos de nuestros egresados consiguieron proyectos nuevos con menos de 500 conexiones en LinkedIn porque se dirigían al cliente correcto con el mensaje correcto.</p></div>
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
        ¿El portafolio que crearemos tiene costo mensual?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Usamos herramientas con planes gratuitos permanentes como Notion, Canva o Behance. También enseñamos opciones de pago si quieres un dominio propio, pero no es obligatorio para tener un portafolio profesional funcional.</p></div>
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
    <div style="font-size:2.5rem;margin-bottom:1rem">🏆</div>
    <h2>¿Listo para que el mercado<br>te conozca como mereces?</h2>
    <p>Únete al workshop de Marca Personal y construye la presencia digital que atrae los proyectos y clientes que siempre quisiste. Cupos limitados.</p>
    <div class="bottom-cta-actions">
      <a href="/register.php" class="btn-enroll">
        Inscribirme ahora — $20
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
  <span class="footer-note" style="color:var(--mint)">LEAD. APPLY. LEAD.</span>
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