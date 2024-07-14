<?php
session_start();
include("../conne.php");

// Ensure session email is set, otherwise redirect
if (!isset($_SESSION['email'])) {
  header("location: bootstrap/temp_index.php");
  exit(); // Ensure that no further code is executed after the redirection
}
if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
} else {
  // Handle case where role is not set (e.g., redirect or error message)
  echo "Role information not found. Please contact administrator.";
  exit();
}
$barangay_code = "";
$code = $_SESSION['code'];
$fetch_barangay = "SELECT * FROM barangay WHERE CODE = '$_SESSION[code]'";
$fetch_barangay_result = mysqli_query($conn, $fetch_barangay);
while($row = mysqli_fetch_assoc($fetch_barangay_result)){
  $barangay_code = $row['Brngy'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title></title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
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

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link rel="stylesheet" href="../assets/css/demo.css" /> -->
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
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
        <!-- End Logo Header -->
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
            <?php        
               if ($role == 'admin' || $role == 'superadmin') {
                echo '
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
              </li>';
               }
               ?>


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
          <!-- Logo Header -->
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
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"></nav>
            <h3><?php echo $barangay_code; ?> La Trinidad Youth Profiling System</h3>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <span class="profile-username">
                  <span class="fw-bold"><?php echo $_SESSION['email']; ?></span>
                </span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg">
                        <img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                      </div>
                      <div class="u-text">
                        <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                        <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <?php if ($role == 'superadmin') { echo '<a class="dropdown-item" href="#">Account Setting</a>'; } ?>
                    <a class="dropdown-item" href="temp_logout.php">Logout</a>
                  </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <!-- main content -->
      <div class="container">
        <div class="page-inner">
          <div class="page-header">
            <h3 class="fw-bold mb-3">Youth Profiles</h3>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="ms-auto">
                    <button id="newProfile" style="float:inline-start" class="btn btn-primary btn-round ms-auto"
                      data-bs-toggle="modal" data-bs-target="#addRowModal">
                      <i class="fa fa-plus"></i>
                      New Profile
                    </button>
                    <button id="importBtn" style="float:inline-end" class="btn btn-primary btn-round ms-auto1"
                      data-bs-toggle="modal" data-bs-target="#importModal">
                      <i class="fa fa-file-import"></i>
                      Import
                    </button>
                  </div>
                </div>
                <!-- import csv modal -->
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header border-0">
                        <h5 class="modal-title">
                          <span class="fw-mediumbold">Import</span>
                          <span class="fw-light">Profiles</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="../upload.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="csvFile">Choose CSV File:</label>
                            <input type="file" name="csvFile" id="csvFile" accept=".csv" class="form-control" required>
                          </div>
                          <button type="submit" name="upload" class="btn btn-primary mt-3"
                            style="float: right">Upload</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <!-- new profile modal -->
                  <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <h5 class="modal-title">
                            <span class="fw-mediumbold"> New</span>
                            <span class="fw-light"> Profile </span>
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <!-- contents of create profile/ CRUD -->
                        <div class="modal-body">
                          <form method="POST">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Full Name: </label>
                                  <input id="addName" type="text" class="form-control" placeholder="Last Name" name="lname" required />
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <input id="addName" type="text" class="form-control" placeholder="First Name" name="fname" required />
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <input id="addName" type="text" class="form-control" placeholder="Middle Name" name="mname" />
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <input id="addName" type="text" class="form-control" placeholder="Suffix" name="suffix" />
                                </div>
                              </div>
                              <div class="col-md-6 pe-0">
                                <div class="form-group form-group-default">
                                  <label>Address:</label>
                                  <input type="text" class="form-control" placeholder="Region" name="region" required />
                                </div>
                                <div class="form-group form-group-default">
                                  <input type="text" class="form-control" placeholder="Municipality" name="municipality" required />
                                </div>
                                <div class="form-group form-group-default">
                                  <input type="text" class="form-control" placeholder="Sitio" name="sitio" required />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>&nbsp;</label>
                                  <input type="text" class="form-control" placeholder="Province" name="province" required />
                                </div>
                                <div class="form-group form-group-default">
                                  <input type="text" class="form-control" placeholder="Barangay" name="barangay" required />
                                </div>
                                <div class="form-group form-group-default">
                                  <input type="text" class="form-control" placeholder="Purok and/or House #" name="purok" required />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Birthdate:</label>
                                  <div>
                                    <select id="birth_month" name="birth_month" required onchange="calculateAge()">
                                      <option value="">Month</option>
                                      <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                        <option value="<?php echo $m; ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                                        </option>
                                      <?php } ?>
                                    </select>
                                    <select id="birth_day" name="birth_day" required onchange="calculateAge()">
                                      <option value="">Day</option>
                                      <?php for ($d = 1; $d <= 31; ++$d) { ?>
                                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                      <?php } ?>
                                    </select>
                                    <input type="number" id="birth_year" name="birth_year" placeholder="Year" required
                                      oninput="calculateAge()">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Age:</label>
                                  <input id="age" type="number" class="form-control" name="age" required readonly />
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Sex:</label>
                                  <div class="d-flex">
                                    <input type="radio" name="sex" value="Male" required>&nbsp;&nbsp;Male
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="Female" required>&nbsp;&nbsp;Female
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Youth with Specific Needs:</label>
                                  <input type="text" class="form-control" name="youth_with_needs" />
                                </div>
                                <div class="form-group form-group-default">
                                  <label>Email:</label>
                                  <input type="email" class="form-control" placeholder="user@sample.com" name="email" />
                                </div>
                                <div class="form-group form-group-default">
                                  <label>Contact Number:</label>
                                  <input type="text" class="form-control" placeholder="091234567" name="contactnumber" />
                                </div>
                              </div>
                              <script>
                                function calculateAge() {
                                  var birth_month = document.getElementById("birth_month").value;
                                  var birth_day = document.getElementById("birth_day").value;
                                  var birth_year = document.getElementById("birth_year").value;
                                  var ageGroup = '';

                                  // Check if all birthdate parts are selected
                                  if (birth_month && birth_day && birth_year) {
                                    // Create birthdate in Manila time zone
                                    var birthDate = new Date(birth_year, birth_month - 1, birth_day, 0, 0, 0);
                                    var today = new Date(); // This gets current date in local time zone

                                    // Convert today's date to Manila time zone
                                    var todayManila = new Date(today.toLocaleString('en-US', { timeZone: 'Asia/Manila' }));

                                    // Calculate age
                                    var age = todayManila.getFullYear() - birthDate.getFullYear();
                                    var monthDiff = todayManila.getMonth() - birthDate.getMonth();

                                    if (monthDiff < 0 || (monthDiff === 0 && todayManila.getDate() < birthDate.getDate())) {
                                      age--;
                                    }

                                    document.getElementById("age").value = age;

                                    // Set age group based on age
                                    if (age >= 15 && age <= 17) {
                                      ageGroup = 'Child Youth';
                                    } else if (age >= 18 && age <= 24) {
                                      ageGroup = 'Core Youth';
                                    } else if (age >= 25 && age <= 30) {
                                      ageGroup = 'Young Adult';
                                    }

                                    // Check the appropriate radio button for age_group
                                    var radios = document.getElementsByName('age_group');
                                    for (var i = 0; i < radios.length; i++) {
                                      if (radios[i].value === ageGroup) {
                                        radios[i].checked = true;
                                      }
                                    }
                                  } else {
                                    // Clear age if birthdate is not fully selected
                                    document.getElementById("age").value = "";
                                  }

                                  return ageGroup ?? '';
                                }
                              </script>
                              <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                  <label>Educational Background:</label>
                                  <input type="radio" name="educational_background" value="Elementary Level"> Elementary Level<br>
                                  <input type="radio" name="educational_background" value="Elementary Graduate"> Elementary Graduate<br>
                                  <input type="radio" name="educational_background" value="High School Level"> High School Level<br>
                                  <input type="radio" name="educational_background" value="High School Graduate"> High School Graduate<br>
                                  <input type="radio" name="educational_background" value="Vocational Graduate"> Vocational Graduate<br>
                                  <input type="radio" name="educational_background" value="College Level"> College Level<br>
                                  <input type="radio" name="educational_background" value="College Graduate"> College Graduate<br>
                                  <input type="radio" name="educational_background" value="Master's Level"> Master's Level<br>
                                  <input type="radio" name="educational_background" value="Master's Graduate"> Master's Graduate<br>
                                  <input type="radio" name="educational_background" value="Doctorate Level"> Doctorate Level<br>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Civil Status:</label>
                                  <input type="radio" name="civil_status" value="Single" required> Single<br>
                                  <input type="radio" name="civil_status" value="Married" required> Married<br>
                                  <input type="radio" name="civil_status" value="Divorced" required> Divorced<br>
                                  <input type="radio" name="civil_status" value="Widowed" required> Widowed<br>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Youth Classification:</label>
                                  <input type="radio" name="youth_classification" value="In School Youth" required> In School Youth<br>
                                    <input type="radio" name="youth_classification" value="Out Of School Youth" required> Out Of School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" required> Working Youth<br>
                                    <input type="radio" name="youth_classification" value="Person With Disability (PWD)" required> Person With Disability (PWD)<br>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Work Status:</label>
                                    <input type="radio" name="work_status" value="Student" required> Student<br>
                                    <input type="radio" name="work_status" value="Employed" required> Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" required> Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" required> Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" required> Currently Looking For Job<br>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Registered SK Voter:</label>
                                  <div class="d-flex">
                                    <input type="radio" name="register_sk_voter" value="Yes" required>&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="register_sk_voter" value="No" required>&nbsp;No
                                  </div>
                                </div>
                                <div class="form-group form-group-default">
                                  <label>Voted Last SK Election:</label>
                                  <div class="d-flex">
                                    <input type="radio" name="voted_last_election" value="Yes" required>&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"
                                    name="voted_last_election" value="No" required>&nbsp;No
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>National Voter:</label>
                                  <div class="d-flex">
                                    <input type="radio" name="national_voter" value="Yes" required>&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"
                                    name="national_voter" value="No" required>&nbsp;No
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>Attended KK Activities:</label>
                                  <div class="d-flex">
                                    <input type="radio" name="attended_kk" value="Yes" required>&nbsp;Yes
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"
                                      name="attended_kk" value="No" required>&nbsp;No
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>KK Activities Attended:</label>
                                  <input type="number" name="times_attended_kk" value="">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group form-group-default">
                                  <label>If no, why?</label>
                                  <input type="text" name="why" value="">
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                          <button type="submit" id="addRowButton" class="btn btn-primary" name="submitAdd">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>
                  <!-- end of modal -->
                  <!-- fetch rows -->
                  <div class="table-responsive">
                    <form id="profilesForm" method="POST" action="temp_delete_multiple.php">
                      <table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
                        <thead>
                          <tr role="row">
                            <th tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 30.516px;">
                              <button type="d" class="btn btn-default" data-bs-toggle="tooltip" title="Delete Selected" onclick="return confirm('Are you sure you want to delete the selected profiles?');">
                                <i style="font-size: 17pt" class="fa fa-trash-alt"></i>
                              </button>
                            </th>
                            <th class="sorting_asc" tabindex="1" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 541.766px;">Name</th>
                            <th tabindex="2" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 365.516px;">Email</th>
                            <th tabindex="3" rowspan="1" colspan="1" style="width: 200.266px;"><center>Actions</center></th>
                          </tr>
                        </thead>
                        <?php
                          $recordsPerPage = 20;
                          $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                          $offset = ($currentPage - 1) * $recordsPerPage;

                          if (isset($_GET['search'])) {
                            $searchQuery = $_GET['search'];
                            $sql = "SELECT * FROM profiles 
                                    WHERE fname LIKE '%$searchQuery%' OR lname LIKE '%$searchQuery%' OR mname LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' 
                                    ORDER BY id DESC 
                                    LIMIT $recordsPerPage OFFSET $offset";
                          } else {
                            $sql = "SELECT * FROM profiles 
                                    ORDER BY id DESC ";
                          }

                          $result = mysqli_query($conn, $sql);

                          $totalCountSql = "SELECT COUNT(*) AS total FROM profiles";
                          $totalCountResult = mysqli_query($conn, $totalCountSql);
                          $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                          $totalCount = $totalCountRow['total'];
                          $totalPages = ceil($totalCount / $recordsPerPage);
                          if ($result && mysqli_num_rows($result) > 0) {
                          $results = [];
                        ?>
                          <tbody>
                            <!-- Modal structure -->
                            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog"
                              aria-labelledby="modal-default" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title fw-bold" id="modal-title-default">User Details</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <p id="modal-body-content">User details go here...</p>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- PHP and table code from above -->
                            <div class="section">
                              <form id="profilesForm" method="POST" action="temp_profiles.php">
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                  <tr>
                                    <td>
                                      <center>
                                        <input type="checkbox" name="selectedProfiles[]" value="<?= $row['id']; ?>">
                                      </center>
                                    </td>
                                    <td>
                                      <a href="#" class="profileNameLink" data-id="<?= $row['id']; ?>"
                                        data-fullname="<?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?>"
                                        data-address="<?= $row['region'] . ' ' . $row['province'] . ' ' . $row['municipality'] . ' ' . $row['barangay'] . ' ' . $row['sitio'] . ' ' . $row['purok']; ?>"
                                        data-sex="<?= $row['sex']; ?>" data-age="<?= $row['age']; ?>"
                                        data-email="<?= $row['email']; ?>"
                                        data-birthday="<?= $row['birth_month'] . '/' . $row['birth_day'] . '/' . $row['birth_year']; ?>"
                                        data-youth_with_needs="<?= $row['youth_with_needs']; ?>"
                                        data-contact_number="<?= $row['contactnumber']; ?>"
                                        data-civil_status="<?= $row['civil_status']; ?>"
                                        data-age_group="<?= $row['age_group']; ?>"
                                        data-educational_background="<?= $row['educational_background']; ?>"
                                        data-youth_classification="<?= $row['youth_classification']; ?>"
                                        data-work_status="<?= $row['work_status']; ?>"
                                        data-national_voter="<?= $row['national_voter']; ?>"
                                        data-register_sk_voter="<?= $row['register_sk_voter']; ?>"
                                        data-voted_last_election="<?= $row['voted_last_election']; ?>"
                                        data-times_attended="<?= $row['times_attended_kk']; ?>"
                                        data-national_voter="<?= $row['national_voter']; ?>"
                                        data-reason="<?= $row['no_why']; ?>" data-bs-toggle="modal"
                                        data-bs-target="#modal-default"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></a>
                                    </td>
                                    <td>
                                      <p style="text-transform:lowercase"><?= $row['email']; ?></p>
                                    </td>
                                    <td>
                                      <center>
                                        <a href="temp_update.php?id=<?= $row['id']; ?>" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                        <a href="temp_delete.php?id=<?= $row['id']; ?>" class="btn btn-link btn-danger" title="Remove" data-bs-toggle="tooltip"
                                          onclick="return confirm('Are you sure you want to delete this profile?');"><i
                                            class="fa fa-times"></i></a>
                                      </center>
                                    </td>
                                  </tr>
                                <?php } ?>
                              </form>
                            </div>

                            <script>
                              document.addEventListener('DOMContentLoaded', function () {
                                document.querySelectorAll('.profileNameLink').forEach(function (link) {
                                  link.addEventListener('click', function () {
                                    var fullName = this.getAttribute('data-fullname');
                                    var address = this.getAttribute('data-address');
                                    var sex = this.getAttribute('data-sex');
                                    var age = this.getAttribute('data-age');
                                    var birthday = this.getAttribute('data-birthday');
                                    var youthWithNeeds = this.getAttribute('data-youth_with_needs');
                                    var email = this.getAttribute('data-email');
                                    var contactNumber = this.getAttribute('data-contact_number');
                                    var civilStatus = this.getAttribute('data-civil_status');
                                    // var ageGroup = this.getAttribute('data-age_group');
                                    var educationalBackground = this.getAttribute('data-educational_background');
                                    var youthClassification = this.getAttribute('data-youth_classification');
                                    var workStatus = this.getAttribute('data-work_status');
                                    var nationalVoter = this.getAttribute('data-national_voter');
                                    var registeredSkVoter = this.getAttribute('data-register_sk_voter');
                                    var votedLastElection = this.getAttribute('data-voted_last_election');
                                    var timesAttended = this.getAttribute('data-times_attended');
                                    var reason = this.getAttribute('data-reason');

                                    var bday = new Date(birthday);
                                    var today = new Date();
                                    // Calculate the difference in years
                                    var age = today.getFullYear() - bday.getFullYear();

                                    // Adjust for partial years
                                    var monthDiff = today.getMonth() - bday.getMonth();
                                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bday.getDate())) {
                                      age--;
                                    }

                                    var ageGroup = '';
                                    // Set age group based on age
                                    if (age >= 15 && age <= 17) {
                                      ageGroup = 'Child Youth';
                                    } else if (age >= 18 && age <= 24) {
                                      ageGroup = 'Core Youth';
                                    } else if (age >= 25 && age <= 30) {
                                      ageGroup = 'Young Adult';
                                    }

                                    var modalContent = `
                                        <p><strong>Full Name:</strong> ${fullName}</p>
                                        <p><strong>Address:</strong> ${address}</p>
                                        <p><strong>Sex:</strong> ${sex}</p>
                                        <p><strong>Age:</strong> ${age}</p>
                                        <p><strong>Birthday:</strong> ${birthday}</p>
                                        <p><strong>Youth with Needs:</strong> ${youthWithNeeds}</p>
                                        <p><strong>Email:</strong> ${email}</p>
                                        <p><strong>Contact Number:</strong> ${contactNumber}</p>
                                        <p><strong>Civil Status:</strong> ${civilStatus}</p>
                                        <p><strong>Age Group:</strong> ${ageGroup}</p>
                                        <p><strong>Educational Background:</strong> ${educationalBackground}</p>
                                        <p><strong>Youth Classification:</strong> ${youthClassification}</p>
                                        <p><strong>Work Status:</strong> ${workStatus}</p>
                                        <p><strong>National Voter:</strong> ${nationalVoter}</p>
                                        <p><strong>Registered SK Voter:</strong> ${registeredSkVoter}</p>
                                        <p><strong>Voted Last Election:</strong> ${votedLastElection}</p>
                                        <p><strong>Times Attended:</strong> ${timesAttended}</p>
                                        <p><strong>If no, why?</strong> ${reason}</p>
                                      `;

                                    document.getElementById('modal-body-content').innerHTML = modalContent;
                                  });
                                });
                              });
                            </script>


                            <!-- <div class="form-button-action">
                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" >
                                </button>
                                <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" >
                                </button>
                              </div>
                    
                            </div> -->
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--   Core JS Files   -->
      <script src="assets/js/core/jquery-3.7.1.min.js"></script>
      <script src="assets/js/core/popper.min.js"></script>
      <script src="assets/js/core/bootstrap.min.js"></script>

      <!-- jQuery Scrollbar -->
      <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
      <!-- Datatables -->
      <script src="assets/js/plugin/datatables/datatables.min.js"></script>
      <!-- Kaiadmin JS -->
      <script src="assets/js/kaiadmin.min.js"></script>
      <script>
        $(document).ready(function () {
          $("#basic-datatables").DataTable({});
          $("#multi-filter-select").DataTable({
            pageLength: 5,
            initComplete: function () {
              this.api()
                .columns()
                .every(function () {
                  var column = this;
                  var select = $(
                    '<select class="form-select"><option value=""></option></select>'
                  )
                    .appendTo($(column.footer()).empty())
                    .on("change", function () {
                      var val = $.fn.dataTable.util.escapeRegex($(this).val());

                      column
                        .search(val ? "^" + val + "$" : "", true, false)
                        .draw();
                    });

                  column
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                      select.append(
                        '<option value="' + d + '">' + d + "</option>"
                      );
                    });
                });
            },
          });

          // Add Row
          $("#add-row").DataTable({
            pageLength: 5,
          });

          var action =
            '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

          $("#addRowButton").click(function () {
            $("#add-row")
              .dataTable()
              .fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action,
              ]);
            $("#addRowModal").modal("hide");
          });
        });
      </script>
  </body>

  </html>

  <?php
  if (isset($_POST['submitAdd'])) {
    // Retrieve form data
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sitio = $_POST['sitio'];
    $purok = $_POST['purok'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $youth_with_needs = $_POST['youth_with_needs'];
    $email = $_POST['email'];
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    $birth_year = $_POST['birth_year'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];
    $voted_last_election = $_POST['voted_last_election'];
    $national_voter = $_POST['national_voter'];
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = $_POST['times_attended_kk'];
    $no_why = $_POST['no_why'];
    // $date_created = $_POST['date_created'];
    $barangay_code = $_SESSION['code'];

    $insert = "INSERT INTO profiles 
            (lname, fname, mname, suffix, region, province, municipality, barangay, sitio, purok,
             sex, age, youth_with_needs, email, birth_month, birth_day, birth_year,  contactnumber, civil_status, youth_classification,
             age_group, work_status, educational_background, register_sk_voter, voted_last_election, national_voter, attended_kk, times_attended_kk, no_why,barangay_code)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay','$sitio', '$purok',
             '$sex', '$age', '$youth_with_needs', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
             '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$national_voter', '$attended_kk', '$times_attended_kk', '$no_why','$barangay_code')";

    $result = mysqli_query($conn, $insert);

    if ($result) {
      header("location:temp_profiles.php");
    }
  }
}

?>