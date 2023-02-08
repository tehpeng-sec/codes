<?php
session_start();
include 'dbFunctions.php';
// initializing variables
$username = "";
$email    = "";
$errors = array();



// connect to the database

if(isset($_POST['username'])){
  // receive all input values from the form
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $email = mysqli_real_escape_string($link, $_POST['email']);
  $password_1 = mysqli_real_escape_string($link, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($link, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) {array_push($errors, "Username is required"); }
  if (empty($email)) {array_push($errors, "Email is required"); }
  else{
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       array_push($errors,"Invalid email format");
    }
  }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR user_email='$email' LIMIT 1";
  $result = mysqli_query($link, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['users_email'] === $email) {
      array_push($errors, "email already exists");
    }


  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (username, user_email, user_password, role_id)
  			  VALUES('$username', '$email', '$password', '0')";
  	mysqli_query($link, $query);
  	$_SESSION['username'] = $username;

        $user_check_query = "SELECT * FROM user WHERE username='$username' OR user_email='$email' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $row = mysqli_fetch_array($result);
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['total_post'] = $row['total_post'];
        $_SESSION['date_created'] = $row['date_created'];
        $_SESSION['user_id'] = $row['user_id'];
  	header('location: afterRegister.php');
  }
  else{
      $_SESSION['errors'] = $errors;

    header('location: register.php');

    }

}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
  ?>
