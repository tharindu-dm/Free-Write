<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Free-Write</title>
    <link rel="stylesheet" href="/Free-Write/public/css/feedback.css">
</head>

<body>

    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="feedback-container">
            <h2 class="feedback-title">Book Report: <span id="bookTitle"><?= htmlspecialchars("$bookTitle") ?></span>
            </h2>
            <form class="feedback-form" action="/Free-Write/public/Book/SendReport/" method="post">
                <div class="form-group">
                    <label for="report">Issue:</label>
                    <textarea id="report" name="report" placeholder="Write your report about this book..." required
                        maxlength="600" minlength="10"></textarea>
                </div>

                <div class="btn-container">
                    <button type="submit" class="submit-btn">Submit Report</button>
                </div>
            </form>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>