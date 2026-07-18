<?php
require_once "../config/database.php";

if (isset($_GET['id'])) {
    $conn = Database::connect();
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "DELETE FROM room_types WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: rooms-types.php");
        exit;
    } else {
        echo "Error deleting room type: " . mysqli_error($conn);
    }
} else {
    header("Location: rooms-types.php");
    exit;
}
?>