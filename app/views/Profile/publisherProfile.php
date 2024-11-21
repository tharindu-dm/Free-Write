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

        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 20px;
        }

        .banner {
            height: 200px;
            background-image: url('/image/blank.webp');
            background-size: cover;
            background-position: center;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            background-color: #F5F0E5;
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

        .edit-profile {
            background-color: #FFD052;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .edit-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #E0B94A;
        }

        .book-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .book-grid img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .add-books {
            background-color: #8C805E;
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;


            width: 60%;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .add-books:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #7A6F50;
        }

        .location,
        .contact {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 1rem;
            color: #1C160C;
        }

        .location p,
        .contact p {
            display: flex;
            align-items: center;
            color: #8C805E;
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

        <section class="profile">
            <img src="image/blank.webp" alt="Alice Smith" class="profile-picture">
            <div class="profile-info">
                <h1>Alice Smith</h1>
                <p>Sales Rep at Acme Inc</p>
                <button class="edit-profile">Edit Profile</button>
            </div>
        </section>

        <section class="library">
            <h2>Library</h2>
            <div class="book-grid">
                <a href="link1.html"><img src="image/blank.webp" alt="Book 1"></a>
                <a href="link2.html"><img src="image/blank.webp" alt="Book 2"></a>
                <a href="link3.html"><img src="image/blank.webp" alt="Book 3"></a>
                <a href="link4.html"><img src="image/blank.webp" alt="Book 4"></a>
                <a href="link5.html"><img src="image/blank.webp" alt="Book 5"></a>
            </div>

            <button class="add-books">Add Books to Library</button>
        </section>

        <section class="location">
            <h2>Location</h2>
            <p><img src="image/loc.png" alt="Location icon"> San Francisco, CA</p>
            <p>123 Main St</p>
        </section>

        <section class="contact">
            <h2>Contact</h2>
            <p><img src="image/phone.png" alt="Phone icon"> Phone</p>
            <p>(123) 456-7890</p>
        </section>
    </main>
</body>

</html>