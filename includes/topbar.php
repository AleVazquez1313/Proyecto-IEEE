<?php
$breadcrumb = $breadcrumb ?? [];
?>
<div class="topbar">
    <div class="topbar-bc">
        <?php foreach ($breadcrumb as $i => $crumb): ?>
            <?php if ($i > 0): ?><span class="sep">/</span><?php endif; ?>
            <?php if (!empty($crumb['href']) && $i < count($breadcrumb) - 1): ?>
                <a href="<?= $crumb['href'] ?>"><?= htmlspecialchars($crumb['label']) ?></a>
            <?php else: ?>
                <span class="bc-current"><?= htmlspecialchars($crumb['label']) ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="topbar-actions">
        <button class="topbar-btn" title="Notificaciones">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </button>
        <button class="topbar-btn" title="Ayuda">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </button>
    </div>
</div>
