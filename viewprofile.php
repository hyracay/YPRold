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
    <title>VIEW PROFILES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
    <link rel="stylesheet" type="text/css" href="src/css.css">

    <style>
        input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border: 2px solid #ccc;
            border-radius: 4px;
            vertical-align: middle;
            position: relative;
            top: 4px;
            cursor: pointer;
        }
        input[type="checkbox"]:checked {
            background-color: #FF0000;
            border-color: #FF0000;
        }
        input[type="checkbox"]:checked::before {
            content: '\2713';
            display: block;
            text-align: center;
            line-height: 20px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
            Logged in as: <?php echo $_SESSION['email']; ?></p>

        <a href="homepage.php">Back</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        <?php
         if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
         }
        ?>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
        } else {
            echo "Unknown role.";
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>youth profiles</h1>
        <!-- Search -->
        <div class="search-container">
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
                                                    class="form-control" placeholder="Enter name:">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <div class="col-md-2">
                                                    <button style="margin-left: 129px; width: max-content; border-radius: 0" class="btn btn-primary"><a style="text-decoration: none; color: #fff;"type="button" href="advance_search.php">Advance Search</a></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="exportBtn" style="margin-left:144%">Export</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Fetch all rows from the profiles table, filtering by search query if provided
                    // Constants for pagination

                    $recordsPerPage = 20;
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page, default to 1

                    $offset = ($currentPage - 1) * $recordsPerPage;

                    if (isset($_GET['search'])) {
                        $searchQuery = $_GET['search'];
                        $sql = "SELECT * FROM profiles 
                                WHERE fname LIKE '%$searchQuery%' OR lname LIKE '%$searchQuery%' OR mname LIKE '%$searchQuery%' OR id LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' 
                                ORDER BY id DESC 
                                LIMIT $recordsPerPage OFFSET $offset";
                    } else {
                        $sql = "SELECT * FROM profiles 
                                ORDER BY id DESC 
                                LIMIT $recordsPerPage OFFSET $offset";
                    }

                    $result = mysqli_query($conn, $sql);

                    // Fetch total count of records
                    $totalCountSql = "SELECT COUNT(*) AS total FROM profiles";
                    $totalCountResult = mysqli_query($conn, $totalCountSql);
                    $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                    $totalCount = $totalCountRow['total'];

                    $totalPages = ceil($totalCount / $recordsPerPage);

                    

                    if ($result && mysqli_num_rows($result) > 0) {
                        $results = [];
                        ?>
                        <div class="section">
                            <form id="profilesForm" method="POST" action="delete_multiple.php">
                                <table>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th><center>Actions</center></th>
                                        <th>
                                            <center>
                                                <button style="border-radius: 0" type="submit" class="btn btn-danger btn-delete"
                                                    onclick="return confirm('Are you sure you want to delete the selected profiles?');">
                                                    Delete Selected
                                                </button>
                                            </center>
                                        </th>
                                    </tr>

                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
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
                                                <a style="text-transform:capitalize"href="" class="profileNameLink" type="button"
                                                    data-id="<?= $id; ?>"><?= $fullName; ?></a>
                                            </td>
                                            <td>
                                                <p style="text-transform:lowercase"><?= $email; ?></p>
                                            </td>
                                            <td>
                                                <center>
                                                <a href="update.php?id=<?= $id; ?>"
                                                    class="btn btn-primary">Update</a>
                                                <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                                                </center>
                                                </td>
                                            <td>
                                                <center>
                                                    <input type="checkbox" name="selectedProfiles[]"
                                                        value="<?= $id; ?>">
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </form>
                    <div class="pagination">  
                    <?php
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination justify-content-center">';
                        $disabledPrev = ($currentPage == 1) ? "disabled" : "";
                        echo '<li class="page-item ' . $disabledPrev . '"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
    
                        for ($i = 1; $i <= $totalPages; $i++) {
                            $activeClass = ($currentPage == $i) ? "active" : "";
                            echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
    
                        $disabledNext = ($currentPage == $totalPages || $totalPages == 0) ? "disabled" : "";
                        echo '<li class="page-item ' . $disabledNext . '"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
                        echo '</ul>';
                        echo '</nav>';
                    }
                    ?>
                    </div>  
        </div>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modalContent">
            <span class="close">&times;</span>
            <div id="modalInside"></div>
        </div>
    </div>

    <script>
        const results = <?php echo json_encode($results); ?>;
        var modal = document.getElementById("myModal");
        var btns = document.getElementsByClassName("profileNameLink");
        var span = document.getElementsByClassName("close")[0];
        var modalInside = document.getElementById('modalInside');
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function (e) {
                e.preventDefault();
                modal.style.display = "block";
                const selectedProfile = results.find(res => res.id == this.getAttribute('data-id'));
                let fullName = `${selectedProfile.fname} ${selectedProfile.mname} ${selectedProfile.lname}`;
                modalInside.innerHTML =
                    `<div class="details">Full name: ${fullName}</div>
                     <div class="details">Address: ${selectedProfile.region} ${selectedProfile.province} ${selectedProfile.municipality} ${selectedProfile.barangay} ${selectedProfile.purok}</div>
                     <div class="details">Sex: ${selectedProfile.sex}</div>
                     <div class="details">Age: ${selectedProfile.age}</div>
                     <div class="details">Birth Date: ${selectedProfile.birth_date}</div>
                     <div class="details">Email: ${selectedProfile.email}</div>
                     <div class="details">Contact Number: ${selectedProfile.contactnumber}</div>
                     <div class="details">Civil Status: ${selectedProfile.civil_status}</div>
                     <div class="details">Age Group: ${selectedProfile.age_group}</div>
                     <div class="details">Educational Background: ${selectedProfile.educational_background}</div>`;
                     <?php
                        if ($role == 'admin') {
                            echo 'modalInside.innerHTML += `<div class="details">Youth Classification: ${selectedProfile.youth_classification}</div>`;';
                        }
                     ?>
                     modalInside.innerHTML += `<div class="details">Work Status: ${selectedProfile.work_status}</div>
                     <div class="details">Registered SK Voter: ${selectedProfile.register_sk_voter}</div>
                     <div class="details">Voted Last Election: ${selectedProfile.voted_last_election}</div>
                     <div class="details">Attended a KK Assembly: ${selectedProfile.attended_kk}</div>
                     <div class="details">Times Attended: ${selectedProfile.times_attended_kk}</div>`;
            });
        }

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function exportToCSV(array, filename = 'data.csv') {
            if (array.length > 0) {
                const header = Object.keys(array[0]);
                const csv = array.map(row => header.map(fieldName => JSON.stringify(row[fieldName])).join(','));
                csv.unshift(header.join(','));
                const csvArray = csv.join('\r\n');

                const blob = new Blob([csvArray], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement("a");
                if (link.download !== undefined) {
                    const url = URL.createObjectURL(blob);
                    link.setAttribute("href", url);
                    link.setAttribute("download", filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }
        }

        document.getElementById('exportBtn').addEventListener('click', function (e) {
            e.preventDefault();
            exportToCSV(results, 'profiles.csv');
        });
    </script>

</body>

</html>