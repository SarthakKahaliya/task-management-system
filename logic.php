
<?php if(basename($_SERVER['PHP_SELF']) == 'logic.php'){
    header("location: index.php");
} ?>

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

    $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') ORDER BY createdOn DESC";
    $query = mysqli_query($conn, $sql);

    $selection = "createddss";
    $pselection = "all";


    $sql = "SELECT * FROM projectdata";
    $pquery = mysqli_query($conn, $sql);

    

    if(isset($_REQUEST['pfilter']) || isset($_REQUEST['orderby'])){
        $selection = $_REQUEST['orderby'];
        $pselection = $_REQUEST['pfilter'];

        if($pselection == "all"){

            if($selection == 'deadline'){
            $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') ORDER BY deadline ASC";
            $query = mysqli_query($conn, $sql);

            $selection = "deadline";
            
            

            }
            if($selection == 'createdass'){
                $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') ORDER BY createdOn ASC";
                $query = mysqli_query($conn, $sql);

                $selection = "createdass";

            }

            if($selection == 'createddss'){
                $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') ORDER BY createdOn DESC";
                $query = mysqli_query($conn, $sql);

                $selection = "createddss";

            }

        }else{

            $p_and_id = explode('|', $_REQUEST['pfilter']);
            $pid = $p_and_id[0];
            $title = $p_and_id[1];

            if($selection == 'deadline'){
            $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') AND pid = $pid ORDER BY deadline ASC";
            $query = mysqli_query($conn, $sql);

            $selection = "deadline";
            $pselection = $pid;
            
            

            }
            if($selection == 'createdass'){
                $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') AND pid = $pid ORDER BY createdOn ASC";
                $query = mysqli_query($conn, $sql);

                $selection = "createdass";
                $pselection = $pid;

            }

            if($selection == 'createddss'){
                $sql = "SELECT * FROM taskdata WHERE id IN(SELECT projectID from assignedusers WHERE username = '$usern') AND pid = $pid ORDER BY createdOn DESC";
                $query = mysqli_query($conn, $sql);

                $selection = "createddss";
                $pselection = $pid;

            }
            
        }


    }




    // Get user task data whoever is assigned task




    
   // Create a new project

    if(isset($_REQUEST['new_project'])){
        $project_name = $_REQUEST['project_name'];
        
        $sql = "INSERT INTO projectdata(projectname) VALUES('$project_name')";
        mysqli_query($conn, $sql);
        header("Location: create.php?info=addedproject");
        exit();

    }






    // Create a new task
    if(isset($_REQUEST['new_task'])){
        $p_and_id = explode('|', $_REQUEST['p_and_id']);
        $pid = $p_and_id[0];
        $title = $p_and_id[1];
        $content = $_REQUEST['content'];
        $deadline = $_REQUEST['deadline'];
        
        $sql = "INSERT INTO taskdata(pid, title, content, deadline, status) VALUES('$pid', '$title', '$content', '$deadline', 'Not_Started')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO assignedusers(projectID, username) VALUES('$last_id', '$usern')";
            mysqli_query($conn, $sql);

            header("Location: index.php?info=added");
            exit();
        }
    }

    // Get task data based on id
    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $sql = "SELECT * FROM taskdata WHERE id = $id";
        $query = mysqli_query($conn, $sql);
    }

    // Delete a task
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
        $content = $_REQUEST['content'];
        $status = $_REQUEST['status'];
        
            
        $sql = "UPDATE taskdata SET content = '$content', status = '$status' WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: index.php?info=updated");
        exit();
        
    }

        // Assign User
    if(isset($_REQUEST['adduser'])){
        $id = $_REQUEST['id'];
        $content = $_REQUEST['content'];
        $status = $_REQUEST['status'];
        $assign = $_REQUEST['assign'];
        if($assign != ''){
            $username=mysqli_real_escape_string($conn ,$assign);
            $sql="SELECT * FROM users WHERE  username='$username'";
            $result=mysqli_query($conn,$sql);

            if($result){
                if( mysqli_num_rows($result)>=1){

                    $sql = "SELECT * FROM assignedusers WHERE projectID = $id AND username = '$username'";
                    $exist = mysqli_query($conn, $sql);
                    if($exist){
                        if(mysqli_num_rows($exist)>=1){
                            header("Location: edit.php?info=exist&id=$id&user=$username");
                            exit();
                        }else{

                            $sql = "UPDATE taskdata SET content = '$content', status = '$status' WHERE id = $id";
                            if (mysqli_query($conn, $sql)) {
                                $sql = "INSERT INTO assignedusers(projectID, username) VALUES('$id', '$username')";
                                mysqli_query($conn, $sql);

                                header("Location: edit.php?info=added&id=$id&user=$username");
                                exit();
                            }

                        }
                    }
                }else{
                    header("Location: edit.php?info=usernotfound&id=$id&user=$username");
                    exit();
                }
            
            }

        }else{
            $sql = "UPDATE taskdata SET content = '$content', status = '$status' WHERE id = $id";
            mysqli_query($conn, $sql);

            header("Location: index.php?info=updated");
            exit();
        }
    }


    // Delete Assigned User

    if(isset($_REQUEST['deleteassign'])){

        $id = $_REQUEST['id'];
        $username = $_REQUEST['deleteuser'];

        $sql = "DELETE FROM assignedusers WHERE projectID = $id and username = '$username'";
        mysqli_query($conn, $sql);

        header("Location: edit.php?info=removed&id=$id&user=$username");
        exit();

    }


    // Delete Project

    if(isset($_REQUEST['delete_project'])){


        if($_REQUEST['pfilter'] != 'all'){
            $p_and_id = explode('|', $_REQUEST['pfilter']);
            $pid = $p_and_id[0];
            $title = $p_and_id[1];

            $sql = "SELECT * FROM taskdata WHERE pid = $pid";
            $query = mysqli_query($conn, $sql);

            foreach ($query as $q){

                $qtaskid = $q['id'];
                $sql = "DELETE FROM assignedusers WHERE projectID = $qtaskid ";
                mysqli_query($conn, $sql);
            }

            $sql = "DELETE FROM taskdata WHERE pid = $pid";
            mysqli_query($conn, $sql);

            $sql = "DELETE FROM projectdata WHERE id = $pid";
            mysqli_query($conn, $sql);

            header("Location: index.php");
            exit();
        }


    }





?>
