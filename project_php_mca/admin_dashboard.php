<?php
session_start();

// Prevent browser from caching this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Database connection config
$host = "localhost";
$port = 3307;
$username = "root";
$password = "";
$database = "harsh_mca_php_project";

$conn = new mysqli($host, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Helper function to count IPOs/SMEs dynamically by date
function getCount($conn, $table, $status) {
    $today = date('Y-m-d');
    $sql = "";

    switch ($status) {
        case "upcoming":
            $sql = "SELECT COUNT(*) as total FROM `$table` WHERE Open_Date > '$today'";
            break;

        case "current":
            $sql = "SELECT COUNT(*) as total FROM `$table` 
                    WHERE Open_Date <= '$today' AND Close_Date >= '$today'";
            break;

        case "closed":
            $sql = "SELECT COUNT(*) as total FROM `$table` 
                    WHERE Close_Date < '$today' AND Listing_Date > '$today'";
            break;

        case "listed":
            $sql = "SELECT COUNT(*) as total FROM `$table` 
                    WHERE Listing_Date <= '$today'";
            break;

        default:
            return 0;
    }

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// IPO counts
$upcoming_ipo = getCount($conn, "ipo_data_add", "upcoming");
$current_ipo  = getCount($conn, "ipo_data_add", "current");
$closed_ipo   = getCount($conn, "ipo_data_add", "closed");

// SME counts
$upcoming_sme = getCount($conn, "sme_data_add", "upcoming");
$current_sme  = getCount($conn, "sme_data_add", "current");
$closed_sme   = getCount($conn, "sme_data_add", "closed");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #f2f4f7;
    }
    .sidebar {
      height: 100vh;
      width: 250px;
      background-color: #E3F2FD;
      padding-top: 30px;
      position: fixed;
    }
    .sidebar a {
      padding: 15px 25px;
      display: block;
      font-weight: 500;
      color: #0d6efd;
      text-decoration: none;
      transition: all 0.3s;
    }
    .sidebar a:hover {
      background-color: #BBDEFB;
      color: #000;
      border-left: 5px solid #0d6efd;
    }
    .sidebar .nav-heading {
      padding: 0 25px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }
    .content {
      margin-left: 250px;
      padding: 30px;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <div class="nav-heading text-primary">Admin Panel</div>
    <a href="admin_dashboard.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="add_ipo.php"><i class="bi bi-file-earmark-plus me-2"></i> Add IPO</a>
    <a href="add_sme.php"><i class="bi bi-file-earmark-plus me-2"></i> Add SME</a>
    <a href="demo_display.php"><i class="bi bi-table me-2"></i> View Records</a>
    <a href="home.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </div>

  <div class="content">
    <h2 class="mb-4 text-center text-primary fw-bold">Dashboard Overview</h2>

    <div class="row g-4">
      <!-- Upcoming IPOs -->
      <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
          <div class="card-body">
            <h5 class="card-title">Upcoming IPOs</h5>
            <p class="card-text fs-3"><?= $upcoming_ipo ?></p>
          </div>
        </div>
      </div>

      <!-- Current IPOs -->
      <div class="col-md-4">
        <div class="card text-white bg-success shadow">
          <div class="card-body">
            <h5 class="card-title">Current IPOs</h5>
            <p class="card-text fs-3"><?= $current_ipo ?></p>
          </div>
        </div>
      </div>

      <!-- Closed IPOs -->
      <div class="col-md-4">
        <div class="card text-white bg-danger shadow">
          <div class="card-body">
            <h5 class="card-title">Closed IPOs</h5>
            <p class="card-text fs-3"><?= $closed_ipo ?></p>
          </div>
        </div>
      </div>

      <!-- Upcoming SMEs -->
      <div class="col-md-4">
        <div class="card text-white bg-primary shadow">
          <div class="card-body">
            <h5 class="card-title">Upcoming SMEs</h5>
            <p class="card-text fs-3"><?= $upcoming_sme ?></p>
          </div>
        </div>
      </div>

      <!-- Current SMEs -->
      <div class="col-md-4">
        <div class="card text-white bg-success shadow">
          <div class="card-body">
            <h5 class="card-title">Current SMEs</h5>
            <p class="card-text fs-3"><?= $current_sme ?></p>
          </div>
        </div>
      </div>

      <!-- Closed SMEs -->
      <div class="col-md-4">
        <div class="card text-white bg-danger shadow">
          <div class="card-body">
            <h5 class="card-title">Closed SMEs</h5>
            <p class="card-text fs-3"><?= $closed_sme ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
