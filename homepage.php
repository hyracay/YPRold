
<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit(); // Ensure that no further code is executed after the redirection
}

// Check if 'role' is set in session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    // Handle case where role is not set (e.g., redirect or error message)
    echo "Role information not found. Please contact administrator.";
    exit();
}
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

$data_work_status = "SELECT work_status, COUNT(*) as count FROM profiles GROUP BY work_status";
$result_work= mysqli_query($conn, $data_work_status);

$data_work_status = array();
while($row = mysqli_fetch_assoc($result_work)){
    $data_work_status[]=$row;
}

$data_sk="SELECT register_sk_voter, COUNT(*) as count FROM profiles GROUP BY register_sk_voter";
$result_sk=mysqli_query($conn, $data_sk);

$data_sk= array();
while($row = mysqli_fetch_assoc($result_sk)){
    $data_sk[]=$row;
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <style>
        .content {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

    .welcome-heading {
    margin-top: 20px;
}
        
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="viewprofile.php">Profiles</a>

        <a href="records.php">Records</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
            // For employees, you can customize what to display or leave it empty
            // Here, we do nothing to omit displaying "Create Accounts"
        } else {
            // Handle unexpected roles (optional)
            echo "Unknown role.";
        }
        ?>
        <a href="crud.php">Create Profile</a>
        <?php
         if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
         }
        ?>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>
         
    <div class="content">
    <div class="welcome-heading">
        <h3>Welcome to the Homepage</h3>
    </div>
    <div class="chart">
        <div id="civil_status"></div>
    </div>
    <div class="chart">
        <div id="chart_age"></div>
    </div>
    <div class="chart">
        <div id="chart_edu"></div>
    </div>
    <div class="chart">
        <div id="youth_classification"></div>
    </div>
    <div class="chart">
        <div id="work_status"></div>
    </div>
    <div class="chart">
        <div id="register_sk_voter"></div>
    </div>
</div>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Build the chart
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
                        echo "{ name: '" . $row['register_sk_voter'] . "', y: " . $row['count'] . " },";
                        
                    }
                    ?>
                ]
            }]
        });
    });
    </script>
</body>
</html>
