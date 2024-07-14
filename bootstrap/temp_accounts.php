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

// for barangay code
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
    <title>YOUTH PROFILING SYSTEM</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

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
    <style>
      #profilesForm {
        padding-top: 55px;
        padding-right: 3%;
        padding-left: 3%;
      }
    </style>
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
             
            <?php
        // Display links based on user's role
        if ($role == 'admin' || $role == 'user') {
            echo '              
            <li class="nav-item">
                <a
                  href="temp_homepage.php"
                  aria-expanded="false"
                >
                  <i class="fas fa-chart-bar"></i>
                  <p>Dashboard</p>
                </a>
              </li>';
        } 
        ?>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
              <?php
                      // Display links based on user's role
        if ( $role == 'user') {
          echo ' <a data-bs-toggle="collapse" href="#tables">
                <i class="fas icon-people"></i>
                <p>Youth Profiles</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="temp_profiles.php">
                      <span class="sub-item">Create/View Profiles</span>
                    </a>
                  </li>
                  <li>
                    <a href="temp_archive.php">
                      <span class="sub-item">Archive</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>';
      } 
      ?>
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
              <?php
            if ($role == 'user') {
              echo '<a href="temp_recycle.php">
                <i class="fas icon-trash"></i>
                <p>Recycle Bin</p>
              </a>';
            }
                    ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
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
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              </nav>
              <h2><?php echo $barangay_code; ?>La Trinidad Youth Profiling System</h2>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar-sm">
                      <img
                        src="assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
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
                            <img
                              src="assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                            
                            <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                            <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <?php
                        if ( $role == 'superadmin') {
                          echo
                        '<a class="dropdown-item" href="account_setting.php">Account Setting</a>';
                        }
                        ?>
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

        <div class="content">
        <h1>User Accounts</h1>
        <?php
        
        $current_user_email = $_SESSION['email'];
        $role = $_SESSION['role'];

        // Define the SQL query based on the role
        if ($role === 'superadmin') {
        // Superadmin can only see admin accounts
        $sql_fetch = "SELECT * FROM account WHERE role = 'admin' AND email != '$current_user_email'";
        } elseif ($role === 'admin') {
        // Admin can only see user accounts
        $sql_fetch = "SELECT * FROM account WHERE role = 'user' AND email != '$current_user_email'";
        } else {
        echo "Unauthorized access.";
        exit();
        }

    $sql_result = mysqli_query($conn, $sql_fetch);
    if ($sql_result && mysqli_num_rows($sql_result) > 0) {
        ?>
            <div class="section">
            <div class="table-responsive">
                <form id="profilesForm" method="POST" action="delete_multiple_acc.php">
                  <table class="table table-hover" id="add-row">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th><center>Actions</center></th>
                            <th><center>
                                <button type="submit" style="border-radius:0"class="btn btn-danger btn-delete" onclick="return confirm('Are you sure you want to delete the selected profiles?');">
                                    Delete Selected
                                </center></button>
                            </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($sql_result)) {
                            $id = $row['id'];
                            $lname = $row['LastName'];
                            $fname = $row['FirstName'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $fullName = $fname . ' ' . $lname;
                            ?>
                            <tr>
                                <td><?= $fullName; ?></td>
                                <td style="text-transform:lowercase"><?= $email; ?></td>
                                <td><?= $role; ?></td>
                                <td><center>
                                    <a href="temp_update_acc.php?id=<?= $id; ?>" class="btn btn-primary">Update</a>
                                    <a href="temp_delete_acc.php?id=<?= $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                                </center></td>
                                <td><center><input type="checkbox" name="selectedProfiles[]" value="<?= $id; ?>"></center></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <p>No accounts found.</p>
        <?php } ?>
    </div>

        <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
  </div>
  </div>
</body>
</html>