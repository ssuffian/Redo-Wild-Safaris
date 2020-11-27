<?php 

include 'config/db_connect.php';

$sql = "SELECT id,title,text FROM blogs";
$result = mysqli_query($con, $sql);

if($result) {
    $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = "Error " . mysqli_error($con);
}

?>