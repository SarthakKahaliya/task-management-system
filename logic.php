
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


<?php

    // Don't display server errors 
    ini_set("display_errors", "off");

    // Initialize a database connection
    $conn = mysqli_connect("localhost", "root", "", "mysite");

    // Destroy if not possible to create a connection
    if(!$conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Get data to display on index page
    $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern')";
    $query = mysqli_query($conn, $sql);
    // Get user data who are assigned task




    // Create a new post
    if(isset($_REQUEST['new_post'])){
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        
        $sql = "INSERT INTO taskdata(title, content, status) VALUES('$title', '$content', 'Not_Started')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO assignedusers(projectID, username) VALUES('$last_id', '$usern')";
            mysqli_query($conn, $sql);

            header("Location: index.php?info=added");
            exit();
        }
    }

    // Get post data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM taskdata WHERE id = $id";
        $query = mysqli_query($conn, $sql);
    }

    // Delete a post
    if(isset($_REQUEST['delete'])){
        $id = $_REQUEST['id'];

        $sql = "DELETE FROM taskdata WHERE id = $id";
        mysqli_query($conn, $sql);

        $sql = "DELETE FROM assignedusers WHERE projectID = $id";
        mysqli_query($conn, $sql);

        header("Location: index.php?info=deleted");
        exit();
    }

    // Update a post
    if(isset($_REQUEST['update'])){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        $status = $_REQUEST['status'];
        $assign = $_REQUEST['assign'];
        if($assign != ''){
            $username=mysqli_real_escape_string($conn ,$assign);
            $sql="SELECT * FROM users WHERE  username='$username'";
            $result=mysqli_query($conn,$sql);

            if($result){
                if( mysqli_num_rows($result)>=1){
                    $sql = "UPDATE taskdata SET title = '$title', content = '$content', status = '$status' WHERE id = $id";
                    if (mysqli_query($conn, $sql)) {
                        $sql = "INSERT INTO assignedusers(projectID, username) VALUES('$id', '$username')";
                        mysqli_query($conn, $sql);

                        header("Location: edit.php?info=added&id=$id&user=$username");
                        exit();
                    }

                }else{
                    header("Location: edit.php?info=usernotfound&id=$id&username=$username");
                    exit();
                }
            }
        

        }else{
            $sql = "UPDATE taskdata SET title = '$title', content = '$content', status = '$status' WHERE id = $id";
            mysqli_query($conn, $sql);

            header("Location: index.php?info=updated");
            exit();
        }
    }

        // Update a post
    if(isset($_REQUEST['adduser'])){
        $id = $_REQUEST['id'];
        $title = $_REQUEST['title'];
        $content = $_REQUEST['content'];
        $status = $_REQUEST['status'];
        $assign = $_REQUEST['assign'];
        if($assign != ''){
            $username=mysqli_real_escape_string($conn ,$assign);
            $sql="SELECT * FROM users WHERE  username='$username'";
            $result=mysqli_query($conn,$sql);

            if($result){
                if( mysqli_num_rows($result)>=1){
                    $sql = "UPDATE taskdata SET title = '$title', content = '$content', status = '$status' WHERE id = $id";
                    if (mysqli_query($conn, $sql)) {
                        $sql = "INSERT INTO assignedusers(projectID, username) VALUES('$id', '$username')";
                        mysqli_query($conn, $sql);

                        header("Location: edit.php?info=added&id=$id&user=$username");
                        exit();
                    }

                }else{
                    header("Location: edit.php?info=usernotfound&id=$id&username=$username");
                    exit();
                }
            }
        

        }else{
            $sql = "UPDATE taskdata SET title = '$title', content = '$content', status = '$status' WHERE id = $id";
            mysqli_query($conn, $sql);

            header("Location: index.php?info=updated");
            exit();
        }
    }


    if(isset($_REQUEST['deleteassign'])){

        $id = $_REQUEST['id'];
        $username = $_REQUEST['deleteuser'];

        $sql = "DELETE FROM assignedusers WHERE projectID = $id and username = '$username'";
        mysqli_query($conn, $sql);

        header("Location: edit.php?info=removed&id=$id&user=$username");
        exit();

    }

?>
