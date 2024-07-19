<?php
session_start();
include("../connection/conne.php");

// Redirect to index.php if user is not logged in
if (!isset($_SESSION['SUPERADMIN'])) {
  header("location:../index.php");
    exit();
}

$FirstName = $LastName = $email = $password = $cpassword = ""; 
$show_alert = false; 
$form_submitted = false; 

if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
} else {
  echo "Role information not found. Please contact administrator.";
  exit();
}

// Process form submission
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $FirstName = $_POST['fname'];
  $LastName = $_POST['lname'];
  $role = $_POST['role'];


  // Check if email already exists
  $check_query = "SELECT * FROM account WHERE email = '$email'";
  $check_result = mysqli_query($conn, $check_query);

  if (mysqli_num_rows($check_result) > 0) {
      echo "<script>alert('Email already exists');</script>";
  } else if ($password != $cpassword) {
      $show_alert = true;
  } else {
      // Hash the password using password_hash
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Insert new user into database
      $sql_insert = "INSERT INTO account(email, password, FirstName, LastName, role, code) 
                     VALUES('$email', '$hashed_password', '$FirstName', '$LastName', '$role', '$code')";
      $result_insert = mysqli_query($conn, $sql_insert);

      if ($result_insert) {
          $form_submitted = true;
          echo "<script>
                  alert('User Successfully Registered.');
                  window.location.href = 'createacc.php'; // Redirect to registration form
                </script>";
      } else {
          echo "<script>alert('Error registering user.');</script>";
      }
  }
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
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../bootstrap/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../bootstrap/assets/js/plugin/webfont/webfont.min.js"></script>
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
          urls: ["../bootstrap/assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../bootstrap/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../bootstrap/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../bootstrap/assets/css/kaiadmin.min.css" />

    <style>
        body {
            overflow: hidden;
        }
        .form-group i {
            position: absolute;
            right: 15px;
            top: calc(50% - 7px);
        }
        .showHidePw {
            cursor: pointer;
        }
        .full-height {
            height: 100vh;
        }
        .form-control {
            padding: 0.6rem 6rem;
            text-align: center;
        }
        .card shadow p-4 {
            margin-top: -4%;
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

        <!-- navbar -->
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">

 
              
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
              
              <li class="nav-item">
              
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas icon-user"></i>
                  <p>User Accounts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="accounts.php">
                        <span class="sub-item">View Accounts</span>
                      </a>
                    </li>
                    <li>
                      <a href="createacc.php">
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
              <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              </nav>
              <h3><?php echo $barangay_code; ?>La Trinidad Youth Profiling System</h3>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-sm">
                      <img src="../bootstrap/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
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
                            <img src="../bootstrap/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
                          </div>
                          <div class="u-text">
                          <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                          <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="account_setting.php">Account Setting</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>

        <div class="container mt-5 d-flex justify-content-center align-items-center full-height">
          <div class="card shadow p-4">
            <div class="card-body">
              <h2 class="card-header text-center">Registration</h2>
              <form id="registration-form" method="POST" action="createacc.php" autocomplete="off">
                <?php if (isset($_POST['submit']) && $password != $cpassword): ?>
                  <div class="alert alert-danger" role="alert">Passwords do not match.</div>
                <?php endif; ?>
                <div class="form-group position-relative">
                  <input class="form-control" type="text" name="fname" placeholder="Firstname" required value="<?php echo htmlspecialchars($FirstName); ?>">
                  <i class="uil uil-user"></i>
                </div>
                <div class="form-group position-relative">
                  <input class="form-control" type="text" name="lname" placeholder="Lastname" required value="<?php echo htmlspecialchars($LastName); ?>">
                  <i class="uil uil-user"></i>
                </div>
                <div class="form-group position-relative">
                  <input class="form-control" type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
                  <i class="uil uil-envelope"></i>
                </div>
                <div class="form-group position-relative">
                  <input class="form-control password" type="password" name="password" placeholder="Create a password" required>
                  <i class="uil uil-lock"></i>
                </div>
                <div class="form-group position-relative">
                  <input class="form-control password" type="password" name="cpassword" placeholder="Confirm a password" required>
                  <i class="uil uil-lock"></i>
                  <i class="uil uil-eye-slash showHidePw"></i>
                </div>
              <?php if ($role == 'superadmin'): ?>
              <input type="hidden" id="role" name="role" value="admin">
              <?php elseif ($role == 'admin'): ?>
              <input type="hidden" id="role" name="role" value="user">
              <?php endif; ?>

             
                        <i class="uil uil-user"></i>
                    </div>
                <div>
                  <input class="btn btn-primary" type="submit" name="submit" value="Register" style="float: right; margin-right: 10px">
                </div>
              </form>
            </div>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            if (<?php echo json_encode($form_submitted); ?>) {
              document.getElementById('registration-form').reset();
            }
          });

          // Password show/hide functionality
          const pwShowHide = document.querySelectorAll('.showHidePw');
          const pwFields = document.querySelectorAll('.password');

          pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener('click', () => {
              pwFields.forEach(pwField => {
                if (pwField.type === 'password') {
                  pwField.type = 'text';
                  pwShowHide.forEach(icon => {
                    icon.classList.replace('uil-eye-slash', 'uil-eye');
                  });
                } else {
                  pwField.type = 'password';
                  pwShowHide.forEach(icon => {
                    icon.classList.replace('uil-eye', 'uil-eye-slash');
                  });
                }
              });
            });
          });
        </script>

        <!--   Core JS Files   -->
        <script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="../bootstrap/assets/js/core/popper.min.js"></script>
        <script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src="../bootstrap/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

        <!-- Sweet Alert -->
        <script src="../bootstrap/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

        <!-- Kaiadmin JS -->
        <script src="../bootstrap/assets/js/kaiadmin.min.js"></script>
      </body>
</html>