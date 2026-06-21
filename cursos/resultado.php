<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
requireLogin();

$pageTitle  = 'Resultado de la Evaluación';
$pageActive = 'evaluacion';

$respuestasCorrectas = [0 => 1, 1 => 1, 2 => 2];
$totalPreguntas = 10;
$minimo = 80;

$aciertos = 0;
$contestadas = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($respuestasCorrectas as $i => $correcta) {
        if (isset($_POST['q' . $i])) {
            $contestadas++;
            if ((int) $_POST['q' . $i] === $correcta) {
                $aciertos++;
            }
        }
    }
    $totalEvaluadas = count($respuestasCorrectas);
    $puntaje = $totalEvaluadas > 0 ? (int) round(($aciertos / $totalEvaluadas) * 100) : 0;
} else {
    $puntaje = 85;
    $aciertos = 9;
    $totalEvaluadas = $totalPreguntas;
}

$errores  = $totalEvaluadas - $aciertos;
$aprobado = $puntaje >= $minimo;
$intentoActual = 1;
$intentosMax = 2;

$circ = 2 * M_PI * 52;
$dash = ($puntaje / 100) * $circ;
$color = $aprobado ? 'var(--green)' : 'var(--red)';

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => 'Evaluación', 'href' => '/cursos/evaluacion.php'],
    ['label' => 'Resultado'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="res-wrap">
                <div class="res-card">
                    <p class="res-eyebrow">Evaluación Parcial &middot; Módulo I</p>

                    <div class="res-donut">
                        <svg viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="52" fill="none" stroke="var(--surface3)" stroke-width="12"/>
                            <circle cx="60" cy="60" r="52" fill="none" stroke="<?= $color ?>" stroke-width="12" stroke-linecap="round" stroke-dasharray="<?= round($dash, 1) ?> <?= round($circ, 1) ?>" transform="rotate(-90 60 60)"/>
                        </svg>
                        <div class="res-donut-center">
                            <span class="res-score" style="color:<?= $color ?>"><?= $puntaje ?></span>
                            <span class="res-of">de 100</span>
                        </div>
                    </div>

                    <span class="badge <?= $aprobado ? 'badge-success' : 'badge-danger' ?>" style="font-size:0.82rem;padding:5px 16px;margin-bottom:1.3rem;">
                        <?= $aprobado ? 'Evaluación aprobada' : 'No aprobada' ?>
                    </span>

                    <div class="res-stats">
                        <div class="res-stat">
                            <span class="res-stat-val" style="color:var(--green)"><?= $aciertos ?></span>
                            <span class="res-stat-label">Aciertos</span>
                        </div>
                        <div class="res-stat">
                            <span class="res-stat-val" style="color:var(--red)"><?= $errores ?></span>
                            <span class="res-stat-label">Errores</span>
                        </div>
                        <div class="res-stat">
                            <span class="res-stat-val"><?= $totalEvaluadas ?></span>
                            <span class="res-stat-label">Preguntas</span>
                        </div>
                    </div>

                    <?php if (!$aprobado): ?>
                        <div class="res-alert">
                            <p class="res-alert-title">No alcanzaste el puntaje mínimo</p>
                            <p class="res-alert-text">Necesitas <strong><?= $minimo ?> puntos</strong> para aprobar. Llevas el intento <?= $intentoActual ?> de <?= $intentosMax ?>. Te recomendamos repasar el módulo antes de volver a intentarlo.</p>
                        </div>
                    <?php else: ?>
                        <div class="res-success">
                            <p class="res-success-text">Has demostrado dominio del contenido de este módulo. Puedes continuar con el siguiente o consultar tu constancia al finalizar el curso.</p>
                        </div>
                    <?php endif; ?>

                    <div class="res-actions">
                        <?php if ($aprobado): ?>
                            <a href="/modulos/modulo_2.php" class="btn btn-primary btn-full">Continuar al siguiente módulo</a>
                        <?php else: ?>
                            <a href="/cursos/evaluacion.php" class="btn btn-danger btn-full">Intentar de nuevo</a>
                        <?php endif; ?>
                        <a href="/cursos/calificaciones.php" class="btn btn-outline btn-full">Ver mis calificaciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .res-wrap { max-width: 520px; margin: 0 auto; }
    .res-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        padding: 2.2rem;
        text-align: center;
    }
    .res-eyebrow {
        font-size: 0.72rem;
        color: var(--text3);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 1.3rem;
    }
    .res-donut {
        width: 130px;
        height: 130px;
        position: relative;
        margin: 0 auto 1.1rem;
    }
    .res-donut svg { width: 130px; height: 130px; }
    .res-donut-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        flex-direction: column;
    }
    .res-score { font-family: var(--font-display); font-size: 1.85rem; font-weight: 700; line-height: 1; }
    .res-of { font-size: 0.7rem; color: var(--text3); margin-top: 2px; }
    .res-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.3rem;
    }
    .res-stat {
        background: var(--surface2);
        border-radius: var(--radius-sm);
        padding: 0.85rem;
    }
    .res-stat-val { display: block; font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; }
    .res-stat-label { font-size: 0.7rem; color: var(--text3); }
    .res-alert {
        background: rgba(192, 57, 43, 0.06);
        border: 1px solid rgba(192, 57, 43, 0.15);
        border-radius: var(--radius-sm);
        padding: 0.95rem 1.05rem;
        margin-bottom: 1.3rem;
        text-align: left;
    }
    .res-alert-title { font-size: 0.84rem; font-weight: 600; color: var(--red); margin-bottom: 0.25rem; }
    .res-alert-text { font-size: 0.8rem; color: var(--text2); line-height: 1.55; }
    .res-success {
        background: rgba(10, 140, 77, 0.06);
        border: 1px solid rgba(10, 140, 77, 0.15);
        border-radius: var(--radius-sm);
        padding: 0.95rem 1.05rem;
        margin-bottom: 1.3rem;
        text-align: left;
    }
    .res-success-text { font-size: 0.8rem; color: var(--text2); line-height: 1.55; }
    .res-actions { display: flex; flex-direction: column; gap: 0.6rem; }
</style>

<?php include '../includes/footer.php'; ?>
