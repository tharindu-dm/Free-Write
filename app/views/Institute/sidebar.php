<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$activeClass = function ($path) use ($currentPath) {
    return str_contains($currentPath, $path) ? 'active' : '';
};
?>

<style>
    .sidebar {
        width: 250px;
        background-color: #fff;
        min-height: 100vh;
        padding: 2rem 1rem;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
    }

    .institution-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid #ffd700;
    }

    .institution-icon {
        width: 50px;
        height: 50px;
        background-color: #ffd700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .institution-info h3 {
        color: #333;
        font-size: 1.2rem;
        font-weight: bold;
        margin: 0;
    }

    .menu {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .menu-item {
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-bottom: 0.5rem;
    }

    .menu-item a {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        color: #333;
        text-decoration: none;
        font-size: 1rem;
        font-weight: normal;
        background: none;
        transition: all 0.3s ease;
        border-radius: 8px;
    }

    .menu-item:hover {
        background-color: #fff3ad;
    }

    .menu-item.active {
        background-color: #ffd700;
    }

    .menu-item.active a {
        color: #000;
        font-weight: bold;
        background-color: #ffd700;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            min-height: auto;
            position: relative;
        }

        .institution-info {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<aside class="sidebar">
    <div class="institution-info">
        <div class="institution-icon"></div>
        <div>
            <h3><?= htmlspecialchars($_SESSION['user_name'] ?? 'Institution Name') ?></h3>
        </div>
    </div>
    <nav class="menu">
        <div class="menu-item <?= $activeClass('/Institute/Dashboard') ?>">
            <a href="/Free-Write/public/Institute/Dashboard">Dashboard</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/ManageUser') ?>">
            <a href="/Free-Write/public/Institute/ManageUser">User Management</a>
        </div>
        <div class="menu-item <?= $activeClass('/Institute/Setting') ?>">
            <a href="/Free-Write/public/Institute/Setting">Settings</a>
        </div>
    </nav>
</aside>