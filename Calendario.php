<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Calendario | Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <script src="/Js/cv-session.js"></script>
  <style>
    :root{
      --teal:#0aab96;--teal2:#089882;--teal-lt:rgba(10,171,150,.1);--teal-bdr:rgba(10,171,150,.22);
      --bg:#0a1614;--bg2:#0f1f1d;--surface:#1a2e2b;
      --white:#ffffff;--page-bg:#f7f9f9;--card-bg:#ffffff;
      --border:#e4e8e7;--text:#111d1c;--muted:#8a9a97;
      --danger:#c43a3a;--warn:#c27a00;--success:#1a8a40;--accent:#7c4fd4;
      --type-live:#e03e3e;--type-workshop:#0aab96;--type-charla:#7c4fd4;--type-especial:#c27a00;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    body{background:var(--page-bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;flex-direction:column}

    .bar{height:58px;background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 2rem;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:0 1px 4px rgba(0,0,0,.05)}
    .bar img{height:28px}
    .bar-r{display:flex;align-items:center;gap:.8rem}
    .bar-lnk{display:flex;align-items:center;gap:.35rem;color:var(--muted);text-decoration:none;font-size:.82rem;font-weight:500;padding:.3rem .75rem;border-radius:8px;transition:all .15s}
    .bar-lnk:hover{background:#f0f2f1;color:var(--text)}

    .hero{background:linear-gradient(115deg,#0b1f1d 0%,#0d3330 55%,#0a2e28 100%);padding:3rem 2.4rem 2.5rem;position:relative;overflow:hidden}
    .hero::before{content:'';position:absolute;right:-60px;top:-80px;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(10,171,150,.18) 0%,transparent 70%)}
    .hero-label{font-size:.65rem;font-weight:700;letter-spacing:.14em;color:rgba(110,232,216,.6);text-transform:uppercase;margin-bottom:.4rem}
    .hero-title{font-family:'Syne',sans-serif;font-size:2rem;font-weight:800;color:#e8f4f2;line-height:1.2;margin-bottom:.5rem}
    .hero-title em{font-style:normal;color:#6ee8d8}
    .hero-sub{font-size:.88rem;color:rgba(232,244,242,.45);max-width:480px;line-height:1.6}
    .hero-login-note{margin-top:1rem;display:inline-flex;align-items:center;gap:.5rem;background:rgba(10,171,150,.12);border:1px solid rgba(10,171,150,.22);border-radius:100px;padding:.35rem .9rem;font-size:.75rem;color:#6ee8d8}

    .page-wrap{display:grid;grid-template-columns:1fr 340px;gap:1.6rem;padding:2rem 2.4rem 5rem;max-width:1400px;margin:0 auto;width:100%}

    .cal-card{background:var(--card-bg);border:1px solid var(--border);border-radius:16px;padding:1.6rem;box-shadow:0 2px 10px rgba(0,0,0,.05)}
    .cal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.4rem}
    .cal-mes{font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;color:var(--text)}
    .cal-nav{display:flex;gap:.4rem}
    .cal-btn{background:#f0f2f1;border:1px solid var(--border);border-radius:8px;color:var(--text);padding:.38rem .75rem;cursor:pointer;font-size:.82rem;transition:all .15s}
    .cal-btn:hover{border-color:var(--teal);color:var(--teal)}
    .cal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:.3rem}
    .cal-day-name{text-align:center;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);padding:.3rem 0}
    .cal-day{
      border-radius:9px;display:flex;flex-direction:column;
      align-items:flex-start;justify-content:flex-start;
      font-size:.78rem;cursor:pointer;transition:all .15s;
      position:relative;padding:.35rem .4rem;min-height:64px;
    }
    .cal-day:hover{background:#f0f2f1}
    .cal-day.empty{opacity:0;pointer-events:none}
    .cal-day.today{background:var(--teal-lt);color:var(--teal);font-weight:700;border:1px solid var(--teal-bdr)}
    .cal-day.selected{background:var(--teal);color:#fff;font-weight:800}
    .cal-day.selected .cal-ev-nombre{color:#fff;background:rgba(255,255,255,.2)}
    .cal-day.has-event{font-weight:600}
    .cal-day-num{font-size:.78rem;font-weight:700;line-height:1;margin-bottom:.2rem}
    .cal-ev-nombre{
      font-size:.56rem;line-height:1.2;
      border-radius:3px;padding:.1rem .3rem;
      width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
      display:block;margin-bottom:.1rem;
    }
    .cal-ev-mas{font-size:.54rem;color:var(--muted);margin-top:.1rem}
    .cal-day.selected .cal-ev-mas{color:rgba(255,255,255,.7)}

    .legend{display:flex;flex-wrap:wrap;gap:.6rem;margin-top:1rem;padding-top:1rem;border-top:1px solid var(--border)}
    .legend-item{display:flex;align-items:center;gap:.35rem;font-size:.72rem;color:var(--muted)}
    .legend-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}

    .eventos-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
    .eventos-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.9rem;color:var(--text)}

    .evento-item{background:var(--card-bg);border:1px solid var(--border);border-radius:12px;padding:1.1rem 1.3rem;margin-bottom:.8rem;transition:all .18s;cursor:pointer;border-left:3px solid transparent}
    .evento-item:hover{box-shadow:0 4px 16px rgba(0,0,0,.08);transform:translateY(-1px)}
    .evento-item.live{border-left-color:var(--type-live)}
    .evento-item.workshop{border-left-color:var(--type-workshop)}
    .evento-item.charla{border-left-color:var(--type-charla)}
    .evento-item.especial{border-left-color:var(--type-especial)}
    .evento-item.locked{border-left-color:var(--muted);opacity:.75}

    .evento-top{display:flex;align-items:flex-start;justify-content:space-between;gap:.8rem;margin-bottom:.5rem}
    .evento-titulo{font-family:'Syne',sans-serif;font-weight:700;font-size:.9rem;color:var(--text)}
    .evento-badge{font-size:.6rem;font-weight:700;font-family:'Syne',sans-serif;padding:.18rem .55rem;border-radius:20px;flex-shrink:0}
    .badge-live{background:rgba(224,62,62,.1);color:var(--type-live)}
    .badge-workshop{background:rgba(10,171,150,.1);color:var(--type-workshop)}
    .badge-charla{background:rgba(124,79,212,.1);color:var(--type-charla)}
    .badge-especial{background:rgba(194,122,0,.1);color:var(--type-especial)}
    .badge-locked{background:rgba(138,154,151,.1);color:var(--muted)}

    .evento-meta{display:flex;align-items:center;gap:.8rem;flex-wrap:wrap;margin-bottom:.5rem}
    .evento-meta-item{display:flex;align-items:center;gap:.3rem;font-size:.75rem;color:var(--muted)}
    .evento-meta-item svg{color:var(--teal);flex-shrink:0}
    .evento-desc{font-size:.8rem;color:var(--muted);line-height:1.5;margin-bottom:.7rem}
    .evento-curso{display:inline-flex;align-items:center;gap:.3rem;font-size:.72rem;background:var(--teal-lt);color:var(--teal);border:1px solid var(--teal-bdr);border-radius:20px;padding:.18rem .6rem}

    .btn-link{display:inline-flex;align-items:center;gap:.4rem;background:var(--teal);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.75rem;padding:.42rem 1rem;border-radius:100px;border:none;cursor:pointer;transition:all .18s;text-decoration:none;margin-top:.4rem}
    .btn-link:hover{background:var(--teal2);transform:translateY(-1px)}
    .btn-locked{display:inline-flex;align-items:center;gap:.4rem;background:#f0f2f1;color:var(--muted);font-family:'Syne',sans-serif;font-weight:600;font-size:.75rem;padding:.42rem 1rem;border-radius:100px;border:1px solid var(--border);margin-top:.4rem;cursor:not-allowed}

    .mini-card{background:var(--card-bg);border:1px solid var(--border);border-radius:14px;padding:1.3rem;margin-bottom:1.2rem;box-shadow:0 1px 4px rgba(0,0,0,.04)}
    .mini-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.85rem;color:var(--text);margin-bottom:.9rem;display:flex;align-items:center;gap:.4rem}

    .prox-item{display:flex;gap:.8rem;padding:.65rem 0;border-bottom:1px solid var(--border)}
    .prox-item:last-child{border-bottom:none;padding-bottom:0}
    .prox-date{min-width:40px;text-align:center;background:#f7f9f9;border-radius:8px;padding:.35rem .4rem;flex-shrink:0}
    .prox-day{font-family:'Syne',sans-serif;font-weight:800;font-size:.95rem;line-height:1;color:var(--teal)}
    .prox-mon{font-size:.58rem;color:var(--muted);text-transform:uppercase;letter-spacing:.04em}
    .prox-name{font-size:.8rem;font-weight:500;color:var(--text);line-height:1.3}
    .prox-sub{font-size:.7rem;color:var(--muted);margin-top:.1rem}

    .empty{text-align:center;padding:2.5rem 1rem;color:var(--muted)}
    .empty-icon{font-size:2.5rem;margin-bottom:.6rem;opacity:.5}
    .empty-text{font-size:.83rem}

    .ld{display:flex;align-items:center;justify-content:center;min-height:200px}
    .sp{width:28px;height:28px;border:2.5px solid var(--border);border-top-color:var(--teal);border-radius:50%;animation:spi .7s linear infinite}
    @keyframes spi{to{transform:rotate(360deg)}}

    @media(max-width:960px){.page-wrap{grid-template-columns:1fr;padding:1.4rem 1rem 4rem}}
    @media(max-width:480px){.bar{padding:0 1.2rem}.hero{padding:2rem 1.2rem 2rem}}
  </style>
</head>
<body>

<header class="bar">
  <a href="/"><img src="/Img/Logo aqua.png" alt="Constructiva"></a>
  <div class="bar-r">
    <a href="/" class="bar-lnk">Inicio</a>
    <a href="/live" class="bar-lnk">🔴 Live</a>
    <a href="/dashboard" class="bar-lnk" id="bar-dashboard" style="display:none">Mi Espacio</a>
    <a href="/login" class="bar-lnk" id="bar-login" style="display:none">Iniciar sesión</a>
  </div>
</header>

<div class="hero">
  <div class="hero-label">Constructiva Experience</div>
  <h1 class="hero-title">Calendario de <em>Eventos</em></h1>
  <p class="hero-sub">Workshops, charlas en vivo, eventos especiales y más. Mantente al día con todo lo que sucede.</p>
  <div id="hero-note"></div>
</div>

<div class="page-wrap">
  <div>
    <div class="cal-card" style="margin-bottom:1.4rem">
      <div class="cal-header">
        <div class="cal-mes" id="cal-mes-label">—</div>
        <div class="cal-nav">
          <button class="cal-btn" id="cal-prev">‹</button>
          <button class="cal-btn" id="cal-next">›</button>
        </div>
      </div>
      <div class="cal-grid" id="cal-grid"><div class="ld"><div class="sp"></div></div></div>
      <div class="legend">
        <div class="legend-item"><div class="legend-dot" style="background:var(--type-live)"></div>Live YouTube</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--type-workshop)"></div>Workshop</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--type-charla)"></div>Charla en vivo</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--type-especial)"></div>Evento especial</div>
        <div class="legend-item"><div class="legend-dot" style="background:var(--muted)"></div>Solo inscritos</div>
      </div>
    </div>

    <div>
      <div class="eventos-header">
        <div class="eventos-title" id="eventos-list-title">Todos los eventos</div>
      </div>
      <div id="eventos-list"><div class="ld"><div class="sp"></div></div></div>
    </div>
  </div>

  <div class="sidebar-right">
    <div class="mini-card">
      <div class="mini-title">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        Próximos eventos
      </div>
      <div id="proximos-list"><div class="ld" style="min-height:80px"><div class="sp"></div></div></div>
    </div>

    <div class="mini-card">
      <div class="mini-title">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
        Filtrar por tipo
      </div>
      <div style="display:flex;flex-direction:column;gap:.4rem" id="filtros">
        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer">
          <input type="checkbox" value="todos" id="f-todos" checked onchange="filtrarTipo()" style="accent-color:var(--teal)"> Todos
        </label>
        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer">
          <input type="checkbox" value="live" onchange="filtrarTipo()" style="accent-color:var(--type-live)">
          <span style="color:var(--type-live)">●</span> Live YouTube
        </label>
        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer">
          <input type="checkbox" value="workshop" onchange="filtrarTipo()" style="accent-color:var(--type-workshop)">
          <span style="color:var(--type-workshop)">●</span> Workshop
        </label>
        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer">
          <input type="checkbox" value="charla" onchange="filtrarTipo()" style="accent-color:var(--type-charla)">
          <span style="color:var(--type-charla)">●</span> Charla en vivo
        </label>
        <label style="display:flex;align-items:center;gap:.5rem;font-size:.82rem;cursor:pointer">
          <input type="checkbox" value="especial" onchange="filtrarTipo()" style="accent-color:var(--type-especial)">
          <span style="color:var(--type-especial)">●</span> Evento especial
        </label>
      </div>
    </div>
  </div>
</div>

<script>
const MESES = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
const MESES_C = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
const DIAS = ['D','L','M','M','J','V','S'];
const TIPO_LABELS = { live:'Live', workshop:'Workshop', charla:'Charla', especial:'Especial' };
const TIPO_ICONS  = { live:'🔴', workshop:'🏗️', charla:'📡', especial:'⭐' };
const TIPO_COLORS = { live:'var(--type-live)', workshop:'var(--type-workshop)', charla:'var(--type-charla)', especial:'var(--type-especial)' };

let calYear  = new Date().getFullYear();
let calMonth = new Date().getMonth();
let selectedDay = null;
let todosEventos = [];
let filtrosTipos = ['todos'];

const user = CVSession?.getUser?.();
if (user) {
  const db = document.getElementById('bar-dashboard');
  if (db) db.style.display = 'flex';
} else {
  const bl = document.getElementById('bar-login');
  if (bl) bl.style.display = 'flex';
  const note = document.getElementById('hero-note');
  if (note) note.innerHTML = `
    <div class="hero-login-note">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      Inicia sesión para ver eventos exclusivos de tu curso
    </div>`;
}

async function cargarEventos() {
  try {
    const token = localStorage.getItem('cv_token') || '';
    const headers = token ? { Authorization: 'Bearer ' + token } : {};
    const r = await fetch(`/Php/eventos.php?mes=${calMonth+1}&anio=${calYear}`, { headers });
    const j = await r.json();
    if (!j.ok) return;
    todosEventos = j.data.eventos;
    buildCalendar();
    renderEventos(todosEventos);
    renderProximos();
  } catch(e) { console.error(e); }
}

function buildCalendar() {
  const grid = document.getElementById('cal-grid');
  document.getElementById('cal-mes-label').textContent = MESES[calMonth] + ' ' + calYear;

  const eventosPorDia = {};
  todosEventos.forEach(ev => {
    const d = new Date(ev.fecha_inicio);
    if (d.getMonth() === calMonth && d.getFullYear() === calYear) {
      const dia = d.getDate();
      if (!eventosPorDia[dia]) eventosPorDia[dia] = [];
      eventosPorDia[dia].push(ev);
    }
  });

  let html = DIAS.map(d => `<div class="cal-day-name">${d}</div>`).join('');
  const firstDay = new Date(calYear, calMonth, 1).getDay();
  for (let i = 0; i < firstDay; i++) html += `<div class="cal-day empty"></div>`;

  const total = new Date(calYear, calMonth + 1, 0).getDate();
  const today = new Date();

  for (let d = 1; d <= total; d++) {
    const isToday = today.getFullYear() === calYear && today.getMonth() === calMonth && today.getDate() === d;
    const isSel   = selectedDay === d;
    const evs     = eventosPorDia[d] || [];

    let cls = 'cal-day';
    if (isToday) cls += ' today';
    if (isSel)   cls += ' selected';
    if (evs.length) cls += ' has-event';

    // Nombre del primer evento
    let eventosHtml = '';
    if (evs.length > 0) {
      const ev1 = evs[0];
      const color = ev1.tiene_acceso ? TIPO_COLORS[ev1.tipo] : 'var(--muted)';
      const bgColor = ev1.tiene_acceso ? `rgba(${ev1.tipo === 'live' ? '224,62,62' : ev1.tipo === 'workshop' ? '10,171,150' : ev1.tipo === 'charla' ? '124,79,212' : '194,122,0'},.1)` : 'rgba(138,154,151,.1)';
      eventosHtml += `<span class="cal-ev-nombre" style="color:${color};background:${bgColor}">${ev1.titulo}</span>`;
      if (evs.length > 1) {
        eventosHtml += `<span class="cal-ev-mas">+${evs.length - 1} más</span>`;
      }
    }

    html += `<div class="${cls}" data-day="${d}">
      <span class="cal-day-num">${d}</span>
      ${eventosHtml}
    </div>`;
  }

  grid.innerHTML = html;

  grid.querySelectorAll('.cal-day:not(.empty)').forEach(el => {
    el.addEventListener('click', () => {
      selectedDay = selectedDay === +el.dataset.day ? null : +el.dataset.day;
      buildCalendar();
      const filtered = selectedDay
        ? todosEventos.filter(ev => {
            const d = new Date(ev.fecha_inicio);
            return d.getDate() === selectedDay && d.getMonth() === calMonth && d.getFullYear() === calYear;
          })
        : todosEventos;
      document.getElementById('eventos-list-title').textContent = selectedDay
        ? `Eventos del ${selectedDay} de ${MESES[calMonth]}`
        : 'Todos los eventos';
      renderEventos(filtered);
    });
  });
}

function renderEventos(evs) {
  const el = document.getElementById('eventos-list');
  let filtrados = evs;
  if (!filtrosTipos.includes('todos') && filtrosTipos.length > 0) {
    filtrados = evs.filter(ev => filtrosTipos.includes(ev.tipo));
  }
  if (!filtrados.length) {
    el.innerHTML = `<div class="empty"><div class="empty-icon">📅</div><div class="empty-text">${selectedDay ? 'No hay eventos este día.' : 'No hay eventos este mes.'}</div></div>`;
    return;
  }
  el.innerHTML = filtrados.map(ev => {
    const fi = new Date(ev.fecha_inicio);
    const hora = fi.toLocaleTimeString('es-DO', { hour:'2-digit', minute:'2-digit' });
    const fecha = `${fi.getDate()} ${MESES_C[fi.getMonth()]} ${fi.getFullYear()}`;
    const badgeCls = ev.tiene_acceso ? `badge-${ev.tipo}` : 'badge-locked';
    const badgeLbl = ev.tiene_acceso ? TIPO_LABELS[ev.tipo] : '🔒 Solo inscritos';
    let btnHtml = '';
    if (ev.link && ev.tiene_acceso) {
      btnHtml = `<a href="${ev.link}" target="_blank" rel="noopener" class="btn-link">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
        Unirse
      </a>`;
    } else if (!ev.tiene_acceso) {
      btnHtml = `<span class="btn-locked">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
        Inscríbete para acceder
      </span>`;
    }
    return `<div class="evento-item ${ev.tiene_acceso ? ev.tipo : 'locked'}">
      <div class="evento-top">
        <div class="evento-titulo">${TIPO_ICONS[ev.tipo]} ${ev.titulo}</div>
        <span class="evento-badge ${badgeCls}">${badgeLbl}</span>
      </div>
      <div class="evento-meta">
        <div class="evento-meta-item">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          ${fecha}
        </div>
        <div class="evento-meta-item">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          ${hora}
        </div>
      </div>
      ${ev.descripcion ? `<p class="evento-desc">${ev.descripcion}</p>` : ''}
      ${ev.curso_nombre ? `<div class="evento-curso">${ev.curso_emoji || '📚'} ${ev.curso_nombre}</div>` : ''}
      ${btnHtml}
    </div>`;
  }).join('');
}

function renderProximos() {
  const el = document.getElementById('proximos-list');
  const ahora = new Date();
  const proximos = todosEventos.filter(ev => new Date(ev.fecha_inicio) >= ahora).slice(0, 5);
  if (!proximos.length) {
    el.innerHTML = `<p style="font-size:.78rem;color:var(--muted)">No hay eventos próximos.</p>`;
    return;
  }
  el.innerHTML = proximos.map(ev => {
    const d = new Date(ev.fecha_inicio);
    return `<div class="prox-item">
      <div class="prox-date">
        <div class="prox-day">${d.getDate()}</div>
        <div class="prox-mon">${MESES_C[d.getMonth()]}</div>
      </div>
      <div class="prox-info">
        <div class="prox-name">${ev.titulo}</div>
        <div class="prox-sub">${TIPO_ICONS[ev.tipo]} ${TIPO_LABELS[ev.tipo]} · ${d.toLocaleTimeString('es-DO',{hour:'2-digit',minute:'2-digit'})}</div>
      </div>
    </div>`;
  }).join('');
}

function filtrarTipo() {
  const todos = document.getElementById('f-todos');
  const checks = document.querySelectorAll('#filtros input[type=checkbox]:not(#f-todos)');
  if (event?.target?.id === 'f-todos' && todos.checked) {
    checks.forEach(c => c.checked = false);
    filtrosTipos = ['todos'];
  } else {
    todos.checked = false;
    filtrosTipos = Array.from(checks).filter(c => c.checked).map(c => c.value);
    if (!filtrosTipos.length) { todos.checked = true; filtrosTipos = ['todos']; }
  }
  const evs = selectedDay
    ? todosEventos.filter(ev => {
        const d = new Date(ev.fecha_inicio);
        return d.getDate() === selectedDay && d.getMonth() === calMonth && d.getFullYear() === calYear;
      })
    : todosEventos;
  renderEventos(evs);
}

document.getElementById('cal-prev').addEventListener('click', () => {
  calMonth--; if (calMonth < 0) { calMonth = 11; calYear--; }
  selectedDay = null;
  document.getElementById('eventos-list-title').textContent = 'Todos los eventos';
  cargarEventos();
});
document.getElementById('cal-next').addEventListener('click', () => {
  calMonth++; if (calMonth > 11) { calMonth = 0; calYear++; }
  selectedDay = null;
  document.getElementById('eventos-list-title').textContent = 'Todos los eventos';
  cargarEventos();
});

cargarEventos();
</script>
</body>
</html>