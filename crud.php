<?php
session_start();
include ("conne.php");

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
    <link rel="stylesheet" type="text/css" href="src/temp.css">
</head>

<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
            Logged in as: <?php echo $_SESSION['email']; ?></p>
            <a href="viewprofile.php">Profiles</a>
        <a href="homepage.php">Back</a>
        <a href="records.php">SK Reports</a>
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
        <h1>Create new youth Profile</h1>
        <button id="importBtn">Import</button>
        <form method="POST" action="crud.php">
            <table>
                <tr>
                    <td>I. Profile</td>
                </tr>
                <tr>
                    <td>
                        Name: <input type="text" name="lname" placeholder="Last Name" required>
                        <input type="text" name="fname" placeholder="First Name" required>
                        <input type="text" name="mname" placeholder="Middle Name" required>
                        <input type="text" name="suffix" placeholder="Suffix" required>
                    </td>
                </tr>
                <tr>
                    <td><br>
                        Location: <input type="text" name="region" placeholder="Region" required>
                        <input type="text" name="province" placeholder="Province" required>
                        <input type="text" name="municipality" placeholder="Municipality" required>
                        <input type="text" name="barangay" placeholder="Barangay" required>
                        <input type="text" name="purok" placeholder="Purok/Zone" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr><br>
                                <td style="border: 1px solid;">
                                    Sex Assigned as Birth: <br>
                                    <input type="radio" name="sex" value="Male" required>Male<br>
                                    <input type="radio" name="sex" value="Female" required>Female
                                </td>
                                <td>
                                    Age:<input type="text" name="age" placeholder="Age">
                                    Email Address:<input type="email" name="email" placeholder="Email Address" required><br><br>
                                    Birth Date:<input type="date" name="birth_date" placeholder="Year/Month/Date" required>
                                    Contact Number:<input type="text" name="contactnumber" placeholder="Contact Number" required>
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
                                    <input type="radio" name="civil_status" value="Single" required> Single<br>
                                    <input type="radio" name="civil_status" value="Married" required> Married<br>
                                    <input type="radio" name="civil_status" value="Divorced" required> Divorced<br>
                                    <input type="radio" name="civil_status" value="Widowed" required> Widowed<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Youth Classification:<br>
                                    <input type="radio" name="youth_classification" value="In Youth School" required> In Youth
                                    School<br>
                                    <input type="radio" name="youth_classification" value="Out of School Youth" required> Out of
                                    School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" required> Working
                                    Youth<br>
                                    <input type="radio" name="youth_classification"
                                        value="Person with Disability (PWD)" required> Person with Disability (PWD)<br>
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
                                    <input type="radio" name="age_group" value="Child Youth" required> Child Youth(15-17 yrs.
                                    old)<br>
                                    <input type="radio" name="age_group" value="Core Youth" required> Core Youth(18-24 yrs.
                                    old)<br>
                                    <input type="radio" name="age_group" value="Young adult" required> Young adult(25-30
                                    yrs.old)<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Work Status:<br>
                                    <input type="radio" name="work_status" value="Employed" required> Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" required> Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" required> Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" required> Currently
                                    looking for job<br>
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
                                    <input type="radio" name="educational_background" value="Elementary Level" required>
                                    Elementary Level<br>
                                    <input type="radio" name="educational_background" value="Elementary Graduate" required>
                                    Elementary Graduate<br>
                                    <input type="radio" name="educational_background" value="High School Level" required> High
                                    School Level<br>
                                    <input type="radio" name="educational_background" value="High School Graduate" required> High
                                    School Graduate<br>
                                    <input type="radio" name="educational_background" value="Vocational Graduate" required>
                                    Vocational Graduate<br>
                                    <input type="radio" name="educational_background" value="College Level" required> College
                                    Level<br>
                                    <input type="radio" name="educational_background" value="College Graduate" required> College
                                    Graduate<br>
                                    <input type="radio" name="educational_background" value="Master Level" required> Master's
                                    Level<br>
                                    <input type="radio" name="educational_background" value="Master Graduate" required>
                                    Master's Graduate<br>
                                    <input type="radio" name="educational_background" value="Doctrate Level" required> Doctrate
                                    Level<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Registered SK Voter:<br>
                                    <input type="radio" name="register_sk_voter" value="Registered" required> YES<br>
                                    <input type="radio" name="register_sk_voter" value="Not Registered" required> NO<br>

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

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalInside">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <label for="csvFile">Choose CSV File:</label>
                    <input type="file" name="csvFile" id="csvFile" accept=".csv">
                    <button type="submit" name="upload">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const importBtn = document.getElementById('importBtn');
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        importBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
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

    if ($result) {
        echo "Record Inserted Successfully";
    } else {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}
?>