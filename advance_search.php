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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p>Hello <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
         <a href="homepage.php">Back</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
            
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
        
        <h3>Advanced Search by Age</h3>
        <form method="POST" action="advance_search.php">
            <table>
                <tr>
                    <td>Minimum Age: <input type="number" name="age_min" ></td>
                </tr>
                <tr>
                    <td>Maximum Age: <input type="number" name="age_max" ></td>
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
  

               <td>
               <label for="work_status">Work Status</label>
                    <select name="work_status" class="form-control">
                        <option value="">Any</option>
                        <option value="">Any</option>
                        <option value="Employed">Employed</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Self-Employed">Self-Employed</option>
                        <option value="Currently Looking for a Job">Currently Looking for a Job</option>
                    </select>
                </td>
                <tr>
                    <td><input type="submit" name="search" value="Search"></td>
                </tr>
            </table>
        </form>

       <?php
if (isset($_POST['search'])) {
    $age_min = (int)$_POST['age_min'];
    $age_max = (int)$_POST['age_max'];
    $civil_status = $_POST['civil_status'];
    $work_status = $_POST['work_status'];

    // Validate age range
    if ($age_min > $age_max) {
        echo "Minimum age cannot be greater than maximum age.";
    } else {
        $sql = "SELECT * FROM profiles WHERE age BETWEEN $age_min AND $age_max";
        if (!empty($civil_status)) {
            $sql .= " AND civil_status = '$civil_status'";
        }
        if (!empty($educational_background)) {
            $sql .= " AND work_status = '$work_status'";
        }

        // Query the database
        $result = mysqli_query($conn, $sql);

        // Display results
        echo "<h3>Search Results</h3>";
        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Email</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }
} else {
    echo "Please provide an age range.";
}
?>
    </div>
</body>
</html>