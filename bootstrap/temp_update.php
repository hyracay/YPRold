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

    // Retrieve existing profile data
    $query = "SELECT * FROM profiles WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $profile = mysqli_fetch_assoc($result);
    } else {
        echo "No profile found with the specified ID.";
        exit();
    }
} else {
    echo "No profile ID specified.";
    exit();
}

if (isset($_POST['update'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sitio = $_POST['sitio'];
    $purok = $_POST['purok'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $youth_with_needs= $_POST['youth_with_needs'];
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
    $national_voter = isset($_POST['national_voter']) ? $_POST['national_voter'] : '';
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = isset($_POST['times_attended_kk']) ? $_POST['times_attended_kk'] : '';
    $no_why = isset($_POST['no_why']) ? $_POST['no_why'] : '';
    
    // Prepare SQL statement
    $update = "UPDATE profiles SET 
            lname = '$lname',
            fname = '$fname',
            mname = '$mname',
            suffix = '$suffix',
            region = '$region',
            province = '$province',
            municipality = '$municipality',
            barangay = '$barangay',
            sitio = '$sitio',
            purok = '$purok',
            sex = '$sex',
            age = '$age',
            youth_with_needs = '$youth_with_needs',
            email = '$email',
            birth_month = '$birth_month',
            birth_day = '$birth_day',
            birth_year = '$birth_year',
            contactnumber = '$contactnumber',
            civil_status = '$civil_status',
            youth_classification = '$youth_classification',
            age_group = '$age_group',
            work_status = '$work_status',
            educational_background = '$educational_background',
            register_sk_voter = '$register_sk_voter',
            voted_last_election = '$voted_last_election',
            national_voter = '$national_voter',
            attended_kk = '$attended_kk',
            times_attended_kk = '$times_attended_kk',
            no_why = '$no_why'
        WHERE id = $id";

    $result = mysqli_query($conn, $update);

    if ($result) {
        header("location: temp_profiles.php");
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
function calculateAge($birth_year, $birth_month, $birth_day) {
    $birthDate = "$birth_year-$birth_month-$birth_day";
    $age = date_diff(date_create($birthDate), date_create('today'))->y;
    return $age;
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
</head>
<body>

    <div class="content">
        <h3>Update Profile</h3>
        <form method="POST" action="temp_update.php?id=<?php echo $id; ?>">
            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
            <table>
                <tr>
                    <td>I. Profile</td>
                </tr>
                <tr>
                    <td>
                        Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $profile['lname']; ?>" required>
                              <input type="text" name="fname" placeholder="First Name" value="<?php echo $profile['fname']; ?>" required>
                              <input type="text" name="mname" placeholder="Middle Name" value="<?php echo $profile['mname']; ?>" required>
                              <input type="text" name="suffix" placeholder="Suffix" value="<?php echo $profile['suffix']; ?>" >
                    </td>
                </tr>
                <tr>
                    <td><br>
                        Location: <input type="text" name="region" placeholder="Region" value="<?php echo $profile['region']; ?>" required>
                                  <input type="text" name="province" placeholder="Province" value="<?php echo $profile['province']; ?>" required>
                                  <input type="text" name="municipality" placeholder="Municipality" value="<?php echo $profile['municipality']; ?>" required>
                                  <input type="text" name="sitio" placeholder="Sitio" value="<?php echo $profile['sitio']; ?>" required>
                                  <input type="text" name="barangay" placeholder="Barangay" value="<?php echo $profile['barangay']; ?>" required>
                                  <input type="text" name="purok" placeholder="Purok/Zone" value="<?php echo $profile['purok']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr><br>
                                <td style="border: 1px solid;">
                                    Sex : <br>
                                    <input type="radio" name="sex" value="Male" <?php if ($profile['sex'] == 'Male') echo 'checked'; ?> required>Male<br>
                                    <input type="radio" name="sex" value="Female" <?php if ($profile['sex'] == 'Female') echo 'checked'; ?> required>Female
                                </td>
                                <td>
                                <td>
                                Birth Date:<br>
                                <select name="birth_month" required onchange="calculateAge()">
                                    <option value="">Month</option>
                                    <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                        <option value="<?php echo $m; ?>" <?php if ($profile['birth_month'] == $m) echo 'selected'; ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                    <?php } ?>
                                </select>
                                <select name="birth_day" required onchange="calculateAge()">
                                    <option value="">Day</option>
                                    <?php for ($d = 1; $d <= 31; ++$d) { ?>
                                        <option value="<?php echo $d; ?>" <?php if ($profile['birth_day'] == $d) echo 'selected'; ?>><?php echo $d; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="text" name="birth_year" placeholder="Year" value="<?php echo $profile['birth_year']; ?>" required onchange="calculateAge()">
                                <td>
                                    Age:<br>
                                    <input type="text" name="age" style="width: 20%" id="age" value="<?php echo $profile['age']; ?>" readonly>
                                </td>
                                <tr>
                                    <td>
                                        Youth with Specific Needs:<br>
                                        <input type="text" name="youth_with_needs" value="<?php echo $profile['youth_with_needs']; ?>" placeholder="Specify specific needs">
                                    </td>
                                </tr>
                                </tr>
                                        
                                    Email Address: <input type="email" name="email" placeholder="Email Address" value="<?php echo $profile['email']; ?>" required><br><br>
                                    
                                    Contact Number: <input type="text" name="contactnumber" placeholder="Contact Number" value="<?php echo $profile['contactnumber']; ?>" required>
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
                                    <input type="radio" name="civil_status" value="Single" <?php if ($profile['civil_status'] == 'Single') echo 'checked'; ?> required>Single<br>
                                    <input type="radio" name="civil_status" value="Married" <?php if ($profile['civil_status'] == 'Married') echo 'checked'; ?> required>Married<br>
                                    <input type="radio" name="civil_status" value="Divorced" <?php if ($profile['civil_status'] == 'Divorced') echo 'checked'; ?> required>Divorced<br>
                                    <input type="radio" name="civil_status" value="Widowed" <?php if ($profile['civil_status'] == 'Widowed') echo 'checked'; ?> required>Widowed<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Youth Classification:<br>
                                    <input type="radio" name="youth_classification" value="In Youth School" <?php if ($profile['youth_classification'] == 'In Youth School') echo 'checked'; ?> required>In Youth School<br>
                                    <input type="radio" name="youth_classification" value="Out of School Youth" <?php if ($profile['youth_classification'] == 'Out of School Youth') echo 'checked'; ?> required>Out of School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" <?php if ($profile['youth_classification'] == 'Working Youth') echo 'checked'; ?> required>Working Youth<br>
                                    <input type="radio" name="youth_classification" value="Person with Disability (PWD)" <?php if ($profile['youth_classification'] == 'Person with Disability (PWD)') echo 'checked'; ?> required>Person with Disability (PWD)<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td style="border: 1px solid;" hidden>
                                    Your Age Group:<br>
                                    <input type="radio" name="age_group" value="Child Youth" <?php if ($profile['age_group'] == 'Child Youth') echo 'checked'; ?> hidden>Child Youth (15-17 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Core Youth" <?php if ($profile['age_group'] == 'Core Youth') echo 'checked'; ?> hidden>Core Youth (18-24 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Young Adult" <?php if ($profile['age_group'] == 'Young Adult') echo 'checked'; ?> hidden>Young Adult (25-30 yrs. old)<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Work Status:<br>
                                    <input type="radio" name="work_status" value="Employed" <?php if ($profile['work_status'] == 'Student') echo 'checked'; ?> required>Student<br>
                                    <input type="radio" name="work_status" value="Employed" <?php if ($profile['work_status'] == 'Employed') echo 'checked'; ?> required>Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" <?php if ($profile['work_status'] == 'Unemployed') echo 'checked'; ?> required>Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" <?php if ($profile['work_status'] == 'Self-Employed') echo 'checked'; ?> required>Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" <?php if ($profile['work_status'] == 'Currently looking for job') echo 'checked'; ?> required>Currently looking for job<br>
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
                                    <input type="radio" name="educational_background" value="Elementary Level" <?php if ($profile['educational_background'] == 'Elementary Level') echo 'checked'; ?> required>Elementary Level<br>
                                    <input type="radio" name="educational_background" value="Elementary Graduate" <?php if ($profile['educational_background'] == 'Elementary Graduate') echo 'checked'; ?> required>Elementary Graduate<br>
                                    <input type="radio" name="educational_background" value="High School Level" <?php if ($profile['educational_background'] == 'High School Level') echo 'checked'; ?> required>High School Level<br>
                                    <input type="radio" name="educational_background" value="High School Graduate" <?php if ($profile['educational_background'] == 'High School Graduate') echo 'checked'; ?> required>High School Graduate<br>
                                    <input type="radio" name="educational_background" value="Vocational Graduate" <?php if ($profile['educational_background'] == 'Vocational Graduate') echo 'checked'; ?> required>Vocational Graduate<br>
                                    <input type="radio" name="educational_background" value="College Level" <?php if ($profile['educational_background'] == 'College Level') echo 'checked'; ?> required>College Level<br>
                                    <input type="radio" name="educational_background" value="College Graduate" <?php if ($profile['educational_background'] == 'College Graduate') echo 'checked'; ?> required>College Graduate<br>
                                    <input type="radio" name="educational_background" value="Master Level" <?php if ($profile['educational_background'] == 'Master Level') echo 'checked'; ?> required>Master's Level<br>
                                    <input type="radio" name="educational_background" value="Master Graduate" <?php if ($profile['educational_background'] == 'Master Graduate') echo 'checked'; ?> required>Master's Graduate<br>
                                    <input type="radio" name="educational_background" value="Doctorate Level" <?php if ($profile['educational_background'] == 'Doctorate Level') echo 'checked'; ?> required>Doctorate Level<br>
                                </td>
                                <tr>
                    <td>
                        Registered SK Voter:<br>
                        <input type="text" name="register_sk_voter" placeholder="Registered SK Voter" value="<?php echo $profile['register_sk_voter']; ?>" required>
                    </td>
                    <td>
                        Voted Last Election:<br>
                        <input type="text" name="voted_last_election" placeholder="Voted Last Election" value="<?php echo $profile['voted_last_election']; ?>" required>
                    </td>
                    <td>
    National Voter:<br>
    <input type="radio" name="national_voter" value="Yes" <?php if ($profile['national_voter'] == 'Yes') echo 'checked'; ?> required> Yes
    <input type="radio" name="national_voter" value="No" <?php if ($profile['national_voter'] == 'No') echo 'checked'; ?> required> No
</td>
</tr>
<tr>
    <td>III. Participation in KK</td>
</tr>
<tr>
    <td>
        Attended KK:<br>
        <input type="radio" name="attended_kk" value="Yes" <?php if ($profile['attended_kk'] == 'Yes') echo 'checked'; ?> required> Yes
        <input type="radio" name="attended_kk" value="No" <?php if ($profile['attended_kk'] == 'No') echo 'checked'; ?> required> No
    </td>
    <td>
        Times Attended KK:<br>
        <input type="number" name="times_attended_kk" placeholder="Times Attended KK" value="<?php echo $profile['times_attended_kk']; ?>" required>
    </td>
    <td>
        No Why:<br>
        <input type="text" name="no_why" placeholder="No Why" value="<?php echo $profile['no_why']; ?>" >
    </td>
</tr>

                <tr>
                    <td><br><button type="submit" name="update">Update</button></td>
                </tr>
            </table>
        </form>
    </div>

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
</body>
</html>