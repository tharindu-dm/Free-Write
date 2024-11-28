<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storytellers' Challenge - CodeChamp's Most Wanted</title>
    <style>
        :root {
            --primary-color: #FFD700;
            --secondary-color: #FFD700;
            --text-color: #333;
            --background-color: #F4F7F6;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            background-color: #FFD70055;
            color: #000;
            text-align: center;
            padding: 40px 0;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header h2 {
            font-size: 1.25rem;
            font-weight: 300;
        }

        .enter-btn {
            background-color: #000;
            color: var(--primary-color);
            padding: 1rem;
            border-radius: 1rem;
        }

        .enter-btn button {
            background-color: #000;
            color: var(--primary-color);
            padding: 1rem;
            border-radius: 1rem;
            border: none;
            cursor: pointer;
            margin-top: 2rem;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .prize-list {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .prize-item {
            text-align: center;
            padding: 15px;
            background-color: #F9F9F9;
            border-radius: 8px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: var(--primary-color);
            color: white;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .prize-list {
                flex-direction: column;
            }

            .prize-item {
                margin-bottom: 10px;
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
    <div class="header">
        <div class="container">
            <h1>Storytellers' Challenge</h1>
            <h2>CodeChamp's Most Wanted</h2>
        </div>
        <a href="#" class="enter-btn"><button>Enter Competition</button></a>
    </div>

    <div class="container">
        <div class="card">
            <p>Join us in this exciting competition where writers will craft captivating stories centered around the
                theme of "CodeChamp's Most Wanted." Unleash your creativity and imagination as you delve into the world
                of coding, technology, and adventure!</p>
        </div>

        <div class="card">
            <h3 class="section-title">Challenge Details</h3>
            <ul>
                <li>Write an original story that explores the journey of a coder on a quest to uncover hidden bugs in a
                    mysterious program.</li>
                <li>Your story can be in any genre: thriller, sci-fi, fantasy, or even a romantic comedy!</li>
            </ul>
        </div>

        <div class="card">
            <h3 class="section-title">Prizes</h3>
            <div class="prize-list">
                <div class="prize-item">
                    <h4>🥇 First Place</h4>
                    <p>$5,000 USD</p>
                </div>
                <div class="prize-item">
                    <h4>🥈 Second Place</h4>
                    <p>$3,000 USD</p>
                </div>
                <div class="prize-item">
                    <h4>🥉 Third Place</h4>
                    <p>$2,000 USD</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="section-title">Judging Criteria</h3>
            <ul>
                <li>Creativity and Originality (40%)</li>
                <li>Writing Style and Voice (30%)</li>
                <li>Engagement and Emotional Impact (20%)</li>
                <li>Adherence to Theme (10%)</li>
            </ul>
        </div>

        <div class="card">
            <h3 class="section-title">Submission Details</h3>
            <p><strong>Submission Deadline:</strong> August 15, 2024</p>
            <p><strong>Eligibility:</strong> Open to all writers, ages 13 and older.</p>
        </div>
    </div>

    <div class="footer">
        <p>Get ready to write your story and join the adventure of a lifetime!</p>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>