<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher User Profile</title>
    <style>
        .user-actions {
            display: flex;
            align-items: center;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            margin: 0 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .banner {
            height: 200px;
            background-image: url('/Free-Write/public/images/hero.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            background-color: #FFD70044;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            /* Adjust based on how many books you want per row */
            gap: 16px;
            /* Space between the book items */
        }

        .book-item {
            text-align: center;
            /* Center the text */
            background-color: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            border-radius: 1rem;
        }

        .book-item:hover {
            transform: translateY(-5px);
            background-color: #ffd700;
        }

        .book-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .book-title {
            margin-top: 8px;
            /* Space between image and title */
            font-size: 16px;
            /* Adjust font size */
            font-weight: bold;
            color: #333;
            /* Color for the title */
        }


        .add-books {
            background-color: #444;
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;


            width: 100%;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .add-books:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #000;
        }

        .publisher-profile-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .location,
        .contact {
            background-color: rgba(255, 215, 0, 0.05);
            border: #ffd700 solid 1px;
            border-radius: 1rem;
            padding: 2rem;
            margin-top: 2rem;
        }

        h2 {
            margin-bottom: 1rem;
            color: #444;
        }

        .location p,
        .contact p {
            display: flex;
            align-items: center;
            color: #333;
        }

        svg {
            max-width: 2rem;
            max-height: 2rem;
        }

        .location img,
        .contact img {
            width: 20px;
            margin-right: 10px;
        }

        @media (max-width: 768px) {

            .book-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <main>
        <div class="banner"></div>


        <section class="library">
            <h2>Library</h2>
            <!-- <div class="book-grid">
    <div class="book-item">
        <a href="/Free-Write/public/Publisher/BookDesign">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Book 1">
            <p class="book-title">Book 1</p>
        </a>
    </div>
    <div class="book-item">
        <a href="link2.html">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Book 2">
            <p class="book-title">Book 2</p>
        </a>
    </div>
    <div class="book-item">
        <a href="link3.html">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Book 3">
            <p class="book-title">Book 3</p>
        </a>
    </div>
    <div class="book-item">
        <a href="link4.html">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Book 4">
            <p class="book-title">Book 4</p>
        </a>
    </div>
    <div class="book-item">
        <a href="link5.html">
            <img src="/Free-Write/public/images/collectionThumb.jpeg" alt="Book 5">
            <p class="book-title">Book 5</p>
        </a>
    </div>
</div> -->

            <div class="book-grid">
                <?php if (!empty($data['bookDetails'])): ?>
                    <?php foreach (array_slice($data['bookDetails'], 0, 5) as $bookDetails): ?>
                        <div class="book-item">
                            <a href="/Free-Write/public/Publisher/bookProfile4Publishers/<?php echo $bookDetails['isbnID']; ?>">
                                <img src="/Free-Write/app/images/coverDesign/<?= !empty($bookDetails['coverImage']) ? htmlspecialchars($bookDetails['coverImage']) : 'sampleCover.jpg' ?>"
                                    alt="<?= htmlspecialchars($bookDetails['title']) ?>">
                                <p class="book-title"><?php echo htmlspecialchars($bookDetails['title'] ?? ''); ?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No books available.</p>
                <?php endif; ?>
            </div>



            <div class="publisher-profile-btn">
            <a href="/Free-Write/public/Publisher/bookList/<?php echo htmlspecialchars($publisher['pubID'] ?? ''); ?>"><button class="add-books">View Books Library</button></a>
                <a href="/Free-Write/public/Publisher/AddBook
                "><button class="add-books">Add Books To Library</button></a>
                <a href="/Free-Write/public/Competition/MyCompetitions"><button class="add-books">Manage My
                        Competitions</button></a>
                <!-- <a href="/Free-Write/public/Publisher/courier"><button class="add-books">Manage My Couriers</button></a> -->
            </div>
        </section>

        <section class="location">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <h2>Location</h2>
            <p><?php echo htmlspecialchars($publisher['hqAddress'] ?? ''); ?></p>

        </section>

        <section class="contact">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            </svg>
            <h2>Contact</h2>
            <p>Phone</p>
            <p><?php echo htmlspecialchars($publisher['contactNo'] ?? ''); ?></p>
        </section>
    </main>
</body>

</html>