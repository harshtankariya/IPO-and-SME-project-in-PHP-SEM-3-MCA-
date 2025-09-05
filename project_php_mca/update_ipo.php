<?php
$host = 'localhost';
$port = 3307;
$dbname = 'harsh_mca_php_project';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get IPO_ID from query string
    if (!isset($_GET['IPO_ID'])) {
        die("Error: IPO_ID not provided.");
    }

    $ipo_id = $_GET['IPO_ID'];

    // Fetch record
    $sql = "SELECT * FROM ipo_data_add WHERE IPO_ID = :IPO_ID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':IPO_ID' => $ipo_id]);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$record) {
        die("Error: Record not found.");
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update IPO Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Update IPO Data</h2>
        <form action="update_ipo_data.php" method="POST">
            <!-- Hidden field for IPO_ID -->
            <input type="hidden" name="IPO_ID" value="<?= htmlspecialchars($record['IPO_ID']) ?>">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">IPO Name</label>
                    <input type="text" name="ipo_name" class="form-control" 
                           value="<?= htmlspecialchars($record['Name_ipo']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Issue Price</label>
                    <input type="number" step="0.01" name="issue_price" class="form-control" 
                           value="<?= htmlspecialchars($record['Issue_Price']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Face Value</label>
                    <input type="number" step="0.01" name="face_value" class="form-control" 
                           value="<?= htmlspecialchars($record['Face_Value']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Registrar</label>
                    <input type="text" name="registrar" class="form-control" 
                           value="<?= htmlspecialchars($record['Registrar']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Listing Group</label>
                    <input type="text" name="listing_group" class="form-control" 
                           value="<?= htmlspecialchars($record['Listing_at_Group']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lead Manager</label>
                    <input type="text" name="lead_manager" class="form-control" 
                           value="<?= htmlspecialchars($record['Lead_Manager']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Market Lot</label>
                    <input type="number" name="market_lot" class="form-control" 
                           value="<?= htmlspecialchars($record['Market_Lot']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Issue Size</label>
                    <input type="text" name="issue_size" class="form-control" 
                           value="<?= htmlspecialchars($record['Issue_Size']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Subscription</label>
                    <input type="text" name="subscription" class="form-control" 
                           value="<?= htmlspecialchars($record['Subscription']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Open Date</label>
                    <input type="date" name="open_date" class="form-control" 
                           value="<?= htmlspecialchars($record['Open_Date']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Close Date</label>
                    <input type="date" name="close_date" class="form-control" 
                           value="<?= htmlspecialchars($record['Close_Date']) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Allotment Date</label>
                    <input type="date" name="allotment_date" class="form-control" 
                           value="<?= htmlspecialchars($record['Allotment_Date']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Listing Date</label>
                    <input type="date" name="listing_date" class="form-control" 
                           value="<?= htmlspecialchars($record['Listing_Date']) ?>" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="ipo_disp_admin.php" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
