<?php
session_start();
include("../conne.php");

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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve existing profile data (using prepared statement to prevent SQL injection)
    $query = "SELECT * FROM profiles_archive WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $profile = mysqli_fetch_array($result);
    } else {
        echo "No profile found with the specified ID.";
        exit();
    }
} else {
    echo "No profile ID specified.";
    exit();
}

if (isset($_POST['update'])) {
    // Retrieve form data (sanitize input to prevent XSS attacks)
    $id = $_POST['id'];
    $lname = htmlspecialchars($_POST['lname']);
    $fname = htmlspecialchars($_POST['fname']);
    $mname = htmlspecialchars($_POST['mname']);
    $suffix = htmlspecialchars($_POST['suffix']);
    $region = htmlspecialchars($_POST['region']);
    $province = htmlspecialchars($_POST['province']);
    $municipality = htmlspecialchars($_POST['municipality']);
    $barangay = htmlspecialchars($_POST['barangay']);
    $sitio = htmlspecialchars($_POST['sitio']);
    $purok = htmlspecialchars($_POST['purok']);
    $sex = $_POST['sex']; // Ensure this is sanitized or validated
    $age = $_POST['age']; // Ensure this is sanitized or validated
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    $birth_year = $_POST['birth_year'];
    $contactnumber = htmlspecialchars($_POST['contactnumber']);
    $civil_status = $_POST['civil_status']; // Ensure this is sanitized or validated
    $youth_classification = $_POST['youth_classification']; // Ensure this is sanitized or validated
    $age_group = $_POST['age_group']; // Ensure this is sanitized or validated
    $work_status = $_POST['work_status']; // Ensure this is sanitized or validated
    $educational_background = $_POST['educational_background']; // Ensure this is sanitized or validated
    $register_sk_voter = $_POST['register_sk_voter']; // Ensure this is sanitized or validated
    $voted_last_election = isset($_POST['voted_last_election']) ? $_POST['voted_last_election'] : '';
    $attended_kk = isset($_POST['attended_kk']) ? $_POST['attended_kk'] : '';
    $times_attended_kk = htmlspecialchars($_POST['times_attended_kk']);

    // Prepare SQL statement (using prepared statement to prevent SQL injection)
    $update = "UPDATE profiles_archive SET 
            lname = ?,
            fname = ?,
            mname = ?,
            suffix = ?,
            region = ?,
            province = ?,
            municipality = ?,
            barangay = ?,
            sitio = ?,
            purok = ?,
            sex = ?,
            age = ?,
            email = ?,
            birth_month = ?,
            birth_day = ?,
            birth_year = ?,
            contactnumber = ?,
            civil_status = ?,
            youth_classification = ?,
            age_group = ?,
            work_status = ?,
            educational_background = ?,
            register_sk_voter = ?,
            voted_last_election = ?,
            attended_kk = ?,
            times_attended_kk = ?
        WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, 'sssssssssssisississsssssssi', 
        $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $sitio, $purok, $sex, $age,
        $email, $birth_month, $birth_day, $birth_year, $contactnumber, $civil_status, $youth_classification, $age_group,
        $work_status, $educational_background, $register_sk_voter, $voted_last_election, $attended_kk, $times_attended_kk, $id);
    
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("location: temp_archive.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
        exit();
    }
}

function calculateAge() {
    // This function can remain as it is, for calculating age dynamically in the form.
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDIT PROFILE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
    <link rel="stylesheet" type="text/css" href="src/update.css">
    <style>
        button[name="update"] {
            background-color: #1d5f85;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button[name="update"]:hover {
            background-color: #0056b3;
        }
    </style>
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
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>

        <a href="homepage.php">Back</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        
        <?php if ($role == 'admin'): ?>
            <a href="accounts.php">Accounts</a>
            <a href="createacc.php">Create Accounts</a>
        <?php endif; ?>
       
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Update Profile</h3>
        <form method="POST" action="temp_update_archive.php?id=<?php echo $id; ?>" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
            <table>
                <tr>
                    <td>I. Profile</td>
                </tr>
                <tr>
                    <td>
                        Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $profile['lname']; ?>" required>
                              <input type="text" name="fname" placeholder="First Name" value="<?php echo $profile['fname']; ?>" required>
                              <input type="text" name="mname" placeholder="Middle Name" value="<?php echo $profile['mname']; ?>">
                              <input type="text" name="suffix" placeholder="Suffix" value="<?php echo $profile['suffix']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Region: <input type="text" name="region" placeholder="Region" value="<?php echo $profile['region']; ?>"></td>
                </tr>
                <tr>
                    <td>
                        Province: <input type="text" name="province" placeholder="Province" value="<?php echo $profile['province']; ?>">
                        Municipality: <input type="text" name="municipality" placeholder="Municipality" value="<?php echo $profile['municipality']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Sitio: <input type="text" name="sitio" placeholder="Sitio" value="<?php echo $profile['sitio']; ?>">
                        Barangay: <input type="text" name="barangay" placeholder="Barangay" value="<?php echo $profile['barangay']; ?>">
                        Purok: <input type="text" name="purok" placeholder="Purok" value="<?php echo $profile['purok']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Sex:
                        <input type="radio" name="sex" value="Male" <?php if ($profile['sex'] === 'Male') echo 'checked'; ?>> Male
                        <input type="radio" name="sex" value="Female" <?php if ($profile['sex'] === 'Female') echo 'checked'; ?>> Female
                    </td>
                </tr>
                
                <tr>
                    <td>Email: <input type="email" name="email" placeholder="Email" value="<?php echo $profile['email']; ?>"></td>
                </tr>
                <tr>
                    <td>
                        Birthdate:
                        <select name="birth_month" onchange="calculateAge()">
                            <option value="">Month</option>
                            <?php
                            $months = array("January", "February", "March", "April", "May", "June",
                                            "July", "August", "September", "October", "November", "December");
                            foreach ($months as $key => $month) {
                                $selected = ($profile['birth_month'] == $key + 1) ? 'selected' : '';
                                echo "<option value='" . ($key + 1) . "' $selected>$month</option>";
                            }
                            ?>
                        </select>
                        <input type="number" name="birth_day" placeholder="Day" min="1" max="31" value="<?php echo $profile['birth_day']; ?>" onchange="calculateAge()">
                        <input type="number" name="birth_year" placeholder="Year" min="1900" max="2100" value="<?php echo $profile['birth_year']; ?>" onchange="calculateAge()">
                    </td>
                </tr>
                <tr>
                    <td>
                        Age: <input type="text" name="age" id="age" value="<?php echo $profile['age']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Contact Number: <input type="text" name="contactnumber" placeholder="Contact Number" value="<?php echo $profile['contactnumber']; ?>"></td>
                </tr>
                <tr>
                    <td>
                        Civil Status:
                        <select name="civil_status">
                            <option value="Single" <?php if ($profile['civil_status'] === 'Single') echo 'selected'; ?>>Single</option>
                            <option value="Married" <?php if ($profile['civil_status'] === 'Married') echo 'selected'; ?>>Married</option>
                            <option value="Divorced" <?php if ($profile['civil_status'] === 'Divorced') echo 'selected'; ?>>Divorced</option>
                            <option value="Widowed" <?php if ($profile['civil_status'] === 'Widowed') echo 'selected'; ?>>Widowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Youth Classification:
                        <select name="youth_classification">
                            <option value="SK Official" <?php if ($profile['youth_classification'] === 'SK Official') echo 'selected'; ?>>SK Official</option>
                            <option value="SK Member" <?php if ($profile['youth_classification'] === 'SK Member') echo 'selected'; ?>>SK Member</option>
                            <option value="Not SK" <?php if ($profile['youth_classification'] === 'Not SK') echo 'selected'; ?>>Not SK</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td hidden>
                        Age Group:
                        <input type="radio" name="age_group" value="Child Youth" <?php if ($profile['age_group'] === 'Child Youth') echo 'checked'; ?>> Child Youth
                        <input type="radio" name="age_group" value="Core Youth" <?php if ($profile['age_group'] === 'Core Youth') echo 'checked'; ?>> Core Youth
                        <input type="radio" name="age_group" value="Young Adult" <?php if ($profile['age_group'] === 'Young Adult') echo 'checked'; ?>> Young Adult
                    </td>
                </tr>
                <tr>
                    <td>
                        Work Status:
                        <select name="work_status">
                            <option value="Employed" <?php if ($profile['work_status'] === 'Employed') echo 'selected'; ?>>Employed</option>
                            <option value="Unemployed" <?php if ($profile['work_status'] === 'Unemployed') echo 'selected'; ?>>Unemployed</option>
                            <option value="Self-employed" <?php if ($profile['work_status'] === 'Self-employed') echo 'selected'; ?>>Self-employed</option>
                            <option value="Student" <?php if ($profile['work_status'] === 'Student') echo 'selected'; ?>>Student</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Educational Background:
                        <select name="educational_background">
                            <option value="Elementary" <?php if ($profile['educational_background'] === 'Elementary') echo 'selected'; ?>>Elementary</option>
                            <option value="High School" <?php if ($profile['educational_background'] === 'High School') echo 'selected'; ?>>High School</option>
                            <option value="College" <?php if ($profile['educational_background'] === 'College') echo 'selected'; ?>>College</option>
                            <option value="Vocational" <?php if ($profile['educational_background'] === 'Vocational') echo 'selected'; ?>>Vocational</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Registered SK Voter:
                        <input type="radio" name="register_sk_voter" value="Yes" <?php if ($profile['register_sk_voter'] === 'Yes') echo 'checked'; ?>> Yes
                        <input type="radio" name="register_sk_voter" value="No" <?php if ($profile['register_sk_voter'] === 'No') echo 'checked'; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>
                        Voted Last Election:
                        <input type="checkbox" name="voted_last_election" value="Yes" <?php if ($profile['voted_last_election'] === 'Yes') echo 'checked'; ?>> Yes
                    </td>
                </tr>
                <tr>
                    <td>
                        Attended KK:
                        <input type="checkbox" name="attended_kk" value="Yes" <?php if ($profile['attended_kk'] === 'Yes') echo 'checked'; ?>> Yes
                        Times Attended: <input type="number" name="times_attended_kk" value="<?php echo $profile['times_attended_kk']; ?>">
                    </td>
                </tr>
            </table>
            <br>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
