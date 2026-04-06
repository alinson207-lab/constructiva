<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Constructiva — Mi Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --teal:#0aab96;--teal2:#089882;--teal3:#0d6e64;
  --teal-glow:rgba(10,171,150,.18);--teal-border:rgba(10,171,150,.22);
  --accent:#7c4fd4;--warn:#c27a00;--danger:#c43a3a;--success:#1a8a40;
  --sidebar-bg:#111c1a;--sidebar-w:260px;
  --text:#111d1c;--muted:#6b7f7d;--border:#e4e8e7;
  --surface:#f7f9f9;--surface2:#edf1f0;--white:#ffffff;
  --sh-xs:0 1px 3px rgba(0,0,0,.05);
  --sh-sm:0 2px 10px rgba(0,0,0,.06);
  --sh-md:0 8px 28px rgba(0,0,0,.09);
  --radius:14px;--radius-sm:9px;
}
html{font-size:15px;scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--surface);color:var(--text);min-height:100vh;display:flex;overflow-x:hidden}
@keyframes pulse-live{0%,100%{opacity:1}50%{opacity:.25}}

/* ── SIDEBAR ── */
.sidebar{
  width:var(--sidebar-w);min-height:100vh;
  background:var(--sidebar-bg);
  border-right:1px solid rgba(255,255,255,.05);
  display:flex;flex-direction:column;
  position:fixed;top:0;left:0;z-index:200;
  transition:transform .3s cubic-bezier(.4,0,.2,1);
}
.sb-logo{
  display:flex;align-items:center;padding:1.5rem 1.6rem 1.2rem;
  border-bottom:1px solid rgba(255,255,255,.05);
}
.sb-logo img{height:30px;width:auto}

.sb-user{
  display:flex;align-items:center;gap:.85rem;
  padding:1.1rem 1.4rem;border-bottom:1px solid rgba(255,255,255,.05);
}
.sb-av{
  width:40px;height:40px;border-radius:50%;
  background:linear-gradient(135deg,var(--teal3),var(--teal));
  display:flex;align-items:center;justify-content:center;
  font-size:1.15rem;flex-shrink:0;
  box-shadow:0 0 0 2px rgba(10,171,150,.35);
}
.sb-uname{font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;color:#e8f4f2;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sb-urole{font-size:.7rem;color:var(--teal);margin-top:.1rem}

.sb-nav{flex:1;padding:.9rem 0;overflow-y:auto}
.sb-section-lbl{
  font-size:.6rem;font-weight:700;letter-spacing:.14em;
  text-transform:uppercase;color:rgba(255,255,255,.22);
  padding:.9rem 1.5rem .35rem;
}
.nav-item{
  display:flex;align-items:center;gap:.75rem;
  padding:.58rem 1.4rem;color:rgba(255,255,255,.38);
  text-decoration:none;font-size:.83rem;font-weight:400;
  border-left:2px solid transparent;
  transition:all .15s;cursor:pointer;position:relative;
}
.nav-item:hover{color:rgba(255,255,255,.75);background:rgba(255,255,255,.04)}
.nav-item.active{
  color:#6ee8d8;border-left-color:var(--teal);
  background:rgba(10,171,150,.09);font-weight:500;
}
.nav-icon{width:18px;height:18px;display:flex;align-items:center;justify-content:center;flex-shrink:0;opacity:.7}
.nav-item.active .nav-icon{opacity:1}
.nav-badge{
  margin-left:auto;background:var(--teal);color:#0b1a18;
  font-size:.6rem;font-weight:800;font-family:'Syne',sans-serif;
  padding:.15rem .45rem;border-radius:20px;min-width:18px;text-align:center;
}
.nav-badge.warn{background:#f0c07a;color:#2a1a00}
.sb-footer{
  padding:1rem 1.4rem;border-top:1px solid rgba(255,255,255,.05);
  font-size:.68rem;color:rgba(255,255,255,.2);
}

/* ── MAIN ── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;background:var(--surface)}

/* ── TOPBAR ── */
.topbar{
  height:58px;background:var(--white);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;padding:0 2rem;gap:1rem;
  position:sticky;top:0;z-index:100;
  box-shadow:var(--sh-xs);
}
.topbar-hamburger{display:none;background:none;border:none;color:var(--muted);cursor:pointer;padding:.3rem}
.topbar-breadcrumb{font-size:.8rem;color:var(--muted)}
.topbar-breadcrumb strong{color:var(--text);font-weight:600}
.topbar-right{margin-left:auto;display:flex;align-items:center;gap:.75rem}
.top-av{
  width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,var(--teal3),var(--teal));
  display:flex;align-items:center;justify-content:center;
  font-size:.9rem;cursor:pointer;
  box-shadow:0 0 0 2px rgba(10,171,150,.25);
}

/* ── CONTENT ── */
.content{padding:2rem 2.2rem 5rem;flex:1}
.section{display:none}.section.active{display:block}

/* ── PAGE HEADER ── */
.page-header{margin-bottom:2rem}
.page-label{
  font-size:.65rem;font-weight:700;letter-spacing:.14em;
  color:var(--teal);text-transform:uppercase;margin-bottom:.4rem;
}
.page-title{
  font-family:'Syne',sans-serif;font-size:1.75rem;
  font-weight:800;line-height:1.15;color:var(--text);
}
.page-title em{font-style:normal;color:var(--teal)}
.page-sub{color:var(--muted);font-size:.84rem;margin-top:.4rem}

/* ── GRIDS ── */
.grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem}
.grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;margin-bottom:1.5rem}
.grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:1.2rem;margin-bottom:1.5rem}
.grid-dash{display:grid;grid-template-columns:2fr 1fr;gap:1.4rem;margin-bottom:1.5rem}

/* ── CARDS ── */
.card{
  background:var(--white);border:1px solid var(--border);
  border-radius:var(--radius);padding:1.4rem 1.6rem;
  box-shadow:var(--sh-xs);transition:box-shadow .2s,border-color .2s;
}
.card:hover{box-shadow:var(--sh-sm);border-color:rgba(10,171,150,.18)}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.1rem}
.card-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.9rem;color:var(--text)}
.card-link{font-size:.74rem;color:var(--teal);text-decoration:none;font-weight:500;cursor:pointer;transition:opacity .15s}
.card-link:hover{opacity:.7}

/* ── STAT CARDS ── */
.stat-card{
  background:var(--white);border:1px solid var(--border);
  border-radius:var(--radius);padding:1.2rem 1.4rem;
  display:flex;align-items:center;gap:1rem;
  box-shadow:var(--sh-xs);transition:box-shadow .2s,transform .2s;
}
.stat-card:hover{box-shadow:var(--sh-sm);transform:translateY(-1px)}
.stat-icon{
  width:48px;height:48px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.3rem;flex-shrink:0;
}
.stat-icon.teal{background:rgba(10,171,150,.1)}
.stat-icon.purple{background:rgba(124,79,212,.1)}
.stat-icon.warn{background:rgba(194,122,0,.1)}
.stat-icon.success{background:rgba(26,138,64,.1)}
.stat-num{font-family:'Syne',sans-serif;font-weight:800;font-size:1.6rem;line-height:1}
.stat-label{font-size:.71rem;color:var(--muted);margin-top:.2rem}

/* ── PROGRESS BAR ── */
.progress-bar{height:4px;background:var(--surface2);border-radius:4px;overflow:hidden;margin-top:.6rem}
.progress-fill{height:100%;background:linear-gradient(90deg,var(--teal3),var(--teal));border-radius:4px;transition:width 1s cubic-bezier(.4,0,.2,1)}
.progress-fill.purple{background:linear-gradient(90deg,#5c31a8,var(--accent))}
.progress-fill.warn{background:linear-gradient(90deg,#9a6000,var(--warn))}

/* ── COURSE ITEMS ── */
.course-item{display:flex;align-items:center;gap:1rem;padding:.9rem 0;border-bottom:1px solid var(--border)}
.course-item:last-child{border-bottom:none;padding-bottom:0}
.course-thumb{width:46px;height:46px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0}
.course-info{flex:1;min-width:0}
.course-name{font-family:'Syne',sans-serif;font-weight:700;font-size:.83rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.course-meta{font-size:.71rem;color:var(--muted);margin-top:.15rem}
.course-pct{font-family:'Syne',sans-serif;font-weight:800;font-size:.83rem;color:var(--teal);flex-shrink:0}

/* ── UPCOMING ── */
.upcoming-item{display:flex;align-items:center;gap:.9rem;padding:.75rem 0;border-bottom:1px solid var(--border)}
.upcoming-item:last-child{border-bottom:none}
.upcoming-date{min-width:42px;text-align:center;background:var(--surface);border:1px solid var(--border);border-radius:10px;padding:.4rem .5rem}
.upcoming-day{font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;line-height:1;color:var(--teal)}
.upcoming-mon{font-size:.6rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-top:.1rem}
.upcoming-info{flex:1;min-width:0}
.upcoming-title{font-weight:500;font-size:.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.upcoming-sub{font-size:.71rem;color:var(--muted);margin-top:.1rem}
.upcoming-tag{font-size:.62rem;font-weight:700;font-family:'Syne',sans-serif;padding:.22rem .6rem;border-radius:20px;flex-shrink:0}
.tag-live{background:rgba(10,171,150,.1);color:var(--teal)}
.tag-task{background:rgba(194,122,0,.1);color:var(--warn)}
.tag-exam{background:rgba(196,58,58,.1);color:var(--danger)}

/* ── BADGES ── */
.badge{display:inline-flex;align-items:center;gap:.28rem;padding:.18rem .58rem;border-radius:20px;font-size:.64rem;font-weight:700;font-family:'Syne',sans-serif}
.badge-active{background:rgba(10,171,150,.1);color:var(--teal)}
.badge-done{background:rgba(26,138,64,.1);color:var(--success)}
.badge-pending{background:rgba(194,122,0,.1);color:var(--warn)}
.badge-danger{background:rgba(196,58,58,.1);color:var(--danger)}

/* ── TABLE ── */
.data-table{width:100%;border-collapse:collapse;font-size:.82rem}
.data-table th{text-align:left;font-family:'Syne',sans-serif;font-size:.66rem;font-weight:700;letter-spacing:.09em;text-transform:uppercase;color:var(--muted);padding:.7rem 1rem;border-bottom:1px solid var(--border)}
.data-table td{padding:.75rem 1rem;border-bottom:1px solid var(--surface2)}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:var(--surface)}

/* ── CALENDAR ── */
.cal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem}
.cal-nav{display:flex;gap:.4rem}
.cal-btn{background:var(--surface);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:.35rem .7rem;cursor:pointer;font-size:.8rem;transition:all .15s}
.cal-btn:hover{border-color:var(--teal);color:var(--teal)}
.cal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:.3rem}
.cal-day-name{text-align:center;font-size:.62rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);padding:.3rem 0}
.cal-day{aspect-ratio:1;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.77rem;cursor:pointer;transition:all .15s;position:relative}
.cal-day:hover{background:var(--surface2)}
.cal-day.empty{opacity:0;pointer-events:none}
.cal-day.today{background:rgba(10,171,150,.12);color:var(--teal);font-weight:700}
.cal-day.has-task::after{content:'';width:4px;height:4px;border-radius:50%;background:var(--warn);position:absolute;bottom:3px;left:50%;transform:translateX(-50%)}
.cal-day.selected{background:var(--teal);color:#fff;font-weight:800}

/* ── BUTTONS ── */
.btn-primary{display:inline-flex;align-items:center;gap:.45rem;background:var(--teal);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;padding:.62rem 1.35rem;border-radius:100px;border:none;cursor:pointer;transition:all .18s;text-decoration:none}
.btn-primary:hover{background:var(--teal2);transform:translateY(-1px);box-shadow:0 4px 14px rgba(10,171,150,.3)}
.btn-ghost{display:inline-flex;align-items:center;gap:.45rem;background:transparent;color:var(--text);font-family:'Syne',sans-serif;font-weight:600;font-size:.82rem;padding:.6rem 1.35rem;border-radius:100px;border:1px solid var(--border);cursor:pointer;transition:all .18s}
.btn-ghost:hover{border-color:var(--teal);color:var(--teal)}

/* ── FORM ── */
.form-group{margin-bottom:1.1rem}
.form-label{font-size:.7rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--muted);display:block;margin-bottom:.4rem}
.form-input{width:100%;background:var(--surface);border:1.5px solid var(--border);border-radius:var(--radius-sm);color:var(--text);padding:.68rem 1rem;font-family:'DM Sans',sans-serif;font-size:.85rem;outline:none;transition:border-color .18s,box-shadow .18s}
.form-input:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(10,171,150,.1);background:var(--white)}
.profile-avatar-big{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--teal3),var(--teal));display:flex;align-items:center;justify-content:center;font-size:2rem;border:3px solid var(--teal-border);margin-bottom:1rem}

/* ── TABS ── */
.tab-btn{background:transparent;border:none;color:var(--muted);font-family:'DM Sans',sans-serif;font-size:.82rem;padding:.5rem .95rem;cursor:pointer;transition:all .15s;border-bottom:2px solid transparent;margin-bottom:-1px;font-weight:500}
.tab-btn.active{color:var(--teal);border-bottom-color:var(--teal)}
.tab-btn:hover{color:var(--text)}

/* ── FAQ ── */
.faq-item{border-bottom:1px solid var(--border);padding:.9rem 0}
.faq-q{font-family:'Syne',sans-serif;font-weight:700;font-size:.85rem;cursor:pointer;display:flex;justify-content:space-between;align-items:center}
.faq-q:hover{color:var(--teal)}
.faq-a{font-size:.8rem;color:var(--muted);margin-top:.6rem;line-height:1.6;display:none}
.faq-item.open .faq-a{display:block}
.faq-arrow{transition:transform .2s}
.faq-item.open .faq-arrow{transform:rotate(180deg)}

/* ── SKELETON ── */
.skeleton{background:linear-gradient(90deg,var(--surface2) 25%,var(--surface) 50%,var(--surface2) 75%);background-size:200% 100%;animation:shimmer 1.4s infinite;border-radius:8px}
@keyframes shimmer{0%{background-position:200% 0}100%{background-position:-200% 0}}
.skel-line{height:14px;margin-bottom:.5rem}
.skel-sm{width:60%}.skel-md{width:80%}.skel-full{width:100%}

/* ── REVEAL ── */
.reveal{opacity:0;transform:translateY(16px);transition:opacity .45s,transform .45s}
.reveal.visible{opacity:1;transform:none}

/* ── TOAST ── */
#toast{position:fixed;bottom:1.6rem;right:1.6rem;background:var(--sidebar-bg);color:#e8f4f2;border:1px solid rgba(10,171,150,.3);border-radius:12px;padding:.75rem 1.2rem;font-size:.82rem;font-family:'Syne',sans-serif;font-weight:600;z-index:9000;transform:translateY(80px);opacity:0;transition:all .3s cubic-bezier(.4,0,.2,1);max-width:320px;box-shadow:var(--sh-md)}
#toast.show{transform:translateY(0);opacity:1}
#toast.error{border-color:rgba(196,58,58,.4);color:#f07a7a}

/* ── RESOURCE ── */
.resource-item{display:flex;align-items:center;gap:.9rem;padding:.85rem;background:var(--surface);border:1px solid var(--border);border-radius:10px;cursor:pointer;transition:border-color .18s}
.resource-item:hover{border-color:var(--teal-border)}

/* ── RING SVG ── */
.ring-svg{flex-shrink:0}

/* ── WELCOME BANNER ── */
.welcome-banner{
  background:linear-gradient(115deg,#0b1f1d 0%,#0d3330 50%,#0a2e28 100%);
  border-radius:var(--radius);padding:2rem 2.2rem;margin-bottom:1.5rem;
  display:flex;align-items:center;justify-content:space-between;gap:1.5rem;
  position:relative;overflow:hidden;
}
.welcome-banner::before{
  content:'';position:absolute;right:-40px;top:-60px;
  width:240px;height:240px;border-radius:50%;
  background:radial-gradient(circle,rgba(10,171,150,.18) 0%,transparent 70%);
}
.welcome-banner::after{
  content:'';position:absolute;right:80px;bottom:-80px;
  width:180px;height:180px;border-radius:50%;
  background:radial-gradient(circle,rgba(10,171,150,.1) 0%,transparent 70%);
}
.wb-label{font-size:.65rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:rgba(110,232,216,.6);margin-bottom:.4rem}
.wb-title{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;color:#e8f4f2;line-height:1.2}
.wb-title em{font-style:normal;color:#6ee8d8}
.wb-date{font-size:.8rem;color:rgba(232,244,242,.4);margin-top:.4rem}
.wb-icon{font-size:3.5rem;position:relative;z-index:1;flex-shrink:0;opacity:.85}

/* ── NOTIF ITEMS ── */
.notif-item{display:flex;gap:.85rem;padding:.8rem 0;border-bottom:1px solid var(--border)}
.notif-item:last-child{border-bottom:none}
.notif-dot2{width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-top:.35rem}
.notif-dot2.teal{background:var(--teal)}
.notif-dot2.warn{background:var(--warn)}
.notif-dot2.purple{background:var(--accent)}
.notif-text{font-size:.8rem;line-height:1.5}
.notif-time{font-size:.68rem;color:var(--muted);margin-top:.15rem}

/* ── RESPONSIVE ── */
@media(max-width:1024px){
  .grid-4{grid-template-columns:repeat(2,1fr)}
  .grid-dash{grid-template-columns:1fr}
}
@media(max-width:700px){
  .sidebar{transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .main{margin-left:0}
  .topbar-hamburger{display:flex}
  .grid-4{grid-template-columns:1fr 1fr}
  .grid-2{grid-template-columns:1fr}
  .grid-3{grid-template-columns:1fr}
  .content{padding:1.4rem 1rem 4rem}
  .welcome-banner{padding:1.4rem 1.4rem}
  .wb-icon{display:none}
}
@media(max-width:480px){
  .grid-4{grid-template-columns:1fr}
}
</style>
</head>
<body>

<div id="toast"></div>

<!-- ═══════ SIDEBAR ═══════ -->
<aside class="sidebar" id="sidebar">
  <div class="sb-logo">
   <a href="/" class="sidebar-logo"><img src="/Img/Logo aqua.png" alt="" width="190 px" height="auto"><span></span></a>
  </div>
  <div class="sb-user">
    <div class="sb-av" id="sb-avatar">👤</div>
    <div>
      <div class="sb-uname" id="sb-name">Cargando...</div>
      <div class="sb-urole">Estudiante Activo</div>
    </div>
  </div>
  <nav class="sb-nav">
    <div class="sb-section-lbl">Principal</div>
    <a class="nav-item active" data-section="inicio">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg></span>
      Inicio
    </a>
    <a class="nav-item" data-section="cursos">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg></span>
      Mis Cursos
      <span class="nav-badge" id="badge-cursos">—</span>
    </a>
    <a class="nav-item" data-section="tareas">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9,11 12,14 22,4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></span>
      Tareas y Evaluaciones
      <span class="nav-badge warn" id="badge-tareas">—</span>
    </a>
    <a class="nav-item" data-section="calendario">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
      Calendario
    </a>
    <div class="sb-section-lbl">Académico</div>
    <a class="nav-item" data-section="progreso">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/></svg></span>
      Progreso Académico
    </a>
    <div class="sb-section-lbl">Comunidad</div>
    <a class="nav-item" data-section="charlas">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 10l4.553-2.069A1 1 0 0121 8.869v6.262a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg></span>
      Charlas en Vivo
      <span class="nav-badge" id="badge-charla" style="background:rgba(10,171,150,.15);color:#6ee8d8;display:none">EN VIVO</span>
    </a>
    <div class="sb-section-lbl">Cuenta</div>
    <a class="nav-item" data-section="perfil">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
      Perfil
    </a>
    <a class="nav-item" id="btn-logout" style="cursor:pointer">
      <span class="nav-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16,17 21,12 16,7"/><line x1="21" y1="12" x2="9" y2="12"/></svg></span>
      Cerrar Sesión
    </a>
  </nav>
  <div class="sb-footer">constructiva.edu.do · v2.1</div>
</aside>

<!-- ═══════ MAIN ═══════ -->
<div class="main">
  <header class="topbar">
    <button class="topbar-hamburger" id="hamburger" onclick="toggleSidebar()">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <div class="topbar-breadcrumb">constructiva / <strong><span id="breadcrumb-label">Inicio</span></strong></div>
    <div class="topbar-right">
      <div class="top-av" id="top-avatar">👤</div>
    </div>
  </header>

  <div class="content">

    <!-- ══ 1. INICIO ══ -->
    <div class="section active" id="sec-inicio">

      <div class="welcome-banner reveal visible">
        <div>
          <div class="wb-label">Panel Principal</div>
          <div class="wb-title">Bienvenido de vuelta,<br><em id="welcome-name">...</em></div>
          <div class="wb-date" id="welcome-date">Cargando...</div>
        </div>
        <div class="wb-icon">🎓</div>
      </div>

      <div class="grid-4 reveal visible" id="stats-inicio">
        <div class="stat-card"><div class="stat-icon teal">📚</div><div><div class="stat-num skeleton skel-line" style="width:40px;height:22px"></div><div class="stat-label">Cursos inscritos</div></div></div>
        <div class="stat-card"><div class="stat-icon purple">⚡</div><div><div class="stat-num skeleton skel-line" style="width:50px;height:22px"></div><div class="stat-label">Progreso total</div></div></div>
        <div class="stat-card"><div class="stat-icon warn">⏰</div><div><div class="stat-num skeleton skel-line" style="width:30px;height:22px"></div><div class="stat-label">Tareas pendientes</div></div></div>
        <div class="stat-card"><div class="stat-icon success">🏆</div><div><div class="stat-num skeleton skel-line" style="width:30px;height:22px"></div><div class="stat-label">Certificados</div></div></div>
      </div>

      <div class="grid-dash">
        <div class="card reveal visible">
          <div class="card-header">
            <div class="card-title">Mis Cursos</div>
            <a class="card-link" data-section="cursos">Ver todos →</a>
          </div>
          <div id="inicio-cursos-list">
            <div class="skeleton skel-line skel-full" style="height:46px;margin-bottom:.8rem;border-radius:10px"></div>
            <div class="skeleton skel-line skel-full" style="height:46px;border-radius:10px"></div>
          </div>
        </div>
        <div>
          <div class="card reveal visible">
            <div class="card-header">
              <div class="card-title">Próximas Tareas</div>
              <a class="card-link" data-section="tareas">Ver todas →</a>
            </div>
            <div id="inicio-tareas-list">
              <div class="skeleton skel-line skel-full" style="height:36px;margin-bottom:.5rem;border-radius:8px"></div>
              <div class="skeleton skel-line skel-md" style="height:36px;border-radius:8px"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══ 2. CURSOS ══ -->
    <div class="section" id="sec-cursos">
      <div class="page-header reveal">
        <div class="page-label">Mi Aprendizaje</div>
        <h1 class="page-title">Mis <em>Cursos</em></h1>
        <p class="page-sub" id="cursos-sub">Cargando...</p>
      </div>
      <div style="display:flex;gap:.5rem;margin-bottom:1.4rem;border-bottom:1px solid var(--border);padding-bottom:.5rem">
        <button class="tab-btn active" data-tab="activos">Cursos Activos</button>
        <button class="tab-btn" data-tab="finalizados">Finalizados</button>
        <button class="tab-btn" data-tab="certificados">Certificados</button>
      </div>
      <div id="tab-activos"><div class="grid-3" id="cursos-activos-grid"></div></div>
      <div id="tab-finalizados" style="display:none"><div class="grid-3" id="cursos-finalizados-grid"></div></div>
      <div id="tab-certificados" style="display:none"><div class="grid-3" id="cursos-certificados-grid"></div></div>
    </div>

    <!-- ══ 3. TAREAS ══ -->
    <div class="section" id="sec-tareas">
      <div class="page-header reveal">
        <div class="page-label">Gestión Académica</div>
        <h1 class="page-title">Tareas y <em>Evaluaciones</em></h1>
      </div>
      <div class="grid-4" style="margin-bottom:1.5rem" id="tareas-stats">
        <div class="stat-card"><div class="stat-icon warn">📝</div><div><div class="stat-num" id="t-pendientes" style="color:var(--warn)">—</div><div class="stat-label">Pendientes</div></div></div>
        <div class="stat-card"><div class="stat-icon success">✅</div><div><div class="stat-num" id="t-entregadas" style="color:var(--success)">—</div><div class="stat-label">Entregadas</div></div></div>
        <div class="stat-card"><div class="stat-icon teal">📊</div><div><div class="stat-num" id="t-promedio" style="color:var(--teal)">—</div><div class="stat-label">Promedio</div></div></div>
        <div class="stat-card"><div class="stat-icon purple">🏅</div><div><div class="stat-num" id="t-calificadas" style="color:var(--accent)">—</div><div class="stat-label">Calificadas</div></div></div>
      </div>
      <div class="card reveal">
        <div class="card-header"><div class="card-title">Todas las Evaluaciones</div></div>
        <table class="data-table">
          <thead><tr><th>Actividad</th><th>Curso</th><th>Vence</th><th>Estado</th><th>Calificación</th><th></th></tr></thead>
          <tbody id="tareas-tbody"></tbody>
        </table>
      </div>
    </div>

    <!-- ══ 4. CALENDARIO ══ -->
    <div class="section" id="sec-calendario">
      <div class="page-header reveal">
        <div class="page-label">Planificación</div>
        <h1 class="page-title">Calendario <em>Académico</em></h1>
      </div>
      <div class="grid-dash">
        <div class="card reveal">
          <div class="cal-header">
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1rem" id="cal-month-label">—</div>
            <div class="cal-nav">
              <button class="cal-btn" id="cal-prev">‹</button>
              <button class="cal-btn" id="cal-next">›</button>
            </div>
          </div>
          <div class="cal-grid" id="cal-grid"></div>
        </div>
        <div class="card reveal">
          <div class="card-header"><div class="card-title">Tareas del mes</div></div>
          <div id="cal-events-list"><p style="color:var(--muted);font-size:.8rem">Selecciona un mes</p></div>
        </div>
      </div>
    </div>

    <!-- ══ 5. PROGRESO ══ -->
    <div class="section" id="sec-progreso">
      <div class="page-header reveal">
        <div class="page-label">Learning Analytics</div>
        <h1 class="page-title">Progreso <em>Académico</em></h1>
      </div>
      <div class="grid-4" style="margin-bottom:1.5rem" id="progreso-stats">
        <div class="stat-card"><div class="stat-icon teal">📈</div><div><div class="stat-num" id="p-global" style="color:var(--teal)">—</div><div class="stat-label">Progreso total</div></div></div>
        <div class="stat-card"><div class="stat-icon success">⭐</div><div><div class="stat-num" id="p-promedio" style="color:var(--success)">—</div><div class="stat-label">Promedio notas</div></div></div>
        <div class="stat-card"><div class="stat-icon purple">⏱</div><div><div class="stat-num" id="p-horas" style="color:var(--accent)">—</div><div class="stat-label">Horas de estudio</div></div></div>
        <div class="stat-card"><div class="stat-icon warn">✅</div><div><div class="stat-num" id="p-actividades" style="color:var(--warn)">—</div><div class="stat-label">Actividades</div></div></div>
      </div>
      <div class="grid-3" id="progreso-rings"></div>
      <div class="card reveal">
        <div class="card-header"><div class="card-title">Historial de Calificaciones</div></div>
        <table class="data-table">
          <thead><tr><th>Actividad</th><th>Curso</th><th>Fecha</th><th>Nota</th></tr></thead>
          <tbody id="historial-tbody"></tbody>
        </table>
      </div>
      <div class="card reveal" style="margin-top:1.2rem">
        <div class="card-header"><div class="card-title">Certificados Obtenidos</div></div>
        <div id="cert-list"></div>
      </div>
    </div>

    <!-- ══ 6. PERFIL ══ -->
    <div class="section" id="sec-perfil">
      <div class="page-header reveal">
        <div class="page-label">Mi Cuenta</div>
        <h1 class="page-title">Mi <em>Perfil</em></h1>
      </div>
      <div class="grid-2">
        <div class="card reveal">
          <div class="card-title" style="margin-bottom:1.2rem">Información Personal</div>
          <div style="display:flex;align-items:center;gap:1.2rem;margin-bottom:1.5rem">
            <div class="profile-avatar-big" style="margin-bottom:0" id="perfil-emoji-big">👤</div>
            <div>
              <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem" id="perfil-fullname">...</div>
              <div style="font-size:.78rem;color:var(--teal);margin-top:.2rem" id="perfil-sub">...</div>
            </div>
          </div>
          <div class="form-group"><label class="form-label">Nombre</label><input class="form-input" type="text" id="p-nombre"/></div>
          <div class="form-group"><label class="form-label">Apellido</label><input class="form-input" type="text" id="p-apellido"/></div>
          <div class="form-group"><label class="form-label">Correo electrónico</label><input class="form-input" type="email" id="p-email"/></div>
          <div class="form-group"><label class="form-label">Profesión</label><input class="form-input" type="text" id="p-profesion"/></div>
          <div class="form-group"><label class="form-label">Ciudad / País</label><input class="form-input" type="text" id="p-ciudad"/></div>
          <div class="form-group"><label class="form-label">Emoji Avatar</label><input class="form-input" type="text" id="p-emoji" maxlength="4" style="font-size:1.4rem;width:80px"/></div>
          <div style="display:flex;gap:.7rem;flex-wrap:wrap">
            <button class="btn-primary" onclick="guardarPerfil()">Guardar cambios</button>
            <button class="btn-ghost" onclick="loadPerfil()">Cancelar</button>
          </div>
        </div>
        <div>
          <div class="card reveal" style="margin-bottom:1.2rem">
            <div class="card-title" style="margin-bottom:1rem">Seguridad</div>
            <div class="form-group"><label class="form-label">Contraseña actual</label><input class="form-input" type="password" id="pw-actual" placeholder="••••••••"/></div>
            <div class="form-group"><label class="form-label">Nueva contraseña</label><input class="form-input" type="password" id="pw-nueva" placeholder="••••••••"/></div>
            <button class="btn-primary" style="font-size:.78rem;padding:.5rem 1.1rem" onclick="cambiarPassword()">Actualizar contraseña</button>
          </div>
          <div class="card reveal">
            <div class="card-title" style="margin-bottom:1rem">Estadísticas</div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:.8rem;text-align:center">
              <div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--teal)" id="p-stat-activos">—</div><div style="font-size:.7rem;color:var(--muted)">Activos</div></div>
              <div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--success)" id="p-stat-finalizados">—</div><div style="font-size:.7rem;color:var(--muted)">Finalizados</div></div>
              <div><div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--accent)" id="p-stat-certs">—</div><div style="font-size:.7rem;color:var(--muted)">Certificados</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══ 7. CHARLAS ══ -->
    <div class="section" id="sec-charlas">
      <div class="page-header reveal">
        <div class="page-label">Comunidad</div>
        <h1 class="page-title">Charlas <em>en Vivo</em></h1>
        <p class="page-sub">Sesiones interactivas · cámara y micrófono directamente en el navegador</p>
      </div>

      <!-- PLAYER 100ms EMBEBIDO (oculto hasta unirse) -->
      <div id="hms-player-section" style="display:none;margin-bottom:1.4rem">
        <div style="background:#0f1a1a;border:1px solid rgba(239,68,68,.25);border-radius:var(--radius);overflow:hidden">
          <div style="display:flex;align-items:center;justify-content:space-between;padding:.7rem 1.2rem;background:rgba(239,68,68,.07);border-bottom:1px solid rgba(239,68,68,.12)">
            <div style="display:flex;align-items:center;gap:.5rem;font-family:'Syne',sans-serif;font-weight:700;font-size:.8rem;color:#ef4444">
              <div style="width:7px;height:7px;border-radius:50%;background:#ef4444;animation:pulse-live 1.2s infinite"></div>
              SALA ACTIVA · 100ms
            </div>
            <button onclick="salirSala100ms()" style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.25);color:#ef4444;font-family:'Syne',sans-serif;font-weight:700;font-size:.72rem;padding:.3rem .75rem;border-radius:8px;cursor:pointer">
              ✕ Salir de la sala
            </button>
          </div>
          <div id="hms-iframe-container" style="width:100%;height:520px;background:#000"></div>
        </div>
      </div>

      <div class="grid-dash">
        <div>
          <!-- CARD PROXIMA SESIÓN -->
          <div class="card reveal" style="margin-bottom:1.2rem">
            <div class="card-header">
              <div class="card-title">📡 Próxima sesión</div>
              <span id="charla-estado-badge"></span>
            </div>
            <div id="charla-proxima-body" style="color:var(--muted);font-size:.85rem">Cargando...</div>
          </div>
          <!-- HISTORIAL -->
          <div class="card reveal">
            <div class="card-header"><div class="card-title">🎬 Sesiones anteriores</div></div>
            <div id="charla-historial-list"><p style="color:var(--muted);font-size:.8rem">Cargando...</p></div>
          </div>
        </div>

        <div class="card reveal" style="height:fit-content">
          <div class="card-title" style="margin-bottom:.8rem">📡 Cómo funciona</div>
          <p style="font-size:.82rem;color:var(--muted);line-height:1.7">
            Las sesiones usan <strong style="color:var(--teal)">100ms</strong> — cámara, micrófono y chat directo en el navegador.<br><br>
            Cuando el instructor inicia la sala, aparece el botón <strong style="color:var(--teal)">Unirme</strong> automáticamente.<br><br>
            Las grabaciones quedan disponibles aquí después de cada sesión finalizada.
          </p>
          <div id="charla-link-full" style="margin-top:1rem;display:none">
            <a id="charla-link-btn-full" href="#" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:.5rem;font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;color:var(--teal);text-decoration:none;border:1px solid var(--teal-border);padding:.4rem .9rem;border-radius:100px;transition:background .15s"
               onmouseover="this.style.background='rgba(10,171,150,.08)'" onmouseout="this.style.background='transparent'">
              ↗ Abrir en ventana completa
            </a>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<script>
// ═══════════════════════════════════════════════
//  CONFIG
// ═══════════════════════════════════════════════
const API = 'Php';

// ═══════ TOAST ═══════
function toast(msg, isError=false) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'show' + (isError ? ' error' : '');
  clearTimeout(t._to);
  t._to = setTimeout(() => t.className = '', 3500);
}

// ═══════ API HELPER ═══════
async function apiFetch(endpoint, opts={}) {
  try {
    const res = await fetch(`${API}/${endpoint}`, {
      credentials: 'include',
      headers: { 'Content-Type': 'application/json', ...opts.headers },
      ...opts
    });
    const json = await res.json();
    if (!json.ok) throw new Error(json.error || 'Error desconocido');
    return json.data;
  } catch(e) {
    toast(e.message, true);
    throw e;
  }
}

// ═══════ FORMATO FECHA ═══════
function fmtDate(str) {
  if (!str) return '—';
  const d = new Date(str);
  const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
  return `${d.getDate()} ${meses[d.getMonth()]} ${d.getFullYear()}`;
}
function fmtDateShort(str) {
  if (!str) return {day:'—',mon:'—'};
  const d = new Date(str);
  const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
  return {day: d.getDate(), mon: meses[d.getMonth()]};
}
function isVencida(str) { return str && new Date(str) < new Date(); }

// ═══════ COLOR HELPERS ═══════
function courseColor(idx) {
  const palettes = [
    {bg:'rgba(10,171,150,.1)',cls:''},
    {bg:'rgba(124,79,212,.1)',cls:'purple'},
    {bg:'rgba(194,122,0,.1)',cls:'warn'},
    {bg:'rgba(26,138,64,.1)',cls:''},
  ];
  return palettes[idx % palettes.length];
}
function pctColor(idx) {
  const cols = ['var(--teal)','var(--accent)','var(--warn)','var(--success)'];
  return cols[idx % cols.length];
}
const RING_STROKES = ['var(--teal)','var(--accent)','var(--warn)','var(--success)'];

// ═══════ RENDER HELPERS ═══════
function badgeEstado(estado) {
  const map = {
    'calificada': '<span class="badge badge-done">Calificada</span>',
    'entregada':  '<span class="badge badge-active">Entregada</span>',
    'tarde':      '<span class="badge badge-active" style="color:var(--warn)">Tarde</span>',
    'vencida':    '<span class="badge badge-danger">Vencida</span>',
    'pendiente':  '<span class="badge badge-pending">Pendiente</span>',
  };
  return map[estado] || `<span class="badge">${estado}</span>`;
}

// ═══════════════════════════════════════════════
//  LOAD PERFIL
// ═══════════════════════════════════════════════
let perfilData = null;
async function loadPerfil() {
  try {
    const d = await apiFetch('perfil.php');
    perfilData = d;

    // Guard de rol: redirigir si no es estudiante
    const rol = (d.rol || '').toLowerCase().trim();
    if (rol === 'admin') { window.location.href = '/Admin.php'; return; }
    if (rol === 'instructor') { window.location.href = '/Instructor.php'; return; }

    const fullName = `${d.nombre} ${d.apellido}`;
    document.getElementById('sb-name').textContent = fullName;
    document.getElementById('sb-avatar').textContent = d.avatar_emoji || '👤';
    document.getElementById('top-avatar').textContent = d.avatar_emoji || '👤';
    document.getElementById('welcome-name').textContent = d.nombre + '.';
    const now = new Date();
    const dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
    const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
    document.getElementById('welcome-date').textContent = `${dias[now.getDay()]}, ${now.getDate()} de ${meses[now.getMonth()]} de ${now.getFullYear()}`;
    document.getElementById('perfil-emoji-big').textContent = d.avatar_emoji || '👤';
    document.getElementById('perfil-fullname').textContent = fullName;
    document.getElementById('perfil-sub').textContent = `${d.profesion||'Sin profesión'} · ${d.ciudad||'Sin ciudad'}`;
    document.getElementById('p-nombre').value = d.nombre || '';
    document.getElementById('p-apellido').value = d.apellido || '';
    document.getElementById('p-email').value = d.email || '';
    document.getElementById('p-profesion').value = d.profesion || '';
    document.getElementById('p-ciudad').value = d.ciudad || '';
    document.getElementById('p-emoji').value = d.avatar_emoji || '👤';
    document.getElementById('p-stat-activos').textContent = d.cursos_activos ?? '0';
    document.getElementById('p-stat-finalizados').textContent = d.cursos_finalizados ?? '0';
    document.getElementById('p-stat-certs').textContent = d.certificados ?? '0';
  } catch(e) {
    if (e.message === 'No autenticado' || e.message === 'Sesión inválida o expirada') {
      window.location.href = '/login';
    }
  }
}

// ═══════════════════════════════════════════════
//  LOAD CURSOS
// ═══════════════════════════════════════════════
let cursosData = null;
async function loadCursos() {
  const d = await apiFetch('cursos.php');
  cursosData = d;
  const { cursos, stats } = d;

  document.getElementById('badge-cursos').textContent = stats.activos || 0;
  document.getElementById('cursos-sub').textContent = `${stats.activos} cursos activos · ${stats.finalizados} finalizados`;

  document.getElementById('stats-inicio').innerHTML = `
    <div class="stat-card"><div class="stat-icon teal">📚</div><div><div class="stat-num" style="color:var(--teal)">${stats.total}</div><div class="stat-label">Cursos inscritos</div></div></div>
    <div class="stat-card"><div class="stat-icon purple">⚡</div><div><div class="stat-num" style="color:var(--accent)">${stats.progreso_global}%</div><div class="stat-label">Progreso total</div></div></div>
    <div class="stat-card"><div class="stat-icon warn">⏰</div><div><div class="stat-num" id="stat-pendientes-inicio" style="color:var(--warn)">—</div><div class="stat-label">Tareas pendientes</div></div></div>
    <div class="stat-card"><div class="stat-icon success">🏆</div><div><div class="stat-num" id="stat-certs-inicio" style="color:var(--success)">—</div><div class="stat-label">Certificados</div></div></div>
  `;

  const activos = cursos.filter(c => c.inscripcion_estado === 'activo').slice(0, 3);
  document.getElementById('inicio-cursos-list').innerHTML = activos.length ? activos.map((c, i) => {
    const col = courseColor(i);
    const url = `/Lecciones.php?curso=${encodeURIComponent(c.slug)}&leccion=1`;
    return `<div class="course-item" onclick="window.location='${url}'" style="cursor:pointer">
      <div class="course-thumb" style="background:${col.bg}">${c.emoji || '📚'}</div>
      <div class="course-info">
        <div class="course-name">${c.nombre}</div>
        <div class="course-meta">${c.horas_vistas}h vistas de ${c.horas_totales}h</div>
        <div class="progress-bar"><div class="progress-fill ${col.cls}" style="width:${c.progreso_pct||0}%"></div></div>
      </div>
      <div class="course-pct" style="color:${pctColor(i)}">${c.progreso_pct||0}%</div>
    </div>`;
  }).join('') : '<p style="color:var(--muted);font-size:.82rem">No tienes cursos activos.</p>';

  const activosGrid = cursos.filter(c => c.inscripcion_estado === 'activo');
  document.getElementById('cursos-activos-grid').innerHTML = activosGrid.length ? activosGrid.map((c,i) => {
    const col = courseColor(i);
    const url = `/Lecciones.php?curso=${encodeURIComponent(c.slug)}&leccion=1`;
    return `<div class="card reveal">
      <div style="height:100px;border-radius:10px;background:${col.bg};display:flex;align-items:center;justify-content:center;font-size:2.8rem;margin-bottom:1rem">${c.emoji||'📚'}</div>
      <span class="badge badge-active">● Activo</span>
      <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;margin:.6rem 0 .3rem">${c.nombre}</div>
      <div style="font-size:.77rem;color:var(--muted);margin-bottom:.8rem">${c.total_workshops} workshops · ${c.horas_totales}h</div>
      <div style="display:flex;justify-content:space-between;font-size:.74rem;color:var(--muted);margin-bottom:.3rem"><span>Progreso</span><span style="color:${pctColor(i)};font-weight:700">${c.progreso_pct||0}%</span></div>
      <div class="progress-bar"><div class="progress-fill ${col.cls}" style="width:${c.progreso_pct||0}%"></div></div>
      <div style="margin-top:1rem"><a href="${url}" class="btn-primary" style="width:100%;justify-content:center;text-decoration:none;display:flex">Continuar →</a></div>
    </div>`;
  }).join('') : '<div class="card"><p style="color:var(--muted);font-size:.82rem;text-align:center;padding:2rem">No tienes cursos activos.</p></div>';

  const finGrid = cursos.filter(c => c.inscripcion_estado === 'finalizado');
  document.getElementById('cursos-finalizados-grid').innerHTML = finGrid.length ? finGrid.map((c,i) => `
    <div class="card reveal">
      <div style="height:100px;border-radius:10px;background:var(--surface2);display:flex;align-items:center;justify-content:center;font-size:2.8rem;margin-bottom:1rem">${c.emoji||'📚'}</div>
      <span class="badge badge-done">✓ Finalizado</span>
      <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;margin:.6rem 0 .3rem">${c.nombre}</div>
      <div style="font-size:.77rem;color:var(--muted);margin-bottom:.8rem">Completado · ${fmtDate(c.fecha_inscripcion)}</div>
      ${c.certificado_codigo ? `<button class="btn-primary" style="width:100%;justify-content:center">⬇ Certificado</button>` : ''}
    </div>`).join('') : `
    <div class="card" style="grid-column:1/-1"><div style="text-align:center;padding:2.5rem;color:var(--muted)">
      <div style="font-size:2.5rem;margin-bottom:.8rem">🎉</div>
      <div style="font-family:'Syne',sans-serif;font-weight:700">Aún no has finalizado cursos</div>
      <div style="font-size:.8rem;margin-top:.4rem">¡Sigue así! Estás en camino.</div>
    </div></div>`;

  const certs = cursos.filter(c => c.certificado_codigo);
  document.getElementById('cursos-certificados-grid').innerHTML = certs.length ? certs.map(c => `
    <div class="card" style="max-width:380px">
      <div style="background:linear-gradient(135deg,#0b2e2a,#0aab96);border-radius:12px;padding:1.5rem;margin-bottom:1rem;text-align:center">
        <div style="font-size:2.5rem">🏆</div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;color:#fff;margin-top:.5rem">Certificado Digital</div>
        <div style="font-size:.78rem;color:rgba(255,255,255,.6);margin-top:.25rem">${fmtDate(c.certificado_fecha)}</div>
      </div>
      <div style="font-family:'Syne',sans-serif;font-weight:700;margin-bottom:.3rem">${c.nombre}</div>
      <div style="font-size:.77rem;color:var(--muted);margin-bottom:1rem">ID: ${c.certificado_codigo} · Nota: ${c.certificado_nota||'—'}</div>
      <button class="btn-primary">⬇ Descargar</button>
    </div>`).join('') : `<div class="card" style="grid-column:1/-1"><p style="color:var(--muted);font-size:.82rem;text-align:center;padding:2rem">Aún no tienes certificados. ¡Completa un curso!</p></div>`;

  return stats;
}

// ═══════════════════════════════════════════════
//  LOAD TAREAS
// ═══════════════════════════════════════════════
let tareasData = null;
async function loadTareas() {
  const d = await apiFetch('tareas.php');
  tareasData = d;
  const { tareas, stats } = d;

  document.getElementById('t-pendientes').textContent = stats.pendientes;
  document.getElementById('t-entregadas').textContent = stats.entregadas;
  document.getElementById('t-promedio').textContent = stats.promedio !== null ? stats.promedio : '—';
  document.getElementById('t-calificadas').textContent = stats.calificadas;
  document.getElementById('badge-tareas').textContent = stats.pendientes;

  document.getElementById('tareas-tbody').innerHTML = tareas.length ? tareas.map(t => {
    const vence = fmtDate(t.fecha_limite);
    const vencida = isVencida(t.fecha_limite) && t.estado_display === 'pendiente';
    return `<tr>
      <td><strong>${t.titulo}</strong></td>
      <td>${t.curso_emoji||''} ${t.curso_nombre}</td>
      <td style="color:${vencida ? 'var(--danger)' : isVencida(t.fecha_limite) ? 'var(--muted)' : 'var(--warn)'}">${vence}</td>
      <td>${badgeEstado(t.estado_display)}</td>
      <td style="color:var(--success);font-weight:700;font-family:'Syne',sans-serif">${t.calificacion !== null ? t.calificacion+'/'+t.puntos_max : '—'}</td>
      <td>${t.estado_display === 'pendiente' || t.estado_display === 'vencida'
        ? `<button class="btn-primary" style="padding:.35rem .9rem;font-size:.72rem" onclick="entregarTarea(${t.id})">Entregar</button>`
        : `<button class="btn-ghost" style="padding:.35rem .9rem;font-size:.72rem">Ver</button>`}</td>
    </tr>`;
  }).join('') : '<tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem">No hay tareas disponibles.</td></tr>';

  const pendientes = tareas.filter(t => t.estado_display === 'pendiente').slice(0, 3);
  document.getElementById('inicio-tareas-list').innerHTML = pendientes.length ? pendientes.map(t => {
    const fd = fmtDateShort(t.fecha_limite);
    return `<div class="upcoming-item">
      <div class="upcoming-date"><div class="upcoming-day">${fd.day}</div><div class="upcoming-mon">${fd.mon}</div></div>
      <div class="upcoming-info">
        <div class="upcoming-title">${t.titulo}</div>
        <div class="upcoming-sub">${t.curso_emoji||''} ${t.curso_nombre}</div>
      </div>
      <span class="upcoming-tag tag-task">TAREA</span>
    </div>`;
  }).join('') : '<p style="color:var(--muted);font-size:.82rem;padding:.5rem 0">¡No tienes tareas pendientes!</p>';

  const el = document.getElementById('stat-pendientes-inicio');
  if (el) el.textContent = stats.pendientes;

  calTareas = {};
  tareas.forEach(t => {
    if (t.fecha_limite) {
      const d = new Date(t.fecha_limite);
      const key = `${d.getFullYear()}-${d.getMonth()}`;
      if (!calTareas[key]) calTareas[key] = [];
      calTareas[key].push({ dia: d.getDate(), titulo: t.titulo, estado: t.estado_display });
    }
  });
  buildCalendar();
  return stats;
}

// ═══════════════════════════════════════════════
//  LOAD PROGRESO
// ═══════════════════════════════════════════════
async function loadProgreso() {
  const d = await apiFetch('progreso.php');
  const { stats, cursos, historial, certificados } = d;

  document.getElementById('p-global').textContent = stats.progreso_global + '%';
  document.getElementById('p-promedio').textContent = stats.promedio_global !== null ? stats.promedio_global : '—';
  document.getElementById('p-horas').textContent = stats.horas_totales + 'h';
  document.getElementById('p-actividades').textContent = stats.actividades_completadas;

  const elc = document.getElementById('stat-certs-inicio');
  if (elc) elc.textContent = stats.total_certificados;

  const rings = document.getElementById('progreso-rings');
  rings.innerHTML = cursos.length ? cursos.map((c, i) => {
    const stroke = RING_STROKES[i % RING_STROKES.length];
    const r = 44, circ = 2 * Math.PI * r;
    const offset = circ - (circ * (c.progreso_pct || 0) / 100);
    return `<div class="card reveal" style="text-align:center">
      <div class="card-title" style="margin-bottom:1.2rem">${c.emoji||''} ${c.nombre}</div>
      <svg width="110" height="110" viewBox="0 0 110 110">
        <circle cx="55" cy="55" r="${r}" fill="none" stroke="var(--surface2)" stroke-width="9"/>
        <circle cx="55" cy="55" r="${r}" fill="none" stroke="${stroke}" stroke-width="9"
          stroke-dasharray="${circ.toFixed(1)}" stroke-dashoffset="${offset.toFixed(1)}"
          stroke-linecap="round" transform="rotate(-90 55 55)"/>
        <text x="55" y="60" text-anchor="middle" fill="${stroke}"
          font-family="Syne,sans-serif" font-weight="800" font-size="18">${c.progreso_pct||0}%</text>
      </svg>
      <div style="font-size:.77rem;color:var(--muted);margin-top:.5rem">${c.horas_vistas}h vistas</div>
      <div style="font-size:.77rem;color:var(--muted)">Nota: <strong style="color:var(--text)">${c.nota_promedio !== null ? c.nota_promedio : '—'}</strong></div>
    </div>`;
  }).join('') : '<div class="card" style="grid-column:1/-1"><p style="color:var(--muted);text-align:center;padding:2rem">Sin datos de progreso.</p></div>';

  document.getElementById('historial-tbody').innerHTML = historial.length ? historial.map(h => `
    <tr>
      <td>${h.titulo}</td>
      <td>${h.emoji||''} ${h.curso_nombre}</td>
      <td>${fmtDate(h.calificada_en)}</td>
      <td style="color:var(--success);font-weight:700;font-family:'Syne',sans-serif">${h.calificacion}/100</td>
    </tr>`).join('') : '<tr><td colspan="4" style="text-align:center;color:var(--muted);padding:1.5rem">Sin historial aún.</td></tr>';

  document.getElementById('cert-list').innerHTML = certificados.length ? certificados.map(c => `
    <div class="course-item">
      <div class="course-thumb" style="background:rgba(26,138,64,.1);font-size:1.2rem">🏆</div>
      <div class="course-info">
        <div class="course-name">${c.emoji||''} ${c.curso_nombre}</div>
        <div class="course-meta">ID: ${c.codigo} · ${fmtDate(c.emitido_en)} · Nota: ${c.nota_final||'—'}</div>
      </div>
      <button class="btn-ghost" style="font-size:.7rem;padding:.3rem .8rem">⬇ PDF</button>
    </div>`).join('') : '<p style="color:var(--muted);font-size:.82rem;padding:.5rem 0">Aún no tienes certificados.</p>';
}

// ═══════════════════════════════════════════════
//  ENTREGAR TAREA
// ═══════════════════════════════════════════════
async function entregarTarea(id) {
  const comentario = prompt('Comentario para tu entrega (opcional):') ?? '';
  try {
    const r = await apiFetch(`tareas.php?id=${id}`, {
      method: 'POST',
      body: JSON.stringify({ comentario })
    });
    toast('✅ ' + r.mensaje);
    await loadTareas();
  } catch(e) {}
}

// ═══════════════════════════════════════════════
//  GUARDAR PERFIL
// ═══════════════════════════════════════════════
async function guardarPerfil() {
  try {
    await apiFetch('perfil.php', {
      method: 'PUT',
      body: JSON.stringify({
        nombre:       document.getElementById('p-nombre').value,
        apellido:     document.getElementById('p-apellido').value,
        email:        document.getElementById('p-email').value,
        profesion:    document.getElementById('p-profesion').value,
        ciudad:       document.getElementById('p-ciudad').value,
        avatar_emoji: document.getElementById('p-emoji').value,
      })
    });
    toast('✅ Perfil actualizado');
    await loadPerfil();
  } catch(e) {}
}

// ═══════════════════════════════════════════════
//  CAMBIAR CONTRASEÑA
// ═══════════════════════════════════════════════
async function cambiarPassword() {
  const actual = document.getElementById('pw-actual').value;
  const nueva  = document.getElementById('pw-nueva').value;
  if (!actual || !nueva) return toast('Completa ambos campos', true);
  try {
    await apiFetch('perfil.php?action=password', {
      method: 'POST',
      body: JSON.stringify({ password_actual: actual, password_nueva: nueva })
    });
    toast('✅ Contraseña actualizada. Vuelve a iniciar sesión.');
    document.getElementById('pw-actual').value = '';
    document.getElementById('pw-nueva').value = '';
  } catch(e) {}
}

// ═══════════════════════════════════════════════
//  CERRAR SESIÓN
// ═══════════════════════════════════════════════
document.getElementById('btn-logout').addEventListener('click', () => {
  document.cookie = 'cv_token=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
  window.location.href = '/login';
});

// ═══════════════════════════════════════════════
//  CALENDARIO
// ═══════════════════════════════════════════════
let calYear = new Date().getFullYear(), calMonth = new Date().getMonth();
let calTareas = {};
const MESES = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

function buildCalendar() {
  const grid = document.getElementById('cal-grid');
  if (!grid) return;
  document.getElementById('cal-month-label').textContent = MESES[calMonth] + ' ' + calYear;
  const days = ['D','L','M','M','J','V','S'];
  grid.innerHTML = days.map(d => `<div class="cal-day-name">${d}</div>`).join('');
  const firstDay = new Date(calYear, calMonth, 1).getDay();
  for(let i=0;i<firstDay;i++) grid.innerHTML += `<div class="cal-day empty"></div>`;
  const total = new Date(calYear, calMonth+1, 0).getDate();
  const today = new Date();
  const eKey = `${calYear}-${calMonth}`;
  const diasConTarea = (calTareas[eKey]||[]).map(t => t.dia);
  for(let d=1;d<=total;d++){
    let cls = 'cal-day';
    if(today.getFullYear()===calYear && today.getMonth()===calMonth && today.getDate()===d) cls+=' today';
    if(diasConTarea.includes(d)) cls+=' has-task';
    grid.innerHTML += `<div class="${cls}">${d}</div>`;
  }
  const lista = document.getElementById('cal-events-list');
  const tareasDelMes = calTareas[eKey] || [];
  lista.innerHTML = tareasDelMes.length ? tareasDelMes.map(t => `
    <div class="upcoming-item">
      <div class="upcoming-date"><div class="upcoming-day">${t.dia}</div><div class="upcoming-mon">${MESES[calMonth].slice(0,3)}</div></div>
      <div class="upcoming-info">
        <div class="upcoming-title">${t.titulo}</div>
        <div class="upcoming-sub">${badgeEstado(t.estado)}</div>
      </div>
    </div>`).join('') : '<p style="color:var(--muted);font-size:.8rem">No hay tareas este mes.</p>';

  grid.querySelectorAll('.cal-day:not(.empty)').forEach(el => {
    el.addEventListener('click', () => {
      grid.querySelectorAll('.cal-day').forEach(e=>e.classList.remove('selected'));
      el.classList.add('selected');
    });
  });
}

document.getElementById('cal-prev').addEventListener('click', () => { calMonth--; if(calMonth<0){calMonth=11;calYear--;} buildCalendar(); });
document.getElementById('cal-next').addEventListener('click', () => { calMonth++; if(calMonth>11){calMonth=0;calYear++;} buildCalendar(); });

// ═══════════════════════════════════════════════
//  NAVEGACIÓN
// ═══════════════════════════════════════════════
const sectionLabels = {
  inicio:'Inicio', cursos:'Mis Cursos', tareas:'Tareas y Evaluaciones',
  calendario:'Calendario', progreso:'Progreso Académico', perfil:'Perfil',
  charlas:'Charlas en Vivo'
};

function navigate(sectionId) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  const sec = document.getElementById('sec-' + sectionId);
  if (sec) { sec.classList.add('active'); revealAll(sec); }
  const navItem = document.querySelector(`.nav-item[data-section="${sectionId}"]`);
  if (navItem) navItem.classList.add('active');
  document.getElementById('breadcrumb-label').textContent = sectionLabels[sectionId] || sectionId;
  document.getElementById('sidebar').classList.remove('open');
  if (sectionId === 'charlas') checkCharlaLive();
}

document.querySelectorAll('.nav-item[data-section]').forEach(item => {
  item.addEventListener('click', () => navigate(item.dataset.section));
});
document.querySelectorAll('.card-link[data-section]').forEach(l => {
  l.addEventListener('click', e => { e.preventDefault(); navigate(l.dataset.section); });
});

// TABS cursos
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    ['activos','finalizados','certificados'].forEach(t => {
      const el = document.getElementById('tab-' + t);
      if(el) el.style.display = (t === btn.dataset.tab) ? 'block' : 'none';
    });
  });
});

function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('open'); }

function revealAll(container) {
  const items = container.querySelectorAll('.reveal:not(.visible)');
  items.forEach((el, i) => { setTimeout(() => el.classList.add('visible'), i * 65); });
}
revealAll(document.getElementById('sec-inicio'));

// ═══════════════════════════════════════════════
//  CHARLAS EN VIVO · 100ms
// ═══════════════════════════════════════════════
let _charlaActual = null;

async function checkCharlaLive() {
  try {
    const token = localStorage.getItem('cv_token') || '';
    const r = await fetch('/Php/charla.php', {
      credentials: 'include',
      headers: token ? { 'Authorization': 'Bearer ' + token } : {}
    });
    const j = await r.json();
    if (!j.ok) return;
    const { proxima, historial } = j.data;
    _charlaActual = proxima;

    // Badge en sidebar
    const badge = document.getElementById('badge-charla');
    if (badge && proxima?.estado === 'en_vivo') badge.style.display = 'inline-flex';

    // ── CARD PRÓXIMA ──────────────────────────────
    const proximaBody = document.getElementById('charla-proxima-body');
    if (proximaBody) {
      if (proxima) {
        const estadoBadge = document.getElementById('charla-estado-badge');
        if (estadoBadge) estadoBadge.innerHTML = proxima.estado === 'en_vivo'
          ? '<span class="badge badge-active" style="animation:none">🔴 EN VIVO</span>'
          : '<span class="badge badge-pending">Programada</span>';

        const plat = proxima.plataforma || '100ms';
        const fechaFmt = fmtDate(proxima.fecha_sesion);
        const platLabel = { zoom:'Zoom', meet:'Google Meet', teams:'Teams', '100ms':'100ms (integrado)', webex:'Webex', otro:'En línea' }[plat] || plat.toUpperCase();

        // Botón de unión según plataforma y estado
        let accionHtml = '';
        if (proxima.estado === 'en_vivo') {
          if (plat === '100ms' || (!proxima.link_reunion)) {
            // Botón 100ms embebido en dashboard
            accionHtml = `
              <button
                onclick="unirse100msDashboard('${(proxima.titulo||'').replace(/'/g,"\\'")}'  , ${proxima.id})"
                id="btn-100ms-dashboard"
                style="display:inline-flex;align-items:center;gap:.6rem;margin-top:1rem;padding:.65rem 1.4rem;border-radius:100px;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;border:none;cursor:pointer;box-shadow:0 4px 16px rgba(239,68,68,.3);transition:opacity .2s,transform .2s"
                onmouseover="this.style.opacity='.88';this.style.transform='translateY(-1px)'"
                onmouseout="this.style.opacity='1';this.style.transform='translateY(0)'"
              >
                📡 Unirme a la sesión
              </button>
              <div style="font-size:.72rem;color:var(--muted);margin-top:.4rem">Sin instalaciones · directo en el navegador</div>`;
          } else {
            accionHtml = `<a href="${proxima.link_reunion}" target="_blank" rel="noopener"
              style="display:inline-flex;align-items:center;gap:.5rem;margin-top:1rem;padding:.65rem 1.4rem;border-radius:100px;background:var(--teal);color:#0a1f1e;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;text-decoration:none">
              🎥 Unirse a ${platLabel}
            </a>`;
            // Mostrar botón ventana completa
            const fullLink = document.getElementById('charla-link-full');
            const fullBtn  = document.getElementById('charla-link-btn-full');
            if (fullLink && fullBtn) { fullBtn.href = proxima.link_reunion; fullLink.style.display = 'block'; }
          }
        } else if (proxima.estado === 'programada') {
          accionHtml = `<p style="font-size:.78rem;color:var(--muted);margin-top:.8rem">⏳ La sala abrirá cuando el instructor la inicie.</p>`;
        }

        proximaBody.innerHTML = `
          <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;margin-bottom:.3rem">${proxima.titulo}</div>
          <div style="font-size:.78rem;color:var(--muted);margin-bottom:.5rem">
            ${platLabel} · ${fechaFmt} · ${proxima.duracion_min} min
          </div>
          ${proxima.descripcion ? `<p style="font-size:.82rem;line-height:1.6;margin-bottom:.4rem;color:var(--muted)">${proxima.descripcion}</p>` : ''}
          ${accionHtml}`;
      } else {
        proximaBody.innerHTML = '<p style="font-size:.82rem;color:var(--muted)">No hay sesiones programadas por el momento.</p>';
      }
    }

    // ── HISTORIAL ─────────────────────────────────
    const histList = document.getElementById('charla-historial-list');
    if (histList) {
      const MESES_CORTOS = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
      histList.innerHTML = historial?.length ? historial.map(h => {
        const fd = new Date(h.fecha_sesion);
        return `<div class="upcoming-item">
          <div class="upcoming-date">
            <div class="upcoming-day">${fd.getDate()}</div>
            <div class="upcoming-mon">${MESES_CORTOS[fd.getMonth()]}</div>
          </div>
          <div class="upcoming-info">
            <div class="upcoming-title">${h.titulo}</div>
            <div class="upcoming-sub">${h.sesion_label || 'Sesión ' + h.sesion_numero}</div>
          </div>
          ${h.link_grabacion
            ? `<a href="${h.link_grabacion}" target="_blank" rel="noopener" class="upcoming-tag tag-live" style="text-decoration:none">▶ Ver</a>`
            : '<span class="upcoming-tag" style="color:var(--muted)">Sin grab.</span>'}
        </div>`;
      }).join('') : '<p style="color:var(--muted);font-size:.8rem">Aún no hay sesiones finalizadas.</p>';
    }
  } catch(e) { console.error('charla error', e); }
}

// ── 100ms: UNIRSE DESDE DASHBOARD ────────────────
async function unirse100msDashboard(titulo, charlaId) {
  const btn = document.getElementById('btn-100ms-dashboard');
  if (btn) { btn.disabled = true; btn.textContent = '⏳ Conectando...'; }

  try {
    const topic = `charla-${charlaId}-${titulo.replace(/\s+/g,'-').slice(0,30)}`;
    const token = localStorage.getItem('cv_token') || '';

    let userName = 'Estudiante';
    try {
      const u = JSON.parse(localStorage.getItem('cv_user') || '{}');
      if (u.nombre) userName = `${u.nombre} ${u.apellido||''}`.trim();
    } catch(_) {}

    const res = await fetch(`/Php/100ms_room.php?topic=${encodeURIComponent(topic)}&role=learner`, {
      credentials: 'include',
      headers: token ? { 'Authorization': 'Bearer ' + token } : {}
    });
    const json = await res.json();

    if (!json.ok) throw new Error(json.error || 'No se pudo obtener acceso');

    let iframeUrl = '';
    if (json.data.prebuiltUrl) {
      iframeUrl = json.data.prebuiltUrl + (json.data.prebuiltUrl.includes('?') ? '&' : '?') + `name=${encodeURIComponent(userName)}`;
    } else if (json.data.roomCode && json.data.subdomain) {
      iframeUrl = `https://${json.data.subdomain}/meeting/${json.data.roomCode}?name=${encodeURIComponent(userName)}`;
    } else {
      throw new Error('No se recibió URL válida del servidor.');
    }

    // Mostrar sección del player
    document.getElementById('hms-iframe-container').innerHTML = `
      <iframe
        title="100ms-dashboard"
        src="${iframeUrl}"
        allow="camera; microphone; display-capture; fullscreen; autoplay; clipboard-write; web-share"
        style="width:100%;height:100%;border:none;"
      ></iframe>`;
    document.getElementById('hms-player-section').style.display = 'block';

    // Badge live sidebar
    const badge = document.getElementById('badge-charla');
    if (badge) { badge.style.display = 'inline-flex'; badge.textContent = '🔴'; }

    // Scroll al player
    document.getElementById('hms-player-section').scrollIntoView({ behavior:'smooth', block:'start' });

  } catch(err) {
    if (btn) { btn.disabled = false; btn.textContent = '📡 Unirme a la sesión'; }
    console.error('100ms error:', err);
  }
}

// ── 100ms: SALIR ─────────────────────────────────
function salirSala100ms() {
  document.getElementById('hms-player-section').style.display = 'none';
  document.getElementById('hms-iframe-container').innerHTML = '';
  const btn = document.getElementById('btn-100ms-dashboard');
  if (btn) { btn.disabled = false; btn.textContent = '📡 Unirme a la sesión'; }
}

// ═══════════════════════════════════════════════
//  INIT
// ═══════════════════════════════════════════════
(async () => {
  try {
    await loadPerfil();
    await Promise.all([loadCursos(), loadTareas()]);
    await loadProgreso();
    buildCalendar();
    checkCharlaLive();
  } catch(e) {
    console.error('Error de inicialización:', e);
  }
})();
</script>
</body>
</html>