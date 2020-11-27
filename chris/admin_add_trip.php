<?php

include 'config/db_connect.php';
$errors = array('trip-name' => '', 'description' => '');

if (isset($_POST['submit'])) {

 //validate trip-name
 if (empty($_POST['trip-name'])) {
  $errors['trip-name'] = 'Trip name cannot be empty';
 } else {
  $tripName = $_POST['trip-name'];
  if (!preg_match('/^[a-zA-Z\s]+$/', $tripName)) {
   $errors['trip-name'] = 'Trip name must contain letters and spaces only';
  }
 }

 //redirect user if there are no errors

 if (array_filter($errors)) {
  print_r($errors); //echo errors in form
 } else {
  $tripId = mt_rand(); 
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $tripName    = mysqli_real_escape_string($con, $_POST['trip-name']);
    $tripType = mysqli_real_escape_string($con, $_POST['trip-type']);
    $tripDetails = mysqli_real_escape_string($con, $_POST['details']);
    $tripRegion = mysqli_real_escape_string($con, $_POST['region']);

  //create record in database
  $sql = "INSERT INTO trips(id,tripname,description,tripType,details,region) VALUES('$tripId','$tripName','$description','$tripType','$tripDetails','$tripRegion')";

  //check and redirect
  if (mysqli_query($con, $sql)) {
   header('Location: admin_home.php');
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
    <title>Add Trip</title>
</head>
<body>
    <div>
        <ul>
            <li>HELLO ADMIN</li>
        </ul>
    </div>

    <ul>
        <li>TRIPS</li>
        <li>USERS</li>
        <li>REVIEWS</li>
    </ul>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="trip-name">TRIP NAME</label>
        <input type="text" name="trip-name"> <br> <br>
        <label for="description">DESCRIPTION</label>
        <input type="text" name="description"> <br> <br>
        <label for="trip-type">TRIP TYPE</label>
        <input type="text" name="trip-type"> <br> <br>
        <label for="details">DETAILS</label>
        <input type="text" name="details"> <br> <br>
        <label for="region">REGION</label>
        <input type="text" name="region"> <br> <br>
        <input type="submit" name="submit" value ="SUBMIT">
    </form>
</body>
</html>
