<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE bookings SET status='accepted' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Booking approved successfully!";
    } else {
        echo "Error updating booking: " . $conn->error;
    }
} else {
    echo "No booking ID specified!";
}

$conn->close();
header("Location: admin_page.php");
exit();
?>
