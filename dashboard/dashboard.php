<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
requireLogin();

$pageTitle  = 'Inicio';
$pageActive = 'inicio';
$breadcrumb = [['label' => 'Cursos disponibles']];

$cursos = [];

if (DB_ACTIVA && $pdo) {
    $stmt = $pdo->prepare('
        SELECT c.id_curso, c.nombre_curso, c.presentacion_curso, COALESCE(i.progreso, 0) AS progreso
        FROM aprende_curso c
        LEFT JOIN aprende_inscripciones_curso i ON i.id_curso = c.id_curso AND i.id_persona = ?
        WHERE c.estatus_curso = 1
        ORDER BY c.id_curso
    ');
    $stmt->execute([$_SESSION['usuario_id']]);
    $cursos = $stmt->fetchAll();
} else {
    $curso = datosCurso();
    $cursos = [[
        'id_curso'           => $curso['id_curso'],
        'nombre_curso'       => $curso['nombre_curso'],
        'presentacion_curso' => $curso['presentacion_curso'],
        'progreso'           => 0,
    ]];
}

$acentos = ['var(--primary)', 'var(--blue)', 'var(--purple3)', 'var(--purple2)'];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <div class="hero hero-primary">
                    <div class="hero-content">
                        <span class="hero-badge">Proceso Electoral Local 2026&ndash;2027</span>
                        <h1 class="hero-title">Bienvenido, <?= htmlspecialchars(explode(' ', usuarioActual()['nombre'])[0]) ?></h1>
                        <p class="hero-sub">Selecciona un curso para comenzar o continuar tu formacion electoral.</p>
                    </div>
                </div>

                <p class="section-label">Mis cursos</p>

                <?php if (empty($cursos)): ?>
                    <div class="card card-body" style="text-align:center;color:var(--text2);">
                        Aun no hay cursos disponibles. Vuelve mas tarde.
                    </div>
                <?php else: ?>
                    <div class="course-grid">
                        <?php foreach ($cursos as $i => $curso):
                            $pct    = (int) ($curso['progreso'] ?? 0);
                            $acento = $acentos[$i % count($acentos)];
                        ?>
                            <article class="course-card">
                                <div class="course-banner" style="background:linear-gradient(135deg, <?= $acento ?>, color-mix(in srgb, <?= $acento ?> 60%, #000));">
                                    <span class="course-banner-tag"><?= $pct > 0 ? 'En progreso' : 'Nuevo' ?></span>
                                    <svg class="course-banner-mark" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                    </svg>
                                </div>
                                <div class="course-body">
                                    <h3 class="course-title"><?= htmlspecialchars($curso['nombre_curso']) ?></h3>
                                    <p class="course-desc"><?= htmlspecialchars($curso['presentacion_curso']) ?></p>
                                    <div class="course-prog">
                                        <div class="course-prog-head">
                                            <span>Progreso</span>
                                            <span class="course-prog-pct"><?= $pct ?>%</span>
                                        </div>
                                        <div class="course-prog-track"><div class="course-prog-fill" style="width:<?= $pct ?>%"></div></div>
                                    </div>
                                    <a href="../cursos/presentacion.php?id=<?= $curso['id_curso'] ?>" class="btn btn-primary btn-full">
                                        <?= $pct > 0 ? 'Continuar curso' : 'Comenzar curso' ?>
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<style>
    .course-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.35rem;
    }
    .course-card {
        background: #fff;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: transform var(--transition), box-shadow var(--transition);
    }
    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow);
    }
    .course-banner {
        height: 116px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .course-banner-mark { width: 52px; height: 52px; }
    .course-banner-tag {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        padding: 3px 11px;
        font-size: 0.66rem;
        color: #fff;
        font-weight: 600;
    }
    .course-body { padding: 1.15rem; }
    .course-title {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 0.4rem;
        line-height: 1.3;
    }
    .course-desc {
        font-size: 0.78rem;
        color: var(--text2);
        line-height: 1.55;
        margin-bottom: 0.9rem;
        min-height: 2.4em;
    }
    .course-prog-head {
        display: flex;
        justify-content: space-between;
        margin-bottom: 6px;
    }
    .course-prog-head span { font-size: 0.72rem; color: var(--text3); }
    .course-prog-pct { font-weight: 600; color: var(--primary) !important; }
    .course-prog-track {
        height: 5px;
        background: var(--surface3);
        border-radius: 4px;
        overflow: hidden;
        margin-bottom: 1rem;
    }
    .course-prog-fill {
        height: 100%;
        border-radius: 4px;
        background: linear-gradient(90deg, var(--primary), var(--pink));
    }
</style>

<?php include '../includes/footer.php'; ?>
