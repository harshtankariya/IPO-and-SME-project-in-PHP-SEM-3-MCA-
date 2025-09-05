<?php
session_start();

$host = 'localhost';
$port = 3307; 
$dbname = 'harsh_mca_php_project';
$username = 'root';
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname , $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['userID'];
    $password = $_POST['password'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM admin_users WHERE admin_id = ?");
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (hash('sha256', $password) === $hashed_password) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin_id;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location='admin_login_form.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid user ID!'); window.location='admin_login_form.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
