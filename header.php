
<?php

    include "logic.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


    <title>Task Management System</title>
</head>
<body>

    <div class="container">
      <hgroup>
        <h1 class="site-title mt-3 " style="text-align: center;"><strong>Task Management System</strong></h1>
      </hgroup>
    

        <br>
        <nav class="navbar navbar-dark bg-dark" style="border-radius: 5px">
          <a class="logout btn btn-light" href="index.php">Home</a>
          <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: start;">
            <div style="color: white; padding-left: 0px; padding-right: 0px; margin-top: 0px;">
                <h3>Welcome! <?php echo strtoupper($_SESSION['username']); ?></h3>
            </div>

          </div>

          <a class="logout btn btn-danger btn-sm" href="logout.php">Logout</a>
        </nav>
    </div>


