<?php

include "header.php";

?>

    <div class="container mt-3 " style="margin-bottom: 100px">

        <!-- Display any info -->
        <?php if(isset($_REQUEST['info'])){ ?>
            <?php if($_REQUEST['info'] == "added"){?>
                <div class="alert alert-success ml-3 mr-3 d-flex" style="justify-content: space-between;" role="alert">
                    
                    <div>Post has been added successfully</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="index.php">X</a>
                    
                </div>
            <?php }elseif ($_REQUEST['info'] == "updated"){?>
                <div class="alert alert-primary ml-3 mr-3 d-flex" style="justify-content: space-between;" role="alert">
                    
                    <div>Post has been updated successfully</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="index.php">X</a>
                    
                </div>
            <?php }elseif ($_REQUEST['info'] == "deleted"){?>
                <div class="alert alert-danger ml-3 mr-3 d-flex" style="justify-content: space-between;" role="alert">
                    
                    <div>Post has been deleted successfully</div>
                    <a class="btn btn-sm mr-2" style="border: solid 1px black;" href="index.php">X</a>
                    
                </div>
            <?php } ?>
        <?php } ?>

        <!-- Create a new Post button -->
        <div class="ml-3">
            <a href="create.php" class="btn btn-outline-dark btn-light text-black pl-4 pr-4 ">+ Add Task</a>
        </div>

        <!-- show all tasks -->

        <div >
            <?php foreach($query as $q){ ?>
                <a href = "view.php?id=<?php echo $q['id']?>" style="text-decoration: none; display:flex; color: <?php 
                        if($q['status'] == 'Completed'){ ?> 
                            black;
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                black;
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                white; text-shadow: 1px 0 0px #00000088, 0 -1px 0px #00000088, 0 1px 0px #00000088, -1px 0 0px #00000088;
                            <?php } ?> margin-top: 5px;">
                    <div class="container">
                    
                        <div class="<?php 
                        if($q['status'] == 'Completed'){ ?> 
                            bg-success 
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                bg-warning 
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                bg-secondary
                            <?php } ?>
                                 container" style="border-radius: 5px;">
                            <div class="container  d-flex">
                                <div>
                                    <h5 class="card-title mt-2 pr-3" style="width: 140px; padding-bottom: 0px;"><strong><?php echo $q['title'];?></strong></h5>
                                    <div style="font-size: 12px; margin-top: -10px; padding-bottom: 3px;"><?php echo $q['createdOn'] ?></div>
                                </div>
                                <p class="mt-3 pr-3 pl-3" style="width: 600px; text-align: justify; border-left: solid 2px black;  border-right: solid 2px black; padding-top: 2px "><?php echo $q['content'];?></p>
                                <p class="mt-3 pl-4" style="width: 150px;"><strong><?php 
                        if($q['status'] == 'Completed'){ ?> 
                            Completed
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                In Progress
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                Not Started
                            <?php } ?></strong></p>
                                <div class="d-flex mt-3">
                                    <form>
                                    <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-light btn-sm" style="margin-top: -6px;" name="edit">Edit</a>
                                    </form>
                                    <form method="POST" onSubmit="return confirm('Are you sure you wish to delete this task?');">
                                        <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                                        <button class="btn btn-danger btn-sm ml-2"name="delete">Delete</button>
                                    </form>
                                </div>
                            
                            </div>
                        </div>
                    
                    </div>
                </a>
            <?php }?>
        </div>
       
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


