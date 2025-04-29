<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Collection</title>
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .main-content {
            background-color: rgb(255, 215, 0, 0.05);
            border-radius: 1rem;
            border: #ffd700 1px solid;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .main-content h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .main-content h2:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0.1rem;
            background-color: #ffd700;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        textarea,
        select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #ffd700;
            box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #ffd700;
            color: #333;
        }

        .btn-primary:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #f5f5f5;
            color: #333;
            border: 1px solid #ddd;
            margin-left: 1rem;
        }

        .btn-cancel:hover {
            background-color: #eaeaea;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .gold-divider {
            margin: 1.5rem 0;
            border: 0.1rem solid #ffd700;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main class="dashboard-container">
        <section class="main-content">
            <h2>Edit Collection</h2>
            <hr class="gold-divider">

            <form action="/Free-Write/public/DesignerCollection/updateCollection" method="POST">
                <input type="hidden" name="collectionID" value="<?= htmlspecialchars($collection['collectionID']) ?>">

                <div class="form-group">
                    <label for="collectionTitle">Title</label>
                    <input type="text" id="collectionTitle" name="collectionTitle" maxlength="100"
                        value="<?= htmlspecialchars($collection['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="collectionDescription">Description</label>
                    <textarea id="collectionDescription" name="collectionDescription"
                        maxlength="255"><?= htmlspecialchars($collection['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="collectionVisibility">Visibility</label>
                    <select id="collectionVisibility" name="collectionVisibility">
                        <option value="1" <?= $collection['isPublic'] ? 'selected' : '' ?>>Public</option>
                        <option value="0" <?= !$collection['isPublic'] ? 'selected' : '' ?>>Private</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="/Free-Write/public/DesignerCollection/dashboard" class="btn btn-cancel">Cancel</a>
                </div>
            </form>
        </section>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>