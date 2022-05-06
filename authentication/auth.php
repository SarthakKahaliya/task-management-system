
<?php if(basename($_SERVER['PHP_SELF']) == 'auth.php'){
  header("location: index.php");
} ?>

 <!-- Validating if a user is signed in or not -->
<?php
session_start();

//connect to database
$db=mysqli_connect("localhost","root","","mysite");

if(!$_SESSION['username']){
  header("location: authentication/login.php");
  exit();
}

// Current User

$usern = $_SESSION['username'];

?>