<?php
//profile of user. reader, writer and covdes. check userType and display the profile accordingly 
//for example, if only reader, display only the reader profile and add a button to upgrade to writer or covdes
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/profile.css">
</head>

<body>
    <?php
    require_once "../app/views/layout/header-reader.php";
    ?>

    <main>
        <section class="profile-container">
            <div class="profile-header">
                <div class="profile-image">
                    <img src="../../public/images/profile-image.jpg" alt="User Profile Image">
                </div>
                <div class="profile-info">
                    <h1>@cloudedwithstories</h1>
                    <p>Joined Dec 11, 2020</p>
                    <p>~ Writer ~</p>
                </div>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <h2>FreeWrite Creator <span class="verified">✓</span></h2>
                    <p>My FreeWee Award-winning novel, Creatures of the Night, is now published! Pick it up at your local
                        book store or at the links below.</p>
                    <div class="book-list">
                        <div class="book-item">
                            <h3>BOOKS:</h3>
                            <ul>
                                <li>
                                    <span class="book-title">Creatures of the Night</span>
                                    <span class="book-status">published, paid, FreeWee Award Winner</span>
                                </li>
                                <li>
                                    <span class="book-title">Shadows of the Night</span>
                                    <span class="book-status">book 2 draft, free</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="profile-section">
                    <h2>Profile Statistics</h2>
                    <div class="stats-container">
                        <div class="stat-item">
                            <h3>Reading</h3>
                            <p id="reading-count">15</p>
                        </div>
                        <div class="stat-item">
                            <h3>Completed</h3>
                            <p id="completed-count">11</p>
                        </div>
                        <div class="stat-item">
                            <h3>On-Hold</h3>
                            <p id="onhold-count">10</p>
                        </div>
                        <div class="stat-item">
                            <h3>Dropped</h3>
                            <p id="dropped-count">7</p>
                        </div>
                        <div class="stat-item">
                            <h3>Plan to Read</h3>
                            <p id="plan-to-read-count">12</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-actions">
                <button class="edit-profile-btn">Edit Profile</button>
                <button class="report-btn">Report</button>
            </div>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script src="\Free-Write\public\js\profile.js"></script>
</body>

</html>