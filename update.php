<?php
session_start();
include("conne.php");

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
    $update = "UPDATE profiles SET 
            lname = '$lname',
            fname = '$fname',
            mname = '$mname',
            suffix = '$suffix',
            region = '$region',
            province = '$province',
            municipality = '$municipality',
            barangay = '$barangay',
            purok = '$purok',
            sex = '$sex',
            age = '$age',
            email = '$email',
            birth_date = '$birth_date',
            contactnumber = '$contactnumber',
            civil_status = '$civil_status',
            youth_classification = '$youth_classification',
            age_group = '$age_group',
            work_status = '$work_status',
            educational_background = '$educational_background',
            register_sk_voter = '$register_sk_voter'
        WHERE id = $id";

    $result = mysqli_query($conn, $update);

    if ($result) {
       header("location: viewprofile.php");
       echo " <script> alert('Record updated successfully'); </script>";
    } else {
        echo " <script> alert('Error'); </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
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
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
    
        } 
        ?>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Update Profile</h3>
        <form method="POST" action="update.php?id=<?php echo $id; ?>">
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
                              <input type="text" name="suffix" placeholder="Suffix" value="<?php echo $profile['suffix']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td><br>
                        Location: <input type="text" name="region" placeholder="Region" value="<?php echo $profile['region']; ?>" required>
                                  <input type="text" name="province" placeholder="Province" value="<?php echo $profile['province']; ?>" required>
                                  <input type="text" name="municipality" placeholder="Municipality" value="<?php echo $profile['municipality']; ?>" required>
                                  <input type="text" name="barangay" placeholder="Barangay" value="<?php echo $profile['barangay']; ?>" required>
                                  <input type="text" name="purok" placeholder="Purok/Zone" value="<?php echo $profile['purok']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr><br>
                                <td style="border: 1px solid;">
                                    Sex Assigned at Birth: <br>
                                    <input type="radio" name="sex" value="Male" <?php if ($profile['sex'] == 'Male') echo 'checked'; ?> required>Male<br>
                                    <input type="radio" name="sex" value="Female" <?php if ($profile['sex'] == 'Female') echo 'checked'; ?> required>Female
                                </td>
                                <td>
                                    Age: <input type="text" name="age" placeholder="Age" value="<?php echo $profile['age']; ?>">
                                    Email Address: <input type="email" name="email" placeholder="Email Address" value="<?php echo $profile['email']; ?>" required><br><br>
                                    Birth Date: <input type="date" name="birth_date" placeholder="Year/Month/Date" value="<?php echo $profile['birth_date']; ?>" required>
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
                                    <input type="radio" name="civil_status" value="Single" <?php if ($profile['civil_status'] == 'Single') echo 'checked'; ?> required> Single<br>
                                    <input type="radio" name="civil_status" value="Married" <?php if ($profile['civil_status'] == 'Married') echo 'checked'; ?> required> Married<br>
                                    <input type="radio" name="civil_status" value="Divorced" <?php if ($profile['civil_status'] == 'Divorced') echo 'checked'; ?> required> Divorced<br>
                                    <input type="radio" name="civil_status" value="Widowed" <?php if ($profile['civil_status'] == 'Widowed') echo 'checked'; ?> required> Widowed<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Youth Classification:<br>
                                    <input type="radio" name="youth_classification" value="In Youth School" <?php if ($profile['youth_classification'] == 'In Youth School') echo 'checked'; ?> required> In Youth School<br>
                                    <input type="radio" name="youth_classification" value="Out of School Youth" <?php if ($profile['youth_classification'] == 'Out of School Youth') echo 'checked'; ?> required> Out of School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" <?php if ($profile['youth_classification'] == 'Working Youth') echo 'checked'; ?> required> Working Youth<br>
                                    <input type="radio" name="youth_classification" value="Person with Disability (PWD)" <?php if ($profile['youth_classification'] == 'Person with Disability (PWD)') echo 'checked'; ?> required> Person with Disability (PWD)<br>
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
                                    <input type="radio" name="age_group" value="Child Youth" <?php if ($profile['age_group'] == 'Child Youth') echo 'checked'; ?> required> Child Youth (15-17 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Core Youth" <?php if ($profile['age_group'] == 'Core Youth') echo 'checked'; ?> required> Core Youth (18-24 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Young adult" <?php if ($profile['age_group'] == 'Young adult') echo 'checked'; ?> required> Young adult (25-30 yrs. old)<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Work Status:<br>
                                    <input type="radio" name="work_status" value="Employed" <?php if ($profile['work_status'] == 'Employed') echo 'checked'; ?> required> Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" <?php if ($profile['work_status'] == 'Unemployed') echo 'checked'; ?> required> Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" <?php if ($profile['work_status'] == 'Self-Employed') echo 'checked'; ?> required> Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" <?php if ($profile['work_status'] == 'Currently looking for job') echo 'checked'; ?> required> Currently looking for job<br>
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
                                    <input type="radio" name="educational_background" value="Elementary Level" <?php if ($profile['educational_background'] == 'Elementary Level') echo 'checked'; ?> required> Elementary Level<br>
                                    <input type="radio" name="educational_background" value="Elementary Graduate" <?php if ($profile['educational_background'] == 'Elementary Graduate') echo 'checked'; ?> required> Elementary Graduate<br>
                                    <input type="radio" name="educational_background" value="High School Level" <?php if ($profile['educational_background'] == 'High School Level') echo 'checked'; ?> required> High School Level<br>
                                    <input type="radio" name="educational_background" value="High School Graduate" <?php if ($profile['educational_background'] == 'High School Graduate') echo 'checked'; ?> required> High School Graduate<br>
                                    <input type="radio" name="educational_background" value="Vocational Graduate" <?php if ($profile['educational_background'] == 'Vocational Graduate') echo 'checked'; ?> required> Vocational Graduate<br>
                                    <input type="radio" name="educational_background" value="College Level" <?php if ($profile['educational_background'] == 'College Level') echo 'checked'; ?> required> College Level<br>
                                    <input type="radio" name="educational_background" value="College Graduate" <?php if ($profile['educational_background'] == 'College Graduate') echo 'checked'; ?> required> College Graduate<br>
                                    <input type="radio" name="educational_background" value="Master Level" <?php if ($profile['educational_background'] == 'Master Level') echo 'checked'; ?> required> Master's Level<br>
                                    <input type="radio" name="educational_background" value="Master Graduate" <?php if ($profile['educational_background'] == 'Master Graduate') echo 'checked'; ?> required> Master's Graduate<br>
                                    <input type="radio" name="educational_background" value="Doctorate Level" <?php if ($profile['educational_background'] == 'Doctorate Level') echo 'checked'; ?> required> Doctorate Level<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Registered SK Voter:<br>
                                    <input type="radio" name="register_sk_voter" value="Registered" <?php if ($profile['register_sk_voter'] == 'Registered') echo 'checked'; ?> required> YES<br>
                                    <input type="radio" name="register_sk_voter" value="Not Registered" <?php if ($profile['register_sk_voter'] == 'Not Registered') echo 'checked'; ?> required> NO<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button name="update">Update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>