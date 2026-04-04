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
  <script src="/Js/cv-session.js?v=1.0"></script>
  <style>
    :root {
      --teal:      #0aab96;
      --teal2:     #089882;
      --teal-lt:   rgba(10,171,150,.1);
      --teal-bdr:  rgba(10,171,150,.25);
      --sidebar-bg:#111c1a;
      --white:     #ffffff;
      --surface:   #f7f9f9;
      --surface2:  #edf1f0;
      --border:    #e4e8e7;
      --text:      #111d1c;
      --mid:       #52625f;
      --muted:     #8a9a97;
      --danger:    #c43a3a;
      --success:   #1a8a40;
      --accent:    #7c4fd4;
      --sh-xs:     0 1px 4px rgba(0,0,0,.05);
      --sh-sm:     0 2px 12px rgba(0,0,0,.07);
      --sh-md:     0 8px 28px rgba(0,0,0,.1);
      --radius:    14px;
      --radius-sm: 9px;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth}
    body{background:var(--surface);color:var(--text);font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;flex-direction:column}

    .bar{position:sticky;top:0;z-index:300;height:58px;background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 2rem;justify-content:space-between;box-shadow:var(--sh-xs)}
    .bar img{height:30px;width:auto}
    .bar-r{display:flex;align-items:center;gap:.7rem}
    .bar-lnk{display:flex;align-items:center;gap:.35rem;color:var(--mid);text-decoration:none;font-size:.82rem;font-weight:500;padding:.32rem .8rem;border-radius:8px;transition:all .15s}
    .bar-lnk:hover{background:var(--surface2);color:var(--text)}
    .bar-out{display:flex;align-items:center;gap:.35rem;padding:.32rem .85rem;border-radius:8px;border:1px solid rgba(196,58,58,.2);background:rgba(196,58,58,.05);color:var(--danger);font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:500;cursor:pointer;transition:all .15s}
    .bar-out:hover{background:rgba(196,58,58,.1)}

    .layout{display:grid;grid-template-columns:280px 1fr;flex:1;min-height:calc(100vh - 58px)}

    .sidebar{background:var(--sidebar-bg);padding:2rem 1.5rem;position:sticky;top:58px;height:calc(100vh - 58px);overflow-y:auto;display:flex;flex-direction:column}

    .av-wrap{display:flex;flex-direction:column;align-items:center;margin-bottom:1.5rem}
    .av-ring{width:96px;height:96px;border-radius:50%;position:relative;cursor:pointer;margin-bottom:.9rem}
    .av-ring::before{content:'';position:absolute;inset:-2px;border-radius:50%;background:conic-gradient(var(--teal) 0%,rgba(10,171,150,.1) 60%,var(--teal) 100%);animation:rot 6s linear infinite}
    @keyframes rot{to{transform:rotate(360deg)}}
    .av-inner{position:absolute;inset:3px;border-radius:50%;overflow:hidden;background:#1c2e2b;z-index:1;display:flex;align-items:center;justify-content:center}
    .av-inner img{width:100%;height:100%;object-fit:cover;display:block}
    .av-inner .efb{font-size:2.6rem;line-height:1}
    .av-ov{position:absolute;inset:3px;border-radius:50%;background:rgba(0,0,0,.55);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.25rem;opacity:0;transition:opacity .2s;z-index:2}
    .av-ov span{font-size:.6rem;color:#fff;font-weight:600;letter-spacing:.05em}
    .av-ring:hover .av-ov{opacity:1}

    .sb-name{font-family:'Syne',sans-serif;font-size:1rem;font-weight:700;color:#e8f4f2;text-align:center;margin-bottom:.25rem}
    .sb-badge{display:inline-flex;align-items:center;gap:.28rem;background:rgba(10,171,150,.12);border:1px solid rgba(10,171,150,.22);border-radius:100px;padding:.18rem .65rem;font-size:.68rem;font-weight:600;color:#4dd9c8;margin-bottom:.35rem}
    .sb-sub{font-size:.7rem;color:rgba(255,255,255,.25);text-align:center;line-height:1.5}
    .sb-hr{height:1px;background:rgba(255,255,255,.06);margin:1.1rem 0}
    .sb-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:.4rem;margin-bottom:1rem}
    .sb-st{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);border-radius:9px;padding:.65rem .3rem;text-align:center;transition:background .15s}
    .sb-st:hover{background:rgba(255,255,255,.07)}
    .sb-st-n{font-family:'Syne',sans-serif;font-size:1.3rem;font-weight:800;color:var(--teal);line-height:1}
    .sb-st-l{font-size:.58rem;color:rgba(255,255,255,.28);margin-top:.2rem;text-transform:uppercase;letter-spacing:.05em}
    .sb-nav{display:flex;flex-direction:column;gap:.18rem}
    .sbn{display:flex;align-items:center;gap:.65rem;padding:.6rem .85rem;border-radius:9px;color:rgba(255,255,255,.38);font-size:.82rem;font-weight:400;cursor:pointer;transition:all .15s;border:none;background:none;text-align:left;width:100%;text-decoration:none}
    .sbn:hover{background:rgba(255,255,255,.05);color:rgba(255,255,255,.7)}
    .sbn.on{background:rgba(10,171,150,.1);border:1px solid rgba(10,171,150,.18);color:#6ee8d8;font-weight:500}
    .sbn svg{flex-shrink:0;opacity:.6}
    .sbn.on svg{opacity:1}
    .sb-push{flex:1}
    .sb-foot{font-size:.65rem;color:rgba(255,255,255,.18);text-align:center;line-height:1.6}

    .main{padding:2rem 2.4rem 5rem;background:var(--surface)}
    .sec{display:none}.sec.on{display:block}

    .profile-hero{background:linear-gradient(115deg,#0b1f1d 0%,#0d3330 55%,#0a2e28 100%);border-radius:var(--radius);padding:2rem 2.2rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:1.8rem;position:relative;overflow:hidden}
    .profile-hero::before{content:'';position:absolute;right:-30px;top:-50px;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,rgba(10,171,150,.2) 0%,transparent 70%)}
    .ph-av{width:80px;height:80px;border-radius:50%;flex-shrink:0;border:3px solid rgba(10,171,150,.35);overflow:hidden;background:#1c2e2b;cursor:pointer;position:relative;z-index:1;transition:border-color .2s}
    .ph-av:hover{border-color:var(--teal)}
    .ph-av-inner{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.2rem}
    .ph-av-ov{position:absolute;inset:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;border-radius:50%}
    .ph-av:hover .ph-av-ov{opacity:1}
    .ph-info{position:relative;z-index:1}
    .ph-info h2{font-family:'Syne',sans-serif;font-size:1.4rem;font-weight:800;color:#e8f4f2;margin-bottom:.25rem}
    .ph-info p{font-size:.82rem;color:rgba(232,244,242,.45)}
    .pb{display:none;font-size:.68rem;color:var(--teal);background:rgba(10,171,150,.12);border:1px solid var(--teal-bdr);border-radius:100px;padding:.18rem .6rem;margin-top:.4rem}
    .pb.on{display:inline-flex}

    .card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius);padding:1.6rem 1.8rem;box-shadow:var(--sh-xs);margin-bottom:1.2rem;transition:box-shadow .2s,border-color .2s}
    .card:last-child{margin-bottom:0}
    .card:hover{box-shadow:var(--sh-sm);border-color:rgba(10,171,150,.15)}
    .card-title{font-family:'Syne',sans-serif;font-size:.9rem;font-weight:700;color:var(--text);margin-bottom:1.3rem;padding-bottom:.8rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.5rem}
    .card-title svg{color:var(--teal);flex-shrink:0}

    .two-col{display:grid;grid-template-columns:1fr 360px;gap:1.2rem;align-items:start}
    .fg{display:grid;grid-template-columns:1fr 1fr;gap:.85rem}
    .f{display:flex;flex-direction:column;gap:.35rem}
    .f.s2{grid-column:1/-1}
    .f label{font-size:.68rem;font-weight:700;color:var(--mid);letter-spacing:.07em;text-transform:uppercase}
    .f input{background:var(--surface);border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:.65rem .95rem;color:var(--text);font-family:'DM Sans',sans-serif;font-size:.87rem;outline:none;transition:all .18s;width:100%}
    .f input:focus{border-color:var(--teal);background:var(--white);box-shadow:0 0 0 3px rgba(10,171,150,.09)}
    .f input::placeholder{color:#c2cac8}

    .ep-row{display:flex;align-items:center;gap:.7rem}
    .ep-box{width:44px;height:44px;background:var(--surface);border:1.5px solid var(--border);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0;transition:border-color .15s}
    .ep-box:hover{border-color:var(--teal)}
    .ep-grid{display:none;grid-template-columns:repeat(11,1fr);gap:.25rem;background:var(--white);border:1.5px solid var(--border);border-radius:10px;padding:.7rem;box-shadow:var(--sh-md);margin-top:.5rem}
    .ep-grid.open{display:grid}
    .epb{background:none;border:none;cursor:pointer;font-size:1.1rem;padding:.22rem;border-radius:5px;transition:background .12s;line-height:1}
    .epb:hover{background:var(--surface2)}
    .epb.s{background:var(--teal-lt);outline:1.5px solid var(--teal-bdr)}

    .dv{height:1px;background:var(--border);margin:1.1rem 0}
    .br{display:flex;justify-content:flex-end;gap:.55rem;margin-top:1.3rem}
    .btn{display:inline-flex;align-items:center;gap:.38rem;padding:.6rem 1.35rem;border-radius:100px;font-family:'DM Sans',sans-serif;font-size:.84rem;font-weight:500;cursor:pointer;border:none;transition:all .18s}
    .btn-p{background:var(--teal);color:#fff;box-shadow:0 2px 8px rgba(10,171,150,.25)}
    .btn-p:hover{background:var(--teal2);transform:translateY(-1px);box-shadow:0 4px 14px rgba(10,171,150,.3)}
    .btn-p:disabled{opacity:.45;cursor:not-allowed;transform:none;box-shadow:none}
    .btn-s{background:var(--surface2);color:var(--mid);border:1px solid var(--border)}
    .btn-s:hover{background:var(--border);color:var(--text)}
    .btn-danger{background:rgba(196,58,58,.07);color:var(--danger);border:1px solid rgba(196,58,58,.2)}
    .btn-danger:hover{background:rgba(196,58,58,.12)}

    .stats-row{display:flex;justify-content:space-around;padding:.5rem 0}
    .stat-item{text-align:center}
    .stat-n{font-family:'Syne',sans-serif;font-size:1.7rem;font-weight:800;line-height:1;margin-bottom:.25rem}
    .stat-n.teal{color:var(--teal)}.stat-n.green{color:var(--success)}.stat-n.purple{color:var(--accent)}
    .stat-l{font-size:.72rem;color:var(--muted)}

    .pw-strength{height:3px;border-radius:3px;margin-top:.4rem;transition:all .3s;background:var(--border)}
    .pw-strength.weak{background:var(--danger);width:33%}
    .pw-strength.medium{background:#c27a00;width:66%}
    .pw-strength.strong{background:var(--success);width:100%}

    .mbg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(8px);z-index:1000;align-items:center;justify-content:center}
    .mbg.open{display:flex}
    .mbox{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:2rem;width:300px;text-align:center;box-shadow:var(--sh-md);animation:pop .22s cubic-bezier(.34,1.56,.64,1)}
    @keyframes pop{from{transform:scale(.88);opacity:0}}
    .mbox h3{font-family:'Syne',sans-serif;font-size:1rem;font-weight:800;margin-bottom:.3rem}
    .mbox p{font-size:.81rem;color:var(--muted);margin-bottom:1.2rem}
    .mcirc{width:130px;height:130px;border-radius:50%;margin:0 auto 1.2rem;overflow:hidden;border:2px solid var(--teal-bdr);background:var(--surface)}
    .mcirc img{width:100%;height:100%;object-fit:cover}
    .ma{display:flex;gap:.55rem;justify-content:center}

    .toast{position:fixed;bottom:1.8rem;right:1.8rem;padding:.68rem 1.2rem;border-radius:10px;font-size:.82rem;font-weight:600;font-family:'Syne',sans-serif;opacity:0;transform:translateY(12px);transition:all .24s cubic-bezier(.34,1.56,.64,1);pointer-events:none;z-index:9999;box-shadow:var(--sh-md)}
    .toast.ok{background:var(--sidebar-bg);color:#6ee8d8;border:1px solid rgba(10,171,150,.3)}
    .toast.err{background:#2a0f0f;color:#f07a7a;border:1px solid rgba(196,58,58,.3)}
    .toast.on{opacity:1;transform:translateY(0)}

    .ld{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:50vh;gap:1rem;color:var(--muted)}
    .sp{width:30px;height:30px;border:2.5px solid var(--border);border-top-color:var(--teal);border-radius:50%;animation:spi .7s linear infinite}
    @keyframes spi{to{transform:rotate(360deg)}}

    .sec-header{margin-bottom:1.5rem}
    .sec-label{font-size:.65rem;font-weight:700;letter-spacing:.14em;color:var(--teal);text-transform:uppercase;margin-bottom:.35rem}
    .sec-title{font-family:'Syne',sans-serif;font-size:1.5rem;font-weight:800;color:var(--text)}
    .sec-sub{font-size:.83rem;color:var(--muted);margin-top:.3rem}

    .danger-zone{border-color:rgba(196,58,58,.2)!important}
    .danger-zone .card-title{color:var(--danger)}

    @media(max-width:960px){.two-col{grid-template-columns:1fr}.col-right{display:contents}}
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
      .profile-hero{padding:1.4rem}
    }
  </style>
</head>
<body>

<header class="bar">
  <a href="/"><img src="/Img/Logo aqua.png" alt="Constructiva"></a>
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

<!-- ✅ Input file con posición fija fuera de pantalla — no display:none -->
<input type="file" id="photo-input" accept="image/jpeg,image/png,image/webp"
  style="position:fixed;top:-9999px;left:-9999px;opacity:0;pointer-events:none">

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
<script src="/Js/perfil.js"></script>
</body>
</html>