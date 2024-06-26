<?php
include ("conne.php");

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
                // var_dump($row);
                // die();
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
                $register_sk_voter = $row[20] == 'true' ? 1 : 0;

                $stmt->execute();
            }

            // Close the statement and the connection
            $stmt->close();
            $conn->close();

            // Close the file
            fclose($file);

            echo "CSV data imported successfully.";
        } else {
            echo "Please upload a valid CSV file.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
} else {
    echo "Upload form not submitted.";
}
?>
