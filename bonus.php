<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bonus: Inglés Profesional 1 on 1 — Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="/Css/revit.css">
  <link rel="stylesheet" href="/Css/responsive.css">
  <style>
    /* Badge dorado especial para el bono */
    .bonus-badge {
      display:inline-flex; align-items:center; gap:.6rem;
      background: rgba(245,200,66,.12);
      border: 1px solid rgba(245,200,66,.35);
      border-radius:100px;
      padding:.4rem 1rem;
      font-size:.75rem; font-weight:700;
      letter-spacing:.08em; text-transform:uppercase;
      color:#f5c842;
      margin-bottom:1.5rem;
      width:fit-content;
    }
    .bonus-badge-dot { width:6px; height:6px; background:#f5c842; border-radius:50%; animation:pulse 2s infinite; }

    /* Formulario de inscripción */
    .form-section {
      background: var(--bg);
      padding: 5rem 4rem;
    }
    .form-wrapper {
      max-width: 680px;
      margin: 0 auto;
    }
    .form-card {
      background:#fff;
      border:1px solid var(--border);
      border-radius:24px;
      padding:3rem;
      box-shadow: 0 8px 40px rgba(0,0,0,.08);
      margin-top:3rem;
    }
    .form-card h3 {
      font-family:'Syne',sans-serif;
      font-weight:800; font-size:1.3rem;
      color:var(--text-dark); margin-bottom:.4rem;
    }
    .form-card p {
      font-size:.88rem; color:var(--text-body);
      margin-bottom:2rem; line-height:1.6;
    }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; }
    .form-field { margin-bottom:1.2rem; }
    .form-field label {
      display:block; font-size:.78rem; font-weight:700;
      color:var(--teal-vivid); text-transform:uppercase;
      letter-spacing:.05em; margin-bottom:.4rem;
    }
    .form-field input,
    .form-field select,
    .form-field textarea {
      width:100%; padding:.75rem 1rem;
      border:1.5px solid var(--border); border-radius:10px;
      font-family:'DM Sans',sans-serif; font-size:.9rem;
      color:var(--text-dark); outline:none; background:#fff;
      transition:border-color .2s, box-shadow .2s;
    }
    .form-field input:focus,
    .form-field select:focus,
    .form-field textarea:focus {
      border-color:var(--mint);
      box-shadow:0 0 0 3px rgba(16,176,158,.1);
    }
    .form-field textarea { resize:vertical; min-height:90px; }
    .form-submit {
      width:100%; padding:1rem;
      background:linear-gradient(135deg,var(--mint),var(--teal-vivid));
      color:#fff; border:none; border-radius:12px;
      font-family:'Syne',sans-serif; font-weight:800;
      font-size:1rem; cursor:pointer;
      box-shadow:0 8px 24px rgba(16,176,158,.3);
      transition:transform .2s, box-shadow .2s;
      margin-top:.5rem;
    }
    .form-submit:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(16,176,158,.4); }
    .form-note {
      text-align:center; font-size:.78rem;
      color:var(--text-muted); margin-top:1rem;
    }

    /* Niveles de inglés */
    .levels-grid {
      display:grid; grid-template-columns:repeat(3,1fr);
      gap:1rem; margin-top:3rem;
    }
    .level-card {
      background:#fff; border:1px solid var(--border);
      border-radius:14px; padding:1.5rem;
      text-align:center;
      box-shadow:var(--shadow-sm);
      transition:border-color .25s, transform .25s;
    }
    .level-card:hover { border-color:var(--mint); transform:translateY(-3px); }
    .level-icon { font-size:2rem; margin-bottom:.8rem; }
    .level-name {
      font-family:'Syne',sans-serif; font-weight:800;
      font-size:.95rem; color:var(--text-dark); margin-bottom:.3rem;
    }
    .level-range {
      display:inline-block;
      font-size:.7rem; font-weight:700; letter-spacing:.06em;
      text-transform:uppercase; color:var(--mint);
      background:rgba(16,176,158,.08); padding:.2rem .6rem;
      border-radius:100px; margin-bottom:.6rem;
    }
    .level-desc { font-size:.82rem; color:var(--text-body); line-height:1.5; }

    /* Cómo funciona timeline */
    .timeline { display:flex; flex-direction:column; gap:0; margin-top:3rem; max-width:600px; margin-left:auto; margin-right:auto; }
    .tl-item { display:flex; gap:1.5rem; position:relative; }
    .tl-item:not(:last-child)::after {
      content:''; position:absolute;
      left:20px; top:44px;
      width:2px; height:calc(100% + 0px);
      background:linear-gradient(to bottom, var(--mint), rgba(16,176,158,.1));
    }
    .tl-left { flex-shrink:0; display:flex; flex-direction:column; align-items:center; }
    .tl-num {
      width:40px; height:40px; border-radius:50%;
      background:linear-gradient(135deg,var(--mint),var(--teal-vivid));
      display:flex; align-items:center; justify-content:center;
      font-family:'Syne',sans-serif; font-weight:800;
      font-size:.85rem; color:#fff; flex-shrink:0; z-index:1;
    }
    .tl-content { padding-bottom:2.5rem; }
    .tl-title { font-family:'Syne',sans-serif; font-weight:700; font-size:.95rem; color:var(--text-dark); margin-bottom:.3rem; }
    .tl-desc { font-size:.86rem; color:var(--text-body); line-height:1.6; }

    @media (max-width:768px) {
      .levels-grid { grid-template-columns:1fr; }
      .form-row { grid-template-columns:1fr; }
      .form-card { padding:2rem 1.5rem; }
      .form-section { padding:4rem 1.5rem; }
    }
  </style>
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
  <a href="/" class="nav-back">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
    Volver al inicio
  </a>
  <a href="/" class="nav-logo">constructiva<span>.</span></a>
  <a href="/register.php" class="nav-cta-small">Quiero mi bonus</a>
</nav>

<!-- HERO -->
<section class="course-hero">
  <div class="hero-left">
    <div class="breadcrumb">
      <a href="/">Inicio</a>
      <span>/</span>
      <a href="#">Workshops</a>
      <span>/</span>
      <span style="color:rgba(255,255,255,.5)">Bonus Exclusivo</span>
    </div>

    <div class="bonus-badge">
      <span class="bonus-badge-dot"></span>
      🎁 Bonus exclusivo · Constructiva Experience
    </div>

    <h1>
      Inglés Profesional<br>
      <em>1 on 1</em><br>
      para ingenieros
    </h1>

    <p class="hero-desc">
      Una sesión personalizada con un tutor nativo o bilingüe especializado en vocabulario técnico de construcción e ingeniería. Diseñada para que puedas comunicarte con confianza en reuniones internacionales, licitaciones y documentos técnicos en inglés.
    </p>

    <div class="hero-tags">
      <span class="tag">🎯 Sesión personalizada</span>
      <span class="tag">🏗️ Vocabulario técnico</span>
      <span class="tag">🌐 Inglés de negocios</span>
      <span class="tag">📄 Documentos técnicos</span>
      <span class="tag">🤝 Reuniones internacionales</span>
    </div>

    <div class="hero-meta-row">
      <div class="meta-item">
        <div class="meta-val">1<span>h</span></div>
        <div class="meta-lbl">Sesión privada</div>
      </div>
      <div class="meta-item">
        <div class="meta-val">1<span>:1</span></div>
        <div class="meta-lbl">Solo tú y el tutor</div>
      </div>
      <div class="meta-item">
        <div class="meta-val">Online</div>
        <div class="meta-lbl">Zoom o Meet</div>
      </div>
      <div class="meta-item">
        <div class="meta-val" style="color:#f5c842">Gratis</div>
        <div class="meta-lbl">Con tu workshop</div>
      </div>
    </div>

    <div class="hero-actions">
      <a href="/register.php" class="btn-enroll" style="background:#f5c842; color:var(--teal-deep)">
        Agendar mi sesión
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#como-funciona" class="btn-outline-white">
        ¿Cómo funciona?
      </a>
    </div>

    <div class="discount-banner" style="background:rgba(245,200,66,.1); border-color:rgba(245,200,66,.25); color:#f5c842;">
      ✅ Incluido gratis al inscribirte en cualquier workshop de Constructiva Experience
    </div>
  </div>

  <!-- STICKY RIGHT CARD -->
  <div class="hero-right">
    <div class="sticky-card">
      <div class="sticky-video" id="videoContainer" onclick="loadVideo()">
        <span class="video-label">▶ Vista previa</span>
        <div class="play-btn">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><polygon points="5,3 19,12 5,21"/></svg>
        </div>
      </div>
      <div class="sticky-body">
        <div class="price-row">
          <span class="price-main" style="color:#f5c842">$0</span>
          <span class="price-original">$80</span>
          <span class="price-badge">100% GRATIS</span>
        </div>
        <div class="price-note">🎁 Bonus exclusivo con tu inscripción</div>
        <a href="/register.php" class="sticky-btn" style="background:#f5c842; color:var(--teal-deep)">Agendar mi sesión 1 on 1</a>
        <a href="#como-funciona" class="sticky-btn-ghost">¿Cómo funciona?</a>
        <div class="sticky-includes">
          <div class="include-item"><span class="include-icon">👤</span>Tutor bilingüe especializado en AEC</div>
          <div class="include-item"><span class="include-icon">🎯</span>Sesión 100% personalizada a tu nivel</div>
          <div class="include-item"><span class="include-icon">📋</span>Plan de mejora enviado post-sesión</div>
          <div class="include-item"><span class="include-icon">📅</span>Agenda en el horario que te convenga</div>
          <div class="include-item"><span class="include-icon">💻</span>Sesión por Zoom o Google Meet</div>
          <div class="include-item"><span class="include-icon">📁</span>Material de vocabulario técnico incluido</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT YOU'LL LEARN -->
<section class="section section-white" id="aprender">
  <div class="reveal">
    <div class="section-label">¿Qué trabajaremos?</div>
    <h2 class="s-title">Una sesión enfocada en<br>lo que tú más necesitas</h2>
  </div>

  <div class="learn-grid">
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Diagnóstico de tu nivel actual</strong>La sesión comienza evaluando tu inglés real para diseñar un plan específico a tus fortalezas y áreas de mejora.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Vocabulario técnico de construcción</strong>Términos clave en inglés para planos, especificaciones, reuniones de obra, licitaciones internacionales y contratos.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Inglés para reuniones y presentaciones</strong>Frases y estructuras para participar con confianza en calls internacionales, presentar proyectos y hacer preguntas técnicas.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Lectura de documentos técnicos</strong>Aprende a leer y entender normas ASTM, ACI, especificaciones técnicas y contratos redactados en inglés.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Escritura de emails profesionales</strong>Estructura emails técnicos, solicitudes de cotización y comunicaciones formales en inglés con el tono correcto.</div>
    </div>
    <div class="learn-card reveal">
      <div class="learn-check">✓</div>
      <div class="learn-text"><strong>Plan de continuación personalizado</strong>Al finalizar recibes un plan de estudio de 30 días con recursos gratuitos para seguir mejorando por tu cuenta.</div>
    </div>
  </div>
</section>

<!-- CÓMO FUNCIONA -->
<section class="section section-soft" id="como-funciona">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto;">
    <div class="section-label">Proceso</div>
    <h2 class="s-title">¿Cómo funciona el bonus?</h2>
    <p class="s-sub" style="margin:0 auto;">Desde que te inscribes hasta tu sesión, todo el proceso es simple y rápido.</p>
  </div>

  <div class="timeline reveal">
    <div class="tl-item">
      <div class="tl-left"><div class="tl-num">1</div></div>
      <div class="tl-content">
        <div class="tl-title">Inscríbete en cualquier workshop de Constructiva Experience</div>
        <div class="tl-desc">Al completar tu pago de cualquiera de los 5 workshops, el bonus de Inglés Profesional queda activado automáticamente en tu cuenta.</div>
      </div>
    </div>
    <div class="tl-item">
      <div class="tl-left"><div class="tl-num">2</div></div>
      <div class="tl-content">
        <div class="tl-title">Completa el formulario de inscripción al bonus</div>
        <div class="tl-desc">Llena el formulario en esta página con tu nivel de inglés, tu área de especialidad y el enfoque que más te interesa trabajar en la sesión.</div>
      </div>
    </div>
    <div class="tl-item">
      <div class="tl-left"><div class="tl-num">3</div></div>
      <div class="tl-content">
        <div class="tl-title">Te asignamos un tutor especializado</div>
        <div class="tl-desc">En menos de 48 horas recibirás un correo con el nombre de tu tutor bilingüe asignado y un link para agendar tu sesión en el horario que prefieras.</div>
      </div>
    </div>
    <div class="tl-item">
      <div class="tl-left"><div class="tl-num">4</div></div>
      <div class="tl-content">
        <div class="tl-title">Realiza tu sesión 1 on 1 de 60 minutos</div>
        <div class="tl-desc">Conéctate en el horario que agendaste. La sesión se realiza por Zoom o Google Meet. Tu tutor llevará el material adaptado a tu perfil.</div>
      </div>
    </div>
    <div class="tl-item">
      <div class="tl-left"><div class="tl-num">5</div></div>
      <div class="tl-content">
        <div class="tl-title">Recibe tu plan de continuación</div>
        <div class="tl-desc">Dentro de las 24 horas siguientes a tu sesión recibirás un reporte personalizado con tu nivel actual, áreas de mejora prioritarias y un plan de 30 días con recursos gratuitos.</div>
      </div>
    </div>
  </div>
</section>

<!-- NIVELES -->
<section class="section section-white">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto;">
    <div class="section-label">Niveles</div>
    <h2 class="s-title">El bonus se adapta<br>a tu nivel actual</h2>
    <p class="s-sub" style="margin:0 auto;">No importa si eres principiante o avanzado. La sesión se diseña 100% para donde estás tú.</p>
  </div>

  <div class="levels-grid">
    <div class="level-card reveal">
      <div class="level-icon">🌱</div>
      <div class="level-name">Básico</div>
      <div class="level-range">A1 — A2</div>
      <div class="level-desc">Conoces palabras sueltas pero no te sientes seguro en conversaciones. Nos enfocamos en estructuras básicas y vocabulario técnico esencial.</div>
    </div>
    <div class="level-card reveal">
      <div class="level-icon">📈</div>
      <div class="level-name">Intermedio</div>
      <div class="level-range">B1 — B2</div>
      <div class="level-desc">Puedes comunicarte pero pierdes confianza en contextos técnicos. Trabajamos fluidez, vocabulario AEC y comunicación en reuniones.</div>
    </div>
    <div class="level-card reveal">
      <div class="level-icon">🚀</div>
      <div class="level-name">Avanzado</div>
      <div class="level-range">C1 — C2</div>
      <div class="level-desc">Tu inglés es sólido pero quieres pulir el lenguaje técnico de alto nivel para licitaciones internacionales y contratos complejos.</div>
    </div>
  </div>
</section>

<!-- INSTRUCTOR TUTOR -->
<section class="section section-soft">
  <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto 0;">
    <div class="section-label">Los tutores</div>
    <h2 class="s-title">Profesionales bilingües<br>especializados en AEC</h2>
  </div>

  <div class="instructor-card reveal">
    <div class="instructor-avatar">
      <img src="/Img/Tutor Ingles.PNG" alt="Tutor Inglés Profesional"/>
    </div>
    <div>
      <div class="instructor-name">Equipo de tutores Constructiva</div>
      <div class="instructor-title">Tutores bilingües · Especialistas en inglés técnico para ingeniería y arquitectura</div>
      <p class="instructor-bio">
        Nuestros tutores son profesionales bilingües con experiencia real en el sector AEC — algunos son ingenieros o arquitectos que dominan el inglés, otros son profesores de inglés con especialización en lenguaje técnico de construcción. Todos han pasado por un proceso de selección riguroso y están capacitados para adaptar cada sesión al nivel y necesidades específicas del estudiante.
      </p>
      <div class="instructor-stats">
        <div>
          <div class="i-stat-val">5<span>+</span></div>
          <div class="i-stat-lbl">Tutores</div>
        </div>
        <div>
          <div class="i-stat-val">3<span> niveles</span></div>
          <div class="i-stat-lbl">Cubiertos</div>
        </div>
        <div>
          <div class="i-stat-val">★ 5.0</div>
          <div class="i-stat-lbl">Valoración</div>
        </div>
        <div>
          <div class="i-stat-val">100<span>%</span></div>
          <div class="i-stat-lbl">Personalizado</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FORMULARIO DE INSCRIPCIÓN -->
<div class="form-section" id="inscribirse">
  <div class="form-wrapper">
    <div class="reveal" style="text-align:center;">
      <div class="section-label">Inscripción</div>
      <h2 class="s-title">Agenda tu sesión<br>1 on 1 ahora</h2>
      <p class="s-sub" style="margin:0 auto 0;">Completa el formulario y en menos de 48 horas recibirás la confirmación con tu tutor asignado.</p>
    </div>

    <div class="form-card reveal">
      <h3>🎁 Formulario de inscripción — Bonus Inglés Profesional</h3>
      <p>Solo disponible para inscritos en Constructiva Experience. Necesitarás tu número de orden o comprobante de inscripción.</p>

      <form action="procesar_bonus.php" method="POST">

        <div class="form-row">
          <div class="form-field">
            <label>Nombre *</label>
            <input type="text" name="nombre" placeholder="Juan" required/>
          </div>
          <div class="form-field">
            <label>Apellido *</label>
            <input type="text" name="apellido" placeholder="Pérez" required/>
          </div>
        </div>

        <div class="form-field">
          <label>Correo electrónico *</label>
          <input type="email" name="email" placeholder="tu@email.com" required/>
        </div>

        <div class="form-field">
          <label>WhatsApp *</label>
          <input type="tel" name="whatsapp" placeholder="+1 809 000 0000" required/>
        </div>

        <div class="form-row">
          <div class="form-field">
            <label>Workshop en el que te inscribiste *</label>
            <select name="workshop" required>
              <option value="" disabled selected>Selecciona...</option>
              <option value="bim-revit">Workshop 01 — BIM-Revit</option>
              <option value="ms-project">Workshop 02 — Ms Project</option>
              <option value="ia">Workshop 03 — Inteligencia Artificial</option>
              <option value="marca-personal">Workshop 04 — Marca Personal</option>
              <option value="neurocomunicacion">Workshop 05 — Neurocomunicación</option>
            </select>
          </div>
          <div class="form-field">
            <label>Tu nivel de inglés actual *</label>
            <select name="nivel" required>
              <option value="" disabled selected>Selecciona...</option>
              <option value="basico">Básico (A1-A2) — Sé muy poco</option>
              <option value="intermedio-bajo">Intermedio bajo (B1) — Me defiendo</option>
              <option value="intermedio">Intermedio (B2) — Puedo comunicarme</option>
              <option value="avanzado">Avanzado (C1-C2) — Nivel sólido</option>
            </select>
          </div>
        </div>

        <div class="form-field">
          <label>Número de orden o comprobante de inscripción *</label>
          <input type="text" name="orden" placeholder="Ej: CON-2024-0001" required/>
        </div>

        <div class="form-field">
          <label>¿En qué área del inglés técnico quieres enfocarte?</label>
          <select name="enfoque">
            <option value="" disabled selected>Selecciona...</option>
            <option value="reuniones">Reuniones y calls internacionales</option>
            <option value="documentos">Lectura de documentos y normas técnicas</option>
            <option value="emails">Redacción de emails y comunicaciones</option>
            <option value="presentaciones">Presentaciones de proyectos en inglés</option>
            <option value="vocabulario">Vocabulario técnico de construcción</option>
            <option value="general">General — el tutor que decida</option>
          </select>
        </div>

        <div class="form-field">
          <label>¿Algo más que el tutor deba saber sobre ti? (opcional)</label>
          <textarea name="notas" placeholder="Ej: Tengo una reunión con un cliente de EE.UU. en 3 semanas y necesito practicar vocabulario de presupuestos..."></textarea>
        </div>

        <button type="submit" class="form-submit">
          📅 Enviar solicitud y agendar mi sesión →
        </button>
        <p class="form-note">🔒 Tu información es confidencial · Recibirás respuesta en menos de 48 horas hábiles</p>

      </form>
    </div>
  </div>
</div>

<!-- FAQ -->
<section class="section section-soft">
  <div class="reveal" style="text-align:center; max-width:580px; margin:0 auto;">
    <div class="section-label">Preguntas frecuentes</div>
    <h2 class="s-title">Todo lo que necesitas saber<br>sobre el bonus</h2>
  </div>

  <div class="faq-list">
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Puedo usar el bonus si me inscribo en más de un workshop?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>El bonus de una sesión 1 on 1 aplica por persona, no por workshop. Si te inscribes en más de un workshop de la Constructiva Experience, el bonus cuenta una sola vez. Sin embargo, si deseas sesiones adicionales, puedes adquirirlas a un precio preferencial para inscritos.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Cuánto tiempo tengo para usar el bonus?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Tienes hasta 60 días después de la fecha de inicio de tu workshop para agendar y realizar tu sesión. Te recomendamos agendarla durante las primeras semanas para que puedas aplicar el inglés mientras aprendes en el workshop.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿La sesión es grabada?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí, con tu autorización la sesión puede ser grabada para que puedas revisarla después. La grabación es solo para tu uso personal y no se comparte con terceros.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Qué pasa si necesito cancelar o reprogramar?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Puedes reprogramar tu sesión hasta con 12 horas de anticipación sin ningún problema. Solo comunícate con tu tutor asignado o con nuestro equipo por WhatsApp y te buscamos un nuevo horario disponible.</p></div>
    </div>
    <div class="faq-item reveal">
      <div class="faq-q" onclick="toggleFaq(this)">
        ¿Puedo elegir el horario de mi sesión?
        <span class="faq-icon">+</span>
      </div>
      <div class="faq-a"><p>Sí. Una vez asignado tu tutor, recibirás un link de Calendly con los horarios disponibles del tutor para que elijas el que mejor se adapte a tu agenda. Los horarios disponibles incluyen mañanas, tardes y algunos fines de semana.</p></div>
    </div>
  </div>
</section>

<!-- BOTTOM CTA -->
<section class="bottom-cta" id="cta-final">
  <div class="bottom-cta-content reveal">
    <div style="font-size:2.5rem;margin-bottom:1rem">🎁</div>
    <h2>¿Aún no tienes tu workshop?<br>Inscríbete y activa el bonus</h2>
    <p>El bonus de Inglés Profesional 1 on 1 está incluido gratis en todos los workshops de la Constructiva Experience. Elige el tuyo y actívalo hoy.</p>
    <div class="bottom-cta-actions">
      <a href="Programa-completo.php" class="btn-enroll" style="background:#f5c842; color:var(--teal-deep)">
        Ver todos los workshops
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="https://wa.me/18294910540" class="btn-outline-white" style="border-color:rgba(255,255,255,.25)">
        💬 Consultar por WhatsApp
      </a>
    </div>
    <div class="bottom-note">🏷️ Bonus incluido en los 5 workshops · Cupos limitados · 23 MAR – 22 ABR</div>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <a href="/" class="footer-logo-sm">constructiva<span>.</span></a>
  <span class="footer-note">© 2026 Constructiva · constructiva.edu.do · Todos los derechos reservados</span>
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

  // Toggle FAQ
  function toggleFaq(btn){
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(f => f.classList.remove('open'));
    if(!isOpen) item.classList.add('open');
  }

  // Load video
  function loadVideo() {
    const container = document.getElementById('videoContainer');
    container.innerHTML = `
      <iframe
        width="100%" height="100%"
        src=""
        frameborder="0"
        allow="autoplay; encrypted-media; fullscreen"
        allowfullscreen>
      </iframe>
    `;
    container.style.padding = '0';
    container.style.cursor = 'default';
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    CVSession.injectNav({
      type: 'course',
      ctaLabel: 'Quiero mi bonus',
      ctaHref:  '#inscribirse',
    });
  });
</script>
</body>
</html>