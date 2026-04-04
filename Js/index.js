  // Custom Cursor
  const cursor = document.getElementById('cursor');
  const ring   = document.getElementById('cursor-ring');
  let mx = 0, my = 0, rx = 0, ry = 0;

  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    cursor.style.transform = `translate(${mx - 6}px, ${my - 6}px)`;
  });

  function animateRing() {
    rx += (mx - rx - 18) * .12;
    ry += (my - ry - 18) * .12;
    ring.style.transform = `translate(${rx}px, ${ry}px)`;
    requestAnimationFrame(animateRing);
  }
  animateRing();

  document.querySelectorAll('a, button').forEach(el => {
    el.addEventListener('mouseenter', () => { cursor.style.transform += ' scale(1.6)'; ring.style.opacity = '.9'; });
    el.addEventListener('mouseleave', () => { ring.style.opacity = '.5'; });
  });

  // Navbar scroll — goes white after hero
  const navbar = document.getElementById('navbar');
  const heroHeight = document.querySelector('.hero').offsetHeight;
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > heroHeight * 0.6);
  });

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver(entries => {
    entries.forEach((e, i) => {
      if (e.isIntersecting) {
        e.target.style.transitionDelay = (i % 4) * 0.08 + 's';
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  reveals.forEach(r => observer.observe(r));


  /* ── HERO VIDEO PLAYER ── */
(function () {
  const video       = document.getElementById('heroVideo');
  const playBtn     = document.getElementById('heroPlayBtn');
  const soundBtn    = document.getElementById('heroSoundBtn');
  const progressBar = document.getElementById('heroProgress');
  const fill        = document.getElementById('heroProgressFill');

  if (!video) return;

  // El video arranca en autoplay muted
  video.volume = 0.25;

  // Play / Pause
  playBtn.addEventListener('click', () => {
    if (video.paused) {
      video.play();
      playBtn.classList.add('playing');
      playBtn.title = 'Pausar';
    } else {
      video.pause();
      playBtn.classList.remove('playing');
      playBtn.title = 'Reproducir';
    }
  });

  // Sonido
  soundBtn.addEventListener('click', () => {
    video.muted = !video.muted;
    soundBtn.classList.toggle('unmuted', !video.muted);
    soundBtn.title = video.muted ? 'Activar sonido' : 'Silenciar';
  });

  // Barra de progreso (actualización)
  video.addEventListener('timeupdate', () => {
    if (!video.duration) return;
    const pct = (video.currentTime / video.duration) * 100;
    fill.style.width = pct + '%';
  });

  // Click en barra → seek
  progressBar.addEventListener('click', (e) => {
    const rect = progressBar.getBoundingClientRect();
    const ratio = (e.clientX - rect.left) / rect.width;
    video.currentTime = ratio * video.duration;
  });
})();