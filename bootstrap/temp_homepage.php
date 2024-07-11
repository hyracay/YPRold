<?php
include("../conne.php");

//pie chart for civil status
$data_civ= "SELECT civil_status, COUNT(*) as count FROM profiles GROUP BY civil_status";
$result_civ= mysqli_query($conn, $data_civ);

$data_civ = array();
while($row = mysqli_fetch_assoc($result_civ)){
    $data_civ[]=$row;
}

// pie chart for age_group
$data_age = "SELECT age_group, COUNT(*) as count FROM profiles GROUP BY age_group";
$result_age = mysqli_query($conn, $data_age);

$data_age= array();
while ($row = mysqli_fetch_assoc($result_age)) {
    $data_age[] = $row;
}

//pie chart for educational background
$data_edu = "SELECT educational_background, COUNT(*) as count FROM profiles GROUP BY educational_background";
$result_edu = mysqli_query($conn, $data_edu);

$data_edu= array();
while($row = mysqli_fetch_assoc($result_edu)){
    $data_edu []=$row;
}

//youth classification
$data_youth_class = "SELECT youth_classification, COUNT(*) as count FROM profiles GROUP BY youth_classification";
$result_class = mysqli_query($conn, $data_youth_class);

$data_youth_class=array();
while($row = mysqli_fetch_assoc($result_class)){
    $data_youth_class[] = $row;
}

//work status
$data_work_status = "SELECT work_status, COUNT(*) as count FROM profiles GROUP BY work_status";
$result_work= mysqli_query($conn, $data_work_status);

$data_work_status = array();
while($row = mysqli_fetch_assoc($result_work)){
    $data_work_status[]=$row;
}

//sk voter
$data_sk="SELECT register_sk_voter, COUNT(*) as count FROM profiles GROUP BY register_sk_voter";
$result_sk=mysqli_query($conn, $data_sk);

$data_sk= array();
while($row = mysqli_fetch_assoc($result_sk)){
    $data_sk[]=$row;
}

// Query to fetch age group data with specified categories
$data_age = "SELECT 
    CASE
        WHEN age >= 15 AND age <= 17 THEN 'Child Youth (15-17 Yrs. Old)'
        WHEN age >= 18 AND age <= 24 THEN 'Core Youth (18-24 Yrs. Old)'
        WHEN age >= 25 AND age <= 30 THEN 'Young Adult (25-30 Yrs. Old)'
        ELSE 'Unknown'
    END as age_group,
    COUNT(*) as count 
FROM profiles 
GROUP BY age_group";
$result_age = mysqli_query($conn, $data_age);

$data_age = array();
while ($row = mysqli_fetch_assoc($result_age)) {
    $data_age[] = $row;
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
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
              <li class="nav-item">
                <a
                  href="temp_homepage.php"
                  aria-expanded="false"
                >
                  <i class="fas fa-chart-bar" active></i>
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
                      <a href="temp_createacc.html">
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
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              </nav>
              <h3>La Trinidad Youth Profiling System</h3>
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
                      <span class="op-7">Hi,</span>
                      <span class="fw-bold">username!</span>
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
                            <h4>Hizrian</h4>
                            <p class="text-muted">hello@example.com</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <a class="dropdown-item" href="#">Logout</a>
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
            <div class="page-category">
              <div class="row">
                <div class="chart">
                    <div id="civil_status"></div>
                </div>
                <div class="chart">
                    <div id="chart_age"></div>
                </div>
            </div>
    
            <div class="row">
                <div class="chart">
                    <div id="chart_edu"></div>
                </div>
                <div class="chart">
                    <div id="youth_classification"></div>
                </div>
            </div>
    
            <div class="row">
                <div class="chart">
                    <div id="work_status"></div>
                </div>
                <div class="chart">
                    <div id="register_sk_voter"></div>
                </div>
            </div>
            <button id="downloadPdf">Download Charts as PDF</button>
        </div>
    
    
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Highcharts.chart('civil_status', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Civil Status'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Civil Status',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($data_civ as $row) {
                            echo "{ name: '" . $row['civil_status'] . "', y: " . $row['count'] . " },";
                            
                        }
                        ?>
                    ]
                }]
            });
    
            Highcharts.chart('chart_age', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Age Group Distribution'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y}'
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Age Group',
                colorByPoint: true,
                data: [
                    <?php
                    foreach ($data_age as $row) {
                        echo "{ name: '" . $row['age_group'] . "', y: " . $row['count'] . " },";
                    }
                    ?>
                ]
            }]
        });
    });
            Highcharts.chart('chart_edu', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Educational Background'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Educational Background',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($data_edu as $row) {
                            echo "{ name: '" . $row['educational_background'] . "', y: " . $row['count'] . " },";
                            
                        }
                        ?>
                    ]
                }]
            });
            Highcharts.chart('youth_classification', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Youth Classification'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Youth Classification',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($data_youth_class as $row) {
                            echo "{ name: '" . $row['youth_classification'] . "', y: " . $row['count'] . " },";
                            
                        }
                        ?>
                    ]
                }]
            });
            Highcharts.chart('work_status', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Work Status'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Work Status',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($data_work_status as $row) {
                            echo "{ name: '" . $row['work_status'] . "', y: " . $row['count'] . " },";
                            
                        }
                        ?>
                    ]
                }]
            });
            Highcharts.chart('register_sk_voter', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Registered SK Voter'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y}</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Registered SK Voter',
                    colorByPoint: true,
                    data: [
                        <?php
                        foreach ($data_sk as $row) {
                            $display = $row['register_sk_voter'] == 'Registered' ? 'Registered' : 'Not Registered';
                            echo "{ name: '" . $display . "', y: " . $row['count'] . " },";
                            
                        }
                        ?>
                    ]
                }]
            });
        </script>
        <script>
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
      </div>
    </div>

    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Google Maps Plugin -->
    <script src="assets/js/plugin/gmaps/gmaps.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>
  </body>
</html>
