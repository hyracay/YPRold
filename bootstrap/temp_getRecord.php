<?php
session_start();
include("../conne.php");

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Fetch data based on the selected barangay code
    $data_civ = "SELECT civil_status, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY civil_status";
    $result_civ = mysqli_query($conn, $data_civ);

    $data_age = "SELECT age_group, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY age_group";
    $result_age = mysqli_query($conn, $data_age);

    $data_edu = "SELECT educational_background, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY educational_background";
    $result_edu = mysqli_query($conn, $data_edu);

    $data_youth_class = "SELECT youth_classification, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY youth_classification";
    $result_class = mysqli_query($conn, $data_youth_class);

    $data_work_status = "SELECT work_status, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY work_status";
    $result_work = mysqli_query($conn, $data_work_status);

    $data_sk = "SELECT register_sk_voter, COUNT(*) as count FROM profiles WHERE barangay_code = '$code' GROUP BY register_sk_voter";
    $result_sk = mysqli_query($conn, $data_sk);

    // Initialize arrays to store data for Highcharts
    $civil_status_data = [];
    while ($row = mysqli_fetch_assoc($result_civ)) {
        $civil_status_data[] = [
            'name' => $row['civil_status'],
            'y' => intval($row['count'])
        ];
    }

    $age_group_data = [];
    while ($row = mysqli_fetch_assoc($result_age)) {
        $age_group_data[] = [
            'name' => $row['age_group'],
            'y' => intval($row['count'])
        ];
    }

    $edu_background_data = [];
    while ($row = mysqli_fetch_assoc($result_edu)) {
        $edu_background_data[] = [
            'name' => $row['educational_background'],
            'y' => intval($row['count'])
        ];
    }

    $youth_class_data = [];
    while ($row = mysqli_fetch_assoc($result_class)) {
        $youth_class_data[] = [
            'name' => $row['youth_classification'],
            'y' => intval($row['count'])
        ];
    }

    $work_status_data = [];
    while ($row = mysqli_fetch_assoc($result_work)) {
        $work_status_data[] = [
            'name' => $row['work_status'],
            'y' => intval($row['count'])
        ];
    }

    $sk_voter_data = [];
    while ($row = mysqli_fetch_assoc($result_sk)) {
        $sk_voter_data[] = [
            'name' => $row['register_sk_voter'],
            'y' => intval($row['count'])
        ];
    }

    // Encode arrays to JSON format for Highcharts
    $civil_status_json = json_encode($civil_status_data);
    $age_group_json = json_encode($age_group_data);
    $edu_background_json = json_encode($edu_background_data);
    $youth_class_json = json_encode($youth_class_data);
    $work_status_json = json_encode($work_status_data);
    $sk_voter_json = json_encode($sk_voter_data);
?>

<!-- Include Highcharts CDN -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- Display charts using Highcharts -->
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

<script>
// Initialize Highcharts with pie chart options
Highcharts.chart('civil_status', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Civil Status Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $civil_status_json; ?>
    }]
});

Highcharts.chart('chart_age', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Age Group Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $age_group_json; ?>
    }]
});

Highcharts.chart('chart_edu', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Educational Background Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $edu_background_json; ?>
    }]
});

Highcharts.chart('youth_classification', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Youth Classification Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $youth_class_json; ?>
    }]
});

Highcharts.chart('work_status', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Work Status Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $work_status_json; ?>
    }]
});

Highcharts.chart('register_sk_voter', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Registered SK Voter Distribution'
    },
    series: [{
        name: 'Count',
        data: <?php echo $sk_voter_json; ?>
    }]
});
</script>

<?php
}
?>
