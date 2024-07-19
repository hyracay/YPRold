<?php

session_start();
include("../connection/conne.php");

if (!isset($_SESSION['USER'])) {
    header("location:../index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}
if (isset($_POST['submit'])) {
    // Retrieve form data
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sitio = $_POST['sitio'];
    $purok = $_POST['purok'];
    $house_number = $_POST['house_number'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST ['birth_day'];
    $birth_year = $_POST ['birth_year'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];
    $voted_last_election = $_POST['voted_last_election'];
    $national_voter = $_POST ['national_voter'];
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = $_POST['times_attended_kk'];
    $no_why = $_POST['no_why'];

    $insert = "INSERT INTO profiles
            (lname, fname, mname, suffix, region, province, municipality, barangay, sitio, purok, house_number,
             sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
             age_group, work_status, educational_background, register_sk_voter, voted_last_election, national_voter, attended_kk, times_attended_kk, no_why)
            VALUES 
            ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$sitio', '$purok','$house_number',
             '$sex', '$age', '$email', '$birth_month','$birth_day','$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
             '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$national_voter', '$attended_kk', '$times_attended_kk','$no_why')";

    $result = mysqli_query($conn, $insert);

    if (!$result) {
        echo "Error: " . $insert . "<br>" . mysqli_error($conn);
    }
}                               
?>
<?php



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve existing profile data
    $query = "SELECT * FROM profiles WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $profile = mysqli_fetch_assoc($result);
    } else {
        echo "No profile found with the specified ID.";
        exit();
    }
} else {
    echo "No profile ID specified.";
    exit();
}

if (isset($_POST['update'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $suffix = $_POST['suffix'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $municipality = $_POST['municipality'];
    $barangay = $_POST['barangay'];
    $sitio = $_POST['sitio'];
    $purok = $_POST['purok'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $youth_with_needs= $_POST['youth_with_needs'];
    $email = $_POST['email'];
    $birth_month = $_POST['birth_month'];
    $birth_day = $_POST['birth_day'];
    $birth_year = $_POST['birth_year'];
    $contactnumber = $_POST['contactnumber'];
    $civil_status = $_POST['civil_status'];
    $youth_classification = $_POST['youth_classification'];
    $age_group = $_POST['age_group'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $register_sk_voter = $_POST['register_sk_voter'];
    $voted_last_election = $_POST['voted_last_election'];
    $national_voter = isset($_POST['national_voter']) ? $_POST['national_voter'] : '';
    $attended_kk = $_POST['attended_kk'];
    $times_attended_kk = isset($_POST['times_attended_kk']) ? $_POST['times_attended_kk'] : '';
    $no_why = isset($_POST['no_why']) ? $_POST['no_why'] : '';
    
    // Prepare SQL statement
    $update = "UPDATE profiles SET 
            lname = '$lname',
            fname = '$fname',
            mname = '$mname',
            suffix = '$suffix',
            region = '$region',
            province = '$province',
            municipality = '$municipality',
            barangay = '$barangay',
            sitio = '$sitio',
            purok = '$purok',
            sex = '$sex',
            age = '$age',
            youth_with_needs = '$youth_with_needs',
            email = '$email',
            birth_month = '$birth_month',
            birth_day = '$birth_day',
            birth_year = '$birth_year',
            contactnumber = '$contactnumber',
            civil_status = '$civil_status',
            youth_classification = '$youth_classification',
            age_group = '$age_group',
            work_status = '$work_status',
            educational_background = '$educational_background',
            register_sk_voter = '$register_sk_voter',
            voted_last_election = '$voted_last_election',
            national_voter = '$national_voter',
            attended_kk = '$attended_kk',
            times_attended_kk = '$times_attended_kk',
            no_why = '$no_why'
        WHERE id = $id";

    $result = mysqli_query($conn, $update);

    if ($result) {
        header("location: profiles.php");
        echo "<script>alert('Record updated successfully');</script>";
    } else {
        echo "<script>alert('Error');</script>";
    }
}
function calculateAge($birth_year, $birth_month, $birth_day) {
    $birthDate = "$birth_year-$birth_month-$birth_day";
    $age = date_diff(date_create($birthDate), date_create('today'))->y;
    return $age;
}

$barangay_code = "";
$code = $_SESSION['code'];
$fetch_barangay = "SELECT * FROM barangay WHERE CODE = '$_SESSION[code]'";
$fetch_barangay_result = mysqli_query($conn, $fetch_barangay);
while($row = mysqli_fetch_assoc($fetch_barangay_result)){
  $barangay_code = $row['Brngy'];
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Datatables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../bootstrap/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../bootstrap/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../bootstrap/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../bootstrap/assets/css/kaiadmin.min.css" />
    <script src="../bootstrap/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../bootstrap/assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="../bootstrap/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../bootstrap/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../bootstrap/assets/css/kaiadmin.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            padding: 20px;
        }
        form {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="radio"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="radio"] {
            width: auto;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            td {
                display: block;
                width: 100%;
            }
            input[type="radio"] {
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <div class="logo-header" data-background-color="dark">
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item">
                        <a href="homepage.php" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#tables">
                            <i class="fas icon-people"></i>
                            <p>Youth Profiles</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="profiles.php">
                                        <span class="sub-item" active>Create/View Profiles</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="archive.php">
                                        <span class="sub-item">Archive</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                       
             
                    <li class="nav-item">
                        <a href="calendar.php">
                            <i class="fas icon-calendar"></i>
                            <p>Calendar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="recycle.php">
                            <i class="fas icon-trash"></i>
                            <p>Recycle Bin</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-panel">
        <div class="main-header">
            <div class="main-header-logo">
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img src="../bootstrap/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20"/>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"></nav>
                    <h3><?php echo $barangay_code; ?> La Trinidad Youth Profiling System</h3>
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item topbar-user dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="../bootstrap/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle"/>
                                </div>
                                <span class="profile-username">
                                <span class="fw-bold"><?php echo $_SESSION['email']; ?></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg">
                                                <img src="../bootstrap/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"/>
                                            </div>
                                            <div class="u-text">
                                                <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                                                <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                          <li>
                        <div class="dropdown-divider"></div>
                       
                        <a class="dropdown-item" href="logout.php">Logout</a>
                      </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        

        
    <!-- Core JS Files -->
<!-- Core JS Files -->
<script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../bootstrap/assets/js/core/popper.min.js"></script>
<script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>
<!-- jQuery Scrollbar -->
<script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Chart JS -->
<script src="../bootstrap/assets/js/plugin/chart.js/chart.min.js"></script>< class="content">
            <br><br><br>
            
            <div class="container">
            <center><h3>Update Profile</h3></center>
        <form method="POST" action="update.php?id=<?php echo $id; ?>">
            <input type="hidden" name="id" value="<?php echo $profile['id']; ?>">
            <table>
                <tr>
                    <td>I. Profile</td>
                </tr>
                <tr>
                    <td>
                        Name: <input type="text" name="lname" placeholder="Last Name" value="<?php echo $profile['lname']; ?>" required>
                              <input type="text" name="fname" placeholder="First Name" value="<?php echo $profile['fname']; ?>" required>
                              <input type="text" name="mname" placeholder="Middle Name" value="<?php echo $profile['mname']; ?>" required>
                              <input type="text" name="suffix" placeholder="Suffix" value="<?php echo $profile['suffix']; ?>" >
                    </td>
                </tr>
                <tr>
                    <td><br>
                        Location: <input type="text" name="region" placeholder="Region" value="<?php echo $profile['region']; ?>" readonly>
                                  <input type="text" name="province" placeholder="Province" value="<?php echo $profile['province']; ?>" readonly>
                                  <input type="text" name="municipality" placeholder="Municipality" value="<?php echo $profile['municipality']; ?>" readonly>
                                  <input type="text" name="sitio" placeholder="Sitio" value="<?php echo $profile['sitio']; ?>" required>
                                  <input type="text" name="barangay" placeholder="Barangay" value="<?php echo $profile['barangay']; ?>" readonly>
                                  <input type="text" name="purok" placeholder="Purok/Zone" value="<?php echo $profile['purok']; ?>" required>
                                  <input type="text" name="house_number" placeholder="House Number" value="<?php echo $profile['house_number']; ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr><br>
                                <td style="border: 1px solid;">
                                    Sex : <br>
                                    <input type="radio" name="sex" value="Male" <?php if ($profile['sex'] == 'Male') echo 'checked'; ?> required>Male<br>
                                    <input type="radio" name="sex" value="Female" <?php if ($profile['sex'] == 'Female') echo 'checked'; ?> required>Female
                                </td>
                                <td>
                                <td>
                                Birth Date:<br>
                                <select name="birth_month" required onchange="calculateAge()">
                                    <option value="">Month</option>
                                    <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                        <option value="<?php echo $m; ?>" <?php if ($profile['birth_month'] == $m) echo 'selected'; ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                    <?php } ?>
                                </select>
                                <select name="birth_day" required onchange="calculateAge()">
                                    <option value="">Day</option>
                                    <?php for ($d = 1; $d <= 31; ++$d) { ?>
                                        <option value="<?php echo $d; ?>" <?php if ($profile['birth_day'] == $d) echo 'selected'; ?>><?php echo $d; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="text" name="birth_year" placeholder="Year" value="<?php echo $profile['birth_year']; ?>" required onchange="calculateAge()">
                                <td>
                                    Age:<br>
                                    <input type="text" name="age" style="width: 40%" id="age" value="<?php echo $profile['age']; ?>" readonly>
                                </td>
                                <tr>
                                    <td style = "width: 25%";>
                                        Youth with Specific Needs:<br>
                                        <input type="text" name="youth_with_needs" value="<?php echo $profile['youth_with_needs']; ?>" placeholder="Specify specific needs">
                                    </td>
                                </tr>
                                </tr>
                                        
                                    Email Address: <input type="email" name="email" placeholder="Email Address" value="<?php echo $profile['email']; ?>" required><br><br>
                                    
                                    Contact Number: <input type="text" name="contactnumber" placeholder="Contact Number" value="<?php echo $profile['contactnumber']; ?>" required>
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
                                    <input type="radio" name="civil_status" value="Single" <?php if ($profile['civil_status'] == 'Single') echo 'checked'; ?> required>Single<br>
                                    <input type="radio" name="civil_status" value="Married" <?php if ($profile['civil_status'] == 'Married') echo 'checked'; ?> required>Married<br>
                                    <input type="radio" name="civil_status" value="Divorced" <?php if ($profile['civil_status'] == 'Divorced') echo 'checked'; ?> required>Divorced<br>
                                    <input type="radio" name="civil_status" value="Widowed" <?php if ($profile['civil_status'] == 'Widowed') echo 'checked'; ?> required>Widowed<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Youth Classification:<br>
                                    <input type="radio" name="youth_classification" value="In School Youth" <?php if ($profile['youth_classification'] == 'In School Youth') echo 'checked'; ?> required>In Youth School<br>
                                    <input type="radio" name="youth_classification" value="Out Of School Youth" <?php if ($profile['youth_classification'] == 'Out Of School Youth') echo 'checked'; ?> required>Out of School Youth<br>
                                    <input type="radio" name="youth_classification" value="Working Youth" <?php if ($profile['youth_classification'] == 'Working Youth') echo 'checked'; ?> required>Working Youth<br>
                                    <input type="radio" name="youth_classification" value="Person With Disability (PWD)" <?php if ($profile['youth_classification'] == 'Person With Disability (PWD)') echo 'checked'; ?> required>Person with Disability (PWD)<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td style="border: 1px solid;" hidden>
                                    Your Age Group:<br>
                                    <input type="radio" name="age_group" value="Child Youth" <?php if ($profile['age_group'] == 'Child Youth') echo 'checked'; ?> hidden>Child Youth (15-17 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Core Youth" <?php if ($profile['age_group'] == 'Core Youth') echo 'checked'; ?> hidden>Core Youth (18-24 yrs. old)<br>
                                    <input type="radio" name="age_group" value="Young Adult" <?php if ($profile['age_group'] == 'Young Adult') echo 'checked'; ?> hidden>Young Adult (25-30 yrs. old)<br>
                                </td>
                                <td style="border: 1px solid;">
                                    Work Status:<br>
                                    <input type="radio" name="work_status" value="Employed" <?php if ($profile['work_status'] == 'Student') echo 'checked'; ?> required>Student<br>
                                    <input type="radio" name="work_status" value="Employed" <?php if ($profile['work_status'] == 'Employed') echo 'checked'; ?> required>Employed<br>
                                    <input type="radio" name="work_status" value="Unemployed" <?php if ($profile['work_status'] == 'Unemployed') echo 'checked'; ?> required>Unemployed<br>
                                    <input type="radio" name="work_status" value="Self-Employed" <?php if ($profile['work_status'] == 'Self-Employed') echo 'checked'; ?> required>Self-Employed<br>
                                    <input type="radio" name="work_status" value="Currently looking for job" <?php if ($profile['work_status'] == 'Currently looking for job') echo 'checked'; ?> required>Currently looking for job<br>
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
                                    <input type="radio" name="educational_background" value="Elementary Level" <?php if ($profile['educational_background'] == 'Elementary Level') echo 'checked'; ?> required>Elementary Level<br>
                                    <input type="radio" name="educational_background" value="Elementary Graduate" <?php if ($profile['educational_background'] == 'Elementary Graduate') echo 'checked'; ?> required>Elementary Graduate<br>
                                    <input type="radio" name="educational_background" value="High School Level" <?php if ($profile['educational_background'] == 'High School Level') echo 'checked'; ?> required>High School Level<br>
                                    <input type="radio" name="educational_background" value="High School Graduate" <?php if ($profile['educational_background'] == 'High School Graduate') echo 'checked'; ?> required>High School Graduate<br>
                                    <input type="radio" name="educational_background" value="Vocational Graduate" <?php if ($profile['educational_background'] == 'Vocational Graduate') echo 'checked'; ?> required>Vocational Graduate<br>
                                    <input type="radio" name="educational_background" value="College Level" <?php if ($profile['educational_background'] == 'College Level') echo 'checked'; ?> required>College Level<br>
                                    <input type="radio" name="educational_background" value="College Graduate" <?php if ($profile['educational_background'] == 'College Graduate') echo 'checked'; ?> required>College Graduate<br>
                                    <input type="radio" name="educational_background" value="Master Level" <?php if ($profile['educational_background'] == 'Master Level') echo 'checked'; ?> required>Master's Level<br>
                                    <input type="radio" name="educational_background" value="Master Graduate" <?php if ($profile['educational_background'] == 'Master Graduate') echo 'checked'; ?> required>Master's Graduate<br>
                                    <input type="radio" name="educational_background" value="Doctorate Level" <?php if ($profile['educational_background'] == 'Doctorate Level') echo 'checked'; ?> required>Doctorate Level<br>
                                </td>
                                <tr>
                    <td>
                        Registered SK Voter:<br>
                        <input type="radio" name="register_sk_voter" value="Registered" <?php if ($profile['register_sk_voter'] == 'Registered') echo 'checked'; ?> required> Registered
                        <input type="radio" name="register_sk_voter" value="Not Registered" <?php if ($profile['register_sk_voter'] == 'Not Registered') echo 'checked'; ?> required> Not Registered</td>
                    </td>
                    <td>
                      Voted Last Election:<br>
                        <input type="radio" name="voted_last_election" value="Yes" <?php if ($profile['voted_last_election'] == 'Yes') echo 'checked'; ?> required> Yes
                        <input type="radio" name="voted_last_election" value="No" <?php if ($profile['voted_last_election'] == 'No') echo 'checked'; ?> required> No
                    <td>
                        National Voter:<br>
                        <input type="radio" name="national_voter" value="Yes" <?php if ($profile['national_voter'] == 'Yes') echo 'checked'; ?> required> Yes
                        <input type="radio" name="national_voter" value="No" <?php if ($profile['national_voter'] == 'No') echo 'checked'; ?> required> No
                    </td>
                    </tr>
                  <tr>
    <td>III. Participation in KK</td>
</tr>
<tr>
    <td>
        Attended KK:<br>
        <input type="radio" name="attended_kk" value="Yes" <?php if ($profile['attended_kk'] == 'Yes') echo 'checked'; ?> required> Yes
        <input type="radio" name="attended_kk" value="No" <?php if ($profile['attended_kk'] == 'No') echo 'checked'; ?> required> No
    </td>
    <td>
        Times Attended KK:<br>
        <input type="number" name="times_attended_kk" placeholder="Times Attended KK" value="<?php echo $profile['times_attended_kk']; ?>" required>
    </td>
    <td>
        No Why:<br>
        <input type="text" name="no_why" placeholder="No Why" value="<?php echo $profile['no_why']; ?>" >
    </td>
</tr>

                <tr>
                    <td><br><button type="submit" name="update" >Update</button></td>
                </tr>
            </table>
    </div>
    </form>
    </div>
    <script>
    function calculateAge() {
        var birthMonth = document.getElementsByName("birth_month")[0].value;
        var birthDay = document.getElementsByName("birth_day")[0].value;
        var birthYear = document.getElementsByName("birth_year")[0].value;

        if (birthMonth && birthDay && birthYear) {
            // Create a date string in the format accepted by Date constructor
            var birthDateString = birthYear + '-' + birthMonth + '-' + birthDay;
            var birthDate = new Date(birthDateString);

            // Adjust for Manila time zone (GMT+8)
            var manilaOffset = 8 * 60; // Offset in minutes
            birthDate.setMinutes(birthDate.getMinutes() + manilaOffset);

            // Now proceed with age calculation as before
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.getElementById("age").value = age;

            // Set age group based on age
            var ageGroup = '';
            if (age >= 15 && age <= 17) {
                ageGroup = 'Child Youth';
            } else if (age >= 18 && age <= 24) {
                ageGroup = 'Core Youth';
            } else if (age >= 25 && age <= 30) {
                ageGroup = 'Young Adult';
            }

            // Check the appropriate radio button for age_group
            var radios = document.getElementsByName('age_group');
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].value === ageGroup) {
                    radios[i].checked = true;
                }
            }
        }
    }
</script>
<!-- jQuery Sparkline -->
<script src="../bootstrap/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
<!-- Chart Circle -->
<script src="../bootstrap/assets/js/plugin/chart-circle/circles.min.js"></script>
<!-- Datatables -->
<script src="../bootstrap/assets/js/plugin/datatables/datatables.min.js"></script>
<!-- Bootstrap Notify -->
<script src="../bootstrap/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- jQuery Vector Maps -->
<script src="../bootstrap/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../bootstrap/assets/js/plugin/jsvectormap/world.js"></script>
<!-- Google Maps Plugin -->
<script src="../bootstrap/assets/js/plugin/gmaps/gmaps.js"></script>
<!-- Sweet Alert -->
<script src="../bootstrap/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<!-- Kaiadmin JS -->
<script src="../bootstrap/assets/js/kaiadmin.min.js"></script>
</body>
</html>