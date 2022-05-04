<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location: ../index.php");
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
            header("location: ../index.php");
        }
       else
       {
              $_SESSION['message']="Username or Password incorrect";
       }
      }
  }
}
?>

<?php

include "../components/header.php";

?>

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

include "../components/footer.php";

?>
</body>
</html>

