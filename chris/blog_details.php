<?php 

include 'config/db_connect.php';

if(isset($_GET['id'])) {
    $id =htmlspecialchars($_GET['id']);
}

$sql = "SELECT title,text FROM blogs WHERE id = $id";

$result = mysqli_query($con, $sql);

if($result) {
    $blog = mysqli_fetch_assoc($result);
} else {
    $error = mysqli_error($conn);
}

print_r($blog);

?>