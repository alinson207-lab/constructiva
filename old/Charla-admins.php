<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gestionar Charla · Admin · Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
  <!--
    =====================================================
    UBICACIÓN: /charla-admin.html  (raíz del proyecto)
    RUTAS CORREGIDAS:
      API   → php/charla.php   ✅
      Atrás → Admin.php        ✅
      Logo  → index.php        ✅
    =====================================================
  -->
  <style>
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    :root {
      --teal-deep:  #0a2e2e; --teal-mid:#0d4a46; --teal-vivid:#12796e;
      --mint:       #10b09e; --mint-light:#5de6d4;
      --bg:         #0f1a1a; --bg-panel:#111f1f; --bg-card:#162424;
      --border:     rgba(93,230,212,.1); --border-soft:rgba(93,230,212,.06);
      --text-white: #f0faf9; --text-muted:#5a8a86; --text-body:#8ab8b4;
      --red:        #ef4444; --red-soft:rgba(239,68,68,.1);
    }
    html { scroll-behavior:smooth; }
    body { font-family:'DM Sans',sans-serif; background:var(--bg); color:var(--text-white); overflow-x:hidden; min-height:100vh; }

    /* NAV */
    .topnav { position:fixed; top:0; left:0; right:0; z-index:200; height:56px; background:rgba(10,30,30,.96); border-bottom:1px solid var(--border); backdrop-filter:blur(16px); display:flex; align-items:center; padding:0 1.5rem; gap:1rem; }
    .topnav-left { display:flex; align-items:center; gap:1rem; flex:1; min-width:0; }
    .back-btn { display:flex; align-items:center; gap:.4rem; color:var(--text-body); text-decoration:none; font-size:.82rem; font-weight:500; padding:.3rem .7rem; border-radius:8px; border:1px solid var(--border); transition:color .2s,border-color .2s,background .2s; flex-shrink:0; }
    .back-btn:hover { color:var(--mint-light); border-color:var(--mint); background:rgba(93,230,212,.05); }
    .nav-label { font-size:.82rem; color:var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .nav-label strong { color:var(--text-body); font-weight:500; }
    .sep { color:var(--border); margin:0 .2rem; }
    .topnav-center { flex:2; display:flex; justify-content:center; }
    .nav-logo { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:var(--teal-vivid); text-decoration:none; letter-spacing:-.02em; }
    .nav-logo span { color:var(--mint); }
    .topnav-right { display:flex; align-items:center; gap:.8rem; flex:1; justify-content:flex-end; }
    .admin-pill { display:flex; align-items:center; gap:.4rem; background:rgba(93,230,212,.08); border:1px solid var(--border); border-radius:100px; padding:.3rem .8rem; font-size:.72rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:var(--mint-light); }
    .live-badge { display:none; align-items:center; gap:.4rem; background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.3); border-radius:100px; padding:.3rem .8rem; font-size:.75rem; font-weight:700; text-transform:uppercase; color:#f87171; }
    .live-badge.show { display:flex; }
    .live-dot { width:6px; height:6px; border-radius:50%; background:#ef4444; animation:blink 1.2s infinite; }
    @keyframes blink { 0%,100%{opacity:1}50%{opacity:.3} }
    .new-btn { display:flex; align-items:center; gap:.5rem; background:var(--mint); color:var(--teal-deep); font-family:'Syne',sans-serif; font-weight:700; font-size:.8rem; padding:.4rem 1rem; border-radius:100px; border:none; cursor:pointer; transition:background .2s,transform .2s; }
    .new-btn:hover { background:var(--mint-light); transform:translateY(-1px); }

    /* PAGE */
    .page-wrap { padding-top:56px; min-height:100vh; display:flex; flex-direction:column; }

    /* HERO */
    .hero { position:relative; overflow:hidden; padding:3rem 2rem 2.5rem; display:flex; flex-direction:column; align-items:center; text-align:center; background:linear-gradient(180deg,var(--teal-deep) 0%,var(--bg) 100%); border-bottom:1px solid var(--border); }
    .hero::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 20% 50%,rgba(93,230,212,.12),transparent 55%),radial-gradient(circle at 80% 30%,rgba(24,176,160,.08),transparent 50%); }
    .hero::after  { content:''; position:absolute; inset:0; background-image:linear-gradient(rgba(93,230,212,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(93,230,212,.03) 1px,transparent 1px); background-size:48px 48px; }
    .hero-inner { position:relative; z-index:1; max-width:660px; }
    .hero-tag { display:inline-flex; align-items:center; gap:.5rem; background:rgba(93,230,212,.08); border:1px solid rgba(93,230,212,.2); border-radius:100px; padding:.3rem 1rem; font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--mint-light); margin-bottom:1rem; }
    .hero-title { font-family:'Syne',sans-serif; font-weight:800; font-size:clamp(1.5rem,3vw,2.4rem); line-height:1.1; letter-spacing:-.04em; color:var(--text-white); margin-bottom:.6rem; }
    .hero-title span { color:var(--mint); }
    .hero-desc { font-size:.9rem; color:var(--text-body); line-height:1.7; font-weight:300; }

    /* STATS */
    .stats-bar { display:flex; gap:1px; background:var(--border); border-bottom:1px solid var(--border); }
    .stat-item { flex:1; padding:1rem 1.5rem; background:var(--bg-panel); text-align:center; }
    .stat-num { font-family:'Syne',sans-serif; font-weight:800; font-size:1.6rem; color:var(--text-white); }
    .stat-num.accent { color:var(--mint); }
    .stat-label { font-size:.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:.08em; margin-top:.2rem; }

    /* GRID */
    .main-grid { display:grid; grid-template-columns:1fr 360px; flex:1; }
    .left-col { border-right:1px solid var(--border); padding:2.5rem; }
    .sidebar { background:var(--bg-panel); border-left:1px solid var(--border); padding:2rem 1.6rem; }

    /* SECTION LABEL */
    .sec-label { font-family:'Syne',sans-serif; font-weight:800; font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; color:var(--mint); margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .sec-label::after { content:''; flex:1; height:1px; background:var(--border-soft); }

    /* CHARLA CARD */
    .charla-card { background:var(--bg-card); border:1px solid var(--border); border-radius:20px; overflow:hidden; margin-bottom:2rem; }
    .card-head { padding:1.5rem 1.8rem 1.2rem; border-bottom:1px solid var(--border-soft); display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; }
    .sess-label { font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--mint); margin-bottom:.4rem; }
    .card-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.15rem; color:var(--text-white); line-height:1.25; }
    .head-right { display:flex; flex-direction:column; align-items:flex-end; gap:.5rem; }
    .badge { flex-shrink:0; display:flex; align-items:center; gap:.35rem; padding:.3rem .8rem; border-radius:100px; font-size:.72rem; font-weight:700; letter-spacing:.05em; text-transform:uppercase; }
    .badge-upcoming { background:rgba(251,191,36,.1); border:1px solid rgba(251,191,36,.25); color:#fbbf24; }
    .badge-live     { background:rgba(239,68,68,.1);  border:1px solid rgba(239,68,68,.25);  color:#f87171; }
    .badge-done     { background:rgba(93,230,212,.08); border:1px solid var(--border); color:var(--text-muted); }
    .badge-dot { width:5px; height:5px; border-radius:50%; background:currentColor; }
    .badge-live .badge-dot { animation:blink 1.2s infinite; }
    .admin-acts { display:flex; gap:.4rem; }
    .act-btn { display:flex; align-items:center; gap:.3rem; padding:.3rem .7rem; border-radius:8px; border:1px solid var(--border); background:transparent; color:var(--text-muted); font-size:.78rem; cursor:pointer; transition:color .2s,border-color .2s,background .2s; font-family:'DM Sans',sans-serif; }
    .act-btn:hover { color:var(--mint-light); border-color:var(--mint); background:rgba(93,230,212,.05); }
    .act-btn.danger:hover { color:#f87171; border-color:var(--red); background:var(--red-soft); }

    .card-meta { display:flex; flex-wrap:wrap; gap:.8rem 1.5rem; padding:1rem 1.8rem; border-bottom:1px solid var(--border-soft); }
    .meta-item { display:flex; align-items:center; gap:.4rem; font-size:.8rem; color:var(--text-muted); }
    .meta-item svg { color:var(--mint); }
    .meta-item strong { color:var(--text-body); }
    .card-body { padding:1.4rem 1.8rem; }
    .card-desc { font-size:.9rem; color:var(--text-body); line-height:1.75; font-weight:300; margin-bottom:1.4rem; }

    /* LINK ROW */
    .link-row { display:flex; align-items:center; gap:.7rem; background:var(--bg-panel); border:1px solid var(--border); border-radius:12px; padding:.75rem 1rem; margin-bottom:1rem; }
    .link-icon { font-size:1.1rem; flex-shrink:0; }
    .link-url { font-size:.8rem; color:var(--mint-light); font-family:monospace; flex:1; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    .link-acts { display:flex; gap:.4rem; flex-shrink:0; }
    .link-btn { display:flex; align-items:center; gap:.3rem; padding:.3rem .7rem; border-radius:8px; border:1px solid var(--border); background:transparent; color:var(--text-muted); font-size:.75rem; cursor:pointer; transition:all .2s; font-family:'DM Sans',sans-serif; text-decoration:none; }
    .link-btn:hover { color:var(--mint-light); border-color:var(--mint); background:rgba(93,230,212,.05); }

    /* GRABACION */
    .rec-row { display:flex; gap:.6rem; margin-top:.8rem; }
    .rec-input { flex:1; background:var(--bg-card); border:1px solid var(--border); border-radius:10px; padding:.6rem .9rem; font-family:'DM Sans',sans-serif; font-size:.85rem; color:var(--text-white); outline:none; transition:border-color .2s; }
    .rec-input:focus { border-color:var(--mint); }
    .rec-input::placeholder { color:var(--text-muted); }
    .rec-save { background:var(--mint); color:var(--teal-deep); font-family:'Syne',sans-serif; font-weight:700; font-size:.8rem; padding:.6rem 1rem; border-radius:10px; border:none; cursor:pointer; transition:background .2s; white-space:nowrap; }
    .rec-save:hover { background:var(--mint-light); }

    /* EMPTY */
    .empty-state { text-align:center; padding:3rem 2rem; background:var(--bg-card); border:1px solid var(--border); border-radius:20px; margin-bottom:2rem; }
    .empty-icon  { font-size:2.5rem; margin-bottom:1rem; }
    .empty-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:var(--text-white); margin-bottom:.5rem; }
    .empty-desc  { font-size:.88rem; color:var(--text-muted); line-height:1.6; margin-bottom:1.5rem; }
    .empty-cta   { display:inline-flex; align-items:center; gap:.5rem; background:var(--mint); color:var(--teal-deep); font-family:'Syne',sans-serif; font-weight:700; font-size:.88rem; padding:.65rem 1.4rem; border-radius:12px; border:none; cursor:pointer; }
    .empty-cta:hover { background:var(--mint-light); }

    /* AGENDA */
    .agenda-list { display:flex; flex-direction:column; gap:.5rem; margin-bottom:2rem; }
    .agenda-item { display:flex; align-items:flex-start; gap:1rem; padding:.9rem 1.1rem; border-radius:12px; background:var(--bg-card); border:1px solid var(--border-soft); }
    .agenda-time { font-family:'Syne',sans-serif; font-weight:700; font-size:.75rem; color:var(--mint); flex-shrink:0; min-width:52px; padding-top:.1rem; }
    .agenda-text strong { font-family:'Syne',sans-serif; font-weight:700; font-size:.85rem; color:var(--text-white); display:block; margin-bottom:.2rem; }
    .agenda-text span { font-size:.8rem; color:var(--text-muted); }

    /* SESSION ROWS */
    .sess-list { display:flex; flex-direction:column; gap:.6rem; }
    .sess-row { display:flex; align-items:center; gap:.8rem; padding:.8rem 1rem; border-radius:12px; background:var(--bg-card); border:1px solid var(--border-soft); transition:border-color .2s; }
    .sess-row:hover { border-color:var(--border); }
    .sess-row.current { border-color:var(--mint); background:rgba(93,230,212,.04); }
    .sess-n { width:32px; height:32px; flex-shrink:0; border-radius:8px; background:rgba(93,230,212,.08); border:1px solid var(--border-soft); display:flex; align-items:center; justify-content:center; font-family:'Syne',sans-serif; font-weight:800; font-size:.72rem; color:var(--mint); }
    .sess-info { flex:1; min-width:0; }
    .sess-tit  { font-size:.85rem; color:var(--text-white); font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .sess-date { font-size:.7rem; color:var(--text-muted); margin-top:.15rem; }
    .sess-acts { display:flex; gap:.3rem; flex-shrink:0; }
    .sess-btn { width:28px; height:28px; border-radius:7px; display:flex; align-items:center; justify-content:center; border:1px solid var(--border); background:transparent; color:var(--text-muted); cursor:pointer; font-size:.8rem; transition:all .2s; }
    .sess-btn:hover { border-color:var(--mint); color:var(--mint-light); background:rgba(93,230,212,.06); }
    .sess-btn.del:hover { border-color:var(--red); color:#f87171; background:var(--red-soft); }

    /* COUNTDOWN */
    .cd-card { background:var(--bg-card); border:1px solid var(--border); border-radius:16px; padding:1.4rem; margin-bottom:1.8rem; text-align:center; }
    .cd-label { font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--text-muted); margin-bottom:1rem; }
    .cd-row { display:flex; justify-content:center; gap:.5rem; }
    .cd-unit { text-align:center; }
    .cd-num  { font-family:'Syne',sans-serif; font-weight:800; font-size:2rem; color:var(--text-white); background:var(--bg-panel); border:1px solid var(--border); border-radius:10px; padding:.3rem .6rem; min-width:52px; display:block; }
    .cd-sep  { font-family:'Syne',sans-serif; font-weight:800; font-size:1.8rem; color:var(--mint); padding-top:.25rem; align-self:flex-start; }
    .cd-sub  { font-size:.6rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; margin-top:.3rem; display:block; }

    /* QUICK INFO */
    .qi-list { display:flex; flex-direction:column; gap:.6rem; margin-bottom:1.8rem; }
    .qi-item { display:flex; align-items:center; gap:.8rem; padding:.75rem 1rem; border-radius:10px; background:var(--bg-card); border:1px solid var(--border-soft); }
    .qi-icon { width:32px; height:32px; border-radius:8px; flex-shrink:0; background:rgba(93,230,212,.08); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-size:.9rem; }
    .qi-lbl  { font-size:.7rem; color:var(--text-muted); }
    .qi-val  { font-size:.85rem; color:var(--text-white); font-weight:500; }

    /* MODAL */
    .overlay { position:fixed; inset:0; z-index:500; background:rgba(0,0,0,.75); backdrop-filter:blur(8px); display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .25s; }
    .overlay.open { opacity:1; pointer-events:all; }
    .modal { background:var(--bg-panel); border:1px solid var(--border); border-radius:20px; padding:2rem; width:min(520px,92vw); transform:translateY(14px); transition:transform .25s; position:relative; max-height:90vh; overflow-y:auto; }
    .overlay.open .modal { transform:translateY(0); }
    .modal::-webkit-scrollbar { width:4px; }
    .modal::-webkit-scrollbar-thumb { background:var(--border); border-radius:4px; }
    .modal-close { position:absolute; top:1rem; right:1rem; background:var(--bg-card); border:1px solid var(--border); color:var(--text-muted); width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; cursor:pointer; font-size:1.1rem; transition:color .2s; }
    .modal-close:hover { color:var(--text-white); }
    .modal-title { font-family:'Syne',sans-serif; font-weight:800; font-size:1.1rem; color:var(--text-white); margin-bottom:.3rem; }
    .modal-sub   { font-size:.85rem; color:var(--text-muted); margin-bottom:1.5rem; }
    .form-grid   { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    .field { }
    .f-label { font-size:.72rem; font-weight:700; letter-spacing:.07em; text-transform:uppercase; color:var(--mint); display:block; margin-bottom:.45rem; }
    .f-input, .f-select, .f-textarea { width:100%; background:var(--bg-card); border:1px solid var(--border); border-radius:10px; padding:.7rem 1rem; font-family:'DM Sans',sans-serif; font-size:.9rem; color:var(--text-white); outline:none; transition:border-color .2s; }
    .f-input:focus, .f-select:focus, .f-textarea:focus { border-color:var(--mint); }
    .f-input::placeholder, .f-textarea::placeholder { color:var(--text-muted); }
    .f-textarea { resize:vertical; min-height:80px; }
    .f-select { appearance:none; cursor:pointer; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%235a8a86' stroke-width='2'%3E%3Cpolyline points='6,9 12,15 18,9'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 1rem center; }
    .f-select option { background:var(--bg-panel); }
    .modal-foot { display:flex; gap:.8rem; justify-content:flex-end; margin-top:1.5rem; border-top:1px solid var(--border-soft); padding-top:1.2rem; }
    .btn-cancel { padding:.6rem 1.2rem; border-radius:10px; background:transparent; border:1px solid var(--border); color:var(--text-muted); font-family:'DM Sans',sans-serif; font-size:.88rem; cursor:pointer; transition:color .2s; }
    .btn-cancel:hover { color:var(--text-white); }
    .btn-save { padding:.65rem 1.5rem; border-radius:10px; background:var(--mint); color:var(--teal-deep); font-family:'Syne',sans-serif; font-weight:700; font-size:.88rem; border:none; cursor:pointer; transition:background .2s,transform .2s; }
    .btn-save:hover { background:var(--mint-light); transform:translateY(-1px); }

    /* TOAST */
    .toast { position:fixed; bottom:1.5rem; left:50%; transform:translateX(-50%) translateY(12px); background:var(--bg-card); border:1px solid var(--mint); border-radius:12px; padding:.75rem 1.4rem; display:flex; align-items:center; gap:.6rem; font-size:.85rem; color:var(--mint-light); font-weight:500; z-index:999; opacity:0; pointer-events:none; transition:opacity .25s,transform .25s; }
    .toast.show { opacity:1; transform:translateX(-50%) translateY(0); }
    .toast.err { border-color:var(--red); color:#f87171; }

    @media(max-width:900px) {
      .main-grid { grid-template-columns:1fr; }
      .sidebar { border-left:none; border-top:1px solid var(--border); }
      .topnav-center { display:none; }
      .left-col { padding:1.5rem; }
      .form-grid { grid-template-columns:1fr; }
      .stats-bar { flex-wrap:wrap; }
    }
  </style>
</head>
<body>

<nav class="topnav">
  <div class="topnav-left">
    <!-- ✅ Ruta correcta a Admin.php en la raíz -->
    <a href="/admin" class="back-btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Admin
    </a>
    <span class="nav-label">Panel <span class="sep">/</span> <strong>Charlas en Vivo</strong></span>
  </div>
  <div class="topnav-center">
    <!-- ✅ Ruta correcta a index.php en la raíz -->
    <a href="/" class="nav-logo">constructiva<span>.</span></a>
  </div>
  <div class="topnav-right">
    <div class="live-badge" id="liveBadge"><span class="live-dot"></span> En Vivo</div>
    <div class="admin-pill">
      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      Admin
    </div>
    <button class="new-btn" onclick="openModal()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Nueva sesión
    </button>
  </div>
</nav>

<div class="page-wrap">
  <div class="hero">
    <div class="hero-inner">
      <div class="hero-tag">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Panel de Administración
      </div>
      <h1 class="hero-title">Gestionar <span>Charlas</span></h1>
      <p class="hero-desc">Configura el enlace de reunión, fecha y plataforma. Los estudiantes ven la información automáticamente.</p>
    </div>
  </div>

  <div class="stats-bar">
    <div class="stat-item"><div class="stat-num accent" id="stat-total">—</div><div class="stat-label">Sesiones totales</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-prog">—</div><div class="stat-label">Programadas</div></div>
    <div class="stat-item"><div class="stat-num" id="stat-fin">—</div><div class="stat-label">Finalizadas</div></div>
  </div>

  <div class="main-grid">
    <div class="left-col">
      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13,2 3,14 12,14 11,22 21,10 12,10"/></svg>
        Próxima sesión activa
      </div>

      <div id="loadArea" style="background:var(--bg-card);border:1px solid var(--border);border-radius:20px;height:180px;display:flex;align-items:center;justify-content:center;margin-bottom:2rem;">
        <div style="text-align:center"><div style="font-size:1.5rem;margin-bottom:.5rem">⏳</div><div style="font-size:.85rem;color:var(--text-muted)">Cargando sesiones...</div></div>
      </div>

      <div id="charlaBox" style="display:none"></div>

      <div id="agendaBox" style="display:none">
        <div class="sec-label">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
          Agenda de la sesión
        </div>
        <div class="agenda-list">
          <div class="agenda-item"><div class="agenda-time">0:00</div><div class="agenda-text"><strong>Bienvenida y revisión de dudas</strong><span>Resolveremos preguntas pendientes de las lecciones grabadas</span></div></div>
          <div class="agenda-item"><div class="agenda-time">0:15</div><div class="agenda-text"><strong>Desarrollo del tema principal</strong><span>Práctica en vivo con ejemplos reales</span></div></div>
          <div class="agenda-item"><div class="agenda-time">0:50</div><div class="agenda-text"><strong>Revisión de proyectos de participantes</strong><span>Análisis de modelos enviados por estudiantes</span></div></div>
          <div class="agenda-item"><div class="agenda-time">1:15</div><div class="agenda-text"><strong>Preguntas abiertas y cierre</strong><span>Espacio libre para consultas</span></div></div>
        </div>
      </div>

      <div id="allSessBox" style="display:none">
        <div class="sec-label">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Todas las sesiones
        </div>
        <div class="sess-list" id="sessList"></div>
      </div>
    </div>

    <div class="sidebar">
      <div id="cdSection" style="display:none">
        <div class="sec-label">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
          Próxima sesión
        </div>
        <div class="cd-card">
          <div class="cd-label">Faltan para la sesión</div>
          <div class="cd-row">
            <div class="cd-unit"><span class="cd-num" id="cd-d">--</span><span class="cd-sub">Días</span></div>
            <div class="cd-sep">:</div>
            <div class="cd-unit"><span class="cd-num" id="cd-h">--</span><span class="cd-sub">Horas</span></div>
            <div class="cd-sep">:</div>
            <div class="cd-unit"><span class="cd-num" id="cd-m">--</span><span class="cd-sub">Mins</span></div>
          </div>
        </div>
      </div>

      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Detalles actuales
      </div>
      <div class="qi-list">
        <div class="qi-item"><div class="qi-icon">📅</div><div><div class="qi-lbl">Fecha</div><div class="qi-val" id="qi-date">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">⏰</div><div><div class="qi-lbl">Hora y duración</div><div class="qi-val" id="qi-time">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">🖥️</div><div><div class="qi-lbl">Plataforma</div><div class="qi-val" id="qi-plat">—</div></div></div>
        <div class="qi-item"><div class="qi-icon">👁️</div><div><div class="qi-lbl">Link visible para estudiantes</div><div class="qi-val" id="qi-vis">—</div></div></div>
      </div>

      <div class="sec-label">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
        Nota para estudiantes
      </div>
      <div style="background:var(--bg-card);border:1px solid var(--border);border-radius:14px;padding:1.1rem;font-size:.82rem;color:var(--text-muted);line-height:1.65;">
        El enlace se muestra a los estudiantes <strong style="color:var(--text-body)">24 horas antes</strong> de la sesión. Durante la sesión activa, el badge <strong style="color:#f87171">EN VIVO</strong> aparece automáticamente.
      </div>
    </div>
  </div>
</div>

<!-- MODAL -->
<div class="overlay" id="overlay" onclick="handleOvClick(event)">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">×</button>
    <div class="modal-title" id="mTitle">Nueva sesión</div>
    <div class="modal-sub" id="mSub">Los estudiantes verán esta información automáticamente</div>
    <div class="form-grid">
      <div class="field" style="grid-column:1/-1"><label class="f-label">Título de la sesión</label><input class="f-input" id="f-tit" type="text" placeholder="Ej: Detección de interferencias con Navisworks"/></div>
      <div class="field"><label class="f-label">N° de sesión</label><input class="f-input" id="f-num" type="number" value="1" min="1"/></div>
      <div class="field"><label class="f-label">Etiqueta</label><input class="f-input" id="f-lbl" type="text" placeholder="Sesión 04 · Semana 3"/></div>
      <div class="field"><label class="f-label">Plataforma</label>
        <select class="f-select" id="f-plat">
          <option value="zoom">Zoom</option>
          <option value="meet">Google Meet</option>
          <option value="teams">Microsoft Teams</option>
          <option value="webex">Webex</option>
          <option value="otro">Otro</option>
        </select>
      </div>
      <div class="field"><label class="f-label">Duración (min)</label><input class="f-input" id="f-dur" type="number" value="90" min="15" max="360"/></div>
      <div class="field" style="grid-column:1/-1"><label class="f-label">Enlace de reunión</label><input class="f-input" id="f-link" type="url" placeholder="https://zoom.us/j/123456789..."/></div>
      <div class="field" style="grid-column:1/-1"><label class="f-label">Fecha y hora</label><input class="f-input" id="f-fecha" type="datetime-local"/></div>
      <div class="field" style="grid-column:1/-1"><label class="f-label">Descripción (opcional)</label><textarea class="f-textarea" id="f-desc" placeholder="Qué cubriremos en esta sesión..."></textarea></div>
    </div>
    <div class="modal-foot">
      <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
      <button class="btn-save" onclick="saveSession()"><span id="saveTxt">Crear sesión</span></button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast">
  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20,6 9,17 4,12"/></svg>
  <span id="toastMsg">¡Listo!</span>
</div>

<script>
// ✅ RUTA CORREGIDA — php/ en lugar de /api/
const API = 'php/charla.php';

const PN = { zoom:'Zoom', meet:'Google Meet', teams:'Microsoft Teams', webex:'Webex', otro:'Otro' };
const PI = { zoom:'📹', meet:'🎦', teams:'💼', webex:'🔵', otro:'🌐' };

let editId = null, allSess = [], cdTimer = null;

async function init() {
  try {
    const [r1, r2] = await Promise.all([
      fetch(API, { credentials:'include' }),
      fetch(`${API}?historial=1`, { credentials:'include' })
    ]);
    const m = await r1.json();
    const h = await r2.json();
    if (!m.ok) { document.getElementById('loadArea').innerHTML='<div style="padding:2rem;text-align:center;color:var(--text-muted)">⚠️ Error al cargar. Verifica tu sesión de admin.</div>'; return; }

    const { proxima, historial } = m.data;
    allSess = [];
    if (proxima) allSess.push({ ...proxima, isCurrent:true });
    if (h.ok && h.data.sesiones) h.data.sesiones.forEach(s => { if (!proxima||s.id!==proxima.id) allSess.push(s); });

    const prog = allSess.filter(s=>s.estado!=='finalizada'&&s.estado!=='cancelada').length;
    const fin  = allSess.filter(s=>s.estado==='finalizada').length;
    document.getElementById('stat-total').textContent = allSess.length;
    document.getElementById('stat-prog').textContent  = prog;
    document.getElementById('stat-fin').textContent   = fin;

    renderProxima(proxima);
    renderAllSess(allSess);
  } catch(e) {
    document.getElementById('loadArea').innerHTML='<div style="padding:2rem;text-align:center;color:var(--text-muted)">⚠️ Error de conexión</div>';
  }
}

function renderProxima(c) {
  document.getElementById('loadArea').style.display = 'none';
  const box = document.getElementById('charlaBox');
  box.style.display = 'block';

  if (!c) {
    box.innerHTML = `<div class="empty-state"><div class="empty-icon">📭</div><div class="empty-title">No hay sesiones programadas</div><div class="empty-desc">Crea la primera sesión para que los estudiantes puedan verla.</div><button class="empty-cta" onclick="openModal()"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Crear primera sesión</button></div>`;
    return;
  }

  const dt = new Date(c.fecha_sesion);
  const ds = dt.toLocaleDateString('es-DO',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
  const ts = dt.toLocaleTimeString('es-DO',{hour:'2-digit',minute:'2-digit'});

  const badgeMap = {
    en_vivo:    `<div class="badge badge-live"><span class="badge-dot"></span>En Vivo</div>`,
    finalizada: `<div class="badge badge-done"><span class="badge-dot"></span>Finalizada</div>`,
    default:    `<div class="badge badge-upcoming"><span class="badge-dot"></span>Programada</div>`
  };
  const badge = badgeMap[c.estado] || badgeMap.default;
  if (c.estado==='en_vivo') document.getElementById('liveBadge').classList.add('show');

  const recHtml = c.estado==='finalizada' ? `
    <div style="margin-top:.8rem">
      <div style="font-size:.75rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:var(--mint);margin-bottom:.4rem">Agregar grabación</div>
      <div class="rec-row"><input class="rec-input" id="recUrl" type="url" placeholder="https://youtu.be/... o drive.google.com/..." value="${c.link_grabacion||''}"/><button class="rec-save" onclick="saveRec(${c.id})">Guardar</button></div>
    </div>` : '';

  box.innerHTML = `
    <div class="charla-card">
      <div class="card-head">
        <div><div class="sess-label">${c.sesion_label||'Sesión '+c.sesion_numero}</div><div class="card-title">${c.titulo}</div></div>
        <div class="head-right">
          ${badge}
          <div class="admin-acts">
            <button class="act-btn" onclick="openEdit(${c.id})"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Editar</button>
            <button class="act-btn danger" onclick="delSession(${c.id})"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg> Cancelar</button>
          </div>
        </div>
      </div>
      <div class="card-meta">
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><strong>${cap(ds)}</strong></div>
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg><strong>${ts}</strong> · ${c.duracion_min} min</div>
        <div class="meta-item"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg><strong>${PN[c.plataforma]||'En línea'}</strong></div>
      </div>
      <div class="card-body">
        ${c.descripcion ? `<p class="card-desc">${c.descripcion}</p>` : ''}
        <div class="link-row">
          <span class="link-icon">${PI[c.plataforma]||'🌐'}</span>
          <span class="link-url">${c.link_reunion}</span>
          <div class="link-acts">
            <a href="${c.link_reunion}" target="_blank" class="link-btn"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15,3 21,3 21,9"/><line x1="10" y1="14" x2="21" y2="3"/></svg> Probar</a>
            <button class="link-btn" onclick="copyTxt('${c.link_reunion}')"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copiar</button>
          </div>
        </div>
        ${recHtml}
      </div>
    </div>`;

  document.getElementById('agendaBox').style.display = 'block';
  document.getElementById('qi-date').textContent = dt.toLocaleDateString('es-DO',{weekday:'short',day:'numeric',month:'short',year:'numeric'});
  document.getElementById('qi-time').textContent = `${ts} · ${c.duracion_min} min`;
  document.getElementById('qi-plat').textContent = PN[c.plataforma]||'En línea';

  const hr = (dt - new Date()) / 3600000;
  document.getElementById('qi-vis').textContent =
    c.estado==='en_vivo'      ? '✅ Visible ahora (en vivo)' :
    c.estado==='programada' && hr<=24 ? '✅ Visible para estudiantes' :
    c.estado==='programada'   ? `En ${Math.ceil(hr-24)}h más` : 'Sesión finalizada';

  if (c.estado==='programada') { document.getElementById('cdSection').style.display='block'; startCD(dt); }
}

function renderAllSess(sess) {
  if (!sess||!sess.length) return;
  document.getElementById('allSessBox').style.display = 'block';
  document.getElementById('sessList').innerHTML = sess.map(s => {
    const d = new Date(s.fecha_sesion);
    const ds = d.toLocaleDateString('es-DO',{day:'numeric',month:'short',year:'numeric'});
    const ts = d.toLocaleTimeString('es-DO',{hour:'2-digit',minute:'2-digit'});
    let tag = '';
    if (s.estado==='en_vivo') tag='<span style="font-size:.65rem;background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#f87171;border-radius:100px;padding:.1rem .45rem;font-weight:700">VIVO</span>';
    else if (s.estado==='finalizada') tag='<span style="font-size:.65rem;color:var(--text-muted)">✓ Finalizada</span>';
    return `<div class="sess-row ${s.isCurrent?'current':''}">
      <div class="sess-n">${String(s.sesion_numero).padStart(2,'0')}</div>
      <div class="sess-info"><div class="sess-tit">${PI[s.plataforma]||'🌐'} ${s.titulo}</div><div class="sess-date">${ds} · ${ts} · ${s.duracion_min}min ${tag}</div></div>
      <div class="sess-acts">
        <button class="sess-btn" title="Editar" onclick="openEdit(${s.id})">✏️</button>
        <button class="sess-btn del" title="Cancelar" onclick="delSession(${s.id})">🗑️</button>
      </div>
    </div>`;
  }).join('');
}

// ── MODAL ─────────────────────────────────────────────────────
function openModal() {
  editId = null;
  document.getElementById('mTitle').textContent  = 'Nueva sesión';
  document.getElementById('mSub').textContent    = 'Los estudiantes verán la información automáticamente';
  document.getElementById('saveTxt').textContent = 'Crear sesión';
  clearForm();
  document.getElementById('overlay').classList.add('open');
}

async function openEdit(id) {
  try {
    const r = await fetch(`${API}?id=${id}`, { credentials:'include' });
    const j = await r.json();
    if (!j.ok) { toast('Error al cargar la sesión', true); return; }
    const c = j.data;
    editId = c.id;
    document.getElementById('mTitle').textContent  = 'Editar sesión';
    document.getElementById('mSub').textContent    = `Sesión #${c.sesion_numero}`;
    document.getElementById('saveTxt').textContent = 'Guardar cambios';
    document.getElementById('f-tit').value  = c.titulo;
    document.getElementById('f-num').value  = c.sesion_numero;
    document.getElementById('f-lbl').value  = c.sesion_label||'';
    document.getElementById('f-plat').value = c.plataforma;
    document.getElementById('f-dur').value  = c.duracion_min;
    document.getElementById('f-link').value = c.link_reunion;
    document.getElementById('f-desc').value = c.descripcion||'';
    const dt = new Date(c.fecha_sesion); dt.setMinutes(dt.getMinutes()-dt.getTimezoneOffset());
    document.getElementById('f-fecha').value = dt.toISOString().slice(0,16);
    document.getElementById('overlay').classList.add('open');
  } catch { toast('Error de conexión', true); }
}

function closeModal() { document.getElementById('overlay').classList.remove('open'); }
function handleOvClick(e) { if (e.target===document.getElementById('overlay')) closeModal(); }
function clearForm() {
  ['f-tit','f-lbl','f-link','f-desc','f-fecha'].forEach(i => document.getElementById(i).value='');
  document.getElementById('f-num').value  = allSess.length+1;
  document.getElementById('f-dur').value  = 90;
  document.getElementById('f-plat').value = 'zoom';
}

// ── SAVE ─────────────────────────────────────────────────────
async function saveSession() {
  const tit  = document.getElementById('f-tit').value.trim();
  const link = document.getElementById('f-link').value.trim();
  const fecha= document.getElementById('f-fecha').value;
  if (!tit)  { toast('El título es requerido', true); return; }
  if (!link) { toast('El enlace de reunión es requerido', true); return; }
  if (!fecha){ toast('La fecha y hora son requeridas', true); return; }

  const body = {
    titulo:       tit,
    sesion_numero: parseInt(document.getElementById('f-num').value)||1,
    sesion_label:  document.getElementById('f-lbl').value.trim(),
    plataforma:    document.getElementById('f-plat').value,
    duracion_min:  parseInt(document.getElementById('f-dur').value)||90,
    link_reunion:  link,
    fecha_sesion:  fecha.replace('T',' ')+':00',
    descripcion:   document.getElementById('f-desc').value.trim()
  };

  try {
    const btn = document.querySelector('.btn-save');
    btn.disabled = true; document.getElementById('saveTxt').textContent = 'Guardando...';
    const url = editId ? `${API}?id=${editId}` : API;
    const res = await fetch(url, { method: editId?'PUT':'POST', credentials:'include', headers:{'Content-Type':'application/json'}, body:JSON.stringify(body) });
    const j   = await res.json();
    btn.disabled = false; document.getElementById('saveTxt').textContent = editId ? 'Guardar cambios' : 'Crear sesión';
    if (!j.ok) { toast(j.error||'Error al guardar', true); return; }
    toast(editId ? '¡Sesión actualizada!' : '¡Sesión creada exitosamente!');
    closeModal();
    setTimeout(init, 400);
  } catch { toast('Error de conexión', true); document.querySelector('.btn-save').disabled=false; }
}

// ── DELETE ────────────────────────────────────────────────────
async function delSession(id) {
  if (!confirm('¿Cancelar esta sesión? Los estudiantes dejarán de verla.')) return;
  try {
    const r = await fetch(`${API}?id=${id}`, { method:'DELETE', credentials:'include' });
    const j = await r.json();
    if (!j.ok) { toast(j.error||'Error', true); return; }
    toast('Sesión cancelada');
    setTimeout(init, 400);
  } catch { toast('Error de conexión', true); }
}

// ── GRABACION ─────────────────────────────────────────────────
async function saveRec(id) {
  const url = document.getElementById('recUrl').value.trim();
  if (!url) { toast('Ingresa la URL de la grabación', true); return; }
  const gr = await fetch(`${API}?id=${id}`, { credentials:'include' });
  const gj = await gr.json();
  if (!gj.ok) { toast('Error', true); return; }
  const c    = gj.data;
  const body = { titulo:c.titulo, sesion_numero:c.sesion_numero, plataforma:c.plataforma, link_reunion:c.link_reunion, fecha_sesion:c.fecha_sesion, duracion_min:c.duracion_min, descripcion:c.descripcion||'', link_grabacion:url };
  const sr   = await fetch(`${API}?id=${id}`, { method:'PUT', credentials:'include', headers:{'Content-Type':'application/json'}, body:JSON.stringify(body) });
  const sj   = await sr.json();
  if (!sj.ok) { toast(sj.error||'Error', true); return; }
  toast('¡Grabación guardada! Los estudiantes ya pueden verla.');
}

// ── HELPERS ───────────────────────────────────────────────────
function startCD(t) {
  if (cdTimer) clearInterval(cdTimer);
  function tick() {
    const d = t - new Date(); if(d<=0){clearInterval(cdTimer);return;}
    document.getElementById('cd-d').textContent = String(Math.floor(d/86400000)).padStart(2,'0');
    document.getElementById('cd-h').textContent = String(Math.floor((d%86400000)/3600000)).padStart(2,'0');
    document.getElementById('cd-m').textContent = String(Math.floor((d%3600000)/60000)).padStart(2,'0');
  }
  tick(); cdTimer = setInterval(tick, 30000);
}

function copyTxt(t) { navigator.clipboard.writeText(t).then(()=>toast('¡Enlace copiado!')); }

function toast(msg, isErr=false) {
  const el = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  el.className = 'toast' + (isErr?' err':'');
  el.classList.add('show');
  setTimeout(()=>el.classList.remove('show'), 3000);
}

function cap(s) { return s.charAt(0).toUpperCase()+s.slice(1); }

document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });
init();
</script>
</body>
</html>