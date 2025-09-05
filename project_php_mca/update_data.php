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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $ipo_id         = $_POST['IPO_ID']; // <-- now matching hidden field
        $name_ipo       = $_POST['ipo_name'];
        $issue_price    = $_POST['issue_price'];
        $face_value     = $_POST['face_value'];
        $registrar      = $_POST['registrar'];
        $listing_group  = $_POST['listing_group'];
        $lead_manager   = $_POST['lead_manager'];
        $market_lot     = $_POST['market_lot'];
        $issue_size     = $_POST['issue_size'];
        $subscription   = $_POST['subscription'];
        $listing_date   = $_POST['listing_date'];
        $allotment_date = $_POST['allotment_date'];
        $close_date     = $_POST['close_date'];
        $open_date      = $_POST['open_date'];

        $sql = "UPDATE sme_data_add 
                SET Name_ipo = :name_ipo, Issue_Price = :issue_price, Face_Value = :face_value,
                    Registrar = :registrar, Listing_at_Group = :listing_group, Lead_Manager = :lead_manager,
                    Market_Lot = :market_lot, Issue_Size = :issue_size, Subscription = :subscription,
                    Listing_Date = :listing_date, Allotment_Date = :allotment_date, 
                    Close_Date = :close_date, Open_Date = :open_date
                WHERE IPO_ID = :ipo_id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':ipo_id', $ipo_id, PDO::PARAM_INT);
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

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Record updated successfully!'); window.location.href='sme_disp_admin.php';</script>";
            } else {
                echo "<script>alert('No changes made. Record already up-to-date.'); window.location.href='sme_disp_admin.php';</script>";
            }
        } else {
            echo "Error updating record.";
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
