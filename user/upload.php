<?php
session_start();
include("../connection/conne.php");

// Ensure session email is set, otherwise redirect
if (!isset($_SESSION['USER'])) {
    header("location:../index.php");
  exit(); // Ensure that no further code is executed after the redirection
}
if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
} else {
  // Handle case where role is not set (e.g., redirect or error message)
  echo "Role information not found. Please contact administrator.";
  exit();
}
if (isset($_POST['upload'])) {
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
        $fileTmpPath = $_FILES['csvFile']['tmp_name'];
        $fileName = $_FILES['csvFile']['name'];
        $fileSize = $_FILES['csvFile']['size'];
        $fileType = $_FILES['csvFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if ($fileExtension == 'csv') {

            $file = fopen($fileTmpPath, 'r');

            if ($file === FALSE) {
                die("Error opening file.");
            }

            fgetcsv($file);

            $stmt_profiles = $conn->prepare("INSERT INTO profiles (lname, fname, mname, suffix, region, province, municipality, barangay, sitio, purok,house_number, sex, age, youth_with_needs,email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter, voted_last_election, national_voter, attended_kk, times_attended_kk, no_why, date_created, barangay_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_profiles_backup = $conn->prepare("INSERT INTO profiles_backup (lname, fname, mname, suffix, region, province, municipality, barangay, sitio, purok,house_number, sex, age, youth_with_needs,email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter, voted_last_election, national_voter, attended_kk, times_attended_kk, no_why, date_created, barangay_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt_profiles === FALSE || $stmt_profiles_backup === FALSE) {
                die("Error.");
            }

            $stmt_profiles->bind_param('sssssssssssssisssssssssssssssiss', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $sitio, $purok, $house_number, $sex, $age,$youth_with_needs,$email, $birth_month, $birth_day, $birth_year, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter, $voted_last_election,$national_voter,$attended_kk, $times_attended_kk,$no_why, $date_created, $barrangay_code);
            $stmt_profiles_backup->bind_param('sssssssssssssisssssssssssssssiss', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $sitio, $purok, $house_number, $sex, $age,$youth_with_needs,$email, $birth_month, $birth_day, $birth_year, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter, $voted_last_election,$national_voter,$attended_kk, $times_attended_kk,$no_why, $date_created, $barrangay_code);

            while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                $id = $row[0];
                $lname = $row[1];
                $fname = $row[2];
                $mname = $row[3];
                $suffix = $row[4];
                $region = $row[5];
                $province = $row[6];
                $municipality = $row[7];
                $barangay = $row[8];
                $sitio = $row[9];//AADED
                $purok = $row[10];
                $house_number = $row[11];
                $sex = $row[12];
                $age = $row[13];
                $youth_with_needs = $row[14];////ADDED
                $email = $row[15];
                $birth_month = $row[16];
                $birth_day = $row[17];
                $birth_year = $row[18];
                $contactnumber = $row[19];
                $civil_status = $row[20];
                $youth_classification = $row[21];
                $age_group = $row[22];
                $work_status = $row[23];
                $educational_background = $row[24];
                $register_sk_voter_raw = $row[25];
                if ($register_sk_voter_raw == 'Registered') {
                    $register_sk_voter = 'Registered';
                } else {
                    $register_sk_voter = 'Not Registered';
                }
                $voted_last_election = $row[26];
                $national_voter = $row[27];////ADDED
                $attended_kk = $row[28];
                $times_attended_kk = $row[29];
                $no_why= $row[30];////ADDED
                $date_created = $row[31];
                $barrangay_code = $row[32];////ADDED

                $stmt_profiles->execute();
                $stmt_profiles_backup->execute();
            }

            $stmt_profiles->close();
            $stmt_profiles_backup->close();
            $conn->close();

            fclose($file);
            header("location: profiles.php");
            exit();
            
        } else {
            echo "Please upload a valid CSV file.";
            header("location: profiles.php");
        }
    } else {
        echo "No file uploaded or there was an upload error.";
        header("location: profiles.php");
    }
} else {
    echo "Upload form not submitted.";
    header("location: profiles.php");
}