<?php
include("../conne.php");
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

            $stmt_profiles = $conn->prepare("INSERT INTO profiles (lname, fname, mname, suffix, region, province, municipality, barangay, purok, sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt_profiles_backup = $conn->prepare("INSERT INTO profiles_backup (lname, fname, mname, suffix, region, province, municipality, barangay, purok, sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt_profiles === FALSE || $stmt_profiles_backup === FALSE) {
                die("Error.");
            }

            $stmt_profiles->bind_param('ssssssssssisssssssssssssis', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $purok, $sex, $age, $email, $birth_month, $birth_day, $birth_year, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter, $voted_last_election, $attended_kk, $times_attended_kk, $date_created);
            $stmt_profiles_backup->bind_param('ssssssssssisssssssssssssis', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $purok, $sex, $age, $email, $birth_month, $birth_day, $birth_year, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter, $voted_last_election, $attended_kk, $times_attended_kk, $date_created);

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
                $purok = $row[9];
                $sex = $row[10];
                $age = $row[11];
                $email = $row[12];
                $birth_month = $row[13];
                $birth_day = $row[14];
                $birth_year = $row[15];
                $contactnumber = $row[16];
                $civil_status = $row[17];
                $youth_classification = $row[18];
                $age_group = $row[19];
                $work_status = $row[20];
                $educational_background = $row[21];
                $register_sk_voter_raw = $row[22];
                if ($register_sk_voter_raw == 'Registered') {
                    $register_sk_voter = 'Registered';
                } else {
                    $register_sk_voter = 'Not Registered';
                }
                $voted_last_election = $row[23];
                $attended_kk = $row[24];
                $times_attended_kk = $row[25];
                $date_created = $row[26];

                $stmt_profiles->execute();
                $stmt_profiles_backup->execute();
            }

            $stmt_profiles->close();
            $stmt_profiles_backup->close();
            $conn->close();

            fclose($file);
            header("location: temp_profiles.php");
            exit();
            
        } else {
            echo "Please upload a valid CSV file.";
            header("location: temp_profiles.php");
        }
    } else {
        echo "No file uploaded or there was an upload error.";
        header("location: temp_profiles.php");
    }
} else {
    echo "Upload form not submitted.";
    header("location: temp_profiles.php");
}