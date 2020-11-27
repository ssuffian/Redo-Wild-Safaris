<?php

include "config/db_connect.php";
$error = '';

if(isset($_GET['id'])) {
    $tripDetails = htmlspecialchars($_GET['id']);
}

if(isset($_POST['upload'])) {

$file = $_FILES['file'];
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];

$fileExt = explode('.', $fileName);
$fileActualExt = strtolower((end($fileExt)));

$allowed = array('jpg', 'jpeg', 'png');

if(!in_array($fileActualExt, $allowed)) {
    $error = "This file type is not allowed";
}

if(!$fileError === 0) {
    $error = "There was an error uploading your file";
}

if($fileSize > 5000000) {
    $error = "Your file is too big";
}

if(empty($error)){
    $newFileName = uniqid().".".$fileActualExt;
    $fileDestination = "images/$newFileName";
    $tripId = mysqli_real_escape_string($con, $_POST['trip_id']);
    $sql = "INSERT INTO blog_images(blogId, image_name) VALUES('blogId','$newFileName')";
    move_uploaded_file($fileTmpName, $fileDestination);
} else {
    echo $error;
}

if(mysqli_query($con, $sql)) {
    header("Location: blog_details.php?id=$blogId"); 
} else {
    $error = "Error writing file to database" .mysqli_error(($con));
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
            <div id="input">
                <input type="file" name="file">
                <input type="submit" name="upload" value="Upload Image">
                <input type="hidden" name="blog_id" value="<?php echo $blogDetails ?>">
            </div>
    </form>
</body>
</html>