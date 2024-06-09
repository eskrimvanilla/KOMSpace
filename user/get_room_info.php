<?php
include('../database/connect.php');

if (isset($_GET['id'])) {
    $room_id = $_GET['id'];
    $sql = "SELECT * FROM ruangan WHERE id = $room_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $room = mysqli_fetch_assoc($result);
        echo json_encode($room);
    } else {
        echo json_encode(['error' => 'Room not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
