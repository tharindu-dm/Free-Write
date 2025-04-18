<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Free-Write</title>
    <style>
        main {
            margin-top: 1rem;
            margin-bottom: 1rem;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ffd700;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-height: fit-content;
        }

        h1 {
            color: #ffd700;
        }

        h2 {
            margin-top: 20px;
            color: #333;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="container">
            <h1>About Free-Write</h1>
            <p>Free-Write is a vibrant online community for readers, writers, and literary enthusiasts. Our platform
                enables
                users to track their reading journey, connect with fellow book lovers, and explore new genres and
                authors.
            </p>

            <h2>Our Mission</h2>
            <p>To create an inclusive space where readers can organize their reading life, discover new books, and
                engage
                with a community that shares their passion for literature.</p>

            <h2>Features</h2>
            <ul>
                <li>Personal reading dashboard to track books read, in progress, and planned</li>
                <li>Custom book collections and reading lists</li>
                <li>Genre-based exploration and recommendations</li>
                <li>Social networking with other readers</li>
                <li>Book progress tracking and statistics</li>
            </ul>

            <h2>Join Our Community</h2>
            <p>Whether you're an avid reader, an aspiring writer, or simply looking to organize your reading life,
                Free-Write provides the tools and community to enhance your literary journey.</p>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>