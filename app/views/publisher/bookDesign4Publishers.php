<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookDesignForUsers</title>
    
    <style>
        body {
            background-color: #F5F0E5;
            font-family: Arial, sans-serif;
            
        }

        .book-container {
            display: flex;
            gap: 40px;
            margin-left: 10%;
            width: 80%;
        }

        .book-image {
            flex: 0 0 300px;
        }

        .book-image img {
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .book-info {
            flex: 1;
        }

        .Names {
            margin-bottom: 20px;
        }

        .Names p {
            color: gray;
        }

        .Names h4 {
            font-weight: normal;
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

        .rating-count {
            color: #6c757d;
            font-size: 14px;
        }

        .details {
            margin: 20px 0;
        }

        .details h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .column {
            flex: 1;
            padding: 10px;
        }

        .column p {
            color: #333;
        }

        .column p:first-of-type {
            color: #6c757d;
            font-weight: bold;
        }

        .resButton {
            background-color: #FFD052;
            padding: 15px 40px;
            font-size: 24px;
            font-weight: normal;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .resButton:hover {
            background-color: #e6bb49;
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
            <img src="/Free-Write/public/images/sampleCover.jpg" alt="The Art of War Book Cover">
        </div>
        <div class="book-info">
            <div class="Names">
                <h1>The Art of War</h1>
                <p>By Sun Tzu</p>

                <div class="price-rating">
                    <span class="price">$24.99</span>
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
                <p>Due back: 2023-10-23</p>

                <h3>Synopsis</h3>
                <h4>The Art of War is an ancient Chinese military treatise attributed to Sun Tzu, a military strategist, and philosopher. The text is composed of 13 chapters, each of which is devoted to one aspect of warfare. It is commonly known to be the definitive work on strategy and tactics.</h4>
            </div>
            <div class="details">
                <h3>Details</h3>
                <div class="row">
                    <div class="column">
                        <p><strong>Author</strong></p>
                        <p>Sun Tzu</p>
                    </div>
                    <div class="column">
                        <p><strong>Genre</strong></p>
                        <p>Non-fiction, Philosophy</p>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <p><strong>Publisher</strong></p>
                        <p>Penguin Classics</p>
                    </div>
                    <div class="column">
                        <p><strong>Published Date</strong></p>
                        <p>5th century BC</p>
                    </div>
                </div>
            </div>
            <button class="resButton">Reserve Book</button>
        </div>
    </div>
</body>

</html>