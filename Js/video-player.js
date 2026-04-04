// Js/video-player.js
(function(){
  document.querySelectorAll('[data-player]').forEach(container => {
    const vid      = container.querySelector('video');
    const playBtn  = container.querySelector('[data-play]');
    const soundBtn = container.querySelector('[data-sound]');
    const progFill = container.querySelector('[data-progress-fill]');
    const timeEl   = container.querySelector('[data-time]');

    if(!vid) return;

    // Progress + timer
    vid.addEventListener('timeupdate', () => {
      if(!vid.duration) return;
      const pct = vid.currentTime / vid.duration * 100;
      if(progFill) progFill.style.width = pct + '%';
      if(timeEl){
        const s = Math.floor(vid.currentTime % 60).toString().padStart(2,'0');
        const m = Math.floor(vid.currentTime / 60);
        timeEl.textContent = m + ':' + s;
      }
    });

    // Play/Pause
    if(playBtn){
      playBtn.addEventListener('click', () => {
        if(vid.paused){ vid.play(); playBtn.classList.add('playing'); }
        else { vid.pause(); playBtn.classList.remove('playing'); }
      });
    }

    // Sound
    if(soundBtn){
      soundBtn.addEventListener('click', () => {
        vid.muted = !vid.muted;
        soundBtn.classList.toggle('active', !vid.muted);
      });
    }

    // Click barra para seek
    const progBar = container.querySelector('[data-progress-bar]');
    if(progBar){
      progBar.addEventListener('click', e => {
        const rect = progBar.getBoundingClientRect();
        vid.currentTime = ((e.clientX - rect.left) / rect.width) * vid.duration;
      });
    }
  });
})();