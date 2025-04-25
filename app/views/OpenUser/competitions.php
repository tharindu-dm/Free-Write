<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Free-Write Competitions</title>

    <link rel="stylesheet" href="/Free-Write/public/css/writer_competitions.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <section>
            <div class="competitions-header">
                <h1>Writing Competitions
                    <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />
                </h1>
                <!-- <div class="filter-section">
                <select>
                    <option>All Genres</option>
                    <option>Fiction</option>
                    <option>Non-Fiction</option>
                    <option>Poetry</option>
                </select>
                <select>
                    <option>Sort by: Newest</option>
                    <option>Most Popular</option>
                    <option>Ending Soon</option>
                </select>
                 </div>-->
            </div>

            <div class="competitions-grid">
                <?php if (!empty($writer)): ?>

                    <?php foreach ($writer as $comp): ?>
                        <div class="competition-card">
                            <img src="/Free-Write/app/images/competition/<?= htmlspecialchars($comp['compImage'] ?? 'writerComp.png'); ?>"
                                alt="Competition Image">

                            <div class="competition-details">
                                <h2><?= htmlspecialchars($comp['title']) ?></h2>
                                <div class="publisher">By <?= htmlspecialchars($comp['creatorFullName']); ?></div>
                                <div class="deadline">
                                    <span class="deadline-badge"><?= htmlspecialchars($comp['end_date']) ?></span>
                                    <a href="/Free-Write/public/Competition/WriterCompetition?compID=<?= htmlspecialchars($comp['competitionID']) ?>"
                                        class="view-button">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No active competitions</p>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <div class="competitions-header">
                <h1>Cover Designer Competitions
                    <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700; " />
                </h1>

                <!-- <div class="filter-section">
                <select>
                    <option>All Genres</option>
                    <option>Fiction</option>
                    <option>Non-Fiction</option>
                    <option>Poetry</option>
                </select>
                <select>
                    <option>Sort by: Newest</option>
                    <option>Most Popular</option>
                    <option>Ending Soon</option>
                </select>
                   </div>-->
            </div>
            <div class="competitions-grid">
                <?php if (!empty($covdes)): ?>

                    <?php foreach ($covdes as $comp): ?>
                        <div class="competition-card">
                            <img src="/Free-Write/app/images/competition/<?= htmlspecialchars($comp['compImage'] ?? 'coverComp.png'); ?>"
                                alt="Competition Image">
                            <div class="competition-details">
                                <h2><?= htmlspecialchars($comp['title']) ?></h2>
                                <div class="publisher">By <?= htmlspecialchars($comp['creatorFullName']) ?></div>
                                <div class="deadline">
                                    <span class="deadline-badge"><?= htmlspecialchars($comp['end_date']) ?></span>
                                    <a href="/Free-Write/public/Competition/CoverCompetition?compID=<?= htmlspecialchars($comp['competitionID']) ?>"
                                        class="view-button">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No active competitions</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>