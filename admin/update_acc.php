<?php
session_start();
include("../connection/conne.php");

if (!isset($_SESSION['ADMIN'])) {
  header("location: ../index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} 

$error = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM account WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $account = mysqli_fetch_assoc($result);
    } else {
        die("Account not found: " . mysqli_error($conn));
    }
} else {
    die("ID parameter not specified.");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        $error = "Passwords do not match.";
    } else {
        $check_query = "SELECT * FROM account WHERE email = '$email' AND id != '$id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "Email already exists.";
        } else {
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $update_query = "UPDATE account SET email = '$email', password = '$hashed_password', FirstName = '$fname', LastName = '$lname', role = '$role' WHERE id = $id";
            } else {
                $update_query = "UPDATE account SET email = '$email', FirstName = '$fname', LastName = '$lname', role = '$role' WHERE id = $id";
            }

            $result = mysqli_query($conn, $update_query);

            if ($result) {
                header("location: accounts.php");
                exit();
            } else {
                $error = "Update failed: " . mysqli_error($conn);
            }
        }
    }
}

$barangay_code = "";
$code = isset($_SESSION['code']) ? $_SESSION['code'] : '';

if ($role == 'admin') {
    if (isset($_POST['barangay_code'])) {
        $code = $_POST['barangay_code'];
        $_SESSION['code'] = $code;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Datatables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../bootstrap/assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

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
                <a
                  href="homepage.php"
                  aria-expanded="false"
                >
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
              
         <li class="nav-item"><a data-bs-toggle="collapse" href="#forms"><i class="fas icon-user"></i><p>User Accounts</p><span class="caret"></span></a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li><a href="accounts.php"><span class="sub-item">View Accounts</span></a></li>
                  <li><a href="createacc.php"><span class="sub-item">Create Account</span></a></li>
                </ul>
              </div>
            </li>
              <li class="nav-item">
             
              <li class="nav-item">
                <a href="calendar.php">
                  <i class="fas icon-calendar"></i>
                  <p>Calendar</p>
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
              <a href="index.html" class="logo">
                <img
                  src="../bootstrap/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
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
              <h3><?php echo $barangay_code; ?> La Trinidad Youth Profiling System</h3>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
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
        
        <!-- main content -->
        <div class="container">
                 <h3>Update Account</h3>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="update_acc.php?id=<?= $id; ?>">
            <input type="hidden" name="id" value="<?= $account['id']; ?>">
            <table>
                <br>
                <br>
                <br>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?= $account['email']; ?>" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="password" placeholder="New password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="cpassword" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="fname" value="<?= $account['FirstName']; ?>" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="lname" value="<?= $account['LastName']; ?>" required></td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" id="role" name="role" value="user">
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="update">Update</button></td>
                    <td><a href="accounts.php">Cancel</a></td>
                </tr>
            </table>
        </form>
    </div>
                    </div>

        <!--   Core JS Files   -->
    <script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap/assets/js/core/popper.min.js"></script>
    <script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../bootstrap/assets/js/kaiadmin.min.js"></script>

    </body>
</html>