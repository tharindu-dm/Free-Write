
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Profile</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2rem;
            color: #333;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .actions button {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><?= htmlspecialchars($competitionName) ?></h1>
            <p><?= htmlspecialchars($competitionDescription) ?></p>
        </div>

        <div class="submission-details">
            <h2>Your Submission</h2>
            <p><strong>Title:</strong> <?= htmlspecialchars($submission['title']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($submission['description']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($submission['status']) ?></p>
            <img src="/Free-Write/app/images/DesignSubmissions/<?= htmlspecialchars($submission['name']) ?>" alt="Submission Image" style="max-width: 100%; height: auto;">
        </div>

        <div class="actions">
            <form action="/Free-Write/public/DesignerCompetition/editSubmission" method="GET">
                <input type="hidden" name="submissionID" value="<?= htmlspecialchars($submission['submissionID']) ?>">
                <button type="submit" class="edit-btn">Edit Submission</button>
            </form>

            <form action="/Free-Write/public/DesignerCompetition/deleteSubmission" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                <input type="hidden" name="submissionID" value="<?= htmlspecialchars($submission['submissionID']) ?>">
                <button type="submit" class="delete-btn">Delete Submission</button>
            </form>
        </div>
    </div>
</body>

</html>