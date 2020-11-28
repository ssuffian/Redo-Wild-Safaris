<?php
//connect to databse
$con = mysqli_connect('localhost', 'chris', 'password', 'chris_website');

// check for errors
if (!$con) {
 echo 'Error connecting to database' . mysqli_connect_error();
}
