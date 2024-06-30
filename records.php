<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "wis");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['report'])) {
    $target_dir = "reports/";

    // Create the uploads directory if it does not exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["report"]["name"]);
    if (move_uploaded_file($_FILES["report"]["tmp_name"], $target_file)) {
        // Insert file information into database
        $stmt = $conn->prepare("INSERT INTO reports (filename) VALUES (?)");
        $stmt->bind_param("s", $target_file);
        if ($stmt->execute()) {
            // File uploaded successfully
            $upload_success = true;
        } else {
            // Error inserting file into database
            $upload_success = false;
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Error moving uploaded file
        echo "Sorry, there was an error uploading your file.";
    }
}

// Handle delete action
if (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['file'])) {
    $file_to_delete = $_POST['file'];

    // Delete from database
    $stmt_delete = $conn->prepare("DELETE FROM reports WHERE filename = ?");
    $stmt_delete->bind_param("s", $file_to_delete);
    if ($stmt_delete->execute()) {
        // Delete from filesystem
        if (unlink($file_to_delete)) {
            echo "File deleted successfully.";
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "Error deleting file from database.";
    }
    exit(); // Ensure no further output
}

// Fetch and display reports from database
$result = $conn->query("SELECT filename, upload_date FROM reports");
$reports = [];
while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
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
    <script>
        function deleteFile(filename) {
            if (confirm('Are you sure you want to delete this file?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'records.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Reload the page or update the UI as needed
                        location.reload(); // Example: Reload the page after deletion
                    } else {
                        alert('Error deleting file.');
                    }
                };
                xhr.send('action=delete&file=' + encodeURIComponent(filename));
            }
        }
    </script>

    <style>
        .chart {
            width: 20%;
        }
        .reports-section {
            margin: 10px;
        }
        .reports-table {
            width: 100%;
            border-collapse: collapse;
        }
        .reports-table th, .reports-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .reports-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="viewprofile.php">Profiles</a>

        <a href="homepage.php">Back</a>
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
        <h1>SK Reports</h1>
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

        <div class="reports-section">
            <h2>Upload Report</h2>
            <form action="records.php" method="post" enctype="multipart/form-data">
                <input type="file" name="report" required>
                <button type="submit">Upload</button>
            </form>
            
            <h2>Uploaded Reports</h2>
            <table class="reports-table">
                <tr>
                    <th>Filename</th>
                    <th>Date Uploaded</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?php echo htmlspecialchars(basename($report['filename'])); ?></td>
                    <td><?php echo date('Y-m-d H:i:s', strtotime($report['upload_date'])); ?></td>
                    <td>
                        <a href="<?php echo htmlspecialchars($report['filename']); ?>" target="_blank">Download</a>
                        <button onclick="deleteFile('<?php echo htmlspecialchars($report['filename']); ?>')">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
