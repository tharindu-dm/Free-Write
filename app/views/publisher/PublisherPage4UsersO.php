<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers UI</title>
    <style>
        /* Publishers Section */
        .publishers-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .publishers-section h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #1C160C;
        }

        .publisher-search {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .publisher-search input {
            width: 300px;
            padding: 1rem;
            border: 2px solid #FFD700;
            border-radius: 8px;
            background-color: #FCFAF5;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .publisher-search input:focus {
            outline: none;
            border-color: #FFD052;
            box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
        }

        .publisher-search button {
            padding: 1rem 1.5rem;
            background-color: #FFD052;
            color: #1C160C;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .publisher-search button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #E0B94A;
        }

        .publisher-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .publisher {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .publisher:hover {
            transform: translateY(-4px);
        }

        .publisher-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .publisher-header img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 1rem;
            border: 2px solid #FFD700;
        }

        .publisher-header h2 {
            color: #1C160C;
            font-weight: 600;
        }

        .books {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }

        .book {
            text-align: center;
            transition: transform 0.2s;
        }

        .book:hover {
            transform: translateY(-4px);
        }

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

        .book img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .book p {
            margin-top: 1rem;
            font-weight: 500;
            color: #c47c15;
        }

        @media (max-width: 768px) {

            .publisher-search {
                flex-direction: column;
                gap: 1rem;
            }

            .publisher-search input {
                width: 100%;
            }

            .books {
                grid-template-columns: repeat(2, 1fr);
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

    <main>
        <section class="publishers-section">
            <h1>Publishers</h1>
            <div class="publisher-search">
                <input type="text" placeholder="Search publisher...">
                <a href="/Free-Write/public/Publisher/regPage"><button>New Publisher</button></a>
            </div>

            <div class="publisher-list">
                <!-- Publisher 1 -->
                <div class="publisher">
                    <div class="publisher-header">
                    <a href="/Free-Write/public/Publisher/Profile">
                        <img src="/api/placeholder/60/60" alt="Wendy Xu"></a>
                        <h2>Wendy Xu</h2>
                    </div>
                    <div class="books">
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 1"></a>
                            <p>Book 1</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 2"></a>
                            <p>Book 2</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 3"></a>
                            <p>Book 3</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 4"></a>
                            <p>Book 4</p>
                        </div>
                    </div>
                </div>

                <!-- Publisher 2 -->
                <div class="publisher">
                    <div class="publisher-header">
                        <img src="/Free-Write/public/images/profile-image.jpg" alt="The New Inquiry">
                        <h2>The New Inquiry</h2>
                    </div>
                    <div class="books">
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 1"></a>
                            <p>Book 1</p>
                        </div>
                        <div class="book">
                            <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 2"></a>
                            <p>Book 2</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 3"></a>
                            <p>Book 3</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 4"></a>
                            <p>Book 4</p>
                        </div>
                    </div>
                </div>

                <!-- Publisher 3 -->
                <div class="publisher">
                    <div class="publisher-header">
                        <img src="/Free-Write/public/images/profile-image.jpg" alt="Karl Ove Knausgård">
                        <h2>Karl Ove Knausgård</h2>
                    </div>
                    <div class="books">
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 1"></a>
                            <p>Book 1</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 2"></a>
                            <p>Book 2</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 3"></a>
                            <p>Book 3</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 4"></a>
                            <p>Book 4</p>
                        </div>
                    </div>
                </div>

                <!-- Publisher 4 -->
                <div class="publisher">
                    <div class="publisher-header">
                        <img src="/Free-Write/public/images/profile-image.jpg" alt="HarperCollins">
                        <h2>HarperCollins</h2>
                    </div>
                    <div class="books">
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 1"></a>
                            <p>Book 1</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 2"></a>
                            <p>Book 2</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 3"></a>
                            <p>Book 3</p>
                        </div>
                        <div class="book">
                        <a href="/Free-Write/public/Publisher/bookProfile"><img src="/api/placeholder/150/200" alt="Book 4"></a>
                            <p>Book 4</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    require_once "../app/views/layout/footer.php";
    ?>
</body>

</html>