<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | AprendIEEQ</title>

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="login-container">
    <div class="login-card">

        <img src="../assets/img/logoWeb.png" alt="Logo IEEQ" class="logo">

        <h2>Crear cuenta</h2>
        <p>Completa la información para registrarte</p>

        <form action="procesar-registro.php" method="POST">

            <div class="input-group">
                <label>Nombre(s)</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="input-group">
                <label>Apellidos</label>
                <input type="text" name="apellidos" required>
            </div>

            <div class="input-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Teléfono</label>
                <input type="tel" name="telefono" required>
            </div>

            <div class="input-group">
                <label>Género</label>
                <select name="genero" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                </select>
            </div>

            <div class="input-group">
                <label>Contraseña</label>
                <input
                    type="password"
                    name="password"
                    minlength="10"
                    required
                >
            </div>

            <div class="input-group">
                <label>Confirmar contraseña</label>
                <input
                    type="password"
                    name="confirmar_password"
                    minlength="10"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Registrarse
            </button>

        </form>

        <div class="links">
            <a href="../auth/login.php">
                ¿Ya tienes cuenta? Inicia sesión
            </a>
        </div>

    </div>
</div>

</body>
</html>