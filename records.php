<?php
session_start();
include('conne.php');

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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['file'])) {
    $file_to_delete = $_POST['file'];

    // Delete from database
    $stmt_delete = $conn->prepare("DELETE FROM reports WHERE filename = ?");
    $stmt_delete->bind_param("s", $file_to_delete);
    if ($stmt_delete->execute()) {
        // Delete from filesystem
        if (unlink($file_to_delete)) {
            header("location:records.php");
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
    <title>SK REPORTS LIBRARY</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        function deleteFile(filename) {
            if (confirm('Are you sure you want to delete this file?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Post to the same page

                var inputAction = document.createElement('input');
                inputAction.type = 'hidden';
                inputAction.name = 'action';
                inputAction.value = 'delete';
                form.appendChild(inputAction);

                var inputFile = document.createElement('input');
                inputFile.type = 'hidden';
                inputFile.name = 'file';
                inputFile.value = filename;
                form.appendChild(inputFile);

                document.body.appendChild(form);
                form.submit();
            }
        }

        function displayFileName() {
            var fileInput = document.getElementById('fileInput');
            var fileNameSpan = document.getElementById('fileNameSpan');
            if (fileInput.files.length > 0) {
                fileNameSpan.textContent = fileInput.files[0].name;
            } else {
                fileNameSpan.textContent = "No file selected";
            }
        }
    </script>

    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .content {
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .chart {
            width: calc(50% - 20px); /* Adjust based on your layout */
            margin-bottom: 20px;
            display: inline-block;
            vertical-align: top;
        }

        /* Reports section */
        .reports-section {
            margin: 20px 0;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .reports-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .reports-table th, .reports-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .reports-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .reports-table td {
            background-color: #fff;
            color: #666;
        }

        .reports-table a, .reports-table button {
            text-decoration: none;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .reports-table a:hover, .reports-table button:hover {
            opacity: 0.8;
        }

        /* Button specific styles */
        .reports-table a.btn-download {
            background-color: #699aba;
            color: #fff;
        }

        .reports-table button.btn-delete {
            background-color: #f37a1f;
            color: #fff;
        }

        /* File input and upload button */
        .upload-form {
            margin-bottom: 20px;
        }

        .upload-form input[type=file] {
            display: none;
        }

        .upload-form label.choose-file {
            display: inline-block;
            padding: 6px 12px;
            background-color: #699aba;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-form label.choose-file:hover {
            background-color: #0056b3;
        }

        .upload-form button[type=submit] {
            display: inline-block;
            padding: 6px 12px;
            background-color: #699aba;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-form button[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="viewprofile.php">Profiles</a>
        <a href="crud.php">Create Profile</a>
        <a href="homepage.php">Back</a>
        <a href="calendar.php">Calendar</a>
        <?php
         if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
         }
        ?>
        <?php
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
        } else {
            echo "Unknown role.";
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>SK Reports</h1>
 

        <div class="reports-section">
            <h2>Upload Report</h2>
            <form class="upload-form" action="records.php" method="post" enctype="multipart/form-data">
                <input type="file" name="report" id="fileInput" onchange="displayFileName()" required>
                <label for="fileInput" class="choose-file">Choose File</label>
                <span id="fileNameSpan">No file selected</span>
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
                    <td><a href="#" type="button" onclick="window.open('<?= $report['filename']; ?>', '_blank')"><?php echo htmlspecialchars(basename($report['filename'])); ?></a></td>
                    <td><?php echo date('Y-m-d H:i:s', strtotime($report['upload_date'])); ?></td>
                    <td>
                        <a href="download.php?file=<?php echo urlencode($report['filename']); ?>" class="btn-download" target="_blank">Download</a>
                        <a href="javascript:void(0);" onclick="deleteFile('<?php echo htmlspecialchars($report['filename']); ?>')"><button>Delete</button></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>
