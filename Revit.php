<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BIM-Revit: Evita demoliciones en obra — Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
 <link rel="stylesheet" href="/Css/revit.css">
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
      <span style="color:rgba(255,255,255,.5)">BIM-Revit</span>
    </div>

    <div class="workshop-num">
      <span class="workshop-num-dot"></span>
      Workshop 01 · Constructiva Experience
    </div>

    <h1>
      Evita demoliciones<br>
      en obra con<br>
      <em>BIM-Revit</em>
    </h1>

    <p class="hero-desc">
      Aprenderás el potencial que tiene la metodología BIM en proyectos de construcción, mejorando la colaboración entre todos los interesados, y mejorando la eficiencia de todos los procesos durante el ciclo de vida del proyecto.
    </p>

    <div class="hero-tags">
      <span class="tag">🏗️ Ingeniería Civil</span>
      <span class="tag">🏛️ Arquitectura</span>
      <span class="tag">💻 Autodesk Revit</span>
      <span class="tag">🔍 Detección de interferencias</span>
      <span class="tag">📐 Modelado 3D</span>
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
      <div class="sticky-video" id="videoContainer">
        <video
          class="card-video"
          src="/Videos/Revit.mp4"
          poster="Img/instructor-poster.jpg"
          autoplay
          muted
          loop
          playsinline
          id="stickyVideo"
          style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block;"
        ></video>

       <div class="card-controls-bar">
  <button class="ctrl-btn playing" id="stickyPlayBtn" title="Pausar">
    <svg class="icon-play" width="16" height="16" viewBox="0 0 24 24" fill="white">
      <polygon points="5,3 19,12 5,21"/>
    </svg>
    <svg class="icon-pause" width="16" height="16" viewBox="0 0 24 24" fill="white">
      <rect x="5" y="3" width="4" height="18" rx="1"/>
      <rect x="15" y="3" width="4" height="18" rx="1"/>
    </svg>
  </button>

  <div class="card-progress-bar" id="stickyProgress">
    <div class="card-progress-fill" id="stickyProgressFill"></div>
  </div>

  <span class="ctrl-time" id="stickyTime">0:00</span>

  <button class="ctrl-btn" id="stickySoundBtn" title="Activar sonido">
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
          <div class="include-item"><span class="include-icon">🎁</span>Bonus: Inglés Profesional 1 on 1</div>
          <div class="include-item"><span class="include-icon">📁</span>Recursos y archivos del proyecto</div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>

<!-- WHAT YOU'LL LEARN -->
<section class="section section-white" id="aprender">
  <div class="reveal">
    <div class="section-label">Lo que aprenderás</div>
    <h2 class="s-title">Habilidades que transforman<br>tu forma de trabajar</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Visión de proyecto en 3D antes de construir</strong>Capacidad de anticipar interferencias, errores y conflictos entre disciplinas usando un modelo digital como simulador de la obra real.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Diagnóstico de pérdidas evitables en obra</strong>Reconocer en tus propios proyectos dónde se están generando demoliciones, retrabajo y sobrecostos por falta de coordinación digital, y entender cómo BIM los previene.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Mentalidad BIM aplicada</strong>Entender que BIM no es solo un software, sino una forma de trabajar colaborativamente que mejora la rentabilidad y reduce el retrabajo en cada fase del proyecto.</div>
       
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
            <div class="module-title">Sesión 1 — Fundamentos BIM y configuración</div>
            <div class="module-count">7 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          
  <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Fundamentos de la metodología BIM</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>

            <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">ISO 19650 y como se implementa</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Roles BIM en proyectos de construcción</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">¿Por qué Autodesk Revit?</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Interfaz y funcionalidades de Revit</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Usos prácticos de Revit en proyectos BIM</span></div>
            <div class="lesson-meta"><span class="lesson-dur"></span></div>
          </div>
          <div class="lesson-item">
            <div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Visualización de un modelo BIM real</span></div>
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
            <div class="module-title">Sesión 2 — Modelado estructural y MEP</div>
            <div class="module-count">7 lecciones</div>
          </div>
        </div>
        <span class="module-arrow">▾</span>
      </div>
      <div class="module-body">
        <div class="lesson-list">
          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Ciclo de vida de un proyecto BIM</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Caso de estudio: cómo evitar errores cometidos en obra</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Obra vs Modelo, construye desde el modelo digital</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Cómo BIM aumenta la rentabilidad de los proyectos</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Tablas de cuantificación en Revit</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Ecosistema BIM más allá de Revit</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>

          <div class="lesson-item"><div class="lesson-left"><span class="lesson-icon"><img src="/Img/+.png" alt="" width="15px"></span><span class="lesson-name">Plan de implementación BIM básico</span></div><div class="lesson-meta"><span class="lesson-dur"></span></div></div>



          
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
        <li>Ingeniero civil o arquitecto que trabaja en proyectos de construcción</li>
        <li>Coordinador de obra que quiere eliminar errores costosos</li>
        <li>Profesional independiente que quiere diferenciarse con BIM</li>
        <li>Recién graduado que quiere habilidades de alto valor en el mercado</li>
        <li>Gerente de proyectos que necesita mejores herramientas de control</li>
      </ul>
    </div>
    <div class="reveal">
      <h3>📋 Lo que necesitas antes de comenzar</h3>
      <ul class="req-list">
        <li>Conocimientos básicos de dibujo técnico o AutoCAD (no excluyente)</li>
        <li>Computadora con Windows 10/11 y mínimo 8GB de RAM</li>
        <li>Conexión a internet para las clases en vivo</li>
        <li>Ganas de aprender y aplicar desde el primer día</li>
        <li>Autodesk Revit — te guiamos en la instalación (versión de prueba disponible)</li>
      </ul>
    </div>
  </div>
</section> -->

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
      <div class="include-box-desc">Todos los archivos Revit y recursos usados en las clases</div>
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
      <div class="include-box-icon">🌐</div>
      <div class="include-box-title">Recursos digitales</div>
      <div class="include-box-desc">Plantillas, guías y materiales de referencia descargables</div>
    </div>
    <div class="include-box reveal" style="border-style:dashed; border-color:rgba(245,200,66,.3)">
      <div class="include-box-icon">🎁</div>
      <div class="include-box-title" style="color:#f5c842">Bonus Exclusivo</div>
      <div class="include-box-desc">Sesión 1 on 1 de Inglés Profesional para ingenieros</div>
    </div>
  </div>
</section>
<!-- INSTRUCTOR -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">El instructor</div>
    <h2 class="s-title">Aprende de un experto<br>con experiencia real en obra</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar"><img src="/Img/img/Foto Ivan Constructiva.png" alt="" width="100"></div>
    <div>
      <div class="instructor-name">Iván Matías</div>
      <div class="instructor-title">Autodesk Expert Elite | Arquitecto | Asesor</div>
      <p class="instructor-bio">
       Arquitecto miebro de Autodesk Expert Elite, experto en BIM con +25 años de experiencia en diseño, asesoría, supervisión y construcción. Especialista en la implementación de metodologías y herramientas digitales aplicadas a la industria AECO, orientadas a optimizar la planificación, la coordinación interdisciplinaria y el control de proyectos en todas sus etapas.</p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">40<span>+</span></div>
          <div class="i-stat-lbl">Proyectos BIM</div>
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
          <div class="i-stat-val">25<span> años</span></div>
          <div class="i-stat-lbl">Experiencia</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- REVIEWS -->
<!--<section class="section section-white">
  <div class="reveal">
    <div class="section-label">Opiniones</div>
    <h2 class="s-title">Lo que dicen quienes<br>ya tomaron el workshop</h2>
  </div>

  <div class="reviews-top reveal">
    <div class="rating-big">
      <div class="rating-num">5.0</div>
      <div class="rating-stars">★★★★★</div>
      <div class="rating-count">Valoración del workshop</div>
    </div>
    <div class="rating-bars">
      <div class="bar-row">
        <span class="bar-label">5 ★</span>
        <div class="bar-track"><div class="bar-fill" style="width:92%"></div></div>
        <span class="bar-pct">92%</span>
      </div>
      <div class="bar-row">
        <span class="bar-label">4 ★</span>
        <div class="bar-track"><div class="bar-fill" style="width:6%"></div></div>
        <span class="bar-pct">6%</span>
      </div>
      <div class="bar-row">
        <span class="bar-label">3 ★</span>
        <div class="bar-track"><div class="bar-fill" style="width:2%"></div></div>
        <span class="bar-pct">2%</span>
      </div>
      <div class="bar-row">
        <span class="bar-label">2 ★</span>
        <div class="bar-track"><div class="bar-fill" style="width:0%"></div></div>
        <span class="bar-pct">0%</span>
      </div>
      <div class="bar-row">
        <span class="bar-label">1 ★</span>
        <div class="bar-track"><div class="bar-fill" style="width:0%"></div></div>
        <span class="bar-pct">0%</span>
      </div>
    </div>
  </div>

  <div class="reviews-grid">
    <div class="review-card reveal">
      <div class="review-top">
        <div class="reviewer">
          <div class="reviewer-av" style="background:linear-gradient(135deg,#0d4a46,#5de6d4)">👷</div>
          <div>
            <div class="reviewer-name">Carlos Fernández</div>
            <div class="reviewer-date">Ingeniero Civil · Santo Domingo</div>
          </div>
        </div>
        <div class="review-stars">★★★★★</div>
      </div>
      <p class="review-text">"En el primer proyecto que apliqué BIM detecté 14 interferencias que en obra hubieran costado semanas de retraso. El workshop se pagó solo con el primer trabajo."</p>
    </div>
    <div class="review-card reveal">
      <div class="review-top">
        <div class="reviewer">
          <div class="reviewer-av" style="background:linear-gradient(135deg,#2a1a6e,#b07af0)">👩‍💼</div>
          <div>
            <div class="reviewer-name">María Peña</div>
            <div class="reviewer-date">Arquitecta · Santiago</div>
          </div>
        </div>
        <div class="review-stars">★★★★★</div>
      </div>
      <p class="review-text">"El instructor explica con ejemplos reales de obra dominicana, no proyectos genéricos. Eso hace toda la diferencia. Ahora mis clientes me piden Revit en todos los proyectos."</p>
    </div>
    <div class="review-card reveal">
      <div class="review-top">
        <div class="reviewer">
          <div class="reviewer-av" style="background:linear-gradient(135deg,#1a3a0a,#5de6a3)">👨‍🔧</div>
          <div>
            <div class="reviewer-name">Roberto Díaz</div>
            <div class="reviewer-date">Ing. Mecánico · La Romana</div>
          </div>
        </div>
        <div class="review-stars">★★★★★</div>
      </div>
      <p class="review-text">"Venía de AutoCAD y pensé que sería difícil. En la segunda semana ya modelaba en 3D. La metodología del instructor hace que todo fluya de forma muy natural."</p>
    </div>
    <div class="review-card reveal">
      <div class="review-top">
        <div class="reviewer">
          <div class="reviewer-av" style="background:linear-gradient(135deg,#3a1a10,#c07a50)">👩‍🎓</div>
          <div>
            <div class="reviewer-name">Ana Jiménez</div>
            <div class="reviewer-date">Recién graduada · Puerto Plata</div>
          </div>
        </div>
        <div class="review-stars">★★★★★</div>
      </div>
      <p class="review-text">"Con Revit en mi CV conseguí mi primer empleo en menos de un mes. El workshop me dio una ventaja real frente a otros candidatos. 100% recomendado para recién graduados."</p>
    </div>
  </div>
</section>
-->
<!-- FAQ -->
<section class="section section-soft">
  <div class="reveal" style="text-align:center; max-width:580px; margin:0 auto;">
    <div class="section-label">Preguntas frecuentes</div>
    <h2 class="s-title">Todo lo que necesitas saber</h2>
  </div>

  <div class="faq-list">
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Qué pasa si no puedo asistir a una clase en vivo?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Todas las sesiones son grabadas en HD y quedan disponibles en la plataforma dentro de las 24 horas siguientes. Tienes acceso a las grabaciones, así que puedes ver la clase cuando más te convenga.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Necesito tener experiencia previa con Revit?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>No es necesario. El workshop empieza desde cero con la configuración e instalación del software. Lo único recomendable es tener nociones básicas de dibujo técnico o AutoCAD, aunque tampoco es excluyente.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Cuándo son las clases en vivo?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Las clases son los sábados de 9:00 AM a 12:00 PM (hora RD). Son 5 semanas consecutivas del 23 de Marzo al 22 de Abril de 2024.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Cómo recibo el certificado?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Al completar el programa y el proyecto final recibirás tu certificado digital por correo electrónico (con código QR de verificación) y el certificado físico es entregado en una ceremonia o enviado a domicilio según tu ubicación.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Tienen descuento estudiantil?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí. Existe un descuento especial para estudiantes universitarios con carnet vigente. Contáctanos directamente por WhatsApp para aplicar al descuento estudiantil antes de inscribirte.</p></div>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section class="bottom-cta" id="inscribirse">
  <div class="bottom-cta-content reveal">
    <div style="font-size:2.5rem;margin-bottom:1rem">🚀</div>
    <h2>¿Listo para transformar<br>tu manera de construir?</h2>
    <p>Únete al workshop de BIM-Revit y aprende a evitar demoliciones, detectar interferencias y presentar proyectos profesionales. Cupos limitados.</p>
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
  <a href="/" class="footer-logo-sm"><img src="/Img/Logo aqua.png" alt="" width="150" height="auto"><span>.</span></a>
  <span class="footer-note">© 2026 Constructiva · constructiva.edu.do · Todos los derechos reservados</span>
  <span class="footer-note" style="color:var(--mint)">LEAD. APPLY. LEAD.</span>
</footer>

<script src="/Js/revit.js"></script>
<script src="/Js/video-player.js"></script>
</body>
</html>