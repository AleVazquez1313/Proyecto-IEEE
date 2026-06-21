<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
requireLogin();

$pageTitle  = 'Objetivo del Curso';
$pageActive = 'objetivos';

$curso = datosCurso();
$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => $curso['nombre_curso'], 'href' => '/cursos/presentacion.php'],
    ['label' => 'Objetivo'],
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
                        <span class="hero-badge" style="background:rgba(116,20,132,0.25);border-color:rgba(116,20,132,0.4);color:#fff;">Objetivo del curso</span>
                        <h1 class="hero-title"><?= htmlspecialchars($curso['nombre_curso']) ?></h1>
                        <p class="hero-sub">Instituto Electoral del Estado de Querétaro &middot; PEL 2026-2027</p>
                    </div>
                </div>

                <div class="card card-body" style="margin-bottom:1.3rem;">
                    <p class="eyebrow">Objetivo general</p>
                    <p style="font-family:var(--font-display);font-size:0.98rem;font-weight:500;color:var(--text);line-height:1.7;"><?= htmlspecialchars($curso['objetivo_curso']) ?></p>
                </div>

                <p class="section-label">Objetivos específicos</p>
                <div class="obj-list">
                    <?php foreach ($curso['objetivos'] as $i => $obj): ?>
                        <div class="obj-row">
                            <span class="obj-num"><?= $i + 1 ?></span>
                            <p class="obj-text"><?= htmlspecialchars($obj) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top:1.5rem;display:flex;gap:0.75rem;">
                    <a href="/cursos/presentacion.php" class="btn btn-ghost">Presentación</a>
                    <a href="/cursos/temario.php" class="btn btn-primary">Ver temario</a>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .obj-list { display: flex; flex-direction: column; gap: 0.7rem; }
    .obj-row {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 1.05rem 1.25rem;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }
    .obj-num {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        background: rgba(116, 20, 132, 0.1);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 0.78rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .obj-text {
        font-size: 0.88rem;
        color: var(--text2);
        line-height: 1.6;
        padding-top: 3px;
    }
</style>

<?php include '../includes/footer.php'; ?>
