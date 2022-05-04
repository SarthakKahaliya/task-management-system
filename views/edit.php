<?php
    include "../authentication/auth.php";
    include "../components/header.php";

?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
            ?>

            <form method="POST" >
                <div style="width: 50%;float:left">
                <strong>Created by: <?php echo $q['creater']?></strong></div>
                <div style="width: 9%;float:right">
                   <!-- <div>   
                    
                    <a href="../index.php" class="btn btn-outline-light my-3">Go Home</a>
               </div> -->
                </div>
                <br>

                <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                <input type="text" readonly placeholder="Project" class="form-control my-3 <?php 
                        if($q['status'] == 'Completed'){ ?> 
                            bg-success  text-black
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                bg-info text-black
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                bg-secondary text-white
                            <?php } ?>" style="font-weight: bold; font-size: x-large;" name="title" value="ID: <?php  echo $q['pid'] ?>       Project: <?php echo $q['title']?>">
                <textarea name="content" class="form-control my-3 bg-dark text-white" cols="30" rows="6"><?php echo $q['content']?></textarea>

                <div class="d-flex" style="justify-content: space-between;">
                    <div style="width:110%;float:left;" class="container-fluid">
                    <div>
                        <strong>Status: </strong>
                        <select class="select mb-3 ml-3 p-1" name="status">
                            <option  value="Not_Started" <?php if($q['status'] == 'Not_Started'){ ?>
                                    
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
                 <div class="container-fluid" style="width:21%;float: right;">
                        <div >     
                    <button class="btn btn-info pl-5 pr-5 mr-2" name="update" onclick="return confirm('Are you sure you wish to make the changes?');">Update</button>
                   
                </div>
                    </div>

                </div>
                
                <br>
               



            
                <div <?php if($q['creater'] != $usern){ echo "hidden"; } ?>>
                     <button class="btn btn-outline-light btn-sm pl-3 pr-3 ml-2" name="adduser" onclick="return confirm('Are you sure you wish to add this user?')">Add User</button>

                    <input type="text" placeholder="Enter name" class=" bg-white text-black text-center" name="assign" style="border-radius: 5px; width: 100px;">

                   
                </div>
                <br><br>
                <div style="width: 20%;float: left;">

                <h4>Created By</h4>
                <div class="btn btn-info mb-3"><?php echo $q['creater'] ?></div>
            </div>
            <div style="width:fit-content;float: right; " class="container-fluid">
                 <h4 style="width:12; float: inline-end">Assigned Users</h4>
                <div class="row container-fluid mt-3">
                    <form>
                        <div class="d-flex" >
                        <?php foreach($uquery as $uq){

                        if($usern == $q['creater']){ 
                            if($q['creater'] != $uq['username']){


                            ?>
                                
                                    <div class="mr-3">
                                        <input hidden type="text" name="deletetaskid" value="<?php echo $uq['taskID'] ?>">  
                                        <input class="btn btn-info" type="submit" name="deleteassign" value="<?php echo $uq['username'] ?> " onclick="return confirm('Are you sure you want to remove this user from your task?')">
                                    </div> 
                               
                        <?php } 
                        }else{
                            if($q['creater'] != $uq['username']){

                                if($usern == $uq['username']){ ?>
                                    <div class="mr-3">
                                        <input hidden type="text" name="deletetaskid" value="<?php echo $uq['taskID'] ?>">  
                                        <input class="btn btn-danger" type="submit" name="deleteonlythis" value="<?php echo $uq['username'] ?> "  onclick="return confirm('Are you sure you want to remove yourself from this task?')">
                                    </div> 

                                <?php }elseif($usern != $uq['username'] ){

                            ?>
                                
                                    <div class="mr-3">
                                        <input hidden class="btn btn-danger" type="text" name="deletetaskid" value="<?php echo $uq['taskID'] ?>">  
                                        <div class="btn btn-outline-light"><?php echo $uq['username'] ?></div>
                                    </div> 
                               
                        <?php
                        }}



                         }}?>
                        </div>
                    </form>
                </div> 
            </div>
<br>
<br><br><br>
            </form>
        <?php } ?>  

   </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<?php

include "../components/footer.php";

?>
</body>
</html>
