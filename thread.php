<?php 
include "partials/_dbconnect.php";
if(isset($_SESSION['login']) && $_SESSION['login'] == true){
    $login = true;
}
else{
    $login = false;
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre&display=swap" rel="stylesheet">
    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- material icons library link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- google fonts apis -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&family=Lato:wght@700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- custom css files  -->
    <link rel="stylesheet" href="css/threadlist.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>">


    <title>Threads - iTalk Community Forum</title>
</head>

<body>
    <?php require "partials/_header.php"; ?>
    <div class="main-container">
        <?php require "partials/_sidenav.php"; ?>
        <!-- main div has been started in sidenav file-->
            <div class="_main" id="main">
            <?php 
            $id =  $_GET['thread_id'];
            $sql = "SELECT * FROM `threads` WHERE thread_id = $id ";
            $res = mysqli_query($conn, $sql);
            if($res){
                while($row = mysqli_fetch_assoc($res)){
                    $id = $row['thread_id'];
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $user_id = $row['thread_user_id'];
                    $sql2 = "SELECT username FROM `users_23` WHERE user_id='$user_id'";
                        $res2 = mysqli_query($conn, $sql2);
                        $row = mysqli_fetch_assoc($res2);
                        $user = $row['username'];
                echo'<div class="jumbotron">
                        <h1 class="display-4"><span>'.$title.'</span></h1>
                        <p class="lead">'.$desc.'</p>
                        <hr class="my-4">
                        <p class="disclaimer">This is a peer to peer forum for sharing knowledge with each other. No spam/ Advertising/ self promote is allowed in the forum. Do not post copyright-infringing material. Do not post "offensive" posts, links or images. Do not cross post Questions. Kindly remain respectful to other members at all times. </p>
                        <p class="lead">
                            <p> Started by : <span style="text-transform: capitalize;"><strong>'.$user.'</strong></span></p>
                        </p>
                    </div>';
            }} ?>
                <!-- Banner Ad space started here.-->
                <div class="banner-ad border">
                    <h1 class="text-center">banner ad</h1>
                </div>
            <?php
            if($login){
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                
                if($method == 'POST'){
                    $comment = $_POST['comment'];
                    $comment = str_replace("<","&lt;","$comment");
                    $comment = str_replace(">","&gt;","$comment");
                    $sno = $_POST['sno'];
                    if($comment != ""){
                    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
                    $res = mysqli_query($conn, $sql);
                    $showAlert = true;
                    if($showAlert){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                    }}
            
                }
            }
                
            ?>
            <!-- Discussions from here.-->
            <h1 class="browse-heading">Discussions:</h1>
            <div class="comments">
                <?php 
                    $id =  $_GET['thread_id'];
                    $sql = "SELECT * FROM `comments` WHERE thread_id = $id ";
                    $res = mysqli_query($conn, $sql);
                    $noResult = true;
                    while($row = mysqli_fetch_assoc($res)){
                    $noResult = false;
                    $message = $row['comment_content'];
                    $commentTime = $row['comment_time'];
                    $comment_by = $row['comment_by'];
                    $sql2 = "SELECT username FROM `users_23` WHERE user_id='$comment_by'";
                        $res2 = mysqli_query($conn, $sql2);
                        $row = mysqli_fetch_assoc($res2);
                        $user = $row['username'];

                    echo   '<div class="comment d-flex">
                            <span class="img"><img src="assets/images/user.png" alt=""></span>
                            <div class="">
                            <p class="my-0">By <span style="text-transform:capitalize; display:inline-block; border:none;"><strong><a href="#">'.$user.'</a></strong></span> at '.date("d/m/Y h:i:s A", strtotime($commentTime)).'</p>
                            <p>'.$message.'</p>
                            </div>
                        </div>';
                    }
                    if($noResult){
                    echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No Answers Found</h1>
                            <p class="lead">Be the first to answer this thread.</p>
                        </div>
                    </div>';
                    }
                    ?>
            </div>
            <div class="type-comment">
            <?php 
            if($login){ echo'
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                <div class="mb-3">
                    <label for="comment" class="form-label">Type your Comment:</label>
                    <textarea class="form-control" id="comment" rows="5" name="comment"
                        placeholder="Type your comment here..." required></textarea>
                    <input type="hidden" name="sno" value="'.$_SESSION['user_id'].'">
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Post Comment</button>
                </div>
            </form>
        ';
            }
            else{
                echo
                '<p class="btnadd text-dark bg-warning p-3"><strong>
               Please Login to Join the Discussion </strong>
            </p>'; 
            }
            ?>
            </div>

    </div> <!-- _main div ended.-->
    </div> <!-- main div ended. Was started before side nav in sidenav file-->
    </div>
    <?php require "partials/_footer.php" ?>



    <script src="app.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="assets/libraries/jquery-3.5.1.min.js"></script>
</body>

</html>