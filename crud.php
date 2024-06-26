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
        <p><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
         <a href = "search.php">Search</a>
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

        <a href="homepage.php">back</a>
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

        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Create new Profile</h3>
            <form method = "POST" action = "crud.php">
        <table>
            <tr>
                <td>I. Profile</td>
            </tr>
            <tr>
                <td>
                    Name: <input type = "text" name="lname"  placeholder="Last Name">
                        <input type = "text" name="fname"  placeholder="First Name">
                        <input type = "text" name="mname"  placeholder="Middle Name">
                        <input type = "text" name="suffix"  placeholder="Suffix">
                </td>
            </tr>
            <tr>
                <td><br>
                    Location: <input type = "text" name="region"  placeholder="Region">
                        <input type = "text" name="province"  placeholder="Province">
                        <input type = "text" name="municipality"  placeholder="Municipality">
                        <input type = "text" name="barangay"  placeholder="Barangay">
                        <input type = "text" name="purok"  placeholder="Purok/Zone">
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr><br>
                            <td style="border: 1px solid;">
                                Sex Assigned as Birth: <br>
                                <input type="radio" name="sex" value="Male">Male<br>
                                <input type="radio" name="sex" value="Female">Female
                            </td>
                            <td>
                                Age:<input type="text" name="age" placeholder="Age">
                                Email Address:<input type="email" name="email" placeholder="Email Address"><br><br>
                                Birth Date:<input type="text" name="birth_date" placeholder="Year/Month/Date">
                                Contact Number:<input type="text" name="contactnumber" placeholder="Contact Number">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td><br>II. Demographic Characteristics</td>
            </tr>
             <tr>
                <td>
                    <table>
                        <tr>
                            <td style="border: 1px solid;">
                                Civil Status:<br>
                                <input type="radio" name="civil_status" value="Single"> Single<br>
                                <input type="radio" name="civil_status" value="Married"> Married<br>
                                <input type="radio" name="civil_status" value="Divorced"> Divorced<br>
                                <input type="radio" name="civil_status" value="Widowed"> Widowed<br>
                            </td>
                            <td style="border: 1px solid;">
                                Youth Classification:<br>
                                <input type="radio" name="youth_classification" value="In Youth School"> In Youth School<br>
                                <input type="radio" name="youth_classification" value="Out of School Youth"> Out of School Youth<br>
                                <input type="radio" name="youth_classification" value="Working Youth"> Working Youth<br>
                                <input type="radio" name="youth_classification" value="Person with Disability (PWD)"> Person with Disability (PWD)<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="border: 1px solid;">
                                Your Age Group:<br>
                                <input type="radio" name="age_group" value="Child Youth"> Child Youth(15-17 yrs. old)<br>
                                <input type="radio" name="age_group" value="Core Youth"> Core Youth(18-24 yrs. old)<br>
                                <input type="radio" name="age_group" value="Young adult"> Young adult(25-30 yrs.old)<br>
                            </td>
                            <td style="border: 1px solid;">
                                Work Status:<br>
                                <input type="radio" name="work_status" value="Employed"> Employed<br>
                                <input type="radio" name="work_status" value="Unemployed"> Unemployed<br>
                                <input type="radio" name="work_status" value="Self-Employed"> Self-Employed<br>
                                <input type="radio" name="work_status" value="Currently looking for job"> Currently looking for job<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="border: 1px solid;">
                                Educational Background:<br>
                                <input type="radio" name="educational_background" value="Elementary Level"> Elementary Level<br>
                                <input type="radio" name="educational_background" value="Elementary Graduate"> Elementary Graduate<br>
                                <input type="radio" name="educational_background" value="High School Level"> High School Level<br>
                                <input type="radio" name="educational_background" value="High School Graduate"> High School Graduate<br>
                                <input type="radio" name="educational_background" value="Vocational Graduate"> Vocational Graduate<br>
                                <input type="radio" name="educational_background" value="College Level"> College Level<br>
                                <input type="radio" name="educational_background" value="College Graduate"> College Graduate<br>
                                <input type="radio" name="educational_background" value="Master's Level"> Master's Level<br>
                                <input type="radio" name="educational_background" value="Master's Graduate"> Master's Graduate<br>
                                <input type="radio" name="educational_background" value="Doctrate Level"> Doctrate Level<br>
                            </td>
                            <td style="border: 1px solid;">
                                Registered SK Voter:<br>
                                <input type="radio" name="register_sk_voter" value="Registered"> YES<br>
                                <input type="radio" name="register_sk_voter" value="Not Registered"> NO<br>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <button name="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Retrieve form data
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $purok = $_POST['purok'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];

    // Prepare SQL statement
    $insert = "INSERT INTO profiles 
            (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
             sex, age, email, birth_date, contactnumber, civil_status, youth_classification,
             age_group, work_status, educational_background, register_sk_voter)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
             '$sex', '$age', '$email', '$birth_date', '$contactnumber', '$civil_status', '$youth_classification',
             '$age_group', '$work_status', '$educational_background', '$register_sk_voter')";

    $result = mysqli_query($conn, $insert);

    if($result){
        echo "Record Inserted Successfully";
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}
?>