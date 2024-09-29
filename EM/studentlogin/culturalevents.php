<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Culturals</title>
    <style>
        body{
            background-color: #A69CAC;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        input{
            margin-top: 7px;
        }
    </style>
</head>
<body>
    <h1>Register for Culturals Events</h1>
    <?php
    if (isset($_GET['registered'])) {
        echo '<p>You have successfully registered for the event: Event ID ' . htmlspecialchars($_GET['eventid']) . '</p>';
    }

    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM culturals";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table border="1">';
        echo '<tr><th>Event ID</th><th>Event Name</th><th>Date and Time</th><th>Venue</th><th>Description</th><th>Participants</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            // Fetch total number of registrations for this event
            $eventid = $row['eventid'];
            $ticketCount = $row['ticketCount'];

            // Get the current number of registrations for this event
            $reg_sql = "SELECT COUNT(*) as total FROM culturalregistrations WHERE eventid = $eventid";
            $reg_result = $conn->query($reg_sql);
            $registeredCount = $reg_result->fetch_assoc()['total'];

            // Show event row only if there are tickets available
            if ($registeredCount < $ticketCount) {
                echo '<tr>';
                echo '<td>' . $row['eventid'] . '</td>';
                echo '<td>' . $row['eventName'] . '</td>';
                echo '<td>' . $row['eventDateTime'] . '</td>';
                echo '<td>' . $row['eventVenue'] . '</td>';
                echo '<td>' . $row['eventDescription'] . '</td>';
                echo '<td>' . $row['eventParticipants'] . '</td>';
                echo '<td>';
                echo '<form method="post" action="registercultural.php">';
                echo '<input type="hidden" name="eventid" value="' . $row['eventid'] . '">';
                echo 'Rollno: <input type="text" name="rollno" required><br>';
                echo 'Name: <input type="text" name="name" required><br>';
                echo 'Dept: <input type="text" name="dept" required><br>';
                echo 'Section: <input type="text" name="section" required><br>';
                echo 'Year of Study: <input type="text" name="yearofstudy" required><br>';
                echo 'Phone Number: <input type="text" name="phonenumber" required><br>';
                echo 'Email: <input type="text" name="email" required><br>';
                echo '<input type="submit" name="register" value="Register">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            } else {
                echo '<tr><td colspan="7">No more tickets available for Event ID ' . $eventid . '</td></tr>';
            }
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo 'No records found.';
    }

    $conn->close();
    ?>
</body>
</html>
