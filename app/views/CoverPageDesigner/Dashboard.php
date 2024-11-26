<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - Cover Designer</title>
    <link rel="stylesheet" href="/Free-Write/public/css/Dashboard.css">
</head>
<body>
    <header>
        <?php
    if (isset($_SESSION['user_type'])) {
        $userType = $_SESSION['user_type'];
    } else {
        $userType = 'guest';
    }
    switch ($userType) {
        case 'admin':
        case 'mod':
        case 'writer':
        case 'covdes':
        case 'wricov':
        case 'reader':
            require_once "../app/views/layout/header-user.php";
            break;
        case 'pub':
            require_once "../app/views/layout/header-pub.php";
            break;
        case 'inst':
            require_once "../app/views/layout/header-inst.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    //show($data);
    ?>
    </header>

    <main>
        <section class="user-profile">
            <img src="thompson.avif" alt="Michael Thompson" class="profile-picture">
            <h1>Michael Thompson</h1>
            <p>250 followers</p>
        </section>

        <nav class="profile-nav">
            <a href="#" class="active">Your Designs</a>
            <a href="#">Competitions</a>
        </nav>

        <section class="designs">

            <div class="designs-header">
                <h2>Your Designs</h2>
                <button class="new-design-btn">+New</button>
            </div>
            <div class="design-grid">
                <div class="design-item">
                    <img src="design1.jpeg" alt="Flying bird design">
                </div>
                <div class="design-item">
                    <img src="design2.jpg" alt="Forest landscape design">
                </div>
                <div class="design-item">
                    <img src="design3.webp" alt="Misty forest design">
                </div>
                <div class="design-item">
                    <img src="design4.webp" alt="Girl in moonlight design">
                </div>
                <div class="design-item">
                    <img src="design5.webp" alt="Day after design">
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