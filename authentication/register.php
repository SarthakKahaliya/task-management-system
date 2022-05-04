
<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if(isset($_POST['register_btn']))
{
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $password2=mysqli_real_escape_string($db,$_POST['password2']);  
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result=mysqli_query($db,$query);
      if($result)
      {
     
        if( mysqli_num_rows($result) > 0)
        {
                
                echo '<script language="javascript">';
                echo 'alert("Username already exists")';
                echo '</script>';
        }
        
          else
          {
            
            if($password==$password2)
            {           //Create User
                $password=md5($password); //hash password before storing for security purposes
                $sql="INSERT INTO users(username, email, password ) VALUES('$username','$email','$password')"; 
                mysqli_query($db,$sql);  
                $_SESSION['message']="You are now logged in"; 
                $_SESSION['username']=$username;
                header("location: ../index.php");  //redirect home page
            }
            else
            {
                $_SESSION['message']="The two password do not match";   
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
             echo "<div id='error_msg'>".$_SESSION['message']."</div>";
             unset($_SESSION['message']);
        }
    ?>


    <div style="display:flex; justify-content: center; flex-direction: column; align-items: center;">
      <br>

    <form method="post" action="register.php">
     
        <p><strong>Username:</strong></p>
        <input type="text" name="username" class="textInput form-control" style="margin-bottom: 10px; margin-top: -10px;" placeholder="Enter username">
         
        <p><strong>Email:</strong></p>
        <input type="email" name="email" class="textInput form-control" style="margin-bottom: 10px; margin-top: -10px;" placeholder="Enter email">


        <p><strong>Password:</strong></p>
        <input type="password" name="password" class="textInput form-control" style="margin-bottom: 10px; margin-top: -10px;" placeholder="Enter password">

        <p><strong>Confirm Password:</strong></p>
        <input type="password" name="password2" class="textInput form-control" style="margin-bottom: 15px; margin-top: -10px;" placeholder="Enter password again">


        <div style="text-align: center;">
            <button class="btn btn-primary form-control" type="submit" name="register_btn" style=" margin-top: 10px">Sign up</button>
        </div>
        <div class="mt-3"><a href="login.php">Already have an account? click here.</a></div>
         
    </form>
    </div>

    </main>
    </div>
</div>
<?php

include "../components/footer.php";

?>
</body>
</html>





