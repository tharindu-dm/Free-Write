<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freewrite</title>
    <link rel="stylesheet" href="/Free-Write/public/css/writer.css">
</head>

<body>


    <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }

    //show($data);
    ?>
    <main>
        <div class="dashboard">
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image">
                <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>"
                alt="Profile Picture" class="user-profile-picture">
                </div>

                <?php if (!empty($userDetails) && is_array($userDetails)): ?>
                    <h2 style="color: var(--black);">
                        <?= htmlspecialchars($userDetails['firstName']) . " " . htmlspecialchars($userDetails['lastName']); ?>
                    </h2>
                    <div class="profile-info">
                        <p><strong><?= htmlspecialchars($followers['followers']) ?> Followers</strong></p>
                        <p><strong><?= htmlspecialchars((string) $views); ?> Views</strong></p>
                    </div>
                <?php else: ?>
                    <h2>User Name</h2>
                <?php endif; ?>
            </div>
            <!-- Navigation for Writer Options -->
            <?php require_once "../app/views/writer/writerNav.php"; ?>
            <section class="quotes-section">
                <h2>My Quotes</h2>

                <?php if (empty($quotas)): ?>
                    <div class="no-requests">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M2 4v16a2 2 0 0 0 2 2h16"/>
          <path d="M6 2h12a2 2 0 0 1 2 2v16"/>
          <path d="M6 8h12"/>
          </svg><br>
                        <h2>You haven't received any Quotations.</h2><br>
                    <a href="/Free-Write/public/Writer/RequestPublisher" class="edit-btn">Request a Publisher</a>
                    </div>
                 <?php else: ?>

                <a href="/Free-Write/public/Writer/RequestPublisher" class="button-new">Request a Publisher</a>

                <!-- Quotation List -->
                <ul class="quote-item">
                    <?php foreach ($quotas as $quota): ?>
                        <li>
                        <a href="/Free-Write/public/Writer/ViewQuota/<?php echo htmlspecialchars($quota['quotaID']);?>" class="quote-link">
                            <p>
                                <?php echo htmlspecialchars($quota['publisher']); ?>
                                <br>
                                <small>Last Edited: <strong><?php echo htmlspecialchars($quota['lastEditedDate']); ?>  </strong></small>
                            </p>
                        </a>
                            
                        </li>     
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </section>
        </div>

            
    </main>

     <!-- Footer Section -->
     <?php require_once "../app/views/layout/footer.php"; ?>

<script src="../public/js/home.js"></script>
</body>

</html>