<?php 
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$activeClass = function($path) use ($currentPath) {
    return str_contains($currentPath, $path) ? 'active' : '';
};
?>

<style>
/* Sidebar Navigation */
.side-nav {
    width: 250px;
    background-color: #ffffff;
    padding: 6rem 1.5rem 2rem; 
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
    position: fixed;
    top: 75px;
    left: 0;
    bottom: 60px;
    height: calc(100vh - 215px);
    border-right: 1px solid #eee;
    z-index: 50; /* Reduced z-index to stay below header */
    overflow-y: auto;
}

.side-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.side-nav ul li {
    margin-bottom: 1rem;
}

.side-nav ul li a {
    text-decoration: none;
    color: #666;
    font-size: 1rem;
    display: block;
    padding: 1rem 1.2rem;
    border-radius: 2rem;
    transition: all 0.3s ease;
    font-weight: 500;
    background-color: transparent;
}

.side-nav ul li a:hover {
    background-color: rgba(255, 215, 0, 0.1);
    color: #000;
    transform: translateX(5px);
}

.side-nav ul li a.active {
    background-color: #ffd700;
    color: #000;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(255, 215, 0, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    .side-nav {
        width: 100%;
        height: auto;
        position: relative;
        bottom: auto;
        padding: 1rem;
        margin: 1rem 0;
        min-height: auto;
    }

    .side-nav ul {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .side-nav ul li {
        margin: 0;
        flex: 1 1 auto;
    }

    .side-nav ul li a {
        text-align: center;
        padding: 0.8rem 1rem;
        font-size: 0.9rem;
    }

    .side-nav ul li a:hover {
        transform: translateY(-2px);
    }
}
</style>
</head>

<body>
    <aside class="side-nav">
        <ul>
            <li>
                <a href="/Free-Write/public/Designer/Dashboard" class="<?= $activeClass('/Designer/Dashboard') ?>">Dashboard</a>
            </li>
            <li>
                <a href="/Free-Write/public/DesignerCompetition/index" class="<?= $activeClass('/DesignerCompetition/index') ?>">Competitions</a>
            </li>
            <li>
                <a href="/Free-Write/public/Designer/New" class="<?= $activeClass('/Designer/New') ?>">Create New Design</a>
            </li>
        </ul>
    </aside>
</body>
