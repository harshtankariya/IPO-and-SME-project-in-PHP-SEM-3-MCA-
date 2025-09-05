<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IPO Data Entry Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f2f4f7; margin: 0; }
        .sidebar { width: 250px; height: 100vh; background-color: #E3F2FD; padding-top: 20px; }
        .sidebar a { padding: 20px; display: block; font-weight: 500; color: #0d6efd; text-decoration: none; transition: all 0.3s; }
        .sidebar a:hover { background-color: #BBDEFB; color: #000; border-left: 5px solid #0d6efd; }
        .nav-heading { padding: 0 25px; font-weight: bold; color: #333; margin-bottom: 20px; }
        .form-container { max-width: 900px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 0 25px rgba(0, 0, 0, 0.1); width: 100%; }
        .form-label { font-weight: 600; }
        .btn-action { min-width: 120px; font-weight: bold; }
        .btn-create { background-color: #28a745; color: white; }
        .btn-create:hover { background-color: #218838; }
        .btn-select { background-color: #17a2b8; color: white; }
        .btn-select:hover { background-color: #117a8b; }
        @media (max-width: 768px) {
            .d-flex { flex-direction: column; }
            .sidebar { width: 100%; height: auto; }
            .form-container { margin: 20px; }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="nav-heading">Admin Panel</div>
            <a href="admin_dashboard.php"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="add_ipo.php"><i class="bi bi-file-earmark-plus me-2"></i> Add IPO</a>
            <a href="add_sme.php"><i class="bi bi-file-earmark-plus me-2"></i> Add SME</a>
            <a href="demo_display.php"><i class="bi bi-table me-2"></i> View Records</a>
            <a href="home.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
        </div>

        <div class="container-fluid">
            <div class="form-container shadow">
                <h2 class="text-center mb-4">IPO Data Entry Form</h2>
                <form action="ipo_data.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Issue Price</label>
                            <input type="number" step="0.01" name="issue_price" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Face Value</label>
                            <input type="number" step="0.01" name="face_value" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Registrar</label>
                            <input type="text" name="registrar" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Listing at Group</label>
                            <input type="text" name="listing_group" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Lead Manager</label>
                            <input type="text" name="lead_manager" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Market Lot</label>
                            <input type="number" name="market_lot" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Issue Size</label>
                            <input type="text" name="issue_size" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">IPO Name </label>
                            <input type="text" name="retail_portion" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Subscription</label>
                            <input type="text" name="subscription" class="form-control" required>
                        </div>

                   <div class="col-md-6">
                        <label class="form-label">Open Date</label>
                        <input type="date" id="open_date" name="open_date" class="form-control" required>
                    </div>
                    </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Allotment Date</label>
                        <input type="date" id="allotment_date" name="allotment_date" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Close Date</label>
                        <input type="date" id="close_date" name="close_date" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Listing Date</label>
                        <input type="date" id="listing_date" name="listing_date" class="form-control" required>
                    </div>
                </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split("T")[0];

        const openDate = document.getElementById("open_date");
        const closeDate = document.getElementById("close_date");
        const allotmentDate = document.getElementById("allotment_date");
        const listingDate = document.getElementById("listing_date");

        // Default all dates to today & prevent past selection
        [openDate, closeDate, allotmentDate, listingDate].forEach(input => {
            input.min = today;
            input.value = today;
        });

        // Chain validation
        openDate.addEventListener("change", function () {
            closeDate.min = this.value;
            if (closeDate.value < this.value) closeDate.value = this.value;
        });

        closeDate.addEventListener("change", function () {
            allotmentDate.min = this.value;
            if (allotmentDate.value < this.value) allotmentDate.value = this.value;
        });

        allotmentDate.addEventListener("change", function () {
            listingDate.min = this.value;
            if (listingDate.value < this.value) listingDate.value = this.value;
        });
    });
</script>

                    <div class="text-center mt-4 d-flex flex-row align-items-center gap-3">
                        <button type="submit" name="action" value="create" class="btn btn-create btn-action">Create</button>
                        <button type="reset" class="btn btn-select btn-action">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
