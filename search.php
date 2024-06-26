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
        <p><?php echo "Hello ".$_SESSION['fname'] . " " . $_SESSION['lname'] ."!". "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href = "homepage.php">Back</a>
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
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
        } elseif ($role == 'employee') {
            // For employees, you can customize what to display or leave it empty
            // Here, we do nothing to omit displaying "Create Accounts"

        } else {
            // Handle unexpected roles (optional)
            echo "Unknown role.";
        }
        ?>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="search-container">
        <form action="search.php" method="get">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
            <title>SEARCH BAR</title>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h4>Search Bar</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">

                                            <form action="" method="GET">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Profiles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $con = mysqli_connect("localhost","root","","wis");

                                                if(isset($_GET['search']))
                                                {
                                                    $filtervalues = $_GET['search'];
                                                    $query = "SELECT * FROM profiles WHERE CONCAT(fname,lname,email) LIKE '%$filtervalues%' ";
                                                    $query_run = mysqli_query($con, $query);

                                                    if(mysqli_num_rows($query_run) > 0)
                                                    {
                                                        foreach($query_run as $items)
                                                        {
                                                            ?>
                                                            <tr>
                                                                <td><?= $items['id']; ?></td>
                                                                <td><?= $items['fname']; ?></td>
                                                                <td><?= $items['lname']; ?></td>
                                                                <td><?= $items['email']; ?></td>
                                                                <td><a href="viewprofile.php?id=<?= $items['id']; ?>">View Profile</a></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td colspan="4">No Record Found</td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </div>
        
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

