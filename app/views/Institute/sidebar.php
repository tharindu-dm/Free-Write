<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$activeClass = function($path) use ($currentPath) {
    return str_contains($currentPath, $path) ? 'active' : '';
};
?>

<aside class="sidebar">
    <div class="institution-info">
        <div class="institution-icon"></div>
        <div>
            <h3><?= htmlspecialchars($instDetails['name'] ?? 'Institution Name') ?></h3>
        </div>
    </div>
    <nav class="menu">
        <div class="menu-item <?= $activeClass('/Institute/Dashboard') ?>">
            <a href="/Free-Write/public/Institute/Dashboard">Dashboard</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/Library') ?>">
            <a href="/Free-Write/public/Institute/Library">Library</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/PurchasePackage') ?>">
            <a href="/Free-Write/public/Institute/PurchasePackage">Packages</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/ManageUser') ?>">
            <a href="/Free-Write/public/Institute/ManageUser">User Management</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/Settings') ?>">
            <a href="/Free-Write/public/Institute/Setting">Settings</a>
        </div>
    </nav>
</aside>