
<?php if(basename($_SERVER['PHP_SELF']) == 'auth.php'){
  header("location: ../index.php");
} ?>

<?php
session_start();

//connect to database
$db=mysqli_connect("localhost","root","","mysite");

if(!$_SESSION['username']){
  header("location: login.php");
  exit();
}

$usern = $_SESSION['username'];

?>