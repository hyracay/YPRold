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
    echo "Role information not found. Please contact administrator.";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CREATE YOUTH PROFILE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
    <link rel="stylesheet" type="text/css" href="src/crud.css">
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
        <form method="POST" action="crud.php" autocomplete="off">
            <table>
                <tr>
                    <td>I. Profile</td>
                </tr>
                <tr>
                    <td>
                        Name:<br>
                        <input type="text" name="lname" placeholder="Last Name" required>
                        <input type="text" name="fname" placeholder="First Name" required><br>
                        <input type="text" name="mname" placeholder="Middle Name" required>
                        <input type="text" name="suffix" placeholder="Suffix">
                    </td>
                </tr>
                <tr>
                    <td><br>
                        Location:<br>
                        <input type="text" name="region" placeholder="Region" value="CAR" required>
                        <input type="text" name="province" placeholder="Province" value="BEN" required>
                        <input type="text" name="municipality" placeholder="Municipality" value="La Trinidad" required><br>
                        <input type="text" name="barangay" placeholder="Barangay" value="Tawang" required>
                        <input type="text" name="purok" placeholder="Purok/Zone" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <td>Sex:<br>
                                <input type="radio" name="sex" value="Male" required> Male<br>
                                <input type="radio" name="sex" value="Female" required> Female<br>
                            </td>
                            <td>
                                Birth Date:<br>
                                <select name="birth_month" required onchange="calculateAge()">
                                    <option value="">Month</option>
                                    <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                        <option value="<?php echo $m; ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                    <?php } ?>
                                </select>
                                <select name="birth_day" required onchange="calculateAge()">
                                    <option value="">Day</option>
                                    <?php for ($d = 1; $d <= 31; ++$d) { ?>
                                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="number" name="birth_year" placeholder="Year" required oninput="calculateAge()">
                            </td>
                            <td>
                                Age:<input type="text" name="age" style="width: 20%" id="age" placeholder="Age" readonly><br>
                            </td>
                            Email Address:<input type="email" name="email" placeholder="Email Address"><br>
                            Contact Number:<input type="text" name="contactnumber" placeholder="Contact Number" required>
                            <script>
    function calculateAge() {
        var birthMonth = document.getElementsByName("birth_month")[0].value;
        var birthDay = document.getElementsByName("birth_day")[0].value;
        var birthYear = document.getElementsByName("birth_year")[0].value;

        if (birthMonth && birthDay && birthYear) {
            // Create a date string in the format accepted by Date constructor
            var birthDateString = birthYear + '-' + birthMonth + '-' + birthDay;
            var birthDate = new Date(birthDateString);

            // Adjust for Manila time zone (GMT+8)
            var manilaOffset = 8 * 60; // Offset in minutes
            birthDate.setMinutes(birthDate.getMinutes() + manilaOffset);

            // Now proceed with age calculation as before
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.getElementById("age").value = age;

            // Set age group based on age
            var ageGroup = '';
            if (age >= 15 && age <= 17) {
                ageGroup = 'Child Youth';
            } else if (age >= 18 && age <= 24) {
                ageGroup = 'Core Youth';
            } else if (age >= 25 && age <= 30) {
                ageGroup = 'Young Adult';
            }

            // Check the appropriate radio button for age_group
            var radios = document.getElementsByName('age_group');
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].value === ageGroup) {
                    radios[i].checked = true;
                }
            }
        }
    }
</script>

                            </td>
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
                                <td>
                                    Civil Status:<br>
                                    <input type="radio" name="civil_status" value="Single" required> Single<br>
                                    <input type="radio" name="civil_status" value="Married" required> Married<br>
                                    <input type="radio" name="civil_status" value="Divorced" required> Divorced<br>
                                    <input type="radio" name="civil_status" value="Widowed" required> Widowed<br>
                                </td>
                                <td>
                                    Youth Classification:<br>
                                    <input type="radio" name="youth_classification" value="In School Youth" required> In School Youth<br>
                                    <input type="radio" name="youth_classification" value="Out Of School Youth" required> Out Of School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" required> Working Youth<br>
                                    <input type="radio" name="youth_classification" value="Person With Disability (PWD)" required> Person With Disability (PWD)<br>
                                </td>
                                <td>
                                    Work Status:<br>
                                    <input type="radio" name="work_status" value="Student" required> Student<br>
                                    <input type="radio" name="work_status" value="Employed" required> Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" required> Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" required> Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" required> Currently Looking For Job<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td hidden>
                                    Age Group:<br>
                                    <input type="radio" name="age_group" value="Child Youth" hidden> Child Youth (15-17 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Core Youth" hidden> Core Youth (18-24 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Young Adult" hidden> Young Adult (25-30 yrs. old)<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                                <td>
                                    Educational Background:<br>
                                    <input type="radio" name="educational_background" value="Elementary Level" required> Elementary Level<br>
                                    <input type="radio" name="educational_background" value="Elementary Graduate" required> Elementary Graduate<br>
                                    <input type="radio" name="educational_background" value="High School Level" required> High School Level<br>
                                    <input type="radio" name="educational_background" value="High School Graduate" required> High School Graduate<br>
                                    <input type="radio" name="educational_background" value="Vocational Graduate" required> Vocational Graduate<br>
                                    <input type="radio" name="educational_background" value="College Level" required> College Level<br>
                                    <input type="radio" name="educational_background" value="College Graduate" required> College Graduate<br>
                                    <input type="radio" name="educational_background" value="Master Level" required> Master's Level<br>
                                    <input type="radio" name="educational_background" value="Master Graduate" required> Master's Graduate<br>
                                    <input type="radio" name="educational_background" value="Doctorate Level" required> Doctorate Level<br>
                                </td>
                </tr>
                <tr>
                    <td>
                        Registered SK Voter:<br>
                        <input type="radio" name="register_sk_voter" value="Registered" required> Yes<br>
                        <input type="radio" name="register_sk_voter" value="Not Registered" required> No<br>
                    </td>
                </tr>
                <tr>
                    <td>
                        Voted Last Election:<br>
                        <input type="radio" name="voted_last_election" value="Yes" required> Yes<br>
                        <input type="radio" name="voted_last_election" value="No" required> No<br>
                    </td>
                </tr>
                <tr>
                <td>
                  Attended Linggo ng Kabataan (KK) Activities:<br>
                  <input type="radio" name="attended_kk" value="Yes" required onclick="showHideTimesAttended()"> Yes<br>
                 <input type="radio" name="attended_kk" value="No" required onclick="showHideTimesAttended()"> No<br>
                 <div id="times_attended_kk_div" style="display: none;">
                 Times attended KK:<br>
                 <input type="text" name="times_attended_kk" placeholder="How many times?">
    </div>
</td>

<script>
    function showHideTimesAttended() {
        var attendedKK = document.querySelector('input[name="attended_kk"]:checked').value;
        var timesAttendedKKDiv = document.getElementById('times_attended_kk_div');

        if (attendedKK === 'Yes') {
            timesAttendedKKDiv.style.display = 'block';
        } else {
            timesAttendedKKDiv.style.display = 'none';
        }
    }
</script>

          </tr>
          <tr>
                    <td>
                        <button name="submit">Submit</button>
                        <button id="importBtn">Import</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div id="myModal" class="modal">
        <div class="modalContent">
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
    date_default_timezone_set('Asia/Manila');
    $date_created = date('m/d/y');

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
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    $birth_year = $_POST['birth_year'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];
    $voted_last_election = $_POST['voted_last_election'];
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = $_POST['times_attended_kk'];

    // Prepare SQL statement for profiles
    $insert_profiles = "INSERT INTO profiles 
        (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
        sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
        age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created)
        VALUES 
        ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
        '$sex', '$age', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
        '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$attended_kk', '$times_attended_kk', '$date_created')";

    // Prepare SQL statement for profiles_backup
    $insert_profiles_backup = "INSERT INTO profiles_backup 
        (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
        sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
        age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created)
        VALUES 
        ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
        '$sex', '$age', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
        '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$attended_kk', '$times_attended_kk', '$date_created')";

    $result_profiles = mysqli_query($conn, $insert_profiles);
    $result_profiles_backup = mysqli_query($conn, $insert_profiles_backup);

    if (!$result_profiles) {
        echo "Error: " . $insert_profiles . "<br>" . mysqli_error($conn);
    } elseif (!$result_profiles_backup) {
        echo "Error: " . $insert_profiles_backup . "<br>" . mysqli_error($conn);
    }
}
?>