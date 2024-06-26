<?php
include("conne.php");


if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Fetch existing data from database based on ID
    $sql_fetch = "SELECT * FROM profiles WHERE ID='$id'";
    $result = mysqli_query($conn, $sql_fetch);

    if ($row = mysqli_fetch_assoc($result)) {
        // Assign fetched data to variables
        $lname = $row['lname'];
        $fname = $row['fname'];
        $mname = $row['mname'];
        $suffix = $row['suffix'];
        $region = $row['region'];
        $province = $row['province'];
        $municipality = $row['municipality'];
        $barangay = $row['barangay'];
        $purok = $row['purok'];
        $sex = $row['sex'];
        $age = $row['age'];
        $email = $row['email'];
        $birth_date = $row['birth_date'];
        $contactnumber = $row['contactnumber'];
        $civil_status = $row['civil_status'];
        $youth_classification = $row['youth_classification'];
        $age_group = $row['age_group'];
        $work_status = $row['work_status'];
        $educational_background = $row['educational_background'];
        $register_sk_voter = $row['register_sk_voter'];
    } 
}
// Process form submission when update button is clicked
if(isset($_POST['update'])) {
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

    // Update SQL statement
    $update = "UPDATE profiles SET 
                lname='$lname', fname='$fname', mname='$mname', suffix='$suffix', 
                region='$region', province='$province', municipality='$municipality', barangay='$barangay', purok='$purok',
                sex='$sex', age='$age', email='$email', birth_date='$birth_date', contactnumber='$contactnumber',
                civil_status='$civil_status', youth_classification='$youth_classification', age_group='$age_group',
                work_status='$work_status', educational_background='$educational_background', register_sk_voter='$register_sk_voter'
                WHERE id='$id'";

    $result = mysqli_query($conn, $update);

    if($result) {
        header("location:crud.php");
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<body>
    <h2>Update Profile</h2>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <table>
            <tr>
                <td>I. Profile</td>
            </tr>
            <tr>
                <td>
                    Name:
                    <input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name">
                    <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First Name">
                    <input type="text" name="mname" value="<?php echo $mname; ?>" placeholder="Middle Name">
                    <input type="text" name="suffix" value="<?php echo $suffix; ?>" placeholder="Suffix">
                </td>
            </tr>
            <tr>
                <td><br>
                    Location:
                    <input type="text" name="region" value="<?php echo $region; ?>" placeholder="Region">
                    <input type="text" name="province" value="<?php echo $province; ?>" placeholder="Province">
                    <input type="text" name="municipality" value="<?php echo $municipality; ?>" placeholder="Municipality">
                    <input type="text" name="barangay" value="<?php echo $barangay; ?>" placeholder="Barangay">
                    <input type="text" name="purok" value="<?php echo $purok; ?>" placeholder="Purok/Zone">
                </td>
            </tr>
            <tr>
                <td>
                    <table>
                        <tr><br>
                            <td style="border: 1px solid;">
                                Sex Assigned as Birth: <br>
                                <input type="radio" name="sex" value="Male" <?php if($sex == 'Male') echo 'checked'; ?>> Male<br>
                                <input type="radio" name="sex" value="Female" <?php if($sex == 'Female') echo 'checked'; ?>> Female
                            </td>
                            <td>
                                Age:<input type="text" name="age" value="<?php echo $age; ?>" placeholder="Age">
                                Email Address:<input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email Address"><br><br>
                                Birth Date:<input type="date" name="birth_date" value="<?php echo $birth_date; ?>" placeholder="Year/Month/Date">
                                Contact Number:<input type="text" name="contactnumber" value="<?php echo $contactnumber; ?>" placeholder="Contact Number">
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
                                <input type="radio" name="civil_status" value="Single" <?php if($civil_status == 'Single') echo 'checked'; ?>> Single<br>
                                <input type="radio" name="civil_status" value="Married" <?php if($civil_status == 'Married') echo 'checked'; ?>> Married<br>
                                <input type="radio" name="civil_status" value="Divorced" <?php if($civil_status == 'Divorced') echo 'checked'; ?>> Divorced<br>
                                <input type="radio" name="civil_status" value="Widowed" <?php if($civil_status == 'Widowed') echo 'checked'; ?>> Widowed<br>
                            </td>
                            <td style="border: 1px solid;">
                                Youth Classification:<br>
                                <input type="radio" name="youth_classification" value="In Youth School" <?php if($youth_classification == 'In Youth School') echo 'checked'; ?>> In Youth School<br>
                                <input type="radio" name="youth_classification" value="Out of School Youth" <?php if($youth_classification == 'Out of School Youth') echo 'checked'; ?>> Out of School Youth<br>
                                <input type="radio" name="youth_classification" value="Working Youth" <?php if($youth_classification == 'Working Youth') echo 'checked'; ?>> Working Youth<br>
                                <input type="radio" name="youth_classification" value="Person with Disability (PWD)" <?php if($youth_classification == 'Person with Disability (PWD)') echo 'checked'; ?>> Person with Disability (PWD)<br>
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
                                <input type="radio" name="age_group" value="Child Youth" <?php if($age_group == 'Child Youth') echo 'checked'; ?>> Child Youth (15-17 yrs. old)<br>
                                <input type="radio" name="age_group" value="Core Youth" <?php if($age_group == 'Core Youth') echo 'checked'; ?>> Core Youth (18-24 yrs. old)<br>
                                <input type="radio" name="age_group" value="Young adult" <?php if($age_group == 'Young adult') echo 'checked'; ?>> Young adult (25-30 yrs.old)<br>
                            </td>
                            <td style="border: 1px solid;">
                                Work Status:<br>
                                <input type="radio" name="work_status" value="Employed" <?php if($work_status == 'Employed') echo 'checked'; ?>> Employed<br>
                                <input type="radio" name="work_status" value="Unemployed" <?php if($work_status == 'Unemployed') echo 'checked'; ?>> Unemployed<br>
                                <input type="radio" name="work_status" value="Self-Employed" <?php if($work_status == 'Self-Employed') echo 'checked'; ?>> Self-Employed<br>
                                <input type="radio" name="work_status" value="Currently looking for job" <?php if($work_status == 'Currently looking for job') echo 'checked'; ?>> Currently looking for job<br>
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
                                <input type="radio" name="educational_background" value="Elementary Level" <?php if($educational_background == 'Elementary Level') echo 'checked'; ?>> Elementary Level<br>
                                <input type="radio" name="educational_background" value="Elementary Graduate" <?php if($educational_background == 'Elementary Graduate') echo 'checked'; ?>> Elementary Graduate<br>
                                <input type="radio" name="educational_background" value="High School Level" <?php if($educational_background == 'High School Level') echo 'checked'; ?>> High School Level<br>
                                <input type="radio" name="educational_background" value="High School Graduate" <?php if($educational_background == 'High School Graduate') echo 'checked'; ?>> High School Graduate<br>
                                <input type="radio" name="educational_background" value="Vocational Graduate" <?php if($educational_background == 'Vocational Graduate') echo 'checked'; ?>> Vocational Graduate<br>
                                <input type="radio" name="educational_background" value="College Level" <?php if($educational_background == 'College Level') echo 'checked'; ?>> College Level<br>
                                <input type="radio" name="educational_background" value="College Graduate" <?php if($educational_background == 'College Graduate') echo 'checked'; ?>> College Graduate<br>
                                <input type="radio" name="educational_background" value="Master's Level" <?php if($educational_background == "Master's Level") echo 'checked'; ?>> Master's Level<br>
                                <input type="radio" name="educational_background" value="Master's Graduate" <?php if($educational_background == "Master's Graduate") echo 'checked'; ?>> Master's Graduate<br>
                                <input type="radio" name="educational_background" value="Doctrate Level" <?php if($educational_background == 'Doctrate Level') echo 'checked'; ?>> Doctrate Level<br>
                            </td>
                            <td style="border: 1px solid;">
                                Registered SK Voter:<br>
                                <input type="radio" name="register_sk_voter" value="Registered" <?php if($register_sk_voter == 'Registered') echo 'checked'; ?>> YES<br>
                                <input type="radio" name="register_sk_voter" value="Not Registered" <?php if($register_sk_voter == 'Not Registered') echo 'checked'; ?>> NO <br>
                            </td>

                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="update">Update</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
