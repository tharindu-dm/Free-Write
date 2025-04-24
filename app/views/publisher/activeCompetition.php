<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Browse competitions on Free Write">
  <title>Free Write - Competitions</title>
  <style>
    .content {
      max-width: 1600px;
      margin: 2rem auto;
      padding: 0 2rem;
    }

    .content h1 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: #1C160C;
    }

    .pub-search-container {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .pub-search-bar {
      flex: 1;
      display: flex;
      align-items: center;
      background-color: #FFFFFF;
      border: 2px solid #FFD700;
      border-radius: 8px;
      padding: 0.75rem 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .pub-search-bar:focus-within {
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    .pub-search-bar svg {
      color: #c47c15;
    }

    .pub-search-bar input {
      flex: 1;
      margin-left: 0.75rem;
      border: none;
      background: none;
      font-size: 1rem;
      color: #1C160C;
      outline: none;
    }

    .pub-search-bar input::placeholder {
      color: #c47c15;
    }

    .new-competition-button {
      padding: 0.75rem 1.5rem;
      background-color: #FFD052;
      color: #1C160C;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .new-competition-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tabs {
      display: flex;
      gap: 2rem;
      margin-bottom: 2rem;
      border-bottom: 2px solid #FFD700;
    }

    .tabs a {
      color: #c47c15;
      text-decoration: none;
      font-weight: 600;
      padding: 0.5rem 0;
      position: relative;
      transition: color 0.3s;
    }

    .tabs a.active {
      color: #1C160C;
    }

    .tabs a.active::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: #FFD052;
    }

    .table-container {
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 1rem 1.5rem;
      text-align: left;
    }

    th {
      background-color: #FCFAF5;
      color: #1C160C;
      font-weight: 600;
      border-bottom: 2px solid #FFD700;
    }

    td {
      border-bottom: 1px solid #FFD700;
    }

    tr:last-child td {
      border-bottom: none;
    }

    td a {
      color: #1C160C;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    td a:hover {
      color: #FFD052;
    }

    .status-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background-color: #FFD700;
      color: #1C160C;
      border-radius: 16px;
      font-size: 0.875rem;
      font-weight: 600;
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

    .action-link {
      color: #ffd700;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .action-link:hover {
      color: #000000;
    }

    @media (max-width: 768px) {
      .content {
        padding: 1rem;
      }

      .pub-search-container {
        flex-direction: column;
      }

      .table-container {
        overflow-x: auto;
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

  <div class="content">
    <h1>Competitions</h1>

    <div class="pub-search-container">
      <div class="pub-search-bar">
        <svg width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
          <path
            d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
          </path>
        </svg>
        <input type="text" placeholder="Search for competitions">
      </div>
      <button class="new-competition-button">New Competition</button>
    </div>

    <div class="tabs">
      <a href="/Free-Write/public/Competition/MyCompetitions">All</a>
      <a href="/Free-Write/public/Competition/Active" class="active">Active</a>
      <a href="/Free-Write/public/Competition/Completed">Completed</a>
    </div>

    <div class="table-container">

      <table>
        <thead>
          <tr>
            <th>Competition</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Category</th>
            <th>First prize</th>
            <th>Second prize</th>
            <th>Third prize</th>
            <th>Participants</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($data['activeCompetition_details'])): ?>

            <?php foreach ($data['activeCompetition_details'] as $activeCompetition_details): ?>
              <tr>
                <td>
                  <a
                    href="/Free-Write/public/Competition/Profile/<?php echo $activeCompetition_details['competitionID']; ?>">
                    <?php echo htmlspecialchars($activeCompetition_details['title']); ?>
                  </a>
                </td>
                <td>
                  <span
                    class="status-badge <?= strtotime($activeCompetition_details['end_date']) < time() ? 'ended' : 'active' ?>">
                    <?= strtotime($activeCompetition_details['end_date']) < time() ? 'Ended' : 'Active' ?>
                  </span>
                </td>

                <td><?php echo date('m/d/Y', strtotime($activeCompetition_details['start_date'])); ?></td>
                <td><?php echo date('m/d/Y', strtotime($activeCompetition_details['end_date'])); ?></td>
                <td><?php echo htmlspecialchars($activeCompetition_details['category'] ?? ''); ?></td>
                <td><?php echo '$' . number_format($activeCompetition_details['first_prize'], 2); ?></td>
                <td><?php echo '$' . number_format($activeCompetition_details['second_prize'], 2); ?></td>
                <td><?php echo '$' . number_format($activeCompetition_details['third_prize'], 2); ?></td>
                <td>0</td>
                <td>
                  <a href="/Free-Write/public/Competition/Manage/<?php echo $activeCompetition_details['competitionID']; ?>"
                    class="action-link">Manage</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" style="text-align: center;">No competitions found</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>