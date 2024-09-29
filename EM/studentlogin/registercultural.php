<?php
// Retrieve form values
$eventid = $_POST['eventid'];
$rollno = $_POST['rollno'];
$name = $_POST['name'];
$dept = $_POST['dept'];
$section = $_POST['section'];
$yearofstudy = $_POST['yearofstudy'];
$phonenumber = $_POST['phonenumber'];
$email = $_POST['email'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the student has already registered with this email for this event
$emailCheckSql = "SELECT * FROM culturalregistrations WHERE eventid = ? AND email = ?";
$stmt = $conn->prepare($emailCheckSql);
$stmt->bind_param("is", $eventid, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the student is already registered for this event
    echo "<script>alert('You have already registered for this event with this email.');window.location.href='registercultural.php';</script>";
} else {
    // Get the current number of registrations for this event
    $ticketCountCheckSql = "SELECT COUNT(*) as total FROM culturalregistrations WHERE eventid = ?";
    $stmt = $conn->prepare($ticketCountCheckSql);
    $stmt->bind_param("i", $eventid);
    $stmt->execute();
    $ticketCountResult = $stmt->get_result();
    $currentRegistrations = $ticketCountResult->fetch_assoc()['total'];

    // Get the total available ticket count for this event from the 'culturals' table
    $totalTicketCountSql = "SELECT ticketCount FROM culturals WHERE eventid = ?";
    $stmt = $conn->prepare($totalTicketCountSql);
    $stmt->bind_param("i", $eventid);
    $stmt->execute();
    $totalTicketCountResult = $stmt->get_result();
    $totalTicketCount = $totalTicketCountResult->fetch_assoc()['ticketCount'];

    if ($currentRegistrations < $totalTicketCount) {
        // If there are available tickets, insert registration
        $registerSql = "INSERT INTO culturalregistrations (eventid, rollno, name, dept, section, yearofstudy, phonenumber, email) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($registerSql);
        $stmt->bind_param("isssssss", $eventid, $rollno, $name, $dept, $section, $yearofstudy, $phonenumber, $email);
        $stmt->execute();

        echo "<script>alert('Successfully registered for the event!');window.location.href='registercultural.php?registered=true&eventid=$eventid';</script>";
    } else {
        // If no tickets are available
        echo "<script>alert('No tickets available for this event.');window.location.href='registercultural.php';</script>";
    }
}

$conn->close();
?>
