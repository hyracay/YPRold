<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

// Check if 'role' is set in session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}
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
    background-color: #f0f5f9;
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
    text-transform: capitalize;
}

.sidebar {
    width: 24.5%;
    background-color: #fffcdc;
    padding-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1px solid #fee7d6;
}

.sidebar img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.sidebar p {
    color: #393939; /* White text color */
    text-align: center;
}

.sidebar a {
    font-family: Arial, sans-serif;
    color: #333; /* Dark text color */
    text-decoration: none;
    margin: 10px 0;
    width: 80%;
    text-align: center;
    padding: 12px 18px;
    background-color: #a4b6c2; /* Light gray background */
    display: block;
    transition: background-color 0.3s ease;
}

.sidebar a:hover {
    background-color: #ff6f00; /* Light blue hover */
    color: #fff; /* White text on hover */
}

.sidebar a[href="homepage.php"] {
    background-color: #f37a1f; /* Medium gray */
}

.sidebar a[href="homepage.php"]:hover {
    background-color: #bdbdbd; /* Light gray hover */
}


   </style>
</head>
<body>
<div class="sidebar">
                <img src="src/avatar.png" alt="Avatar" class="img rounded-circle">
                <p>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
                Logged in as: <?php echo $_SESSION['email']; ?></p>
                <a href="viewprofile.php">Back</a>
                <a href="crud.php">Create Profile</a>
                <?php if ($role == 'admin') { echo '<a href="createacc.php">Create Accounts</a>'; } ?>
                <a href="records.php">SK Reports</a>
                <a href="calendar.php">Calendar</a>
                <?php if ($role == 'admin') { echo '<a href="accounts.php">Accounts</a>'; } ?>
                <a href="logout.php">Logout</a>
            </div>
    <div class="container-fluid">
        <div class="row">
            

            <div class="col-md-9 content">
                <h3>Advanced Search</h3>
                <form method="POST" action="advance_search.php">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="age_min">Minimum Age</label>
                            <input type="number" class="form-control" id="age_min" name="age_min" min="15" max="30">
                            <label for="age_max">Maximum Age</label>
                            <input type="number" class="form-control" id="age_max" name="age_max" min="15" max="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="civil_status">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status">
                            <option value="">Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sex">Sex</label>
                        <select class="form-control" id="sex" name="sex">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="work_status">Work Status</label>
                        <select class="form-control" id="work_status" name="work_status">
                            <option value="">Any</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self-Employed">Self-Employed</option>
                            <option value="Currently looking for job">Currently Looking for a Job</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="educational_background">Educational Background</label>
                        <select class="form-control" id="educational_background" name="educational_background">
                            <option value="">Select</option>
                            <option value="Elementary Level">Elementary Level</option>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="High School Level">High School Level</option>
                            <option value="High School Graduate">High School Graduate</option>
                            <option value="Vocational Graduate">Vocational Graduate</option>
                            <option value="College Level">College Level</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="Master Level">Master Level</option>
                            <option value="Master Graduate">Master Graduate</option>
                            <option value="Doctorate Level">Doctorate Level</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="youth_classification">Youth Classification</label>
                        <select class="form-control" id="youth_classification" name="youth_classification">
                            <option value="">Select</option>
                            <option value="In School Youth">In School Youth</option>
                            <option value="Out Of School Youth">Out Of School Youth</option>
                            <option value="Working Youth">Working Youth</option>
                            <option value="Person with Disability (PWD)">Person With Disability (PWD)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="register_sk_voter">Registered SK Voter</label>
                        <select class="form-control" id="register_sk_voter" name="register_sk_voter">
                            <option value="">Select</option>
                            <option value="Registered">YES</option>
                            <option value="Not Registered">NO</option>
                        </select>
                    </div>
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </form>

                <?php
                if (isset($_POST['search'])) {
                    $sql = "SELECT * FROM profiles WHERE 1";
                    $conditions = [];

                    if (!empty($_POST['age_min']) && !empty($_POST['age_max'])) {
                        $age_min = (int)$_POST['age_min'];
                        $age_max = (int)$_POST['age_max'];
                        if ($age_min > $age_max) {
                            echo "<div class='alert alert-danger mt-3'>Minimum age cannot be greater than maximum age.</div>";
                            exit();
                        }
                        $conditions[] = "age BETWEEN $age_min AND $age_max";
                    } elseif (!empty($_POST['age_min'])) {
                        $age_min = (int)$_POST['age_min'];
                        $conditions[] = "age >= $age_min";
                    } elseif (!empty($_POST['age_max'])) {
                        $age_max = (int)$_POST['age_max'];
                        $conditions[] = "age <= $age_max";
                    }

                    if (!empty($_POST['civil_status'])) {
                        $civil_status = $_POST['civil_status'];
                        $conditions[] = "civil_status = '$civil_status'";
                    }

                    if (!empty($_POST['sex'])) {
                        $sex = $_POST['sex'];
                        if ($sex !== "Any") {
                            $conditions[] = "sex = '$sex'";
                        }
                    }

                    if (!empty($_POST['work_status'])) {
                        $work_status = $_POST['work_status'];
                        if ($work_status !== "Any") {
                            $conditions[] = "work_status = '$work_status'";
                        }
                    }

                    if (!empty($_POST['educational_background'])) {
                        $educational_background = $_POST['educational_background'];
                        $conditions[] = "educational_background = '$educational_background'";
                    }

                    if (!empty($_POST['youth_classification'])) {
                        $youth_classification = $_POST['youth_classification'];
                        $conditions[] = "youth_classification = '$youth_classification'";
                    }

                    if (!empty($_POST['register_sk_voter'])) {
                        $register_sk_voter = $_POST['register_sk_voter'];
                        $conditions[] = "register_sk_voter = '$register_sk_voter'";
                    }

                    if (!empty($conditions)) {
                        $sql .= " AND " . implode(" AND ", $conditions);
                    }

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
                    } else {
                        echo "<div class='alert alert-info mt-3'>No results found.</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning mt-3'>Please provide search criteria.</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>