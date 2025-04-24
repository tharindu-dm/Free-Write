<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Joined Competitions</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer_competitions.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(247, 243, 193);
            color: #1C160C;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        /* Competitions Header */
        .competitions-header {
            margin-bottom: 1.5rem;
        }

        .competitions-header h1 {
            font-size: 2rem;
            color: #1C160C;
            margin-bottom: 0.5rem;
        }

        .competitions-header hr {
            border: 0.1rem solid #FFD700;
        }

        /* Joined Competitions Table */
        .joined-competitions-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
            background-color: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .joined-competitions-table th,
        .joined-competitions-table td {
            padding: 1rem;
            text-align: left;
        }

        .joined-competitions-table th {
            background-color: #FCFAF5;
            color: #1C160C;
            font-weight: 600;
            border-bottom: 2px solid #FFD700;
        }

        .joined-competitions-table td {
            border-bottom: 1px solid #FFD700;
        }

        .joined-competitions-table tr:last-child td {
            border-bottom: none;
        }

        .joined-competitions-table td a {
            color: #FFD700;
            text-decoration: none;
            font-weight: 500;
            margin-right: 0.5rem;
            transition: color 0.3s;
        }

        .joined-competitions-table td a:hover {
            color: #1C160C;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons a {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            color: #FFFFFF;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .view-button {
            background-color: #FFD700;
            color: #1C160C;
        }

        .edit-button {
            background-color: #007BFF;
        }

        .delete-button {
            background-color: #DC3545;
        }

        .view-button:hover,
        .edit-button:hover,
        .delete-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <?php
      require_once "../app/views/CoverPageDesigner/sidebar.php";
    ?>

    <main>
        <!-- User Joined Competitions -->
        <section>
            <div class="competitions-header">
                <h1>Your Joined Competitions</h1>
                <hr style="margin-bottom: 1rem; border: 0.1rem solid #ffd700;" />
            </div>

            <?php if (!empty($joinedCompetitions)): ?>
                <table class="joined-competitions-table">
                    <thead>
                        <tr>
                            <th>Competition Name</th>
                            <th>Submission Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($joinedCompetitions as $comp): ?>
                            <tr>
                                <td><?= htmlspecialchars($comp['competitionName']) ?></td>
                                <td><?= htmlspecialchars($comp['submissionTitle']) ?></td>
                                <td><?= htmlspecialchars($comp['status']) ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/Free-Write/public/DesignerCompetition/viewCompetitionAfterSubmission/<?= htmlspecialchars($comp['submissionID']) ?>" class="view-button">View</a>
                                        <a href="/Free-Write/public/DesignerCompetition/editSubmission/<?= htmlspecialchars($comp['submissionID']) ?>" class="edit-button">Edit</a>
                                        <a href="/Free-Write/public/DesignerCompetition/deleteSubmission/<?= htmlspecialchars($comp['submissionID']) ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this submission?');">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have not joined any competitions yet.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>