<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/progreso.php';
requireLogin();

$pageTitle  = 'Constancia';
$pageActive = 'constancia';

$u = usuarioActual();
$nombreUsuario = $u['nombre'];
$nombreCurso   = 'ABC de la Función Electoral';
$fecha = date('d') . ' de ' . [
    1=>'enero',2=>'febrero',3=>'marzo',4=>'abril',5=>'mayo',6=>'junio',
    7=>'julio',8=>'agosto',9=>'septiembre',10=>'octubre',11=>'noviembre',12=>'diciembre'
][(int) date('n')] . ' de ' . date('Y');
$folio = 'IEEQ-2026-' . str_pad((string) ($u['id'] ?? 1), 5, '0', STR_PAD_LEFT);

$desbloqueada = constanciaDesbloqueada();
$porcentaje   = progresoPorcentaje();
$requisitos   = requisitosConstancia();

$breadcrumb = [
    ['label' => 'Inicio', 'href' => '/dashboard/dashboard.php'],
    ['label' => 'Mi constancia'],
];

include '../includes/header.php';
?>
<div class="app-wrapper">
    <?php include '../includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../includes/topbar.php'; ?>

        <div class="page-content fade-in">
            <div class="page-inner">

                <div class="cons-bar">
                    <h2 class="cons-heading">Tu constancia de participación</h2>
                    <?php if ($desbloqueada): ?>
                        <button onclick="window.print()" class="btn btn-primary">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Descargar PDF
                        </button>
                    <?php else: ?>
                        <span class="cons-locked-tag">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Bloqueada
                        </span>
                    <?php endif; ?>
                </div>

                <?php if (!$desbloqueada): ?>
                    <div class="cons-progress-panel">
                        <div class="cons-pp-head">
                            <div class="cons-pp-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </div>
                            <div>
                                <p class="cons-pp-title">Aún no has desbloqueado tu constancia</p>
                                <p class="cons-pp-sub">Completa todos los requisitos del curso para obtenerla.</p>
                            </div>
                            <span class="cons-pp-pct"><?= $porcentaje ?>%</span>
                        </div>
                        <div class="cons-pp-track"><div class="cons-pp-fill" style="width:<?= $porcentaje ?>%"></div></div>
                        <ul class="cons-pp-list">
                            <?php foreach ($requisitos as $r): ?>
                                <li class="<?= $r['completo'] ? 'done' : '' ?>">
                                    <span class="cons-pp-check">
                                        <?php if ($r['completo']): ?>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        <?php endif; ?>
                                    </span>
                                    <?= htmlspecialchars($r['etiqueta']) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="cert-shell <?= $desbloqueada ? '' : 'cert-locked' ?>">
                    <?php if (!$desbloqueada): ?>
                        <div class="cert-lock-overlay">
                            <div class="cert-lock-badge">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </div>
                            <p class="cert-lock-text">Constancia bloqueada</p>
                            <p class="cert-lock-sub">Termina el curso para revelarla</p>
                        </div>
                    <?php endif; ?>
                    <div class="certificate" id="certificado">
                        <div class="cert-stripe"></div>
                        <div class="cert-inner">
                        <div class="cert-head">
                            <div class="cert-org">
                                <div class="cert-logo">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="18" rx="2"/><path d="M8 3v18"/><path d="M16 9l-4 4-4-4"/></svg>
                                </div>
                                <div>
                                    <p class="cert-org-name">Instituto Electoral del Estado de Querétaro</p>
                                    <p class="cert-org-sub">Tu participación hace la democracia</p>
                                </div>
                            </div>
                            <div class="cert-folio">
                                <span>Folio: <?= $folio ?></span>
                                <span>PEL 2026-2027</span>
                            </div>
                        </div>

                        <div class="cert-title">
                            <p class="cert-title-main">Constancia de participación</p>
                            <p class="cert-title-sub">Curso autogestivo</p>
                        </div>

                        <div class="cert-body">
                            <p class="cert-consta">Se hace constar que</p>
                            <p class="cert-nombre"><?= htmlspecialchars($nombreUsuario) ?></p>
                            <p class="cert-label">completó satisfactoriamente el curso</p>
                            <p class="cert-curso"><?= htmlspecialchars($nombreCurso) ?></p>
                            <p class="cert-fecha">Fecha de conclusión: <strong><?= $fecha ?></strong></p>
                        </div>

                        <div class="cert-foot">
                            <div class="cert-firma">
                                <div class="cert-firma-line"></div>
                                <p class="cert-firma-name">Consejería Presidenta</p>
                                <p class="cert-firma-role">Instituto Electoral del Estado de Querétaro</p>
                            </div>
                            <div class="cert-sello">
                                <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
                            </div>
                            <div class="cert-qr">
                                <div class="cert-qr-box">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--text2)" stroke-width="1.4"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><line x1="14" y1="14" x2="14" y2="21"/><line x1="21" y1="14" x2="21" y2="21"/><line x1="17.5" y1="14" x2="17.5" y2="21"/></svg>
                                </div>
                                <p class="cert-qr-label">Verificar autenticidad</p>
                            </div>
                        </div>
                    </div>
                    <div class="cert-stripe"></div>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .cons-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.3rem;
    }
    .cons-heading { font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; }
    .certificate {
        background: #fff;
        border-radius: var(--radius);
        overflow: hidden;
        max-width: 720px;
        margin: 0 auto;
        box-shadow: var(--shadow-lg);
    }
    .cert-stripe {
        height: 11px;
        background: linear-gradient(90deg, var(--primary) 0%, var(--pink) 50%, var(--primary) 100%);
    }
    .cert-inner { padding: 2.6rem 3rem; }
    .cert-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding-bottom: 1.3rem;
        border-bottom: 1px solid var(--surface3);
        margin-bottom: 1.6rem;
    }
    .cert-org { display: flex; align-items: center; gap: 13px; }
    .cert-logo {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        background: linear-gradient(135deg, var(--primary), var(--purple3));
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cert-logo svg { width: 24px; height: 24px; }
    .cert-org-name { font-family: var(--font-display); font-size: 0.88rem; font-weight: 600; color: var(--text); }
    .cert-org-sub { font-size: 0.72rem; color: var(--text3); margin-top: 1px; }
    .cert-folio { display: flex; flex-direction: column; align-items: flex-end; gap: 3px; }
    .cert-folio span { font-size: 0.68rem; color: var(--text3); }
    .cert-title { text-align: center; margin-bottom: 1.6rem; }
    .cert-title-main {
        font-family: var(--font-display);
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--primary);
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .cert-title-sub {
        font-size: 0.7rem;
        color: var(--text3);
        text-transform: uppercase;
        letter-spacing: 0.12em;
        margin-top: 4px;
    }
    .cert-body {
        background: var(--surface2);
        border: 1px solid var(--surface3);
        border-radius: 14px;
        padding: 1.9rem;
        text-align: center;
        margin-bottom: 1.6rem;
    }
    .cert-consta { font-size: 0.82rem; color: var(--text3); margin-bottom: 0.5rem; }
    .cert-nombre { font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; color: var(--text); margin-bottom: 0.5rem; }
    .cert-label { font-size: 0.78rem; color: var(--text3); }
    .cert-curso { font-family: var(--font-display); font-size: 1.05rem; font-weight: 600; color: var(--primary); margin: 4px 0 0.6rem; }
    .cert-fecha { font-size: 0.82rem; color: var(--text2); }
    .cert-foot {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }
    .cert-firma { text-align: center; }
    .cert-firma-line { width: 150px; height: 1px; background: #c8c0d4; margin: 0 auto 7px; }
    .cert-firma-name { font-size: 0.74rem; color: var(--text); font-weight: 600; }
    .cert-firma-role { font-size: 0.64rem; color: var(--text3); margin-top: 1px; }
    .cert-sello {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        border: 2px solid var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cert-sello svg { width: 28px; height: 28px; }
    .cert-qr { text-align: center; }
    .cert-qr-box {
        width: 58px;
        height: 58px;
        background: var(--surface2);
        border: 1px solid var(--surface3);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 5px;
    }
    .cert-qr-box svg { width: 30px; height: 30px; }
    .cert-qr-label { font-size: 0.62rem; color: var(--text3); }

    .cons-locked-tag {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(192, 57, 43, 0.08);
        border: 1px solid rgba(192, 57, 43, 0.2);
        color: var(--red);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 8px 15px;
        border-radius: var(--radius-sm);
    }
    .cons-locked-tag svg { width: 16px; height: 16px; }

    .cons-progress-panel {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        padding: 1.5rem 1.7rem;
        margin-bottom: 1.5rem;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }
    .cons-pp-head {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 1.1rem;
    }
    .cons-pp-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(116, 20, 132, 0.08);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .cons-pp-icon svg { width: 22px; height: 22px; }
    .cons-pp-title { font-family: var(--font-display); font-size: 0.98rem; font-weight: 600; color: var(--text); }
    .cons-pp-sub { font-size: 0.8rem; color: var(--text3); margin-top: 2px; }
    .cons-pp-pct {
        margin-left: auto;
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }
    .cons-pp-track {
        height: 8px;
        background: var(--surface3);
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 1.3rem;
    }
    .cons-pp-fill {
        height: 100%;
        border-radius: 5px;
        background: linear-gradient(90deg, var(--primary), var(--pink));
        transition: width 0.6s ease;
    }
    .cons-pp-list {
        list-style: none;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.7rem 1.4rem;
    }
    .cons-pp-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.84rem;
        color: var(--text2);
    }
    .cons-pp-check {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 1.5px solid #d2cae0;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: all 0.2s;
    }
    .cons-pp-check svg { width: 12px; height: 12px; }
    .cons-pp-list li.done { color: var(--text); font-weight: 500; }
    .cons-pp-list li.done .cons-pp-check {
        background: var(--green);
        border-color: var(--green);
    }

    .cert-shell {
        position: relative;
        max-width: 720px;
        margin: 0 auto;
    }
    .cert-shell.cert-locked .certificate {
        filter: blur(7px) grayscale(0.4);
        opacity: 0.65;
        transform: scale(0.99);
        pointer-events: none;
        user-select: none;
    }
    .cert-lock-overlay {
        position: absolute;
        inset: 0;
        z-index: 5;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    .cert-lock-badge {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: rgba(13, 10, 18, 0.82);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        margin-bottom: 0.9rem;
        box-shadow: 0 12px 36px rgba(13, 10, 18, 0.4);
    }
    .cert-lock-badge svg { width: 34px; height: 34px; }
    .cert-lock-text {
        font-family: var(--font-display);
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text);
        background: rgba(255, 255, 255, 0.9);
        padding: 4px 16px;
        border-radius: 20px;
    }
    .cert-lock-sub {
        font-size: 0.82rem;
        color: var(--text2);
        background: rgba(255, 255, 255, 0.85);
        padding: 3px 12px;
        border-radius: 16px;
    }

    @media (max-width: 600px) {
        .cons-pp-list { grid-template-columns: 1fr; }
    }

    @media print {
        .sidebar, .topbar, .cons-bar, .cons-progress-panel, .cert-lock-overlay { display: none !important; }
        .main-content { overflow: visible; }
        .page-content { padding: 0; overflow: visible; }
        .cert-shell.cert-locked .certificate { filter: none; opacity: 1; transform: none; }
        .certificate { box-shadow: none; max-width: 100%; border: 1px solid #ddd; }
        body { background: #fff; }
    }
</style>

<?php include '../includes/footer.php'; ?>
