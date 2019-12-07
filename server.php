<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$college  = "";
$gender   = "";
$ca       = "";
$address  = "";
$contact  = "";
$errors   = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'minare_registration');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $college = mysqli_real_escape_string($db, $_POST['college']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);
  $ca = mysqli_real_escape_string($db, $_POST['ca']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $contact = mysqli_real_escape_string($db, $_POST['contact']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($college)) { array_push($errors, "College is required"); }
  if (empty($gender)) { array_push($errors, "Gender is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
  if (empty($contact)) { array_push($errors, "Contact is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $query = "INSERT INTO users (username, email, college, gender, ca, address, phone) 
    VALUES('$username', '$email', '$college', '$gender', '$ca', '$address', '$contact')";
    mysqli_query($db, $query);
  }
}

?>