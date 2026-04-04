<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mi Perfil | Constructiva</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"/>
  <script src="Js/cv-session.js"></script>
  <style>
    :root {
      --teal:    #0aab96;
      --teal-lt: #e8f8f6;
      --teal-mid:rgba(10,171,150,.12);
      --teal-bdr:rgba(10,171,150,.3);
      --bg:      #f4f5f7;
      --white:   #ffffff;
      --soft:    #ecedf0;
      --sidebar: #1a2421;
      --text:    #1c2b28;
      --mid:     #52625f;
      --muted:   #98a5a2;
      --border:  #e2e4e8;
      --danger:  #dc4f4f;
      --sh-sm:   0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
      --sh-md:   0 4px 16px rgba(0,0,0,.08);
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth}
    body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh}

    /* ── TOPBAR ─────────────────────────────────────────── */
    .bar{position:sticky;top:0;z-index:300;height:56px;background:rgba(255,255,255,.94);backdrop-filter:blur(16px);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 2rem;justify-content:space-between;box-shadow:var(--sh-sm)}
    .bar img{height:32px;width:auto}
    .bar-r{display:flex;align-items:center;gap:.7rem}
    .bar-lnk{display:flex;align-items:center;gap:.35rem;color:var(--mid);text-decoration:none;font-size:.83rem;font-weight:500;padding:.32rem .75rem;border-radius:7px;transition:background .15s,color .15s}
    .bar-lnk:hover{background:var(--soft);color:var(--text)}
    .bar-out{display:flex;align-items:center;gap:.35rem;padding:.32rem .85rem;border-radius:7px;border:1px solid rgba(220,79,79,.22);background:rgba(220,79,79,.06);color:var(--danger);font-family:'DM Sans',sans-serif;font-size:.83rem;font-weight:500;cursor:pointer;transition:background .15s}
    .bar-out:hover{background:rgba(220,79,79,.12)}

    /* ── LAYOUT ─────────────────────────────────────────── */
    .layout{display:grid;grid-template-columns:270px 1fr;min-height:calc(100vh - 56px)}

    /* ── SIDEBAR ────────────────────────────────────────── */
    .sidebar{background:var(--sidebar);padding:2rem 1.5rem;position:sticky;top:56px;height:calc(100vh - 56px);overflow-y:auto;display:flex;flex-direction:column}
    .av-wrap{display:flex;flex-direction:column;align-items:center;margin-bottom:1.4rem}
    .av-ring{width:90px;height:90px;border-radius:50%;position:relative;cursor:pointer;margin-bottom:.85rem}
    .av-ring::before{content:'';position:absolute;inset:-2px;border-radius:50%;background:conic-gradient(var(--teal),rgba(10,171,150,.15) 55%,var(--teal));animation:rot 7s linear infinite}
    @keyframes rot{to{transform:rotate(360deg)}}
    .av-inner{position:absolute;inset:2px;border-radius:50%;overflow:hidden;background:#253330;z-index:1;display:flex;align-items:center;justify-content:center}
    .av-inner img{width:100%;height:100%;object-fit:cover;display:block}
    .av-inner .efb{font-size:2.5rem;line-height:1}
    .av-ov{position:absolute;inset:2px;border-radius:50%;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;z-index:2}
    .av-ring:hover .av-ov{opacity:1}
    .sb-name{font-family:'Syne',sans-serif;font-size:1.05rem;font-weight:700;color:#fff;text-align:center;margin-bottom:.28rem}
    .sb-badge{display:inline-flex;align-items:center;gap:.28rem;background:rgba(10,171,150,.15);border:1px solid rgba(10,171,150,.25);border-radius:100px;padding:.2rem .65rem;font-size:.7rem;font-weight:500;color:#4dd9c8;margin-bottom:.4rem}
    .sb-sub{font-size:.72rem;color:rgba(255,255,255,.28);text-align:center;line-height:1.4}
    .sb-hr{height:1px;background:rgba(255,255,255,.07);margin:1.1rem 0}
    .sb-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.45rem;margin-bottom:1.1rem}
    .sb-st{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);border-radius:8px;padding:.65rem .3rem;text-align:center}
    .sb-st-n{font-family:'Syne',sans-serif;font-size:1.25rem;font-weight:800;color:var(--teal);line-height:1}
    .sb-st-l{font-size:.6rem;color:rgba(255,255,255,.3);margin-top:.2rem}
    .sb-nav{display:flex;flex-direction:column;gap:.2rem}
    .sbn{display:flex;align-items:center;gap:.6rem;padding:.58rem .8rem;border-radius:8px;color:rgba(255,255,255,.42);font-size:.83rem;font-weight:500;cursor:pointer;transition:all .15s;border:none;background:none;text-align:left;width:100%;text-decoration:none}
    .sbn:hover{background:rgba(255,255,255,.05);color:rgba(255,255,255,.78)}
    .sbn.on{background:rgba(10,171,150,.13);border:1px solid rgba(10,171,150,.18);color:#4dd9c8}
    .sbn svg{flex-shrink:0;opacity:.6}
    .sbn.on svg{opacity:1}
    .sb-push{flex:1}
    .sb-foot{font-size:.68rem;color:rgba(255,255,255,.18);text-align:center;line-height:1.6}

    /* ── MAIN ───────────────────────────────────────────── */
    .main{padding:2rem 2.5rem 5rem}
    .sec{display:none}.sec.on{display:block}

    /* ── PROFILE HEADER ─────────────────────────────────── */
    .profile-header{
      display:flex;align-items:center;gap:1.4rem;
      background:var(--white);border:1px solid var(--border);border-radius:14px;
      padding:1.4rem 1.8rem;margin-bottom:1.5rem;
      box-shadow:var(--sh-sm);
    }
    .ph-avatar{
      width:80px;height:80px;border-radius:50%;
      position:relative;cursor:pointer;flex-shrink:0;
      border:3px solid var(--border);overflow:hidden;
      background:var(--soft);
      transition:border-color .2s;
    }
    .ph-avatar:hover{border-color:var(--teal)}
    .ph-av-inner{
      width:100%;height:100%;display:flex;align-items:center;
      justify-content:center;font-size:2.2rem;
    }
    .ph-av-ov{
      position:absolute;inset:0;background:rgba(0,0,0,.45);
      display:flex;align-items:center;justify-content:center;
      opacity:0;transition:opacity .2s;border-radius:50%;
    }
    .ph-avatar:hover .ph-av-ov{opacity:1}
    .ph-avatar-wrap{display:flex;flex-direction:column;align-items:center;gap:.4rem}
    .ph-info h2{font-family:'Syne',sans-serif;font-size:1.35rem;font-weight:800;letter-spacing:-.02em;margin-bottom:.2rem}
    .ph-info p{font-size:.84rem;color:var(--muted)}

    /* pending badge */
    .pb{display:none;font-size:.72rem;color:var(--teal);background:var(--teal-lt);border:1px solid var(--teal-bdr);border-radius:100px;padding:.18rem .6rem;white-space:nowrap}
    .pb.on{display:block}

    /* ── 2 COLUMNAS ─────────────────────────────────────── */
    .two-col{display:grid;grid-template-columns:1fr 380px;gap:1.2rem;align-items:start}

    /* ── CARDS ──────────────────────────────────────────── */
    .card{background:var(--white);border:1px solid var(--border);border-radius:14px;padding:1.6rem 1.8rem;box-shadow:var(--sh-sm);margin-bottom:1.2rem}
    .card:last-child{margin-bottom:0}
    .card-title{font-family:'Syne',sans-serif;font-size:.95rem;font-weight:700;color:var(--text);margin-bottom:1.3rem;padding-bottom:.8rem;border-bottom:1px solid var(--border)}

    /* ── FIELDS ─────────────────────────────────────────── */
    .fg{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
    .f{display:flex;flex-direction:column;gap:.35rem}
    .f.s2{grid-column:1/-1}
    .f label{font-size:.72rem;font-weight:600;color:var(--mid);letter-spacing:.05em;text-transform:uppercase}
    .f input{background:var(--bg);border:1.5px solid var(--border);border-radius:9px;padding:.62rem .9rem;color:var(--text);font-family:'DM Sans',sans-serif;font-size:.88rem;outline:none;transition:border-color .18s,box-shadow .18s,background .18s;width:100%}
    .f input:focus{border-color:var(--teal);background:var(--white);box-shadow:0 0 0 3px rgba(10,171,150,.09)}
    .f input::placeholder{color:#bfc4c2}

    /* emoji */
    .ep-row{display:flex;align-items:center;gap:.7rem}
    .ep-box{width:42px;height:42px;background:var(--bg);border:1.5px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
    .ep-grid{display:none;grid-template-columns:repeat(11,1fr);gap:.25rem;background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:.7rem;box-shadow:var(--sh-md);margin-top:.5rem}
    .ep-grid.open{display:grid}
    .epb{background:none;border:none;cursor:pointer;font-size:1.15rem;padding:.22rem;border-radius:5px;transition:background .12s;line-height:1}
    .epb:hover{background:var(--soft)}
    .epb.s{background:var(--teal-mid);outline:1.5px solid var(--teal-bdr)}

    /* divider */
    .dv{height:1px;background:var(--border);margin:1.1rem 0}

    /* buttons */
    .br{display:flex;justify-content:flex-end;gap:.55rem;margin-top:1.2rem}
    .btn{display:inline-flex;align-items:center;gap:.35rem;padding:.58rem 1.3rem;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:.85rem;font-weight:500;cursor:pointer;border:none;transition:all .18s}
    .btn-p{background:var(--teal);color:#fff;box-shadow:0 2px 8px rgba(10,171,150,.25)}
    .btn-p:hover{background:#089882;transform:translateY(-1px);box-shadow:0 4px 14px rgba(10,171,150,.3)}
    .btn-p:disabled{opacity:.45;cursor:not-allowed;transform:none;box-shadow:none}
    .btn-s{background:var(--soft);color:var(--mid);border:1px solid var(--border)}
    .btn-s:hover{background:var(--border);color:var(--text)}

    /* stats card */
    .stats-card .stats-row{display:flex;justify-content:space-around;padding:.5rem 0}
    .stat-item{text-align:center}
    .stat-n{font-family:'Syne',sans-serif;font-size:1.6rem;font-weight:800;line-height:1;margin-bottom:.2rem}
    .stat-n.teal{color:var(--teal)}
    .stat-n.green{color:#22c55e}
    .stat-n.purple{color:#8b5cf6}
    .stat-l{font-size:.75rem;color:var(--muted)}

    /* modal */
    .mbg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);backdrop-filter:blur(6px);z-index:1000;align-items:center;justify-content:center}
    .mbg.open{display:flex}
    .mbox{background:var(--white);border:1px solid var(--border);border-radius:16px;padding:2rem;width:300px;text-align:center;box-shadow:var(--sh-md);animation:pop .2s cubic-bezier(.34,1.56,.64,1)}
    @keyframes pop{from{transform:scale(.9);opacity:0}}
    .mbox h3{font-family:'Syne',sans-serif;font-size:1rem;font-weight:800;margin-bottom:.3rem}
    .mbox p{font-size:.82rem;color:var(--muted);margin-bottom:1.2rem}
    .mcirc{width:130px;height:130px;border-radius:50%;margin:0 auto 1.2rem;overflow:hidden;border:2px solid var(--teal-bdr);background:var(--bg)}
    .mcirc img{width:100%;height:100%;object-fit:cover}
    .ma{display:flex;gap:.55rem;justify-content:center}

    /* toast */
    .toast{position:fixed;bottom:1.8rem;right:1.8rem;padding:.65rem 1.2rem;border-radius:8px;font-size:.84rem;font-weight:500;opacity:0;transform:translateY(10px);transition:all .22s cubic-bezier(.34,1.56,.64,1);pointer-events:none;z-index:9999;box-shadow:var(--sh-md)}
    .toast.ok{background:var(--teal);color:#fff}
    .toast.err{background:var(--danger);color:#fff}
    .toast.on{opacity:1;transform:translateY(0)}

    /* loader */
    .ld{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:50vh;gap:1rem;color:var(--muted)}
    .sp{width:32px;height:32px;border:3px solid var(--border);border-top-color:var(--teal);border-radius:50%;animation:spi .7s linear infinite}
    @keyframes spi{to{transform:rotate(360deg)}}

    @media(max-width:900px){
      .two-col{grid-template-columns:1fr}
      .col-right{display:contents}
    }
    @media(max-width:740px){
      .layout{grid-template-columns:1fr}
      .sidebar{position:static;height:auto;padding:1.3rem 1.2rem}
      .sb-push,.sb-foot{display:none}
      .sb-nav{flex-direction:row;flex-wrap:wrap}
      .main{padding:1.3rem 1rem 4rem}
      .fg{grid-template-columns:1fr}
      .f.s2{grid-column:1}
      .ep-grid{grid-template-columns:repeat(7,1fr)}
      .bar{padding:0 1.2rem}
    }
  </style>
</head>
<body>

<header class="bar">
  <a href="/"><img src="Img/Logo aqua.png" alt="Constructiva"></a>
  <div class="bar-r">
    <a href="/dashboard" class="bar-lnk">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Mi Espacio
    </a>
    <button class="bar-out" onclick="CVSession.logout()">
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
      Salir
    </button>
  </div>
</header>

<input type="file" id="photo-input" accept="image/jpeg,image/png,image/webp">

<div class="mbg" id="modal">
  <div class="mbox">
    <h3>Vista previa</h3>
    <p>Así lucirá tu foto de perfil</p>
    <div class="mcirc"><img id="modal-img" src="" alt=""></div>
    <div class="ma">
      <button class="btn btn-s" id="m-cancel">Cancelar</button>
      <button class="btn btn-p" id="m-ok">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        Usar foto
      </button>
    </div>
  </div>
</div>

<div class="layout">
  <aside class="sidebar" id="sidebar"><div class="ld"><div class="sp"></div></div></aside>
  <main class="main" id="main"><div class="ld" id="main-ld"><div class="sp"></div>Cargando…</div></main>
</div>

<div class="toast" id="toast"></div>
<script src="Js/perfil.js"></script>
</body>
</html>