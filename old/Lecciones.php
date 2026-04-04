<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lección 1 — ¿Qué es BIM? · Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
 <link rel="stylesheet" href="Css/lecciones.css">
  <link rel="stylesheet" href="Css/responsive.css">
  <script src="Js/cv-session.js"></script>
</head>
<body>

<!-- TOP NAV -->
<nav class="topnav">
  <div class="topnav-left">
    <a href="/cursos/revit" class="back-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Curso
    </a>
    <span class="course-title-nav">
      BIM-Revit <span class="sep">/</span>
      <strong>Semana 1 — Fundamentos</strong>
    </span>
  </div>
  <div class="topnav-center">
    <a href="/" class="nav-logo-sm">constructiva<span>.</span></a>
  </div>
  <div class="topnav-right">
    <span class="progress-text"><strong>1</strong> / 20 lecciones</span>
    <button class="complete-btn" id="completeBtn" onclick="markDone()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20,6 9,17 4,12"/></svg>
      Marcar completada
    </button>
  </div>
</nav>

<!-- LAYOUT -->
<div class="app-layout">

  <!-- VIDEO + CONTENT (col 1) -->
  <div>
    <!-- VIDEO -->
    <div class="video-area">
      <div class="video-wrapper" id="videoWrapper">
        <div class="video-placeholder" onclick="loadVideo()" id="videoPlaceholder">
          <span class="vp-label">Workshop 01 · Semana 1 · Lección 1</span>
          <div class="vp-play">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="white"><polygon points="5,3 19,12 5,21"/></svg>
          </div>
          <div class="vp-title">¿Qué es BIM y por qué cambia la industria?</div>
          <div class="vp-sub">32 min · Haz clic para reproducir</div>
        </div>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="content-area">

      <div class="lesson-header">
        <div class="lesson-meta-row">
          <span class="lmeta-tag"><span class="lmeta-dot"></span>Vista previa gratuita</span>
          <span class="lmeta-dur">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
            32 minutos
          </span>
          <span class="lmeta-dur">📅 Semana 1 · Lección 1 de 4</span>
        </div>
        <h1 class="lesson-title">¿Qué es BIM y por qué<br>cambia la industria?</h1>
        <p class="lesson-desc">En esta lección introductoria entenderás qué es la metodología BIM (Building Information Modeling), cómo está transformando la construcción a nivel mundial y por qué dominarla representa una ventaja competitiva real para ingenieros y arquitectos dominicanos.</p>
      </div>

      <!-- TABS -->
      <div class="tabs">
        <button class="tab active" onclick="switchTab(this,'objetivos')">🎯 Objetivos</button>
        <button class="tab" onclick="switchTab(this,'transcripcion')">📄 Transcripción</button>
        <button class="tab" onclick="switchTab(this,'recursos')">📁 Recursos</button>
        <button class="tab" onclick="switchTab(this,'notas')">✏️ Mis notas</button>
      </div>

      <!-- TAB: OBJETIVOS -->
      <div class="tab-content active" id="tab-objetivos">
        <div class="objectives-list">
          <div class="obj-item">
            <div class="obj-check">✓</div>
            <div class="obj-text"><strong>Definir BIM con precisión</strong>Entender qué significa Building Information Modeling más allá del software: es una metodología de trabajo colaborativo basada en datos.</div>
          </div>
          <div class="obj-item">
            <div class="obj-check">✓</div>
            <div class="obj-text"><strong>Comprender los niveles BIM</strong>Conocer los niveles 0, 1, 2 y 3 de madurez BIM y en qué nivel opera el mercado dominicano actualmente.</div>
          </div>
          <div class="obj-item">
            <div class="obj-check">✓</div>
            <div class="obj-text"><strong>Identificar el impacto en obra</strong>Ver casos reales donde BIM evitó demoliciones, redujo costos y acortó cronogramas en proyectos de construcción.</div>
          </div>
          <div class="obj-item">
            <div class="obj-check">✓</div>
            <div class="obj-text"><strong>Conocer el ecosistema de herramientas</strong>Diferenciar Revit, Navisworks, BIM 360 y entender cuál usar en cada fase del proyecto.</div>
          </div>
          <div class="obj-item">
            <div class="obj-check">✓</div>
            <div class="obj-text"><strong>Posicionar tu perfil profesional</strong>Entender por qué BIM es ya un requisito en licitaciones internacionales y cómo te diferencia en el mercado local.</div>
          </div>
        </div>
      </div>

      <!-- TAB: TRANSCRIPCIÓN -->
      <div class="tab-content" id="tab-transcripcion">
        <div class="transcript-search">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--text-muted)"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
          <input type="text" placeholder="Buscar en la transcripción..." oninput="filterTranscript(this.value)"/>
        </div>
        <div class="transcript-block" id="transcriptBlock">
          <div class="t-line"><span class="t-time">0:00</span><span class="t-text">Bienvenidos a la primera lección del Workshop BIM-Revit de Constructiva. En esta sesión vamos a entender qué es realmente BIM y por qué está cambiando la forma en que construimos.</span></div>
          <div class="t-line"><span class="t-time">0:48</span><span class="t-text">BIM no es un software. Es importante que lo tengan claro desde el principio. BIM, Building Information Modeling, es una metodología de trabajo que integra información de un proyecto en un modelo digital único.</span></div>
          <div class="t-line"><span class="t-time">1:55</span><span class="t-text">Piensen en el modelo BIM como el ADN del edificio. Contiene la geometría, sí, pero también materiales, costos, proveedores, fechas de instalación, especificaciones técnicas...</span></div>
          <div class="t-line"><span class="t-time">3:20</span><span class="t-text">En los proyectos tradicionales con AutoCAD, cada disciplina trabaja en su propio plano. El arquitecto tiene sus planos, el estructural tiene los suyos, el MEP tiene los suyos. Cuando llegan a obra, muchas veces se descubren que una viga pasa por donde va la tubería.</span></div>
          <div class="t-line"><span class="t-time">5:10</span><span class="t-text">Con BIM, todas las disciplinas trabajan sobre el mismo modelo. Un proyecto que hicimos en 2022 detectó 47 interferencias antes de comenzar la obra. Eso hubiera significado meses de retraso y millones de pesos en correcciones.</span></div>
          <div class="t-line"><span class="t-time">7:30</span><span class="t-text">Los niveles de madurez BIM van del 0 al 3. El nivel 0 es básicamente dibujo 2D, lo que usamos con AutoCAD. El nivel 1 introduce objetos 3D. El nivel 2 es donde trabaja la mayoría de los países desarrollados hoy.</span></div>
          <div class="t-line"><span class="t-time">10:15</span><span class="t-text">República Dominicana está en transición entre el nivel 0 y el nivel 1. Eso significa que si ustedes dominan BIM nivel 2, tienen una ventaja enorme frente al 95% de los profesionales del país.</span></div>
          <div class="t-line"><span class="t-time">14:00</span><span class="t-text">Autodesk Revit es la herramienta líder para modelado BIM. Es la que vamos a usar en este workshop. Pero también veremos Navisworks para la detección de interferencias y BIM 360 para la colaboración en la nube.</span></div>
          <div class="t-line"><span class="t-time">18:45</span><span class="t-text">Vean este caso real. Un proyecto de hotel en Punta Cana. Antes de usar BIM, en la fase de construcción encontraron que el sistema de aire acondicionado del piso 3 colisionaba con la estructura. Tuvieron que demoler y reconstruir.</span></div>
          <div class="t-line"><span class="t-time">22:30</span><span class="t-text">Con BIM eso se hubiera detectado en pantalla, con un clic. El costo de corregirlo en el modelo es prácticamente cero. El costo de corregirlo en obra puede ser catastrófico para el proyecto.</span></div>
          <div class="t-line"><span class="t-time">26:00</span><span class="t-text">Para la próxima semana quiero que descarguen e instalen Revit. En la descripción de esta lección van a encontrar el enlace y una guía paso a paso. Los que tengan dudas, me escriben al grupo de WhatsApp.</span></div>
          <div class="t-line"><span class="t-time">30:10</span><span class="t-text">Recuerden: el objetivo de este workshop no es que sean expertos en software. Es que sean capaces de eliminar errores en sus proyectos antes de que lleguen a obra. Eso es lo que transforma su carrera.</span></div>
        </div>
      </div>

      <!-- TAB: RECURSOS -->
      <div class="tab-content" id="tab-recursos">
        <div class="resources-grid">
          <a href="#" class="resource-item">
            <div class="res-icon" style="background:rgba(16,176,158,.1)">📄</div>
            <div>
              <div class="res-name">Guía de instalación Autodesk Revit</div>
              <div class="res-meta">PDF · 2.4 MB · Paso a paso para Windows</div>
            </div>
            <div class="res-download">↓</div>
          </a>
          <a href="#" class="resource-item">
            <div class="res-icon" style="background:rgba(0,120,212,.1)">📊</div>
            <div>
              <div class="res-name">Presentación: Niveles de madurez BIM</div>
              <div class="res-meta">PPTX · 5.1 MB · Diapositivas de la lección</div>
            </div>
            <div class="res-download">↓</div>
          </a>
          <a href="#" class="resource-item">
            <div class="res-icon" style="background:rgba(245,200,66,.1)">📋</div>
            <div>
              <div class="res-name">Checklist: ¿Está tu empresa lista para BIM?</div>
              <div class="res-meta">PDF · 890 KB · Evaluación de madurez BIM</div>
            </div>
            <div class="res-download">↓</div>
          </a>
          <a href="#" class="resource-item">
            <div class="res-icon" style="background:rgba(255,100,80,.1)">🔗</div>
            <div>
              <div class="res-name">Enlace: Revit versión de prueba 30 días</div>
              <div class="res-meta">Autodesk.com · Gratis · Incluye activación</div>
            </div>
            <div class="res-download">→</div>
          </a>
          <a href="#" class="resource-item">
            <div class="res-icon" style="background:rgba(160,120,255,.1)">📖</div>
            <div>
              <div class="res-name">Glosario BIM — Términos esenciales</div>
              <div class="res-meta">PDF · 1.2 MB · 80 términos con definición</div>
            </div>
            <div class="res-download">↓</div>
          </a>
        </div>
      </div>

      <!-- TAB: NOTAS -->
      <div class="tab-content" id="tab-notas">
        <div class="notes-area">
          <div class="notes-header">
            <span class="notes-label">✏️ Nueva nota</span>
            <span class="notes-time" id="noteTime">0:00</span>
          </div>
          <textarea class="notes-textarea" id="noteInput" placeholder="Escribe tu nota aquí... Se guardará con el tiempo de la lección."></textarea>
          <br/><br/>
          <button class="notes-save" onclick="saveNote()">Guardar nota</button>
        </div>

        <div class="saved-notes" id="savedNotes">
          <div class="saved-note">
            <div class="sn-time">⏱ 5:10 — Lección 1</div>
            <div class="sn-text">BIM detectó 47 interferencias antes de la obra. Revisar casos de uso locales para presentar a clientes.</div>
          </div>
          <div class="saved-note">
            <div class="sn-time">⏱ 10:15 — Lección 1</div>
            <div class="sn-text">RD está entre nivel 0 y 1. Gran oportunidad de diferenciación dominando nivel 2.</div>
          </div>
        </div>
      </div>

    </div><!-- /content-area -->

    <!-- PREV / NEXT NAV -->
    <div class="lesson-nav">
      <a href="#" class="lnav-btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
        <div>
          <span class="lnav-sub">Anterior</span>
          Inicio del curso
        </div>
      </a>
      <a href="#" class="lnav-btn next">
        <div style="text-align:right">
          <span class="lnav-sub">Siguiente lección</span>
          Instalación y configuración de Revit
        </div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>

  </div><!-- /col1 -->

  <!-- SIDEBAR (col 2) -->
  <aside class="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-course-name">🏗️ Workshop 01 — BIM-Revit</div>
      <div class="sidebar-progress-bar">
        <div class="sidebar-progress-fill"></div>
      </div>
      <div class="sidebar-progress-text">1 de 20 lecciones completadas · 5%</div>
    </div>

    <!-- SEMANA 1 -->
    <div class="sidebar-week open">
      <div class="week-header" onclick="toggleWeek(this)">
        <div class="week-left">
          <div class="week-num">S1</div>
          <div>
            <div class="week-name">Semana 1 — Fundamentos</div>
            <div class="week-count">4 lecciones · 2h 45min</div>
          </div>
        </div>
        <span class="week-arrow">▾</span>
      </div>
      <div class="week-lessons">
        <a href="leccion.php" class="lesson-link active">
          <span class="ll-icon">▶️</span>
          <span class="ll-name">¿Qué es BIM y por qué cambia la industria?</span>
          <span class="ll-dur">32m</span>
          <span class="ll-check">✓</span>
        </a>
        <a href="#" class="lesson-link">
          <span class="ll-icon">🔒</span>
          <span class="ll-name">Instalación y configuración de Revit</span>
          <span class="ll-dur">45m</span>
          <span class="ll-check"></span>
        </a>
        <a href="#" class="lesson-link">
          <span class="ll-icon">🔒</span>
          <span class="ll-name">Interfaz, familias y categorías</span>
          <span class="ll-dur">38m</span>
          <span class="ll-check"></span>
        </a>
        <a href="#" class="lesson-link">
          <span class="ll-icon">🔒</span>
          <span class="ll-name">Práctica: Primer modelo arquitectónico</span>
          <span class="ll-dur">50m</span>
          <span class="ll-check"></span>
        </a>
      </div>
    </div>

    <!-- SEMANAS 2-5 -->
    <div class="sidebar-week">
      <div class="week-header" onclick="toggleWeek(this)">
        <div class="week-left">
          <div class="week-num">S2</div>
          <div>
            <div class="week-name">Semana 2 — Modelado estructural</div>
            <div class="week-count">5 lecciones · 3h 10min</div>
          </div>
        </div>
        <span class="week-arrow">▾</span>
      </div>
      <div class="week-lessons">
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Estructura: vigas, columnas y losas</span><span class="ll-dur">42m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Instalaciones eléctricas en Revit MEP</span><span class="ll-dur">38m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Instalaciones hidráulicas y sanitarias</span><span class="ll-dur">36m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Coordinación multidisciplinaria</span><span class="ll-dur">44m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Práctica: Modelo completo integrado</span><span class="ll-dur">30m</span><span class="ll-check"></span></a>
      </div>
    </div>

    <div class="sidebar-week">
      <div class="week-header" onclick="toggleWeek(this)">
        <div class="week-left">
          <div class="week-num">S3</div>
          <div>
            <div class="week-name">Semana 3 — Clash Detection</div>
            <div class="week-count">4 lecciones · 3h 00min</div>
          </div>
        </div>
        <span class="week-arrow">▾</span>
      </div>
      <div class="week-lessons">
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Navisworks: detección de interferencias</span><span class="ll-dur">50m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Clasificación y priorización de conflictos</span><span class="ll-dur">35m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Reportes y comunicación al equipo</span><span class="ll-dur">40m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Caso real: Resolución de interferencias</span><span class="ll-dur">55m</span><span class="ll-check"></span></a>
      </div>
    </div>

    <div class="sidebar-week">
      <div class="week-header" onclick="toggleWeek(this)">
        <div class="week-left">
          <div class="week-num">S4</div>
          <div>
            <div class="week-name">Semana 4 — Planos y entregables</div>
            <div class="week-count">4 lecciones · 2h 50min</div>
          </div>
        </div>
        <span class="week-arrow">▾</span>
      </div>
      <div class="week-lessons">
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Generación automática de planos</span><span class="ll-dur">42m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Tablas de cómputos y metrados</span><span class="ll-dur">38m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Exportación a AutoCAD y PDF</span><span class="ll-dur">30m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Entregable final: Set de planos BIM</span><span class="ll-dur">60m</span><span class="ll-check"></span></a>
      </div>
    </div>

    <div class="sidebar-week">
      <div class="week-header" onclick="toggleWeek(this)">
        <div class="week-left">
          <div class="week-num">S5</div>
          <div>
            <div class="week-name">Semana 5 — Proyecto final</div>
            <div class="week-count">3 lecciones · 3h 30min</div>
          </div>
        </div>
        <span class="week-arrow">▾</span>
      </div>
      <div class="week-lessons">
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Proyecto integrador: Edificio multifamiliar</span><span class="ll-dur">90m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🔒</span><span class="ll-name">Presentación y revisión con el instructor</span><span class="ll-dur">60m</span><span class="ll-check"></span></a>
        <a href="#" class="lesson-link"><span class="ll-icon">🏆</span><span class="ll-name">Entrega de certificados</span><span class="ll-dur">20m</span><span class="ll-check"></span></a>
      </div>
    </div>

  </aside>

</div><!-- /app-layout -->

<script>
  // Load YouTube video
  function loadVideo() {
    const wrapper = document.getElementById('videoWrapper');
    wrapper.innerHTML = `
      <iframe
        src="https://www.youtube.com/embed/uh3CDOYGcto?autoplay=1&controls=1&rel=0"
        frameborder="0"
        allow="autoplay; encrypted-media; fullscreen; picture-in-picture"
        allowfullscreen
        style="width:100%;height:100%;border:none;display:block;position:relative;z-index:10;">
      </iframe>`;
  }

  // Tabs
  function switchTab(btn, tabId) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tab-' + tabId).classList.add('active');
  }

  // Sidebar week toggle
  function toggleWeek(btn) {
    const week = btn.closest('.sidebar-week');
    const isOpen = week.classList.contains('open');
    document.querySelectorAll('.sidebar-week.open').forEach(w => w.classList.remove('open'));
    if (!isOpen) week.classList.add('open');
  }

  // Mark complete
  function markDone() {
    const btn = document.getElementById('completeBtn');
    btn.classList.toggle('done');
    if (btn.classList.contains('done')) {
      btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><polyline points="20,6 9,17 4,12"/></svg> Completada ✓`;
    } else {
      btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20,6 9,17 4,12"/></svg> Marcar completada`;
    }
  }

  // Transcript filter
  function filterTranscript(query) {
    const lines = document.querySelectorAll('.t-line');
    lines.forEach(line => {
      const text = line.querySelector('.t-text').textContent.toLowerCase();
      line.style.display = text.includes(query.toLowerCase()) ? 'flex' : 'none';
    });
  }

  // Notes
  function saveNote() {
    const input = document.getElementById('noteInput');
    const text = input.value.trim();
    if (!text) return;
    const container = document.getElementById('savedNotes');
    const note = document.createElement('div');
    note.className = 'saved-note';
    note.innerHTML = `<div class="sn-time">⏱ Ahora — Lección 1</div><div class="sn-text">${text}</div>`;
    container.prepend(note);
    input.value = '';
  }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    CVSession.injectNav({
      type: 'lesson',
      backHref:      'Revit.php',
      backLabel:     'Curso',
      courseTitle:   'BIM-Revit',
      lessonTitle:   'Semana 1 — Fundamentos',
      totalLessons:  20,
      currentLesson: 1,
    });
  });
</script>
</body>
</html>