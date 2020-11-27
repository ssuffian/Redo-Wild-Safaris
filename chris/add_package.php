<?php

include 'config/db_connect.php';

$errors = array('package' => '', 'price' => '');

if(isset($_GET['id'])) {
    $tripDetails = htmlspecialchars($_GET['id']);
}


if (isset($_POST['submit'])) {

    for($i = 0; $i < count($_POST['package']); $i++) {
        
        //validate package name
        if(empty($_POST['package'][$i])) {
            $errors['package'] = 'Package name cannot be empty';
        } else {
            $package = $_POST['package'][$i];
            if(!preg_match('/^[a-zA-Z\s]+$/', $package)) {
                $errors['package'] = 'Package name must contain letters and spaces only';
            }
        }
        
        //validate package price 
        if(empty($_POST['price'][$i])) {
            $errors['price'] = 'Price cannot be empty';
        } else {
            $price = $_POST['price'][$i];
            if(!is_numeric($price)){
                $errors['price'] = 'Price should be numbers only';
            }
        }

        //check if there are any errors before proceeding
        if(array_filter($errors)) {
            print_r($errors);
        } else {
            $package = mysqli_real_escape_string($con, $_POST['package'][$i]);
            $price = mysqli_real_escape_string($con, $_POST['price'][$i]);
            $tripId = mysqli_real_escape_string($con, $_POST['id_to_save']);
            $sql = "INSERT INTO packages(tripId,packageName,packagePrice) VALUES('$tripId','$package','$price')";
        }

        //check and redirect 
        if(mysqli_query($con, $sql)) {
            header('location: admin_home.php');
        } else {
            echo 'error' . mysqli_error($con);
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
    <script src="dynamic_input.js" language="Javascript" type="text/javascript"></script>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div id="input">
                <label for="package">Package</label>
                <input type="text" name="package[]">
                <label for="price">Price</label>
                <input type="text" name="price[]">
                <input type="button" value="add" onClick="addInput('input');">
                <input type="submit" name="submit" value="Add Package">
                <input type="hidden" name="id_to_save" value="<?php echo $tripDetails ?>">
            </div>
    </form>
</body>
</html>