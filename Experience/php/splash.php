<style>
  #splash-overlay {
    position: fixed;
    inset: 0;
    background: #050f0f;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: opacity 0.6s ease;
  }
  #splash-overlay.splash-out {
    opacity: 0;
    pointer-events: none;
  }

  .sp-orb {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    filter: blur(90px);
  }
  .sp-orb-1 {
    width: 600px; height: 600px;
    background: radial-gradient(circle, rgba(54,219,202,0.18) 0%, transparent 65%);
    top: -160px; left: -160px;
    animation: spDrift1 6s ease-in-out infinite alternate;
  }
  .sp-orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(54,219,202,0.1) 0%, transparent 65%);
    bottom: -80px; right: -80px;
    animation: spDrift2 8s ease-in-out infinite alternate;
  }
  @keyframes spDrift1 { from{transform:translate(0,0)} to{transform:translate(40px,30px)} }
  @keyframes spDrift2 { from{transform:translate(0,0)} to{transform:translate(-30px,-20px)} }

  .sp-logo {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    animation: spFadeIn 0.8s cubic-bezier(0.16,1,0.3,1) both;
  }
  @keyframes spFadeIn {
    from { opacity: 0; transform: scale(0.95) translateY(12px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
  }

  .sp-name {
    font-family: 'DM Sans', 'Segoe UI', sans-serif;
    font-size: clamp(36px, 8vw, 62px);
    font-weight: 800;
    letter-spacing: -0.02em;
    color: #ffffff;
    line-height: 1;
  }
  .sp-name span { color: #36DBCA; }

  .sp-bar {
    width: 56px;
    height: 3px;
    background: #36DBCA;
    border-radius: 3px;
    margin: 14px auto 10px;
    transform-origin: left;
    animation: spBarGrow 0.6s 0.35s cubic-bezier(0.16,1,0.3,1) both;
  }
  @keyframes spBarGrow {
    from { transform: scaleX(0); opacity: 0; }
    to   { transform: scaleX(1); opacity: 1; }
  }

  .sp-tag {
    font-size: clamp(10px, 1.8vw, 13px);
    font-weight: 300;
    font-style: italic;
    color: rgba(255,255,255,0.38);
    letter-spacing: 0.22em;
    text-transform: uppercase;
    text-align: center;
    animation: spFadeUp 0.6s 0.5s cubic-bezier(0.16,1,0.3,1) both;
  }
  @keyframes spFadeUp {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Barra de progreso */
  .sp-progress-wrap {
    position: absolute;
    bottom: 48px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    z-index: 2;
    animation: spFadeUp 0.5s 0.8s cubic-bezier(0.16,1,0.3,1) both;
  }

  .sp-track {
    width: 130px;
    height: 2px;
    background: rgba(255,255,255,0.1);
    border-radius: 2px;
    overflow: hidden;
  }
  .sp-bar-progress {
    height: 100%;
    width: 0%;
    background: #36DBCA;
    border-radius: 2px;
    animation: spProgress 5s linear 0.2s forwards;
  }
  @keyframes spProgress {
    from { width: 0%; }
    to   { width: 100%; }
  }

  .sp-label {
    font-size: 10.5px;
    color: rgba(255,255,255,0.22);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-family: 'DM Sans', sans-serif;
  }
  .sp-label span { color: rgba(54,219,202,0.55); }

  /* Botón saltar */
  .sp-skip {
    position: absolute;
    top: 22px;
    right: 26px;
    font-size: 11.5px;
    color: rgba(255,255,255,0.2);
    background: none;
    border: none;
    cursor: pointer;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    transition: color 0.2s;
    z-index: 3;
    font-family: 'DM Sans', sans-serif;
    animation: spFadeUp 0.4s 1.2s both;
  }
  .sp-skip:hover { color: rgba(255,255,255,0.55); }

  /* ── Tablet 768px ── */
  @media (max-width: 768px) {
    .sp-orb-1 { width: 400px; height: 400px; top: -120px; left: -120px; }
    .sp-orb-2 { width: 280px; height: 280px; bottom: -60px; right: -60px; }
    .sp-name { font-size: clamp(32px, 9vw, 52px); }
    .sp-tag { font-size: clamp(9px, 2vw, 12px); letter-spacing: 0.18em; }
    .sp-bar { width: 44px; margin: 12px auto 8px; }
    .sp-progress-wrap { bottom: 36px; }
    .sp-skip { top: 18px; right: 20px; font-size: 11px; }
  }

  /* ── Mobile 480px ── */
  @media (max-width: 480px) {
    .sp-orb-1 { width: 280px; height: 280px; top: -80px; left: -80px; filter: blur(60px); }
    .sp-orb-2 { width: 200px; height: 200px; bottom: -40px; right: -40px; filter: blur(60px); }
    .sp-name { font-size: clamp(28px, 10vw, 42px); letter-spacing: -0.01em; }
    .sp-tag {
      font-size: clamp(8.5px, 2.5vw, 11px);
      letter-spacing: 0.14em;
      padding: 0 20px;
    }
    .sp-bar { width: 36px; height: 2px; margin: 10px auto 8px; }
    .sp-progress-wrap { bottom: 28px; gap: 8px; }
    .sp-track { width: 110px; }
    .sp-label { font-size: 10px; }
    .sp-skip { top: 16px; right: 16px; font-size: 10.5px; }
  }

  /* ── Extra small 374px ── */
  @media (max-width: 374px) {
    .sp-name { font-size: clamp(24px, 11vw, 34px); }
    .sp-tag { font-size: 8px; letter-spacing: 0.1em; }
    .sp-bar { width: 30px; }
    .sp-track { width: 90px; }
    .sp-progress-wrap { bottom: 24px; }
    .sp-skip { font-size: 10px; top: 14px; right: 14px; }
  }
</style>

<div id="splash-overlay">
  <div class="sp-orb sp-orb-1"></div>
  <div class="sp-orb sp-orb-2"></div>

  <button class="sp-skip" onclick="splashDismiss()">Saltar &rarr;</button>

  <div class="sp-logo">
    <div class="sp-name"><img src="../img/Logo aqua.png" width="550px" height="auto"></div>
    <div class="sp-bar"></div>
    <div class="sp-tag">&nbsp;&nbsp; Learn. Apply. Lead.</div>
  </div>

  <div class="sp-progress-wrap">
    <div class="sp-track">
      <div class="sp-bar-progress"></div>
    </div>
    <div class="sp-label">Entrando en <span id="sp-counter">5</span>s</div>
  </div>
</div>

<script>
(function () {
  // Si ya vio el splash esta sesion, lo ocultamos instantaneamente
  try {
    if (sessionStorage.getItem('sp_seen')) {
      var el = document.getElementById('splash-overlay');
      if (el) el.style.display = 'none';
      return;
    }
  } catch(e) {}

  var count  = 5;
  var countEl = document.getElementById('sp-counter');
  var timer;

  timer = setInterval(function () {
    count--;
    if (countEl && count >= 0) countEl.textContent = count;
    if (count <= 0) clearInterval(timer);
  }, 1000);

  window.splashDismiss = function () {
    clearInterval(timer);
    try { sessionStorage.setItem('sp_seen', '1'); } catch(e) {}
    var overlay = document.getElementById('splash-overlay');
    if (overlay) {
      overlay.classList.add('splash-out');
      setTimeout(function () {
        overlay.style.display = 'none';
        document.body.style.overflow = '';
      }, 620);
    }
  };

  // Bloquear scroll del index mientras el splash está visible
  document.body.style.overflow = 'hidden';

  setTimeout(window.splashDismiss, 5000);
}());
</script>