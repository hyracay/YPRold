<?php
include("conne.php");
if (isset($_POST['upload'])) {
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
        $fileTmpPath = $_FILES['csvFile']['tmp_name'];
        $fileName = $_FILES['csvFile']['name'];
        $fileSize = $_FILES['csvFile']['size'];
        $fileType = $_FILES['csvFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        if ($fileExtension == 'csv') {
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $file = fopen($fileTmpPath, 'r');

            if ($file === FALSE) {
                die("Error opening file.");
            }

            fgetcsv($file);

            $stmt = $conn->prepare("INSERT INTO profiles (lname, fname, mname, suffix, region, province, municipality, barangay, purok, sex, age, email, birth_date, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt === FALSE) {
                die("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param('ssssssssssisssssssssssi', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $purok, $sex, $age, $email, $birth_date, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter, $voted_last_election, $attended_kk, $times_attended_kk);

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
                $birth_date = $row[13];
                $contactnumber = $row[14];
                $civil_status = $row[15];
                $youth_classification = $row[16];
                $age_group = $row[17];
                $work_status = $row[18];
                $educational_background = $row[19];
                $register_sk_voter_raw = $row[20];
                if ($register_sk_voter_raw == 'Registered') {
                    $register_sk_voter = 'Registered';
                } else {
                    $register_sk_voter = 'Not Registered';
                }
                $voted_last_election = $row[21];
                $attended_kk = $row[22];
                $times_attended_kk = $row[23];
                
                $stmt->execute();
            }

            $stmt->close();
            $conn->close();

            fclose($file);
            header("location: crud.php");
            exit();
            
        } else {
            echo "Please upload a valid CSV file.";
            header("location: crud.php");
        }
    } else {
        echo "No file uploaded or there was an upload error.";
        header("location: crud.php");
    }
} else {
    echo "Upload form not submitted.";
    header("location: crud.php");
}
?>
