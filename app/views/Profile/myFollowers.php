<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/Free-Write/public/css/myFollowers.css">
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <main>

    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

    <script>
        
        document.querySelectorAll(".user-nav-button").forEach((button) => {
            button.addEventListener("click", () => {
                
                document
                    .querySelectorAll(".user-nav-button")
                    .forEach((btn) => btn.classList.remove("active"));
                document
                    .querySelectorAll(".view-section")
                    .forEach((section) => section.classList.remove("active"));

                
                button.classList.add("active");
                document.getElementById(button.dataset.view).classList.add("active");
            });
        });
    </script>
</body>

</html>