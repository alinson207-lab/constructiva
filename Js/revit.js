
  // Cursor
  const cursor = document.getElementById('cursor');
  const ring   = document.getElementById('cursorRing');
  let mx=0, my=0, rx=0, ry=0;
  document.addEventListener('mousemove', e => {
    mx = e.clientX; my = e.clientY;
    cursor.style.transform = `translate(${mx-5}px,${my-5}px)`;
  });
  (function animRing(){
    rx += (mx-rx-16)*.1; ry += (my-ry-16)*.1;
    ring.style.transform = `translate(${rx}px,${ry}px)`;
    requestAnimationFrame(animRing);
  })();
  document.querySelectorAll('a,button').forEach(el => {
    el.addEventListener('mouseenter', ()=>{ ring.style.transform += ' scale(1.6)'; ring.style.opacity='.8'; });
    el.addEventListener('mouseleave', ()=>{ ring.style.opacity='.4'; });
  });

  // Progress bar
  const bar = document.getElementById('progressBar');
  window.addEventListener('scroll', ()=>{
    const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100;
    bar.style.width = pct + '%';
  });

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const obs = new IntersectionObserver(entries => {
    entries.forEach((e,i) => {
      if(e.isIntersecting){
        e.target.style.transitionDelay = (i%4)*.07+'s';
        e.target.classList.add('visible');
        obs.unobserve(e.target);
      }
    });
  }, {threshold:.1});
  reveals.forEach(r => obs.observe(r));

  // Toggle module
  function toggleModule(btn){
    const mod = btn.closest('.module');
    const isOpen = mod.classList.contains('open');
    document.querySelectorAll('.module.open').forEach(m => m.classList.remove('open'));
    if(!isOpen) mod.classList.add('open');
  }

  // Toggle FAQ
  function toggleFaq(btn){
    const item = btn.closest('.faq-item');
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item.open').forEach(f => f.classList.remove('open'));
    if(!isOpen) item.classList.add('open');
  }

  function loadVideo() {
  const container = document.getElementById('videoContainer');
  container.innerHTML = `
    <iframe
      width="100%" height="100%"
      src="https://www.youtube.com/embed/uh3CDOYGcto?autoplay=1&controls=1"
      frameborder="0"
      allow="autoplay; encrypted-media; fullscreen"
      allowfullscreen>
    </iframe>
  `;
  container.style.padding = '0';
  container.style.cursor = 'default';
}

// Sticky video controls
(function(){
  const vid      = document.getElementById('stickyVideo');
  const playBtn  = document.getElementById('stickyPlayBtn');
  const soundBtn = document.getElementById('stickySoundBtn');
  const progFill = document.getElementById('stickyProgressFill');
  if(!vid) return;

  vid.addEventListener('timeupdate', () => {
    if(vid.duration) progFill.style.width = (vid.currentTime / vid.duration * 100) + '%';
  });
  playBtn.addEventListener('click', () => {
    if(vid.paused){ vid.play(); playBtn.classList.add('playing'); }
    else { vid.pause(); playBtn.classList.remove('playing'); }
  });
  soundBtn.addEventListener('click', () => {
    vid.muted = !vid.muted;
    soundBtn.classList.toggle('active', !vid.muted);
  });
})();


  document.addEventListener('DOMContentLoaded', function () {
    CVSession.injectNav({
      type: 'course',
      ctaLabel: 'Inscribirme',
      ctaHref:  '#inscribirse',
    });
  });

  const timeEl = document.getElementById('stickyTime');

vid.addEventListener('timeupdate', () => {
  if(vid.duration){
    progFill.style.width = (vid.currentTime / vid.duration * 100) + '%';
    const s = Math.floor(vid.currentTime % 60).toString().padStart(2,'0');
    const m = Math.floor(vid.currentTime / 60);
    timeEl.textContent = m + ':' + s;
  }
});
