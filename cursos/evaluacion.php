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
$preguntas  = $eval['preguntas'];

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $eval['titulo'], 'href' => '/cursos/evaluacion-intro.php?id=' . $eval['id']],
    ['label' => 'En curso'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">
                <form action="resultado.php" method="POST" id="evalForm">
                    <input type="hidden" name="eval_id" value="<?= htmlspecialchars($eval['id']) ?>">
                    <div class="eval-grid">

                        <aside class="eval-side">
                            <p class="eyebrow">Preguntas</p>
                            <div class="eval-qmap">
                                <?php for ($i = 0; $i < count($preguntas); $i++): ?>
                                    <button type="button" class="eval-qbtn <?= $i === 0 ? 'current' : '' ?>" data-q="<?= $i ?>" onclick="irPregunta(<?= $i ?>)"><?= $i + 1 ?></button>
                                <?php endfor; ?>
                            </div>
                            <div class="eval-legend">
                                <span><i class="dot answered"></i> Respondida</span>
                                <span><i class="dot current"></i> Actual</span>
                                <span><i class="dot pending"></i> Pendiente</span>
                            </div>
                            <div class="eval-timer" style="background:linear-gradient(135deg, <?= $acento ?>, color-mix(in srgb, <?= $acento ?> 50%, #000));">
                                <span class="eval-timer-val" id="timer"><?= str_pad((string) $eval['minutos'], 2, '0', STR_PAD_LEFT) ?>:00</span>
                                <span class="eval-timer-label">tiempo restante</span>
                            </div>
                        </aside>

                        <div class="eval-main">
                            <div class="eval-bar">
                                <h2 class="eval-name"><?= htmlspecialchars($eval['titulo']) ?></h2>
                                <div class="eval-chips">
                                    <span class="badge badge-muted"><?= count($preguntas) ?> preguntas</span>
                                    <span class="badge badge-muted"><?= (int) $eval['intentos'] ?> intentos</span>
                                    <span class="badge badge-muted">Mínimo <?= (int) $eval['minimo'] ?>%</span>
                                </div>
                            </div>

                            <?php foreach ($preguntas as $i => $p): ?>
                                <div class="eval-q <?= $i === 0 ? '' : 'hidden' ?>" data-qpanel="<?= $i ?>">
                                    <p class="eval-q-count">Pregunta <?= $i + 1 ?> de <?= count($preguntas) ?></p>
                                    <h3 class="eval-q-text"><?= htmlspecialchars($p['texto']) ?></h3>
                                    <div class="eval-opts">
                                        <?php foreach ($p['opciones'] as $j => $op): ?>
                                            <label class="eval-opt">
                                                <input type="radio" name="q<?= $i ?>" value="<?= $j ?>" onchange="marcar(<?= $i ?>)">
                                                <span class="eval-opt-letter"><?= chr(65 + $j) ?></span>
                                                <span class="eval-opt-text"><?= htmlspecialchars($op) ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="eval-foot">
                                <button type="button" class="btn btn-ghost" id="btnPrev" onclick="prev()" disabled><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg> Anterior</button>
                                <span class="eval-foot-count" id="footCount">1 / <?= count($preguntas) ?></span>
                                <button type="button" class="btn btn-ghost" id="btnNext" onclick="next()">Siguiente <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></button>
                                <button type="submit" class="btn btn-primary" id="btnFinish" style="display:none;background:<?= $acento ?>;" onclick="return confirm('¿Deseas finalizar la evaluación? Ya no podrás cambiar tus respuestas.')">Finalizar evaluación</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .eval-grid { display: grid; grid-template-columns: 220px 1fr; gap: 1.35rem; align-items: start; }
    .eval-side {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.15rem;
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
        position: sticky;
        top: 80px;
    }
    .eval-qmap { display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px; }
    .eval-qbtn {
        aspect-ratio: 1;
        border-radius: 9px;
        font-family: var(--font-display);
        font-size: 0.74rem;
        font-weight: 600;
        border: 1.5px solid var(--border);
        background: var(--surface2);
        color: var(--text3);
        cursor: pointer;
        transition: all var(--transition);
    }
    .eval-qbtn.answered { background: var(--primary); border-color: var(--primary); color: #fff; }
    .eval-qbtn.current { border-color: var(--primary); color: var(--primary); background: rgba(116, 20, 132, 0.08); }
    .eval-legend { display: flex; flex-direction: column; gap: 6px; }
    .eval-legend span { display: flex; align-items: center; gap: 8px; font-size: 0.72rem; color: var(--text2); }
    .eval-legend .dot { width: 11px; height: 11px; border-radius: 3px; }
    .eval-legend .dot.answered { background: var(--primary); }
    .eval-legend .dot.current { border: 2px solid var(--primary); background: rgba(116, 20, 132, 0.08); }
    .eval-legend .dot.pending { background: var(--surface3); border: 1px solid var(--border); }
    .eval-timer { border-radius: var(--radius-sm); padding: 0.95rem; text-align: center; }
    .eval-timer-val { display: block; font-family: var(--font-display); font-size: 1.4rem; font-weight: 700; color: #fff; }
    .eval-timer-label { font-size: 0.66rem; color: rgba(255, 255, 255, 0.6); }
    .eval-main { display: flex; flex-direction: column; gap: 1.1rem; }
    .eval-bar {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.1rem 1.35rem;
    }
    .eval-name { font-family: var(--font-display); font-size: 1.02rem; font-weight: 600; margin-bottom: 0.6rem; }
    .eval-chips { display: flex; gap: 7px; flex-wrap: wrap; }
    .eval-q {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.6rem;
    }
    .eval-q.hidden { display: none; }
    .eval-q-count { font-size: 0.72rem; color: var(--text3); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.6rem; }
    .eval-q-text { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--text); line-height: 1.5; margin-bottom: 1.4rem; }
    .eval-opts { display: flex; flex-direction: column; gap: 0.6rem; }
    .eval-opt {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 0.9rem 1.05rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        cursor: pointer;
        transition: all var(--transition);
    }
    .eval-opt:hover { border-color: var(--primary); background: rgba(116, 20, 132, 0.04); }
    .eval-opt input { display: none; }
    .eval-opt-letter {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.76rem;
        font-weight: 700;
        color: var(--text3);
        flex-shrink: 0;
        transition: all var(--transition);
    }
    .eval-opt:has(input:checked) { border-color: var(--primary); background: rgba(116, 20, 132, 0.08); }
    .eval-opt:has(input:checked) .eval-opt-letter { background: var(--primary); border-color: var(--primary); color: #fff; }
    .eval-opt-text { font-size: 0.9rem; color: var(--text); }
    .eval-foot {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 0.9rem 1.35rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .eval-foot-count { font-size: 0.78rem; color: var(--text3); }
    @media (max-width: 860px) { .eval-grid { grid-template-columns: 1fr; } .eval-side { position: static; } }
</style>

<script>
    const total = <?= count($preguntas) ?>;
    let actual = 0;
    const respondidas = new Array(total).fill(false);
    let segundos = <?= (int) $eval['minutos'] ?> * 60;

    function irPregunta(i) {
        document.querySelector('[data-qpanel="' + actual + '"]').classList.add('hidden');
        document.querySelector('[data-q="' + actual + '"]').classList.remove('current');
        if (respondidas[actual]) document.querySelector('[data-q="' + actual + '"]').classList.add('answered');

        actual = i;
        document.querySelector('[data-qpanel="' + actual + '"]').classList.remove('hidden');
        document.querySelector('[data-q="' + actual + '"]').classList.add('current');
        document.getElementById('footCount').textContent = (actual + 1) + ' / ' + total;
        document.getElementById('btnPrev').disabled = actual === 0;

        const ultimo = actual === total - 1;
        document.getElementById('btnNext').style.display = ultimo ? 'none' : 'inline-flex';
        document.getElementById('btnFinish').style.display = ultimo ? 'inline-flex' : 'none';
    }

    function next() { if (actual < total - 1) irPregunta(actual + 1); }
    function prev() { if (actual > 0) irPregunta(actual - 1); }

    function marcar(i) {
        respondidas[i] = true;
        document.querySelector('[data-q="' + i + '"]').classList.add('answered');
    }

    const timerEl = document.getElementById('timer');
    setInterval(function () {
        if (segundos <= 0) { document.getElementById('evalForm').submit(); return; }
        segundos--;
        const m = String(Math.floor(segundos / 60)).padStart(2, '0');
        const s = String(segundos % 60).padStart(2, '0');
        timerEl.textContent = m + ':' + s;
    }, 1000);
</script>

<?php include '../includes/footer.php'; ?>
