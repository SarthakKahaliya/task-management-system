<?php
    include "auth.php";
    include "header.php";

?>
  


   <div class="container mt-3" style="margin-bottom: 100px">

         <!-- Display any info -->
        <?php if(isset($_REQUEST['info'])){ ?>
            <?php if($_REQUEST['info'] == "added"){?>
                <div class="alert alert-success d-flex" style="justify-content: space-between;" role="alert">
                    <div><span style="font-weight: bold;"><?php echo $_REQUEST['user']; ?></span> successfully added.</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="edit.php?id=<?php echo $id ?>">X</a>
                </div>
            <?php }elseif ($_REQUEST['info'] == "removed"){?>
                <div class="alert alert-danger d-flex" style="justify-content: space-between;" role="alert">
                    <div><span style="font-weight: bold;"><?php echo $_REQUEST['user']; ?></span> successfully removed.</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="edit.php?id=<?php echo $id ?>">X</a>
                </div>
            <?php }elseif ($_REQUEST['info'] == "usernotfound"){?>
                <div class="alert alert-warning d-flex" style="justify-content: space-between;" role="alert">
                    <div><span style="font-weight: bold;"><?php echo $_REQUEST['user']; ?></span> not found.</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="edit.php?id=<?php echo $id ?>">X</a>
                </div>
            <?php }elseif ($_REQUEST['info'] == "exist"){?>
                <div class="alert alert-warning d-flex" style="justify-content: space-between;" role="alert">
                    <div><span style="font-weight: bold;"><?php echo $_REQUEST['user']; ?></span> already assigned.</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="edit.php?id=<?php echo $id ?>">X</a>
                </div>
            <?php } ?>
        <?php } ?>



        <?php foreach($query as $q){ 
            $projectID = $q['id'];
            $usql = "SELECT * FROM assignedusers where projectID = '$projectID'";
            $uquery = mysqli_query($conn, $usql);
            ?>

            <form method="POST" >
                <?php echo $q['creater']?>
                <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                <input type="text" readonly placeholder="Project" class="form-control my-3 <?php 
                        if($q['status'] == 'Completed'){ ?> 
                            bg-success  text-black
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                bg-warning  text-black
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                bg-secondary text-white
                            <?php } ?>" style="font-weight: bold; font-size: x-large;" name="title" value="ID: <?php  echo $q['pid'] ?>       Project: <?php echo $q['title']?>">
                <textarea name="content" class="form-control my-3 bg-dark text-white" cols="30" rows="6"><?php echo $q['content']?></textarea>

                <div class="d-flex" style="justify-content: space-between;">
                    
                    <div>
                        <strong>Status: </strong>
                        <select class="select mb-3 ml-3 p-1" name="status">
                            <option value="Not_Started" <?php if($q['status'] == 'Not_Started'){ ?>
                                    
                           <?php } ?>>Not Started</option>
                            <option value="In_Progress" <?php if($q['status'] == 'In_Progress'){ ?>
                                    selected
                            <?php } ?>>In Progress</option>
                            <option value="Completed" <?php if($q['status'] == 'Completed'){ ?>
                                    selected
                            <?php } ?>>Completed</option>
                        </select>
                    </div>

                </div>
                <div >     
                    <button class="btn btn-primary pl-5 pr-5 mr-2" name="update" onclick="return confirm('Are you sure you wish to make the changes?');">Update</button>
                    <a href="index.php" class="btn btn-light my-3">Go Home</a>
                </div>
                <br>
                <br>



            
                <div <?php if($q['creater'] != $usern){ echo "hidden"; } ?>>

                    <input type="text" placeholder="Enter Username to add." class=" bg-white text-black text-center" name="assign" style="border-radius: 5px; width: 260px;">

                    <button class="btn btn-success btn-sm pl-3 pr-3 ml-2" name="adduser" onclick="return confirm('Are you sure you wish to add this user?')">Add User</button>
                </div>
                <br>
                <h4>Assigned Users</h4>
                <div class="row container mt-3">
                    <?php foreach($uquery as $uq){ ?>
                        <div class="card pl-3 mr-3 bg-transparent" style="display:flex; flex-direction: row; border: solid 1px white;">
                            <div class="d-flex mr-3 pt-1 pb-1">
                                <input type="text" name="deleteuser" value="<?php echo $uq['username'] ?>" hidden>
                                <strong><?php echo $uq['username'] ?></strong>  
                            </div> 

                            <div  class="mt-0 mb-0">
                                <?php if($q['creater'] == $usern){
                                    if($uq['username'] != $q['creater']){?>
                                <button class="btn btn-danger btn-sm pt-1 pb-1" onclick="return confirm('Are you sure you want to remove this user from the task?');" name="deleteassign">X</button>
                            <?php   } 

                                }else{
                                    if($uq['username'] != $q['creater']){
                                        if($uq['username'] == $usern){?>
                                    <button class="btn btn-danger btn-sm pt-1 pb-1" onclick="return confirm('Are you sure you want to remove this user from the task?');" name="deleteassign">X</button>
                                <?php   } 
                                    } 
                                }?> 
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </form>

            
        <?php } ?>    
   </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<?php

include "footer.php";

?>
</body>
</html>
