<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Constructiva</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<!-- CSS principal -->
<link rel="stylesheet" href="Css/index.css">

<!-- CSS del login -->
<link rel="stylesheet" href="Css/login.css">

 <link rel="stylesheet" href="Css/responsive.css">
</head>


<body class="login-body">

<div class="login-container">
<!-- BOTON VOLVER -->
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
<p>Accede a tu cuenta</p>
</div>


<!-- FORM -->

<form class="login-form" method="POST" action="Php/login.php">

<!-- EMAIL -->

<div class="input-group">

<label>Email</label>

<div class="input-wrapper">

<svg viewBox="0 0 24 24">
<path fill="none" d="M0 0h24v24H0z"/>
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


<!-- BOTON LOGIN -->

<button class="btn-login" type="submit">
Iniciar Sesión
</button>


<!-- DIVIDER -->

<div class="divider">
<span>o continuar con</span>
</div>


<!-- GOOGLE LOGIN -->

<a href="Php/google_auth.php" class="google-btn">

<img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">

Continuar con Google

</a>


</form>


<!-- FOOTER -->

<div class="login-footer">

<p>¿No tienes cuenta?</p>

<a href="/registro">
Crear cuenta
</a>

</div>

</div>

</div>

</body>

</html>