/**
 * cv-session.js — Constructiva
 * ─────────────────────────────────────────────────────────────
 * Módulo compartido de sesión. Una sola línea en cada página:
 *   <script src="/Js/cv-session.js"></script>
 *
 * TIPOS DE NAV:
 *   'index'   → nav del index.html  (logo img + dropdown + links)
 *               Solo reemplaza el <li> con .nav-cta
 *   'course'  → nav simple de páginas de curso (back · logo · cta)
 *               Reemplaza el último enlace por chip o login
 *   'lesson'  → topnav horizontal de Lecciones.html
 *               Inserta chip en .topnav-right
 * ─────────────────────────────────────────────────────────────
 */

(function () {
  'use strict';

  // ✅ Rutas absolutas — funcionan desde cualquier página del sitio
  const API_BASE     = '/Php';
  const TOKEN_KEY    = 'cv_token';
  const USER_KEY     = 'cv_user';
  const LOGIN_PAGE   = '/loginhome.php';
  const HOME_STUDENT = '/Homestudent.php';

  /* ─── Storage ────────────────────────────────────────────── */

  function saveToken(token) {
    localStorage.setItem(TOKEN_KEY, token);
    document.cookie = `cv_token=${token}; path=/; max-age=600; SameSite=Lax`;
  }

  function getToken() {
    const ls = localStorage.getItem(TOKEN_KEY);
    if (ls) return ls;
    const m = document.cookie.match(/(?:^|;\s*)cv_token_js=([^;]+)/);
    if (m) { localStorage.setItem(TOKEN_KEY, m[1]); return m[1]; }
    const m2 = document.cookie.match(/(?:^|;\s*)cv_token=([^;]+)/);
    if (m2) { localStorage.setItem(TOKEN_KEY, m2[1]); return m2[1]; }
    return null;
  }

  function saveUser(user) {
    localStorage.setItem(USER_KEY, JSON.stringify(user));
  }

  function getUser() {
    try { return JSON.parse(localStorage.getItem(USER_KEY)); } catch { return null; }
  }

  function clearSession() {
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(USER_KEY);
    document.cookie = 'cv_token=; path=/; max-age=0';
    document.cookie = 'cv_token_js=; path=/; max-age=0';
  }

  /* ─── Auth ───────────────────────────────────────────────── */

  // ✅ Rutas absolutas
  const LOGOUT_API   = '/Php/logout.php';
  const ACTIVITY_API = '/Php/activity.php';

  function logout() {
    const token = getToken();
    clearSession();
    if (token) {
      fetch(LOGOUT_API, {
        method: 'POST',
        headers: { 'Authorization': 'Bearer ' + token },
        keepalive: true,
      })
      .catch(() => {})
      .finally(() => { window.location.href = LOGIN_PAGE; });
    } else {
      window.location.href = LOGIN_PAGE;
    }
  }

  function logoutBeacon() {
    const token = getToken();
    clearSession();
    if (token) navigator.sendBeacon(LOGOUT_API, '{}');
  }

  async function fetchProfile() {
    const token = getToken();
    if (!token) return null;
    try {
      const res  = await fetch(`${API_BASE}/perfil.php`, {
        headers: { Authorization: `Bearer ${token}` }
      });
      const json = await res.json();
      if (json.ok) { saveUser(json.data); return json.data; }
      return null;
    } catch { return null; }
  }

  async function requireAuth(redirectTo = LOGIN_PAGE) {
    if (!getToken()) { window.location.href = redirectTo; return null; }
    let user = getUser() || await fetchProfile();
    if (!user) { clearSession(); window.location.href = redirectTo; return null; }
    return user;
  }

  /* ─── Estilos del chip ───────────────────────────────────── */

  function ensureStyles() {
    if (document.getElementById('cv-session-styles')) return;
    const s = document.createElement('style');
    s.id = 'cv-session-styles';
    s.textContent = `
      .cv-user-chip {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        background: rgba(16,176,158,.10);
        border: 1.5px solid rgba(16,176,158,.28);
        border-radius: 100px;
        padding: .35rem .9rem .35rem .55rem;
        font-family: 'DM Sans', sans-serif;
        font-size: .82rem;
        font-weight: 500;
        color: var(--teal-vivid, #0db39e);
        cursor: pointer;
        transition: background .2s, border-color .2s, transform .15s;
        white-space: nowrap;
        user-select: none;
        text-decoration: none;
        vertical-align: middle;
      }
      .cv-user-chip:hover {
        background: rgba(16,176,158,.18);
        border-color: rgba(16,176,158,.55);
        transform: translateY(-1px);
      }
      .cv-user-chip .cv-avatar  { font-size: 1rem; line-height: 1; }
      .cv-user-chip .cv-name    { max-width: 130px; overflow: hidden; text-overflow: ellipsis; }
      .cv-user-chip .cv-logout  { opacity: .45; flex-shrink: 0; }
      li .cv-user-chip           { font-size: .85rem; padding: .4rem 1rem .4rem .65rem; }
    `;
    document.head.appendChild(s);
  }

  /* ─── HTML del chip ──────────────────────────────────────── */

  function chipHTML(user) {
    return `<span class="cv-user-chip" onclick="CVSession.logout()" title="Cerrar sesión">
      <span class="cv-avatar">${user.avatar_emoji || '👤'}</span>
      <span class="cv-name">${user.nombre}</span>
      <svg class="cv-logout" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/>
      </svg>
    </span>`;
  }

  /* ─── injectNav ──────────────────────────────────────────── */

  function injectNav(opts = {}) {
    const {
      type          = 'course',
      ctaHref       = '#inscribirse',
      ctaLabel      = 'Inscribirme',
      backHref      = '/',
      backLabel     = 'Volver al inicio',
    } = opts;

    ensureStyles();
    const user = getUser();

    if (type === 'index') {
      const ctaLink = document.querySelector('nav .nav-cta');
      if (!ctaLink) return;
      const li = ctaLink.closest('li');
      if (!li) return;
      if (user) { li.innerHTML = chipHTML(user); }
      return;
    }

    if (type === 'course') {
      const nav = document.querySelector('nav:not(.topnav)');
      if (!nav) return;
      const lastLink = nav.querySelector('a.nav-cta-small');
      if (lastLink) lastLink.remove();
      if (user) {
        nav.insertAdjacentHTML('beforeend', chipHTML(user));
      } else {
        nav.insertAdjacentHTML('beforeend',
          `<a href="${ctaHref}" class="nav-cta-small">${ctaLabel}</a>`);
      }
      return;
    }

    if (type === 'lesson') {
      const right = document.querySelector('.topnav-right');
      if (!right) return;
      const prev = right.querySelector('.cv-user-chip');
      if (prev) prev.remove();
      const completeBtn = right.querySelector('.complete-btn');
      if (user) {
        const tmp = document.createElement('span');
        tmp.innerHTML = chipHTML(user);
        const chip = tmp.firstElementChild;
        completeBtn ? right.insertBefore(chip, completeBtn) : right.appendChild(chip);
      } else {
        const a = document.createElement('a');
        a.href = LOGIN_PAGE;
        a.className = 'nav-cta-small';
        a.textContent = 'Iniciar sesión';
        completeBtn ? right.insertBefore(a, completeBtn) : right.appendChild(a);
      }
      return;
    }
  }

  /* ─── Inactividad 10 min ────────────────────────────────── */

  const INACTIVITY_MS = 10 * 60 * 1000;
  const PING_MS       =  2 * 60 * 1000;
  let   inactivityTimer = null;
  let   activityPending = false;

  function resetInactivityTimer() {
    clearTimeout(inactivityTimer);
    localStorage.setItem('cv_last_activity', Date.now().toString());
    activityPending = true;
    inactivityTimer = setTimeout(() => logout(), INACTIVITY_MS);
  }

  function pingBackend() {
    if (!activityPending) return;
    activityPending = false;
    const token = getToken();
    if (!token) return;
    fetch(ACTIVITY_API, {
      method: 'POST',
      headers: { 'Authorization': 'Bearer ' + token },
    }).then(r => { if (r.status === 401) logout(); }).catch(() => {});
  }

  function initActivityWatcher() {
    if (!getToken()) return;
    ['mousemove','keydown','click','scroll','touchstart'].forEach(evt =>
      document.addEventListener(evt, resetInactivityTimer, { passive: true })
    );
    resetInactivityTimer();
    setInterval(pingBackend, PING_MS);

    // ✅ Fix: solo cerrar sesión en cierre real de pestaña, no en navegación normal
    window.addEventListener('pagehide', function(e) {
      if (!e.persisted && !navigator.userActivation?.isActive) {
        logoutBeacon();
      }
    });
  }

  /* ─── Auto-sincronización al cargar ─────────────────────── */

  document.addEventListener('DOMContentLoaded', () => {
    const m = document.cookie.match(/(?:^|;\s*)cv_token_js=([^;]+)/);
    if (m && !localStorage.getItem(TOKEN_KEY)) {
      localStorage.setItem(TOKEN_KEY, m[1]);
      fetchProfile();
    }
    initActivityWatcher();
  });

  /* ─── API pública ────────────────────────────────────────── */

  window.CVSession = {
    getToken, getUser, saveToken, saveUser,
    logout, logoutBeacon, requireAuth, fetchProfile, injectNav,
    initActivityWatcher, LOGIN_PAGE, HOME_STUDENT,
  };

})();