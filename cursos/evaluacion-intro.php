<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/evaluaciones.php';
requireLogin();

$id   = $_GET['id'] ?? 'final';
$eval = obtenerEvaluacion($id);

if (!$eval) {
    header('Location: /dashboard/dashboard.php');
    exit;
}

$pageTitle  = $eval['titulo'];
$pageActive = $eval['modulo'] > 0 ? 'modulo' . $eval['modulo'] : 'evaluacion';
$acento     = $eval['acento'];
$rgb        = $eval['acento_rgb'];

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $eval['titulo']],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="intro-wrap">

                <div class="intro-card">
                    <div class="intro-head" style="background:linear-gradient(135deg, <?= $acento ?>, color-mix(in srgb, <?= $acento ?> 55%, #000));">
                        <span class="intro-badge">Módulo <?= htmlspecialchars($eval['numero']) ?></span>
                        <svg class="intro-head-mark" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.45)" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/>
                        </svg>
                        <h1 class="intro-title"><?= htmlspecialchars($eval['titulo']) ?></h1>
                        <p class="intro-subtitle"><?= htmlspecialchars($eval['subtitulo']) ?></p>
                    </div>

                    <div class="intro-body">
                        <p class="intro-desc"><?= htmlspecialchars($eval['descripcion']) ?></p>

                        <div class="intro-stats">
                            <div class="intro-stat">
                                <span class="intro-stat-icon" style="color:<?= $acento ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                </span>
                                <span class="intro-stat-val"><?= (int) $eval['preguntas_total'] ?></span>
                                <span class="intro-stat-label">Preguntas</span>
                            </div>
                            <div class="intro-stat">
                                <span class="intro-stat-icon" style="color:<?= $acento ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </span>
                                <span class="intro-stat-val"><?= (int) $eval['minutos'] ?> min</span>
                                <span class="intro-stat-label">Tiempo límite</span>
                            </div>
                            <div class="intro-stat">
                                <span class="intro-stat-icon" style="color:<?= $acento ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v4"/><path d="M12 18v4"/><path d="m4.93 4.93 2.83 2.83"/><path d="m16.24 16.24 2.83 2.83"/><circle cx="12" cy="12" r="4"/></svg>
                                </span>
                                <span class="intro-stat-val"><?= (int) $eval['minimo'] ?>%</span>
                                <span class="intro-stat-label">Mínimo aprobatorio</span>
                            </div>
                            <div class="intro-stat">
                                <span class="intro-stat-icon" style="color:<?= $acento ?>">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
                                </span>
                                <span class="intro-stat-val"><?= (int) $eval['intentos'] ?></span>
                                <span class="intro-stat-label">Intentos disponibles</span>
                            </div>
                        </div>

                        <div class="intro-section">
                            <p class="intro-section-title">Temas que se evalúan</p>
                            <ul class="intro-temas">
                                <?php foreach ($eval['temas'] as $tema): ?>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="<?= $acento ?>" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        <?= htmlspecialchars($tema) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="intro-instr">
                            <p class="intro-instr-title">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                Antes de comenzar
                            </p>
                            <ul class="intro-instr-list">
                                <li>Lee cada pregunta con atención antes de responder.</li>
                                <li>Selecciona una sola respuesta por pregunta.</li>
                                <li>El tiempo comienza a correr al dar clic en Iniciar evaluación.</li>
                                <li>Necesitas al menos <?= (int) $eval['minimo'] ?>% de aciertos para aprobar.</li>
                                <li>Cuentas con <?= (int) $eval['intentos'] ?> intentos para lograrlo.</li>
                            </ul>
                        </div>

                        <div class="intro-actions">
                            <a href="<?= $eval['modulo'] > 0 ? '/modulos/modulo_' . $eval['modulo'] . '.php' : '/dashboard/dashboard.php' ?>" class="btn btn-ghost">Volver</a>
                            <a href="/cursos/evaluacion.php?id=<?= htmlspecialchars($eval['id']) ?>" class="btn btn-primary" style="background:<?= $acento ?>;box-shadow:0 4px 16px rgba(<?= $rgb ?>,0.35);">
                                Iniciar evaluación
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .intro-wrap { max-width: 720px; margin: 0 auto; }
    .intro-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }
    .intro-head {
        padding: 2rem 2.2rem;
        position: relative;
        overflow: hidden;
    }
    .intro-head-mark {
        position: absolute;
        top: 1.4rem;
        right: 1.6rem;
        width: 54px;
        height: 54px;
    }
    .intro-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.28);
        border-radius: 20px;
        padding: 4px 13px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.9rem;
    }
    .intro-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }
    .intro-subtitle {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.78);
        margin-top: 0.35rem;
    }
    .intro-body { padding: 2rem 2.2rem; }
    .intro-desc {
        font-size: 0.92rem;
        color: var(--text2);
        line-height: 1.75;
        margin-bottom: 1.7rem;
    }
    .intro-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.85rem;
        margin-bottom: 1.9rem;
    }
    .intro-stat {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 1.05rem 0.6rem;
        text-align: center;
    }
    .intro-stat-icon { display: block; margin-bottom: 0.5rem; }
    .intro-stat-icon svg { width: 22px; height: 22px; }
    .intro-stat-val {
        display: block;
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text);
    }
    .intro-stat-label {
        font-size: 0.66rem;
        color: var(--text3);
        margin-top: 2px;
    }
    .intro-section { margin-bottom: 1.7rem; }
    .intro-section-title {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 0.9rem;
    }
    .intro-temas { list-style: none; display: flex; flex-direction: column; gap: 0.6rem; }
    .intro-temas li {
        display: flex;
        align-items: center;
        gap: 11px;
        font-size: 0.86rem;
        color: var(--text2);
    }
    .intro-temas svg { width: 17px; height: 17px; flex-shrink: 0; }
    .intro-instr {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 1.2rem 1.35rem;
        margin-bottom: 1.8rem;
    }
    .intro-instr-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--font-display);
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 0.85rem;
    }
    .intro-instr-title svg { width: 17px; height: 17px; color: var(--primary); }
    .intro-instr-list { list-style: none; display: flex; flex-direction: column; gap: 0.5rem; }
    .intro-instr-list li {
        font-size: 0.82rem;
        color: var(--text2);
        padding-left: 1.1rem;
        position: relative;
        line-height: 1.55;
    }
    .intro-instr-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: var(--text3);
    }
    .intro-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }
    @media (max-width: 640px) {
        .intro-stats { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<?php include '../includes/footer.php'; ?>
