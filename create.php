<?php

    include "header.php";



?>

   

   <div class="container mt-5" style="margin-bottom: 100px">

    <!-- Display any info -->
        <form method="POST">
            <input type="text" placeholder="Project" class="form-control my-3 bg-dark text-white text-center" name="title" style="border-radius: 5px;">
            <textarea name="content" placeholder="Task Description." class="form-control my-3 bg-dark text-white" style="border-radius: 5px;" cols="30" rows="6"></textarea>
            <strong>Deadline: </strong>
            <input class="deadline" name="deadline" type="datetime-local" min="<?php echo date('Y-m-d\TH:i',strtotime("-1 days")); ?>" max="3000-01-01" required>
            <br>
            <br>
            <button class="btn btn-success pl-5 pr-5 mr-2" name="new_post">Add Task</button>
            <a href="index.php" class="btn btn-outline-light my-3">Go Home</a>
        </form>
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
