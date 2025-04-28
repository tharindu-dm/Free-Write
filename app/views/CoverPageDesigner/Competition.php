<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Designer Competitions</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main class="dashboard-container">
        <?php require_once "../app/views/CoverPageDesigner/sidebar.php"; ?>

        <section class="main-content">
            <!-- profile section -->
            <section class="user-profile">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                    alt="Profile Picture" class="profile-picture">
                <h1><?= htmlspecialchars($userDetails['firstName'] ?? 'Designer Name') . ' ' . htmlspecialchars($userDetails['lastName'] ?? '') ?></h1>
                <p><?= htmlspecialchars($userDetails['followers'] ?? '0') ?> followers</p>
            </section>

            <nav class="profile-nav">
                <a href="/Free-Write/public/Designer/Dashboard">Your Designs</a>
                <a href="#" class="active">Competitions</a>
            </nav>

            <!-- Competition Content Section -->
            <section class="competitions">
                <div class="competitions-header">
                    <h2>Your Joined Competitions</h2>
                    <hr />
                </div>

                <?php if (!empty($joinedCompetitions)): ?>
                    <div class="joined-competitions-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Competition Name</th>
                                    <th>Submission Title</th>
                                    <th>Status</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($joinedCompetitions as $comp): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($comp['competitionName']) ?></td>
                                        <td><?= htmlspecialchars($comp['submissionTitle']) ?></td>
                                        <td><?= htmlspecialchars($comp['status']) ?></td>
                                        <td>
                                            <div class="competition-actions">
                                                <a href="/Free-Write/public/DesignerCompetition/editSubmission/<?= htmlspecialchars($comp['submissionID']) ?>" 
                                                   class="edit-button">Edit</a>
                                                <a href="/Free-Write/public/DesignerCompetition/deleteSubmission/<?= htmlspecialchars($comp['submissionID']) ?>" 
                                                   class="delete-button" 
                                                   onclick="return confirm('Are you sure you want to delete this submission?');">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p>You have not joined any competitions yet.</p>
                <?php endif; ?>
            </section>
        </section>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>
</html>