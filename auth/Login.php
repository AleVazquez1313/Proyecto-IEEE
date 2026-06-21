<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit;
}
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión · AprendIEEQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body>
    <aside class="auth-aside">
        <div class="auth-brand">
            <div class="auth-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="18" rx="2"/>
                    <path d="M8 3v18"/>
                    <path d="M16 9l-4 4-4-4"/>
                </svg>
            </div>
            <p class="auth-name">AprendIEEQ</p>
            <p class="auth-tagline">Instituto Electoral del Estado de Querétaro</p>
        </div>
        <div class="auth-quote">
            <div class="auth-quote-line"></div>
            <p>Tu participación hace la democracia. Fórmate, conoce y actúa en el Proceso Electoral Local 2026&ndash;2027.</p>
            <span>IEEQ &middot; PEL 2026-2027</span>
        </div>
        <div class="auth-dots">
            <div class="auth-dot active"></div>
            <div class="auth-dot"></div>
            <div class="auth-dot"></div>
        </div>
    </aside>

    <main class="auth-main">
        <div class="auth-form">
            <h1 class="auth-title">Bienvenido de nuevo</h1>
            <p class="auth-subtitle">Accede a tu cuenta para continuar tu formación</p>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="procesar-login.php" method="POST">
                <div class="form-group">
                    <label class="form-label">Correo electrónico</label>
                    <input class="form-input" type="email" name="email" placeholder="tucorreo@ejemplo.com" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    <div class="pw-wrap">
                        <input class="form-input" type="password" name="password" id="pw" placeholder="Ingresa tu contraseña" required autocomplete="current-password">
                        <button type="button" class="pw-eye" onclick="togglePw()" aria-label="Mostrar contraseña">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-full">Iniciar sesión</button>
            </form>

            <a href="recuperar-password.php" class="auth-link-inline">¿Olvidaste tu contraseña?</a>

            <div class="auth-divider">
                <div class="auth-divider-line"></div>
                <span class="auth-divider-text">o continúa con</span>
                <div class="auth-divider-line"></div>
            </div>

            <button class="btn-google">
                <svg width="17" height="17" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.2l6.8-6.8C35.8 2.5 30.2 0 24 0 14.8 0 6.9 5.3 3 13l7.9 6.1C12.8 13 18 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.2-.4-4.7H24v9h12.7c-.6 3-2.3 5.5-4.8 7.2l7.5 5.8c4.4-4.1 7.1-10.1 7.1-17.3z"/><path fill="#FBBC05" d="M10.9 28.6A14.7 14.7 0 0 1 9.5 24c0-1.6.3-3.1.8-4.6L2.4 13C.9 16 0 19.4 0 24s.9 8 2.4 11l8.5-6.4z"/><path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.5-5.8c-2.1 1.4-4.7 2.3-7.7 2.3-6 0-11.1-4-12.9-9.4l-8.2 6.3C6.8 42.5 14.8 48 24 48z"/></svg>
                Continuar con Google
            </button>

            <p class="auth-foot">¿Aún no tienes cuenta? <a href="../registro/Registro.php">Regístrate aquí</a></p>
        </div>
    </main>

    <script>
        function togglePw() {
            const pw = document.getElementById('pw');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
