<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
requireLogin();

$pageTitle  = 'Mis Calificaciones';
$pageActive = 'calificaciones';

$calificaciones = [
    ['modulo' => 'Módulo II. Sistema Político-Electoral', 'evaluacion' => 'Evaluación de módulo', 'eval_id' => 'modulo2', 'minimo' => 80, 'intentos' => '0 / 2'],
    ['modulo' => 'Módulo III. Elecciones',                'evaluacion' => 'Evaluación de módulo', 'eval_id' => 'modulo3', 'minimo' => 80, 'intentos' => '0 / 2'],
    ['modulo' => 'Evaluación Final del curso',            'evaluacion' => 'Evaluación final',    'eval_id' => 'final',   'minimo' => 80, 'intentos' => '0 / 2'],
];

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
                        <p class="cal-sum-label">Evaluaciones</p>
                        <p class="cal-sum-val" style="color:var(--blue)"><?= count($calificaciones) ?></p>
                        <p class="cal-sum-note">disponibles en el curso</p>
                    </div>
                    <div class="cal-sum-card">
                        <p class="cal-sum-label">Mínimo aprobatorio</p>
                        <p class="cal-sum-val" style="color:var(--green)">80%</p>
                        <p class="cal-sum-note">en cada evaluación</p>
                    </div>
                </div>

                <div class="cal-table">
                    <div class="cal-thead">
                        <span>Módulo</span>
                        <span>Evaluación</span>
                        <span>Mínimo</span>
                        <span>Estatus</span>
                        <span>Intentos</span>
                        <span></span>
                    </div>
                    <?php foreach ($calificaciones as $cal): ?>
                        <div class="cal-row">
                            <span class="cal-mod"><?= htmlspecialchars($cal['modulo']) ?></span>
                            <span class="cal-cell"><?= htmlspecialchars($cal['evaluacion']) ?></span>
                            <span class="cal-cell muted"><?= (int) $cal['minimo'] ?>%</span>
                            <span><span class="badge badge-muted">Pendiente</span></span>
                            <span class="cal-cell muted"><?= htmlspecialchars($cal['intentos']) ?></span>
                            <span><a href="/cursos/evaluacion-intro.php?id=<?= htmlspecialchars($cal['eval_id']) ?>" class="cal-go">Presentar</a></span>
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
        grid-template-columns: 2.4fr 1.4fr 0.8fr 1.1fr 0.9fr 1fr;
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
    .cal-go {
        font-size: 0.74rem;
        font-weight: 600;
        color: var(--primary);
        background: rgba(116, 20, 132, 0.07);
        border: 1px solid rgba(116, 20, 132, 0.15);
        border-radius: 7px;
        padding: 5px 13px;
        transition: all var(--transition);
        white-space: nowrap;
    }
    .cal-go:hover { background: var(--primary); color: #fff; }
    @media (max-width: 820px) {
        .cal-summary { grid-template-columns: 1fr; }
        .cal-thead { display: none; }
        .cal-row { grid-template-columns: 1fr 1fr; row-gap: 0.4rem; }
    }
</style>

<?php include '../includes/footer.php'; ?>
