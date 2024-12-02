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
            gap: 20px;
            margin-bottom: 20px;
        }

        .book-grid img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            <div class="book-grid">
                <a href="link1.html"><img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 1"></a>
                <a href="link2.html"><img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 2"></a>
                <a href="link3.html"><img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 3"></a>
                <a href="link4.html"><img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 4"></a>
                <a href="link5.html"><img src="/Free-Write/app/images/coverDesign/sampleCover.jpg" alt="Book 5"></a>
            </div>
            <div class="publisher-profile-btn">
                <a hSpinoffNameref="#"><button class="add-books">Add Books To Library</button></a>
                <a href="/Free-Write/public/Competition/MyCompetitions"><button class="add-books">Manage My
                        Competitions</button></a>
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
            <p>San Francisco, CA</p>
            <p>123 Main St</p>
        </section>

        <section class="contact">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
            </svg>
            <h2>Contact</h2>
            <p>Phone</p>
            <p>(123) 456-7890</p>
        </section>
    </main>
</body>

</html>