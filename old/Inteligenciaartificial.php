<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inteligencia Artificial: Aumenta tu productividad — Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="Css/revit.css">
  <link rel="stylesheet" href="Css/video-player.css">
  <link rel="stylesheet" href="Css/responsive.css">
  <script src="Js/cv-session.js"></script>
</head>
<body>

<!-- Progress bar -->
<div class="progress-top" id="progressBar"></div>

<!-- Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAV -->
<nav>
  <a href="/"><img src="Img/Logo aqua.png" alt="" width="150" height="auto"></a>
  <span>Ahorra 20% al inscribirte en el programa completo</span>
  <a href="#inscribirse" class="nav-cta-small">Inscribirme</a>
</nav>

<!-- HERO -->
<section class="course-hero">
  <div class="hero-left">
    <div class="breadcrumb">
      <a href="/">Inicio</a>
      <span>/</span>
      <a href="#">Workshops</a>
      <span>/</span>
      <span style="color:rgba(255,255,255,.5)">Inteligencia Artificial</span>
    </div>

    <div class="workshop-num">
      <span class="workshop-num-dot"></span>
      Workshop 03 · Constructiva Experience
    </div>

    <h1>
      Aumenta tu<br>
      productividad<br>
      con <em>IA</em>
    </h1>

    <p class="hero-desc">
      Usa la IA para automatizar tareas diarias en construcción: menos tiempo, más productividad y rentabilidad. Diagnostica tu punto de partida, domina prompts efectivos y aplica herramientas clave.
    </p>

    <div class="hero-tags">
      <span class="tag">🤖 ChatGPT & Claude</span>
      <span class="tag">🏗️ IA para construcción</span>
      <span class="tag">📄 Generación de documentos</span>
      <span class="tag">🖼️ IA generativa</span>
      <span class="tag">⚡ Automatización</span>
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
      <a href="#inscribirse" class="btn-enroll">
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
          src="Videos/Inteligenciaartificial.mp4"
          poster="Img/instructor-ia-poster.jpg"
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
        <a href="#inscribirse" class="sticky-btn">Inscribirme al workshop</a>
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
    <h2 class="s-title">Habilidades que multiplican<br>tu capacidad de trabajo</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Prompting efectivo para el sector construcción</strong>Saber comunicarte con herramientas de IA para obtener resultados útiles y específicos, desde reportes de obra hasta revisión de documentos técnicos.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Automatización de tareas repetitivas</strong>Identificar qué procesos de tu día a día (presupuestos, informes, revisiones) pueden delegarse a herramientas inteligentes para liberar tiempo de alto valor.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Criterio para adoptar tecnología</strong>Saber evaluar qué herramientas de IA realmente aportan a tu flujo de trabajo y cuáles son ruido, construyendo un plan de implementación realista para tu contexto.</div>
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
            <div class="module-title">Sesión 1 — El mundo de la IA aplicada a la construcción</div>
            <div class="module-count">7 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          
            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">¿Qué es la IA y qué NO es?</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
        
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Diagnóstico de estado actual en Inteligencia Artificial</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Prompting: el lenguaje para comunicarte con la IA</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Inteligencia Artificial aplicada a la construcción</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Mapa de herramientas: cuáles existen y para qué sirve cada una</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">DEMO 1: Convierte cualquier reunión o conversación en un reporte profesiona</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">DEMO 2: La arquitectura cambió y la generación de renders también</span></div>
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
            <div class="module-title">Sesión 2 — Generación de documentos técnicos con IA</div>
            <div class="module-count">5 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">DEMO 3: Automatización y skills para creación de presupuestos, informes o reportes</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">DEMO 4: Revisión de planos basado en normativas con IA</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Caso Práctico en vivo</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Introducción a agentes de inteligencia artificial</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="Img/+.png" alt="" width="15px"></span><span class="lesson-name">Plan de implementación de IA aplicada a tu negocio o proyecto</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- INSTRUCTOR -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">El instructor</div>
    <h2 class="s-title">Aprende de un experto en IA<br>aplicada a la construcción</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar">
      <img src="Img/img/Foto Irvin Constructiva (2).png" alt="Instructor Inteligencia Artificial"/>
    </div>
    <div>
      <div class="instructor-name">Irvin Rosario</div>
      <div class="instructor-title">CEO y Founder Constructiva | Ingeniero Civil</div>
      <p class="instructor-bio">
        MBA en empresas de ingeniería y construcción. Apasionado por la transformación digital en la industria, inteligencia artificial y la planificación estratégica.
      </p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">300<span>+</span></div>
          <div class="i-stat-lbl">Profesionales</div>
        </div>
        <div>
          <div class="i-stat-val">8<span> años</span></div>
          <div class="i-stat-lbl">Experiencia</div>
        </div>
        <div>
          <div class="i-stat-val">★ 5.0</div>
          <div class="i-stat-lbl">Valoración</div>
        </div>
        <div>
          <div class="i-stat-val">15<span>+</span></div>
          <div class="i-stat-lbl">Herramientas IA</div>
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
        <li>Ingeniero o arquitecto que siente que pierde horas en tareas repetitivas</li>
        <li>Profesional independiente que quiere producir más sin contratar más personal</li>
        <li>Gerente o director que necesita documentación técnica de calidad más rápido</li>
        <li>Estudiante que quiere diferenciarse con habilidades del futuro desde ya</li>
        <li>Cualquier profesional curioso que quiere entender cómo la IA puede trabajar para él</li>
      </ul>
    </div>
    <div class="reveal">
      <h3>📋 Lo que necesitas antes de comenzar</h3>
      <ul class="req-list">
        <li>Computadora o laptop con acceso a internet (Windows o Mac)</li>
        <li>Cuenta gratuita en ChatGPT — te guiamos en la primera clase</li>
        <li>No se requiere experiencia previa en IA ni programación</li>
        <li>Conocimientos básicos de tu área (ingeniería, arquitectura o construcción)</li>
        <li>Disposición para experimentar y adoptar nuevas formas de trabajar</li>
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
      <div class="include-box-icon">🤖</div>
      <div class="include-box-title">Biblioteca de prompts</div>
      <div class="include-box-desc">+50 prompts listos para ingeniería y arquitectura</div>
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
      <div class="include-box-icon">⚡</div>
      <div class="include-box-title">Flujos de trabajo</div>
      <div class="include-box-desc">Plantillas de automatización listas para usar en tu empresa</div>
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
        ¿Necesito saber programar para tomar este workshop?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No. Todo el workshop está diseñado para profesionales de la construcción sin conocimientos de programación. Usaremos herramientas con interfaces visuales e intuitivas que cualquier ingeniero o arquitecto puede manejar desde el primer día.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Las herramientas de IA que usarán son gratuitas?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>La mayoría tienen versiones gratuitas más que suficientes para el workshop. ChatGPT, Claude y otras herramientas ofrecen planes gratis con los que puedes hacer todo lo que enseñamos. Para las herramientas de imagen como Midjourney, mostramos alternativas gratuitas.</p></div>
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
        ¿Los prompts y plantillas que entregan funcionan en español?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí, todos los prompts, flujos y plantillas están desarrollados en español y adaptados al contexto dominicano. Incluyendo terminología técnica local, normativas MOPC y formatos de documentos que se usan en el país.</p></div>
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
    <div style="font-size:2.5rem;margin-bottom:1rem">🤖</div>
    <h2>¿Listo para trabajar<br>con IA a tu lado?</h2>
    <p>Únete al workshop de Inteligencia Artificial y aprende a multiplicar tu productividad con las herramientas más poderosas del momento, aplicadas a la ingeniería y arquitectura. Cupos limitados.</p>
    <div class="bottom-cta-actions">
      <a href="#" class="btn-enroll">
        Inscribirme ahora
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#" class="btn-outline-white" style="border-color:rgba(255,255,255,.25)">
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

  // Load video
  // Load video — eliminado, reemplazado por video-player.js
</script>

<script src="Js/video-player.js" defer></script>

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