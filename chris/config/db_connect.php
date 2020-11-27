<?php
//connect to databse
$con = mysqli_connect('localhost', 'Alex', 'test1234', 'chris_website');

// check for errors
if (!$con) {
 echo 'Error connecting to database' . mysqli_connect_error();
}
