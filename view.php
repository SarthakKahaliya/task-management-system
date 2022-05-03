<?php

    include "header.php";

?>


   <div class="container mt-5" style="margin-bottom: 100px">

        <?php foreach($query as $q){
            $projectID = $q['id'];
            $usql = "SELECT * FROM assignedusers where projectID = '$projectID'";
            $uquery = mysqli_query($conn, $usql);
            ?>
            <div class=" p-5 rounded-lg text-center <?php 
                        if($q['status'] == 'Completed'){ ?> 
                            bg-success  text-black
                            <?php }elseif($q['status'] == 'In_Progress'){ ?> 
                                bg-warning  text-black
                            <?php }elseif($q['status'] == 'Not_Started'){ ?> 
                                bg-secondary text-white
                            <?php } ?>">
                <h1 class="mb-3" style="font-weight: bold;"><?php echo $q['title'];?></h1>

                <div class="d-flex mt-2 justify-content-center align-items-center">
                    <a href="edit.php?id=<?php echo $q['id']?>" class="btn btn-light btn-sm" name="edit">Edit</a>
                    <form method="POST" onSubmit="return confirm('Are you sure you wish to delete this task?');">
                        <input type="text" hidden value='<?php echo $q['id']?>' name="id">
                        <button class="btn btn-danger btn-sm ml-2" name="delete">Delete</button>
                    </form>
                </div>

            </div>
            <p class="mt-5 border-left border-dark pl-3"><?php echo $q['content'];?></p>
                <br>
                <br>
                <h4>Assigned Users</h4>
                <div class="row container mt-3">
                    <?php foreach($uquery as $uq){ ?>
                        <div class="card pl-3 mr-3 bg-transparent" style="display:flex; flex-direction: row; border: solid 1px white;">
                            <div class="d-flex mr-3 pt-1 pb-1">
                                <strong><?php echo $uq['username'] ?></strong>  
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
