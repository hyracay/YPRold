<?php
session_start();
include ("conne.php");

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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CALENDAR</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/calendar.css">
</head>

<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
            Logged in as: <?php echo $_SESSION['email']; ?></p>

        <a href="viewprofile.php">Profiles</a>
        <a href="records.php">Records</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        }
        ?>
        <a href="crud.php">Create Profile</a>
        <?php
        if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
        }
        ?>

        <a href="homepage.php">Back</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Event Calendar</h1>
        <button id="addEventBtn">Add Event</button>
        <div id='calendar'></div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
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

        function openEvent(eventId = null) {
            modal.style.display = "block";
            if (eventId === null) {
                modalInside.innerHTML = `
                <div class="eventFormContainer">
                    <form id="eventForm" method="POST" action="calendar.php">
                        <h3>Create Event</h3><br>
                        <input type="text" id="title" name="title" placeholder="Event Title"><br><br>
                        <textarea id="description" name="description" placeholder="Event Description"></textarea><br><br>
                        <input type="datetime-local" id="start_date" name="start_date" placeholder="Start Date"><br><br>
                        <input type="datetime-local" id="end_date" name="end_date" placeholder="End Date"><br><br>
                        <input type="submit" name="new_event" value="Create Event">
                    </form>
                </div>
            `;
            } else {
                const selectedEvent = results.find(item => item.id == eventId);
                modalInside.innerHTML = `
                <div class="eventFormContainer">
                    <form id="eventForm" method="POST" action="calendar.php">
                        <h3>Edit Event</h3><br>
                        <input type="hidden" id="event_id" name="event_id" value="${selectedEvent.id}">
                        <input type="text" id="title" name="title" placeholder="Event Title" value="${selectedEvent.title}"><br><br>
                        <textarea id="description" name="description" placeholder="Event Description">${selectedEvent.description}</textarea><br><br>
                        <input type="datetime-local" id="start_date" name="start_date" value="${selectedEvent.start}"><br><br>
                        <input type="datetime-local" id="end_date" name="end_date" value="${selectedEvent.end}"><br><br>
                        <input type="submit" name="update_event" value="Update Event">
                        <button type="button" onclick="deleteEvent(${selectedEvent.id})">Delete Event</button>
                    </form>
                </div>
            `;
            }
        }

        function deleteEvent(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                window.location.href = `delete_event.php?event_id=${eventId}`;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2024-06-07',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: resultsToShow,
                eventClick: function (info) {
                    openEvent(info.event.id);
                }
            });

            calendar.render();
        });

        addEventBtn.addEventListener('click', function () {
            openEvent();
        });

        // Optional: Submit form via AJAX to avoid page reload
        document.getElementById('eventForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    modal.style.display = "none";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    </script>
</body>

</html>

<?php
    // Handle event creation
    if (isset($_POST['new_event'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

        $event_insert = "INSERT INTO events(title, description, start_date, end_date) VALUES('$title', '$description', '$start_date', '$end_date')";
        $insert_result = mysqli_query($conn, $event_insert);

        if (!$insert_result) {
            echo "Error creating event: " . mysqli_error($conn);
        }
    }

    // Handle event update
    if (isset($_POST['update_event'])) {
        $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

        $event_update = "UPDATE events SET 
                        title = '$title',
                        description = '$description',
                        start_date = '$start_date',
                        end_date = '$end_date'
                        WHERE event_id = $event_id";
        $update_result = mysqli_query($conn, $event_update);

        if (!$update_result) {
            echo "Error updating event: " . mysqli_error($conn);
        }
    }
?>