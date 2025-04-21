<!-- filepath: c:\xampp\htdocs\Free-Write\app\views\CoverPageDesigner\editSubmissionForm.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Submission</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(247, 243, 193);
            color: #1C160C;
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #1C160C;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #1C160C;
        }

        input,
        textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 2px solid #FFD700;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            background-color: #FCFAF5;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #FFD052;
            box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        button {
            padding: 1rem 1.5rem;
            margin-right: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .submit-btn {
            background-color: #FFD052;
            color: #1C160C;
        }

        .submit-btn:hover {
            background-color: #E0B94A;
        }

        .cancel-btn {
            background-color: #c47c15;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #7A6F50;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <h1>Edit Submission</h1>
        <form action="/Free-Write/public/DesignerCompetition/updateSubmission/<?= htmlspecialchars($submission['submissionID']) ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($submission['title']) ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($submission['description']) ?></textarea>

            <label for="submissionImage">Update Image (optional):</label>
            <input type="file" id="submissionImage" name="submissionImage" accept="image/*">

            <button type="submit" class="submit-btn">Update Submission</button>
            <button type="button" class="cancel-btn" onclick="location.href='/Free-Write/public/DesignerCompetition/index'">Cancel</button>
        </form>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>