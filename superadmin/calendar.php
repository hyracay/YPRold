<?php
session_start();
include("../connection/conne.php");

if (!isset($_SESSION['SUPERADMIN'])) {
  header("location:../index.php");
  exit();
}
if (isset($_SESSION['role'])) {
  $role = $_SESSION['role'];
} else {
  echo "Role information not found. Please contact administrator.";
  exit();
}


$searchQuery = "";
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
$results = [];
while ($row = mysqli_fetch_assoc($result)) {
    $results[] = $row;
}

// Handle event creation
if (isset($_POST['new_event'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $event_insert = "INSERT INTO events (title, description, start_date, end_date) VALUES ('$title', '$description', '$start_date', '$end_date')";
    $insert_result = mysqli_query($conn, $event_insert);

    if (!$insert_result) {
        echo "Error creating event: " . mysqli_error($conn);
    } else {
        header("location: calendar.php");
        exit();
    }
}

// Handle event update
if (isset($_POST['update_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $event_update = "UPDATE events SET title = '$title', description = '$description', start_date = '$start_date', end_date = '$end_date' WHERE event_id = $event_id";
    $update_result = mysqli_query($conn, $event_update);

    if (!$update_result) {
        echo "Error updating event: " . mysqli_error($conn);
    } else {
        header("location: calendar.php");
        exit();
    }
}

// Handle event deletion
if (isset($_GET['event_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['event_id']);
    $sql_delete = "DELETE FROM events WHERE event_id = '$id'";

    if (mysqli_query($conn, $sql_delete)) {
        header("location: calendar.php");
        exit();
    } else {
        echo "Error deleting event: " . mysqli_error($conn);
    }
}

// for barangay code
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
    <title>YOUTH PROFILING SYSTEM</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../bootstrap/assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
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

        <!-- navbar -->
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">

              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
              <li class="nav-item">
            
              <li class="nav-item">
               

                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas icon-user"></i>
                  <p>User Accounts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="accounts.php">
                        <span class="sub-item">View Accounts</span>
                      </a>
                    </li>
                    <li>
                      <a href="createacc.php">
                        <span class="sub-item">Create Account</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a href="calendar.php">
                  <i class="fas icon-calendar"></i>
                  <p>Calendar</p>
                </a>
              </li>
              <li class="nav-item">

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
          <nav
            class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
          >
            <div class="container-fluid">
              <nav
                class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              </nav>
              <h2><?php echo $barangay_code; ?> La Trinidad Youth Profiling System</h2>
              <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                  <a
                    class="dropdown-toggle profile-pic"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar-sm">
                      <img
                        src="../bootstrap/assets/img/profile.jpg"
                        alt="..."
                        class="avatar-img rounded-circle"
                      />
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
                            <img
                              src="../bootstrap/assets/img/profile.jpg"
                              alt="image profile"
                              class="avatar-img rounded"
                            />
                          </div>
                          <div class="u-text">
                          <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h4>
                          <p class="text-muted"><?php echo $_SESSION['email']; ?></p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="account_setting.php">Account Setting</a>
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
    <div class="content" style="margin-top: 86px">
        <button id="addEventBtn" class="btn btn-black">Add Event</button>
        <div id='calendar'></div>
    </div>

    <div id="myModal" class="modal" >
        <div class="modalContent" >
            <span class="close">&times;</span>
            <div id="modalInside"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
    <script>
        const results = <?= json_encode($results); ?>;
        var resultsToShow = results.map(item => ({
            id: item.event_id,
            title: item.title,
            description: item.description,
            start: item.start_date,
            end: item.end_date
        }));

        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        var modalInside = document.getElementById('modalInside');

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        const addEventBtn = document.getElementById('addEventBtn');

        function createEvent(eventId = null) {
            modal.style.display = "block";
            modalInside.innerHTML = `
                <div class="eventFormContainer" style="margin-top: 50px">
                    <form id="eventForm" method="POST" action="calendar.php">
                        <h3>Create Event</h3><br>
                        <input type="text" id="title" name="title" placeholder="Event Title" required class="form-control"><br><br>
                        <textarea id="description" name="description" placeholder="Event Description" class="form-control"></textarea><br><br>
                        <input type="datetime-local" id="start_date" name="start_date" placeholder="Start Date" required class="form-control"><br><br>
                        <input type="datetime-local" id="end_date" name="end_date" placeholder="End Date" required class="form-control"><br><br>
                        <input type="submit" name="new_event" value="Create Event" class="btn btn-success">
                    </form>
                </div>
            `;
        }

        function editEvent(eventId) {
            const selectedEvent = results.find(item => item.event_id == eventId);
            modal.style.display = "block";
            modalInside.innerHTML = `
                <div class="eventFormContainer">
                    <form id="eventForm" method="POST" action="calendar.php">
                        <h3>Edit Event</h3><br>
                        <input type="hidden" id="event_id" name="event_id" value="${selectedEvent.event_id}">
                        <input type="text" id="title" name="title" placeholder="Event Title" value="${selectedEvent.title}" class="form-control"><br><br>
                        <textarea id="description" name="description" placeholder="Event Description" class="form-control">${selectedEvent.description}</textarea><br><br>
                        <input type="datetime-local" id="start_date" name="start_date" value="${selectedEvent.start_date}" class="form-control"><br><br>
                        <input type="datetime-local" id="end_date" name="end_date" value="${selectedEvent.end_date}" class="form-control"><br><br>
                        <input type="submit" name="update_event" value="Update Event" class="btn btn-black">
                        <input style="margin-top: 10px;" type="button" name="delete_event" value="Delete Event" onclick="deleteEvent(${selectedEvent.event_id})" class="btn btn-danger">
                    </form>
                </div>
            `;
        }

        function deleteEvent(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                window.location.href = `calendar.php?event_id=${eventId}`;
            }
        }

        addEventBtn.addEventListener('click', function () {
            createEvent();
        });

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            let today = new Date().toISOString().slice(0, 10);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: today,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: resultsToShow,
                eventClick: function (info) {
                    editEvent(info.event.id);
                }
            });

            calendar.render();

            document.querySelector('.fc-prev-button').classList.add('custom-prev-class');
            document.querySelector('.fc-next-button').classList.add('custom-next-class');
            document.querySelector('.fc-today-button').classList.add('custom-today-class');
            document.querySelector('.fc-dayGridMonth-button').classList.add('custom-dayGridMonth-class');
            document.querySelector('.fc-timeGridWeek-button').classList.add('custom-timeGridWeek-class');
            document.querySelector('.fc-timeGridDay-button').classList.add('custom-timeGridDay-class');
            document.querySelector('.fc-toolbar-title').classList.add('custom-title-class');
        });
    </script>
    <style>
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding: 20px;
}

/* Modal content */
.modalContent {
    background-color: #fffcdc;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* Close button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.modal-inside {
    min-height: 100px;
    background-color: #fffcdc;
}

.details{
    padding: 10px;
}

/* Modal styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
    backdrop-filter: blur(5px); /* Blur background */
}

.modalContent {
    background-color: #ffffff;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #ffffff;
    width: 60%;
    max-width: 600px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    animation: modalOpen 0.3s;
}

@keyframes modalOpen {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modalContent form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.modalContent form label {
    margin-bottom: 10px;
    font-size: 16px;
    font-weight: bold;
}

.modalContent form input[type="file"] {
    margin-bottom: 20px;
    padding: 5px;
}

.modalContent form button {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    font-size: 16px;
}

.modalContent form button:hover {
    background-color: #0056b3;
}

h1 {
    font-size: 55px;
    text-transform: uppercase;
    font-family: Helvetica;
    font-weight: 700;
  }

.card-body {
    padding: 1rem 1rem 0rem 1rem;
}

a {
    color: #699aba;
}
    </style>

    <!--   Core JS Files   -->
    <script src="../bootstrap/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap/assets/js/core/popper.min.js"></script>
    <script src="../bootstrap/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../bootstrap/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../bootstrap/assets/js/kaiadmin.min.js"></script>
</body>
</html>