
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

// pie chart for age_group
$data_age = "SELECT age_group, COUNT(*) as count FROM profiles GROUP BY age_group";
$result_age = mysqli_query($conn, $data_age);

$data_age= array();
while ($row = mysqli_fetch_assoc($result_age)) {
    $data_age[] = $row;
}


$data_edu = "SELECT educational_background, COUNT(*) as count FROM profiles GROUP BY educational_background";
$result_edu = mysqli_query($conn, $data_edu);

$data_edu= array();
while($row = mysqli_fetch_assoc($result_edu)){
    $data_edu []=$row;
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
        .chart {
            width: 20%;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="viewprofile.php">Profiles</a>
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
            echo '<a href="#.php">Accounts</a>';
         }
        ?>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Welcome to the Homepage</h3>
        <div class="chart">
            <div id="chart_age"></div>
        </div>
        <div class="chart">
            <div id="chart_edu"></div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Build the chart
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
    });
    </script>
</body>
</html>
