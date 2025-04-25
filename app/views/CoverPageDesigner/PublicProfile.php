<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($designer['firstName'] . ' ' . $designer['lastName']) ?>'s Profile</title>
    <link rel="stylesheet" href="/Free-Write/public/css/PublicProfile.css">
    <style>
        /* Main Layout */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Designer Profile Section */
        .designer-profile {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            text-align: center;
        }

        .designer-profile img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 1rem;
            border: 3px solid #FFD700;
            object-fit: cover;
        }

        .designer-profile h1 {
            font-size: 2.5rem;
            color: #1C160C;
            margin-bottom: 1rem;
        }

        .designer-profile p {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .designer-profile a {
            color: #c47c15;
            text-decoration: none;
            transition: color 0.3s;
        }

        .designer-profile a:hover {
            color: #FFD052;
        }

        /* Follow/Unfollow Buttons */
        .designer-profile button {
            padding: 0.8rem 2rem;
            background-color: #FFD052;
            color: #1C160C;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 1rem;
        }

        .designer-profile button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #E0B94A;
        }

        /* Designs Section */
        .designer-designs {
            margin-bottom: 2rem;
        }

        .designer-designs h2, 
        .designer-collections h2 {
            font-size: 1.8rem;
            color: #1C160C;
            margin-bottom: 1.5rem;
        }

        .designs {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .design {
            background: #FFFFFF;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .design:hover {
            transform: translateY(-4px);
        }

        .design img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .design h3 {
            padding: 1rem;
            color: #c47c15;
            font-size: 1.1rem;
            text-align: center;
        }

        /* Collections Section */
        .collections {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .collection {
            background: #FFFFFF;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .collection:hover {
            transform: translateY(-4px);
        }

        .collection h3 {
            color: #1C160C;
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .collection p {
            color: #666;
            line-height: 1.4;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }

            .designs {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }

            .collections {
                grid-template-columns: 1fr;
            }

            .designer-profile h1 {
                font-size: 2rem;
            }

            .designer-profile img {
                width: 120px;
                height: 120px;
            }
        }

        /* Links */
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Error Messages */
        .designs p, 
        .collections p {
            text-align: center;
            color: #666;
            padding: 2rem;
            background: #f8f8f8;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php"; ?>

    <main>
        <section class="designer-profile">
            <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($designerDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="<?= htmlspecialchars($designerDetails['firstName'] . ' ' . $designerDetails['lastName']) ?>">
            <h1><?= htmlspecialchars($designerDetails['firstName'] . ' ' . $designerDetails['lastName']) ?></h1>
            <p><?= htmlspecialchars($designerDetails['bio'] ?? 'No bio available.') ?></p>
            <p>Contact: <a href="mailto:<?= htmlspecialchars($designer['email']) ?>"><?= htmlspecialchars($designer['email']) ?></a></p>
            <p>Followers: <?= htmlspecialchars($followersCount['followers']) ?></p>
            <p>Following: <?= htmlspecialchars($followersCount['following']) ?></p>
            
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $designer['userID']): ?>
                <?php if ($isFollowing): ?>
                    <form method="POST" action="/Free-Write/public/Designer/unfollow">
                        <input type="hidden" name="designerID" value="<?= htmlspecialchars($designer['userID']) ?>">
                        <button type="submit">Unfollow</button>
                    </form>
                <?php else: ?>
                    <form method="POST" action="/Free-Write/public/Designer/follow">
                    <input type="hidden" name="designerID" value="<?= htmlspecialchars($designer['userID']) ?>">
                        <button type="submit">Follow</button>
                    </form>
                <?php endif; ?> 
            <?php endif; ?>
        </section>

        <section class="designer-designs">
            <h2>Designs</h2>
            <div class="designs">
                <?php if (!empty($designs)): ?>
                    <?php foreach ($designs as $design): ?>
                        <div class="design">
                            <a href="/Free-Write/public/Designer/viewDesignForNonOwner/<?= htmlspecialchars($design['covID']) ?>">
                                <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($design['license']) ?>" alt="<?= htmlspecialchars($design['name']) ?>">
                                <h3><?= htmlspecialchars($design['name']) ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No designs found.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="designer-collections">
            <h2>Public Collections</h2>
            <div class="collections">
                <?php if (!empty($collections)): ?>
                    <?php foreach ($collections as $collection): ?>
                        <?php if ($collection['isPublic']): ?>
                            <div class="collection">
                                <a href="/Free-Write/public/Designer/showCollectionForUsers/<?= htmlspecialchars($collection['collectionID']) ?>">
                                    <img src="/Free-Write/app/images/coverDesign/<?= htmlspecialchars($collection['frontImage']) ?>" alt="<?= htmlspecialchars($collection['title']) ?>">
                                    <h3><?= htmlspecialchars($collection['title']) ?></h3>
                                    <p><?= htmlspecialchars($collection['description']) ?></p>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No public collections found.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>