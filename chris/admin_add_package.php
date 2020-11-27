<?php

//validate package
if (empty($_POST['package'])) {
 $errors['package'] = 'Package name cannot be empty';
} else {
 $package = $_POST['package'];
 if (!preg_match('/^[a-zA-Z\s]+$/', $package)) {
  $errors['package'] = 'Package name must contain letters and spaces only';
 }
}

//validate price
if (empty($_POST['price'])) {
 $errors['price'] = 'Price  cannot be empty';
} else {
 $price = $_POST['price'];
 if (!is_numeric($price)) {
  $errors['price'] = 'Price should be numbers only';
 }
}

//validate days
if (empty($_POST['days'])) {
 $errors['days'] = 'Days  cannot be empty';
} else {
 $days = $_POST['days'];
 if (!is_numeric($days)) {
  $errors['days'] = 'days should be numbers only';
 }
}
