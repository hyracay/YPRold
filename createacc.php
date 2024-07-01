<?php
    session_start();
    include("conne.php");

    if (!isset($_SESSION['email'])) {
        header("location: index.php");
        exit(); // Ensure that no further code is executed after the redirection
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CREATE USER ACCOUNT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/newcss.css">
    <link rel="stylesheet" type="text/css" href="src/css.css">
</head>
<body>
    
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello ".$_SESSION['fname'] . " " . $_SESSION['lname'] ."!". "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href = "viewprofile.php">Profiles</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">Records</a>
        <a href="calendar.php">Calendar</a>
        <a href="accounts.php">Accounts</a>
        <a href="homepage.php">Back</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Create a user account</h1>
        <div class="table-container">
            <form method="POST" action="createacc.php">
                <section class="vh-100 -custom">
                    <div class="container py-5 h-100">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="col-12 col-lg-9 col-xl-7">
                                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                    <div class="card-body p-4 p-md-5">
                                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                <input type="text" id="firstName" name="fname" class="form-control form-control-lg" />
                                                <label class="form-label" for="firstName">First Name</label>
                                            </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="lastName" name="lname" class="form-control form-control-lg" />
                                                    <label class="form-label" for="lastName">Last Name</label>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                                    <label class="form-label" for="email">Email</label>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-4 ">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4 ">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="password" id="cpassword" name="cpassword" class="form-control form-control-lg" />
                                                    <label class="form-label" for="cpassword">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                    <label for="role">Role:</label>
                                    <select id="role" name="role" class="form-control">
                                    <option value="employee">Employee</option>
                                    <option value="admin">Admin</option>
                                    </select> 
                                        <div class="mt-4 pt-2">
                                            <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit" name="submit" value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    // Retrieve other form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $FirstName = $_POST['fname'];
    $LastName = $_POST['lname'];
    $role = $_POST['role']; 
    // Check if email already exists (your existing code)
    $check_query = "SELECT * FROM account WHERE email = '$email' ";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email already exists');</script>";
        exit();
    }

    if ($password == $cpassword){
        $password = md5($password); // Consider using more secure hashing methods like bcrypt
        // Insert user into database with role
        $sql_insert = "INSERT INTO account(email, password, FirstName, LastName, role) 
                       VALUES('$email','$password', '$FirstName', '$LastName', '$role')";
        $result_insert = mysqli_query($conn, $sql_insert);
        if ($result_insert) {
            echo "<script>alert('User Successfully Registered.');</script>";
        } else {
            echo "<script>alert('Error registering user.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}

?>