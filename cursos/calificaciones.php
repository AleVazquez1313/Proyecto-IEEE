<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
requireLogin();

$pageTitle  = 'Mis Calificaciones';
$pageActive = 'calificaciones';

$calificaciones = [
    ['modulo' => 'Módulo I. Conceptos clave',      'evaluacion' => 'Evaluación Parcial', 'fecha' => '07/05/2026', 'puntaje' => 85,   'minimo' => 80, 'intentos' => '1 / 2'],
    ['modulo' => 'Módulo II. Sistema político',     'evaluacion' => 'Evaluación Parcial', 'fecha' => '09/05/2026', 'puntaje' => 90,   'minimo' => 80, 'intentos' => '1 / 2'],
    ['modulo' => 'Módulo III. Elecciones',          'evaluacion' => 'Evaluación Parcial', 'fecha' => null,          'puntaje' => null, 'minimo' => 80, 'intentos' => '0 / 2'],
    ['modulo' => 'Evaluación general del curso',    'evaluacion' => 'Evaluación Final',   'fecha' => null,          'puntaje' => null, 'minimo' => 80, 'intentos' => '0 / 1'],
];

$puntajes = array_filter(array_column($calificaciones, 'puntaje'), fn($p) => $p !== null);
$promedio = !empty($puntajes) ? round(array_sum($puntajes) / count($puntajes), 1) : 0;
$aprobadas = count(array_filter($puntajes, fn($p) => $p >= 80));
$progreso = usuarioActual()['progreso'];

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => 'Mis calificaciones'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <h2 class="cal-heading">Mis calificaciones</h2>

                <div class="cal-summary">
                    <div class="cal-sum-card">
                        <p class="cal-sum-label">Progreso del curso</p>
                        <p class="cal-sum-val" style="color:var(--primary)"><?= $progreso ?>%</p>
                        <div class="cal-sum-track"><div class="cal-sum-fill" style="width:<?= $progreso ?>%"></div></div>
                    </div>
                    <div class="cal-sum-card">
                        <p class="cal-sum-label">Promedio general</p>
                        <p class="cal-sum-val" style="color:var(--green)"><?= $promedio ?: '—' ?></p>
                        <p class="cal-sum-note">de evaluaciones realizadas</p>
                    </div>
                    <div class="cal-sum-card">
                        <p class="cal-sum-label">Evaluaciones aprobadas</p>
                        <p class="cal-sum-val"><?= $aprobadas ?> / <?= count($calificaciones) ?></p>
                        <p class="cal-sum-note">completadas</p>
                    </div>
                </div>

                <div class="cal-table">
                    <div class="cal-thead">
                        <span>Módulo</span>
                        <span>Evaluación</span>
                        <span>Fecha</span>
                        <span>Calificación</span>
                        <span>Estatus</span>
                        <span>Intentos</span>
                    </div>
                    <?php foreach ($calificaciones as $cal):
                        $p = $cal['puntaje'];
                        $aprob = $p !== null && $p >= $cal['minimo'];
                    ?>
                        <div class="cal-row">
                            <span class="cal-mod"><?= htmlspecialchars($cal['modulo']) ?></span>
                            <span class="cal-cell"><?= htmlspecialchars($cal['evaluacion']) ?></span>
                            <span class="cal-cell muted"><?= $cal['fecha'] ?? '—' ?></span>
                            <span class="cal-score" style="color:<?= $p === null ? 'var(--text3)' : ($aprob ? 'var(--green)' : 'var(--red)') ?>"><?= $p ?? '—' ?></span>
                            <span>
                                <?php if ($p === null): ?>
                                    <span class="badge badge-muted">Pendiente</span>
                                <?php elseif ($aprob): ?>
                                    <span class="badge badge-success">Aprobado</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Reprobado</span>
                                <?php endif; ?>
                            </span>
                            <span class="cal-cell muted"><?= $cal['intentos'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .cal-heading { font-family: var(--font-display); font-size: 1.3rem; font-weight: 700; margin-bottom: 1.3rem; }
    .cal-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.4rem;
    }
    .cal-sum-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.2rem;
    }
    .cal-sum-label {
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: var(--text3);
        font-weight: 600;
        margin-bottom: 0.4rem;
    }
    .cal-sum-val { font-family: var(--font-display); font-size: 1.7rem; font-weight: 700; }
    .cal-sum-note { font-size: 0.7rem; color: var(--text3); margin-top: 3px; }
    .cal-sum-track {
        height: 5px;
        background: var(--surface3);
        border-radius: 4px;
        overflow: hidden;
        margin-top: 9px;
    }
    .cal-sum-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, var(--primary), var(--pink)); }
    .cal-table {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .cal-thead, .cal-row {
        display: grid;
        grid-template-columns: 2.4fr 1.2fr 1fr 1fr 1.1fr 0.9fr;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 1.35rem;
    }
    .cal-thead {
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
    }
    .cal-thead span {
        font-size: 0.68rem;
        font-weight: 700;
        color: var(--text3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .cal-row { border-bottom: 1px solid var(--border); transition: background var(--transition); }
    .cal-row:last-child { border-bottom: none; }
    .cal-row:hover { background: var(--surface2); }
    .cal-mod { font-size: 0.83rem; color: var(--text); font-weight: 500; }
    .cal-cell { font-size: 0.81rem; color: var(--text2); }
    .cal-cell.muted { color: var(--text3); }
    .cal-score { font-family: var(--font-display); font-size: 0.92rem; font-weight: 700; }
    @media (max-width: 820px) {
        .cal-summary { grid-template-columns: 1fr; }
        .cal-thead { display: none; }
        .cal-row { grid-template-columns: 1fr 1fr; row-gap: 0.4rem; }
    }
</style>

<?php include '../includes/footer.php'; ?>
