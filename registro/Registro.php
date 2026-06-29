<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit;
}
$error = $_SESSION['registro_error'] ?? '';
$old   = $_SESSION['registro_old']   ?? [];
unset($_SESSION['registro_error'], $_SESSION['registro_old']);
$cssVersion = filemtime(__DIR__ . '/../assets/css/styles.css');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta · AprendIEEQ</title>
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
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="procesar-registro.php" method="POST" id="registroForm" novalidate>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nombre(s)</label>
                        <input class="form-input" type="text" name="nombre" id="nombre" placeholder="Abraham" value="<?= htmlspecialchars($old['nombre'] ?? '') ?>" required>
                        <span class="field-error" id="nombreError"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Apellidos</label>
                        <input class="form-input" type="text" name="apellidos" id="apellidos" placeholder="Ordóñez Moreno" value="<?= htmlspecialchars($old['apellidos'] ?? '') ?>" required>
                        <span class="field-error" id="apellidosError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Correo electrónico</label>
                    <input class="form-input" type="email" name="email" id="email" placeholder="tucorreo@ejemplo.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                    <span class="field-error" id="emailError"></span>
                    <div class="form-note">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        Verifica que sea un correo válido y no repetido
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Género</label>
                        <select class="form-select" name="genero" id="genero" required>
                            <option value="">Seleccionar...</option>
                            <option value="F"  <?= ($old['genero'] ?? '') === 'F'  ? 'selected' : '' ?>>Femenino</option>
                            <option value="M"  <?= ($old['genero'] ?? '') === 'M'  ? 'selected' : '' ?>>Masculino</option>
                            <option value="NB" <?= ($old['genero'] ?? '') === 'NB' ? 'selected' : '' ?>>No binario</option>
                            <option value="ND" <?= ($old['genero'] ?? '') === 'ND' ? 'selected' : '' ?>>Prefiero no decirlo</option>
                        </select>
                        <span class="field-error" id="generoError"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Teléfono</label>
                        <input class="form-input" type="tel" name="telefono" id="telefono" placeholder="4420000000" maxlength="10" inputmode="numeric" pattern="\d{10}" value="<?= htmlspecialchars($old['telefono'] ?? '') ?>" required>
                        <span class="field-error" id="telefonoError"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Contraseña</label>
                    <div class="pw-wrap">
                        <input class="form-input" type="password" name="password" id="pw" placeholder="Crea una contraseña segura" minlength="10" required>
                        <button type="button" class="pw-eye" onclick="togglePw('pw')" aria-label="Mostrar contraseña">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <div class="strength-wrap">
                        <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                        <span class="strength-text" id="strengthText">Ingresa una contraseña</span>
                    </div>
                    <ul class="pw-checklist" id="pwChecklist">
                        <li data-rule="len"><span class="pw-check-dot"></span>Al menos 10 caracteres</li>
                        <li data-rule="upper"><span class="pw-check-dot"></span>Una letra mayúscula</li>
                        <li data-rule="lower"><span class="pw-check-dot"></span>Una letra minúscula</li>
                        <li data-rule="num"><span class="pw-check-dot"></span>Un número</li>
                        <li data-rule="sym"><span class="pw-check-dot"></span>Un símbolo (!@#$...)</li>
                    </ul>
                    <span class="field-error" id="pwError"></span>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirmar contraseña</label>
                    <div class="pw-wrap">
                        <input class="form-input" type="password" name="confirm_password" id="confirmPw" placeholder="Repite tu contraseña" minlength="10" required>
                        <button type="button" class="pw-eye" onclick="togglePw('confirmPw')" aria-label="Mostrar contraseña">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    <span class="field-error" id="confirmError"></span>
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
        function togglePw(id) {
            const el = document.getElementById(id);
            el.type = el.type === 'password' ? 'text' : 'password';
        }

        const form = document.getElementById('registroForm');
        const nombre = document.getElementById('nombre');
        const apellidos = document.getElementById('apellidos');
        const email = document.getElementById('email');
        const genero = document.getElementById('genero');
        const telefono = document.getElementById('telefono');
        const pw = document.getElementById('pw');
        const confirmPw = document.getElementById('confirmPw');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const generosValidos = ['F', 'M', 'NB', 'ND'];

        function setError(input, id, msg) {
            input.classList.add('input-error');
            input.classList.remove('input-ok');
            const span = document.getElementById(id);
            span.textContent = msg;
            span.classList.add('show');
        }
        function setOk(input, id) {
            input.classList.remove('input-error');
            input.classList.add('input-ok');
            const span = document.getElementById(id);
            span.textContent = '';
            span.classList.remove('show');
        }

        function valNombre(m) {
            const v = nombre.value.trim();
            if (v === '') { if (m) setError(nombre, 'nombreError', 'Ingresa tu nombre.'); return false; }
            setOk(nombre, 'nombreError'); return true;
        }
        function valApellidos(m) {
            const v = apellidos.value.trim();
            if (v === '') { if (m) setError(apellidos, 'apellidosError', 'Ingresa tus apellidos.'); return false; }
            setOk(apellidos, 'apellidosError'); return true;
        }
        function valEmail(m) {
            const v = email.value.trim();
            if (v === '') { if (m) setError(email, 'emailError', 'Ingresa tu correo electrónico.'); return false; }
            if (!emailRegex.test(v)) { if (m) setError(email, 'emailError', 'Ingresa un correo electrónico válido.'); return false; }
            setOk(email, 'emailError'); return true;
        }
        function valGenero(m) {
            if (!generosValidos.includes(genero.value)) { if (m) setError(genero, 'generoError', 'Selecciona una opción válida.'); return false; }
            setOk(genero, 'generoError'); return true;
        }
        function valTelefono(m) {
            const v = telefono.value.trim();
            if (v === '') { if (m) setError(telefono, 'telefonoError', 'Ingresa tu teléfono.'); return false; }
            if (!/^\d{10}$/.test(v)) { if (m) setError(telefono, 'telefonoError', 'El teléfono debe tener exactamente 10 dígitos numéricos.'); return false; }
            setOk(telefono, 'telefonoError'); return true;
        }
        function reglasPw(v) {
            return {
                len: v.length >= 10,
                upper: /[A-Z]/.test(v),
                lower: /[a-z]/.test(v),
                num: /[0-9]/.test(v),
                sym: /[^A-Za-z0-9]/.test(v),
            };
        }
        function valPw(m) {
            const v = pw.value;
            const r = reglasPw(v);
            for (const key in r) {
                const li = document.querySelector('[data-rule="' + key + '"]');
                if (li) li.classList.toggle('done', r[key]);
            }
            checkStrength(v);
            const todas = Object.values(r).every(Boolean);
            if (v === '') { if (m) setError(pw, 'pwError', 'Crea una contraseña.'); return false; }
            if (!todas) { if (m) setError(pw, 'pwError', 'La contraseña no cumple todos los requisitos.'); return false; }
            setOk(pw, 'pwError');
            if (confirmPw.value !== '') valConfirm(true);
            return true;
        }
        function valConfirm(m) {
            if (confirmPw.value === '') { if (m) setError(confirmPw, 'confirmError', 'Confirma tu contraseña.'); return false; }
            if (confirmPw.value !== pw.value) { if (m) setError(confirmPw, 'confirmError', 'Las contraseñas no coinciden.'); return false; }
            setOk(confirmPw, 'confirmError'); return true;
        }

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

        nombre.addEventListener('input', () => valNombre(true));
        apellidos.addEventListener('input', () => valApellidos(true));
        email.addEventListener('input', () => valEmail(true));
        genero.addEventListener('change', () => valGenero(true));
        telefono.addEventListener('input', () => {
            telefono.value = telefono.value.replace(/\D/g, '').slice(0, 10);
            valTelefono(true);
        });
        pw.addEventListener('input', () => valPw(true));
        confirmPw.addEventListener('input', () => valConfirm(true));

        form.addEventListener('submit', (e) => {
            const checks = [valNombre(true), valApellidos(true), valEmail(true), valGenero(true), valTelefono(true), valPw(true), valConfirm(true)];
            if (checks.includes(false)) {
                e.preventDefault();
                const primerError = document.querySelector('.input-error');
                if (primerError) primerError.focus();
            }
        });
    </script>
</body>
</html>
