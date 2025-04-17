<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookDesignForUsers</title>

    <style>
        /* Reset and base styles */
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
            height: 650px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

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
        .resButton,
        .buyButton {
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

            .resButton,
            .buyButton {
                width: 100%;
                margin: 8px 0;
            }
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <div class="book-container">
        <div class="book-image">
            <img src="/Free-Write/app/images/coverDesign/<?= !empty($bookDetails['coverImage']) ? htmlspecialchars($bookDetails['coverImage']) : 'sampleCover.jpg' ?>"
                alt="<?= htmlspecialchars($bookDetails['title']) ?>">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="The Art of War Book Cover">
        </div>
        <div class="book-info">
            <div class="Names">
                <h1><?= htmlspecialchars($bookDetails['title']) ?></h1>
                <p>By <?= htmlspecialchars($bookDetails['author_name']) ?></p>

                <div class="price-rating">
                    <span class="price">$<?= htmlspecialchars($bookDetails['prize']) ?></span>
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
                <h4><?= htmlspecialchars($bookDetails['synopsis']) ?></h4>
            </div>
            <div class="details">
                <h3>Details</h3>
                <div class="row">
                    <div class="column">
                        <p><strong>Author</strong></p>
                        <p><?= htmlspecialchars($bookDetails['author_name']) ?></p>
                    </div>
                    <div class="column">
                        <p><strong>Genre</strong></p>
                        <p><?= htmlspecialchars($bookDetails['genre']) ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <p><strong>Contributor</strong></p>
                        <p><?= empty($bookDetails['contributor_name']) ? 'No contributors' : htmlspecialchars($bookDetails['contributor_name']) ?>
                        </p>

                    </div>
                    <div class="column">
                        <p><strong>Published Date</strong></p>
                        <p><?= htmlspecialchars($bookDetails['publication_year']) ?></p>
                    </div>
                </div>
                <div class="quantity-selector" style="margin-bottom: 20px;">
                    <label for="quantity"><strong>Quantity:</strong></label>
                    <select name="quantity" id="quantity"
                        style="padding: 8px; margin-left: 10px; border-radius: 8px; border: 1px solid #ddd;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

            </div>
            <button class="resButton">Add to WishList</button>
            <a href="/Free-Write/public/Publisher/paymentPage/<?= htmlspecialchars($bookDetails['isbnID']) ?>">
                <?php if ($_SESSION['user_type'] !== 'pub'): ?>
                    <button class="buyButton"
                        onclick="window.location.href=this.parentElement.href + '?quantity=' + document.getElementById('quantity').value; return false;">Buy
                        Now</button>
                <?php endif; ?>
            </a>


        </div>
    </div>
    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>