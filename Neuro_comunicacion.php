<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Neurocomunicación Estratégica — Constructiva</title>
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
      <span style="color:rgba(255,255,255,.5)">Neurocomunicación</span>
    </div>

    <div class="workshop-num">
      <span class="workshop-num-dot"></span>
      Workshop 05 · Constructiva Experience
    </div>

    <h1>
      Neurocomunicación<br>
      <em>Estratégica</em>
    </h1>

    <p class="hero-desc">
      Al finalizar este taller tendrás en tu poder habilidades esenciales que retroceran la comunicación diaria, tomando como punto de partida el funcionamiento del cerebro humano.
    </p>

    <div class="hero-tags">
      <span class="tag">🧠 Neurociencia aplicada</span>
      <span class="tag">🎤 Presentaciones de impacto</span>
      <span class="tag">🤝 Negociación técnica</span>
      <span class="tag">👥 Liderazgo de equipos</span>
      <span class="tag">💡 Persuasión estratégica</span>
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
          src="/Videos/Neurocomunicacion.mp4"
          poster="Img/instructor-neuro-poster.jpg"
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
        <div class="price-note">Precio individual</div>
        <a href="/register.php" class="sticky-btn">Inscribirme al workshop</a>
        <a href="#curriculum" class="sticky-btn-ghost">Ver temario completo</a>
        <div class="sticky-includes">
          <div class="include-item"><span class="include-icon">🎓</span>Certificado digital y físico</div>
          <div class="include-item"><span class="include-icon">📺</span>Clases en vivo + grabaciones</div>
          <div class="include-item"><span class="include-icon">🔁</span>Acceso al material</div>
          <div class="include-item"><span class="include-icon">💬</span>Soporte directo con el instructor</div>
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
    <h2 class="s-title">Habilidades que hacen que<br>tu voz tenga autoridad</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Comunicación técnica persuasiva</strong> Explicar temas complejos de ingeniería o arquitectura sin perder rigor, pero generando confianza y comprensión inmediata en cualquier audiencia.</div>

    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Gestión emocional de conversaciones difíciles</strong>Manejar situaciones de conflicto en obra (retrasos, sobrecostos, cambios de alcance) sin activar defensividad ni perder liderazgo ante el equipo.</div>
    </div>

    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Influencia basada en neurociencia</strong>Usar principios de cómo funciona el cerebro para estructurar mensajes que muevan a la acción, desde una presentación a un cliente hasta una instrucción en campo.</div>
    </div>

  </div>
</section>

<!-- CURRICULUM -->
<section class="section section-soft" id="curriculum">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">Temario</div>
    <h2 class="s-title">Contenido del workshop</h2>
    <p class="s-sub" style="margin:0 auto;">5 semanas · +14 horas · Clases en vivo</p>
  </div>

  <div class="curriculum-wrapper">

    <div class="module open reveal">
      <div class="module-header" onclick="toggleModule(this)">
        <div class="module-left">
          <div class="module-num">S1</div>
          <div>
            <div class="module-title">Sesión 1 — La ciencia detrás de la comunicación efectiva</div>
            <div class="module-count">6 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <a href="/leccion" class="lesson-item">
            <div class="lesson-left">

              <span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span>
              <span class="lesson-name preview">Cómo decide el cerebro cuando evalúa un proyecto</span>
            </div>
            <div class="lesson-meta"><span class="preview-tag"></span><span class="lesson-dur"></span></div>
          </a>

          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cerebro emocional vs cerebro racional en decisiones técnicas</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Sesgos cognitivos frecuentes en proyectos (aversión al riesgo, efecto anclaje, status quo)</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Neurocomunicación de confianza: cómo generar credibilidad profesional en segundos</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
            </div>

            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cómo explicar lo complejo sin perder autoridad técnica</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
            </div>

            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Uso estratégico de metáforas, visualización y storytelling técnico</span></div>
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
            <div class="module-title">Sesión 2 — Presentaciones técnicas que generan decisiones</div>
            <div class="module-count">6 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Gestión neurocomunicacional del conflicto y la resistencia al cambio</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Qué ocurre en el cerebro bajo estrés y amenaza</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cómo comunicar correcciones, retrasos y sobrecostos sin activar rechazo</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Liderazgo neurocomunicacional en equipos técnicos</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Motivación cerebral en perfiles técnicos</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Comunicación clara en entornos de alta exigencia</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>
        </div>
      </div>
    </div>

       

  </div>
</section>

<!-- INSTRUCTOR -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">El instructor</div>
    <h2 class="s-title">Aprende de un experto en comunicación<br>para el sector técnico</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar">
      <img src="/Img/img/Foto Cesar Constructiva1.png" alt="Instructor Neurocomunicación"/>
    </div>
    <div>
      <div class="instructor-name">César Caldas</div>
      <div class="instructor-title">Neuroeducador | Speaker | Asesorl</div>
      <p class="instructor-bio">
        +19 años de experiencia como docente y conferencista en Cuba y Rep. Dom. Especialista en procesos de aprendizaje, desarrollo humano y formación educativa, con una destacada trayectoria impartiendo conferencias y espacios de capacitación orientados a la transformación de la enseñanza desde la neuroeducación
      </p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">500<span>+</span></div>
          <div class="i-stat-lbl">Profesionales</div>
        </div>
        <div>
          <div class="i-stat-val">19<span> años</span></div>
          <div class="i-stat-lbl">Experiencia</div>
        </div>
        <div>
          <div class="i-stat-val">★ 5.0</div>
          <div class="i-stat-lbl">Valoración</div>
        </div>
        <div>
          <div class="i-stat-val">1+<span> países</span></div>
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
        <li>Ingeniero o arquitecto que sabe mucho pero le cuesta convencer a clientes o superiores</li>
        <li>Residente o gerente de obra que necesita comunicarse mejor con su equipo en campo</li>
        <li>Profesional que pierde licitaciones frente a competidores que comunican mejor</li>
        <li>Director o socio que necesita presentar proyectos a juntas, bancos e inversionistas</li>
        <li>Cualquier profesional técnico que quiere que sus ideas sean escuchadas y ejecutadas</li>
      </ul>
    </div>
    <div class="reveal">
      <h3>📋 Lo que necesitas antes de comenzar</h3>
      <ul class="req-list">
        <li>No se requiere experiencia previa en comunicación o psicología</li>
        <li>Disposición para participar activamente en ejercicios prácticos y roleplays</li>
        <li>Cámara encendida en las sesiones — la práctica en vivo es esencial</li>
        <li>Al menos una situación real donde necesites mejorar tu comunicación (reuniones, obras, clientes)</li>
        <li>Mente abierta: este workshop cambia creencias, no solo da técnicas</li>
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
      <div class="include-box-desc">Sábados de 9AM–12PM · Práctica real con feedback inmediato</div>
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
      <div class="include-box-icon">🧠</div>
      <div class="include-box-title">Guía de neurociencia</div>
      <div class="include-box-desc">Manual de los 6 disparadores cerebrales para ingenieros</div>
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
      <div class="include-box-icon">🎤</div>
      <div class="include-box-title">Feedback personalizado</div>
      <div class="include-box-desc">Revisión individual de tu presentación final por el instructor</div>
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
        ¿Este workshop es solo para personas que hablan en público?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No. La neurocomunicación aplica a toda interacción: reuniones de obra, conversaciones con clientes, correos, negociaciones, instrucciones a cuadrillas y presentaciones. Si alguna vez necesitas que alguien entienda, decida o actúe, este workshop es para ti.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Es obligatorio tener la cámara encendida en las clases?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí, especialmente en los ejercicios prácticos. El lenguaje no verbal es una parte fundamental del workshop y el instructor necesita verte para darte feedback real. Entendemos que puede incomodar al principio, pero es exactamente eso lo que vamos a trabajar juntos.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Qué pasa si no puedo asistir a una clase en vivo?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Todas las sesiones son grabadas en HD y quedan disponibles dentro de las 24 horas siguientes. Tienes acceso a las grabaciones. Sin embargo, recomendamos asistir en vivo, especialmente en las semanas de práctica y roleplay.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Las técnicas que enseñan son manipulación?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No. La neurocomunicación se basa en comunicar de forma que el cerebro de tu audiencia pueda procesar mejor tu mensaje. No se trata de engañar sino de eliminar las barreras que impiden que tu idea llegue con claridad. La ética es un principio fundamental en todo lo que enseñamos.</p></div>
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
    <div style="font-size:2.5rem;margin-bottom:1rem">🧠</div>
    <h2>¿Listo para que tus ideas<br>muevan a las personas?</h2>
    <p>Únete al workshop de Neurocomunicación Estratégica y aprende a presentar, negociar y liderar usando la ciencia del cerebro. Cupos limitados.</p>
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
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    CVSession.injectNav({
      type: 'course',
      ctaLabel: 'Inscribirme',
      ctaHref:  '#inscribirse',
    });
  });
</script>
<script src="/Js/video-player.js" defer></script>
</body>
</html>