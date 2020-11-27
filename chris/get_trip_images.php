<?php 

include 'config/db_connect.php';

$sql = "SELECT tripId,image_name FROM trip_images";

$result = mysqli_query($con, $sql);

if($result) {
    $tripImages = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = "Error " . mysqli_error($con);
}

?>
