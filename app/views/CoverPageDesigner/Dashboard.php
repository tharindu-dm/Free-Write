<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Cover Designer</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
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
        case 'mod':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>

    <main>
        <section class="user-profile">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Michael Thompson" class="profile-picture">
            <h1>Michael Thompson</h1>
            <p>250 followers</p>
        </section>

        <nav class="profile-nav">
            <a href="#" class="active">Your Designs</a>
            <a href="/Free-Write/public/Designer/Competition">Competitions</a>
        </nav>

        <section class="designs">

            <div class="designs-header">
                <h2>Your Designs</h2>
                <a href="/Free-Write/public/Designer/New"><button class="new-design-btn">+New</button></a>
            </div>
            <div class="design-grid">
                <div class="design-item">
                    <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Flying bird design">
                </div>
                <div class="design-item">
                    <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Forest landscape design">
                </div>
                <div class="design-item">
                    <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Misty forest design">
                </div>
                <div class="design-item">
                    <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Girl in moonlight design">
                </div>
                <div class="design-item">
                    <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Day after design">
                </div>
                <div class="pagination">
                    <button>&lt;</button>
                    <button>1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>&gt;</button>
                </div>
            </div>

        </section>
    </main>

    <script src="script.js"></script>
</body>

</html>