<?php
session_start();
include("../conne.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the profile information before deletion
    $select_sql = "SELECT * FROM profiles WHERE id = '$id'";
    $result = mysqli_query($conn, $select_sql);
    $profile_data = mysqli_fetch_assoc($result);

    if ($profile_data) {
        // Extract data from $profile_data array
        $lname = mysqli_real_escape_string($conn, $profile_data['lname']);
        $fname = mysqli_real_escape_string($conn, $profile_data['fname']);
        $mname = mysqli_real_escape_string($conn, $profile_data['mname']);
        $suffix = mysqli_real_escape_string($conn, $profile_data['suffix']);
        $region = mysqli_real_escape_string($conn, $profile_data['region']);
        $province = mysqli_real_escape_string($conn, $profile_data['province']);
        $municipality = mysqli_real_escape_string($conn, $profile_data['municipality']);
        $barangay = mysqli_real_escape_string($conn, $profile_data['barangay']);
        $purok = mysqli_real_escape_string($conn, $profile_data['purok']);
        $sex = mysqli_real_escape_string($conn, $profile_data['sex']);
        $age = mysqli_real_escape_string($conn, $profile_data['age']);
        $email = mysqli_real_escape_string($conn, $profile_data['email']);
        $birth_month = mysqli_real_escape_string($conn, $profile_data['birth_month']);
        $birth_day = mysqli_real_escape_string($conn, $profile_data['birth_day']);
        $birth_year = mysqli_real_escape_string($conn, $profile_data['birth_year']);
        $contactnumber = mysqli_real_escape_string($conn, $profile_data['contactnumber']);
        $civil_status = mysqli_real_escape_string($conn, $profile_data['civil_status']);
        $youth_classification = mysqli_real_escape_string($conn, $profile_data['youth_classification']);
        $age_group = mysqli_real_escape_string($conn, $profile_data['age_group']);
        $work_status = mysqli_real_escape_string($conn, $profile_data['work_status']);
        $educational_background = mysqli_real_escape_string($conn, $profile_data['educational_background']);
        $register_sk_voter = mysqli_real_escape_string($conn, $profile_data['register_sk_voter']);
        $voted_last_election = mysqli_real_escape_string($conn, $profile_data['voted_last_election']);
        $attended_kk = mysqli_real_escape_string($conn, $profile_data['attended_kk']);
        $times_attended_kk = mysqli_real_escape_string($conn, $profile_data['times_attended_kk']);
        $date_created = mysqli_real_escape_string($conn, $profile_data['date_created']);

        // Store the profile information into delete_profile table
        $insert_sql = "INSERT INTO delete_profile (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
            sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
            age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
            '$sex', '$age', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
            '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$attended_kk', '$times_attended_kk', '$date_created')";

        if (mysqli_query($conn, $insert_sql)) {
            // Proceed with deletion from profiles table
            $delete_sql = "DELETE FROM profiles WHERE id = '$id'";
            if (mysqli_query($conn, $delete_sql)) {
                header("location: temp_profiles.php");
            } else {
                echo "Error deleting profile: " . mysqli_error($conn);
            }
        } else {
            echo "Error storing profile information before deletion: " . mysqli_error($conn);
        }
    } else {
        echo "Profile not found.";
    }
}


?>