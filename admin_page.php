<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include 'db.php';
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        /* Original styling from the admin page */
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 20px; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; font-size: 2em; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); }
        th, td { padding: 12px; text-align: left; font-size: 1em; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        tr:hover { background-color: #d1ecf1; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .action-buttons { display: inline-block; margin-right: 5px; }
        .separator { display: inline-block; border-left: 1px solid #ccc; height: 20px; margin: 0 10px; }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <table border="1">
        <tr>
            <th>Lab</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Purpose</th>
            <th>Booking Type</th>
            <th>Individual/Department Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        $sql = "SELECT * FROM bookings ORDER BY date, start_time";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['lab']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['start_time']}</td>
                    <td>{$row['end_time']}</td>
                    <td>{$row['purpose']}</td>
                    <td>{$row['booking_type']}</td>
                    <td>{$row['booking_name']}</td>
                    <td>{$row['status']}</td>
                    <td>";
            if ($row['status'] == 'pending') {
                echo "<a href='approve.php?id={$row['id']}'>Approve</a> | ";
                echo "<a href='reject.php?id={$row['id']}'>Reject</a>";
            }
            echo " | <a href='edit_booking.php?id={$row['id']}'>Edit</a>";
            echo "</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>

<?php
ob_end_flush();
?>
