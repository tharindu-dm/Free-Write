<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookDesignForUsers</title>
    
    <style>/* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background-color: #F5F0E5;
    font-family: 'Inter', Arial, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    line-height: 1.6;
}

/* Container styles */
.book-container {
    display: flex;
    gap: 60px;
    max-width: 1400px;
    width: 90%;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

/* Book image styles */
.book-image {
    flex: 0 0 400px;
    position: sticky;
    top: 40px;
    align-self: flex-start;
}

.book-image img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
}

.book-image img:hover {
    transform: scale(1.02);
}

/* Book info styles */
.book-info {
    flex: 1;
    max-width: 800px;
}

.Names h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 12px;
    line-height: 1.2;
}

.Names p {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 24px;
}

/* Price and rating section */
.price-rating {
    display: flex;
    align-items: center;
    gap: 32px;
    margin: 32px 0;
    padding: 20px;
    background-color: #f8fafc;
    border-radius: 12px;
}

.price {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
}

.rating {
    display: flex;
    align-items: center;
    gap: 12px;
}

.stars {
    color: #FFD052;
    font-size: 1.2rem;
}

.rating-count {
    color: #64748b;
    font-size: 0.95rem;
}

/* Availability badge */
.availability-badge {
    display: inline-block;
    background-color: #22c55e;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    margin: 16px 0;
}

/* Details section */
.details {
    margin: 40px 0;
    background-color: #f8fafc;
    padding: 24px;
    border-radius: 12px;
}

.details h3 {
    font-size: 1.5rem;
    color: #1e293b;
    margin-bottom: 24px;
}

.row {
    display: flex;
    gap: 40px;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e2e8f0;
}

.row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.column {
    flex: 1;
}

.column p {
    color: #475569;
}

.column p:first-of-type {
    color: #64748b;
    font-size: 0.95rem;
    margin-bottom: 8px;
}

/* Button styles */
.resButton, .buyButton {
    padding: 16px 48px;
    font-size: 1.1rem;
    font-weight: 600;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 16px;
}

.resButton {
    background-color: #FFD052;
    color: #1e293b;
}

.resButton:hover {
    background-color: #ffc529;
    transform: translateY(-2px);
}

.buyButton {
    background-color: #8C805E;
    color: white;
}

.buyButton:hover {
    background-color: #7A6F50;
    transform: translateY(-2px);
}

/* Responsive design */
@media (max-width: 1200px) {
    .book-container {
        width: 95%;
        gap: 40px;
    }
    
    .book-image {
        flex: 0 0 350px;
    }
}

@media (max-width: 900px) {
    .book-container {
        flex-direction: column;
        padding: 20px;
    }
    
    .book-image {
        flex: none;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        position: static;
    }
    
    .Names h1 {
        font-size: 2rem;
    }
    
    .price-rating {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
}

@media (max-width: 600px) {
    .book-container {
        width: 100%;
        border-radius: 0;
        margin: 0;
    }
    
    .row {
        flex-direction: column;
        gap: 16px;
    }
    
    .resButton, .buyButton {
        width: 100%;
        margin: 8px 0;
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
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="The Art of War Book Cover">
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
            <button class="resButton">Add to WishList</button>
            <button class="buyButton">Buy Now</button>
        </div>
    </div>
    <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>