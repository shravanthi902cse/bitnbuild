<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Cultural Event</title>
<style>
    /* General styling for responsiveness and advanced design */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-image: url('adminimage/cultural.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        max-width: 600px;
        width: 100%;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1s ease-in-out;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        font-size: 1.1em;
        margin-bottom: 8px;
        display: inline-block;
        color: #333;
    }

    input[type="text"],
    input[type="datetime-local"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
        background-color: #f2f2f2;
        margin-top: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        font-size: 1.2em;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Adding responsiveness */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
        input[type="submit"] {
            font-size: 1em;
            padding: 10px;
        }
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Styling for form elements */
    .form-group input,
    .form-group textarea {
        outline: none;
        transition: border 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #4CAF50;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Add Cultural Event</h2>
    <form action="addculturals.php" method="POST">
        <div class="form-group">
            <label for="eventid">Event ID:</label>
            <input type="text" id="eventid" name="eventid" required>
        </div>
        <div class="form-group">
            <label for="eventName">Event Name:</label>
            <input type="text" id="eventName" name="eventName" required>
        </div>
        <div class="form-group">
            <label for="eventDateTime">Date and Time:</label>
            <input type="datetime-local" id="eventDateTime" name="eventDateTime" required>
        </div>
        <div class="form-group">
            <label for="eventVenue">Venue:</label>
            <input type="text" id="eventVenue" name="eventVenue" required>
        </div>
        <div class="form-group">
            <label for="eventDescription">Description:</label>
            <textarea id="eventDescription" name="eventDescription" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="eventParticipants">Participants:</label>
            <input type="text" id="eventParticipants" name="eventParticipants" required>
        </div>
        <div class="form-group">
            <label for="ticketCount">Number of Tickets to Open:</label>
            <input type="number" id="ticketCount" name="ticketCount" min="1" required>
        </div>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
