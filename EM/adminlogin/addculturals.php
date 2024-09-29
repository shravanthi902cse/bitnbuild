<?php

$eventid = $_POST['eventid'];
$eventName = $_POST['eventName'];
$eventDateTime = $_POST['eventDateTime'];
$eventVenue = $_POST['eventVenue'];
$eventDescription = $_POST['eventDescription'];
$eventParticipants = $_POST['eventParticipants'];
$ticketCount = $_POST['ticketCount']; // Get the ticket count from the form

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'test');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    // Insert the event details into the culturals table
    $stmt = $conn->prepare("INSERT INTO culturals(eventid, eventName, eventDateTime, eventVenue, eventDescription, eventParticipants, ticketCount) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssi", $eventid, $eventName, $eventDateTime, $eventVenue, $eventDescription, $eventParticipants, $ticketCount);
    $stmt->execute();

    // Open tickets based on the ticket count (Insert records into culturalstickets table)
    for ($i = 1; $i <= $ticketCount; $i++) {
        $ticketID = $eventid . '-T' . $i; // Create a unique ticket ID using event ID and the count
        $stmtTickets = $conn->prepare("INSERT INTO culturalstickets(ticketID, eventid, ticketStatus) VALUES(?, ?, 'available')");
        $stmtTickets->bind_param("si", $ticketID, $eventid);
        $stmtTickets->execute();
    }

    echo '<script>alert("Event and tickets added successfully!");</script>';

    // Close the statements and connection
    $stmt->close();
    $conn->close();
}
?>
