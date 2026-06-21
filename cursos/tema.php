<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
requireLogin();

$idTema = (int) ($_GET['id'] ?? 10);

$catalogo = [];
foreach ([datosModulo2(), datosModulo3()] as $mod) {
    foreach ($mod['unidades'] as $unidad) {
        foreach ($unidad['temas'] as $pos => $tema) {
            $catalogo[$tema['id_tema']] = [
                'tema'        => $tema,
                'unidad'      => $unidad['nombre_unidad'],
                'numero_u'    => $unidad['numero_unidad'],
                'modulo'      => $mod['nombre_modulo'],
                'id_modulo'   => $mod['id_modulo'],
                'hermanos'    => array_column($unidad['temas'], 'id_tema'),
            ];
        }
    }
}

$ctx = $catalogo[$idTema] ?? [
    'tema'      => ['id_tema' => $idTema, 'nombre_tema' => 'Tema', 'descripcion_tema' => 'Contenido del tema.', 'numero_tema' => 1],
    'unidad'    => 'Unidad', 'numero_u' => 1, 'modulo' => 'Módulo', 'id_modulo' => 2, 'hermanos' => [$idTema],
];

$tema      = $ctx['tema'];
$hermanos  = $ctx['hermanos'];
$posActual = array_search($idTema, $hermanos);
$anterior  = $posActual > 0 ? $hermanos[$posActual - 1] : null;
$siguiente = $posActual < count($hermanos) - 1 ? $hermanos[$posActual + 1] : null;

$pageTitle  = $tema['nombre_tema'];
$pageActive = 'modulo' . $ctx['id_modulo'];

$recursos = [
    ['nombre' => 'Lectura complementaria — ' . $tema['nombre_tema'], 'tipo' => 'PDF', 'meta' => 'PDF · 2.4 MB', 'url' => '#'],
    ['nombre' => 'Material oficial INE — Cultura cívica', 'tipo' => 'Enlace', 'meta' => 'Enlace externo', 'url' => 'https://ine.mx'],
];

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $ctx['modulo'], 'href' => '/modulos/modulo_' . $ctx['id_modulo'] . '.php'],
    ['label' => $tema['nombre_tema']],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="tema-scroll fade-in">
            <div class="tema-inner">

                <div class="tema-path">
                    <span>Unidad <?= $ctx['numero_u'] ?></span>
                    <span class="sep">/</span>
                    <span class="cur"><?= htmlspecialchars($ctx['unidad']) ?></span>
                </div>

                <span class="badge badge-primary" style="margin-bottom:0.6rem;">Tema <?= $tema['numero_tema'] ?></span>
                <h1 class="tema-title"><?= htmlspecialchars($tema['nombre_tema']) ?></h1>

                <div class="tema-video">
                    <button class="tema-play" aria-label="Reproducir video">
                        <svg viewBox="0 0 24 24" fill="currentColor"><polygon points="6 4 20 12 6 20 6 4"/></svg>
                    </button>
                    <span class="tema-video-meta">Video explicativo · 4:32 min</span>
                </div>

                <div class="tema-body">
                    <p><?= htmlspecialchars($tema['descripcion_tema']) ?></p>
                </div>

                <p class="section-label">Recursos de apoyo</p>
                <div class="rec-list">
                    <?php foreach ($recursos as $rec): ?>
                        <a href="<?= htmlspecialchars($rec['url']) ?>" target="_blank" class="rec-item">
                            <span class="rec-icon <?= $rec['tipo'] === 'PDF' ? 'rec-pdf' : 'rec-link' ?>">
                                <?php if ($rec['tipo'] === 'PDF'): ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                <?php endif; ?>
                            </span>
                            <span class="rec-info">
                                <span class="rec-name"><?= htmlspecialchars($rec['nombre']) ?></span>
                                <span class="rec-meta"><?= htmlspecialchars($rec['meta']) ?></span>
                            </span>
                            <span class="rec-action">Abrir</span>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>

        <div class="tema-nav">
            <?php if ($anterior): ?>
                <a href="/cursos/tema.php?id=<?= $anterior ?>" class="btn btn-ghost"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg> Anterior</a>
            <?php else: ?><span></span><?php endif; ?>

            <span class="tema-nav-count">Tema <?= ($posActual ?? 0) + 1 ?> de <?= count($hermanos) ?></span>

            <?php if ($siguiente): ?>
                <a href="/cursos/tema.php?id=<?= $siguiente ?>" class="btn btn-primary">Siguiente <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></a>
            <?php else: ?>
                <a href="/cursos/evaluacion.php" class="btn btn-primary">Ir a evaluación <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .tema-scroll { flex: 1; overflow-y: auto; padding: 1.85rem; }
    .tema-inner { max-width: 820px; margin: 0 auto; }
    .tema-path { display: flex; align-items: center; gap: 7px; font-size: 0.76rem; color: var(--text3); margin-bottom: 1rem; }
    .tema-path .sep { opacity: 0.5; }
    .tema-path .cur { color: var(--text); font-weight: 500; }
    .tema-title { font-family: var(--font-display); font-size: 1.55rem; font-weight: 700; color: var(--text); line-height: 1.25; margin-bottom: 1.3rem; letter-spacing: -0.02em; }
    .tema-video {
        background: linear-gradient(135deg, var(--dark), #1a0d24);
        border-radius: var(--radius);
        height: 260px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .tema-video::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(116, 20, 132, 0.18), transparent 60%); }
    .tema-play {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #fff;
        position: relative;
        z-index: 1;
        transition: all var(--transition);
    }
    .tema-play svg { width: 22px; height: 22px; margin-left: 3px; }
    .tema-play:hover { background: var(--primary); border-color: var(--primary); transform: scale(1.06); }
    .tema-video-meta { font-size: 0.76rem; color: rgba(255, 255, 255, 0.6); position: relative; z-index: 1; }
    .tema-body { font-size: 0.94rem; color: var(--text2); line-height: 1.85; margin-bottom: 1.6rem; }
    .rec-list { display: flex; flex-direction: column; gap: 0.6rem; }
    .rec-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 0.85rem 1rem;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        transition: all var(--transition);
    }
    .rec-item:hover { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(116, 20, 132, 0.07); }
    .rec-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .rec-icon svg { width: 19px; height: 19px; }
    .rec-pdf { background: rgba(116, 20, 132, 0.08); color: var(--primary); }
    .rec-link { background: rgba(52, 100, 132, 0.08); color: var(--blue); }
    .rec-info { flex: 1; }
    .rec-name { display: block; font-size: 0.84rem; font-weight: 500; color: var(--text); }
    .rec-meta { font-size: 0.72rem; color: var(--text3); }
    .rec-action { font-size: 0.76rem; color: var(--primary); font-weight: 600; }
    .tema-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.95rem 1.85rem;
        background: #fff;
        border-top: 1px solid var(--border);
        flex-shrink: 0;
    }
    .tema-nav-count { font-size: 0.78rem; color: var(--text3); }
</style>

<?php include '../includes/footer.php'; ?>
