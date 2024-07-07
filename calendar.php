<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location:index.php");
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CALENDAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/calendar.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
        Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="viewprofile.php">Profiles</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">SK Reports</a>
        <a href="homepage.php">Back</a>
        <?php
         if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
         }
        ?>
        <?php
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
        <button id="addEventBtn" class="btn btn-primary">Add Event</button>
        <div id='calendar'></div>
    </div>

    <div id="myModal" class="modal">
        <div class="modalContent">
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
                <div class="eventFormContainer">
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
                        <input type="submit" name="update_event" value="Update Event" class="btn btn-primary">
                        <input type="button" name="delete_event" value="Delete Event" onclick="deleteEvent(${selectedEvent.event_id})" class="btn btn-danger">
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
        });
    </script>
</body>
</html>
