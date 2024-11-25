<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CompetitionProfile4user</title>
    <style>
        /* Hero Section */
        .hero {
            position: relative;
            height: 400px;
            background-image: url('/office-background.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .enter-btn {
            background-color: #FFD052;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
        }

        /* Prizes Section */
        .prizes {
            padding: 40px 20px;
        }

        .prizes h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .prize-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 40px;
        }

        .prize-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .prize-card span {
            font-size: 12px;
            color: #666;
        }

        .prize-card h3 {
            font-size: 32px;
            margin: 10px 0;
        }

        /* Timeline Section */
        .timeline {
            padding: 40px 20px;
            background-color: #f5f5f5;
        }

        .timeline h2 {
            margin-bottom: 20px;
        }

        .user-actions {
            display: flex;
            align-items: center;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            margin: 0 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .timeline-item {
            margin-bottom: 15px;
        }

        .timeline-item h4 {
            margin-bottom: 5px;
        }

        .timeline-item p {
            color: #666;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 1rem;
            }

            .nav-container {
                margin: 1rem 0 0 0;
            }

            nav {
                gap: 1rem;
            }
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <div class="hero">
        <div class="hero-content">
            <h1>CodeChamp's Most Wanted</h1>
            <p>In this challenge, you'll build a tool that helps us track down coding bugs. The top 3 tools will win a
                total of $15,000 USD.</p>
            <a href="/Free-Write/public/Competition/ViewStats" class="enter-btn">View Stats</a>
        </div>
    </div>

    <section class="prizes">
        <h2>Prizes</h2>
        <div class="prize-cards">
            <div class="prize-card">
                <span>1st Place</span>
                <h3>$7,500</h3>
                <span>USD</span>
            </div>
            <div class="prize-card">
                <span>2nd Place</span>
                <h3>$4,500</h3>
                <span>USD</span>
            </div>
            <div class="prize-card">
                <span>3rd Place</span>
                <h3>$3,000</h3>
                <span>USD</span>
            </div>
        </div>
    </section>

    <section class="timeline">
        <h2>Competition Timeline</h2>
        <div class="timeline-item">
            <h4>Registration Opens</h4>
            <p>June 20, 2023</p>
        </div>
        <div class="timeline-item">
            <h4>Submission Deadline</h4>
            <p>July 20, 2023</p>
        </div>
        <div class="timeline-item">
            <h4>Winner Announcement</h4>
            <p>August 20, 2023</p>
        </div>
    </section>
</body>

</html>