<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;500;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous" />
  <link rel="stylesheet" href="dist/css/main.css" />
  <link rel="stylesheet" href="dist/css/normalize.css" />
  <title>Registro</title>
</head>

<body>
  <main class="login-design">
    <div class="waves">
      <img src="dist/img/usuarios.png" alt="" />
    </div>
    <div class="login">
      <div class="login-data">
        <img src="dist/img/img-SurtidoradelHogar1.JPEG" alt="" />
        <h1 > Registro</h1>
        <form id="formRegistro" action="#" class="login-form">
          <div class="input-group">
            <label class="input-fill">
              <input type="text" name="usuario" id="usuario" autocomplete="off" required />
              <span class="input-label">Escribe Usuario</span>
              <i class="far fa-user"></i>
            </label>
          </div>
          <div class="input-group">
            <label class="input-fill">
              <input type="password" name="contra" id="contraseña" autocomplete="off" required />
              <span class="input-label">Escribe la Contraseña</span>
              <i class="fas fa-lock"></i>
            </label>
          </div>

          <input type="submit"  id="nuevo_usuario" value="Registrarme" class="btn-login" /> <br> <br>
          <input type="button" value="Login"  class="btn-login" onclick = "location='Login.php'" />
          <br>
          <br>
        </form>
      </div>
    </div>
  </main>

  <?php include("Include/scripts.php"); ?>
  <script src="dist/js/pages/Registro.js"></script>

</body>

</html>