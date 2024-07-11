<?php
session_start();
include("../conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}

// Archive profiles with age > 30
$archive_profiles = "INSERT INTO profiles_archive (SELECT * FROM profiles WHERE age > 30)";

if (mysqli_query($conn, $archive_profiles)) {
    $delete_archived_profiles = "DELETE FROM profiles WHERE age > 30";
    if (!mysqli_query($conn, $delete_archived_profiles)) {
        $message = "Error deleting archived profiles: " . mysqli_error($conn);
    }
} else {
    $message = "Error archiving profiles: " . mysqli_error($conn);
}

// Move profiles with age < 30 back to profiles
$move_back_profiles = "INSERT INTO profiles (SELECT * FROM profiles_archive WHERE age < 31)";
if (mysqli_query($conn, $move_back_profiles)) {
    $delete_moved_back_profiles = "DELETE FROM profiles_archive WHERE age < 31";
    if (!mysqli_query($conn, $delete_moved_back_profiles)) {
        $message = "Error deleting moved-back profiles: " . mysqli_error($conn);
    }
} else {
    $message = "Error moving back profiles: " . mysqli_error($conn);
}

// Fetch profiles to display
$fetch_profiles = "SELECT id, fname, mname, lname, suffix, email FROM profiles_archive WHERE age > 30";
$result = mysqli_query($conn, $fetch_profiles);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Datatables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <div class="logo-header" data-background-color="dark">
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item">
                        <a href="temp_homepage.php" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas icon-people"></i>
                            <p>Youth Profiles</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="temp_profiles.php">
                                        <span class="sub-item" active>Create/View Profiles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="temp_archive.php">
                                        <span class="sub-item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#forms">
                            <i class="fas icon-user"></i>
                            <p>User Accounts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="temp_accounts.php">
                                        <span class="sub-item">View Accounts</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="temp_createacc.php">
                                        <span class="sub-item">Create Account</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="calendar.php">
                            <i class="fas icon-calendar"></i>
                            <p>Calendar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="temp_recycle.php">
                            <i class="fas icon-trash"></i>
                            <p>Recycle Bin</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20"/>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"></nav>
                    <h3>La Trinidad Youth Profiling System</h3>
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle"/>
                                </div>
                                <span class="profile-username">
                                    <span class="op-7">Hi,</span>
                                    <span class="fw-bold"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"/>
                                            </div>
                                            <div class="u-text">
                                                <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                                                <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <a class="dropdown-item" href="logout.php">Logout</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        

        
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Archive</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="basic-datatables_length">
                                        <label>Show 
                                            <select name="basic-datatables_length" aria-controls="basic-datatables" class="form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="basic-datatables_filter" class="dataTables_filter">
                                        <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatables"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 365.516px;">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 541.766px;">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 287.266px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td>
                                            <div class="form-button-action">
                                            <form action="temp_update_archive.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="update" class="btn btn-link btn-success">
                                                    <i class="fa fa-edit"></i>
                                                    </button>
                                                </form>
                                                <form action="temp_delete_archive.php" method="post" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" name="delete" class="btn btn-link btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="basic-datatables_info" role="status" aria-live="polite">Showing 1 to 10 of <?php echo mysqli_num_rows($result); ?> entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="basic-datatables_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="basic-datatables_previous">
                                                <a href="#" aria-controls="basic-datatables" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                            </li>
                                            <li class="paginate_button page-item active">
                                                <a href="#" aria-controls="basic-datatables" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                            </li>
                                            <!-- Pagination buttons would go here -->
                                            <li class="paginate_button page-item next" id="basic-datatables_next">
                                                <a href="#" aria-controls="basic-datatables" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core JS Files -->
        <script src="assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <!-- jQuery Scrollbar -->
        <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script src="assets/js/kaiadmin.min.js"></script>
    </div>
</body>
</html>



<?php
mysqli_close($conn);
?>
<?php
if (isset($_POST['submit'])) {
    // Retrieve form data
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $purok = $_POST['purok'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];
    $voted_last_election = $_POST['voted_last_election'];
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = $_POST['times_attended_kk'];

    $insert = "INSERT INTO profiles 
            (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
             sex, age, email, birth_date, contactnumber, civil_status, youth_classification,
             age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
             '$sex', '$age', '$email', '$birth_date', '$contactnumber', '$civil_status', '$youth_classification',
             '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$attended_kk', '$times_attended_kk')";

    $result = mysqli_query($conn, $insert);

    if (!$result) {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}
                                    
                                    
?> 