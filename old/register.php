<!DOCTYPE html>
    <html lang="es">

    <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear Cuenta | Constructiva</title>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Css/index.css">
    <link rel="stylesheet" href="Css/login.css">
    <link rel="stylesheet" href="Css/responsive.css">
    </head>


    <body class="login-body">

    <div class="login-container">

    <a href="/" class="back-link">

    <svg viewBox="0 0 24 24" class="back-icon">
    <path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

    </svg>

    <span>Volver</span>

    </a>


    <div class="login-card">

    <!-- HEADER -->

    <div class="login-header">
    <h1>Constructiva<span>.</span></h1>
    <p>Crea tu cuenta</p>
    </div>

    <!-- FORM -->

    <form class="login-form" method="POST" action="Php/Register.php">


    <!-- NOMBRE -->

    <div class="input-group">

    <label>Nombre</label>

    <div class="input-wrapper">

    <svg viewBox="0 0 24 24">
    <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z"/>
    <path d="M12 14c-4 0-8 2-8 5v1h16v-1c0-3-4-5-8-5z"/>
    </svg>

    <input 
    type="text" 
    name="nombre"
    placeholder="Tu nombre"
    required
    >

    </div>

    </div>

<!-- APELLIDO -->
<div class="input-group">
<label>Apellido</label>
<div class="input-wrapper">
<svg viewBox="0 0 24 24">
  <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z"/>
  <path d="M12 14c-4 0-8 2-8 5v1h16v-1c0-3-4-5-8-5z"/>
</svg>
<input 
  type="text" 
  name="apellido"
  placeholder="Tu apellido"
  required
>
</div>
</div>

    <!-- EMAIL -->

    <div class="input-group">

    <label>Email</label>

    <div class="input-wrapper">

    <svg viewBox="0 0 24 24">
    <path d="M20 8l-8 5-8-5V6l8 5 8-5v2z"/>
    </svg>

    <input 
    type="email" 
    name="email"
    placeholder="correo@ejemplo.com"
    required
    >

    </div>

    </div>


    <!-- PASSWORD -->

    <div class="input-group">

    <label>Contraseña</label>

    <div class="input-wrapper">

    <svg viewBox="0 0 24 24">
    <path d="M12 17a2 2 0 100-4 2 2 0 000 4z"/>
    <path d="M6 10V8a6 6 0 1112 0v2"/>
    <rect x="4" y="10" width="16" height="10" rx="2"/>
    </svg>

    <input 
    type="password" 
    name="password"
    placeholder="********"
    required
    >

    </div>

    </div>


    <!-- CONFIRMAR PASSWORD -->

    <div class="input-group">

    <label>Confirmar contraseña</label>

    <div class="input-wrapper">

    <svg viewBox="0 0 24 24">
    <path d="M12 17a2 2 0 100-4 2 2 0 000 4z"/>
    <path d="M6 10V8a6 6 0 1112 0v2"/>
    <rect x="4" y="10" width="16" height="10" rx="2"/>
    </svg>

    <input 
    type="password" 
    name="confirm_password"
    placeholder="********"
    required
    >

    </div>

    </div>


    <!-- BOTON CREAR CUENTA -->

    <button class="btn-login" type="submit">
    Crear cuenta
    </button>


    <!-- DIVIDER -->

    <div class="divider">
    <span>o registrarte con</span>
    </div>


    <!-- GOOGLE -->

    <a href="Php/google_auth.php" class="google-btn">

    <img src="https://www.svgrepo.com/show/475656/google-color.svg">

    Registrarse con Google

    </a>


    </form>

    <!-- FOOTER -->

    <div class="login-footer">

    <p>¿Ya tienes cuenta?</p>

    <a href="/login">
    Iniciar sesión
    </a>

    </div>

    </div>

    </div>

    </body>

    </html>