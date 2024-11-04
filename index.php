<?php
include 'db.php';

// Start output buffering
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CC Lab Booking - Cotton University</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Optional if using external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('path/to/your/background-image.jpg'); /* Add your background image here */
            background-size: cover; /* Cover the entire background */
            background-repeat: no-repeat; /* Prevent image repetition */
            background-position: center; /* Center the background image */
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #007bff;
            font-size: 2.5em;
            margin: 20px 0;
            text-align: center;
        }
        h2 {
            color: #555;
            margin-top: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency for form background */
            padding: 20px;
            border: 2px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            text-align: left;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        select, input[type="date"], input[type="time"], input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 2px solid #007bff;
            font-size: 1em;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-bookings {
            text-align: center;
            margin-top: 20px;
            font-size: 1.1em;
            color: #888;
        }
    </style>
    <script>
        function toggleBookingNameLabel() {
            const bookingType = document.getElementById('booking_type').value;
            const bookingNameLabel = document.getElementById('booking_name_label');
            if (bookingType === 'Individual') {
                bookingNameLabel.innerText = 'Individual Name:';
            } else {
                bookingNameLabel.innerText = 'Department Name:';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Book CC Lab - Cotton University</h1>
        
        <!-- Form for New Booking -->
        <form action="process_booking.php" method="POST">
            <label for="lab">Choose Lab:</label>
            <select name="lab" required>
                <option value="Linux Lab">Linux Lab</option>
                <option value="Windows Lab">Windows Lab</option>
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" required>

            <label for="purpose">Purpose of Booking:</label>
            <input type="text" name="purpose" required>

            <label for="booking_type">Booking Type:</label>
            <select name="booking_type" id="booking_type" required onchange="toggleBookingNameLabel()">
                <option value="Individual">Individual</option>
                <option value="Department">Department</option>
            </select>

            <label for="booking_name" id="booking_name_label">Individual Name:</label>
            <input type="text" name="booking_name" id="booking_name" placeholder="Enter Individual or Department Name" required>

            <button type="submit" name="book">Submit Booking</button>
        </form>

        <h2>Existing Bookings</h2>

        <!-- Display Existing Bookings -->
        <?php
        // Query to fetch existing bookings
        $sql = "SELECT * FROM bookings WHERE status = 'accepted' ORDER BY date, start_time";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Lab</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Purpose</th>
                        <th>Booking Type</th>
                        <th>Individual/Department Name</th>
                    </tr>";
            // Output each booking
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['lab']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['start_time']}</td>
                        <td>{$row['end_time']}</td>
                        <td>{$row['purpose']}</td>
                        <td>{$row['booking_type']}</td>
                        <td>{$row['booking_name']}</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-bookings'>No bookings available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
