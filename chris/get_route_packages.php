<?php 

include 'config/db_connect.php';

$sql_packages = "SELECT * FROM route_packages";

$packagesResult = mysqli_query($con, $sql_packages);

$allPackages = mysqli_fetch_all($packagesResult, MYSQLI_ASSOC);

mysqli_free_result($packagesResult);

?>