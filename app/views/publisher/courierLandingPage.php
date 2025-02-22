<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Write - Courier Applications Dashboard</title>
  <style>
     body {
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .content {
      width: 95%; /* Changed from max-width to width */
      margin: 1rem auto; /* Reduced margin */
      padding: 0 1rem; /* Reduced padding */
    }

    .content h1 {
      font-size: 2rem;
      margin-bottom: 1.5rem;
      color: #1C160C;
    }

    /* Stats Cards */
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Reduced minmax width */
      gap: 1rem; /* Reduced gap */
      margin-bottom: 1.5rem;
    }

    .stat-card {
      background: #FFFFFF;
      border-radius: 8px; /* Reduced border radius */
      padding: 1.25rem; /* Reduced padding */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-left: 4px solid #FFD700;
    }

    .stat-card.pending {
      border-left-color: #FFD700;
    }

    .stat-card.approved {
      border-left-color: #4CAF50;
    }

    .stat-card.rejected {
      border-left-color: #f44336;
    }

    .stat-card h3 {
      color: #c47c15;
      font-size: 0.875rem;
      margin-bottom: 0.5rem;
    }

    .stat-card .number {
      color: #1C160C;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
    }

    .stat-card .trend {
      font-size: 0.875rem;
      color: #4CAF50;
    }

    /* Filter Section */
    .filters-section {
      background: #FFFFFF;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .filters-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
    }

    .filter-group label {
      font-size: 0.875rem;
      color: #1C160C;
      margin-bottom: 0.5rem;
    }

    .filter-group select,
    .filter-group input {
      padding: 0.75rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      font-size: 0.875rem;
      color: #1C160C;
      background: #FFFFFF;
    }

    .filter-group select:focus,
    .filter-group input:focus {
      border-color: #FFD052;
      outline: none;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
    }

    /* Table Styles */
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

    th, td {
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

    .status-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 16px;
      font-size: 0.875rem;
      font-weight: 600;
    }

    .status-badge.pending {
      background-color: #FFD700;
      color: #1C160C;
    }

    .status-badge.approved {
      background-color: #4CAF50;
      color: white;
    }

    .status-badge.rejected {
      background-color: #f44336;
      color: white;
    }

    .action-link {
      color: #c47c15;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .action-link:hover {
      color: #1C160C;
    }

    @media (max-width: 768px) {
      .content {
        padding: 1rem;
      }
      
      .filters-grid {
        grid-template-columns: 1fr;
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
    <h1>Courier Applications Dashboard</h1>

    <!-- Stats Cards -->
    <div class="stats-container">
      <div class="stat-card pending">
        <h3>Pending Applications</h3>
        <div class="number">24</div>
        <div class="trend">↑ 12% this week</div>
      </div>
      <div class="stat-card approved">
        <h3>Approved Applications</h3>
        <div class="number">156</div>
        <div class="trend">↑ 8% this week</div>
      </div>
      <div class="stat-card rejected">
        <h3>Rejected Applications</h3>
        <div class="number">12</div>
        <div class="trend">↓ 5% this week</div>
      </div>
      <div class="stat-card">
        <h3>Total Applications</h3>
        <div class="number">192</div>
        <div class="trend">↑ 15% this month</div>
      </div>
    </div>

    <!-- Filters Section -->
    <!-- <div class="filters-section">
      <div class="filters-grid">
        <div class="filter-group">
          <label>Status</label>
          <select>
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
          </select>
        </div>
        <div class="filter-group">
          <label>Service Area</label>
          <select>
            <option value="">All Areas</option>
            <option value="north">North Zone</option>
            <option value="south">South Zone</option>
            <option value="east">East Zone</option>
            <option value="west">West Zone</option>
          </select>
        </div>
        <div class="filter-group">
          <label>Vehicle Type</label>
          <select>
            <option value="">All Vehicles</option>
            <option value="motorcycle">Motorcycle</option>
            <option value="car">Car</option>
            <option value="van">Van</option>
          </select>
        </div>
        <div class="filter-group">
          <label>Date Range</label>
          <input type="date">
        </div>
      </div>
    </div> -->

    <!-- Applications Table -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Applicant Name</th>
            <th>Service Area</th>
            <th>Vehicle Type</th>
            <th>Experience</th>
            <th>Applied Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John Doe</td>
            <td>North Zone</td>
            <td>Motorcycle</td>
            <td>2 years</td>
            <td>01/02/2024</td>
            <td><span class="status-badge pending">Pending</span></td>
            <td><a href="/Free-Write/public/Publisher/courierReview" class="action-link">Review</a></td>
          </tr>
          <tr>
            <td>Jane Smith</td>
            <td>South Zone</td>
            <td>Car</td>
            <td>3 years</td>
            <td>31/01/2024</td>
            <td><span class="status-badge approved">Approved</span></td>
            <td><a href="#" class="action-link">View Details</a></td>
          </tr>
          <tr>
            <td>Mike Johnson</td>
            <td>East Zone</td>
            <td>Van</td>
            <td>1 year</td>
            <td>30/01/2024</td>
            <td><span class="status-badge rejected">Rejected</span></td>
            <td><a href="#" class="action-link">View Details</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>