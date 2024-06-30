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
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADVANCE SEARCH</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="homepage.php">Back</a>
        <a href="records.php">SK Reports</a>
        <?php if ($role == 'admin') { echo '<a href="createacc.php">Create Accounts</a>'; } ?>
        <a href="crud.php">Create Profile</a>
        <?php if ($role == 'admin') { echo '<a href="accounts.php">Accounts</a>'; } ?>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Advanced Search</h3>
        <form method="POST" action="advance_search.php">
            <table>
                <tr>
                    <td>Minimum Age: <input type="number" name="age_min" min="15" max="30"></td>
                </tr>
                <tr>
                    <td>Maximum Age: <input type="number" name="age_max" min="15" max="30"></td>
                </tr>
                <tr>
                    <td>Civil Status:
                        <select name="civil_status">
                            <option value="">Select</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </td>
                </tr>


                <tr>
                    <td>Sex:
                        <select name="sex">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>                           
                        </select>
                    </td>
                </tr>



                <tr>
                    <td>Work Status:
                        <select name="work_status">
                            <option value="">Any</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self-Employed">Self-Employed</option>
                            <option value="Currently looking for job">Currently Looking for a Job</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Educational Background:
                        <select name="educational_background">
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
                            <option value="Doctrate Level">Doctorate Level</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Youth Classification:
                        <select name="youth_classification">
                            <option value="">Select</option>
                            <option value="In Youth School">In School Youth</option>
                            <option value="Out Of School Youth">Out Of School Youth</option>
                            <option value="Working Youth">Working Youth</option>
                            <option value="Person with Disability (PWD)">Person With Disability (PWD)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Registered SK Voters:
                        <select name="register_sk_voter">
                            <option value="">Select</option>
                            <option value="Registered">YES</option>
                            <option value="Not Registered">NO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="search" value="Search"></td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['search'])) {
            $sql = "SELECT * FROM profiles WHERE 1";
            $conditions = [];

            if (!empty($_POST['age_min']) && !empty($_POST['age_max'])) {
                $age_min = (int)$_POST['age_min'];
                $age_max = (int)$_POST['age_max'];
                if ($age_min > $age_max) {
                    echo "Minimum age cannot be greater than maximum age.";
                    exit();
                }
                $conditions[] = "age BETWEEN $age_min AND $age_max";
            }

            if (!empty($_POST['civil_status'])) {
                $civil_status = $_POST['civil_status'];
                $conditions[] = "civil_status = '$civil_status'";
            }

            if (!empty($_POST['sex'])) {
                $sex = $_POST['sex'];
                if ($sex!== "Any") {
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

            echo "<h3>Search Results</h3>";
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Age</th><th>Sex</th><th>Civil Status</th><th>Work Status</th><th>Educational Background</th><th>Youth Classification</th><th>Registered</th></tr>";
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


                }
                echo "</table>";
            } else {
                echo "No results found.";
            }
        } else {
            echo "Please provide search criteria.";
        }
        ?>
    </div>
</body>
</html>