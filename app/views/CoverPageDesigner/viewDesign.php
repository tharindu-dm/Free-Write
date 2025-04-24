<!-- filepath: c:\xampp\htdocs\Free-Write\app\views\CoverPageDesigner\ViewCoverPage.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= htmlspecialchars($design['name']) ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/ViewCoverPage.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .cover-page-container {
            display: flex;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .cover-image img {
            max-width: 400px;
            border-radius: 8px;
        }

        .cover-details {
            margin-left: 30px;
            flex: 1;
        }

        .cover-details h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .cover-details .designer {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 20px;
        }

        .cover-details .price {
            font-size: 1.5rem;
            color: #28a745;
            margin-bottom: 10px;
        }

        .cover-details .status {
            font-size: 1rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        .cover-details .description {
            font-size: 1rem;
            color: #333;
            margin-bottom: 30px;
        }

        .cover-details .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .cover-details .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .cover-details .btn-secondary {
            background-color: #ffc107;
            color: #fff;
        }

        .rating-container {
            margin-top: 20px; /* Add spacing between the image and the rating section */
            text-align: center; /* Center-align the content */
            background-color: #f8f9fa; /* Light background for better visibility */
            padding: 15px; /* Add padding inside the container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for better separation */
        }

        .stars {
            display: flex;
            justify-content: center;
            gap: 5px;
            cursor: pointer;
        }

        .star {
            font-size: 2rem;
            color: #ccc;
            transition: color 0.2s;
        }

        .star:hover,
        .star:hover ~ .star {
            color: #ccc; /* Reset color for stars after the hovered one */
        }

        .star:hover,
        .star ~ .star:hover {
            color: #ff0; /* Highlight stars up to the hovered one */
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
        case 'inst':
            require_once "../app/views/layout/header-inst.php";
            break;
        default:
            require_once "../app/views/layout/header.php";
    }
    ?>

    <main>
        <div class="cover-page-container">
            <div class="cover-image">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
            </div>
           
            <div class="cover-details">
                <h1><?= htmlspecialchars($design['name']) ?></h1>
                <p class="designer">By <?= htmlspecialchars($designer['firstName'] . ' ' . $designer['lastName']) ?></p>
                <p class="uploadDate">Uploaded At : <?= date('M d, Y', strtotime($design['uploadDate']))?></p>
                <!-- <p class="status">In Stock</p> -->
                <p class="description"><?= htmlspecialchars($design['description']) ?></p>
            </div>
        </div>

        <div class='rating-container'>
        <h3 id="average-rating-<?= $design['covID'] ?>">Average Rating: <?= number_format($ratingData['averageRating'], 1) ?>/5</h3>
            <p>Total Rating: <?=$ratingData['totalUsers']?></p>

            <div class="stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="star" data-value="<?= $i ?>">&#9733;</span>
                <?php endfor; ?>
            </div>
                <input type="hidden" id="covID" value="<?= $design['covID'] ?>">
        </div>
    
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.star');
        const covID = document.getElementById('covID').value;

        let selectedRating = 0; // Store the selected rating

        // Highlight stars based on the hovered or selected rating
        const highlightStars = (rating) => {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.style.color = '#ff0'; // Highlight stars in yellow
                } else {
                    star.style.color = '#ccc'; // Reset unselected stars to gray
                }
            });
        };

        stars.forEach((star, index) => {
            // Highlight stars on hover
            star.addEventListener('mouseover', () => {
                highlightStars(index + 1);
            });

            // Reset stars to the selected rating on mouse out
            star.addEventListener('mouseout', () => {
                highlightStars(selectedRating);
            });

            // Set the selected rating on click
            star.addEventListener('click', () => {
                selectedRating = index + 1;

                // Send the rating to the backend
                fetch('/Free-Write/public/Designer/rateDesign', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ covID, rating: selectedRating })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the average rating dynamically
                        document.getElementById(`average-rating-${covID}`).textContent = 
                            `Average Rating: ${parseFloat(data.newAverageRating).toFixed(1)}/5`;
                        alert('Rating submitted successfully!');
                    } else {
                        alert('Failed to submit rating.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
</body>

</html>