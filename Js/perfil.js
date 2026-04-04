(async () => {
  function readToken() {
    const ls = localStorage.getItem('cv_token');
    if (ls) return ls;
    const m1 = document.cookie.match(/(?:^|;\s*)cv_token_js=([^;]+)/);
    if (m1) return decodeURIComponent(m1[1]);
    const m2 = document.cookie.match(/(?:^|;\s*)cv_token=([^;]+)/);
    if (m2) return decodeURIComponent(m2[1]);
    return null;
  }

  const token = readToken();
  if (!token) { window.location.href = '/loginhome.php'; return; }

  // ✅ Helper para abrir el file picker correctamente
  function openFilePicker() {
    const inp = document.getElementById('photo-input');
    inp.value = ''; // reset para permitir seleccionar el mismo archivo
    inp.click();
  }

  function toast(msg, type='ok') {
    const el = document.getElementById('toast');
    el.textContent = msg;
    el.className = 'toast ' + type + ' on';
    clearTimeout(el._t);
    el._t = setTimeout(() => el.className = 'toast', 3200);
  }

  function spin(b, t) {
    b.disabled = true;
    b.dataset.o = b.innerHTML;
    b.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spi .7s linear infinite"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 100 .49"/></svg> ${t}`;
  }
  function unspin(b) { b.disabled = false; b.innerHTML = b.dataset.o; }

  let P;
  try {
    const r = await fetch('/Php/perfil.php', { headers: { Authorization: 'Bearer ' + token } });
    const j = await r.json();
    if (!j.ok) { window.location.href = '/loginhome.php'; return; }
    P = j.data;
  } catch {
    document.getElementById('main-ld').innerHTML = '<p style="color:#c43a3a;font-size:.85rem">Error de conexión. Recarga la página.</p>';
    return;
  }

  const EMOJIS = ['👤','👨‍💼','👩‍💼','👨‍🔧','👩‍🔧','🏗️','🏛️','⚙️','🔧','📐','📏','🚀','🎯','💡','🌟','🔥','⚡','🎓','💼','🏆','🌎'];
  let curE   = P.avatar_emoji || '👤';
  let pBlob  = null;
  let pURL   = null;
  const hasPhoto = !!P.avatar_foto;

  function avContent() {
    if (pURL)     return `<img src="${pURL}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block">`;
    if (hasPhoto) return `<img src="/Php/avatar.php?id=${P.id}&t=${Date.now()}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;display:block">`;
    return `<div class="efb">${curE}</div>`;
  }

  function syncAvatars() {
    const avIn = document.getElementById('av-in');
    if (avIn) avIn.innerHTML = avContent();
    const headerAv = document.getElementById('header-av');
    if (headerAv) {
      headerAv.innerHTML = pURL || hasPhoto
        ? `<img src="${pURL || `/Php/avatar.php?id=${P.id}&t=${Date.now()}`}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`
        : curE;
    }
  }

  // ── SIDEBAR ──────────────────────────────────────────────
  function renderSB() {
    document.getElementById('sidebar').innerHTML = `
      <div class="av-wrap">
        <div class="av-ring" id="av-ring" title="Cambiar foto">
          <div class="av-inner" id="av-in">${avContent()}</div>
          <div class="av-ov">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
            <span>Cambiar</span>
          </div>
        </div>
        <div class="sb-name" id="sb-nm">${P.nombre} ${P.apellido}</div>
        <div class="sb-badge">🎓 Estudiante</div>
        <div class="sb-sub" id="sb-sub">${P.profesion || P.ciudad
          ? (P.profesion || '') + (P.profesion && P.ciudad ? ' · ' : '') + (P.ciudad || '')
          : 'Constructiva Experience'}</div>
      </div>

      <div class="sb-hr"></div>

      <div class="sb-stats">
        <div class="sb-st"><div class="sb-st-n">${P.cursos_activos    || 0}</div><div class="sb-st-l">Activos</div></div>
        <div class="sb-st"><div class="sb-st-n">${P.cursos_finalizados|| 0}</div><div class="sb-st-l">Final.</div></div>
        <div class="sb-st"><div class="sb-st-n">${P.certificados      || 0}</div><div class="sb-st-l">Certs.</div></div>
      </div>

      <div class="sb-hr"></div>

      <nav class="sb-nav">
        <button class="sbn on" data-s="datos">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          Información Personal
        </button>
        <button class="sbn" data-s="seguridad">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
          Seguridad
        </button>
        <a href="/dashboard" class="sbn">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
          Mi Espacio
        </a>
      </nav>

      <div class="sb-push"></div>
      <div class="sb-foot">
        Miembro desde<br>
        <strong style="color:rgba(255,255,255,.38)">
          ${new Date(P.created_at).toLocaleDateString('es-DO', { month: 'long', year: 'numeric' })}
        </strong>
      </div>
    `;

    // ✅ Click en avatar sidebar — usa openFilePicker
    document.getElementById('av-ring').addEventListener('click', openFilePicker);

    document.querySelectorAll('.sbn[data-s]').forEach(b => {
      b.addEventListener('click', () => {
        document.querySelectorAll('.sbn').forEach(x => x.classList.remove('on'));
        b.classList.add('on');
        document.querySelectorAll('.sec').forEach(s => s.classList.remove('on'));
        document.getElementById('s-' + b.dataset.s).classList.add('on');
      });
    });
  }

  // ── MAIN ─────────────────────────────────────────────────
  function renderMain() {
    document.getElementById('main').innerHTML = `

      <div class="sec on" id="s-datos">

        <div class="profile-hero">
          <!-- ✅ Sin onclick inline — se agrega por JS en bindEvents -->
          <div class="ph-av" id="ph-avatar" title="Cambiar foto">
            <div id="header-av" class="ph-av-inner">${pURL || hasPhoto
              ? `<img src="${pURL || `/Php/avatar.php?id=${P.id}&t=${Date.now()}`}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`
              : curE}</div>
            <div class="ph-av-ov">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
            </div>
          </div>
          <div class="ph-info">
            <h2 id="ph-name">${P.nombre} ${P.apellido}</h2>
            <p id="ph-sub">${P.profesion || P.ciudad
              ? (P.profesion || '') + (P.profesion && P.ciudad ? ' · ' : '') + (P.ciudad || '')
              : 'Sin profesión · Sin ciudad'}</p>
            <span class="pb" id="pb">● Foto pendiente de guardar</span>
          </div>
        </div>

        <div class="two-col">
          <div class="col-left">
            <div class="card">
              <div class="card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                Información Personal
              </div>
              <div class="fg">
                <div class="f"><label>Nombre</label><input type="text" id="f-n" value="${P.nombre}" placeholder="Tu nombre"></div>
                <div class="f"><label>Apellido</label><input type="text" id="f-a" value="${P.apellido}" placeholder="Tu apellido"></div>
                <div class="f s2"><label>Correo Electrónico</label><input type="email" id="f-e" value="${P.email}" placeholder="correo@ejemplo.com"></div>
                <div class="f"><label>Profesión</label><input type="text" id="f-p" value="${P.profesion || ''}" placeholder="Ej: Ingeniero Civil"></div>
                <div class="f"><label>Ciudad / País</label><input type="text" id="f-c" value="${P.ciudad || ''}" placeholder="Ej: Santo Domingo"></div>
              </div>
              <div class="dv"></div>
              <div class="f" style="margin-bottom:.9rem">
                <label>Emoji Avatar</label>
                <div class="ep-row">
                  <div class="ep-box" id="ep-box">${curE}</div>
                  <button class="btn btn-s" id="ep-tog">Cambiar emoji</button>
                </div>
                <div class="ep-grid" id="ep-grid">
                  ${EMOJIS.map(e => `<button class="epb${e === curE ? ' s' : ''}" data-e="${e}">${e}</button>`).join('')}
                </div>
              </div>
              <div class="br">
                <button class="btn btn-s" onclick="location.href='/'">Cancelar</button>
                <button class="btn btn-p" id="save-btn">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                  Guardar cambios
                </button>
              </div>
            </div>
          </div>

          <div class="col-right">
            <div class="card">
              <div class="card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Seguridad
              </div>
              <div class="f" style="margin-bottom:.85rem"><label>Contraseña Actual</label><input type="password" id="p-a" placeholder="••••••••"></div>
              <div class="f" style="margin-bottom:.85rem">
                <label>Nueva Contraseña</label>
                <input type="password" id="p-n" placeholder="Mínimo 8 caracteres">
                <div class="pw-strength" id="pw-str"></div>
              </div>
              <div class="f" style="margin-bottom:1.1rem"><label>Confirmar Nueva</label><input type="password" id="p-c" placeholder="Repite la contraseña"></div>
              <button class="btn btn-p" id="pwd-btn" style="width:100%;justify-content:center">Actualizar contraseña</button>
            </div>

            <div class="card">
              <div class="card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/></svg>
                Estadísticas
              </div>
              <div class="stats-row">
                <div class="stat-item"><div class="stat-n teal">${P.cursos_activos || 0}</div><div class="stat-l">Activos</div></div>
                <div class="stat-item"><div class="stat-n green">${P.cursos_finalizados || 0}</div><div class="stat-l">Finalizados</div></div>
                <div class="stat-item"><div class="stat-n purple">${P.certificados || 0}</div><div class="stat-l">Certificados</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sec" id="s-seguridad">
        <div class="sec-header">
          <div class="sec-label">Cuenta</div>
          <div class="sec-title">Seguridad</div>
          <div class="sec-sub">Gestiona el acceso a tu cuenta</div>
        </div>
        <div class="two-col">
          <div>
            <div class="card">
              <div class="card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Cambiar contraseña
              </div>
              <div class="f" style="margin-bottom:.85rem"><label>Contraseña actual</label><input type="password" id="p-a2" placeholder="••••••••"></div>
              <div class="f" style="margin-bottom:.85rem">
                <label>Nueva contraseña</label>
                <input type="password" id="p-n2" placeholder="Mínimo 8 caracteres">
                <div class="pw-strength" id="pw-str2"></div>
              </div>
              <div class="f" style="margin-bottom:1.1rem"><label>Confirmar nueva</label><input type="password" id="p-c2" placeholder="Repite la contraseña"></div>
              <button class="btn btn-p" id="pwd-btn2" style="width:100%;justify-content:center">Actualizar contraseña</button>
            </div>
          </div>
          <div>
            <div class="card danger-zone">
              <div class="card-title">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                Cerrar sesión
              </div>
              <p style="font-size:.83rem;color:var(--muted);margin-bottom:1rem;line-height:1.6">Cierra tu sesión en este dispositivo.</p>
              <button class="btn btn-danger" onclick="CVSession.logout()" style="width:100%;justify-content:center">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                Cerrar sesión
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    bindEvents();
  }

  // ── Eventos ──────────────────────────────────────────────
  function bindEvents() {

    // ✅ Click en avatar del hero — usa openFilePicker
    document.getElementById('ph-avatar')?.addEventListener('click', openFilePicker);

    // Emoji picker
    document.getElementById('ep-tog').addEventListener('click', () =>
      document.getElementById('ep-grid').classList.toggle('open')
    );
    document.getElementById('ep-grid').addEventListener('click', e => {
      const b = e.target.closest('.epb');
      if (!b) return;
      curE = b.dataset.e;
      document.getElementById('ep-box').textContent = curE;
      document.querySelectorAll('.epb').forEach(x => x.classList.remove('s'));
      b.classList.add('s');
      document.getElementById('ep-grid').classList.remove('open');
      if (!pURL && !hasPhoto) {
        const ha = document.getElementById('header-av');
        if (ha) ha.textContent = curE;
        const ai = document.getElementById('av-in');
        if (ai) { const ef = ai.querySelector('.efb'); if (ef) ef.textContent = curE; }
      }
    });

    // Password strength
    function checkStrength(val, barId) {
      const bar = document.getElementById(barId);
      if (!bar) return;
      if (!val) { bar.className = 'pw-strength'; return; }
      if (val.length < 6) bar.className = 'pw-strength weak';
      else if (val.length < 10 || !/[0-9]/.test(val) || !/[A-Z]/.test(val)) bar.className = 'pw-strength medium';
      else bar.className = 'pw-strength strong';
    }
    document.getElementById('p-n')?.addEventListener('input',  e => checkStrength(e.target.value, 'pw-str'));
    document.getElementById('p-n2')?.addEventListener('input', e => checkStrength(e.target.value, 'pw-str2'));

    // Guardar datos
    document.getElementById('save-btn').addEventListener('click', async () => {
      const btn = document.getElementById('save-btn');
      spin(btn, 'Guardando…');

      if (pBlob) {
        const fd = new FormData();
        fd.append('foto', pBlob);
        try {
          const r = await fetch('/Php/avatar_upload.php', { method:'POST', headers:{ Authorization:'Bearer '+token }, body:fd });
          const j = await r.json();
          if (j.ok) { pBlob = null; const pb = document.getElementById('pb'); if (pb) pb.classList.remove('on'); }
          else toast('Error al subir foto: ' + (j.error || ''), 'err');
        } catch { toast('Error al subir foto', 'err'); }
      }

      const body = {
        nombre:       document.getElementById('f-n').value.trim(),
        apellido:     document.getElementById('f-a').value.trim(),
        email:        document.getElementById('f-e').value.trim(),
        profesion:    document.getElementById('f-p').value.trim(),
        ciudad:       document.getElementById('f-c').value.trim(),
        avatar_emoji: curE,
      };

      try {
        const r = await fetch('/Php/perfil.php', { method:'PUT', headers:{ Authorization:'Bearer '+token, 'Content-Type':'application/json' }, body:JSON.stringify(body) });
        const j = await r.json();
        if (j.ok) {
          const nm  = document.getElementById('sb-nm');  if (nm)  nm.textContent  = body.nombre + ' ' + body.apellido;
          const sub = document.getElementById('sb-sub'); if (sub) sub.textContent = body.profesion && body.ciudad ? body.profesion+' · '+body.ciudad : body.profesion||body.ciudad||'Constructiva Experience';
          const phn = document.getElementById('ph-name'); if (phn) phn.textContent = body.nombre + ' ' + body.apellido;
          const phs = document.getElementById('ph-sub');  if (phs) phs.textContent = body.profesion && body.ciudad ? body.profesion+' · '+body.ciudad : body.profesion||body.ciudad||'Sin profesión · Sin ciudad';
          CVSession.saveUser({ ...(CVSession.getUser()||{}), ...body });
          toast('✓ Perfil actualizado');
        } else { toast(j.error || 'Error al guardar', 'err'); }
      } catch { toast('Error de conexión', 'err'); }

      unspin(btn);
    });

    // Cambiar contraseña
    async function cambiarPassword(aId, nId, cId, btnId, strId) {
      const btn = document.getElementById(btnId);
      const a = document.getElementById(aId).value;
      const n = document.getElementById(nId).value;
      const c = document.getElementById(cId).value;
      if (!a || !n)     { toast('Completa todos los campos', 'err'); return; }
      if (n.length < 8) { toast('Mínimo 8 caracteres', 'err'); return; }
      if (n !== c)      { toast('Las contraseñas no coinciden', 'err'); return; }
      spin(btn, 'Actualizando…');
      try {
        const r = await fetch('/Php/perfil.php?action=password', { method:'POST', headers:{ Authorization:'Bearer '+token, 'Content-Type':'application/json' }, body:JSON.stringify({ password_actual:a, password_nueva:n }) });
        const j = await r.json();
        if (j.ok) {
          [aId,nId,cId].forEach(id => document.getElementById(id).value = '');
          const bar = document.getElementById(strId); if (bar) bar.className = 'pw-strength';
          toast('✓ Contraseña actualizada');
        } else { toast(j.error || 'Error', 'err'); }
      } catch { toast('Error de conexión', 'err'); }
      unspin(btn);
    }

    document.getElementById('pwd-btn') ?.addEventListener('click', () => cambiarPassword('p-a',  'p-n',  'p-c',  'pwd-btn',  'pw-str'));
    document.getElementById('pwd-btn2')?.addEventListener('click', () => cambiarPassword('p-a2', 'p-n2', 'p-c2', 'pwd-btn2', 'pw-str2'));
  }

  // ── File input change ────────────────────────────────────
  document.getElementById('photo-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    if (file.size > 5 * 1024 * 1024) { toast('Máximo 5 MB', 'err'); return; }

    const url = URL.createObjectURL(file);
    document.getElementById('modal-img').src = url;
    document.getElementById('modal').classList.add('open');

    document.getElementById('m-ok').onclick = () => {
      pBlob = file;
      pURL  = url;
      syncAvatars();
      const pb = document.getElementById('pb'); if (pb) pb.classList.add('on');
      document.getElementById('modal').classList.remove('open');
      toast('Foto lista · guarda para confirmar');
    };

    document.getElementById('m-cancel').onclick = () => {
      document.getElementById('modal').classList.remove('open');
      this.value = '';
    };
  });

  // ── Init ─────────────────────────────────────────────────
  renderSB();
  renderMain();

})();