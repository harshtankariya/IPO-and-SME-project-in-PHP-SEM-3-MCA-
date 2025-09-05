<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - IPO Tracker</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #f75f1e;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control:focus {
            border-color: #f75f1e;
            box-shadow: 0 0 0 0.2rem rgba(247, 95, 30, 0.25);
        }
        .btn-login {
            background-color: #f75f1e;
            color: white;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 10px;
        }
        .btn-login:hover {
            background-color: #e35418;
        }
        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }
        .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <!-- Logo Image -->
        <img src="ipo_logo_project.png" alt="Logo" class="logo">
        
        <h2>Admin Login</h2>
        
        <!-- Show message from backend if login fails -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center p-2">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="admin_login.php" method="POST">
            <div class="mb-3">
                <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID" placeholder="Enter your Admin ID" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>
        
        <div class="forgot-password">
            <a href="#">Forgot user ID or password?</a>
        </div>

        <div class="forgot-password">
            <a href="home.php">⬅ Back to Home Page</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
