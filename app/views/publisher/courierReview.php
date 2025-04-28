<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Write - Review Courier Application</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .content {
      width: 95%;
      margin: 1.5rem auto;
      padding: 0 1rem;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      padding: 1rem;
      background: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .header h1 {
      font-size: 2rem;
      color: #1C160C;
      margin: 0;
      position: relative;
    }

    .header h1::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 60px;
      height: 3px;
      background-color: #FFD700;
    }

    .status-badge {
      display: inline-block;
      padding: 0.5rem 1.25rem;
      border-radius: 20px;
      font-size: 1rem;
      font-weight: 600;
      background-color: #FFD700;
      color: #1C160C;
      box-shadow: 0 2px 4px rgba(255, 215, 0, 0.2);
      transition: transform 0.2s;
    }

    .status-badge:hover {
      transform: translateY(-2px);
    }

    .grid-container {
      display: grid;
      grid-template-columns: 3fr 1fr;
      gap: 1.5rem;
    }

    .section-card {
      background: #FFFFFF;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 1.5rem;
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .section-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .section-header {
      background: #FCFAF5;
      padding: 1rem 1.5rem;
      border-bottom: 2px solid #FFD700;
      position: relative;
    }

    .section-header::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background-color: #FFD700;
    }

    .section-header h2 {
      color: #1C160C;
      font-size: 1.25rem;
      margin: 0;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.25rem;
    }

    .info-item {
      margin-bottom: 0.5rem;
      padding: 0.75rem;
      border-radius: 8px;
      transition: background-color 0.2s;
    }

    .info-item:hover {
      background-color: #FCFAF5;
    }

    .document-card {
      border: 1px solid #FFD700;
      border-radius: 8px;
      padding: 1rem;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: all 0.2s;
    }

    .document-card:hover {
      background-color: #FCFAF5;
      transform: translateX(4px);
    }

    .document-icon {
      width: 40px;
      height: 40px;
      background: #FCFAF5;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #c47c15;
      font-weight: bold;
      border: 2px solid #FFD700;
      transition: all 0.2s;
    }

    .document-card:hover .document-icon {
      background: #FFD700;
      color: #1C160C;
    }

    .view-button {
      padding: 0.5rem 1.25rem;
      background: #FCFAF5;
      border: 1px solid #FFD700;
      border-radius: 6px;
      color: #c47c15;
      cursor: pointer;
      transition: all 0.3s;
      font-weight: 500;
    }

    .view-button:hover {
      background: #FFD700;
      color: #1C160C;
      transform: translateX(2px);
    }

    .area-map {
      border: 2px solid #FFD700;
      border-radius: 8px;
      height: 200px;
      background: #FCFAF5;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #c47c15;
      transition: all 0.2s;
      cursor: pointer;
    }

    .area-map:hover {
      border-color: #c47c15;
      background: #FFF8E1;
    }

    .decision-box {
      position: sticky;
      top: 1rem;
    }

    .decision-buttons {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-top: 1rem;
    }

    .decision-button {
      padding: 1rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .approve-button {
      background: #4CAF50;
      color: white;
      box-shadow: 0 2px 4px rgba(76, 175, 80, 0.2);
    }

    .reject-button {
      background: #f44336;
      color: white;
      box-shadow: 0 2px 4px rgba(244, 67, 54, 0.2);
    }

    .decision-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .feedback-textarea {
      width: 100%;
      min-height: 100px;
      margin-top: 1rem;
      padding: 1rem;
      border: 2px solid #FFD700;
      border-radius: 8px;
      resize: vertical;
      transition: all 0.2s;
      font-family: inherit;
    }

    .feedback-textarea:focus {
      outline: none;
      border-color: #FFD052;
      box-shadow: 0 0 0 3px rgba(255, 208, 82, 0.2);
      background-color: #FCFAF5;
    }

    /* Enhanced Responsive Design */
    @media (min-width: 1921px) {
      .content {
        width: 90%;
        max-width: 2200px;
      }
    }

    @media (max-width: 1440px) {
      .content {
        width: 98%;
      }
    }

    @media (max-width: 1200px) {
      .grid-container {
        grid-template-columns: 2fr 1fr;
        gap: 1rem;
      }
    }

    @media (max-width: 1024px) {
      .grid-container {
        grid-template-columns: 1fr;
      }

      .decision-box {
        position: static;
      }

      .info-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      }
    }

    @media (max-width: 768px) {
      .content {
        width: 100%;
        padding: 0 0.75rem;
        margin: 1rem auto;
      }

      .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
      }

      .status-badge {
        align-self: flex-start;
      }

      .section-content {
        padding: 1rem;
      }

      .document-card {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
      }

      .view-button {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>

<body>
  <?php require_once "../app/views/layout/headerSelector.php";
  
  ?>
  
  <div class="content">
    <div class="header">
      <h1>Application Review</h1>
      <span class="status-badge">Pending Review</span>
    </div>

    <div class="grid-container">
      <div class="main-content">
        <!-- Personal Information -->
        <div class="section-card">
          <div class="section-header">
            <h2>Personal Information</h2>
          </div>
          <div class="section-content">
            <div class="info-grid">
              <div class="info-item">
                <div class="info-label">Full Name</div>
                <div class="info-value">John Doe</div>
              </div>
              <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">john.doe@example.com</div>
              </div>
              <div class="info-item">
                <div class="info-label">Phone</div>
                <div class="info-value">+1 234 567 8900</div>
              </div>
              <div class="info-item">
                <div class="info-label">Experience</div>
                <div class="info-value">3 years</div>
              </div>
              <div class="info-item">
                <div class="info-label">Office address</div>
                <div class="info-value">colombo 06</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Documents -->
        <div class="section-card">
          <div class="section-header">
            <h2>Documents</h2>
          </div>
          <div class="section-content">
            <div class="document-card">
              <div class="document-info">
                <div class="document-icon">ID</div>
                <div>
                  <div class="info-value">ID Proof</div>
                  <div class="info-label">Uploaded on Feb 1, 2024</div>
                </div>
              </div>
              <button class="view-button">View Document</button>
            </div>
            <div class="document-card">
              <div class="document-info">
                <div class="document-icon">DL</div>
                <div>
                  <div class="info-value">Driver's License</div>
                  <div class="info-label">Uploaded on Feb 1, 2024</div>
                </div>
              </div>
              <button class="view-button">View Document</button>
            </div>
            <div class="document-card">
              <div class="document-info">
                <div class="document-icon">VR</div>
                <div>
                  <div class="info-value">Vehicle Registration</div>
                  <div class="info-label">Uploaded on Feb 1, 2024</div>
                </div>
              </div>
              <button class="view-button">View Document</button>
            </div>
          </div>
        </div>

        <!-- Service Area -->
        <div class="section-card">
          <div class="section-header">
            <h2>Service Area Coverage</h2>
          </div>
          <div class="section-content">
            <div class="area-map">
              Map View of Coverage Area
            </div>
            <div class="info-grid" style="margin-top: 1rem;">
              <div class="info-item">
                <div class="info-label">Primary Zone</div>
                <div class="info-value">North Zone</div>
              </div>
              <div class="info-item">
                <div class="info-label">Secondary Zones</div>
                <div class="info-value">East Zone, Central Zone</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Decision Box -->
      <div class="decision-box">
        <div class="section-card">
          <div class="section-header">
            <h2>Application Decision</h2>
          </div>
          <div class="section-content">
            <div class="info-item">
              <div class="info-label">Background Check Status</div>
              <div class="info-value" style="color: #4CAF50;">Cleared</div>
            </div>
            <div class="info-item">
              <div class="info-label">Document Verification</div>
              <div class="info-value" style="color: #4CAF50;">Verified</div>
            </div>
            <div class="info-item">
              <div class="info-label">Vehicle Inspection</div>
              <div class="info-value" style="color: #FFD700;">Pending</div>
            </div>
            <textarea class="feedback-textarea" placeholder="Add feedback or notes about the application..."></textarea>
            <div class="decision-buttons">
              <button class="decision-button approve-button">Approve</button>
              <button class="decision-button reject-button">Reject</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>