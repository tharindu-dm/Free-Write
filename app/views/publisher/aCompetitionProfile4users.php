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
            background-color:rgb(255, 215, 0, 0.05);
            border-radius: 1rem;
            border: var(--primary-color) 1px solid;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }

        .section-title {
            color: #ffbb00;
            border-bottom: 2px solid #ffbb00;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .prize-list {
            display: flex;
            justify-content: space-between;
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

        .premium-message {
            background-color: rgba(255, 215, 0, 0.1);
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            padding: 15px;
            margin: 20px auto;
            max-width: 80%;
            text-align: center;
        }

        .premium-message p {
            color: #333;
            font-weight: 500;
            margin-bottom: 15px;
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
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>
    
    <div class="header">
        <div class="container">
            <h1><?= htmlspecialchars($details['title']) ?></h1>
            <h2>A <?= htmlspecialchars($details['type']) ?> competition</h2>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
    
    <?php if (
        isset($_SESSION['user_type']) &&
        $_SESSION['user_type'] != 'writer' &&
        $details['type'] == 'writer' &&
        $_SESSION['user_type'] != 'wricov'  ): ?>
        <div class="premium-message">
            <p>Only writers can participate in competitions</p>
        </div>

    <?php elseif ($details['type'] == 'covdes' && $_SESSION['user_type'] != 'covdes' ): ?>
        
        <div class="premium-message">
            <p>Only Cover designers can participate in competitions</p>
        </div>

    <?php elseif (isset($competitionEntries) && $competitionEntries): ?>
        <div class="premium-message">
            <p>You have already submitted an entry for this competition</p>
        </div>

    <?php elseif (strtotime($data['details']['start_date']) > time()): ?>
        <div class="premium-message">
            <p>You can enter into the competition from <?= date('F j, Y', strtotime($data['details']['start_date'])) ?></p>
        </div>

    <?php else: ?>
        <a href="/Free-Write/public/Competition/Enter/<?= htmlspecialchars($data['details']['competitionID']) ?>"
           class="enter-btn">
            <button>Enter Competition</button>
        </a>
    <?php endif; ?>

<?php endif; ?>

        
    </div>

    </div>
    <div class="container">
        <div class="competition-image-container">
            <img src="/Free-Write/app/images/competition/<?= htmlspecialchars($details['compImage'] ?? 'coverComp.png') ?>"
                alt="Competition Image" class="competition-image">
        </div>



        <div class="card">
            <h3 class="section-title">Description</h3>
            <p><?= htmlspecialchars($details['description'] ?? '') ?></p>
        </div>

        <div class="card">
            <h3 class="section-title">Judging criteria</h3>
            <ul>
                <li><?= htmlspecialchars($details['rules']) ?></li>
            </ul>
        </div>

        <div class="card">
            <h3 class="section-title">Prizes</h3>
            <div class="prize-list">
                <div class="prize-item">
                    <h4>🥇 First Place</h4>
                    <p>$ <?= htmlspecialchars($details['first_prize'] ?? 0) ?></p>
                </div>
               <?php if ($details['type'] == 'writer'): ?>
                <div class="prize-item">
                    <h4>🥈 Second Place</h4>
                    <p>$ <?= htmlspecialchars($details['second_prize'] ?? 0) ?></p>
                </div>
                <div class="prize-item">
                    <h4>🥉 Third Place</h4>
                    <p>$ <?= htmlspecialchars($details['third_prize'] ?? 0) ?></p>
                </div>
                <?php endif; ?> 
            </div>
        </div>

        <div class="card">
            <h3 class="section-title">Submission Details</h3>
            <p><strong>Submission Deadline:</strong> <?= htmlspecialchars($details['end_date']) ?></p>
            <p><strong>Eligibility:</strong> Open to all writers</p>
        </div>

    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>