<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | AprendIEEQ</title>

    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">

            <img src="../assets/img/logoWeb.png" alt="Logo IEEQ" class="logo">

            <h2>Bienvenido a AprendIEEQ</h2>
            <p>Inicia sesión para continuar</p>

            <form action="procesar-login.php" method="POST">

                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="ejemplo@correo.com"
                        required
                    >
                </div>

                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">
                    Iniciar sesión
                </button>

            </form>

            <div class="links">
                <a href="../registro/registro.php">
                    Registrarse
                </a>

                <a href="recuperar-password.php">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

        </div>
    </div>

</body>
</html>