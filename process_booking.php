<?php
include 'db.php';

if (isset($_POST['book'])) {
    $lab = $_POST['lab'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $purpose = $_POST['purpose'];
    $booking_type = $_POST['booking_type']; // New field for booking type
    $booking_name = $_POST['booking_name']; // New field for individual/department name

    // Check for existing bookings with the same date and time, excluding rejected bookings
    $sql = "SELECT * FROM bookings WHERE lab = '$lab' AND date = '$date' 
            AND (start_time < '$end_time' AND end_time > '$start_time') 
            AND status != 'rejected'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "This time slot is already booked!";
    } else {
        // Insert the booking with the additional "booking_name" field
        $sql = "INSERT INTO bookings (lab, date, start_time, end_time, purpose, booking_type, booking_name, status) 
                VALUES ('$lab', '$date', '$start_time', '$end_time', '$purpose', '$booking_type', '$booking_name', 'pending')";
        if ($conn->query($sql) === TRUE) {
            echo "Booking submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
