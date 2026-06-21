<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit;
}
$error = $_SESSION['registro_error'] ?? '';
$old   = $_SESSION['registro_old']   ?? [];
unset($_SESSION['registro_error'], $_SESSION['registro_old']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta · AprendIEEQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body>
    <aside class="auth-aside">
        <div class="auth-brand">
            <div class="auth-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="18" rx="2"/><path d="M8 3v18"/><path d="M16 9l-4 4-4-4"/>
                </svg>
            </div>
            <p class="auth-name">AprendIEEQ</p>
            <p class="auth-tagline">Instituto Electoral del Estado de Querétaro</p>
        </div>
        <div class="auth-quote">
            <div class="auth-quote-line"></div>
            <p>Crea tu cuenta y comienza tu formación electoral para el Proceso Electoral Local 2026&ndash;2027.</p>
            <span>IEEQ &middot; PEL 2026-2027</span>
        </div>
        <div class="auth-dots">
            <div class="auth-dot"></div>
            <div class="auth-dot active"></div>
            <div class="auth-dot"></div>
        </div>
    </aside>

    <main class="auth-main">
        <div class="auth-form wide">
            <h1 class="auth-title">Crear cuenta</h1>
            <p class="auth-subtitle">Completa tus datos para acceder a los cursos</p>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="procesar-registro.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre(s)</label>
                        <input class="form-input" type="text" name="nombre" placeholder="Abraham" required value="<?= htmlspecialchars($old['nombre'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos</label>
                        <input class="form-input" type="text" name="apellidos" placeholder="Ordaz González" required value="<?= htmlspecialchars($old['apellidos'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo electrónico</label>
                    <input class="form-input" type="email" name="email" placeholder="tucorreo@ejemplo.com" required value="<?= htmlspecialchars($old['email'] ?? '') ?>">
                    <div class="form-note">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        Verifica que sea un correo válido al que tengas acceso
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Género</label>
                        <select class="form-select" name="genero" required>
                            <option value="">Seleccionar...</option>
                            <option value="F"  <?= ($old['genero'] ?? '') === 'F'  ? 'selected' : '' ?>>Femenino</option>
                            <option value="M"  <?= ($old['genero'] ?? '') === 'M'  ? 'selected' : '' ?>>Masculino</option>
                            <option value="NB" <?= ($old['genero'] ?? '') === 'NB' ? 'selected' : '' ?>>No binario</option>
                            <option value="ND" <?= ($old['genero'] ?? '') === 'ND' ? 'selected' : '' ?>>Prefiero no decirlo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input class="form-input" type="tel" name="telefono" placeholder="442 000 0000" value="<?= htmlspecialchars($old['telefono'] ?? '') ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    <input class="form-input" type="password" name="password" id="pw" placeholder="Crea una contraseña segura" required oninput="checkStrength(this.value)">
                    <div class="strength-wrap">
                        <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                        <span class="strength-text" id="strengthText">Ingresa una contraseña</span>
                    </div>
                    <p class="pw-hint">Mínimo 10 caracteres con mayúsculas, minúsculas, números y símbolos.</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmar contraseña</label>
                    <input class="form-input" type="password" name="confirm_password" placeholder="Repite tu contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Crear mi cuenta</button>
            </form>

            <div class="auth-divider">
                <div class="auth-divider-line"></div>
                <span class="auth-divider-text">o continúa con</span>
                <div class="auth-divider-line"></div>
            </div>

            <button class="btn-google">
                <svg width="17" height="17" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.2l6.8-6.8C35.8 2.5 30.2 0 24 0 14.8 0 6.9 5.3 3 13l7.9 6.1C12.8 13 18 9.5 24 9.5z"/><path fill="#4285F4" d="M46.5 24.5c0-1.6-.1-3.2-.4-4.7H24v9h12.7c-.6 3-2.3 5.5-4.8 7.2l7.5 5.8c4.4-4.1 7.1-10.1 7.1-17.3z"/><path fill="#FBBC05" d="M10.9 28.6A14.7 14.7 0 0 1 9.5 24c0-1.6.3-3.1.8-4.6L2.4 13C.9 16 0 19.4 0 24s.9 8 2.4 11l8.5-6.4z"/><path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.5-5.8c-2.1 1.4-4.7 2.3-7.7 2.3-6 0-11.1-4-12.9-9.4l-8.2 6.3C6.8 42.5 14.8 48 24 48z"/></svg>
                Continuar con Google
            </button>

            <p class="auth-foot">¿Ya tienes cuenta? <a href="../auth/Login.php">Inicia sesión aquí</a></p>
        </div>
    </main>

    <script>
        function checkStrength(val) {
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');
            let score = 0;
            if (val.length >= 10) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[a-z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [
                { w: '0%',   c: '#9e96b0', t: 'Ingresa una contraseña' },
                { w: '22%',  c: '#c0392b', t: 'Muy débil' },
                { w: '44%',  c: '#d4600a', t: 'Débil' },
                { w: '66%',  c: '#c9960a', t: 'Aceptable' },
                { w: '85%',  c: '#0a8c4d', t: 'Buena' },
                { w: '100%', c: '#0a8c4d', t: 'Muy segura' }
            ];
            const l = levels[score] || levels[0];
            fill.style.width = l.w;
            fill.style.background = l.c;
            text.style.color = l.c;
            text.textContent = l.t;
        }
    </script>
</body>
</html>
