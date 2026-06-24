<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/evaluaciones.php';
require_once '../includes/progreso.php';
requireLogin();

$id   = $_POST['eval_id'] ?? ($_GET['id'] ?? 'final');
$eval = obtenerEvaluacion($id);

if (!$eval) {
    header('Location: /dashboard/dashboard.php');
    exit;
}

$pageTitle  = 'Resultado de la Evaluación';
$pageActive = $eval['modulo'] > 0 ? 'modulo' . $eval['modulo'] : 'evaluacion';

$preguntas = $eval['preguntas'];
$totalPreguntas = count($preguntas);
$minimo = (int) $eval['minimo'];

$aciertos = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($preguntas as $i => $p) {
        if (isset($_POST['q' . $i]) && (int) $_POST['q' . $i] === (int) $p['correcta']) {
            $aciertos++;
        }
    }
} else {
    $aciertos = $totalPreguntas;
}

$puntaje  = $totalPreguntas > 0 ? (int) round(($aciertos / $totalPreguntas) * 100) : 0;
$errores  = $totalPreguntas - $aciertos;
$aprobado = $puntaje >= $minimo;

if ($aprobado) {
    marcarEvaluacionAprobada($eval['id']);
}

$circ = 2 * M_PI * 52;
$dash = ($puntaje / 100) * $circ;
$color = $aprobado ? 'var(--green)' : 'var(--red)';

$esFinal       = $eval['id'] === 'final';
$siguienteMod  = $eval['modulo'] + 1;
$haySiguiente  = $eval['modulo'] > 0 && $siguienteMod <= 3;

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $eval['titulo'], 'href' => '/cursos/evaluacion-intro.php?id=' . $eval['id']],
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
                    <p class="res-eyebrow"><?= htmlspecialchars($eval['titulo']) ?></p>

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
                            <span class="res-stat-val"><?= $totalPreguntas ?></span>
                            <span class="res-stat-label">Preguntas</span>
                        </div>
                    </div>

                    <?php if (!$aprobado): ?>
                        <div class="res-alert">
                            <p class="res-alert-title">No alcanzaste el puntaje mínimo</p>
                            <p class="res-alert-text">Necesitas <strong><?= $minimo ?>%</strong> para aprobar. Te recomendamos repasar el contenido antes de volver a intentarlo. Recuerda que cuentas con <?= (int) $eval['intentos'] ?> intentos.</p>
                        </div>
                    <?php else: ?>
                        <div class="res-success">
                            <p class="res-success-text">
                                <?php if ($esFinal): ?>
                                    Has aprobado la evaluación final del curso. Ya puedes descargar tu constancia de participación.
                                <?php else: ?>
                                    Has demostrado dominio del contenido de este módulo. Puedes continuar con el siguiente.
                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="res-actions">
                        <?php if (!$aprobado): ?>
                            <a href="/cursos/evaluacion.php?id=<?= htmlspecialchars($eval['id']) ?>" class="btn btn-danger btn-full">Intentar de nuevo</a>
                        <?php elseif ($esFinal): ?>
                            <a href="/cursos/constancia.php" class="btn btn-primary btn-full">Ver mi constancia</a>
                        <?php elseif ($haySiguiente): ?>
                            <a href="/modulos/modulo_<?= $siguienteMod ?>.php" class="btn btn-primary btn-full">Continuar al siguiente módulo</a>
                        <?php else: ?>
                            <a href="/cursos/evaluacion-intro.php?id=final" class="btn btn-primary btn-full">Ir a la evaluación final</a>
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
    .res-donut { width: 130px; height: 130px; position: relative; margin: 0 auto 1.1rem; }
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
    .res-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1.3rem; }
    .res-stat { background: var(--surface2); border-radius: var(--radius-sm); padding: 0.85rem; }
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
