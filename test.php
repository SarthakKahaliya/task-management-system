<?php 

	echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';

	echo "<style>
			h1{
				text-align: center;
			}

			h3{
				padding-left: 450px;
			}
		</style>";

	echo "<h1>Here all the Functionality of Code is being Tested</h1><br><h3>";

	// Testing for Database Connection

	echo "Connection to Database: ";

	$conn = mysqli_connect("localhost", "root", "", "mysite");
	if(!$conn){
        ?><span class="text-danger" >Failed</span><br><?php
    }else{
    	?><span class="text-success" >Successfull</span><br><?php

    }

	$usern = "admin";
	$project_name = "project";


	// Testing For Project Creation

	echo "Project Creation: ";

	$sql = "INSERT INTO projectdata(projectname, creater) VALUES('$project_name', '$usern')";
	if(mysqli_query($conn, $sql)){
		?><span class="text-success" >Successfull</span><br><?php
	}else{
		?><span class="text-danger" >Failed</span><br><?php
	}

	
	// Testing for Adding Task and Assigning User

	$pid = mysqli_insert_id($conn);
	$title = $project_name;
	$content = "Task";
	$deadline = date("Y-m-d", strtotime("+1 day"));
	$sql = "INSERT INTO taskdata(pid, title, content, deadline, status, creater) VALUES('$pid', '$title', '$content', '$deadline', 'Not_Started', '$usern')";
	if(mysqli_query($conn, $sql)) {
		echo "Add Task : <span class='text-success' >Successfull</span><br> ";
            $last_id = mysqli_insert_id($conn);
            $sql = "INSERT INTO assignedusers(taskID, username) VALUES('$last_id', '$usern')";
            if(mysqli_query($conn, $sql)){
            	echo "Assign Task to User : <span class='text-success' >Successfull</span><br> ";
            }
        }else{
        	echo "Add Task : <span class='text-danger' >Failed</span><br> ";
        	echo "Assign Task to User : <span class='text-danger' >Failed</span><br> ";
        }
            

    // Testing for Deleting Assigned User

    $sql = "DELETE FROM assignedusers WHERE taskID = $last_id ";

    if(mysqli_query($conn, $sql)){
    	echo "Delete Assigned User : <span class='text-success' >Successfull</span><br> ";
    }else{
    	echo "Delete Assigned User : <span class='text-danger' >Failed</span><br> ";
    }


    // Testing for Deleting Task 

    $sql = "DELETE FROM taskdata WHERE pid = $pid";
    if(mysqli_query($conn, $sql)){
    	echo "Delete Task : <span class='text-success' >Successfull</span><br> ";
    }else{
    	echo "Delete Task : <span class='text-danger' >Failed</span><br> ";
    }


    // Testing for Deleting Project 

    $sql = "DELETE FROM projectdata WHERE id = $pid";
    if(mysqli_query($conn, $sql)){
    	echo "Delete Project : <span class='text-success' >Successfull</span><br> ";
    }else{
    	echo "Delete Project : <span class='text-danger' >Failed</span><br> ";
    }
	
?>