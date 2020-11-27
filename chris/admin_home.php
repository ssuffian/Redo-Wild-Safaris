<?php

include 'config/db_connect.php';



//Delete selected trip 
if(isset($_POST['delete'])) {
    $deleteTrip = mysqli_real_escape_string($con, $_POST['trip_id_to_delete']);
    $sqlDelete = "DELETE from trips WHERE trips.id = $deleteTrip"; 

    if(mysqli_query($con, $sqlDelete)) {
        header('Location: admin_home.php');
    } else {
        $error = mysqli_error($con);
    }

}

include 'get_all_trips.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <a href="admin_add_trip.php">Add Trip</a>
    <?php foreach ($trips as $trip): ?>
        <h3> <?php echo $trip['tripname']; ?></h3>
        <h4> <?php echo $trip['description']; ?></h4>
        <a href="trip_details.php?id=<?php echo $trip['id']; ?>">Details</a>

        <!-- Delete trip -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ; ?>" method="POST">
        <input type="hidden" name="trip_id_to_delete" value="<?php echo $trip['id']; ?>">
        <input type="submit" name="delete" value="Delete Trip">

        </form>
    <?php endforeach;?>
</body>
</html>
