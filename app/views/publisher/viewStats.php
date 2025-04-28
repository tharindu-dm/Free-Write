<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sales Insights for The Art of War">
    <title>The Art of War - Sales Insights</title>
    <style>
        /* Winners Section and Related Styles (First Set, Takes Precedence) */
        .winners-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .winners-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            margin-top: 20px;
        }

        .winner-card {
            position: relative;
            width: 280px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .first-place {
            background-color: #fff9e6;
            border: 2px solid #ffd700;
        }

        .second-place {
            background-color: #f5f5f5;
            border: 2px solid #c0c0c0;
        }

        .third-place {
            background-color: #fff0e6;
            border: 2px solid #cd7f32;
        }

        .winner-badge {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }

        .first-place .winner-badge {
            background-color: #ffd700;
            color: #333;
        }

        .second-place .winner-badge {
            background-color: #c0c0c0;
            color: #333;
        }

        .third-place .winner-badge {
            background-color: #cd7f32;
            color: white;
        }

        .winner-details {
            margin-top: 15px;
        }

        .entry-title {
            font-style: italic;
            margin-bottom: 10px;
        }

        .prize-info {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ccc;
        }

        .prize-label {
            font-weight: bold;
        }

        .not-announced {
            color: #888;
            font-style: italic;
        }

        /* Dropdown Menu Styling */
        .winner-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .winner-select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .winner-select:disabled {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }

        /* Error state for duplicate selections */
        .winner-select.error {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        /* Button Styling */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #0056b3;
            transform: translateY(-1px);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
            opacity: 0.6;
        }

        /* Center button below winners-container */
        .winners-section .btn {
            display: block;
            margin: 20px auto 0;
        }

        /* Non-Conflicting Styles from Second Set */
        main {
            padding: 2rem;
            position: relative;
        }

        .breadcrumb {
            margin-bottom: 1rem;
        }

        .breadcrumb a {
            color: #c47c15;
            text-decoration: none;
        }

        .chart-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .download-btn {
            padding: 0.75rem 1.5rem;
            background-color: #FFD052;
            color: #1C160C;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #E0B94A;
        }

        .download-all-container {
            position: fixed;
            bottom: 80px;
            right: 2rem;
            z-index: 1000;
        }

        .download-all-btn {
            padding: 1rem 2rem;
            background-color: #1C160C;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .download-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            background-color: #2D261C;
        }

        .chart-title {
            font-size: 1.2rem;
            color: #1C160C;
            font-weight: 500;
        }

        .chart {
            width: 100%;
            height: 200px;
            background-color: #FCFAF5;
            border-radius: 8px;
            border: 2px solid #FFD700;
            margin-bottom: 1rem;
            position: relative;
            overflow: hidden;
        }

        .chart svg {
            width: 100%;
            height: 100%;
        }

        .line {
            fill: none;
            stroke: #FFD052;
            stroke-width: 2;
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            color: #c47c15;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #1C160C;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 1.5rem;
            background-color: #FFFFFF;
            color: #c47c15;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        .icon {
            width: 16px;
            height: 16px;
        }

        .stats-container {
            max-width: 1200px;
            width: 90%;
            margin: 1rem auto;
            padding: 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #FFFFFF;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border: 2px solid #FFD700;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            color: #1C160C;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: #FFD052;
        }

        .competition-entries {
            margin-top: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
        }

        .competition-entries h2 {
            margin-top: 0;
            margin-bottom: 1rem;
            color: #333;
        }

        .entries-table {
            width: 100%;
            border-collapse: collapse;
        }

        .entries-table th,
        .entries-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .entries-table th {
            background-color: #f5f5f5;
            font-weight: 600;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-submitted {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .status-reviewed {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-rejected {
            background-color: #ffebee;
            color: #c62828;
        }

        .status-pending {
            background-color: #fff8e1;
            color: #f57f17;
        }

        .view-btn {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: #FFD052;
            color: #1C160C;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .view-btn:hover {
            background-color: #E5BB4A;
        }

        .no-entries {
            padding: 2rem;
            text-align: center;
            color: #666;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .reviewed-btn {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background-color: #E5BB4A;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .reviewed-btn:hover {
            background-color: #d4a939;
        }


        /* Media Queries from Second Set */
        @media (max-width: 768px) {
            .chart-container {
                margin: 1rem;
                padding: 1rem;
            }

            .chart-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .stats-container {
                width: 95%;
                padding: 0.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .download-btn {
                width: 100%;
                justify-content: center;
            }

            .download-all-container {
                position: fixed;
                bottom: 80px;
                right: 1rem;
                left: 1rem;
            }

            .download-all-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>
        <div class="breadcrumb">
            <a href="/Free-Write/public/Competition/Profile/<?= htmlspecialchars($compID ?? '') ?>">Back to
                competition</a>
            <span> / <?= htmlspecialchars($competition['title'] ?? 'Competition Statistics') ?></span>
        </div>

        <div class="stats-container">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Participant Count</h3>
                    <div class="number">
                        <?= htmlspecialchars($competition['participants']) ?>
                    </div>
                </div>
                <div class="stat-card">
                    <h3>Status</h3>
                    <div class="number">
                        <?= htmlspecialchars($competition['status']) ?>
                    </div>
                </div>
                <?php if (strtolower($competition['status']) == 'active'): ?>
                    <div class="stat-card">
                        <h3>Days Remaining</h3>
                        <div class="number">
                            <?php
                            $endDate = new DateTime($competition['end_date']);
                            $today = new DateTime();
                            $daysLeft = $today->diff($endDate)->days;
                            echo htmlspecialchars($daysLeft > 0 ? $daysLeft : 0);
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="winners-section">
            <h2>Competition Winners</h2>
            <form method="post" action="/Free-Write/public/Competition/AnnounceWinners" id="winners-form">
            <div class="winners-container">
                <!-- First Place -->
                <div class="winner-card first-place">
                    <div class="winner-badge">1st Place</div>
                    <div class="winner-details">
                        <?php if (isset($competition['first_place_winner'])): ?>
                            <h3><?php echo htmlspecialchars($competition['first_place_winner_name'] ?? 'Not Announced Yet'); ?>
                            </h3>
                            <p class="entry-title">
                                <?php echo htmlspecialchars($competition['first_place_entry_title'] ?? ''); ?>
                            </p>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">$<?php echo htmlspecialchars($competition['first_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php else: ?>
                            <p class="not-announced">Select first winner</p>
                            <input type="hidden" name="winners[first][competition_id]"
                                value="<?php echo htmlspecialchars($competition['competitionID'] ?? ''); ?>">
                            <input type="hidden" name="winners[first][place]" value="first">
                            <select name="winners[first][entry_id]" class="winner-select" id="first-place-select">
                                <option value="">-- Select Entry --</option>
                                <?php if (isset($entryData) && !empty($entryData)): ?>
                                    <?php foreach ($entryData as $entry): ?>
                                        <option value="<?php echo htmlspecialchars($entry['entryID']); ?>">
                                            <?php echo htmlspecialchars($entry['bookTitle']); ?> by
                                            <?php echo htmlspecialchars($entry['participantName']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option disabled>No entries available</option>
                                <?php endif; ?>
                            </select>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">$<?php echo htmlspecialchars($competition['first_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Second Place -->
                <div class="winner-card second-place">
                    <div class="winner-badge">2nd Place</div>
                    <div class="winner-details">
                        <?php if (isset($competition['second_place_winner'])): ?>
                            <h3><?php echo htmlspecialchars($competition['second_place_winner_name'] ?? 'Not Announced Yet'); ?>
                            </h3>
                            <p class="entry-title">
                                <?php echo htmlspecialchars($competition['second_place_entry_title'] ?? ''); ?>
                            </p>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">$<?php echo htmlspecialchars($competition['second_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php else: ?>
                            <p class="not-announced">Select second winner</p>
                            <input type="hidden" name="winners[second][competition_id]"
                                value="<?php echo htmlspecialchars($competition['competitionID'] ?? ''); ?>">
                            <input type="hidden" name="winners[second][place]" value="second">
                            <select name="winners[second][entry_id]" class="winner-select" id="second-place-select">
                                <option value="">-- Select Entry --</option>
                                <?php if (isset($entryData) && !empty($entryData)): ?>
                                    <?php foreach ($entryData as $entry): ?>
                                        <option value="<?php echo htmlspecialchars($entry['entryID']); ?>">
                                            <?php echo htmlspecialchars($entry['bookTitle']); ?> by
                                            <?php echo htmlspecialchars($entry['participantName']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option disabled>No entries available</option>
                                <?php endif; ?>
                            </select>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">LKR<?php echo htmlspecialchars($competition['second_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Third Place -->
                <div class="winner-card third-place">
                    <div class="winner-badge">3rd Place</div>
                    <div class="winner-details">
                        <?php if (isset($competition['third_place_winner'])): ?>
                            <h3><?php echo htmlspecialchars($competition['third_place_winner_name'] ?? 'Not Announced Yet'); ?>
                            </h3>
                            <p class="entry-title">
                                <?php echo htmlspecialchars($competition['third_place_entry_title'] ?? ''); ?>
                            </p>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">LKR<?php echo htmlspecialchars($competition['third_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php else: ?>
                            <p class="not-announced">Select third winner</p>
                            <input type="hidden" name="winners[third][competition_id]"
                                value="<?php echo htmlspecialchars($competition['competitionID'] ?? ''); ?>">
                            <input type="hidden" name="winners[third][place]" value="third">
                            <select name="winners[third][entry_id]" class="winner-select" id="third-place-select">
                                <option value="">-- Select Entry --</option>
                                <?php if (isset($entryData) && !empty($entryData)): ?>
                                    <?php foreach ($entryData as $entry): ?>
                                        <option value="<?php echo htmlspecialchars($entry['entryID']); ?>">
                                            <?php echo htmlspecialchars($entry['bookTitle']); ?> by
                                            <?php echo htmlspecialchars($entry['participantName']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option disabled>No entries available</option>
                                <?php endif; ?>
                            </select>
                            <div class="prize-info">
                                <span class="prize-label">Prize:</span>
                                <span
                                    class="prize-value">LKR<?php echo htmlspecialchars($competition['third_prize'] ?? 'N/A'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="announce-winners-btn" disabled>Announce Winners</button>
            <?php if ($competition['status'] === 'ended'): ?>
                <p class="announcement-message">You cant select winners before competition finish</p>
            <?php endif; ?>
            </form>
        </div>


        <div class="competition-entries">
            <h2>Competition Entries</h2>

            <?php if (!empty($entryData)): ?>
                <table class="entries-table">
                    <thead>
                        <tr>
                            <th>Participant</th>
                            <th>Book Title</th>
                            <th>Submission Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($entryData['participantID'])): ?>
                            <!-- Single entry display -->
                            <tr>
                                <td><?= htmlspecialchars($entryData['participantName'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($entryData['bookTitle'] ?? 'Unknown') ?></td>
                                <td><?= htmlspecialchars($entryData['submissionDate'] ?? 'N/A') ?></td>
                                <td>
                                    <span class="status-badge status-<?= strtolower($entryData['status'] ?? 'pending') ?>">
                                        <?= htmlspecialchars($entryData['status'] ?? 'Pending') ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($entryData['bookID'] ?? '') ?>"
                                        class="view-btn">View Book</a>
                                </td>
                                <td><button>Reviewed</button></td>
                            </tr>
                        <?php else: ?>
                            <!-- Multiple entries display -->
                            <?php foreach ($entryData as $entry): ?>
                                <tr>
                                    <td><?= htmlspecialchars($entry['participantName'] ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars($entry['bookTitle'] ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars($entry['submissionDate'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="status-badge status-<?= strtolower($entry['status'] ?? 'pending') ?>">
                                            <?= htmlspecialchars($entry['status'] ?? 'Pending') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/Free-Write/public/Book/Overview/<?= htmlspecialchars($entry['bookID'] ?? '') ?>"
                                            class="view-btn">View Book</a>
                                    </td>
                                    <?php if ($entry['status'] === 'submitted'): ?>
                                        <td>
                                            <a href="/Free-Write/public/Competition/updatestatus/<?= htmlspecialchars($entry['entryID']) ?>"
                                                class="reviewed-btn">
                                                ✅ Reviewed
                                            </a>
                                        </td>
                                    <?php endif; ?>


                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-entries">
                    <p>No entries have been submitted for this competition yet.</p>
                </div>
            <?php endif; ?>
        </div>



        <!-- <div class="download-all-container">
            <button class="download-all-btn">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Download All Statistics
            </button>
        </div> -->
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get dropdowns and button
            const firstSelect = document.getElementById('first-place-select');
            const secondSelect = document.getElementById('second-place-select');
            const thirdSelect = document.getElementById('third-place-select');
            const announceBtn = document.getElementById('announce-winners-btn');

            // Store all dropdowns for easy iteration
            const selects = [firstSelect, secondSelect, thirdSelect];

            // Function to validate selections and update button state
            function validateSelections() {
                // Reset error states
                selects.forEach(select => select.classList.remove('error'));

                // Get current values
                const values = selects.map(select => select.value);

                // Check for duplicates (ignore empty values)
                let hasDuplicate = false;
                for (let i = 0; i < values.length; i++) {
                    if (values[i] === '') continue; // Skip empty selections
                    for (let j = i + 1; j < values.length; j++) {
                        if (values[i] === values[j] && values[j] !== '') {
                            hasDuplicate = true;
                            selects[j].classList.add('error'); // Highlight duplicate
                            selects[j].value = ''; // Reset duplicate selection
                            alert('Cannot select the same entry for multiple places.');
                        }
                    }
                }

                // Check if all dropdowns have valid (non-empty) selections
                const allSelected = values.every(value => value !== '');
                const competitionStatus = '<?php echo strtolower($competition['status']); ?>';

                // Enable button only if all selections are made and no duplicates
                announceBtn.disabled = !allSelected || hasDuplicate || competitionStatus !== 'ended';

            }

            // Add change event listeners to each dropdown
            selects.forEach(select => {
                select.addEventListener('change', validateSelections);
            });

            // Run validation on page load (in case of pre-filled values)
            validateSelections();
        });

        // Add JavaScript for download functionality if needed
        document.querySelectorAll('.download-btn').forEach(button => {
            button.addEventListener('click', function () {
                const chartTitle = this.closest('.chart-header').querySelector('.chart-title').textContent;
                alert('Downloading ' + chartTitle + ' as PDF...');
                // Implement actual download functionality
            });
        });

        document.querySelector('.download-all-btn').addEventListener('click', function () {
            alert('Downloading all statistics...');
            // Implement actual download functionality
        });
    </script>
</body>

</html>