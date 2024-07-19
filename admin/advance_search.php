<?php
session_start();
include("../connection/conne.php");

if (!isset($_SESSION['ADMIN'])) {
  header("location:../index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=wis", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$barangay_code = "";
$code = isset($_SESSION['code']) ? $_SESSION['code'] : '';

if ($role == 'admin') {
    if (isset($_POST['barangay_code'])) {
        $code = $_POST['barangay_code'];
        $_SESSION['code'] = $code;
    }
}

// Collect search parameters
$searchParams = [
    'age_min' => isset($_POST['age_min']) ? $_POST['age_min'] : (isset($_GET['age_min']) ? $_GET['age_min'] : ''),
    'age_max' => isset($_POST['age_max']) ? $_POST['age_max'] : (isset($_GET['age_max']) ? $_GET['age_max'] : ''),
    'civil_status' => isset($_POST['civil_status']) ? $_POST['civil_status'] : (isset($_GET['civil_status']) ? $_GET['civil_status'] : ''),
    'sex' => isset($_POST['sex']) ? $_POST['sex'] : (isset($_GET['sex']) ? $_GET['sex'] : ''),
    'work_status' => isset($_POST['work_status']) ? $_POST['work_status'] : (isset($_GET['work_status']) ? $_GET['work_status'] : ''),
    'educational_background' => isset($_POST['educational_background']) ? $_POST['educational_background'] : (isset($_GET['educational_background']) ? $_GET['educational_background'] : ''),
    'youth_classification' => isset($_POST['youth_classification']) ? $_POST['youth_classification'] : (isset($_GET['youth_classification']) ? $_GET['youth_classification'] : ''),
    'register_sk_voter' => isset($_POST['register_sk_voter']) ? $_POST['register_sk_voter'] : (isset($_GET['register_sk_voter']) ? $_GET['register_sk_voter'] : '')
];
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
               <a data-bs-toggle="collapse" href="#tables">
                <i class="fas icon-people"></i>
                <p>Youth Profiles</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="profiles.php">
                      <span class="sub-item">View Profiles</span>
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
              </li>';
               }
               ?>


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
          <div class="content">
                <h3>Advanced Search</h3>
                <form method="POST" action="advance_search.php">
                    <?php foreach ($searchParams as $key => $value) {
                        echo '<input type="hidden" name="' . $key . '" value="' . htmlspecialchars($value) . '">';
                    } ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="age_min">Minimum Age</label>
                            <input type="number" class="form-control" id="age_min" name="age_min" value="<?php echo htmlspecialchars($searchParams['age_min']); ?>" min="15" max="30">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age_max">Maximum Age</label>
                            <input type="number" class="form-control" id="age_max" name="age_max" value="<?php echo htmlspecialchars($searchParams['age_max']); ?>" min="15" max="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status">
                            <option value="">Select</option>
                            <option value="Single" <?php if ($searchParams['civil_status'] == 'Single') echo 'selected'; ?>>Single</option>
                            <option value="Married" <?php if ($searchParams['civil_status'] == 'Married') echo 'selected'; ?>>Married</option>
                            <option value="Divorced" <?php if ($searchParams['civil_status'] == 'Divorced') echo 'selected'; ?>>Divorced</option>
                            <option value="Widowed" <?php if ($searchParams['civil_status'] == 'Widowed') echo 'selected'; ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="">Select</option>
                            <option value="Male" <?php if ($searchParams['sex'] == 'Male') echo 'selected'; ?>>Male</option>
                            <option value="Female" <?php if ($searchParams['sex'] == 'Female') echo 'selected'; ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="work_status">Work Status</label>
                        <select class="form-control" id="work_status" name="work_status">
                            <option value="">Any</option>
                            <option value="Employed" <?php if ($searchParams['work_status'] == 'Employed') echo 'selected'; ?>>Employed</option>
                            <option value="Unemployed" <?php if ($searchParams['work_status'] == 'Unemployed') echo 'selected'; ?>>Unemployed</option>
                            <option value="Self-Employed" <?php if ($searchParams['work_status'] == 'Self-Employed') echo 'selected'; ?>>Self-Employed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="educational_background">Educational Background</label>
                        <select class="form-control" id="educational_background" name="educational_background">
                            <option value="">Any</option>
                            <option value="Elementary" <?php if ($searchParams['educational_background'] == 'Elementary') echo 'selected'; ?>>Elementary</option>
                            <option value="High School" <?php if ($searchParams['educational_background'] == 'High School') echo 'selected'; ?>>High School</option>
                            <option value="College" <?php if ($searchParams['educational_background'] == 'College') echo 'selected'; ?>>College</option>
                            <option value="Graduate" <?php if ($searchParams['educational_background'] == 'Graduate') echo 'selected'; ?>>Graduate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="youth_classification">Youth Classification</label>
                        <select class="form-control" id="youth_classification" name="youth_classification">
                            <option value="">Any</option>
                            <option value="In School Youth" <?php if ($searchParams['youth_classification'] == 'In School Youth') echo 'selected'; ?>>In School</option>
                            <option value="Out of School Youth" <?php if ($searchParams['youth_classification'] == 'Out of School Youth') echo 'selected'; ?>>Out of School</option>
                            <option value="Working Youth" <?php if ($searchParams['youth_classification'] == 'Working Youth') echo 'selected'; ?>>Working</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="register_sk_voter">Registered SK Voter</label>
                        <select class="form-control" id="register_sk_voter" name="register_sk_voter">
                            <option value="">Any</option>
                            <option value="Registered" <?php if ($searchParams['register_sk_voter'] == 'Registered') echo 'selected'; ?>>Yes</option>
                            <option value="Not Registered" <?php if ($searchParams['register_sk_voter'] == 'Not Registered') echo 'selected'; ?>>No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <?php
                // Construct the search query
                $query = "SELECT * FROM profiles WHERE 1=1";
                $params = [];
                if (!empty($searchParams['age_min'])) {
                    $query .= " AND age >= ?";
                    $params[] = $searchParams['age_min'];
                }
                if (!empty($searchParams['age_max'])) {
                    $query .= " AND age <= ?";
                    $params[] = $searchParams['age_max'];
                }
                if (!empty($searchParams['civil_status'])) {
                    $query .= " AND civil_status = ?";
                    $params[] = $searchParams['civil_status'];
                }
                if (!empty($searchParams['sex'])) {
                    $query .= " AND sex = ?";
                    $params[] = $searchParams['sex'];
                }
                if (!empty($searchParams['work_status'])) {
                    $query .= " AND work_status = ?";
                    $params[] = $searchParams['work_status'];
                }
                if (!empty($searchParams['educational_background'])) {
                    $query .= " AND educational_background = ?";
                    $params[] = $searchParams['educational_background'];
                }
                if (!empty($searchParams['youth_classification'])) {
                    $query .= " AND youth_classification = ?";
                    $params[] = $searchParams['youth_classification'];
                }
                if (!empty($searchParams['register_sk_voter'])) {
                    $query .= " AND register_sk_voter = ?";
                    $params[] = $searchParams['register_sk_voter'];
                }

                // Prepare and execute the query
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Civil Status</th>
                                <th>Work Status</th>
                                <th>Educational Background</th>
                                <th>Youth Classification</th>
                                <th>Registered SK Voter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></td>
                                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                                    <td><?php echo htmlspecialchars($row['sex']); ?></td>
                                    <td><?php echo htmlspecialchars($row['civil_status']); ?></td>
                                    <td><?php echo htmlspecialchars($row['work_status']); ?></td>
                                    <td><?php echo htmlspecialchars($row['educational_background']); ?></td>
                                    <td><?php echo htmlspecialchars($row['youth_classification']); ?></td>
                                    <td><?php echo htmlspecialchars($row['register_sk_voter']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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