<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Write - <?= htmlspecialchars($design['name']) ?></title>
    <link rel="stylesheet" href="/Free-Write/public/css/ViewCoverPage.css">
    <style>
        /* Enhanced Cover Page View Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .cover-page-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2.5rem;
            margin-bottom: 2rem;
            padding: 2rem;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .cover-image {
            flex: 0 0 350px;
        }

        .cover-image img {
            width: 100%;
            height: auto;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border: #ffd700 solid 1px;
            object-fit: cover;
        }

        .cover-details {
            flex: 1;
            min-width: 300px;
        }

        .cover-details h1 {
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .designer {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .designer:before {
            content: '👤';
            margin-right: 0.5rem;
        }

        .uploadDate {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1.5rem;
            display: inline-block;
            padding: 0.4rem 0.8rem;
            background: rgba(255, 215, 0, 0.1);
            border-radius: 0.3rem;
        }

        .price {
            font-size: 1.5rem;
            color: #28a745;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            background-color: #d4edda;
            color: #155724;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #444;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 0.5rem;
            border-left: 4px solid #ffd700;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            margin-right: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: rgba(0, 123, 255, 0.1);
            border: 1px solid #007bff;
            color: #007bff;
        }

        .btn-primary:hover {
            background: rgba(0, 123, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 215, 0, 0.1);
            border: #ffd700 solid 1px;
            color: #333;
        }

        .btn-secondary:hover {
            background: rgba(255, 215, 0, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.3);
        }

        .rating-container {
            margin-top: 2rem;
            text-align: center;
            background: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .rating-container h3 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .rating-container p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 1.5rem;
        }

        .stars {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            margin: 1rem 0;
        }

        .star {
            font-size: 2.5rem;
            color: #ccc;
            transition: color 0.3s;
            -webkit-text-stroke: 1px #ffd700;
        }

        .star:hover {
            color: #ffd700;
            transform: scale(1.1);
        }

        .rating-info {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .rating-info div {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 0.5rem;
            color: #333;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .cover-page-container {
                flex-direction: column;
            }

            .cover-image {
                margin: 0 auto;
            }

            .cover-details {
                text-align: center;
            }

            .description {
                text-align: left;
            }
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <div class="cover-page-container">
            <div class="cover-image">
                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>"
                    alt="<?= htmlspecialchars($design['name']) ?> cover design">
            </div>

            <div class="cover-details">
                <h1><?= htmlspecialchars($design['name']) ?></h1>
                <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700;" />

                <p class="designer">By <?= htmlspecialchars($designer['firstName'] . ' ' . $designer['lastName']) ?></p>
                <p class="uploadDate">Uploaded: <?= date('F j, Y', strtotime($design['uploadDate'])) ?></p>

                <hr style="margin: 1.5rem 0; border:0.1rem solid #ffd700; opacity: 0.5;" />

                <h3>Description:</h3>
                <p class="description"><?= htmlspecialchars($design['description']) ?></p>
            </div>
        </div>

        <div class="rating-container">
            <h3>Design Rating</h3>
            <hr style="margin-bottom: 1rem; border:0.1rem solid #ffd700;" />

            <div class="rating-info">
                <div id="average-rating-<?= $design['covID'] ?>">
                    <strong>Average Rating:</strong> <?= number_format($ratingData['averageRating'], 1) ?>/5.0
                </div>
                <div>
                    <strong>Total Ratings:</strong> <?= $ratingData['totalUsers'] ?>
                </div>
            </div>

            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $design['artist']): ?>
                <p>Rate this design:</p>
                <div class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?= $i ?>">&#9733;</span>
                    <?php endfor; ?>
                </div>
                <input type="hidden" id="covID" value="<?= $design['covID'] ?>">
                <p class="rating-note">Click on a star to submit your rating</p>
            <?php else: ?>
                <p>Log in to rate this design</p>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star');
            const covIDInput = document.getElementById('covID');
            if (!stars.length || !covIDInput) return; // Only run if stars exist

            const covID = covIDInput.value;
            let selectedRating = 0;

            const highlightStars = (rating) => {
                stars.forEach((star, index) => {
                    star.style.color = index < rating ? '#ffd700' : '#ccc';
                });
            };

            stars.forEach((star, index) => {
                star.addEventListener('mouseover', () => highlightStars(index + 1));
                star.addEventListener('mouseout', () => highlightStars(selectedRating));
                star.addEventListener('click', () => {
                    selectedRating = index + 1;
                    fetch('/Free-Write/public/Designer/rateDesign', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ covID, rating: selectedRating })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`average-rating-${covID}`).innerHTML =
                                    `<strong>Average Rating:</strong> ${parseFloat(data.newAverageRating).toFixed(1)}/5.0`;

                                // Add a success notification
                                const notification = document.createElement('div');
                                notification.textContent = 'Rating submitted successfully!';
                                notification.style.cssText = 'position:fixed; top:20px; right:20px; background:#d4edda; color:#155724; padding:1rem; border-radius:0.5rem; box-shadow:0 4px 10px rgba(0,0,0,0.2); z-index:1000;';
                                document.body.appendChild(notification);

                                // Remove notification after 3 seconds
                                setTimeout(() => {
                                    notification.style.opacity = '0';
                                    notification.style.transition = 'opacity 0.5s ease';
                                    setTimeout(() => notification.remove(), 500);
                                }, 3000);
                            } else {
                                alert('Failed to submit rating. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while submitting your rating.');
                        });
                });
            });
        });
    </script>
</body>

</html>