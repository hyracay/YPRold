<?php
include("conne.php");

if (isset($_POST['upload'])) {
    // Check if a file is uploaded
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
        // Get the file details
        $fileTmpPath = $_FILES['csvFile']['tmp_name'];
        $fileName = $_FILES['csvFile']['name'];
        $fileSize = $_FILES['csvFile']['size'];
        $fileType = $_FILES['csvFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Check if the file is a CSV
        if ($fileExtension == 'csv') {
            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Open the uploaded CSV file
            $file = fopen($fileTmpPath, 'r');

            if ($file === FALSE) {
                die("Error opening file.");
            }

            // Skip the first line (header)
            fgetcsv($file);

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO profiles (lname, fname, mname, suffix, region, province, municipality, barangay, purok, sex, age, email, birth_date, contactnumber, civil_status, youth_classification, age_group, work_status, educational_background, register_sk_voter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if ($stmt === FALSE) {
                die("Error preparing statement: " . $conn->error);
            }

            // Bind parameters
            $stmt->bind_param('ssssssssssissssssssi', $lname, $fname, $mname, $suffix, $region, $province, $municipality, $barangay, $purok, $sex, $age, $email, $birth_date, $contactnumber, $civil_status, $youth_classification, $age_group, $work_status, $educational_background, $register_sk_voter);

            // Read and insert the data
            while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
                $lname = $row[0];
                $fname = $row[1];
                $mname = $row[2];
                $suffix = $row[3];
                $region = $row[4];
                $province = $row[5];
                $municipality = $row[6];
                $barangay = $row[7];
                $purok = $row[8];
                $sex = $row[9];
                $age = $row[10];
                $email = $row[11];
                $birth_date = $row[12];
                $contactnumber = $row[13];
                $civil_status = $row[14];
                $youth_classification = $row[15];
                $age_group = $row[16];
                $work_status = $row[17];
                $educational_background = $row[18];
                $register_sk_voter = $row[19] == 'true' ? 1 : 0;

                $stmt->execute();
            }

            // Close the statement and the connection
            $stmt->close();
            $conn->close();

            // Close the file
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
