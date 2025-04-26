<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        Stat Report | Freewrite
    </title>
    <link rel="stylesheet" href="/Free-Write/public/css/adminGenerateReport.css">
</head>

<body>

    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <main>
        <div class="report-container">
            <div class="report-header">
                <h1>Statistics Report</h1>
                <div class="date-range">From <span id="start-date"><?= $data['startDate'] ?></span> to <span
                        id="end-date"><?= $data['endDate'] ?></span></div>
            </div>

            <div class="stats-grid">
                <!-- Users Card -->
                <div class="stats-card">
                    <h2> Life Time User Statistics</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Users</div>
                        <div class="stat-value" id="total-users"><?= $userTypeCounts[0]['totalUsers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Reader</div>
                        <div class="stat-value" id="free-users"><?= $userTypeCounts[0]['readers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Writers</div>
                        <div class="stat-value" id="free-users"><?= $userTypeCounts[0]['writers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Cover Designers</div>
                        <div class="stat-value" id="free-users"><?= $userTypeCounts[0]['covdes'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Premium Users</div>
                        <div class="stat-value" id="premium-users"><?= $userTypeCounts[0]['premium'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Courier Users</div>
                        <div class="stat-value" id="courier-users"><?= $userTypeCounts[0]['courier'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Publishers</div>
                        <div class="stat-value" id="pub-users"><?= $userTypeCounts[0]['pubs'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Institutes</div>
                        <div class="stat-value" id="inst-users"><?= $userTypeCounts[0]['inst'] ?></div>
                    </div>
                </div>

                <!-- Feedback & Reports Card -->
                <div class="stats-card">
                    <h2>Feedback & Reports</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Feedback Received</div>
                        <div class="stat-value" id="feedback-count"><?= $data['feedbackCount'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Reports</div>
                        <div class="stat-value" id="total-reports"><?= $data['totalReports'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Handled Reports</div>
                        <div class="stat-value" id="handled-reports"><?= $data['handledReports'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Escalated Reports</div>
                        <div class="stat-value" id="escalated-reports"><?= $data['escalatedReports'] ?></div>
                    </div>
                </div>

                <!-- Sales Card -->
                <div class="stats-card">
                    <h2>Sales Data</h2>
                    <div class="stat-item">
                        <div class="stat-label">Book Sales Revenue</div>
                        <div class="stat-value" id="book-sales">LKR. <?= $data['totalBookSales'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Chapter Sales Revenue</div>
                        <div class="stat-value" id="chapter-sales">LKR. <?= $data['totalChapterSales'] ?></div>
                    </div>
                    <div class="stat-item total-row">
                        <div class="stat-label">Total Revenue</div>
                        <div class="stat-value highlight-value" id="total-sales">LKR.
                            <?= ($data['totalBookSales'] + $data['totalChapterSales']) ?>
                        </div>
                    </div>
                </div>

                <!-- Content Creation Card -->
                <div class="stats-card">
                    <h2>Content Creation</h2>
                    <div class="stat-item">
                        <div class="stat-label">Books Created</div>
                        <div class="stat-value" id="books-created"><?= $data['booksCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Spinoffs Created</div>
                        <div class="stat-value" id="spinoffs-created"><?= $data['spinoffsCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Covers Created</div>
                        <div class="stat-value" id="covers-created"><?= $data['coversCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Competitions Created</div>
                        <div class="stat-value" id="competitions-created"><?= $data['competitionsCreated'] ?></div>
                    </div>
                </div>

                <!-- Views Card -->
                <div class="stats-card">
                    <h2>Life Time Impressions</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Book Views (All Time)</div>
                        <div class="stat-value highlight-value" id="total-views"><?= $totalViewDetails['TotalViews']?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Average Views per Book</div>
                        <div class="stat-value" id="avg-views"><?= $totalViewDetails['AverageViewsPerBook']?></div>
                    </div>
                </div>
            </div>

            <div class="disclaimer">
                This report was generated on <span id="generation-date"><?= $data['today'] ?></span>. All statistics are
                based on
                the selected date range unless otherwise noted.
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>


</body>

</html>