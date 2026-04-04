<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Constructiva · Instructor</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --bg:#07100f;--bg2:#0b1a18;--bg3:#0f2320;
  --surface:#f3f8f7;--surface2:#e6f0ee;--border:rgba(13,110,100,.14);
  --teal:#0d9e8e;--teal2:#0b8779;--teal3:#0d6e64;
  --accent:#7c4fd4;--warn:#b86e00;--danger:#c43a3a;--success:#1a8a40;
  --text:#0f1f1d;--muted:rgba(15,31,29,.45);
  --sidebar-w:240px;
}
html{font-size:15px}
body{font-family:'DM Sans',sans-serif;background:#fff;color:var(--text);min-height:100vh;display:flex;overflow-x:hidden}

/* SIDEBAR */
.sidebar{width:var(--sidebar-w);min-height:100vh;background:#0b1a18;border-right:1px solid rgba(93,230,212,.10);display:flex;flex-direction:column;position:fixed;top:0;left:0;z-index:100;transition:transform .3s}
.sidebar-logo{padding:1.4rem 1.4rem 1rem;font-family:'Syne',sans-serif;font-weight:800;font-size:1.2rem;color:#e8f5f3;text-decoration:none;border-bottom:1px solid rgba(93,230,212,.10);display:flex;align-items:center;gap:.5rem}
.sidebar-logo span{color:var(--teal)}
.sidebar-badge{background:rgba(124,79,212,.2);color:#b07af0;font-size:.6rem;font-weight:800;padding:.15rem .5rem;border-radius:20px;font-family:'Syne',sans-serif}
.sidebar-nav{flex:1;padding:.6rem 0;overflow-y:auto}
.nav-label{font-size:.62rem;font-weight:700;letter-spacing:.12em;color:rgba(232,245,243,.35);text-transform:uppercase;padding:.8rem 1.2rem .3rem}
.nav-item{display:flex;align-items:center;gap:.7rem;padding:.58rem 1.2rem;color:rgba(232,245,243,.45);text-decoration:none;font-size:.82rem;border-left:2px solid transparent;transition:all .15s;cursor:pointer}
.nav-item:hover{color:#e8f5f3;background:rgba(93,230,212,.05)}
.nav-item.active{color:#5de6d4;border-left-color:#5de6d4;background:rgba(93,230,212,.07);font-weight:500}
.nav-icon{width:18px;height:18px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.nav-count{margin-left:auto;background:rgba(93,230,212,.15);color:#5de6d4;font-size:.6rem;font-weight:800;padding:.1rem .4rem;border-radius:10px}
.sidebar-footer{padding:.8rem 1.2rem;border-top:1px solid rgba(93,230,212,.10);font-size:.72rem;color:rgba(232,245,243,.35)}

/* MAIN */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{height:56px;background:#0b1a18;border-bottom:1px solid rgba(93,230,212,.10);display:flex;align-items:center;padding:0 1.8rem;gap:1rem;position:sticky;top:0;z-index:50}
.topbar-burger{display:none;background:none;border:none;color:#e8f5f3;cursor:pointer}
.topbar-breadcrumb{font-family:'Syne',sans-serif;font-size:.82rem;font-weight:600;color:rgba(232,245,243,.5)}
.topbar-breadcrumb span{color:#e8f5f3}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:.7rem}
.topbar-badge{font-family:'Syne',sans-serif;font-size:.72rem;font-weight:700;color:#b07af0;background:rgba(124,79,212,.1);padding:.3rem .8rem;border-radius:20px}

/* CONTENT */
.content{padding:1.8rem;flex:1}
.section{display:none}.section.active{display:block}
.page-header{margin-bottom:1.8rem}
.page-label{font-size:.68rem;font-weight:700;letter-spacing:.12em;color:var(--teal);text-transform:uppercase;margin-bottom:.3rem}
.page-title{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;line-height:1.15}
.page-title em{font-style:italic;color:var(--teal)}
.page-sub{color:var(--muted);font-size:.82rem;margin-top:.3rem}

/* GRIDS */
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.1rem;margin-bottom:1.4rem}
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.1rem;margin-bottom:1.4rem}

/* CARDS */
.card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.3rem;transition:border-color .2s,box-shadow .2s}
.card:hover{border-color:rgba(93,230,212,.2);box-shadow:0 4px 16px rgba(0,0,0,.06)}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem}
.card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem}

/* CURSO CARD */
.curso-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;overflow:hidden;transition:border-color .2s,box-shadow .2s}
.curso-card:hover{border-color:rgba(93,230,212,.25);box-shadow:0 4px 20px rgba(0,0,0,.07)}
.curso-thumb{height:90px;display:flex;align-items:center;justify-content:center;font-size:2.6rem}
.curso-body{padding:1rem 1.1rem}
.curso-nombre{font-family:'Syne',sans-serif;font-weight:800;font-size:.92rem;margin-bottom:.3rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.curso-meta{font-size:.72rem;color:var(--muted);margin-bottom:.7rem}
.prog-bar{height:4px;background:var(--surface2);border-radius:3px;overflow:hidden;margin-bottom:.8rem}
.prog-fill{height:100%;background:linear-gradient(90deg,var(--teal3),var(--teal));border-radius:3px}
.curso-actions{display:flex;gap:.4rem}

/* STAT CARD */
.stat-card{background:var(--surface);border:1px solid var(--border);border-radius:14px;padding:1.1rem 1.3rem;display:flex;align-items:center;gap:.9rem}
.stat-icon{width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}
.stat-icon.teal{background:rgba(93,230,212,.12)}
.stat-icon.purple{background:rgba(176,122,240,.12)}
.stat-icon.warn{background:rgba(240,192,122,.12)}
.stat-icon.success{background:rgba(122,240,160,.12)}
.stat-num{font-family:'Syne',sans-serif;font-weight:800;font-size:1.4rem;line-height:1}
.stat-label{font-size:.7rem;color:var(--muted);margin-top:.15rem}

/* TABLA */
.data-table{width:100%;border-collapse:collapse;font-size:.8rem}
.data-table th{text-align:left;font-family:'Syne',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);padding:.65rem .9rem;border-bottom:1px solid var(--border)}
.data-table td{padding:.7rem .9rem;border-bottom:1px solid rgba(93,230,212,.05);vertical-align:middle}
.data-table tr:last-child td{border-bottom:none}

/* BADGES */
.badge{display:inline-flex;align-items:center;gap:.25rem;padding:.18rem .55rem;border-radius:20px;font-size:.62rem;font-weight:700;font-family:'Syne',sans-serif}
.b-active{background:rgba(93,230,212,.12);color:var(--teal)}
.b-done{background:rgba(122,240,160,.12);color:var(--success)}
.b-pending{background:rgba(240,192,122,.12);color:var(--warn)}
.b-danger{background:rgba(240,122,122,.12);color:var(--danger)}

/* BUTTONS */
.btn{display:inline-flex;align-items:center;gap:.4rem;font-family:'Syne',sans-serif;font-weight:700;font-size:.75rem;padding:.5rem 1rem;border-radius:100px;border:none;cursor:pointer;transition:all .15s;text-decoration:none}
.btn-primary{background:var(--teal);color:#07100f}
.btn-primary:hover{background:var(--teal2);transform:translateY(-1px)}
.btn-ghost{background:transparent;color:var(--text);border:1px solid var(--border)}
.btn-ghost:hover{border-color:var(--teal);color:var(--teal)}
.btn-live{background:rgba(239,68,68,.1);color:#f07a7a;border:1px solid rgba(239,68,68,.25)}
.btn-live:hover{background:rgba(239,68,68,.2)}
.btn-sm{padding:.32rem .7rem;font-size:.7rem}

/* TOAST */
#toast{position:fixed;bottom:1.4rem;right:1.4rem;background:#0b1a18;color:#e8f5f3;border:1px solid rgba(93,230,212,.3);border-radius:10px;padding:.65rem 1.1rem;font-size:.8rem;font-family:'Syne',sans-serif;font-weight:600;z-index:9000;transform:translateY(60px);opacity:0;transition:all .3s;max-width:300px}
#toast.show{transform:translateY(0);opacity:1}
#toast.err{border-color:rgba(196,58,58,.4);color:#f07a7a}

/* EMPTY */
.empty{text-align:center;padding:2.5rem 1rem;color:var(--muted)}
.empty-icon{font-size:2rem;margin-bottom:.6rem}
.empty-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.9rem;color:var(--text);margin-bottom:.3rem}

@media(max-width:700px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.topbar-burger{display:flex}.grid-3{grid-template-columns:1fr 1fr}.grid-2{grid-template-columns:1fr}}
</style>
</head>
<body>

<div id="toast"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <a href="/" class="sidebar-logo">
    constructiva<span>.</span>
    <span class="sidebar-badge">INSTRUCTOR</span>
  </a>
  <nav class="sidebar-nav">
    <div class="nav-label">Mi Panel</div>
    <a class="nav-item active" data-section="mis-cursos">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></span>
      Mis Cursos
      <span class="nav-count" id="cnt-mis-cursos">—</span>
    </a>
    <div class="nav-label">En Vivo</div>
    <a class="nav-item" data-section="charlas">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.869v6.262a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg></span>
      Charlas en Vivo
    </a>
    <div class="nav-label">Académico</div>
    <a class="nav-item" data-section="estudiantes">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></span>
      Mis Estudiantes
    </a>
    <div class="nav-label">Cuenta</div>
    <a class="nav-item" id="btn-logout" style="cursor:pointer">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span>
      Cerrar sesión
    </a>
  </nav>
  <div class="sidebar-footer" id="sidebar-footer">constructiva.edu.do · Instructor</div>
</aside>

<!-- MAIN -->
<div class="main">
  <header class="topbar">
    <button class="topbar-burger" onclick="toggleSidebar()">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <div class="topbar-breadcrumb">constructiva<span> / <span id="breadcrumb">Mis Cursos</span></span></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="instructor-name">Instructor</span>
    </div>
  </header>

  <div class="content">

    <!-- ══ MIS CURSOS ══ -->
    <div class="section active" id="sec-mis-cursos">
      <div class="page-header">
        <div class="page-label">Panel Instructor</div>
        <h1 class="page-title">Mis <em>Cursos</em></h1>
        <p class="page-sub" id="cursos-sub">Cursos donde eres instructor asignado</p>
      </div>

      <!-- Stats -->
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.6rem" id="inst-stats">
        <div class="stat-card"><div class="stat-icon teal">📚</div><div><div class="stat-num" id="st-cursos" style="color:var(--teal)">—</div><div class="stat-label">Cursos asignados</div></div></div>
        <div class="stat-card"><div class="stat-icon purple">👥</div><div><div class="stat-num" id="st-estudiantes" style="color:var(--accent)">—</div><div class="stat-label">Estudiantes totales</div></div></div>
        <div class="stat-card"><div class="stat-icon warn">📡</div><div><div class="stat-num" id="st-charlas" style="color:var(--warn)">—</div><div class="stat-label">Charlas programadas</div></div></div>
      </div>

      <!-- Grid de cursos -->
      <div class="grid-3" id="grid-mis-cursos">
        <div class="card" style="grid-column:1/-1;text-align:center;padding:2.5rem;color:var(--muted)">
          <div style="font-size:1.8rem;margin-bottom:.5rem">⏳</div>
          Cargando tus cursos...
        </div>
      </div>
    </div>

    <!-- ══ CHARLAS ══ -->
    <div class="section" id="sec-charlas">
      <div class="page-header">
        <div class="page-label">En Vivo · 100ms</div>
        <h1 class="page-title">Charlas <em>en Vivo</em></h1>
        <p class="page-sub">Selecciona el curso para gestionar sus sesiones en vivo</p>
      </div>
      <div class="grid-3" id="charlas-grid">
        <div class="card" style="grid-column:1/-1;text-align:center;padding:2rem;color:var(--muted)">Cargando...</div>
      </div>
    </div>

    <!-- ══ ESTUDIANTES ══ -->
    <div class="section" id="sec-estudiantes">
      <div class="page-header">
        <div class="page-label">Académico</div>
        <h1 class="page-title">Mis <em>Estudiantes</em></h1>
        <p class="page-sub">Estudiantes inscritos en tus cursos</p>
      </div>
      <div class="card">
        <table class="data-table">
          <thead><tr><th>Estudiante</th><th>Curso</th><th>Progreso</th><th>Estado</th></tr></thead>
          <tbody id="tbody-estudiantes">
            <tr><td colspan="4" style="text-align:center;color:var(--muted);padding:2rem">Cargando...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<script>
// ══════════════════════════════════════════════
//  CONFIG
// ══════════════════════════════════════════════
const API = '/Php';
let misCursos = [];

function toast(msg, err=false) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'show' + (err ? ' err' : '');
  clearTimeout(t._t);
  t._t = setTimeout(() => t.className='', 3500);
}

async function apiFetch(ep, opts={}) {
  const token = localStorage.getItem('cv_token') || '';
  const res = await fetch(`${API}/${ep}`, {
    credentials: 'include',
    headers: { 'Content-Type':'application/json', 'Authorization': token ? 'Bearer '+token : '', ...opts.headers },
    ...opts
  });
  const json = await res.json();
  if (!json.ok) throw new Error(json.error || 'Error');
  return json.data;
}

function fmtDate(s) {
  if (!s) return '—';
  return new Date(s).toLocaleDateString('es-DO',{day:'2-digit',month:'short',year:'numeric'});
}

// ══════════════════════════════════════════════
//  NAV
// ══════════════════════════════════════════════
const LABELS = { 'mis-cursos':'Mis Cursos', charlas:'Charlas en Vivo', estudiantes:'Mis Estudiantes' };

function navigate(id) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item[data-section]').forEach(n => n.classList.remove('active'));
  document.getElementById('sec-'+id)?.classList.add('active');
  document.querySelector(`.nav-item[data-section="${id}"]`)?.classList.add('active');
  document.getElementById('breadcrumb').textContent = LABELS[id] || id;
  document.getElementById('sidebar').classList.remove('open');
  if (id === 'charlas')      renderCharlasGrid();
  if (id === 'estudiantes')  loadEstudiantes();
}

document.querySelectorAll('.nav-item[data-section]').forEach(n => {
  n.addEventListener('click', () => navigate(n.dataset.section));
});

function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); }

// ══════════════════════════════════════════════
//  CARGAR PERFIL DEL INSTRUCTOR
// ══════════════════════════════════════════════
async function loadPerfil() {
  try {
    const d = await apiFetch('perfil.php');
    // Verificar que sea instructor
    if (d.rol !== 'instructor' && d.rol !== 'admin') {
      window.location.href = '/dashboard';
      return null;
    }
    const nombre = `${d.nombre} ${d.apellido}`;
    document.getElementById('instructor-name').textContent = nombre;
    document.getElementById('sidebar-footer').textContent  = nombre + ' · Instructor';
    return d;
  } catch(e) {
    window.location.href = '/login';
    return null;
  }
}

// ══════════════════════════════════════════════
//  CARGAR MIS CURSOS (donde soy instructor)
// ══════════════════════════════════════════════
async function loadMisCursos() {
  try {
    const perfil = await apiFetch('perfil.php');
    const instructorId = perfil.id;

    // Usar endpoint de instructor (no requiere rol admin)
    // Filtramos los cursos donde el usuario es instructor asignado
    const token = localStorage.getItem('cv_token') || '';
    const res = await fetch(`/Php/cursos_instructor.php`, {
      credentials: 'include',
      headers: { 'Authorization': token ? 'Bearer ' + token : '' }
    });
    const json = await res.json();

    if (!json.ok) throw new Error(json.error || 'Error al cargar cursos');
    misCursos = json.data.cursos || [];

    // Stats
    const totalEstudiantes = misCursos.reduce((s, c) => s + (parseInt(c.total_inscritos)||0), 0);
    document.getElementById('st-cursos').textContent      = misCursos.length;
    document.getElementById('st-estudiantes').textContent = totalEstudiantes;
    document.getElementById('cnt-mis-cursos').textContent = misCursos.length;
    document.getElementById('cursos-sub').textContent     = `${misCursos.length} curso${misCursos.length !== 1 ? 's' : ''} asignado${misCursos.length !== 1 ? 's' : ''}`;

    // Conteo de charlas
    try {
      const ch = await apiFetch('charla.php');
      const proxima = ch.proxima;
      document.getElementById('st-charlas').textContent = proxima ? '1+' : '0';
    } catch(_) { document.getElementById('st-charlas').textContent = '—'; }

    // Render grid
    const grid = document.getElementById('grid-mis-cursos');
    if (!misCursos.length) {
      grid.innerHTML = `<div class="card" style="grid-column:1/-1">
        <div class="empty">
          <div class="empty-icon">📭</div>
          <div class="empty-title">Sin cursos asignados</div>
          <p style="font-size:.8rem">Pídele al administrador que te asigne como instructor en un curso.</p>
        </div>
      </div>`;
      return;
    }

    grid.innerHTML = misCursos.map((c, i) => {
      const colors = ['rgba(93,230,212,.1)','rgba(176,122,240,.1)','rgba(240,192,122,.1)','rgba(122,240,160,.1)'];
      const bg = c.color_hex ? c.color_hex + '18' : colors[i % colors.length];
      return `<div class="curso-card">
        <div class="curso-thumb" style="background:${bg}">${c.emoji||'📚'}</div>
        <div class="curso-body">
          <div class="curso-nombre" title="${c.nombre}">${c.nombre}</div>
          <div class="curso-meta">${c.total_inscritos||0} estudiantes · ${c.total_workshops||0} workshops · ${c.horas_totales||0}h</div>
          <div class="prog-bar"><div class="prog-fill" style="width:${c.progreso_promedio||0}%"></div></div>
          <div class="curso-actions">
            <a href="/Charla-admin.php?curso=${encodeURIComponent(c.slug)}"
               class="btn btn-live btn-sm" style="flex:1;justify-content:center">
              📡 Charlas
            </a>
            <a href="/Lecciones.php?curso=${encodeURIComponent(c.slug)}&leccion=1"
               class="btn btn-ghost btn-sm" style="flex:1;justify-content:center">
              Ver →
            </a>
          </div>
        </div>
      </div>`;
    }).join('');

  } catch(e) {
    toast('Error al cargar cursos: ' + e.message, true);
    document.getElementById('grid-mis-cursos').innerHTML = `
      <div class="card" style="grid-column:1/-1;text-align:center;padding:2rem;color:var(--muted)">
        <div style="font-size:1.5rem;margin-bottom:.5rem">⚠️</div>
        ${e.message}
      </div>`;
  }
}

// ══════════════════════════════════════════════
//  RENDER CHARLAS GRID
// ══════════════════════════════════════════════
function renderCharlasGrid() {
  const grid = document.getElementById('charlas-grid');
  if (!misCursos.length) {
    grid.innerHTML = `<div class="card" style="grid-column:1/-1">
      <div class="empty"><div class="empty-icon">📭</div><div class="empty-title">Sin cursos asignados</div></div>
    </div>`;
    return;
  }
  grid.innerHTML = misCursos.map(c => `
    <div class="card" style="display:flex;flex-direction:column;gap:.8rem">
      <div style="display:flex;align-items:center;gap:.8rem">
        <div style="width:44px;height:44px;border-radius:10px;background:rgba(93,230,212,.1);display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0">${c.emoji||'📚'}</div>
        <div style="flex:1;min-width:0">
          <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:.88rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">${c.nombre}</div>
          <div style="font-size:.7rem;color:var(--muted)">${c.total_inscritos||0} estudiantes</div>
        </div>
      </div>
      <a href="/Charla-admin.php?curso=${encodeURIComponent(c.slug)}"
         class="btn btn-live" style="width:100%;justify-content:center;text-align:center">
        📡 Gestionar charlas
      </a>
    </div>`).join('');
}

// ══════════════════════════════════════════════
//  ESTUDIANTES
// ══════════════════════════════════════════════
async function loadEstudiantes() {
  const tbody = document.getElementById('tbody-estudiantes');
  try {
    if (!misCursos.length) {
      tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;color:var(--muted);padding:1.5rem">Sin cursos asignados</td></tr>';
      return;
    }
    // Usar endpoint de instructor para obtener estudiantes
    const token = localStorage.getItem('cv_token') || '';
    const res = await fetch('/Php/cursos_instructor.php?include_students=1', {
      credentials: 'include',
      headers: { 'Authorization': token ? 'Bearer ' + token : '' }
    });
    const json = await res.json();
    if (!json.ok) throw new Error(json.error);

    const filas = json.data.estudiantes || [];
    if (!filas.length) {
      tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;color:var(--muted);padding:1.5rem">No hay estudiantes inscritos aún</td></tr>';
      return;
    }
    tbody.innerHTML = filas.map(f => `
      <tr>
        <td>
          <div style="display:flex;align-items:center;gap:.6rem">
            <div style="width:30px;height:30px;border-radius:50%;background:rgba(93,230,212,.1);display:flex;align-items:center;justify-content:center;font-size:.85rem">${f.avatar_emoji||'👤'}</div>
            <div>
              <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem">${f.nombre} ${f.apellido}</div>
              <div style="font-size:.68rem;color:var(--muted)">${f.email}</div>
            </div>
          </div>
        </td>
        <td style="font-size:.78rem">${f.curso_nombre}</td>
        <td>
          <div style="display:flex;align-items:center;gap:.5rem">
            <div style="flex:1;height:4px;background:var(--surface2);border-radius:3px;overflow:hidden;max-width:80px">
              <div style="height:100%;background:var(--teal);width:${f.progreso||0}%"></div>
            </div>
            <span style="font-size:.72rem;font-weight:700;color:var(--teal)">${f.progreso||0}%</span>
          </div>
        </td>
        <td><span class="badge ${f.estado==='activo'?'b-active':'b-pending'}">${f.estado}</span></td>
      </tr>`).join('');
  } catch(e) {
    tbody.innerHTML = `<tr><td colspan="4" style="text-align:center;color:var(--muted);padding:1.5rem">Error: ${e.message}</td></tr>`;
  }
}

// ══════════════════════════════════════════════
//  LOGOUT
// ══════════════════════════════════════════════
document.getElementById('btn-logout').addEventListener('click', async () => {
  try {
    await fetch('/Php/logout.php', { method:'POST', credentials:'include' });
  } catch(_) {}
  localStorage.removeItem('cv_token');
  localStorage.removeItem('cv_user');
  document.cookie = 'cv_token=;expires=Thu,01 Jan 1970 00:00:00 GMT;path=/';
  window.location.href = '/login';
});

// ══════════════════════════════════════════════
//  INIT
// ══════════════════════════════════════════════
(async () => {
  const perfil = await loadPerfil();
  if (!perfil) return;
  await loadMisCursos();
})();
</script>
</body>
</html>