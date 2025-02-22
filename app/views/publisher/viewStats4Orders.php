<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sales Insights for The Art of War">
  <title>The Art of War - Sales Insights</title>
  <style>
    main {
      padding: 2rem;
      position: relative;
    }

    .breadcrumb {
      margin-bottom: 1rem;
    }

    .breadcrumb a {
      color: #c47c15;
      text-decoration: none;
    }

    .chart-container {
      max-width: 800px;
      margin: 2rem auto;
      padding: 2rem;
      background-color: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .download-btn {
      padding: 0.75rem 1.5rem;
      background-color: #FFD052;
      color: #1C160C;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .download-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #E0B94A;
    }

    .download-all-container {
      position: fixed;
      bottom: 80px;
      right: 2rem;
      z-index: 1000;
    }

    .download-all-btn {
      padding: 1rem 2rem;
      background-color: #1C160C;
      color: #FFFFFF;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .download-all-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
      background-color: #2D261C;
    }

    .chart-title {
      font-size: 1.2rem;
      color: #1C160C;
      font-weight: 500;
    }

    .chart {
      width: 100%;
      height: 200px;
      background-color: #FCFAF5;
      border-radius: 8px;
      border: 2px solid #FFD700;
      margin-bottom: 1rem;
      position: relative;
      overflow: hidden;
    }

    .chart svg {
      width: 100%;
      height: 100%;
    }

    .line {
      fill: none;
      stroke: #FFD052;
      stroke-width: 2;
    }

    .chart-labels {
      display: flex;
      justify-content: space-between;
      color: #c47c15;
      font-size: 0.9rem;
      margin-top: 1rem;
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      color: #1C160C;
    }

    footer {
      margin-top: auto;
      text-align: center;
      padding: 1.5rem;
      background-color: #FFFFFF;
      color: #c47c15;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }

    .icon {
      width: 16px;
      height: 16px;
    }

    @media (max-width: 768px) {
      .chart-container {
        margin: 1rem;
        padding: 1rem;
      }

      .chart-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
      }

      .download-btn {
        width: 100%;
        justify-content: center;
      }

      .download-all-container {
        position: fixed;
        bottom: 80px;
        right: 1rem;
        left: 1rem;
      }

      .download-all-btn {
        width: 100%;
        justify-content: center;
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
  <main>
    <div class="breadcrumb">
      <a href="/Free-Write/public/Order">Back to Orders</a>
      <span> / View Statistics</span>
    </div>
    <div class="chart-container">
      <h1>The Art of War - Sales Insights</h1>
      <div class="chart-wrapper">
        <div class="chart-header">
          <h2 class="chart-title">Total royalties</h2>
          <button class="download-btn">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
              <polyline points="7 10 12 15 17 10" />
              <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            Download PDF
          </button>
        </div>
        <div class="chart">
          <svg viewBox="0 0 1000 200" preserveAspectRatio="none">
            <path class="line" d="M0,100 Q250,50 500,150 T1000,100" />
          </svg>
        </div>
        <div class="chart-labels">
          <span>Jan 2023</span>
          <span>Feb 2023</span>
          <span>Mar 2023</span>
          <span>Apr 2023</span>
          <span>May 2023</span>
          <span>Jun 2023</span>
          <span>Jul 2023</span>
        </div>
      </div>
    </div>
    <div class="chart-container">
      <div class="chart-header">
        <h2 class="chart-title">Total units sold</h2>
        <button class="download-btn">
          <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
            <polyline points="7 10 12 15 17 10" />
            <line x1="12" y1="15" x2="12" y2="3" />
          </svg>
          Download PDF
        </button>
      </div>
      <div class="chart">
        <svg viewBox="0 0 1000 200" preserveAspectRatio="none">
          <path class="line" d="M0,100 Q250,50 500,150 T1000,100" />
        </svg>
      </div>
      <div class="chart-labels">
        <span>Jan 2023</span>
        <span>Feb 2023</span>
        <span>Mar 2023</span>
        <span>Apr 2023</span>
        <span>May 2023</span>
        <span>Jun 2023</span>
        <span>Jul 2023</span>
      </div>
    </div>
    <div class="download-all-container">
      <button class="download-all-btn">
        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
          <polyline points="7 10 12 15 17 10" />
          <line x1="12" y1="15" x2="12" y2="3" />
        </svg>
        Download All Statistics
      </button>
    </div>
  </main>

  <?php
  require_once "../app/views/layout/footer.php";
  ?>
</body>

</html>