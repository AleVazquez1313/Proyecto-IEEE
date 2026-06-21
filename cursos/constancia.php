<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
requireLogin();

$pageTitle  = 'Constancia';
$pageActive = 'constancia';

$u = usuarioActual();
$nombreUsuario = $u['nombre'];
$nombreCurso   = 'ABC de la Función Electoral';
$fecha = '09 de mayo de 2026';
$folio = 'IEEQ-2026-' . str_pad((string) ($u['id'] ?? 1), 5, '0', STR_PAD_LEFT);

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
                    <button onclick="window.print()" class="btn btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Descargar PDF
                    </button>
                </div>

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

    @media print {
        .sidebar, .topbar, .cons-bar { display: none !important; }
        .main-content { overflow: visible; }
        .page-content { padding: 0; overflow: visible; }
        .certificate { box-shadow: none; max-width: 100%; border: 1px solid #ddd; }
        body { background: #fff; }
    }
</style>

<?php include '../includes/footer.php'; ?>
