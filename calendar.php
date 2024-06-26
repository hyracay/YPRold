<?php
session_start();
include ("conne.php");
include ("calendar2.php");
$calendar = new Calendar('2024-05-12');

if (!isset($_SESSION['email'])) {
    header("location:index.php");
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


// Fetch all rows from the events table
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
        <a href="#calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Event Calendar</h1>
        <button id="addEventBtn">Add event</button>
        <div id='calendar'></div>
        <?php // echo $calendar ?>
    </div>

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modalInside"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
    <script>
        const results = <?= json_encode($results); ?>;
        var resultsToShow = results.map(item => ({ id: item.event_id, title: item.title, start: item.start_date, end: item.end_date }));

        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        var modalInside = document.getElementById('modalInside');

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

        const addEventBtn = document.getElementById('addEventBtn');
        function openEvent(eventId = null) {
            const selectedEvent = results.find(item => item.id == eventId);
            console.log(selectedEvent);
            modal.style.display = "block";
            modalInside.innerHTML = `
                <div class="eventFormContainer">
                    <h3>Event</h3>
                    <input type="text" id="title" name="title" placeholder="Event Title" value="${selectedEvent?.title ?? ''}" />
                    <textarea id="description" name="description" placeholder="Event Description">${selectedEvent?.description ?? ''}</textarea>
                    <input type="datetime-local" id="start_date" name="start_date" placeholder="Start Date" value="${selectedEvent?.start_date}" />
                    <input type="datetime-local" id="end_date" name="end_date" placeholder="End Date" value="${selectedEvent?.end_date}" />
                </div>
            `;
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

    </script>
</body>

</html>