
<?php if(basename($_SERVER['PHP_SELF']) == 'header.php'){
  header("location: ../index.php");
} ?>

<?php

    include "../logic.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">


    <title>Task Management System</title>
</head>
<body>

    <div class="container">
      <hgroup>
        <h1 class="site-title mt-2 " style="text-align: center;"><strong>Task Management System</strong></h1>
      </hgroup>
    

        
        <h3 class="mt-5 pt-5" style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px; text-align: center;" <?php if(basename($_SERVER['PHP_SELF']) != 'login.php'){
              echo "hidden";
            }  ?>>Login</h3>

        <h3 class="mt-5 pt-5" style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px; text-align: center;" <?php if(basename($_SERVER['PHP_SELF']) != 'register.php'){
              echo "hidden";
            }  ?>>Sign Up</h3>



        <nav class="navbar navbar-dark  mt-3 pt-3" style="border-radius: 5px"  <?php if(basename($_SERVER['PHP_SELF']) == 'login.php'){
              echo "hidden";
            }  ?>>   
        
          <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: start;">

            <div style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px;" <?php if(basename($_SERVER['PHP_SELF']) != 'view.php'){
            echo "hidden";
          }     ?> >
                <a href="index.php" class="btn btn-light btn-outline-dark my-3">Go Home</a>
            </div>

            <div style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px;" <?php if(basename($_SERVER['PHP_SELF']) != 'index.php'){
            echo "hidden";
          }     ?> >
                <h3>WELCOME <?php echo strtoupper($_SESSION['username']);?>!</h3>
            </div>
            <div style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px;" <?php if(basename($_SERVER['PHP_SELF']) != 'create.php'){
            echo "hidden";
          }     ?> >
                <h3>Create Task</h3>
            </div>
            <div style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px;" <?php if(basename($_SERVER['PHP_SELF']) != 'edit.php'){
            echo "hidden";
          }     ?> >
                <h3>Edit Task</h3>
            </div>

          </div>
          <div <?php if(basename($_SERVER['PHP_SELF']) == 'login.php' || basename($_SERVER['PHP_SELF']) == 'register.php'){
            echo "hidden";
          }     ?> >
        
                    
                    <a href="../index.php" class="btn btn-outline-light my-3">Home</a>
             
            <a class="logout btn btn-outline-light " href="../authentication/logout.php"  >Logout</a>
          </div>
          
        </nav>
    </div>


