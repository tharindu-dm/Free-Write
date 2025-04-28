<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Submission</title>
    <link rel="stylesheet" href="/Free-Write/public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f5e7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #5a5a33;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            color: #5a5a33;
        }

        input[type="text"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        input[readonly] {
            background-color: #f4f4f4;
            color: #888888;
            cursor: not-allowed;
        }

        button {
            background-color: #d4a017;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #b38e14;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #d4a017;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    
    ?>

    <div class="container">
        <h1>Create Submission</h1>
        <form action="/Free-Write/public/DesignerCompetition/submitCompetition" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="competitionID" value="<?= htmlspecialchars($competition['competitionID']) ?>">

            <input type="hidden" name="userID" value="<?= htmlspecialchars($userID) ?>">

            <label for="competitionName">Competition Name</label>
            <input type="text" id="competitionName" name="competitionName"
                value="<?= htmlspecialchars($competition['title']) ?>" readonly>

            <label for="userName">Your Name</label>
            <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($_SESSION['user_name']) ?>"
                readonly>

            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter Submission Title" required>

            <label for="content">Submission Content</label>
            <textarea id="content" name="content" rows="6" placeholder="Write your submission content here..."
                required></textarea>

            <label for="submissionImage">Upload Submission Image</label>
            <input type="file" id="submissionImage" name="submissionImage" accept="image/*" required>

            <button type="submit">Submit</button>
        </form>

        <div class="back-link">
            <a href="/Free-Write/public/Designer/MyCompetitions">Back to Competitions</a>
        </div>
    </div>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

</body>

</html>