<style>
  #mc-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.4s ease;
  }
  #mc-overlay.mc-show { opacity: 1; }
  #mc-overlay.mc-hide { opacity: 0; pointer-events: none; }

  #mc-card {
    position: relative;
    background: linear-gradient(160deg, #0b1d1d 0%, #050f0f 100%);
    border: 1px solid rgba(54,219,202,0.22);
    border-radius: 24px;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    overflow-y: auto;
    padding: 44px 40px 36px;
    transform: translateY(28px) scale(0.97);
    transition: transform 0.45s cubic-bezier(0.16,1,0.3,1), opacity 0.4s ease;
    scrollbar-width: none;
  }
  #mc-card::-webkit-scrollbar { display: none; }
  #mc-overlay.mc-show #mc-card { transform: translateY(0) scale(1); }

  #mc-card::before {
    content: '';
    position: absolute;
    top: 0; left: 15%; right: 15%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(54,219,202,0.65), transparent);
  }

  .mc-orb {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    filter: blur(60px);
  }
  .mc-orb-1 {
    width: 320px; height: 320px;
    background: radial-gradient(circle, rgba(54,219,202,0.14) 0%, transparent 70%);
    top: -100px; left: -80px;
  }
  .mc-orb-2 {
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(54,219,202,0.08) 0%, transparent 70%);
    bottom: -40px; right: -40px;
  }

  #mc-close {
    position: absolute;
    top: 16px; right: 18px;
    width: 32px; height: 32px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.5);
    font-size: 18px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
    z-index: 2;
    line-height: 1;
  }
  #mc-close:hover {
    background: rgba(54,219,202,0.15);
    border-color: rgba(54,219,202,0.4);
    color: #36DBCA;
  }

  .mc-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(54,219,202,0.1);
    border: 1px solid rgba(54,219,202,0.3);
    border-radius: 100px;
    padding: 5px 14px 5px 10px;
    font-size: 11px;
    font-weight: 600;
    color: #36DBCA;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
  }
  .mc-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #36DBCA;
    animation: mc-pulse 1.8s ease-in-out infinite;
  }
  @keyframes mc-pulse {
    0%,100% { opacity:1; transform:scale(1); box-shadow: 0 0 0 0 rgba(54,219,202,0.5); }
    50%      { opacity:0.4; transform:scale(0.7); box-shadow: 0 0 0 5px rgba(54,219,202,0); }
  }

  .mc-eyebrow {
    font-size: 12px;
    font-weight: 600;
    color: #36DBCA;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 8px;
    position: relative; z-index: 1;
  }

  .mc-h2 {
    font-size: clamp(22px, 4vw, 30px);
    font-weight: 900;
    line-height: 1.2;
    letter-spacing: -0.02em;
    color: #ffffff;
    margin-bottom: 8px;
    position: relative; z-index: 1;
  }
  .mc-h2 .mc-teal { color: #36DBCA; }

  .mc-sub {
    font-size: 14px;
    color: rgba(255,255,255,0.55);
    margin-bottom: 22px;
    line-height: 1.5;
    position: relative; z-index: 1;
  }
  .mc-sub strong { color: #36DBCA; font-weight: 500; }

  .mc-pills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    margin-top: 16px;
    margin-bottom: 24px;
    position: relative; z-index: 1;
  }
  .mc-pill {
    display: flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 100px;
    padding: 6px 13px;
    font-size: 12px;
    color: rgba(255,255,255,0.65);
  }
  .mc-pill svg { opacity: 0.55; flex-shrink: 0; }

  .mc-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.07), transparent);
    margin: 0 0 20px;
  }

  .mc-cd-label {
    text-align: center;
    font-size: 10px;
    font-weight: 600;
    color: rgba(54,219,202,0.55);
    letter-spacing: 0.14em;
    text-transform: uppercase;
    margin-bottom: 12px;
    position: relative; z-index: 1;
  }

  .mc-countdown {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 24px;
    position: relative; z-index: 1;
  }
  .mc-unit { display: flex; flex-direction: column; align-items: center; gap: 5px; }
  .mc-box {
    width: 66px; height: 62px;
    background: linear-gradient(160deg, rgba(54,219,202,0.1) 0%, rgba(54,219,202,0.04) 100%);
    border: 1px solid rgba(54,219,202,0.22);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; font-weight: 900;
    color: #ffffff;
    font-variant-numeric: tabular-nums;
    position: relative; overflow: hidden;
  }
  .mc-box::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(90deg, transparent, rgba(54,219,202,0.55), transparent);
  }
  .mc-lbl {
    font-size: 9.5px; font-weight: 600;
    color: rgba(54,219,202,0.6);
    letter-spacing: 0.1em; text-transform: uppercase;
  }
  .mc-sep {
    font-size: 26px; font-weight: 900;
    color: rgba(54,219,202,0.3);
    line-height: 62px;
    animation: mc-blink 1s step-end infinite;
  }
  @keyframes mc-blink { 0%,100%{opacity:1} 50%{opacity:0.15} }

  .mc-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: #36DBCA;
    color: #061212;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 0.03em;
    padding: 15px 32px;
    border-radius: 100px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: transform 0.15s, box-shadow 0.2s, background 0.2s;
    margin-bottom: 0;
    position: relative; z-index: 1;
    overflow: hidden;
  }
  .mc-cta-btn::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
    transform: translateX(-100%);
    transition: transform 0.5s;
  }
  .mc-cta-btn:hover::before { transform: translateX(100%); }
  .mc-cta-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(54,219,202,0.4); background: #50e8d8; }
  .mc-cta-btn:active { transform: scale(0.97); }

  .mc-skip-btn {
    display: block;
    width: 100%;
    text-align: center;
    font-size: 11.5px;
    color: rgba(255,255,255,0.25);
    cursor: pointer;
    background: none;
    border: none;
    padding: 4px 0;
    position: relative; z-index: 1;
    transition: color 0.2s;
  }
  .mc-skip-btn:hover { color: rgba(255,255,255,0.5); }

  .mc-logo-block {
    display: flex; flex-direction: column; align-items: center; gap: 3px;
    margin-top: 22px;
    position: relative; z-index: 1;
  }
  .mc-logo-name { font-size: 17px; font-weight: 900; color: #fff; letter-spacing: 0.01em; }
  .mc-logo-name span { color: #36DBCA; }
  .mc-logo-name sup { font-size: 10px; font-weight: 400; color: rgba(255,255,255,0.3); vertical-align: super; }
  .mc-logo-bar { width: 30px; height: 2px; background: #36DBCA; border-radius: 2px; margin: 4px 0 2px; }
  .mc-logo-tag { font-size: 10px; color: rgba(255,255,255,0.3); letter-spacing: 0.18em; text-transform: uppercase; font-style: italic; }

  #mc-done-msg {
    display: none;
    text-align: center;
    background: rgba(54,219,202,0.1);
    border: 1px solid rgba(54,219,202,0.3);
    border-radius: 10px;
    padding: 14px;
    font-size: 14px;
    color: #36DBCA;
    margin-bottom: 18px;
    position: relative; z-index: 1;
  }

  /* ── Tablet 768px ── */
  @media (max-width: 768px) {
    #mc-overlay {
      padding: 16px;
      align-items: flex-end;
    }
    #mc-card {
      max-height: 95vh;
      border-radius: 20px 20px 14px 14px;
      padding: 36px 28px 28px;
    }
    .mc-h2 { font-size: clamp(20px, 5vw, 26px); }
    .mc-sub { font-size: 13.5px; }
  }

  /* ── Mobile 480px ── */
  @media (max-width: 480px) {
    #mc-overlay {
      padding: 0;
      align-items: flex-end;
    }
    #mc-card {
      max-width: 100%;
      max-height: 92vh;
      border-radius: 20px 20px 0 0;
      padding: 30px 20px 30px;
    }

    .mc-h2 {
      font-size: clamp(20px, 6vw, 24px);
      line-height: 1.25;
    }
    .mc-h2 br { display: none; }

    .mc-eyebrow { font-size: 11px; margin-bottom: 6px; }
    .mc-sub { font-size: 13px; margin-bottom: 16px; }
    .mc-badge { font-size: 10px; padding: 4px 12px 4px 8px; margin-bottom: 14px; }

    /* Contador */
    .mc-countdown { gap: 5px; margin-bottom: 16px; }
    .mc-box {
      width: min(58px, 20vw);
      height: min(56px, 18vw);
      font-size: clamp(18px, 5.5vw, 24px);
      border-radius: 10px;
    }
    .mc-sep {
      font-size: clamp(16px, 4vw, 22px);
      line-height: min(56px, 18vw);
    }
    .mc-lbl { font-size: 8px; }

    /* Pills */
    .mc-pills {
      gap: 6px;
      margin-top: 12px;
      margin-bottom: 18px;
    }
    .mc-pill { font-size: 11px; padding: 5px 11px; }

    /* CTA */
    .mc-cta-btn {
      font-size: clamp(12px, 3.5vw, 14px);
      padding: 13px 20px;
    }

    /* Cerrar más fácil de tocar */
    #mc-close {
      width: 36px;
      height: 36px;
      font-size: 20px;
      top: 12px;
      right: 14px;
    }

    .mc-divider { margin-top: 16px; margin-bottom: 16px; }
    .mc-cd-label { margin-bottom: 10px; }
  }

  /* ── Extra small 374px ── */
  @media (max-width: 374px) {
    #mc-card { padding: 26px 16px 26px; }
    .mc-h2 { font-size: 19px; }
    .mc-box {
      width: 50px;
      height: 48px;
      font-size: 18px;
    }
    .mc-sep { font-size: 15px; line-height: 48px; }
    .mc-pill { font-size: 10.5px; padding: 4px 9px; }
    .mc-cta-btn { font-size: 12px; padding: 12px 16px; }
    .mc-badge { font-size: 9.5px; }
  }
</style>

<div id="mc-overlay" role="dialog" aria-modal="true" aria-label="Anuncio Masterclass">
  <div id="mc-card">
    <div class="mc-orb mc-orb-1"></div>
    <div class="mc-orb mc-orb-2"></div>

    <button id="mc-close" aria-label="Cerrar">&times;</button>

    <div class="mc-badge"><div class="mc-dot"></div> Masterclass gratuita &middot; Cupos limitados</div>

    <div class="mc-eyebrow">Habla con tus planos —</div>

    <h2 class="mc-h2">
      Revisión de proyectos con<br>
      <span class="mc-teal">Inteligencia Artificial</span>
    </h2>

    <p class="mc-sub">+ Tour en nuestra plataforma <strong>Constructiva</strong></p>

    <div class="mc-divider" style="margin-top:22px;"></div>

    <div id="mc-done-msg">¡El evento ya comenzó! Únete ahora en constructiva.edu.do</div>

    <p class="mc-cd-label">El evento comienza en</p>

    <div class="mc-countdown" id="mc-countdown">
      <div class="mc-unit"><div class="mc-box" id="mc-d">00</div><div class="mc-lbl">Días</div></div>
      <div class="mc-sep">:</div>
      <div class="mc-unit"><div class="mc-box" id="mc-h">00</div><div class="mc-lbl">Horas</div></div>
      <div class="mc-sep">:</div>
      <div class="mc-unit"><div class="mc-box" id="mc-m">00</div><div class="mc-lbl">Min</div></div>
      <div class="mc-sep">:</div>
      <div class="mc-unit"><div class="mc-box" id="mc-s">00</div><div class="mc-lbl">Seg</div></div>
    </div>

    <div class="mc-pills">
      <div class="mc-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <rect x="3" y="4" width="18" height="18" rx="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
        Martes 31 de marzo
      </div>
      <div class="mc-pill">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
        </svg>
        8:00 p.m.
      </div>
    </div>

  </div>
</div>

<script>
(function () {
  var TARGET   = new Date('2026-03-31T20:00:00');
  var SESS_KEY = 'mc_dismissed_v1';
  var DELAY    = 1200;

  function pad(n) { return String(Math.max(0, n)).padStart(2, '0'); }

  var overlay  = document.getElementById('mc-overlay');
  var timer;

  function tick() {
    var diff = TARGET - Date.now();
    if (diff <= 0) {
      document.getElementById('mc-countdown').style.display = 'none';
      document.querySelector('.mc-cd-label').style.display  = 'none';
      document.getElementById('mc-done-msg').style.display  = 'block';
      clearInterval(timer);
      return;
    }
    var d = Math.floor(diff / 86400000);
    var h = Math.floor((diff % 86400000) / 3600000);
    var m = Math.floor((diff % 3600000)  / 60000);
    var s = Math.floor((diff % 60000)    / 1000);
    document.getElementById('mc-d').textContent = pad(d);
    document.getElementById('mc-h').textContent = pad(h);
    document.getElementById('mc-m').textContent = pad(m);
    document.getElementById('mc-s').textContent = pad(s);
  }

  function openModal() {
    document.body.style.overflow = 'hidden';
    overlay.style.display = 'flex';
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        overlay.classList.add('mc-show');
      });
    });
    tick();
    timer = setInterval(tick, 1000);
  }

  function closeModal() {
    overlay.classList.remove('mc-show');
    overlay.classList.add('mc-hide');
    document.body.style.overflow = '';
    try { sessionStorage.setItem(SESS_KEY, '1'); } catch(e) {}
    setTimeout(function () { overlay.style.display = 'none'; }, 420);
  }

  try { if (sessionStorage.getItem(SESS_KEY)) return; } catch(e) {}

  setTimeout(openModal, DELAY);

  document.getElementById('mc-close').addEventListener('click', closeModal);
  overlay.addEventListener('click', function (e) { if (e.target === overlay) closeModal(); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
}());
</script>