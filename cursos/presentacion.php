<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
requireLogin();

$pageTitle  = 'Presentación del Curso';
$pageActive = 'presentacion';

$curso   = datosCurso();
$modulos = datosModulos();
$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $curso['nombre_curso'], 'href' => '/cursos/presentacion.php'],
    ['label' => 'Presentación'],
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
                        <span class="hero-badge" style="background:rgba(243,60,124,0.2);border-color:rgba(243,60,124,0.35);color:#fff;">Curso autogestivo</span>
                        <h1 class="hero-title"><?= htmlspecialchars($curso['nombre_curso']) ?></h1>
                        <p class="hero-sub">Instituto Electoral del Estado de Querétaro &middot; 3 módulos &middot; 40 horas &middot; PEL 2026-2027</p>
                    </div>
                </div>

                <div class="card card-body" style="margin-bottom:1.3rem;">
                    <p class="eyebrow">Presentación</p>
                    <p style="font-size:0.9rem;color:var(--text2);line-height:1.75;"><?= htmlspecialchars($curso['presentacion_curso']) ?></p>
                </div>

                <p class="section-label">Estructura del curso</p>
                <div class="mod-list">
                    <?php foreach ($modulos as $m): ?>
                        <a href="/modulos/modulo_<?= $m['id_modulo'] ?>.php" class="mod-row">
                            <span class="mod-row-num"><?= $m['numero'] ?></span>
                            <span class="mod-row-info">
                                <span class="mod-row-name"><?= htmlspecialchars($m['nombre_modulo']) ?></span>
                                <span class="mod-row-meta"><?= $m['unidades'] ?> unidades</span>
                            </span>
                            <svg class="mod-row-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top:1.5rem;display:flex;gap:0.75rem;">
                    <a href="/cursos/objetivos.php" class="btn btn-ghost">Ver objetivos</a>
                    <a href="/modulos/modulo_1.php" class="btn btn-primary">Comenzar curso</a>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .mod-list { display: flex; flex-direction: column; gap: 0.7rem; }
    .mod-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 1.1rem 1.25rem;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        transition: all var(--transition);
    }
    .mod-row:hover {
        box-shadow: var(--shadow);
        transform: translateX(3px);
    }
    .mod-row-num {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary), var(--purple3));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }
    .mod-row-info { flex: 1; }
    .mod-row-name {
        display: block;
        font-family: var(--font-display);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text);
        line-height: 1.35;
    }
    .mod-row-meta {
        font-size: 0.74rem;
        color: var(--text3);
    }
    .mod-row-arrow {
        width: 18px;
        height: 18px;
        color: var(--text3);
        flex-shrink: 0;
    }
</style>

<?php include '../includes/footer.php'; ?>
