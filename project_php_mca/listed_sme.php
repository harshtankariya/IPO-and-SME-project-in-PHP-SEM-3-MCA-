<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IPO - Initial Public Offering</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Global Background */
    body {
      background: linear-gradient(to right, #6c63ff, #00c6ff);
      min-height: 100vh;
      margin: 0;
      padding: 0;
      color: #fff;
    }

    /* Navbar Styling */
    .navbar-custom {
      background: linear-gradient(90deg, #6c63ff, #00c6ff);
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }
    .navbar-custom .nav-link, 
    .navbar-custom .navbar-brand {
      color: white !important;
      font-weight: 500;
    }
    .navbar-custom .nav-link:hover {
      color: #ffe082 !important;
    }

    /* Sidebar */
    .sidebar {
      width: 220px;
      background: linear-gradient(to bottom, #6c63ff, #00c6ff);
      padding: 20px 15px;
      min-height: calc(100vh - 56px);
      color: white;
      box-shadow: 2px 0 8px rgba(0,0,0,0.2);
    }
    .sidebar .nav-link {
      border-radius: 10px;
      margin-bottom: 10px;
      padding: 10px 15px;
      color: white;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: 0.3s;
      font-weight: 500;
    }
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
      background-color: rgba(255, 255, 255, 0.2);
      color: #ffe082;
    }

    /* IPO Card Styling */
    .ipo-card {
      background: linear-gradient(135deg, #ffffff, #f3f3f3);
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      padding: 20px;
      margin-bottom: 20px;
      color: #333;
      min-height: 480px; /* ensures equal card height */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .ipo-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    }

    .ipo-details td {
      padding: 6px 8px;
      vertical-align: middle;
    }
    .ipo-details td:first-child {
      font-weight: 500;
      color: #555;
    }
    .ipo-details td:last-child {
      text-align: right;
      font-weight: 600;
      color: #222;
    }

    .ipo-id {
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="bi bi-graph-up-arrow"></i> IPO Tracker</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="home.php">Mainboard IPO</a></li>
          <li class="nav-item"><a class="nav-link" href="sme_data_disp.php">SME</a></li>
          <li class="nav-item"><a class="nav-link" href="admin_login_form.php">Admin Login </a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="add_ipo.php">Add IPO</a></li> -->
        </ul>
      </div>
    </div>
  </nav>

  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar d-none d-md-block">
      <a class="nav-link active" href="sme_data_disp.php"><i class="bi bi-funnel"></i> All SME</a>
      <a class="nav-link" href="current_sme.php"><i class="bi bi-broadcast"></i> Current SME IPOs</a>
      <a class="nav-link" href="upcoming_sme.php"><i class="bi bi-calendar-event"></i> Upcoming SME IPOs</a>
      <a class="nav-link" href="listed_sme.php"><i class="bi bi-list-task"></i> Listed SME IPOs</a>
    </div>

    <!-- Main Content -->
    <div class="container-fluid p-4">
      <div class="row g-4">
        <?php
        // Database connection
        $host = "localhost";
        $port = 3307;
        $username = "root";
        $password = "";
        $database = "harsh_mca_php_project";
        $conn = new mysqli($host, $username, $password, $database, $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * 
                                FROM sme_data_add
                                WHERE listing_date < CURDATE()
                                ORDER BY IPO_ID DESC; ");

        if (!$result) {
            die("Query Error: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()): ?>
          <div class="col-lg-4 col-md-6">
            <div class="ipo-card">
              <h6 class="mb-3 ipo-id">
                <span class="badge bg-primary">SME  Name : <?= htmlspecialchars($row['Name_ipo']) ?></span>
              </h6>
              <table class="table table-borderless ipo-details">
                <tbody>
                  <tr><td>📅 Open Date:</td><td><?= htmlspecialchars($row['Open_Date']) ?></td></tr>
                  <tr><td>📅 Close Date:</td><td><?= htmlspecialchars($row['Close_Date']) ?></td></tr>
                  <tr><td>📅 Listing Date:</td><td><?= htmlspecialchars($row['Listing_Date']) ?></td></tr>
                  <tr><td>📅 Allotment Date:</td><td><?= htmlspecialchars($row['Allotment_Date']) ?></td></tr>
                  <tr><td>💰 Issue Price:</td><td>₹<?= htmlspecialchars($row['Issue_Price']) ?></td></tr>
                  <tr><td>📄 Face Value:</td><td>₹<?= htmlspecialchars($row['Face_Value']) ?></td></tr>
                  <tr><td>📝 Registrar:</td><td><?= htmlspecialchars($row['Registrar']) ?></td></tr>
                  <tr><td>📈 Listing At:</td><td><?= htmlspecialchars($row['Listing_at_Group']) ?></td></tr>
                  <tr><td>👔 Lead Manager:</td><td><?= htmlspecialchars($row['Lead_Manager']) ?></td></tr>
                  <tr><td>📦 Market Lot:</td><td><?= htmlspecialchars($row['Market_Lot']) ?></td></tr>
                  <tr><td>💹 Issue Size:</td><td><?= htmlspecialchars($row['Issue_Size']) ?></td></tr>
                  <tr><td>📊 Subscription:</td><td><?= htmlspecialchars($row['Subscription']) ?></td></tr>
                </tbody>
              </table>
            </div>
          </div>
        <?php endwhile; $conn->close(); ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!--
NOTE -> this ia table slq code 

CREATE TABLE ipo_data (
    IPO_ID INT AUTO_INCREMENT PRIMARY KEY,
    Name_ipo VARCHAR(255) NOT NULL,
    Issue_Price DECIMAL(10,2),
    Face_Value DECIMAL(10,2),
    Registrar VARCHAR(255),
    Listing_at_Group VARCHAR(255),
    Lead_Manager VARCHAR(255),
    Market_Lot INT,
    Issue_Size VARCHAR(100),
    Subscription VARCHAR(100),
    Listing_Date DATE,
    Allotment_Date DATE,
    Close_Date DATE,
    Open_Date DATE
); -->
