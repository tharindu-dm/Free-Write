<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
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
    //show( $data);
    ?>

    <main class="create-collection">
        <section class="writing-section">
            <div class="title-container">
                <h1 class="main-title">Create A Collection</h1>
                <p class="subtitle">Your Own Book Album (share with everyone)</p>
            </div>
            <div class="form-container">
                
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php
    // Including the footer
    require_once "../app/views/layout/footer.php";
    ?>


</body>

</html>