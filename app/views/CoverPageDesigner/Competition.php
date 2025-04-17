<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Write - Competitions</title>
  <link rel="stylesheet" href="/Free-Write/public/css/Competition.css">
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
    case 'inst':
      require_once "../app/views/layout/header-inst.php";
      break;
    default:
      require_once "../app/views/layout/header.php";
  }
  //show($data);
  ?>

  <main>

    <aside class="side-nav">
        <ul>
            <li><a href="/Free-Write/public/Designer/Dashboard" class="active">Dashboard</a></li>
            <li><a href="/Free-Write/public/Designer/Competition">Competitions</a></li>
            <li><a href="/Free-Write/public/Designer/New">Create New Design</a></li>
            <!-- <li><a href="/Free-Write/public/Designer/MyOrders">My Orders</a></li> -->
            <li><a href="/Free-Write/public/User/profile">Profile</a></li>
        </ul>
    </aside>

    <section class="user-profile">
      <img src="/Free-Write/app/images/profile/<?= htmlspecialchars($userDetails['profileImage'] ?? 'profile-image.jpg') ?>" alt="Michael Thompson" class="profile-picture">
      <h1>Michael Thompson</h1>
      <p>250 followers</p>
    </section>
    <nav class="profile-nav">
      <ul>
        <li><a href="/Free-Write/public/Designer/Dashboard" class="inactive">Your Designs</a></li>
        <li><a href="#" class="active">Competitions</a></li>
      </ul>
    </nav>
    <section class="competitions">

    <!-- filepath: c:\xampp\htdocs\Free-Write\app\views\Competitions\index.php -->
<h1>All Competitions</h1>
<?php if (!empty($competitions)): ?>
    <?php foreach ($competitions as $competition): ?>
        <div class="competition">
            <h2><?= htmlspecialchars($competition['title']) ?></h2>
            <p><?= htmlspecialchars($competition['description']) ?></p>
            <p><strong>Deadline:</strong> <?= htmlspecialchars($competition['deadline']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No competitions available at the moment.</p>
<?php endif; ?>


    <!-- Active Competitions -->
    <div class="active-competitions">
        <h2>Active Competitions</h2>
        <table class="competition-table">
            <thead>
                <tr>
                    <th>Competition</th>
                    <th>Deadline</th>
                    <th>Prizes</th>
                    <th>Enter</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activeCompetitions ?? [] as $comp): ?>
                    <tr>
                        <td><?= htmlspecialchars($comp->title) ?></td>
                        <td><?= htmlspecialchars($comp->end_date) ?></td>
                        <td>
                            🥇 <?= $comp->first_prize ?> <br>
                            🥈 <?= $comp->second_prize ?> <br>
                            🥉 <?= $comp->third_prize ?>
                        </td>
                        <td><a href="#" class="btn-enter">Enter</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Previous Competitions -->
    <div class="previous-competitions">
        <h2>Previous Competitions</h2>
        <table class="competition-table">
            <thead>
                <tr>
                    <th>Competition</th>
                    <th>Deadline</th>
                    <th>Prizes</th>
                    <th>Results</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($previousCompetitions ?? [] as $comp): ?>
                    <tr>
                        <td><?= htmlspecialchars($comp->title) ?></td>
                        <td><?= htmlspecialchars($comp->end_date) ?></td>
                        <td>
                            🥇 <?= $comp->first_prize ?> <br>
                            🥈 <?= $comp->second_prize ?> <br>
                            🥉 <?= $comp->third_prize ?>
                        </td>
                        <td><a href="#">View Results</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Upcoming Competitions -->
    <div class="upcoming-competitions">
        <h2>Upcoming Competitions</h2>
        <table class="competition-table">
            <thead>
                <tr>
                    <th>Competition</th>
                    <th>Deadline</th>
                    <th>Prizes</th>
                    <th>Reminder</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($upcomingCompetitions ?? [] as $comp): ?>
                    <tr>
                        <td><?= htmlspecialchars($comp->title) ?></td>
                        <td><?= htmlspecialchars($comp->end_date) ?></td>
                        <td>
                            🥇 <?= $comp->first_prize ?> <br>
                            🥈 <?= $comp->second_prize ?> <br>
                            🥉 <?= $comp->third_prize ?>
                        </td>
                        <td><a href="#">Set Reminder</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
  </main>
  
  <?php require_once "../app/views/layout/footer.php"; ?>
  <script src="Competition.js"></script>
</body>

</html>