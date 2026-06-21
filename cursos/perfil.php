<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
requireLogin();

$pageTitle  = 'Mi Perfil';
$pageActive = 'perfil';

$u = usuarioActual();

$persona = null;
if (DB_ACTIVA && $pdo) {
    $stmt = $pdo->prepare('SELECT nombre, email, genero, telefono, email_verificado, fecha_registro, ultima_sesion FROM aprende_persona WHERE id_persona = ?');
    $stmt->execute([$u['id']]);
    $persona = $stmt->fetch();
}

$generos = ['F' => 'Femenino', 'M' => 'Masculino', 'NB' => 'No binario', 'ND' => 'Prefiero no decirlo'];

$datos = [
    'nombre'    => $persona['nombre'] ?? $u['nombre'],
    'email'     => $persona['email'] ?? $u['email'],
    'telefono'  => $persona['telefono'] ?? 'No registrado',
    'genero'    => $generos[$persona['genero'] ?? ''] ?? 'No especificado',
    'registro'  => !empty($persona['fecha_registro']) ? date('d/m/Y', strtotime($persona['fecha_registro'])) : '—',
    'ultima'    => !empty($persona['ultima_sesion']) ? date('d/m/Y H:i', strtotime($persona['ultima_sesion'])) : 'Esta es tu primera sesion',
    'verificado'=> !empty($persona['email_verificado']),
];

$promedio  = 0;
$aprobadas = 0;
$totalEval = 0;

$breadcrumb = [
    ['label' => 'Mi cuenta', 'href' => '/cursos/perfil.php'],
    ['label' => 'Perfil'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <div class="prof-hero">
                    <div class="prof-avatar"><?= htmlspecialchars(iniciales($datos['nombre'])) ?></div>
                    <div class="prof-hero-info">
                        <h1 class="prof-hero-name"><?= htmlspecialchars($datos['nombre']) ?></h1>
                        <p class="prof-hero-email"><?= htmlspecialchars($datos['email']) ?></p>
                        <span class="prof-hero-badge">Estudiante activo &middot; PEL 2026-2027</span>
                    </div>
                </div>

                <div class="prof-stats">
                    <div class="prof-stat">
                        <span class="prof-stat-val" style="color:var(--primary)"><?= $u['progreso'] ?>%</span>
                        <span class="prof-stat-label">Progreso del curso</span>
                    </div>
                    <div class="prof-stat">
                        <span class="prof-stat-val" style="color:var(--green)"><?= $promedio ?: '—' ?></span>
                        <span class="prof-stat-label">Promedio general</span>
                    </div>
                    <div class="prof-stat">
                        <span class="prof-stat-val"><?= $aprobadas ?></span>
                        <span class="prof-stat-label">Evaluaciones aprobadas</span>
                    </div>
                </div>

                <div class="prof-grid">

                    <div class="prof-card">
                        <p class="prof-card-title">Informacion personal</p>
                        <div class="prof-field"><span class="prof-field-label">Nombre completo</span><span class="prof-field-val"><?= htmlspecialchars($datos['nombre']) ?></span></div>
                        <div class="prof-field"><span class="prof-field-label">Correo electronico</span><span class="prof-field-val"><?= htmlspecialchars($datos['email']) ?></span></div>
                        <div class="prof-field"><span class="prof-field-label">Telefono</span><span class="prof-field-val"><?= htmlspecialchars($datos['telefono']) ?></span></div>
                        <div class="prof-field"><span class="prof-field-label">Genero</span><span class="prof-field-val"><?= htmlspecialchars($datos['genero']) ?></span></div>
                    </div>

                    <div class="prof-card">
                        <p class="prof-card-title">Seguridad de la cuenta</p>
                        <div class="prof-field"><span class="prof-field-label">Contrasena</span><span class="prof-field-val">&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;</span></div>
                        <div class="prof-field"><span class="prof-field-label">Ultima sesion</span><span class="prof-field-val"><?= htmlspecialchars($datos['ultima']) ?></span></div>
                        <div class="prof-field"><span class="prof-field-label">Verificacion de correo</span><span class="prof-field-val" style="color:<?= $datos['verificado'] ? 'var(--green)' : 'var(--text3)' ?>"><?= $datos['verificado'] ? 'Verificado' : 'Pendiente' ?></span></div>
                        <div class="prof-field"><span class="prof-field-label">Miembro desde</span><span class="prof-field-val"><?= htmlspecialchars($datos['registro']) ?></span></div>
                    </div>

                    <div class="prof-card">
                        <p class="prof-card-title">Notificaciones</p>
                        <div class="prof-notif">
                            <div><span class="prof-notif-label">Recordatorios de curso</span><span class="prof-notif-desc">Avisos sobre temas pendientes</span></div>
                            <span class="prof-toggle"></span>
                        </div>
                        <div class="prof-notif">
                            <div><span class="prof-notif-label">Resultados de evaluacion</span><span class="prof-notif-desc">Notificacion al terminar un examen</span></div>
                            <span class="prof-toggle"></span>
                        </div>
                        <div class="prof-notif">
                            <div><span class="prof-notif-label">Nuevos cursos disponibles</span><span class="prof-notif-desc">Cuando se publiquen nuevos cursos</span></div>
                            <span class="prof-toggle off"></span>
                        </div>
                        <div class="prof-notif">
                            <div><span class="prof-notif-label">Boletin informativo del IEEQ</span><span class="prof-notif-desc">Noticias y comunicados</span></div>
                            <span class="prof-toggle off"></span>
                        </div>
                    </div>

                    <div class="prof-card">
                        <p class="prof-card-title">Actividad reciente</p>
                        <div class="prof-activity">
                            <div class="prof-act-item">
                                <span class="prof-act-dot" style="background:var(--lilac)"></span>
                                <div>
                                    <p class="prof-act-title">Inscripcion al curso ABC de la Funcion Electoral</p>
                                    <span class="prof-act-fecha"><?= htmlspecialchars($datos['registro']) ?></span>
                                </div>
                            </div>
                            <div class="prof-act-item">
                                <span class="prof-act-dot" style="background:var(--primary)"></span>
                                <div>
                                    <p class="prof-act-title">Cuenta creada en AprendIEEQ</p>
                                    <span class="prof-act-fecha"><?= htmlspecialchars($datos['registro']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .prof-hero {
        background: linear-gradient(135deg, var(--dark) 0%, #1a0d24 100%);
        border-radius: var(--radius);
        padding: 1.8rem 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.3rem;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .prof-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(116, 20, 132, 0.2) 0%, transparent 60%);
    }
    .prof-avatar {
        width: 74px;
        height: 74px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--pink));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
        box-shadow: 0 8px 24px rgba(116, 20, 132, 0.5);
    }
    .prof-hero-info { position: relative; z-index: 1; }
    .prof-hero-name { font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: #fff; margin-bottom: 0.2rem; }
    .prof-hero-email { font-size: 0.82rem; color: rgba(255, 255, 255, 0.5); }
    .prof-hero-badge {
        display: inline-block;
        background: rgba(116, 20, 132, 0.3);
        border: 1px solid rgba(116, 20, 132, 0.4);
        border-radius: 20px;
        padding: 3px 11px;
        font-size: 0.68rem;
        color: var(--lilac);
        margin-top: 0.5rem;
    }
    .prof-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.3rem;
    }
    .prof-stat {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.1rem;
        text-align: center;
    }
    .prof-stat-val { display: block; font-family: var(--font-display); font-size: 1.6rem; font-weight: 700; }
    .prof-stat-label { font-size: 0.72rem; color: var(--text3); margin-top: 3px; }
    .prof-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }
    .prof-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.35rem;
    }
    .prof-card-title {
        font-family: var(--font-display);
        font-size: 0.92rem;
        font-weight: 600;
        margin-bottom: 1.1rem;
    }
    .prof-field {
        display: flex;
        flex-direction: column;
        gap: 2px;
        margin-bottom: 0.85rem;
    }
    .prof-field-label {
        font-size: 0.66rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text3);
        font-weight: 600;
    }
    .prof-field-val { font-size: 0.86rem; color: var(--text); }
    .prof-notif {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.7rem 0;
        border-bottom: 1px solid var(--border);
    }
    .prof-notif:last-child { border-bottom: none; }
    .prof-notif-label { display: block; font-size: 0.84rem; color: var(--text); }
    .prof-notif-desc { font-size: 0.72rem; color: var(--text3); }
    .prof-toggle {
        width: 42px;
        height: 23px;
        border-radius: 12px;
        background: var(--primary);
        position: relative;
        cursor: pointer;
        flex-shrink: 0;
        transition: background var(--transition);
    }
    .prof-toggle::after {
        content: '';
        position: absolute;
        top: 3px;
        right: 3px;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        background: #fff;
        transition: all var(--transition);
    }
    .prof-toggle.off { background: #d2cae0; }
    .prof-toggle.off::after { right: 22px; }
    .prof-activity { display: flex; flex-direction: column; gap: 0.85rem; }
    .prof-act-item { display: flex; align-items: flex-start; gap: 11px; }
    .prof-act-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 5px;
    }
    .prof-act-title { font-size: 0.83rem; color: var(--text); line-height: 1.4; }
    .prof-act-fecha { font-size: 0.7rem; color: var(--text3); }
    @media (max-width: 820px) {
        .prof-stats, .prof-grid { grid-template-columns: 1fr; }
    }
</style>

<?php include '../includes/footer.php'; ?>
