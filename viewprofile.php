<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit(); // Ensure that no further code is executed after the redirection
}

// Check if 'role' is set in session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    // Handle case where role is not set (e.g., redirect or error message)
    echo "Role information not found. Please contact administrator.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="search.php">Search</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
            // For employees, you can customize what to display or leave it empty
            // Here, we do nothing to omit displaying "Create Accounts"
        } else {
            // Handle unexpected roles (optional)
            echo "Unknown role.";
        }
        ?>
        <a href="crud.php">Create Profile</a>
        <a href="#accounts.php">Accounts</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Welcome to the Homepage</h3>
        <?php
        // Fetch all rows from the profiles table
        $sql = "SELECT * FROM profiles";
        $result = mysqli_query($conn, $sql);
        
        if($result && mysqli_num_rows($result) > 0) {
            $results = [];
        ?>
        <div class="section">
        <table>
            <tr>
                <th>Avatar</th>
                <th>Name</th>
            </tr>
        
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $results[] = $row;
                $id = $row['id'];
                $lname = $row['lname'];
                $fname = $row['fname'];
                $mname = $row['mname'];
                $suffix = $row['suffix'];
                $fullName = $fname . ' ' . $mname . ' ' . $lname;
                if (!empty($suffix)) {
                    $fullName .= ' ' . $suffix;
                }
            ?>
            <tr>
                <td>
                    <img width="50px" height="50px" src="src/avatar.png" alt="">
                </td>
                <td><a href="" class="profileNameLink" type="button" data-id="<?= $id; ?>"><?= $fullName; ?></a></td>
            </tr>
            <?php
            }
            ?>
        </table>
        </div>
        <?php
        } else {
            echo "No profiles found.";
        }
        ?>
    </div>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalInside"></div>
        </div>
    </div>

    <script>
        const results = <?php echo json_encode($results); ?>;
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the buttons that open the modal
        var btns = document.getElementsByClassName("profileNameLink");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var modalInside = document.getElementById('modalInside');

        // When the user clicks the button, open the modal 
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function(e) {
                e.preventDefault();
                modal.style.display = "block";
                const selectedProfile = results.find(res => res.id == this.getAttribute('data-id'));
                let fullName = `${selectedProfile.fname} ${selectedProfile.mname} ${selectedProfile.lname}`;
                if (selectedProfile.suffix) {
                    fullName += ` ${selectedProfile.suffix}`;
                }
                modalInside.innerHTML = `
                    <div>Full name: ${fullName}</div>
                    <div>Address: ${selectedProfile.region} ${selectedProfile.province} ${selectedProfile.municipality} ${selectedProfile.barangay} ${selectedProfile.purok}</div>
                    <div>Sex: ${selectedProfile.sex}</div>
                    <div>Age: ${selectedProfile.age}</div>
                    <div>Birth Date: ${selectedProfile.birth_date}</div>
                    <div>Email: ${selectedProfile.email}</div>
                    <div>Contact Number: ${selectedProfile.contactnumber}</div>
                    <div>Civil Status: ${selectedProfile.civil_status}</div>
                    <div>Age Group: ${selectedProfile.age_group}</div>
                    <div>Educational Background: ${selectedProfile.educational_background}</div>
                    <div>Youth Classification: ${selectedProfile.youth_classification}</div>
                    <div>Work Status: ${selectedProfile.work_status}</div>
                    <div>Registered SK Voter: ${selectedProfile.register_sk_voter}</div>
                `;
            });
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
