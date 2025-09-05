<?php
// Connection config
$host = "localhost";
$port = 3307;
$username = "root";
$password = "";
$database = "harsh_mca_php_project";

// Create connection
$conn = new mysqli($host, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM ipo_data_add WHERE IPO_ID = $id");
    header("Location: demo_display.php");
    exit;
}

// Fetch records
$query = "
    SELECT IPO_ID, Name_ipo, Issue_Price, Face_Value, Registrar, Listing_at_Group, 
           Lead_Manager, Market_Lot, Issue_Size, Subscription,
           DATE_FORMAT(Listing_Date, '%d %b %Y') AS Listing_Date,
           DATE_FORMAT(Allotment_Date, '%d %b %Y') AS Allotment_Date,
           DATE_FORMAT(Open_Date, '%d %b %Y') AS Open_Date,
           DATE_FORMAT(Close_Date, '%d %b %Y') AS Close_Date
    FROM ipo_data_add
    ORDER BY IPO_ID DESC
";

$result = $conn->query($query);
if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPO Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to left, #770da8, #a183e8);
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #E3F2FD;
            padding-top: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }
      .no-underline {
            text-decoration: none;
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

        .nav-heading {
            padding: 0 25px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Main content */
        .content {
            margin-left: 260px; /* push content aside */
            padding: 20px;
        }

        .dashboard-header {
            text-align: center;
            margin-top: 30px;
            color: white;
        }

        .record-count {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 30px;
            color: white;
        }

        .ipo-card {
            background: white;
            color: black;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .ipo-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-edit {
            background-color: orange;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: darkorange;
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: darkred;
        }

        .ipo-details {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="nav-heading">Admin Panel</div>
        <a href="admin_dashboard.php" class="bi bi-speedometer2 me-2">Dashboard</a>
        <a href="add_ipo.php" class="bi bi-file-earmark-plus me-2"> Add IPO</a>
        <a href="add_sme.php" class="bi bi-file-earmark-plus me-2"> Add SME</a>
        <a href="demo_display.php"  class="bi bi-table me-2">View Records</a>
        <a href="home.php" class="bi bi-box-arrow-right me-2"> Logout</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container text-center dashboard-header">
            <h2>📈 IPO & SME Dashboard</h2>
            <p>Manage Initial Public Offerings & SME Records</p>
            <a href="demo_display.php" class="record-count no-underline"> Show IPO</a>
            <a href="sme_disp_admin.php" class="record-count no-underline"> Show SME</a><br>
            
            <div class="record-count">Total Records: <?= $result->num_rows ?></div>
        </div>

        <div class="container">
            <div class="row g-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="ipo-card p-3 d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary">IPO: <?= htmlspecialchars($row['Name_ipo']) ?></span>
                                <div>
                                    <a href="update_ipo.php?IPO_ID=<?= $row['IPO_ID'] ?>" class="btn-edit">Edit</a>
                                    <a href="?delete=<?= $row['IPO_ID'] ?>" class="btn-delete"
                                       onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                </div>
                            </div>

                            <table class="table table-sm">
                                <tbody class="ipo-details">
                                    <tr><td>📅 Open Date:</td><td><?= htmlspecialchars($row['Open_Date']) ?></td></tr>
                                    <tr><td>📅 Close Date:</td><td><?= htmlspecialchars($row['Close_Date']) ?></td></tr>
                                    <tr><td>📅 Listing Date:</td><td><?= htmlspecialchars($row['Listing_Date']) ?></td></tr>
                                    <tr><td>📅 Allotment Date:</td><td><?= htmlspecialchars($row['Allotment_Date']) ?></td></tr>
                                    <tr><td>💰 Issue Price:</td><td>₹<?= htmlspecialchars($row['Issue_Price']) ?></td></tr>
                                    <tr><td>📄 Face Value:</td><td>₹<?= htmlspecialchars($row['Face_Value']) ?></td></tr>
                                    <tr><td>📝 Registrar:</td><td><?= htmlspecialchars($row['Registrar']) ?></td></tr>
                                    <tr><td>📈 Listing Group:</td><td><?= htmlspecialchars($row['Listing_at_Group']) ?></td></tr>
                                    <tr><td>👔 Lead Manager:</td><td><?= htmlspecialchars($row['Lead_Manager']) ?></td></tr>
                                    <tr><td>📦 Market Lot:</td><td><?= htmlspecialchars($row['Market_Lot']) ?></td></tr>
                                    <tr><td>💹 Issue Size:</td><td><?= htmlspecialchars($row['Issue_Size']) ?></td></tr>
                                    <tr><td>📊 Subscription:</td><td><?= htmlspecialchars($row['Subscription']) ?></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>
</html>

<?php $conn->close(); ?>
