<?php
session_start();
include("../connection/conne.php");

if (!isset($_SESSION['ADMIN'])) {
  header("location:../index.php");
  exit(); // Ensure that no further code is executed after the redirection
}
if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
} else {
  // Handle case where role is not set (e.g., redirect or error message)
  echo "Role information not found. Please contact administrator.";
  exit();
}

// for barangay code
$barangay_code = "";
$code = isset($_SESSION['code']) ? $_SESSION['code'] : '';

if ($role == 'admin') {
    if (isset($_POST['barangay_code'])) {
        $code = $_POST['barangay_code'];
        $_SESSION['code'] = $code;
    }
}

$fetch_barangay = "SELECT * FROM barangay WHERE Code = '$code'";
$fetch_barangay_result = mysqli_query($conn, $fetch_barangay);
while ($row = mysqli_fetch_assoc($fetch_barangay_result)) {
  $barangay_code = $row['Brngy'];
}

// Fetch data based on barangay code, if set; otherwise, fetch overall data
$where_clause = $code ? "WHERE barangay_code = '$code'" : '';

// pie chart for civil status
$data_civ = "SELECT civil_status, COUNT(*) as count FROM profiles $where_clause GROUP BY civil_status";
$result_civ = mysqli_query($conn, $data_civ);

$data_civ_array = array();
while ($row = mysqli_fetch_assoc($result_civ)) {
  $data_civ_array[] = $row;
}

// pie chart for age_group
$data_age = "SELECT age_group, COUNT(*) as count FROM profiles $where_clause GROUP BY age_group";
$result_age = mysqli_query($conn, $data_age);

$data_age_array = array();
while ($row = mysqli_fetch_assoc($result_age)) {
  $data_age_array[] = $row;
}

// pie chart for educational background
$data_edu = "SELECT educational_background, COUNT(*) as count FROM profiles $where_clause GROUP BY educational_background";
$result_edu = mysqli_query($conn, $data_edu);

$data_edu_array = array();
while ($row = mysqli_fetch_assoc($result_edu)) {
  $data_edu_array[] = $row;
}

// youth classification
$data_youth_class = "SELECT youth_classification, COUNT(*) as count FROM profiles $where_clause GROUP BY youth_classification";
$result_class = mysqli_query($conn, $data_youth_class);

$data_youth_class_array = array();
while ($row = mysqli_fetch_assoc($result_class)) {
  $data_youth_class_array[] = $row;
}

// work status
$data_work_status = "SELECT work_status, COUNT(*) as count FROM profiles $where_clause GROUP BY work_status";
$result_work = mysqli_query($conn, $data_work_status);

$data_work_status_array = array();
while ($row = mysqli_fetch_assoc($result_work)) {
  $data_work_status_array[] = $row;
}

// sk voter
$data_sk = "SELECT register_sk_voter, COUNT(*) as count FROM profiles $where_clause GROUP BY register_sk_voter";
$result_sk = mysqli_query($conn, $data_sk);

$data_sk_array = array();
while ($row = mysqli_fetch_assoc($result_sk)) {
  $data_sk_array[] = $row;
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
        families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ["../bootstrap/assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>
  <!-- CSS Files -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
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
    <!-- navbar -->
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <?php
          // Display links based on user's role
          if ($role == 'admin' || $role == 'user') {
            echo '<li class="nav-item"><a href="temp_homepage.php" aria-expanded="false"><i class="fas fa-chart-bar"></i><p>Dashboard</p></a></li>';
          }
          ?>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Components</h4>
          </li>
          <?php
          if ($role == 'user') {
            echo '<li class="nav-item">
              <a data-bs-toggle="collapse" href="#tables"><i class="fas icon-people"></i><p>Youth Profiles</p><span class="caret"></span></a>
              <div class="collapse" id="tables">
                <ul class="nav nav-collapse">
                  <li><a href="temp_profiles.php"><span class="sub-item">Create/View Profiles</span></a></li>
                  <li><a href="temp_archive.php"><span class="sub-item">Archive</span></a></li>
                </ul>
              </div>
            </li>';
          }
          if ($role == 'admin' || $role == 'superadmin') {
            echo '<li class="nav-item"><a data-bs-toggle="collapse" href="#forms"><i class="fas icon-user"></i><p>User Accounts</p><span class="caret"></span></a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li><a href="temp_accounts.php"><span class="sub-item">View Accounts</span></a></li>
                  <li><a href="temp_createacc.php"><span class="sub-item">Create Account</span></a></li>
                </ul>
              </div>
            </li>';
          }
          ?>
          <li class="nav-item">
            <a href="calendar.php"><i class="fas icon-calendar"></i><p>Calendar</p></a>
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
                    <?php if ($role == 'superadmin') { echo '<a class="dropdown-item" href="#">Account Setting</a>'; } ?>
                    <a class="dropdown-item" href="../temp_logout.php">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>

    <div class="container">
      <div class="page-inner">
        <div class="page-header">
          <h4 class="page-title">Demographic Insights</h4>
        </div>
        <?php if ($role == 'admin') { ?>
          <form method="POST">
    Barangay
    <select name="barangay_code" onchange="this.form.submit()">
        <option value="All">All</option>
        <?php
        $fetch = "SELECT * FROM barangay";
        $result_fetch = mysqli_query($conn, $fetch);
        
        while ($row = mysqli_fetch_array($result_fetch)) {
            echo '<option value="' . $row['Code'] . '">' . $row['Brngy'] . '</option>';
        }
        ?>
    </select>
</form>

<?php
// Processing form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barangay_code = $_POST['barangay_code'];
    
    if ($barangay_code == "All") {
        // Query to fetch all barangay information including all details
        $query = "SELECT * FROM barangay";
    } else {
        // Query to fetch specific barangay information based on selected code
        $query = "SELECT * FROM barangay WHERE Code = '$barangay_code'";
    }
    
    $result = mysqli_query($conn, $query);
    
    // Display fetched information
    echo "<h2>Barangay Information</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Code</th><th>Barangay</th><th>Other Info</th></tr>";
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Code'] . "</td>";
        echo "<td>" . $row['Brngy'] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}
?>

          
        <?php } ?>

        <br><br>
        <div class="row">
          <div class="chart"><div id="civil_status"></div></div>
          <div class="chart"><div id="chart_age"></div></div>
        </div>
        <div class="row">
          <div class="chart"><div id="chart_edu"></div></div>
          <div class="chart"><div id="youth_classification"></div></div>
        </div>
        <div class="row">
          <div class="chart"><div id="work_status"></div></div>
          <div class="chart"><div id="register_sk_voter"></div></div>
        </div>
        <button id="downloadPdf">Download Charts as PDF</button>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const defaultData = [{ name: 'No Data', y: 1 }];
          
          const civData = <?php echo empty($data_civ_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            return ['name' => $row['civil_status'], 'y' => (int)$row['count']];
          }, $data_civ_array)); ?>;

          const ageData = <?php echo empty($data_age_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            return ['name' => $row['age_group'], 'y' => (int)$row['count']];
          }, $data_age_array)); ?>;

          const eduData = <?php echo empty($data_edu_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            return ['name' => $row['educational_background'], 'y' => (int)$row['count']];
          }, $data_edu_array)); ?>;

          const youthClassData = <?php echo empty($data_youth_class_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            return ['name' => $row['youth_classification'], 'y' => (int)$row['count']];
          }, $data_youth_class_array)); ?>;

          const workStatusData = <?php echo empty($data_work_status_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            return ['name' => $row['work_status'], 'y' => (int)$row['count']];
          }, $data_work_status_array)); ?>;

          const skVoterData = <?php echo empty($data_sk_array) ? json_encode($defaultData) : json_encode(array_map(function($row) {
            $display = $row['register_sk_voter'] == 'Registered' ? 'Registered' : 'Not Registered';
            return ['name' => $display, 'y' => (int)$row['count']];
          }, $data_sk_array)); ?>;

          Highcharts.chart('civil_status', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Civil Status' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Civil Status', colorByPoint: true, data: civData }]
          });

          Highcharts.chart('chart_age', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Age Group Distribution' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Age Group', colorByPoint: true, data: ageData }]
          });

          Highcharts.chart('chart_edu', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Educational Background' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Educational Background', colorByPoint: true, data: eduData }]
          });

          Highcharts.chart('youth_classification', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Youth Classification' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Youth Classification', colorByPoint: true, data: youthClassData }]
          });

          Highcharts.chart('work_status', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Work Status' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Work Status', colorByPoint: true, data: workStatusData }]
          });

          Highcharts.chart('register_sk_voter', {
            chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie' },
            title: { text: 'Registered SK Voter' },
            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
            accessibility: { point: { valueSuffix: '%' } },
            plotOptions: {
              pie: {
                allowPointSelect: true, cursor: 'pointer',
                dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' },
                showInLegend: true
              }
            },
            series: [{ name: 'Registered SK Voter', colorByPoint: true, data: skVoterData }]
          });
        });

        document.getElementById('downloadPdf').addEventListener('click', function () {
          const { jsPDF } = window.jspdf;
          const pdf = new jsPDF('p', 'mm', 'a4');

          const chartsConfig = [
            { id: 'civil_status', width: 90, height: 60 },
            { id: 'chart_age', width: 90, height: 80 },
            { id: 'chart_edu', width: 90, height: 60 },
            { id: 'youth_classification', width: 90, height: 80 },
            { id: 'work_status', width: 90, height: 60 },
            { id: 'register_sk_voter', width: 90, height: 80 }
          ];

          const margin = 10; // Margin from the edges of the page
          const xSpacing = 30; // Horizontal space between charts
          const ySpacing = 2; // Vertical space between charts

          // Function to capture and add charts to PDF
          const captureChart = async (chartConfig, xPos, yPos) => {
            const chartElement = document.getElementById(chartConfig.id);
            if (chartElement) {
              const canvas = await html2canvas(chartElement);
              const imgData = canvas.toDataURL('image/png');
              pdf.addImage(imgData, 'PNG', xPos, yPos, chartConfig.width, chartConfig.height);
            }
          };

          // Function to handle page layout
          const generateChartsPage = async (startIndex, endIndex) => {
            let xPos = margin;
            let yPos = margin;
            for (let i = startIndex; i < endIndex; i++) {
              await captureChart(chartsConfig[i], xPos, yPos);
              xPos += chartsConfig[i].width + xSpacing - chartWidthAdjustment(chartsConfig[i]); // Adjust spacing based on width
              if (xPos + chartsConfig[i].width > 210 - margin) { // Move to next row if it exceeds the page width
                xPos = margin;
                yPos += chartsConfig[i].height + ySpacing - chartHeightAdjustment(chartsConfig[i]); // Adjust spacing based on height
              }
              if (yPos + chartsConfig[i].height > 297 - margin) { // Move to next page if it exceeds the page height
                if (i + 1 < endIndex) {
                  pdf.addPage();
                  xPos = margin;
                  yPos = margin;
                }
              }
            }
          };

          // Generate pages
          (async () => {
            for (let i = 0; i < chartsConfig.length; i += chartsConfig.length) {
              const endIndex = Math.min(i + chartsConfig.length, chartsConfig.length);
              await generateChartsPage(i, endIndex);
              if (endIndex < chartsConfig.length) {
                pdf.addPage();
              }
            }
            pdf.save('charts.pdf');
          })().catch(error => {
            console.error('Error generating PDF:', error);
          });

          function chartWidthAdjustment(chartConfig) {
            // If the chart's width is different, adjust spacing accordingly
            return (chartConfig.width !== chartConfig.height) ? (chartConfig.width - chartConfig.height) / 1 : 0;
          }

          function chartHeightAdjustment(chartConfig) {
            // If the chart's height is different, adjust spacing accordingly
            return (chartConfig.height !== chartConfig.width) ? (chartConfig.height - chartConfig.width) / 1 : 0;
          }
        });
      </script>
    </div>
  </div>
</div>
<!-- Core JS Files -->
<script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../bootstrap/assets/js/core/popper.min.js"></script>
<script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Chart JS -->
<script src="../bootstrap/assets/js/plugin/chart.js/chart.min.js"></script>
<!-- jQuery Sparkline -->
<script src="../bootstrap/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
<!-- Chart Circle -->
<script src="../bootstrap/assets/js/plugin/chart-circle/circles.min.js"></script>
<!-- Datatables -->
<script src="../bootstrap/assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Bootstrap Notify -->
<script src="../bootstrap/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- jQuery Vector Maps -->
<script src="../bootstrap/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../bootstrap/assets/js/plugin/jsvectormap/world.js"></script>
<!-- Google Maps Plugin -->
<script src="../bootstrap/assets/js/plugin/gmaps/gmaps.js"></script>
<!-- Sweet Alert -->
<script src="../bootstrap/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<!-- Kaiadmin JS -->
<script src="../bootstrap/assets/js/kaiadmin.min.js"></script>
</body>
</html>