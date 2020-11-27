<?php 


include 'config/db_connect.php';

$errors = array('routeName' => '', 'reouteDescription' => '');

if(isset($_GET['id'])) {
    $tripDetails = htmlspecialchars($_GET['id']);
}

if(isset($_POST['submit'])) {
    
    //validate route name 
    if(empty($_POST['route_name'])) {
        $errors['routeName'] = 'Route name cannot be empty';
    } 

    //validate route description 
    if(empty($_POST['route_description'])) {
        $errors['routeDescription'] = 'Route description cannot be empty';
    } 


    //check errors before saving to database
    if(array_filter($errors)) {
        print_r($errors);
    } else {
        $routeId = mt_rand();
        $routeName = mysqli_real_escape_string($con, $_POST['route_name']);
        $routeDescription = mysqli_real_escape_string($con, $_POST['route_description']);
        $tripId = mysqli_real_escape_string($con, $_POST['id_to_save']);
        $sql = "INSERT INTO routes(routeId,routeName,routeDescription,tripId) VALUES('$routeId','$routeName','$routeDescription','$tripId')";
    }

    //redirect user
    if(mysqli_query($con, $sql)) {
        header("Location: trip_details.php?id=$tripId");
    } else {
        echo "Error" . mysqli_error($con);
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <label for="route_name">Route Name</label>
    <input type="text" name="route_name">
    <label for="route_description">Route Description</label>
    <input type="text" name="route_description">
    <input type="submit" name="submit" value="Add Route">
    <input type="hidden" name="id_to_save" value="<?php echo $tripDetails ?>">
    </form>
</body>
</html>