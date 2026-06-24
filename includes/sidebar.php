<?php
$u = usuarioActual();
$pageActive = $pageActive ?? '';

require_once __DIR__ . '/progreso.php';
$progresoReal = progresoPorcentaje();

$nav = [
    'General' => [
        ['key' => 'inicio',        'label' => 'Inicio',        'href' => '/dashboard/dashboard.php',    'icon' => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
        ['key' => 'presentacion',  'label' => 'Presentación',  'href' => '/cursos/presentacion.php',    'icon' => '<rect x="5" y="2" width="14" height="20" rx="2"/><line x1="9" y1="7" x2="15" y2="7"/><line x1="9" y1="11" x2="15" y2="11"/><line x1="9" y1="15" x2="13" y2="15"/>'],
        ['key' => 'objetivos',     'label' => 'Objetivo',      'href' => '/cursos/objetivos.php',       'icon' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>'],
        ['key' => 'temario',       'label' => 'Temario',       'href' => '/cursos/temario.php',         'icon' => '<line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>'],
    ],
    'Contenido' => [
        ['key' => 'modulo1', 'label' => 'Módulo I. Conceptos clave',   'href' => '/modulos/modulo_1.php', 'icon' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>'],
        ['key' => 'modulo2', 'label' => 'Módulo II. Sistema político',  'href' => '/modulos/modulo_2.php', 'icon' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>'],
        ['key' => 'modulo3', 'label' => 'Módulo III. Elecciones',       'href' => '/modulos/modulo_3.php', 'icon' => '<path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>'],
    ],
    'Evaluación' => [
        ['key' => 'evaluacion',     'label' => 'Evaluación Final', 'href' => '/cursos/evaluacion-intro.php?id=final',     'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/>'],
        ['key' => 'calificaciones', 'label' => 'Calificaciones',   'href' => '/cursos/calificaciones.php', 'icon' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>'],
        ['key' => 'constancia',     'label' => 'Constancia',       'href' => '/cursos/constancia.php',     'icon' => '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/>'],
        ['key' => 'perfil',         'label' => 'Mi Perfil',        'href' => '/cursos/perfil.php',         'icon' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
    ],
];
?>
<aside class="sidebar">
    <div class="sb-header">
        <div class="sb-brand">
            <div class="sb-logo">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="18" rx="2"/>
                    <path d="M8 3v18"/>
                    <path d="M16 9l-4 4-4-4"/>
                </svg>
            </div>
            <div class="sb-info">
                <div class="sb-title">ABC de la Función Electoral</div>
                <div class="sb-subtitle">AprendIEEQ &middot; IEEQ</div>
            </div>
        </div>
        <div class="sb-progress">
            <div class="sb-prog-label">
                <span>Progreso del curso</span>
                <strong><?= $progresoReal ?>%</strong>
            </div>
            <div class="sb-prog-track">
                <div class="sb-prog-fill" style="width:<?= $progresoReal ?>%"></div>
            </div>
        </div>
    </div>

    <div class="sb-user">
        <div class="sb-avatar"><?= htmlspecialchars(iniciales($u['nombre'])) ?></div>
        <div class="sb-user-info">
            <div class="sb-user-name"><?= htmlspecialchars($u['nombre']) ?></div>
            <div class="sb-user-email"><?= htmlspecialchars($u['email']) ?></div>
        </div>
    </div>

    <nav class="sb-nav">
        <?php foreach ($nav as $seccion => $items): ?>
            <span class="sb-section"><?= htmlspecialchars($seccion) ?></span>
            <?php foreach ($items as $item): ?>
                <a href="<?= $item['href'] ?>" class="sb-item <?= $pageActive === $item['key'] ? 'active' : '' ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><?= $item['icon'] ?></svg>
                    <span><?= htmlspecialchars($item['label']) ?></span>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </nav>

    <div class="sb-footer">
        <a href="/auth/logout.php" class="sb-logout" onclick="return confirm('¿Deseas cerrar sesión?')">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Cerrar sesión
        </a>
    </div>
</aside>
