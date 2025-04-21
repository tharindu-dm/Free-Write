<!-- filepath: c:\xampp\htdocs\Free-Write\app\views\CoverPageDesigner\sidebar.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <style>
        /* Sidebar Styles */
        .side-nav {
            width: 250px;
            background-color: var(--light-gray); /* Light gray */
            padding: 30px;
            display: flex;
            flex-direction: column;
            border-right: 2px solid var(--primary-color); /* Primary gold color */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100vh; /* Full height of the viewport */
            position: fixed; /* Fixed position for the sidebar */
            top: 0;
            left: 0;
        }

        .side-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-nav ul li {
            margin-bottom: 15px;
        }

        .side-nav ul li a {
            text-decoration: none;
            color: var(--black); /* Black */
            font-weight: bold;
            display: block;
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .side-nav ul li a:hover,
        .side-nav ul li a.active {
            background-color: var(--primary-color); /* Primary gold color */
            color: var(--black); /* Black text */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .side-nav ul li a.active {
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .side-nav {
                width: 200px;
                padding: 20px;
            }

            .side-nav ul li a {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }
    </style>
</head>

<body>
    <aside class="side-nav">
        <ul>
            <li><a href="/Free-Write/public/Designer/Dashboard" class="active">Dashboard</a></li>
            <li><a href="/Free-Write/public/Designer/Competition">Competitions</a></li>
            <li><a href="/Free-Write/public/Designer/New">Create New Design</a></li>
            <!-- <li><a href="/Free-Write/public/Designer/MyOrders">My Orders</a></li> -->
            <li><a href="/Free-Write/public/User/profile">Profile</a></li>
        </ul>
    </aside>
</body>

</html>