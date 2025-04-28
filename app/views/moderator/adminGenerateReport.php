<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statistics Report | Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/adminGenerateReport.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data)
    ?>

    <main>
        <div class="report-container">
            <div class="report-header">
                <h1>Freewrite Platform Statistics Report</h1>
                <div class="date-range">Report Period: <span id="start-date"><?= $data['startDate'] ?></span> to <span
                        id="end-date"><?= $data['endDate'] ?> UTC Time</span></div>
                <button id="download-pdf" class="download-btn">Download as PDF</button>
            </div>

            <div class="stats-grid">
                <!-- Users Statistics Section -->
                <div class="stats-card">
                    <h2>User Statistics</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Users</div>
                        <div class="stat-value" id="total-users"><?= $userTypeCounts[0]['totalUsers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Readers</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['readers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Writers</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['writers'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Cover Designers</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['covdes'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Premium Users</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['premium'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Courier Users</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['courier'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Publishers</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['pubs'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Institutes</div>
                        <div class="stat-value"><?= $userTypeCounts[0]['inst'] ?></div>
                    </div>
                </div>

                <!-- Content Creation Section -->
                <div class="stats-card">
                    <h2>Content Creation</h2>
                    <div class="stat-item">
                        <div class="stat-label">Books Created</div>
                        <div class="stat-value"><?= $data['booksCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Spinoffs Created</div>
                        <div class="stat-value"><?= $data['spinoffsCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Covers Created</div>
                        <div class="stat-value"><?= $data['coversCreated'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Competitions Created</div>
                        <div class="stat-value"><?= $data['competitionsCreated'] ?></div>
                    </div>
                </div>

                <!-- Engagement Statistics Section -->
                <div class="stats-card">
                    <h2>Engagement Statistics</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Book Views (All Time)</div>
                        <div class="stat-value highlight-value"><?= $totalViewDetails['TotalViews'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Average Views per Book</div>
                        <div class="stat-value"><?= round($totalViewDetails['AverageViewsPerBook'], 3) ?></div>
                    </div>
                </div>

                <!-- Feedback & Reports Section -->
                <div class="stats-card">
                    <h2>Feedback & Reports</h2>
                    <div class="stat-item">
                        <div class="stat-label">Total Feedback Received</div>
                        <div class="stat-value"><?= $data['feedbackCount'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Reports</div>
                        <div class="stat-value"><?= $data['totalReports'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Handled Reports</div>
                        <div class="stat-value"><?= $data['handledReports'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Escalated Reports</div>
                        <div class="stat-value"><?= $data['escalatedReports'] ?></div>
                    </div>
                </div>

                <!-- Sales Data Section -->
                <div class="stats-card">
                    <h2>Revenue Summary</h2>
                    <div class="stat-item">
                        <div class="stat-label">Book Sales Revenue</div>
                        <div class="stat-value">LKR. <?= $data['totalBookSales'] ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Chapter Sales Revenue</div>
                        <div class="stat-value">LKR. <?= $data['totalChapterSales'] ?></div>
                    </div>
                    <?php foreach ($totalSubs as $subscription): ?>
                        <div class="stat-item">
                            <div class="stat-label"><?= $subscription['planName'] ?> Revenue</div>
                            <div class="stat-value">LKR. <?= $subscription['totalPaid'] ?></div>
                        </div>
                    <?php endforeach; ?>
                    <div class="stat-item total-row">
                        <div class="stat-label">Total Revenue</div>
                        <div class="stat-value highlight-value">LKR.
                            <?php
                            $total = $data['totalBookSales'] + $data['totalChapterSales'];
                            foreach ($totalSubs as $subscription) {
                                $total += $subscription['totalPaid'];
                            }
                            echo '' . $total . '';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="disclaimer">
                This report was generated on <span id="generation-date"><?= $data['today'] ?></span>.
                All statistics are based on the selected date range unless otherwise noted.
            </div>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function () {
            // Hiding the download button before printing
            this.style.display = 'none';

            // Set print title
            document.title = 'Freewrite Statistics Report - ' + document.getElementById('generation-date').textContent;

            // Print the document
            window.print();

            // Show the button again after printing dialog is closed
            setTimeout(() => {
                this.style.display = 'inline-block';
            }, 1000);
        });
    </script>
</body>

</html>