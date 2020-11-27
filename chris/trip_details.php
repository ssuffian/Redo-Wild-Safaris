<?php
include 'config/db_connect.php';
include 'get_route_packages.php';


if(isset($_POST['delete_route'])) {
    $route_id_to_delete = mysqli_real_escape_string($con, $_POST['route_id_to_delete']);
    $tripId = mysqli_real_escape_string($con, $_POST['trip_id']);
    $sql_delete_route = "DELETE FROM routes WHERE routes.routeId = $route_id_to_delete";

    if(mysqli_query($con, $sql_delete_route)) {
        header("Location: trip_details.php?id=$tripId");
    } else {
        echo 'Error deleting route' . mysqli_error($con);
    }

}

if (isset($_GET['id'])) {
 $id  = htmlspecialchars($_GET['id']);
}
 
$sql_trip = "SELECT tripname, description FROM trips WHERE id = $id"; 
 $sql_routes = "SELECT routeName,routeDescription,routeId FROM routes WHERE tripId=$id";

 //get results
 $result_trip = mysqli_query($con, $sql_trip);
 $result_routes = mysqli_query($con, $sql_routes);

 //check for errors
 if (!$result_trip || !$result_routes) {
  echo 'Reading database error' . mysqli_error($con);
 }

 //fetch result as array
 $trip = mysqli_fetch_assoc($result_trip);
 $routes = mysqli_fetch_all($result_routes, MYSQLI_ASSOC);

 print_r($routes);
 print_r($allPackages);




mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h5><?php echo $trip['tripname']; ?> </h5>
<h6><?php echo $trip['description']; ?></h6>
<a href="add_package.php?id=<?php echo $id; ?>">Add Package</a>
<a href="add_route.php?id=<?php echo $id; ?>">Add Route</a>
<a href="add_trip_images.php?id=<?php echo $id; ?>">Add Images</a>
    <?php foreach($routes as $route) : ?>
        <div>
            <h3><?php echo $route['routeName'] ?></h3>
            <p><?php echo $route['routeDescription'] ?></p>
        </div>
        <div>
            <a href="<?php echo 'add_route_package.php?routeId=' . $route['routeId'] . '&&tripId=' . $id; ?>">Add Route Packages</a>
            <a href="<?php echo 'add_route_images.php?routeId=' . $route['routeId'] . '&&tripId=' . $id; ?>">Add Route Images</a>
        </div>

        <!-- Display route packages  -->

        <?php 
        
        $routeId = $route['routeId']; 
        $packages = array_filter($allPackages, function ($array) {
            global $routeId; 
            return $array['routeId'] == $routeId;
        }); 
        print_r($packages)
        ?>

        
        <!-- Delete Route -->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="hidden" name="route_id_to_delete" value="<?php echo $route['routeId']; ?>">
            <input type="hidden" name="trip_id" value="<?php echo $id; ?>">
            <input type="submit" name="delete_route" value="Delete Route">
        </form>
    <?php endforeach; ?>

    <a href="admin_home.php">View Trips</a>
</body>
</html>
