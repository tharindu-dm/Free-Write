<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freewrite - Courier Dashboard</title>
    <style>
        :root {
            --primary-color: #ffd700;
            --background-light: #f4f4f4;
            --text-dark: #333;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-dark);
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            border-right: 1px solid var(--border-color);
            padding: 20px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .sidebar-logo img {
            width: 50px;
            margin-right: 10px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 15px;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .delivery-card {
            background-color: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delivery-details {
            flex-grow: 1;
        }

        .delivery-actions button {
            padding: 8px 15px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-accept {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-details {
            background-color: #f0f0f0;
            color: var(--text-dark);
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8em;
        }

        .status-pending {
            background-color: #ffd54f;
            color: white;
        }

        .status-completed {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>

<body>
    <?php require_once "../app/views/layout/headerSelector.php";
    //show($data);
    ?>

    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="sidebar-menu">
                <li><a href="#" class="active">Available Deliveries</a></li>
                <li><a href="#">My Deliveries</a></li>
                <li><a href="#">Completed Orders</a></li>
                <li><a href="#">Earnings</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="section-title">
                <h1>Available Deliveries</h1>
                <span>Total Available: 12</span>
            </div>

            <!-- Delivery Card -->
            <div class="delivery-card">
                <div class="delivery-details">
                    <h3>Book: The Silent Writer</h3>
                    <p>Pickup: 123 Author Street</p>
                    <p>Delivery: 456 Reader Avenue</p>
                    <span class="status-badge status-pending">Pending</span>
                </div>
                <div class="delivery-actions">
                    <button class="btn-details">View Details</button>
                    <button class="btn-accept">Accept Delivery</button>
                </div>
            </div>

            <!-- More Delivery Cards can be added similarly -->
        </div>
    </div>
    <?php require_once "../app/views/layout/footer.php"; ?>
</body>

</html>