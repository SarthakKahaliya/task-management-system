<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location: index.php");
  die();
}
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if($db)
{
  if(isset($_POST['login_btn']))
  {
      $username=mysqli_real_escape_string($db,$_POST['username']);
      $password=mysqli_real_escape_string($db,$_POST['password']);
      $password=md5($password); //Remember we hashed password before storing last time
      $sql="SELECT * FROM users WHERE  username='$username' AND password='$password'";
      $result=mysqli_query($db,$sql);
      
      if($result)
      {
     
        if( mysqli_num_rows($result)>=1)
        {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['username']=$username;
            header("location:index.php");
        }
       else
       {
              $_SESSION['message']="Username or Password incorrect";
       }
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Task Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>


<div style="margin-bottom: 100px">
  <div class="container pt-3 mb-3" style="text-align: center;">
    <hgroup>
        <h1><strong>Task Management System</strong></h1>
    </hgroup>
  </div>


  <div class="container navbar text-white bg-dark " style="border-radius: 5px; justify-content: center;">
    <h3>Login</h3>

  </div>

  <main class="main-content">

  <?php
      if(isset($_SESSION['message']))
      {
           echo "<div class='container alert alert-danger'>".$_SESSION['message']."</div>";
           unset($_SESSION['message']);
      }
  ?>

  <div style="display:flex; justify-content: center; flex-direction: column; align-items: center;">
    <br>

  <form method="post"  action="login.php">
   
        <p><strong>Username:</strong></p>
        <input type="text" name="username" class="textInput form-control" style="margin-bottom: 10px; margin-top: -10px;" placeholder="Enter username">
       
        <p><strong>Password:</strong></p>
        <input type="password" name="password" class="textInput form-control" style="margin-bottom: 15px; margin-top: -10px;" placeholder="Enter password">
        <div style="text-align: center;">
          <button class="btn btn-primary form-control" type="submit" name="login_btn" style="margin-top: 10px">Login</button>
        </div>
        <div class="mt-3"><a href="register.php">Don't have an account? Click here</a></div>
        
       
  </form>
  </div>
  </div>

  </main>
  </div>
</div>

<?php

include "footer.php";

?>
</body>
</html>

