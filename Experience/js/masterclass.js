// =============================================
// MASTERCLASS REGISTRO — js/masterclass.js
// =============================================

// ── Countdown ────────────────────────────────
var TARGET = new Date('2026-03-31T20:00:00');

function pad(n) { return String(Math.max(0, n)).padStart(2, '0'); }

function tick() {
  var diff = TARGET - Date.now();

  if (diff <= 0) {
    var cd = document.getElementById('countdown');
    var lbl = document.querySelector('.cd-label');
    var done = document.getElementById('done-msg');
    if (cd)   cd.style.display   = 'none';
    if (lbl)  lbl.style.display  = 'none';
    if (done) done.style.display = 'block';
    return;
  }

  var d = Math.floor(diff / 86400000);
  var h = Math.floor((diff % 86400000) / 3600000);
  var m = Math.floor((diff % 3600000)  / 60000);
  var s = Math.floor((diff % 60000)    / 1000);

  document.getElementById('cd-d').textContent = pad(d);
  document.getElementById('cd-h').textContent = pad(h);
  document.getElementById('cd-m').textContent = pad(m);
  document.getElementById('cd-s').textContent = pad(s);
}

tick();
setInterval(tick, 1000);

// ── Form ─────────────────────────────────────
function submitForm() {
  var emailEl = document.getElementById('email-input');
  var errorEl = document.getElementById('form-error');
  var btn     = document.getElementById('form-submit');
  var email   = emailEl.value.trim();
  var re      = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  errorEl.style.display = 'none';

  if (!email) {
    showError('Por favor ingresa tu correo electrónico.');
    emailEl.focus();
    return;
  }
  if (!re.test(email)) {
    showError('El correo no parece válido. Revísalo.');
    emailEl.focus();
    return;
  }

  btn.disabled = true;
  btn.innerHTML = 'Enviando... <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/></svg>';

  var fd = new FormData();
  fd.append('email', email);
  fd.append('accion', 'notificacion_masterclass');

  fetch('php/registro_notificacion.php', {
    method: 'POST',
    body: fd
  })
  .then(function(r) { return r.json(); })
  .then(function(data) {
    if (data.success) {
      showSuccess();
    } else {
      btn.disabled = false;
      btn.innerHTML = 'Notifícame <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
      showError(data.message || 'Ocurrió un error. Intenta de nuevo.');
    }
  })
  .catch(function() {
    showSuccess(); // modo demo si no hay backend aún
  });
}

function showError(msg) {
  var el = document.getElementById('form-error');
  el.textContent = msg;
  el.style.display = 'block';
}

function showSuccess() {
  document.getElementById('register-form').style.display = 'none';
  document.getElementById('success-msg').style.display   = 'block';
}

// Enter en el input
document.addEventListener('DOMContentLoaded', function() {
  var input = document.getElementById('email-input');
  if (input) {
    input.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') submitForm();
    });
  }
});