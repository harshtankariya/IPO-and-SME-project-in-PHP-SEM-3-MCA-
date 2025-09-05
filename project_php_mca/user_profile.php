<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile Settings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e0f7fa, #ffffff);
      font-family: 'Segoe UI', sans-serif;
    }

    .profile-container {
      max-width: 750px;
      margin: 50px auto;
      padding: 30px;
      border: none;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
      background-color: #ffffff;
    }

    .avatar-img {
      width: 100px;
      height: 100px;
      border-radius: 10px;
      object-fit: cover;
      border: 2px solid #17a2b8;
    }

    .form-label {
      font-weight: 600;
      color: #333;
    }

    .btn-primary {
      background-color: #17a2b8;
      border-color: #17a2b8;
    }

    .btn-primary:hover {
      background-color: #138496;
      border-color: #138496;
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    .section-title {
      margin-top: 50px;
      margin-bottom: 20px;
      color: #17a2b8;
    }

    p {
      color: #555;
    }

    input.form-control {
      border-radius: 8px;
    }
  </style>
</head>
<body>

<div class="container profile-container">
  <h4 class="mb-4 text-center text-info">Personal Information</h4>
  
  <!-- <div class="row mb-4">
    <div class="col-md-3 text-center">
      <img src="https://via.placeholder.com/100" alt="avatar" class="avatar-img">
    </div>
    <div class="col-md-9 d-flex align-items-center">
      <div>
        <button class="btn btn-secondary btn-sm change-avatar-btn">Change avatar</button>
        <p class="text-muted mt-2">JPG, GIF or PNG. 1MB max.</p>
      </div>
    </div>
  </div> -->

  <form>
    <div class="row mb-3">
      <div class="col">
        <label class="form-label">First name</label>
        <input type="text" class="form-control">
      </div>
      <div class="col">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control">
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" class="form-control" placeholder="example.com/janesmith">
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>

  <!-- Change Password Section -->
  <h5 class="section-title">Change password</h5>
  <p>Update your password associated with your account.</p>
  <form>
    <div class="mb-3">
      <label class="form-label">Current password</label>
      <input type="password" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">New password</label>
      <input type="password" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm password</label>
      <input type="password" class="form-control">
    </div>
    <button class="btn btn-primary">Save</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

