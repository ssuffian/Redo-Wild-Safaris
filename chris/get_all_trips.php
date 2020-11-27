<?php

include "config/db_connect.php";

//query to get all trips
$sql = "SELECT id, tripname, description, id FROM trips ORDER BY created_at";

//send query and get results
$result = mysqli_query($con, $sql);

//Return result as array
if ($result) {
 $trips = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
 echo 'Error reading database' . mysqli_error($con);
}

//free result from memory
mysqli_free_result($result);

//close conenction
mysqli_close($con);
?>