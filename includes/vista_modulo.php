<?php
$mod    = $moduloData;
$acento = $mod['acento'];
$rgb    = $mod['acento_rgb'];
$progreso = $progresoModulo ?? 0;

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $mod['nombre_curso'], 'href' => '/cursos/presentacion.php?id=' . $mod['id_curso']],
    ['label' => 'Módulo ' . $mod['numero']],
];

include __DIR__ . '/header.php';
?>
<div class="app-wrapper">
    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="main-content">
        <?php include __DIR__ . '/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <div class="hero hero-dark hero-tint" style="--mod-accent: <?= $acento ?>;">
                    <div class="hero-content">
                        <span class="hero-badge" style="background:rgba(<?= $rgb ?>,0.25);border-color:rgba(<?= $rgb ?>,0.4);color:#fff;">Módulo <?= $mod['numero'] ?> de III</span>
                        <h1 class="hero-title"><?= htmlspecialchars($mod['nombre_modulo']) ?></h1>
                        <p class="hero-sub">Instituto Electoral del Estado de Querétaro &middot; <?= count($mod['unidades']) ?> unidades &middot; PEL 2026-2027</p>
                        <div class="mod-progress">
                            <div class="mod-progress-track"><div class="mod-progress-fill" style="width:<?= $progreso ?>%;background:linear-gradient(90deg, <?= $acento ?>, color-mix(in srgb, <?= $acento ?> 50%, #fff));"></div></div>
                            <span class="mod-progress-pct"><?= $progreso ?>% completado</span>
                        </div>
                    </div>
                </div>

                <div class="mod-cols">
                    <div class="mod-card">
                        <p class="eyebrow">Objetivo del módulo</p>
                        <p class="mod-card-text"><?= htmlspecialchars($mod['objetivo_modulo']) ?></p>
                    </div>
                    <div class="mod-card">
                        <p class="eyebrow">Presentación</p>
                        <p class="mod-card-text"><?= htmlspecialchars($mod['presentacion_modulo']) ?></p>
                    </div>
                </div>

                <?php if (!empty($mod['timeline'])): ?>
                    <div class="card card-body" style="margin-bottom:1.5rem;">
                        <p class="eyebrow">Etapas del proceso electoral</p>
                        <div class="timeline">
                            <?php foreach ($mod['timeline'] as $paso): ?>
                                <div class="tl-item">
                                    <div class="tl-dot <?= !empty($paso['destacado']) ? 'tl-dot-hl' : '' ?>"><?= $paso['n'] ?></div>
                                    <div class="tl-body">
                                        <p class="tl-title <?= !empty($paso['destacado']) ? 'tl-title-hl' : '' ?>"><?= htmlspecialchars($paso['titulo']) ?></p>
                                        <span class="tl-detail"><?= htmlspecialchars($paso['detalle']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <p class="section-label">Contenido del módulo</p>

                <div class="unidades">
                    <?php foreach ($mod['unidades'] as $unidad):
                        $esEval = !empty($unidad['es_evaluacion']);
                    ?>
                        <div class="unidad" data-unidad="<?= $unidad['id_unidad'] ?>">
                            <button class="unidad-head" onclick="toggleUnidad(<?= $unidad['id_unidad'] ?>)">
                                <span class="unidad-num <?= $esEval ? 'is-eval' : '' ?>">
                                    <?php if ($esEval): ?>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                                    <?php else: ?>
                                        U<?= $unidad['numero_unidad'] ?>
                                    <?php endif; ?>
                                </span>
                                <span class="unidad-info">
                                    <span class="unidad-name"><?= htmlspecialchars($unidad['nombre_unidad']) ?></span>
                                    <span class="unidad-desc"><?= htmlspecialchars($unidad['descripcion_unidad']) ?></span>
                                </span>
                                <span class="badge <?= $esEval ? 'badge-gold' : 'badge-muted' ?>">
                                    <?= $esEval ? 'Evaluación' : count($unidad['temas']) . ' temas' ?>
                                </span>
                                <svg class="unidad-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                            </button>
                            <div class="unidad-temas" id="temas-<?= $unidad['id_unidad'] ?>">
                                <?php foreach ($unidad['temas'] as $tema): ?>
                                    <a href="/cursos/tema.php?id=<?= $tema['id_tema'] ?>" class="tema-link">
                                        <span class="tema-bullet"></span>
                                        <span class="tema-name"><?= htmlspecialchars($tema['nombre_tema']) ?></span>
                                        <span class="tema-num">Tema <?= $tema['numero_tema'] ?></span>
                                        <svg class="tema-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mod-actions">
                    <?php if ($mod['id_modulo'] > 1): ?>
                        <a href="/modulos/modulo_<?= $mod['id_modulo'] - 1 ?>.php" class="btn btn-ghost">Módulo anterior</a>
                    <?php endif; ?>
                    <a href="/cursos/tema.php?id=<?= $mod['unidades'][0]['temas'][0]['id_tema'] ?>" class="btn btn-primary" style="background:<?= $acento ?>;box-shadow:0 4px 16px rgba(<?= $rgb ?>,0.35);">Comenzar módulo</a>
                    <?php if ($mod['id_modulo'] < 3): ?>
                        <a href="/modulos/modulo_<?= $mod['id_modulo'] + 1 ?>.php" class="btn btn-ghost">Módulo siguiente</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .mod-progress {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
        max-width: 520px;
    }
    .mod-progress-track {
        flex: 1;
        height: 6px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 4px;
        overflow: hidden;
    }
    .mod-progress-fill {
        height: 100%;
        border-radius: 4px;
    }
    .mod-progress-pct {
        font-size: 0.74rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.7);
        white-space: nowrap;
    }
    .mod-cols {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
        margin-bottom: 1.5rem;
    }
    .mod-card {
        background: #fff;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        padding: 1.35rem;
    }
    .mod-card-text {
        font-size: 0.86rem;
        color: var(--text2);
        line-height: 1.7;
    }
    .timeline {
        margin-top: 0.4rem;
    }
    .tl-item {
        display: flex;
        gap: 14px;
        padding: 0.55rem 0;
        position: relative;
    }
    .tl-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 13px;
        top: 32px;
        width: 2px;
        height: calc(100% - 10px);
        background: linear-gradient(to bottom, rgba(116, 20, 132, 0.25), rgba(116, 20, 132, 0.08));
    }
    .tl-dot {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(116, 20, 132, 0.12);
        border: 2px solid rgba(116, 20, 132, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--primary);
        flex-shrink: 0;
    }
    .tl-dot-hl {
        background: rgba(201, 150, 10, 0.15);
        border-color: rgba(201, 150, 10, 0.45);
        color: var(--gold);
    }
    .tl-title {
        font-size: 0.86rem;
        font-weight: 600;
        color: var(--text);
    }
    .tl-title-hl {
        color: var(--gold);
    }
    .tl-detail {
        font-size: 0.76rem;
        color: var(--text3);
    }
    .unidades {
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
    }
    .unidad {
        background: #fff;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: box-shadow var(--transition);
    }
    .unidad:hover {
        box-shadow: var(--shadow);
    }
    .unidad-head {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 1rem 1.15rem;
        cursor: pointer;
        background: none;
        border: none;
        text-align: left;
        font-family: var(--font-body);
    }
    .unidad-num {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--surface3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.74rem;
        font-weight: 700;
        color: var(--primary);
        flex-shrink: 0;
    }
    .unidad-num.is-eval {
        background: rgba(201, 150, 10, 0.1);
        color: var(--gold);
    }
    .unidad-num svg {
        width: 16px;
        height: 16px;
    }
    .unidad-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }
    .unidad-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text);
    }
    .unidad-desc {
        font-size: 0.74rem;
        color: var(--text3);
    }
    .unidad-arrow {
        width: 17px;
        height: 17px;
        color: var(--text3);
        transition: transform var(--transition);
        flex-shrink: 0;
    }
    .unidad.open .unidad-arrow {
        transform: rotate(90deg);
    }
    .unidad-temas {
        display: none;
        border-top: 1px solid var(--border);
        padding: 0.4rem 1.15rem 0.7rem;
    }
    .unidad.open .unidad-temas {
        display: block;
    }
    .tema-link {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 0.62rem 0;
        border-bottom: 1px solid var(--border);
    }
    .tema-link:last-child {
        border-bottom: none;
    }
    .tema-bullet {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #d6cee4;
        flex-shrink: 0;
        transition: background var(--transition);
    }
    .tema-link:hover .tema-bullet {
        background: var(--primary);
    }
    .tema-name {
        font-size: 0.82rem;
        color: var(--text2);
        flex: 1;
        transition: color var(--transition);
    }
    .tema-link:hover .tema-name {
        color: var(--primary);
    }
    .tema-num {
        font-size: 0.7rem;
        color: var(--text3);
    }
    .tema-arrow {
        width: 14px;
        height: 14px;
        color: var(--primary);
        opacity: 0;
        transform: translateX(-4px);
        transition: all var(--transition);
    }
    .tema-link:hover .tema-arrow {
        opacity: 1;
        transform: translateX(0);
    }
    .mod-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }
    @media (max-width: 720px) {
        .mod-cols {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    function toggleUnidad(id) {
        const unidad = document.querySelector('[data-unidad="' + id + '"]');
        unidad.classList.toggle('open');
    }
    document.addEventListener('DOMContentLoaded', function () {
        const primera = document.querySelector('.unidad');
        if (primera) primera.classList.add('open');
    });
</script>

<?php include __DIR__ . '/footer.php'; ?>
