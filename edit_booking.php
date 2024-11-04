<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch current booking details
    $sql = "SELECT * FROM bookings WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Booking not found!";
        exit();
    }
} else {
    echo "No booking selected!";
    exit();
}

if (isset($_POST['update'])) {
    $lab = $_POST['lab'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    $booking_type = $_POST['booking_type'];
    $status = $_POST['status'];

    // Update booking details
    $sql = "UPDATE bookings SET lab='$lab', date='$date', start_time='$start_time', end_time='$end_time', 
            purpose='$purpose', booking_type='$booking_type', status='$status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Booking updated successfully!";
        header("Location: admin_page.php");
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .edit-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #007bff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #007bff;
            text-align: center;
            font-size: 1.8em;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="date"], input[type="time"], select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="edit-container">
        <h1>Edit Booking</h1>

        <!-- Edit Booking Form -->
        <form action="" method="POST">
            <label for="lab">Choose Lab:</label>
            <select name="lab" required>
                <option value="Linux Lab" <?php if ($row['lab'] == 'Linux Lab') echo 'selected'; ?>>Linux Lab</option>
                <option value="Windows Lab" <?php if ($row['lab'] == 'Windows Lab') echo 'selected'; ?>>Windows Lab</option>
            </select>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo $row['date']; ?>" required>

            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" value="<?php echo $row['start_time']; ?>" required>

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" value="<?php echo $row['end_time']; ?>" required>

            <label for="purpose">Purpose of Booking:</label>
            <input type="text" name="purpose" value="<?php echo $row['purpose']; ?>" required>

            <label for="booking_type">Booking Type:</label>
            <select name="booking_type" required>
                <option value="Individual" <?php if ($row['booking_type'] == 'Individual') echo 'selected'; ?>>Individual</option>
                <option value="Department" <?php if ($row['booking_type'] == 'Department') echo 'selected'; ?>>Department</option>
            </select>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                <option value="accepted" <?php if ($row['status'] == 'accepted') echo 'selected'; ?>>Accepted</option>
                <option value="rejected" <?php if ($row['status'] == 'rejected') echo 'selected'; ?>>Rejected</option>
            </select>

            <button type="submit" name="update">Update Booking</button>
        </form>
    </div>
</body>
</html>
