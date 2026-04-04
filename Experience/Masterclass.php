<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masterclass Gratuita — Constructiva Experience</title>
  <meta name="description" content="Regístrate para la Masterclass gratuita: Habla con tus planos — Revisión de proyectos con Inteligencia Artificial. Martes 31 de marzo, 8:00 p.m." />

  <!-- CSS -->
  <link rel="stylesheet" href="Css/masterclass.css?v=1.0.1" />
</head>
<body>

  <?php include 'php/splash.php'; ?>

  <!-- Orbs de fondo -->
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <!-- Header logo -->
  <header class="logo-header">
    <a href="https://constructiva.edu.do" aria-label="Constructiva Experience">
      <img src="img/Logo aqua.png"
           alt="Constructiva Experience"
           width="250"
           height="auto" />
    </a>
  </header>

  <main class="page">
    <div class="card">
      <div class="card-orb card-orb-1"></div>
      <div class="card-orb card-orb-2"></div>

      <!-- Badge -->
      <div class="badge">
        <div class="badge-dot"></div>
        Masterclass gratuita &middot; Cupos limitados
      </div>

      <!-- Eyebrow -->
      <div class="eyebrow">Habla con tus planos —</div>

      <!-- Headline -->
      <h1>
        Revisión de proyectos con<br>
        <span class="teal">Inteligencia Artificial</span>
      </h1>

      <!-- Sub -->
      <p class="sub">+ Tour en nuestra plataforma <strong>Constructiva</strong></p>

      <!-- Pills -->
      <div class="pills">
        <div class="pill">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Martes 31 de marzo
        </div>
        <div class="pill">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          8:00 p.m.
        </div>
        <div class="pill">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
          Online &middot; En vivo
        </div>
      </div>

      <div class="divider"></div>

      <!-- Countdown -->
      <div id="done-msg">¡La masterclass ya comenzó! Únete ahora en constructiva.edu.do</div>
      <p class="cd-label">El evento comienza en</p>

      <div class="countdown" id="countdown">
        <div class="cd-unit"><div class="cd-box" id="cd-d">00</div><div class="cd-lbl">Días</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-box" id="cd-h">00</div><div class="cd-lbl">Horas</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-box" id="cd-m">00</div><div class="cd-lbl">Min</div></div>
        <div class="cd-sep">:</div>
        <div class="cd-unit"><div class="cd-box" id="cd-s">00</div><div class="cd-lbl">Seg</div></div>
      </div>

      <div class="divider2"></div>

      <!-- Registro -->
      <div class="register-block">

        <!-- Opción 1: Notificación -->
        <div class="reg-option" id="register-form">
          <div class="reg-option-header">
            <div class="reg-icon">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#36DBCA" stroke-width="2">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
              </svg>
            </div>
            <div>
              <h2 class="register-title">¿No quieres perdértela?</h2>
              <p class="register-desc">
                Registra tu correo y te <strong>notificamos</strong> cuando la masterclass esté por comenzar.
              </p>
            </div>
          </div>
          <div class="form-error" id="form-error"></div>
          <div class="form-row">
            <input
              type="email"
              class="form-input"
              id="email-input"
              placeholder="tucorreo@ejemplo.com"
              autocomplete="email"
              inputmode="email"
            />
            <button class="form-btn" id="form-submit" onclick="submitForm()">
              Notifícame
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
              </svg>
            </button>
          </div>
          <p class="form-note">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Sin spam. Solo un recordatorio antes del inicio.
          </p>
        </div>

        <!-- Success -->
        <div id="success-msg">
          <div class="s-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#36DBCA" stroke-width="2.5">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
          </div>
          <h3>¡Listo, te avisamos!</h3>
          <p>Te enviaremos un recordatorio a tu correo<br>antes de que comience la masterclass.</p>
          <br>
          <a href="https://constructiva.edu.do" class="form-btn community-btn">
            Ir a Constructiva Experience
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
              <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
          </a>
          
          
        </div>

        <!-- Separador -->
        <div class="reg-separator">
          <div class="reg-sep-line"></div>
          <span class="reg-sep-text">
<br>

          </span>
          <div class="reg-sep-line"></div>
        </div>

    

      </div>
    </div>
  </main>

  <footer class="page-footer">
    © 2026 Constructiva Experience &nbsp;·&nbsp;
    <a href="https://www.instagram.com/constructiva__/" target="_blank" rel="noopener">@constructiva__</a>
    &nbsp;·&nbsp;
    <a href="https://wa.me/18294910540" target="_blank" rel="noopener">WhatsApp</a>
  </footer>

  <!-- JS al final del body -->
 <script src="js/masterclass.js?v=1.0.1"></script>

</body>
</html>