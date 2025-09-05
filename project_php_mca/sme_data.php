<?php
$host = 'localhost';
$port = 3307; 
$dbname = 'harsh_mca_php_project';
$username = 'root';
$password = ''; 

try {
    // Set DSN with port
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    // Create PDO instance
    $pdo = new PDO($dsn, $username, $password);

    // Set error mode to Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Collect form data safely
    $name_ipo      = $_POST['ipo_name'];// error here 
    $issue_price   = $_POST['issue_price'];
    $face_value    = $_POST['face_value'];
    $registrar     = $_POST['registrar'];
    $listing_group = $_POST['listing_group'];
    $lead_manager  = $_POST['lead_manager'];
    $market_lot    = $_POST['market_lot'];
    $issue_size    = $_POST['issue_size'];
    $subscription  = $_POST['subscription'];
    $listing_date  = $_POST['listing_date'];
    $allotment_date= $_POST['allotment_date'];
    $close_date    = $_POST['close_date'];
    $open_date     = $_POST['open_date'];

    // Prepare SQL insert statement
    $sql = "INSERT INTO sme_data_add (
        Name_ipo, Issue_Price, Face_Value, Registrar, Listing_at_Group, 
        Lead_Manager, Market_Lot, Issue_Size, Subscription,
        Listing_Date, Allotment_Date, Close_Date, Open_Date
    ) VALUES (
        :name_ipo, :issue_price, :face_value, :registrar, :listing_group,
        :lead_manager, :market_lot, :issue_size, :subscription,
        :listing_date, :allotment_date, :close_date, :open_date
    )";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name_ipo', $name_ipo);
    $stmt->bindParam(':issue_price', $issue_price);
    $stmt->bindParam(':face_value', $face_value);
    $stmt->bindParam(':registrar', $registrar);
    $stmt->bindParam(':listing_group', $listing_group);
    $stmt->bindParam(':lead_manager', $lead_manager);
    $stmt->bindParam(':market_lot', $market_lot);
    $stmt->bindParam(':issue_size', $issue_size);
    $stmt->bindParam(':subscription', $subscription);
    $stmt->bindParam(':listing_date', $listing_date);
    $stmt->bindParam(':allotment_date', $allotment_date);
    $stmt->bindParam(':close_date', $close_date);
    $stmt->bindParam(':open_date', $open_date);

    // Execute
    if ($stmt->execute()) {
        echo "<script>alert('SME IPO data inserted successfully!'); window.location.href='add_sme.php';</script>";
    } else {
        echo "Error inserting data.";
    }
} catch (PDOException $e) {
    echo "Connection failed or query error: " . $e->getMessage();
}
?>
