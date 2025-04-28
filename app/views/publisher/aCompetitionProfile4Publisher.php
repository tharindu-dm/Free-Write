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
            font-size: larger;
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

        .competition-image-container {
            margin: -30px auto 20px;
            max-width: 300px;
            text-align: center;
        }

        .competition-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid white;
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
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>
    
    <div class="header">
        <div class="container">
            <h1><?= htmlspecialchars($competitionDetails['title'] ?? 'Competition Details') ?></h1>
            <h2><?= htmlspecialchars($competitionDetails['category'] ?? '') ?></h2>


        </div>
        <a href="/Free-Write/public/Competition/ViewStats/<?= htmlspecialchars($competitionDetails['competitionID']) ?>"
            class="enter-btn"><button>View Stats</button></a>

    </div>

    <div class="container">
        <?php if (!empty($competitionDetails['compImage'])): ?>
            <div class="competition-image-container">
                <img src="/Free-Write/app/images/competition/<?= htmlspecialchars($competitionDetails['compImage']) ?>"
                    alt="Competition Image" class="competition-image">
            </div>
        <?php endif; ?>

        <div class="card">
            <h3 class="section-title">Description</h3>
            <p><?= htmlspecialchars($competitionDetails['description'] ?? '') ?></p>
        </div>

        <div class="card">
            <h3 class="section-title">Judging criteria</h3>
            <div><?= nl2br(htmlspecialchars($competitionDetails['rules'] ?? '')) ?></div>
        </div>

        <div class="card">
            <h3 class="section-title">Prizes</h3>
            <div class="prize-list">
                <div class="prize-item">
                    <h4>🥇 First Place</h4>
                    <p>$<?= number_format($competitionDetails['first_prize'] ?? 0, 2) ?> USD</p>
                </div>
                <div class="prize-item">
                    <h4>🥈 Second Place</h4>
                    <p>$<?= number_format($competitionDetails['second_prize'] ?? 0, 2) ?> USD</p>
                </div>
                <div class="prize-item">
                    <h4>🥉 Third Place</h4>
                    <p>$<?= number_format($competitionDetails['third_prize'] ?? 0, 2) ?> USD</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h3 class="section-title">Submission Details</h3>
            <p><strong>Submission Deadline:</strong>
                <?= date('F j, Y', strtotime($competitionDetails['end_date'] ?? 'now')) ?></p>
            <p><strong>Start Date:</strong> <?= date('F j, Y', strtotime($competitionDetails['start_date'] ?? 'now')) ?>
            </p>
            <p><strong>Status:</strong> <?= htmlspecialchars(ucfirst($competitionDetails['status'] ?? 'active')) ?></p>
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