<?php 

include 'config/db_connect.php';
$errors = '';

if(isset($_POST['submit'])) {
    if(empty($_POST['blog-title'] || $_POST['blog-text'])) {
        $errors = 'fields cannot be empty';
        echo $errors;
    } else {
        $blogId = mt_rand();
        $blogTitle = mysqli_real_escape_string($con, $_POST['blog-title']);
        $blogText = mysqli_real_escape_string($con, $_POST['blog-text']); 

        $sql = "INSERT INTO blogs(id,title,text) VALUES ('$blogId','$blogTitle','$blogText')";

        if(mysqli_query($con, $sql)) {
            header('Location: all_blogs.php');
        } else {
            echo 'query error' . mysqli_error($con); 
        }

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
    <h1>Write Site Blog</h1>
    <div class="form-container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="blog-title">BLOG TITLE</label>
            <input type="text" name="blog-title">
            <label for="blog-text">TEXT</label>
            <input type="text" name="blog-text">
            <input type="submit" name="submit" value="SUBMIT">
        </form>
    </div>
</body>
</html>