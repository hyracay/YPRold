<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}

// Pagination settings
$recordsPerPage = 40; // Number of records per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $recordsPerPage;

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Advanced Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Helvetica", Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden; /* Prevent horizontal scrolling */
        }

        .sidebar {
            width: 19.5%;
            background-color: #fffcdc;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-right: 1px solid #fee7d6;
            height: 100%;
            position: fixed; /* Make sidebar fixed */
            overflow: auto; /* Allow vertical scrolling in the sidebar */
        }

        .sidebar img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .sidebar p {
            color: #393939;
            text-align: center;
        }

        .sidebar a {
            font-family: Arial, sans-serif;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
            width: 80%;
            text-align: center;
            padding: 12px 18px;
            background-color: #a4b6c2;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #ff6f00;
            color: #fff;
        }

        .sidebar a[href="homepage.php"] {
            background-color: #f37a1f;
        }

        .sidebar a[href="homepage.php"]:hover {
            background-color: #bdbdbd;
        }

        .container-fluid {
            margin-left: 20%; /* Offset for sidebar */
            padding: 10px;
            width: 80%; /* Adjusted to fit beside the sidebar */
            overflow-y: auto; /* Vertical scroll for content area */
            height: 100vh; /* Fill remaining viewport height */
        }

        .content {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px;
        }

        h3 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        a.page-link {
    background-color: #699aba;
    color: black;
}

.page-item.active .page-link {
    color: #fff;
    background-color: #f37a1f;
    border-color: #f37a1f;
    z-index: 0;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar" class="img rounded-circle">
        <p>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
        Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="homepage.php">Back</a>
        <a href="crud.php">Create Profile</a>
        <?php if ($role == 'admin') { echo '<a href="createacc.php">Create Accounts</a>'; } ?>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        <?php if ($role == 'admin') { echo '<a href="accounts.php">Accounts</a>'; } ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container-fluid">
        <div class="content">
            <h3>Advanced Search</h3>
            <form method="POST" action="advance_search.php?page=1">
                <!-- Keep current search parameters -->
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
                        <option value="Currently looking for job" <?php if ($searchParams['work_status'] == 'Currently looking for job') echo 'selected'; ?>>Currently Looking for a Job</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="educational_background">Educational Background</label>
                    <select class="form-control" id="educational_background" name="educational_background">
                        <option value="">Select</option>
                        <option value="Elementary Level" <?php if ($searchParams['educational_background'] == 'Elementary Level') echo 'selected'; ?>>Elementary Level</option>
                        <option value="Elementary Graduate" <?php if ($searchParams['educational_background'] == 'Elementary Graduate') echo 'selected'; ?>>Elementary Graduate</option>
                        <option value="High School Level" <?php if ($searchParams['educational_background'] == 'High School Level') echo 'selected'; ?>>High School Level</option>
                        <option value="High School Graduate" <?php if ($searchParams['educational_background'] == 'High School Graduate') echo 'selected'; ?>>High School Graduate</option>
                        <option value="Vocational Graduate" <?php if ($searchParams['educational_background'] == 'Vocational Graduate') echo 'selected'; ?>>Vocational Graduate</option>
                        <option value="College Level" <?php if ($searchParams['educational_background'] == 'College Level') echo 'selected'; ?>>College Level</option>
                        <option value="College Graduate" <?php if ($searchParams['educational_background'] == 'College Graduate') echo 'selected'; ?>>College Graduate</option>
                        <option value="Master Level" <?php if ($searchParams['educational_background'] == 'Master Level') echo 'selected'; ?>>Master Level</option>
                        <option value="Master Graduate" <?php if ($searchParams['educational_background'] == 'Master Graduate') echo 'selected'; ?>>Master Graduate</option>
                        <option value="Doctorate Level" <?php if ($searchParams['educational_background'] == 'Doctorate Level') echo 'selected'; ?>>Doctorate Level</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="youth_classification">Youth Classification</label>
                    <select class="form-control" id="youth_classification" name="youth_classification">
                        <option value="">Select</option>
                        <option value="In School Youth" <?php if ($searchParams['youth_classification'] == 'In School Youth') echo 'selected'; ?>>In School Youth</option>
                        <option value="Out Of School Youth" <?php if ($searchParams['youth_classification'] == 'Out Of School Youth') echo 'selected'; ?>>Out Of School Youth</option>
                        <option value="Working Youth" <?php if ($searchParams['youth_classification'] == 'Working Youth') echo 'selected'; ?>>Working Youth</option>
                        <option value="Person with Disability (PWD)" <?php if ($searchParams['youth_classification'] == 'Person with Disability (PWD)') echo 'selected'; ?>>Person With Disability (PWD)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="register_sk_voter">Registered SK Voter</label>
                    <select class="form-control" id="register_sk_voter" name="register_sk_voter">
                        <option value="">Select</option>
                        <option value="Registered" <?php if ($searchParams['register_sk_voter'] == 'Registered') echo 'selected'; ?>>YES</option>
                        <option value="Not Registered" <?php if ($searchParams['register_sk_voter'] == 'Not Registered') echo 'selected'; ?>>NO</option>
                    </select>
                </div>
                <button type="submit" name="search" class="btn btn-primary">Search</button>
            </form>

            <?php
            if (isset($_POST['search']) || isset($_GET['page'])) {
                $sql = "SELECT * FROM profiles WHERE 1";
                $conditions = [];

                // Collect search parameters and add to conditions
                foreach ($searchParams as $key => $value) {
                    if (!empty($value)) {
                        $value = mysqli_real_escape_string($conn, $value);
                        switch ($key) {
                            case 'age_min':
                                $conditions[] = "age >= $value";
                                break;
                            case 'age_max':
                                $conditions[] = "age <= $value";
                                break;
                            default:
                                $conditions[] = "$key = '$value'";
                        }
                    }
                }

                if (!empty($conditions)) {
                    $sql .= " AND " . implode(" AND ", $conditions);
                }

                // Get total number of records for pagination
                $totalResults = mysqli_query($conn, $sql);
                $totalRecords = mysqli_num_rows($totalResults);
                $totalPages = ceil($totalRecords / $recordsPerPage);

                // Add limit to SQL query for pagination
                $sql .= " LIMIT $offset, $recordsPerPage";

                $result = mysqli_query($conn, $sql);

                echo "<h3 class='mt-4'>Search Results</h3>";
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='table table-striped mt-3'>";
                    echo "<thead><tr><th>Name</th><th>Age</th><th>Sex</th><th>Civil Status</th><th>Work Status</th><th>Educational Background</th><th>Youth Classification</th><th>Registered</th></tr></thead><tbody>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['sex'] . "</td>";
                        echo "<td>" . $row['civil_status'] . "</td>";
                        echo "<td>" . $row['work_status'] . "</td>";
                        echo "<td>" . $row['educational_background'] . "</td>";
                        echo "<td>" . $row['youth_classification'] . "</td>";
                        echo "<td>" . $row['register_sk_voter'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";

                    // Pagination
                    echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination justify-content-center">';
                    $disabledPrev = ($currentPage == 1) ? "disabled" : "";
                    echo '<li class="page-item ' . $disabledPrev . '"><a class="page-link" href="advance_search.php?page=' . ($currentPage - 1) . '&' . http_build_query($searchParams) . '">Previous</a></li>';

                    for ($i = 1; $i <= $totalPages; $i++) {
                        $activeClass = ($currentPage == $i) ? "active" : "";
                        echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="advance_search.php?page=' . $i . '&' . http_build_query($searchParams) . '">' . $i . '</a></li>';
                    }

                    $disabledNext = ($currentPage == $totalPages || $totalPages == 0) ? "disabled" : "";
                    echo '<li class="page-item ' . $disabledNext . '"><a class="page-link" href="advance_search.php?page=' . ($currentPage + 1) . '&' . http_build_query($searchParams) . '">Next</a></li>';
                    echo '</ul>';
                    echo '</nav>';
                } else {
                    echo "<div class='alert alert-info mt-3'>No results found.</div>";
                }
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>