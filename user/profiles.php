<?php
session_start();
include("../connection/conne.php");

// Ensure session email is set, otherwise redirect
if (!isset($_SESSION['USER'])) {
    header("location:../index.php");
    exit(); // Ensure that no further code is executed after the redirection
}

$barangay_code = $_SESSION['code'];

// Fetch barangay name based on the code
$fetch_barangay = "SELECT Brngy FROM barangay WHERE Code = '$barangay_code'";
$fetch_barangay_result = mysqli_query($conn, $fetch_barangay);
$barangay_name = "";
if ($row = mysqli_fetch_assoc($fetch_barangay_result)) {
    $barangay_name =$row['Brngy'];
}

// Initialize variables for advanced search fields
$age_min = $age_max = $civil_status = $sex = $work_status = $educational_background = $youth_classification = $register_sk_voter = "";

// For advanced search
if (isset($_POST['advancesearch'])) {
    // Fetch form data
    $age_min = $_POST['age_min'];
    $age_max = $_POST['age_max'];
    $civil_status = $_POST['civil_status'];
    $sex = $_POST['sex'];
    $work_status = $_POST['work_status'];
    $educational_background = $_POST['educational_background'];
    $youth_classification = $_POST['youth_classification'];
    $register_sk_voter = $_POST['register_sk_voter'];

    // Build SQL query for advanced search
    $query = "SELECT * FROM profiles WHERE barangay_code = '$barangay_code'";
    if (!empty($age_min)) $query .= " AND age >= $age_min";
    if (!empty($age_max)) $query .= " AND age <= $age_max";
    if (!empty($civil_status)) $query .= " AND civil_status = '$civil_status'";
    if (!empty($sex)) $query .= " AND sex = '$sex'";
    if (!empty($work_status)) $query .= " AND work_status = '$work_status'";
    if (!empty($educational_background)) $query .= " AND educational_background = '$educational_background'";
    if (!empty($youth_classification)) $query .= " AND youth_classification = '$youth_classification'";
    if (!empty($register_sk_voter)) $query .= " AND register_sk_voter = '$register_sk_voter'";

    $result = mysqli_query($conn, $query);
} else {
    // Pagination and search
    $recordsPerPage = 20;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $recordsPerPage;

    if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
        $sql = "SELECT * FROM profiles 
                WHERE (fname LIKE '%$searchQuery%' OR lname LIKE '%$searchQuery%' OR mname LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%') 
                AND barangay_code = '$barangay_code'
                ORDER BY id DESC 
                ";
    } else {
        $sql = "SELECT * FROM profiles 
                WHERE barangay_code = '$barangay_code'
                ORDER BY id DESC 
                ";
    }

    $result = mysqli_query($conn, $sql);

    $totalCountSql = "SELECT COUNT(*) AS total FROM profiles WHERE barangay_code = '$barangay_code'";
    $totalCountResult = mysqli_query($conn, $totalCountSql);
    $totalCountRow = mysqli_fetch_assoc($totalCountResult);
    $totalCount = $totalCountRow['total'];
    $totalPages = ceil($totalCount / $recordsPerPage);
}

if (isset($_POST['submitAdd'])) {
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
  $youth_with_needs = $_POST['youth_with_needs'];
  $email = $_POST['email'];
  $birth_month = $_POST['birth_month'];
  $birth_day = $_POST['birth_day'];
  $birth_year = $_POST['birth_year'];
  $contactnumber = $_POST['contactnumber'];
  $civil_status = $_POST['civil_status'];
  $youth_classification = $_POST['youth_classification'];
  $work_status = $_POST['work_status'];
  $educational_background = $_POST['educational_background'];
  $register_sk_voter = $_POST['register_sk_voter'];
  $voted_last_election = $_POST['voted_last_election'];
  $national_voter = $_POST['national_voter'];
  $attended_kk = $_POST['attended_kk'];
  $times_attended_kk = $_POST['times_attended_kk'];
  $no_why = $_POST['no_why'];
  $barangay_code = $_SESSION['code'];

  // Calculate age group
  $ageGroup = '';
  if ($age >= 15 && $age <= 17) {
      $ageGroup = 'Child Youth';
  } elseif ($age >= 18 && $age <= 24) {
      $ageGroup = 'Core Youth';
  } elseif ($age >= 25 && $age <= 30) {
      $ageGroup = 'Young Adult';
  }

  // Insert into database
  $insert = "INSERT INTO profiles
          (lname, fname, mname, suffix, region, province, municipality, barangay, sitio, purok, house_number,
          sex, age, youth_with_needs, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
          age_group, work_status, educational_background, register_sk_voter, voted_last_election, national_voter, attended_kk, times_attended_kk, no_why, barangay_code)
          VALUES
          ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay','$sitio', '$purok', '$house_number',
          '$sex', '$age', '$youth_with_needs', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
          '$ageGroup', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$national_voter', '$attended_kk', '$times_attended_kk', '$no_why','$barangay_code')";

  $result = mysqli_query($conn, $insert);

  if ($result) {
      header("location:profiles.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title></title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="../bootstrap/assets/img/kaiadmin/favicon.ico" type="image/x-icon" />
  <!-- Fonts and icons -->
  <script src="../bootstrap/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
   WebFont.load({
    google: {
     families: ["Public Sans:300,400,500,600,700"]
    },
    custom: {
     families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons", ],
     urls: ["../bootstrap/assets/css/fonts.min.css"],
    },
    active: function() {
     sessionStorage.fonts = true;
    },
   });
  </script>
  <!-- CSS Files -->
  <link rel="stylesheet" href="../bootstrap/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../bootstrap/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../bootstrap/assets/css/kaiadmin.min.css" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <!-- <link rel="stylesheet" href="../assets/css/demo.css" /> -->
 </head>
 <body>
  <div class="wrapper">
   <!-- Sidebar -->
   <div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
     <!-- Logo Header -->
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
     <!-- End Logo Header -->
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
      <!-- Logo Header -->
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
      <!-- End Logo Header -->
     </div>
     <!-- Navbar Header -->
     <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
      <div class="container-fluid">
       <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex"></nav>
       <h3> <?php echo $barangay_name; ?> La Trinidad Youth Profiling System </h3>
       <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        <li class="nav-item topbar-user dropdown hidden-caret">
         <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="avatar-sm">
           <img src="../bootstrap/assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
          </div>
          <span class="profile-username">
           <span class="fw-bold"> <?php echo $_SESSION['email']; ?> </span>
          </span>
         </a>
         <ul class="dropdown-menu dropdown-user animated fadeIn">
          <div class="dropdown-user-scroll scrollbar-outer">
           <li>
            <div class="user-box">
             <div class="avatar-lg">
              <img src="../bootstrap/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded" />
             </div>
             <div class="u-text">
              <h4> <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?> </h4>
              <p class="text-muted"> <?php echo $_SESSION['email']; ?> </p>
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
     <!-- End Navbar -->
    </div>
    <!-- main content -->
    <div class="container">
     <div class="page-inner">
      <div class="page-header">
       <h3 class="fw-bold mb-3">Youth Profiles</h3>
      </div>
      <div class="row">
       <div class="col-md-12">
        <div class="card">
         <div class="card-header">
          <div class="ms-auto">
           <button id="newProfile" style="float: left" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
            <i class="fa fa-plus"></i> New Profile </button>
           <button id="importBtn" style="float: right" class="btn btn-primary btn-round ms-auto1" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fa fa-file-import"></i> Import </button>
           <!-- Advance Search Button -->
           <button type="button" style="float: right;" class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
            <i class="fa fa-search"></i> Advance Search </button>
           <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
             <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Advance Search</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">
                <span aria-hidden="true">&times;</span>
               </button>
              </div>
              <div class="modal-body">
               <form method="POST">
                <div class="container">
                 <div class="content">
                  <div class="form-row">
                   <div class="form-group col-md-6">
                    <label for="age_min">Minimum Age</label>
                    <input type="number" class="form-control" id="age_min" name="age_min" min="15" max="30" value="
																						<?php echo htmlspecialchars($age_min); ?>">
                   </div>
                   <div class="form-group col-md-6">
                    <label for="age_max">Maximum Age</label>
                    <input type="number" class="form-control" id="age_max" name="age_max" min="15" max="30" value="
																							<?php echo htmlspecialchars($age_max); ?>">
                   </div>
                  </div>
                  <div class="form-group">
                   <label for="civil_status">Civil Status</label>
                   <select class="form-control" id="civil_status" name="civil_status">
                    <option value="" <?php echo $civil_status == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="Single" <?php echo $civil_status == 'Single' ? 'selected' : ''; ?>>Single </option>
                    <option value="Married" <?php echo $civil_status == 'Married' ? 'selected' : ''; ?>>Married </option>
                    <option value="Divorced" <?php echo $civil_status == 'Divorced' ? 'selected' : ''; ?>>Divorced </option>
                    <option value="Widowed" <?php echo $civil_status == 'Widowed' ? 'selected' : ''; ?>>Widowed </option>
                   </select>
                  </div>
                  <div class="form-group">
                   <label for="sex">Sex</label>
                   <select class="form-control" id="sex" name="sex">
                    <option value="" <?php echo $sex == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="Male" <?php echo $sex == 'Male' ? 'selected' : ''; ?>>Male </option>
                    <option value="Female" <?php echo $sex == 'Female' ? 'selected' : ''; ?>>Female </option>
                   </select>
                  </div>
                  <div class="form-group">
                   <label for="work_status">Work Status</label>
                   <select class="form-control" id="work_status" name="work_status">
                    <option value="" <?php echo $work_status == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="Student" <?php echo $work_status == 'Student' ? 'selected' : ''; ?>>Student </option>
                    <option value="Employed" <?php echo $work_status == 'Employed' ? 'selected' : ''; ?>>Employed </option>
                    <option value="Unemployed" <?php echo $work_status == 'Unemployed' ? 'selected' : ''; ?>>Unemployed </option>
                    <option value="Self-Employed" <?php echo $work_status == 'Self-Employed' ? 'selected' : ''; ?>>Self-Employed </option>
                    <option value="Currently Looking For Job" <?php echo $work_status == 'Currently Looking For Job' ? 'selected' : ''; ?>>Currently Looking For Job </option>
                   </select>
                  </div>
                  <div class="form-group">
                   <label for="educational_background">Educational Background</label>
                   <select class="form-control" id="educational_background" name="educational_background">
                    <option value="" <?php echo $educational_background == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="Elementary Level" <?php echo $educational_background == 'Elementary Level' ? 'selected' : ''; ?>>Elementary Level </option>
                    <option value="Elementary Graduate" <?php echo $educational_background == 'Elementary Graduate' ? 'selected' : ''; ?>>Elementary Graduate </option>
                    <option value="High School Level" <?php echo $educational_background == 'High School Level' ? 'selected' : ''; ?>>High School Level </option>
                    <option value="High School Graduate" <?php echo $educational_background == 'High School Graduate' ? 'selected' : ''; ?>>High School Graduate </option>
                    <option value="Vocational Graduate" <?php echo $educational_background == 'Vocational Graduate' ? 'selected' : ''; ?>>Vocational Graduate </option>
                    <option value="College Level" <?php echo $educational_background == 'College Level' ? 'selected' : ''; ?>>College Level </option>
                    <option value="College Graduate" <?php echo $educational_background == 'College Graduate' ? 'selected' : ''; ?>>College Graduate </option>
                    <option value="Master Level" <?php echo $educational_background == "Master Level" ? 'selected' : ''; ?>>Master's Level </option>
                    <option value="Master Graduate" <?php echo $educational_background == "Master Graduate" ? 'selected' : ''; ?>>Master's Graduate </option>
                    <option value="Doctorate Level" <?php echo $educational_background == 'Doctorate Level' ? 'selected' : ''; ?>>Doctorate Level </option>
                   </select>
                  </div>
                  <div class="form-group">
                   <label for="youth_classification">Youth Classification</label>
                   <select class="form-control" id="youth_classification" name="youth_classification">
                    <option value="" <?php echo $youth_classification == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="In School Youth" <?php echo $youth_classification == 'In School Youth' ? 'selected' : ''; ?>>In School Youth </option>
                    <option value="Out Of School Youth" <?php echo $youth_classification == 'Out Of School Youth' ? 'selected' : ''; ?>>Out Of School Youth </option>
                    <option value="Working Youth" <?php echo $youth_classification == 'Working Youth' ? 'selected' : ''; ?>>Working Youth </option>
                    <option value="Person With Disability (PWD)" <?php echo $youth_classification == 'Person With Disability (PWD)' ? 'selected' : ''; ?>>Person With Disability (PWD) </option>
                   </select>
                  </div>
                  <div class="form-group">
                   <label for="register_sk_voter" class="form-label">Register SK Voter</label>
                   <select class="form-control" id="register_sk_voter" name="register_sk_voter">
                    <option value="" <?php echo $register_sk_voter == '' ? 'selected' : ''; ?>>Any </option>
                    <option value="Registered" <?php echo $register_sk_voter == 'Registered' ? 'selected' : ''; ?>>Yes </option>
                    <option value="Not Registered" <?php echo $register_sk_voter == 'Not Registered' ? 'selected' : ''; ?>>No </option>
                   </select>
                  </div>
                 </div>
                </div>
              </div>
              <div class="modal-footer">
               <button type="submit" class="btn btn-primary" name="advancesearch">Search</button>
               <button type="submit" class="btn btn-primary" name="clearfilterarchive">Clear Filter</button>
              </div>
              </form>
             </div>
            </div>
           </div>
           <!-- fetch rows -->
           <div class="table-responsive">
            <form id="profilesForm" method="POST" action="delete_multiple.php">
             <table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
              <thead>
               <tr role="row">
                <th tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 30.516px;">
                <button type="button" class="btn btn-default" data-bs-toggle="tooltip"
                  title="Delete Selected" onclick="showDeleteConfirmationMultiple(event);">
                  <i style="font-size: 17pt" class="fa fa-trash-alt"></i>
                </button>
                </th>
                <th class="sorting_asc" tabindex="1" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 541.766px;">Name</th>
                <th tabindex="2" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 365.516px;">Email</th>
                <th tabindex="3" rowspan="1" colspan="1" style="width: 200.266px;">
                 <center>Actions</center>
                </th>
               </tr>
              </thead>
              <tbody> 
                <?php
                  if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) { ?>
                <td>
                 <center>
                  <input type="checkbox" name="selectedProfiles[]" value="
                    <?= $row['id']; ?>">
                 </center>
                </td>
                <td>
                 <a href="#" class="profileNameLink" data-id="
                    <?= $row['id']; ?>" data-fullname="
                    <?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?>" data-address="
                    <?= $row['house_number'] . ', ' . $row['purok'] . ', ' . $row['sitio'] . ', ' . $row['barangay'] . ', ' . $row['municipality'] . ', ' . $row['province'] . ', ' . $row['region']; ?>" data-sex="
                    <?= $row['sex']; ?>" data-age="
                    <?= $row['age']; ?>" data-email="
                    <?= $row['email']; ?>" data-birthday="
                    <?= $row['birth_month'] . '/' . $row['birth_day'] . '/' . $row['birth_year']; ?>" data-youth_with_needs="
                    <?= $row['youth_with_needs']; ?>" data-contact_number="
                    <?= $row['contactnumber']; ?>" data-civil_status="
                    <?= $row['civil_status']; ?>" data-age_group="
                    <?= $row['age_group']; ?>" data-educational_background="
                    <?= $row['educational_background']; ?>" data-youth_classification="
                    <?= $row['youth_classification']; ?>" data-work_status="
                    <?= $row['work_status']; ?>" data-national_voter="
                    <?= $row['national_voter']; ?>" data-register_sk_voter="
                    <?= $row['register_sk_voter']; ?>" data-voted_last_election="
                    <?= $row['voted_last_election']; ?>" data-times_attended="
                    <?= $row['times_attended_kk']; ?>" data-national_voter="
                    <?= $row['national_voter']; ?>" data-reason="
                    <?= $row['no_why']; ?>" data-bs-toggle="modal" data-bs-target="#modal-default"> <?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?> </a>
                </td>
                <td>
                 <p style="text-transform:lowercase"> <?= $row['email']; ?> </p>
                </td>
                <td>
                 <center>
                  <a href="update.php?id=
                    <?= $row['id']; ?>" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit">
                   <i class="fa fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-link btn-danger" title="Delete" data-bs-toggle="tooltip"
                  onclick="showDeleteConfirmation(event, <?= htmlspecialchars($row['id']); ?>);"><i
                  class="fa fa-times"></i></a>
                 </center>
                </td>
               </tr> <?php }
            } else {
              echo '
										<tr> <td colspan="4">No profiles found.</td> </tr>';
            }
          ?> </tbody>
             </table>
            </form>
           </div>
           <script>
            document.addEventListener('DOMContentLoaded', function() {
             document.querySelectorAll('.profileNameLink').forEach(function(link) {
              link.addEventListener('click', function() {
               var fullName = this.getAttribute('data-fullname');
               var address = this.getAttribute('data-address');
               var sex = this.getAttribute('data-sex');
               var sex = this.getAttribute('data-sex');
               var birthday = this.getAttribute('data-birthday');
               var youthWithNeeds = this.getAttribute('data-youth_with_needs');
               var email = this.getAttribute('data-email');
               var contactNumber = this.getAttribute('data-contact_number');
               var civilStatus = this.getAttribute('data-civil_status');
               var educationalBackground = this.getAttribute('data-educational_background');
               var youthClassification = this.getAttribute('data-youth_classification');
               var workStatus = this.getAttribute('data-work_status');
               var nationalVoter = this.getAttribute('data-national_voter');
               var registeredSkVoter = this.getAttribute('data-register_sk_voter');
               var votedLastElection = this.getAttribute('data-voted_last_election');
               var timesAttended = this.getAttribute('data-times_attended');
               var reason = this.getAttribute('data-reason');
               var bday = new Date(birthday);
               var today = new Date();
               var age = today.getFullYear() - bday.getFullYear();
               var monthDiff = today.getMonth() - bday.getMonth();
               if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bday.getDate())) {
                age--;
               }
               var ageGroup = '';
               if (age >= 15 && age <= 17) {
                ageGroup = 'Child Youth';
               } else if (age >= 18 && age <= 24) {
                ageGroup = 'Core Youth';
               } else if (age >= 25 && age <= 30) {
                ageGroup = 'Young Adult';
               }

               var modalContent = `
            
											<p>	<strong>Full Name:</strong> ${fullName}	</p>
											<p> <strong>Address:</strong> ${address} </p>
                      <p>	<strong>Sex:</strong> ${sex} </p>
										  <p> <strong>Age:</strong> ${age} </p>
											<p> <strong>Birthday:</strong> ${birthday} </p>
											<p>	<strong>Youth with Needs:</strong> ${youthWithNeeds} </p>
											<p> <strong>Email:</strong> ${email}	</p>
											<p> <strong>Contact Number:</strong> ${contactNumber} </p>
											<p> <strong>Civil Status:</strong> ${civilStatus} </p>
											<p>	<strong>Age Group:</strong> ${ageGroup} </p>
											<p> <strong>Educational Background:</strong> ${educationalBackground} </p>
											<p> <strong>Youth Classification:</strong> ${youthClassification} </p>
											<p>	<strong>Work Status:</strong> ${workStatus}	</p>
											<p> <strong>National Voter:</strong> ${nationalVoter} </p>
										  <p> <strong>Registered SK Voter:</strong> ${registeredSkVoter} </p>
										  <p>	<strong>Voted Last Election:</strong> ${votedLastElection}	</p>
											<p>	<strong>Times Attended:</strong> ${timesAttended}	</p>
											<p>	<strong>If no, why?</strong> ${reason} </p>
                                 
                                  `;
               document.getElementById('modal-body-content').innerHTML = modalContent;
              });
             });
            });
           </script>
           <!-- import csv modal -->
           <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
             <div class="modal-content">
              <div class="modal-header border-0">
               <h5 class="modal-title">
                <span class="fw-mediumbold">Import</span>
                <span class="fw-light">Profiles</span>
               </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">
                <span aria-hidden="true">&times;</span>
               </button>
              </div>
              <div class="modal-body">
               <form action="upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                 <label for="csvFile">Choose CSV File:</label>
                 <input type="file" name="csvFile" id="csvFile" accept=".csv" class="form-control" required>
                </div>
                <button type="submit" name="upload" class="btn btn-primary mt-3" style="float: right">Upload</button>
               </form>
              </div>
             </div>
            </div>
           </div>
           <div class="card-body">
            <!-- new profile modal -->
            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
             <div class="modal-dialog" role="document">
              <div class="modal-content">
               <div class="modal-header border-0">
                <h5 class="modal-title">
                 <span class="fw-mediumbold"> New</span>
                 <span class="fw-light"> Profile </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-bs-dismiss="modal">
                 <span aria-hidden="true">&times;</span>
                </button>
               </div>
               <!-- contents of create profile/ CRUD -->
               <div class="modal-body">
                <form method="POST">
                 <div class="row">
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <input id="addName" type="text" class="form-control" placeholder="Last Name" name="lname" required />
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <input id="addName" type="text" class="form-control" placeholder="First Name" name="fname" required />
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <input id="addName" type="text" class="form-control" placeholder="Middle Name" name="mname" />
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <input id="addName" type="text" class="form-control" placeholder="Suffix" name="suffix" />
                   </div>
                  </div>
                  <div class="col-md-6 pe-0">
                   <div class="form-group form-group-default">
                    <label>Region:</label>
                    <input type="text" class="form-control" value="CAR" name="region" readonly />
                   </div>
                   <div class="form-group form-group-default">
                    <label>Municipality:</label>
                    <input type="text" class="form-control" value="La Trinidad" name="municipality" readonly />
                   </div>
                   <div class="form-group form-group-default">
                    <input type="text" class="form-control" placeholder="Sitio" name="sitio" required />
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Province:</label>
                    <input type="text" class="form-control" value="Benguet" name="province" readonly />
                   </div>
                   <div class="form-group form-group-default">
    <label>Barangay:</label>
    <input type="text" class="form-control" name="barangay" readonly value="<?php
        $barangay_code = $_SESSION['code'];
        $fetch_barangay = "SELECT * FROM barangay WHERE CODE = '$barangay_code'";
        $fetch_barangay_result = mysqli_query($conn, $fetch_barangay);
        while ($row = mysqli_fetch_assoc($fetch_barangay_result)) {
            echo $row['Brngy']; // Output barangay name directly into the input field value
        }
    ?>">
</div>

                   <div class="form-group form-group-default">
                    <input type="text" class="form-control" placeholder="Purok" name="purok" required />
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <input id="addName" type="text" class="form-control" placeholder="House Number" name="house_number" required/>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Birthdate:</label>
                    <div>
                    <select id="birth_month" name="birth_month" required onchange="calculateAge()">
                      <option value="">Month</option>
                      <?php for ($m = 1; $m <= 12; ++$m): ?>
                        <option value="<?php echo $m; ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                      <?php endfor; ?>
                    </select>
                    
                    <select id="birth_day" name="birth_day" required onchange="calculateAge()">
                      <option value="">Day</option>
                      <?php for ($d = 1; $d <= 31; ++$d): ?>
                        <option value="<?php echo $d; ?>"><?php echo $d; ?></option>
                      <?php endfor; ?>
                    </select>
                    
                    <input type="number" id="birth_year" name="birth_year" placeholder="Year" required oninput="calculateAge()">
                  </div>

                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Age:</label>
                    <input id="age" type="number" class="form-control" name="age" required readonly />
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <label>Sex:</label>
                    <div class="d-flex">
                     <input type="radio" name="sex" value="Male" required>&nbsp;&nbsp;Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="sex" value="Female" required>&nbsp;&nbsp;Female
                    </div>
                   </div>
                  </div>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <label>Youth with Specific Needs:</label>
                    <input type="text" class="form-control" name="youth_with_needs" />
                   </div>
                   <div class="form-group form-group-default">
                    <label>Email:</label>
                    <input type="email" class="form-control" placeholder="user@sample.com" name="email" />
                   </div>
                   <div class="form-group form-group-default">
                    <label>Contact Number:</label>
                    <input type="text" class="form-control" placeholder="091234567" name="contactnumber" />
                   </div>
                  </div>
                  <script>
                   function calculateAge() {
                    var birth_month = document.getElementById("birth_month").value;
                    var birth_day = document.getElementById("birth_day").value;
                    var birth_year = document.getElementById("birth_year").value;
                    var ageGroup = '';
                    // Check if all birthdate parts are selected
                    if (birth_month && birth_day && birth_year) {
                     // Create birthdate in Manila time zone
                     var birthDate = new Date(birth_year, birth_month - 1, birth_day, 0, 0, 0);
                     var today = new Date(); // This gets current date in local time zone
                     // Convert today's date to Manila time zone
                     var todayManila = new Date(today.toLocaleString('en-US', {
                      timeZone: 'Asia/Manila'
                     }));
                     // Calculate age
                     var age = todayManila.getFullYear() - birthDate.getFullYear();
                     var monthDiff = todayManila.getMonth() - birthDate.getMonth();
                     if (monthDiff < 0 || (monthDiff === 0 && todayManila.getDate() < birthDate.getDate())) {
                      age--;
                     }
                     document.getElementById("age").value = age;
                     // Set age group based on age
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
                    } else {
                     // Clear age if birthdate is not fully selected
                     document.getElementById("age").value = "";
                    }
                    return ageGroup ?? '';
                   }
                  </script>
                  <div class="col-sm-12">
                   <div class="form-group form-group-default">
                    <label>Educational Background:</label>
                    <input type="radio" name="educational_background" value="Elementary Level"> Elementary Level <br>
                    <input type="radio" name="educational_background" value="Elementary Graduate"> Elementary Graduate <br>
                    <input type="radio" name="educational_background" value="High School Level"> High School Level <br>
                    <input type="radio" name="educational_background" value="High School Graduate"> High School Graduate <br>
                    <input type="radio" name="educational_background" value="Vocational Graduate"> Vocational Graduate <br>
                    <input type="radio" name="educational_background" value="College Level"> College Level <br>
                    <input type="radio" name="educational_background" value="College Graduate"> College Graduate <br>
                    <input type="radio" name="educational_background" value="Master Level"> Master's Level <br>
                    <input type="radio" name="educational_background" value="Master Graduate"> Master's Graduate <br>
                    <input type="radio" name="educational_background" value="Doctorate Level"> Doctorate Level <br>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Civil Status:</label>
                    <input type="radio" name="civil_status" value="Single" required> Single <br>
                    <input type="radio" name="civil_status" value="Married" required> Married <br>
                    <input type="radio" name="civil_status" value="Divorced" required> Divorced <br>
                    <input type="radio" name="civil_status" value="Widowed" required> Widowed <br>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Youth Classification:</label>
                    <input type="radio" name="youth_classification" value="In School Youth" required> In School Youth <br>
                    <input type="radio" name="youth_classification" value="Out Of School Youth" required> Out Of School Youth <br>
                    <input type="radio" name="youth_classification" value="Working Youth" required> Working Youth <br>
                    <input type="radio" name="youth_classification" value="Person With Disability (PWD)" required> Person With Disability (PWD) <br>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Work Status:</label>
                    <input type="radio" name="work_status" value="Student" required> Student <br>
                    <input type="radio" name="work_status" value="Employed" required> Employed <br>
                    <input type="radio" name="work_status" value="Unemployed" required> Unemployed <br>
                    <input type="radio" name="work_status" value="Self-Employed" required> Self-Employed <br>
                    <input type="radio" name="work_status" value="Currently looking for job" required> Currently Looking For Job <br>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Registered SK Voter:</label>
                    <div class="d-flex">
                     <input type="radio" name="register_sk_voter" value="Registered" required>&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="register_sk_voter" value="Not Registered" required>&nbsp;No
                    </div>
                   </div>
                   <div class="form-group form-group-default">
                    <label>Voted Last SK Election:</label>
                    <div class="d-flex">
                     <input type="radio" name="voted_last_election" value="Yes" required>&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="voted_last_election" value="No" required>&nbsp;No
                    </div>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>National Voter:</label>
                    <div class="d-flex">
                     <input type="radio" name="national_voter" value="Yes" required>&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="national_voter" value="No" required>&nbsp;No
                    </div>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>Attended KK Activities:</label>
                    <div class="d-flex">
                     <input type="radio" name="attended_kk" value="Yes" required>&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="attended_kk" value="No" required>&nbsp;No
                    </div>
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>KK Activities Attended:</label>
                    <input type="number" name="times_attended_kk" value="">
                   </div>
                  </div>
                  <div class="col-md-6">
                   <div class="form-group form-group-default">
                    <label>If no, why?</label>
                    <input type="text" name="why" value="">
                   </div>
                  </div>
                 </div>
               </div>
               <div class="modal-footer border-0">
                <button type="submit" id="addRowButton" class="btn btn-primary" name="submitAdd">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal"> Close </button>
               </div>
              </div>
             </div>
            </div>
            </form>
            <!-- end of modal -->
            <!-- fetch rows --> <?php
                          $recordsPerPage = 20;
                          $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                          $offset = ($currentPage - 1) * $recordsPerPage;

                          if (isset($_GET['search'])) {
                            $searchQuery = $_GET['search'];
                            $sql = "SELECT * FROM profiles 
                                    WHERE fname LIKE '%$searchQuery%' OR lname LIKE '%$searchQuery%' OR mname LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' 
                                    ORDER BY id DESC 
                                    LIMIT $recordsPerPage OFFSET $offset";
                          } else {
                            $sql = "SELECT * FROM profiles 
                                    ORDER BY id DESC ";
                          }

                          $result = mysqli_query($conn, $sql);

                          $totalCountSql = "SELECT COUNT(*) AS total FROM profiles";
                          $totalCountResult = mysqli_query($conn, $totalCountSql);
                          $totalCountRow = mysqli_fetch_assoc($totalCountResult);
                          $totalCount = $totalCountRow['total'];
                          $totalPages = ceil($totalCount / $recordsPerPage);
                          if ($result && mysqli_num_rows($result) > 0) {
                          $results = [];
                        ?>
             <!-- Modal structure -->
             <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                <div class="modal-header">
                 <h6 class="modal-title fw-bold" id="modal-title-default">User Details</h6>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                 <p id="modal-body-content">User details go here...</p>
                </div>
               </div>
              </div>
             </div>
            </form>

            <!-- swal -->
            <script>
              function showDeleteConfirmation(event, id) {
                event.preventDefault();
                swal({
                  title: "Are you sure?",
                  text: "Are you sure you want to delete the selected profiles?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.href = `/ypr/user/delete.php?id=${id}`;
                    } else {
                      swal("The profiles are safe.", {
                        icon: "info",
                      });
                    }
                  });
              }

              function showDeleteConfirmationMultiple(event) {
                event.preventDefault();
                var selectedProfiles = [];
                document.querySelectorAll('input[name="selectedProfiles[]"]:checked').forEach(function (checkbox) {
                  selectedProfiles.push(checkbox.value);
                });
                if (selectedProfiles.length === 0) {
                  swal("No profiles selected", "Please select profiles to delete.", "info");
                  return;
                }
                swal({
                  title: "Are you sure?",
                  text: "Are you sure you want to delete the selected profiles?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                  .then((willDelete) => {
                    if (willDelete) {
                      var form = document.getElementById('profilesForm');
                      var formData = new FormData(form);
                      fetch('delete_multiple.php', {
                        method: 'POST',
                        body: formData
                      }).then(response => response.text()).then(data => {
                        swal("The selected profiles have been deleted.", {
                          icon: "success",
                        }).then(() => {
                          location.reload();
                        });
                      }).catch(error => {
                        console.error('Error:', error);
                        swal("Error deleting profiles.", {
                          icon: "error",
                        });
                      });
                    } else {
                      swal("The profiles are safe.", {
                        icon: "info",
                      });
                    }
                  });
              }
            </script>

             <!-- PHP and table code from above -->
             <div class="section">
              <form id="profilesForm" method="POST" action="profiles.php"> <?php while ($row = mysqli_fetch_assoc($result)) { ?> <?php } }?> </form>
             </div>
             <script>
              document.addEventListener('DOMContentLoaded', function() {
               document.querySelectorAll('.profileNameLink').forEach(function(link) {
                link.addEventListener('click', function() {
                 var fullName = this.getAttribute('data-fullname');
                 var address = this.getAttribute('data-address');
                 var sex = this.getAttribute('data-sex');
                 var age = this.getAttribute('data-age');
                 var birthday = this.getAttribute('data-birthday');
                 var youthWithNeeds = this.getAttribute('data-youth_with_needs');
                 var email = this.getAttribute('data-email');
                 var contactNumber = this.getAttribute('data-contact_number');
                 var civilStatus = this.getAttribute('data-civil_status');
                 var ageGroup = this.getAttribute('data-age_group');
                 var educationalBackground = this.getAttribute('data-educational_background');
                 var youthClassification = this.getAttribute('data-youth_classification');
                 var workStatus = this.getAttribute('data-work_status');
                 var nationalVoter = this.getAttribute('data-national_voter');
                 var registeredSkVoter = this.getAttribute('data-register_sk_voter');
                 var votedLastElection = this.getAttribute('data-voted_last_election');
                 var timesAttended = this.getAttribute('data-times_attended');
                 var reason = this.getAttribute('data-reason');
                 var bday = new Date(/);
                 var today = new Date();
                 // Calculate the difference in years
                 var age = today.getFullYear() - bday.getFullYear();
                 // Adjust for partial years
                 var monthDiff = today.getMonth() - bday.getMonth();
                 if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < bday.getDate())) {
                  age--;
                 }
                 var ageGroup = '';
                 // Set age group based on age
                 if (age >= 15 && age <= 17) {
                  ageGroup = 'Child Youth';
                 } else if (age >= 18 && age <= 24) {
                  ageGroup = 'Core Youth';
                 } else if (age >= 25 && age <= 30) {
                  ageGroup = 'Young Adult';
                 }
                 var modalContent = `
                        <p>
                        <strong>Full Name:</strong> ${fullName}
                        </p>
                        <p>
                        <strong>Address:</strong> ${address}
                        </p>
                        <p>
                        <strong>Sex:</strong> ${sex}
                        </p>
                        <p>
                        <strong>Age:</strong> ${age}
                        </p>
                        <p>
                        <strong>Birthday:</strong> ${birthday}
                        </p>
                        <p>
                        <strong>Youth with Needs:</strong> ${youthWithNeeds}
                        </p>
                        <p>
                        <strong>Email:</strong> ${email}
                        </p>
                        <p>
                        <strong>Contact Number:</strong> ${contactNumber}
                        </p>
                        <p>
                        <strong>Civil Status:</strong> ${civilStatus}
                        </p>
                        <p>
                        <strong>Age Group:</strong> ${ageGroup}
                        </p>
                        <p>
                        <strong>Educational Background:</strong> ${educationalBackground}
                        </p>
                        <p>
                        <strong>Youth Classification:</strong> ${youthClassification}
                        </p>
                        <p>
                        <strong>Work Status:</strong> ${workStatus}
                        </p>
                        <p>
                        <strong>National Voter:</strong> ${nationalVoter}
                        </p>
                        <p>
                        <strong>Registered SK Voter:</strong> ${registeredSkVoter}
                        </p>
                        <p>
                        <strong>Voted Last Election:</strong> ${votedLastElection}
                        </p>
                        <p>
                        <strong>Times Attended:</strong> ${timesAttended}
                        </p>
                        <p>
                        <strong>If no, why?</strong> ${reason}
                        </p> `;                 																																																																	
                 document.getElementById('modal-body-content').innerHTML = modalContent;
                });
               });
              });
             </script>
            </tbody>
            </table>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
    <!-- Core JS Files -->
    <script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap/assets/js/core/popper.min.js"></script>
    <script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Chart JS -->
    <script src="../bootstrap/assets/js/plugin/chart.js/chart.min.js"></script>
    <!-- jQuery Sparkline -->
    <script src="../bootstrap/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <!-- Datatables -->
    <script src="../bootstrap/assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Bootstrap Notify -->
    <script src="../bootstrap/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <!-- Sweet Alert -->
    <script src="../bootstrap/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="../bootstrap/assets/js/kaiadmin.min.js"></script>
    <script>
     $(document).ready(function() {
      $("#basic-datatables").DataTable({});
      $("#multi-filter-select").DataTable({
       pageLength: 5,
       initComplete: function() {
        this.api().columns().every(function() {
         var column = this;
         var select = $(' < select class = "form-select" > < option value = "" > < /option> < /select>').appendTo($(column.footer()).empty()).on("change", function() {
          var val = $.fn.dataTable.util.escapeRegex($(this).val());
          column.search(val ? "^" + val + "$" : "", true, false).draw();
         });
         column.data().unique().sort().each(function(d, j) {
          select.append(' < option value = "' + d + '" > ' + d + "</option>");
         });
        });
       },
      });
     });
    </script>
 </body>
</html>