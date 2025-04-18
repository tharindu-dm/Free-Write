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
            <h2 class="feedback-title">Share Your Feedback</h2>
            <form class="feedback-form" action="/Free-Write/public/Home/SendFeedback" method="post">
                <div class="form-group">
                    <label for="feedback">Your Feedback</label>
                    <textarea id="feedback" name="feedback" placeholder="Share your thoughts on this story..." required
                        maxlength="500" minlength="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="recommend">Would you recommend this site?</label>
                    <select id="recommend" name="recommend" required>
                        <option value="">Select an option</option>
                        <option value="yes">Yes, definitely!</option>
                        <option value="maybe">Maybe, to certain readers</option>
                        <option value="no">No, I wouldn't recommend it</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contact">Can we contact you? (Optional)</label>
                    <input type="text" id="contact" name="contact" type="email" placeholder="Enter the email" maxlength="50">
                </div>

                <div class="btn-container">
                    <button type="submit" class="submit-btn">Submit Feedback</button>
                </div>
            </form>
        </div>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>