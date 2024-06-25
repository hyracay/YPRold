<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: login.php");
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
        <a href="#accounts.php">Accounts</a>
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
                                <input type="radio" name="sex" value="Male">Female
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
                                <input type="radio" name="youth_classification" value="InYouthSchool"> In Youth School<br>
                                <input type="radio" name="youth_classification" value="OutofSchoolYouth"> Out of School Youth<br>
                                <input type="radio" name="youth_classification" value="WorkingYouth"> Working Youth<br>
                                <input type="radio" name="youth_classification" value="PersonwithDisability"> Person with Disability (PWD)<br>
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
                                <input type="radio" name="age_group" value="child"> Child Youth(15-17 yrs. old)<br>
                                <input type="radio" name="age_group" value="core"> Core Youth(18-24 yrs. old)<br>
                                <input type="radio" name="age_group" value="youngadult"> Young adult(25-30 yrs.old)<br>
                            </td>
                            <td style="border: 1px solid;">
                                Work Status:<br>
                                <input type="radio" name="work_status" value="employed"> Employed<br>
                                <input type="radio" name="work_status" value="unemployed"> Unemployed<br>
                                <input type="radio" name="work_status" value="selfemployed"> Self-Employed<br>
                                <input type="radio" name="work_status" value="lookingforjob"> Currently looking for job<br>
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
                                Educational Backround:<br>
                                <input type="radio" name="educational_backround" value="elementarylevel"> Elementary Level<br>
                                <input type="radio" name="educational_backround" value="elementarygrad"> Elementary Graduate<br>
                                <input type="radio" name="educational_backround" value="hslevel"> High School Level<br>
                                <input type="radio" name="educational_backround" value="hsgrad"> High School Graduate<br>
                                <input type="radio" name="educational_backround" value="vocgrad"> Vocational Graduate<br>
                                <input type="radio" name="educational_backround" value="collegelevel"> College Level<br>
                                <input type="radio" name="educational_backround" value="collegegrad"> College Graduate<br>
                                <input type="radio" name="educational_backround" value="masterlevel"> Master's Level<br>
                                <input type="radio" name="educational_backround" value="mastergrad"> Master's Graduate<br>
                                <input type="radio" name="educational_backround" value="doctratelevel"> Doctrate Level<br>
                            </td>
                            <td style="border: 1px solid;">
                                Registered SK Voter:<br>
                                <input type="radio" name="register_sk_voter" value="yesvote"> YES<br>
                                <input type="radio" name="register_sk_voter" value="novote"> NO<br>

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
    $educational_backround = $_POST['educational_backround'];
    $register_sk_voter = $_POST['register_sk_voter'];

    // Prepare SQL statement
    $insert = "INSERT INTO profiles 
            (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
             sex, age, email, birth_date, contactnumber, civil_status, youth_classification,
             age_group, work_status, educational_backround, register_sk_voter)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
             '$sex', '$age', '$email', '$birth_date', '$contactnumber', '$civil_status', '$youth_classification',
             '$age_group', '$work_status', '$educational_backround', '$register_sk_voter')";

    $result = mysqli_query($conn, $insert);

    if($result){
        echo "Record Inserted Successfully";
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}
?>