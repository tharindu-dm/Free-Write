<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #F5F0E5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .book-container {
            display: flex;
            gap: 40px;
            margin: 20px auto;
            width: 80%;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .book-image {
            flex: 0 0 300px;
            position: relative;
        }

        .book-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* .image-edit-overlay {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.7);
            padding: 8px;
            border-radius: 4px;
            display: none;
        }

        .book-image:hover .image-edit-overlay {
            display: block;
        } */

        .book-info {
            flex: 1;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background-color: #FFD052;
            color: white;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .save-btn {
            background-color: #28a745;
            color: white;
            display: none;
        }

        .cancel-btn {
            background-color: #6c757d;
            color: white;
            display: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .Names h1 {
            margin: 0;
            color: #2c3e50;
        }

        .Names p {
            color: gray;
            margin: 5px 0;
        }

        .price-rating {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 20px 0;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            color: #FFD052;
        }

        .availability-badge {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin: 10px 0;
        }

        .details {
            margin: 20px 0;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .column {
            flex: 1;
            padding: 10px;
        }

        .column p {
            margin: 5px 0;
        }

        .editable {
            padding: 5px;
            border: 1px solid transparent;
        }

        .editing .editable {
            border: 1px solid #FFD052;
            border-radius: 4px;
        }

     /* Delete Overlay Container */
.deleteOverlay-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Delete Overlay Dialog */
.deleteOverlay {
    background-color: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 400px;
}

/* Heading */
.deleteOverlay h2 {
    color: #2c3e50;
    margin: 0 0 20px 0;
    font-size: 20px;
    text-align: center;
    font-family: Arial, sans-serif;
}

/* Form */
.deleteOverlay form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Labels */
.deleteOverlay label {
    display: block;
    font-weight: 500;
    color: gray;
    margin-bottom: 5px;
    font-size: 14px;
    font-family: Arial, sans-serif;
}

/* Inputs */
.deleteOverlay input[type="text"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #eee;
    border-radius: 4px;
    background-color: #F5F0E5;
    color: #2c3e50;
    font-size: 14px;
    font-family: Arial, sans-serif;
}

.deleteOverlay input[type="text"]:disabled {
    cursor: not-allowed;
    opacity: 0.7;
}

/* Buttons - matching your existing button styles */
.deleteOverlay button {
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    font-size: 14px;
    transition: all 0.3s ease;
    font-family: Arial, sans-serif;
}

#deleteCompetition_Agree {
    background-color: #dc3545;
    color: white;
    margin-top: 10px;
}

#deleteCompetition_Agree:hover {
    opacity: 0.9;
}

#cancelDelete {
    background-color: #6c757d;
    color: white;
    margin-top: 8px;
}

#cancelDelete:hover {
    opacity: 0.9;
}

/* Responsive Adjustments */
@media (max-width: 480px) {
    .deleteOverlay {
        width: 95%;
        padding: 20px;
        margin: 20px;
    }
    
    .deleteOverlay h2 {
        font-size: 18px;
    }
}
    </style>
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
    ?>
    <div class="book-container">
        <div class="book-image">
            <img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book Cover">
            <div class="image-edit-overlay">
                <button class="btn edit-btn">
                    <i class="fas fa-camera"></i> Change Image
                </button>
            </div>
        </div>

        <div class="book-info">
            <div class="header-actions">
                <div class="Names">
                    <h1 class="editable" contenteditable="false"><?= htmlspecialchars($bookDetails['title'] ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="editable" contenteditable="false">By <?= htmlspecialchars($bookDetails['author_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></p>
                </div>

                <div class="action-buttons">
                    <button class="btn edit-btn" onclick="toggleEditMode()">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn save-btn" onclick="saveChanges()">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <button class="btn cancel-btn" onclick="cancelEdit()">
                        <i class="fas fa-times"></i> Cancel
                    </button>

                    <button type="button" id="deletebookProfile" class="btn delete-btn">Delete</button>
                </div>
            </div>

            <div class="deleteOverlay-container">
                <div class="deleteOverlay">
                    <h2>Are you sure you want to delete this book?</h2>
                    <form action="/Free-Write/public/Publisher/deletebookProfile" method="POST">
                        <input type="hidden" name="isbnID" value="<?= htmlspecialchars($bookDetails['isbnID']) ?>">
                        <label for="compID-label">Book ID</label>
                        <input type="text" id="isbnID-label" disabled
                            value="<?= htmlspecialchars($bookDetails['isbnID']) ?>">
                        <label for="title">Book Name</label>
                        <input id="title" type="text" disabled value="<?= htmlspecialchars($bookDetails['title']) ?>">
                        <button type="submit" id="deleteCompetition_Agree">Yes, Delete</button>
                        <button id="cancelDelete">Cancel</button>
                    </form>
                </div>
            </div>

            <div class="price-rating">
                <span class="price editable" contenteditable="false"><?= htmlspecialchars($bookDetails['prize'] ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?></span>
                <div class="rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="rating-count">(4.5/5 - 2,345 reviews)</span>
                </div>
            </div>

            <div class="availability-badge">In Stock</div>

            <div class="synopsis">
                <h3>Synopsis</h3>
                <p class="editable" contenteditable="false">
                    <?= htmlspecialchars($bookDetails['synopsis'] ?? 'Untitled', ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>

            <div class="details">
                <h3>Details</h3>
                <div class="row">
                    <div class="column">
                        <p><strong>Author</strong></p>
                        <p class="editable" contenteditable="false">By <?= htmlspecialchars($bookDetails['author_name'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="column">
                        <p><strong>Genre</strong></p>
                        <p class="editable" contenteditable="false"><?= htmlspecialchars($bookDetails['genre'] ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <p><strong>Publisher</strong></p>
                        <p class="editable" contenteditable="false">Penguin Classics</p>
                    </div>
                    <div class="column">
                        <p><strong>Published Date</strong></p>
                        <p class="editable" contenteditable="false">5th century BC</p>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script>
        function toggleEditMode() {
            document.querySelector('.book-info').classList.add('editing');
            document.querySelectorAll('.editable').forEach(el => {
                el.contentEditable = true;
                el.style.backgroundColor = '#fff8e8';
            });
            document.querySelector('.edit-btn').style.display = 'none';
            document.querySelector('.save-btn').style.display = 'inline-block';
            document.querySelector('.cancel-btn').style.display = 'inline-block';
        }

        function saveChanges() {
            document.querySelector('.book-info').classList.remove('editing');
            document.querySelectorAll('.editable').forEach(el => {
                el.contentEditable = false;
                el.style.backgroundColor = 'transparent';
            });
            document.querySelector('.edit-btn').style.display = 'inline-block';
            document.querySelector('.save-btn').style.display = 'none';
            document.querySelector('.cancel-btn').style.display = 'none';

            // Here you would typically send the updated data to your server
            console.log('Changes saved!');
        }

        function cancelEdit() {
            document.querySelector('.book-info').classList.remove('editing');
            document.querySelectorAll('.editable').forEach(el => {
                el.contentEditable = false;
                el.style.backgroundColor = 'transparent';
                // Here you would typically revert to the original content
            });
            document.querySelector('.edit-btn').style.display = 'inline-block';
            document.querySelector('.save-btn').style.display = 'none';
            document.querySelector('.cancel-btn').style.display = 'none';
        }


        document.addEventListener("DOMContentLoaded", function() {
            const deleteCompBtn = document.getElementById("deletebookProfile");
            const cancelDeleteBtn = document.getElementById("cancelDelete");
            const deleteOverlay = document.querySelector(".deleteOverlay-container");

            if (deleteCompBtn && cancelDeleteBtn && deleteOverlay) {
                deleteCompBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    deleteOverlay.style.display = "flex";
                });

                cancelDeleteBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    deleteOverlay.style.display = "none";
                });
            } else {
                alert("One or more elements not found");
            }
        });
    </script>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>