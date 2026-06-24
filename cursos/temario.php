<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
require_once '../includes/progreso.php';
requireLogin();

marcarModuloVisto(1);

$pageTitle  = 'Temario';
$pageActive = 'temario';

$curso = datosCurso();
$m2 = datosModulo2();
$m3 = datosModulo3();

$temario = [
    [
        'numero' => 'I', 'id_modulo' => 1,
        'nombre' => 'Conceptos clave',
        'unidades' => [
            ['nombre' => 'Introducción a la Democracia', 'temas' => 2],
            ['nombre' => 'Participación ciudadana y elecciones', 'temas' => 3],
            ['nombre' => 'Derechos político-electorales', 'temas' => 3],
            ['nombre' => 'Cultura política y democracia incluyente', 'temas' => 2],
            ['nombre' => 'Evaluación del Módulo I', 'temas' => 1],
        ],
    ],
    [
        'numero' => 'II', 'id_modulo' => 2,
        'nombre' => $m2['nombre_modulo'],
        'unidades' => array_map(fn($u) => ['nombre' => $u['nombre_unidad'], 'temas' => count($u['temas'])], $m2['unidades']),
    ],
    [
        'numero' => 'III', 'id_modulo' => 3,
        'nombre' => $m3['nombre_modulo'],
        'unidades' => array_map(fn($u) => ['nombre' => $u['nombre_unidad'], 'temas' => count($u['temas'])], $m3['unidades']),
    ],
];

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $curso['nombre_curso'], 'href' => '/cursos/presentacion.php'],
    ['label' => 'Temario'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <div class="hero hero-dark hero-tint">
                    <div class="hero-content">
                        <span class="hero-badge" style="background:rgba(116,20,132,0.25);border-color:rgba(116,20,132,0.4);color:#fff;">Temario completo</span>
                        <h1 class="hero-title"><?= htmlspecialchars($curso['nombre_curso']) ?></h1>
                        <p class="hero-sub">3 módulos &middot; Instituto Electoral del Estado de Querétaro</p>
                    </div>
                </div>

                <div class="tem-list">
                    <?php foreach ($temario as $idx => $modulo): ?>
                        <div class="tem-mod <?= $idx === 0 ? 'open' : '' ?>" data-mod="<?= $idx ?>">
                            <button class="tem-mod-head" onclick="toggleTem(<?= $idx ?>)">
                                <span class="tem-mod-num"><?= $modulo['numero'] ?></span>
                                <span class="tem-mod-info">
                                    <span class="tem-mod-name"><?= htmlspecialchars($modulo['nombre']) ?></span>
                                    <span class="tem-mod-meta"><?= count($modulo['unidades']) ?> unidades</span>
                                </span>
                                <a href="/modulos/modulo_<?= $modulo['id_modulo'] ?>.php" class="tem-mod-link" onclick="event.stopPropagation()">Abrir</a>
                                <svg class="tem-mod-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                            <div class="tem-mod-body">
                                <?php foreach ($modulo['unidades'] as $u): ?>
                                    <div class="tem-unidad">
                                        <span class="tem-unidad-dot"></span>
                                        <span class="tem-unidad-name"><?= htmlspecialchars($u['nombre']) ?></span>
                                        <span class="tem-unidad-temas"><?= $u['temas'] ?> temas</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top:1.5rem;display:flex;gap:0.75rem;">
                    <a href="/cursos/objetivos.php" class="btn btn-ghost">Objetivos</a>
                    <a href="/modulos/modulo_1.php" class="btn btn-primary">Comenzar Módulo I</a>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .tem-list { display: flex; flex-direction: column; gap: 0.7rem; }
    .tem-mod {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .tem-mod-head {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 1.1rem 1.25rem;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        font-family: var(--font-body);
    }
    .tem-mod-num {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: linear-gradient(135deg, var(--primary), var(--purple3));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.82rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .tem-mod-info { flex: 1; }
    .tem-mod-name {
        display: block;
        font-family: var(--font-display);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.35;
    }
    .tem-mod-meta { font-size: 0.74rem; color: var(--text3); }
    .tem-mod-link {
        font-size: 0.74rem;
        color: var(--primary);
        background: rgba(116, 20, 132, 0.07);
        border: 1px solid rgba(116, 20, 132, 0.15);
        border-radius: 7px;
        padding: 5px 12px;
        font-weight: 600;
        flex-shrink: 0;
    }
    .tem-mod-arrow {
        width: 18px;
        height: 18px;
        color: var(--text3);
        transition: transform var(--transition);
        flex-shrink: 0;
    }
    .tem-mod.open .tem-mod-arrow { transform: rotate(180deg); }
    .tem-mod-body { display: none; padding: 0.4rem 1.25rem 0.9rem; border-top: 1px solid var(--border); }
    .tem-mod.open .tem-mod-body { display: block; }
    .tem-unidad {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 0.55rem 0;
        border-bottom: 1px solid var(--border);
    }
    .tem-unidad:last-child { border-bottom: none; }
    .tem-unidad-dot {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        background: rgba(116, 20, 132, 0.08);
        flex-shrink: 0;
        position: relative;
    }
    .tem-unidad-dot::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--primary);
    }
    .tem-unidad-name { font-size: 0.83rem; color: var(--text2); flex: 1; }
    .tem-unidad-temas { font-size: 0.7rem; color: var(--text3); }
</style>

<script>
    function toggleTem(idx) {
        document.querySelector('[data-mod="' + idx + '"]').classList.toggle('open');
    }
</script>

<?php include '../includes/footer.php'; ?>
