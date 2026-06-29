<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit;
}
$error   = $_SESSION['recuperar_error']   ?? '';
$success = $_SESSION['recuperar_success'] ?? false;
unset($_SESSION['recuperar_error'], $_SESSION['recuperar_success']);
$cssVersion = filemtime(__DIR__ . '/../assets/css/styles.css');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña · AprendIEEQ</title>
    <link href="../assets/images/logo.png" rel="icon">
    <link rel="stylesheet" href="../assets/css/styles.css?v=<?= $cssVersion ?>">
</head>
<body>
    <aside class="auth-aside">
        <div class="auth-brand">
            <div class="auth-logo">
                <img src="../assets/img/logoWeb.png" alt="AprendIEEQ Logo">
            </div>
            <p class="auth-name">AprendIEEQ</p>
            <p class="auth-tagline">Instituto Electoral del Estado de Querétaro</p>
        </div>
        <div class="auth-quote">
            <div class="auth-quote-line"></div>
            <p>Recupera tu acceso y continúa con tu formación electoral.</p>
            <span>IEEQ &middot; PEL 2026-2027</span>
        </div>
        <div class="auth-dots">
            <div class="auth-dot"></div>
            <div class="auth-dot"></div>
            <div class="auth-dot active"></div>
        </div>
    </aside>

    <main class="auth-main">
        <?php if (!$success): ?>
            <div class="auth-card">
                <div class="auth-card-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <h1 class="auth-card-title">¿Olvidaste tu contraseña?</h1>
                <p class="auth-card-sub">Ingresa tu correo y te enviaremos un enlace desde <strong>intranet@ieeq.mx</strong> para restablecerla.</p>

                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form action="procesar-recuperar.php" method="POST">
                    <div class="form-group">
                        <label class="form-label">Correo electrónico</label>
                        <input class="form-input" type="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Enviar enlace</button>
                </form>
                <a href="Login.php" class="auth-link-inline auth-link-center">Volver al inicio de sesión</a>
            </div>
        <?php else: ?>
            <div class="auth-card">
                <div class="auth-card-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <h1 class="auth-card-title">Correo enviado</h1>
                <p class="auth-card-sub">Hemos enviado un enlace de restablecimiento a tu correo.</p>
                <div class="info-box">
                    <strong>Remitente:</strong> intranet@ieeq.mx<br>
                    Revisa tu bandeja de entrada o carpeta de spam. El enlace es de un solo uso y expira en 30 minutos.
                </div>
                <form action="procesar-recuperar.php" method="POST">
                    <input type="hidden" name="reenviar" value="1">
                    <button type="submit" class="btn btn-ghost btn-full">Reenviar correo</button>
                </form>
                <a href="Login.php" class="btn btn-primary btn-full">Volver al inicio de sesión</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
