
<?php
session_start();
include ("conne.php");

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
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
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
            echo '<a href="#accounts.php">Accounts</a>';
        } 
        ?>

        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <!-- Search -->
        <div class="search-container">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <form action="" method="GET">
                                            <div class="input-group mb-3">
                                                <input type="text" name="search"
                                                    value="<?php if (isset($_GET['search'])) {
                                                        echo $_GET['search'];
                                                    } ?>"
                                                    class="form-control" placeholder="Search data">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <button type="submit" style="margin-left:100px">
                                                Advance Search
                                                <a href="advance_search.php">click here</a>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="exportBtn">Export</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
        // Fetch all rows from the profiles table, filtering by search query if provided
        $searchQuery = "";
        if (isset($_GET['search'])) {
            $searchQuery = $_GET['search'];
            $sql = "SELECT * FROM profiles WHERE fname LIKE '%$searchQuery%' OR lname LIKE '%$searchQuery%' OR mname LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%'";
        } else {
            $sql = "SELECT * FROM profiles";
        }
        $result = mysqli_query($conn, $sql);
        
        if($result && mysqli_num_rows($result) > 0) {
            $results = [];
        ?>
        <div class="section">
        <table>
            <tr>
                <th>Avatar</th>
                <th>Name</th> 
      
                <th>EMAIL</th>    
            </tr>
        
            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $results[] = $row;
                $id = $row['id'];
                $lname = $row['lname'];
                $fname = $row['fname'];
                $mname = $row['mname'];
  
                $email = $row['email'];
                
                $fullName = $fname . ' ' . $mname . ' ' . $lname;   
            ?>
            <tr>
    <td>
        <img width="50px" height="50px" src="src/avatar.png" alt="">
    </td>
    <td>
        <a href="" class="profileNameLink" type="button" data-id="<?= $id; ?>"><?= $fullName; ?></a>
    </td>

    <td>
        <p><?= $email; ?></p>
    </td>
    <td>
        <a href="update.php?id=<?= $id; ?>" class="btn btn-primary">Update</a>
        <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
    </td>
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
                    <?php
                            if ($role == 'admin') {
                            echo ' <div>Youth Classification: ${selectedProfile.youth_classification}</div>';
                            }
                    ?>
                    <div>Work Status: ${selectedProfile.work_status}</div>
                    <div>Registered SK Voter: ${selectedProfile.register_sk_voter}</div>
                `;
            });
        }

                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function () {
                        modal.style.display = "none";
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function (event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }

                    function exportToCSV(array, filename = 'data.csv') {
                        // Check if the array is empty
                        if (!array.length) {
                            return;
                        }

                        // Get the keys from the first object in the array
                        const keys = Object.keys(array[0]);

                        // Create CSV content
                        const csvContent = array.map(obj => keys.map(key => obj[key]).join(',')).join('\n');

                        // Add the header row
                        const csvHeader = keys.join(',') + '\n' + csvContent;

                        // Create a Blob from the CSV content
                        const blob = new Blob([csvHeader], { type: 'text/csv;charset=utf-8;' });

                        // Create a link element
                        const link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.setAttribute('download', filename);

                        // Append the link to the document body and trigger the download
                        document.body.appendChild(link);
                        link.click();

                        // Remove the link from the document
                        document.body.removeChild(link);
                    }

                    const exportBtn = document.getElementById('exportBtn');
                    exportBtn.addEventListener('click', function () {
                        exportToCSV(results);
                    });

                </script>
</body>

</html>
