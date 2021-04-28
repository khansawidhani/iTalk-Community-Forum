<?php 
include "partials/_dbconnect.php";
if(isset($_SESSION['login']) && $_SESSION['login'] == true){$login = true;} else{$login = false;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threads - iTalk Community Forum</title>
    <!-- google fonts apis -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&family=Lato:wght@700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre&display=swap" rel="stylesheet">
    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- material icons library link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- custom css files  -->
    <link rel="stylesheet" href="css/threadlist.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>"> 
</head>

<body>

    <?php require "partials/_header.php"; ?>
    <div class="main-container">
        <?php require "partials/_sidenav.php"; ?>
        <!-- main div has been started in sidenav file-->
        <div class="_main" id="main">
            <?php 
                $id =  $_GET['catid'];
                $sql = "SELECT * FROM `categories` WHERE `category_id` = $id ";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)){
                    $noResult = false;
                    $id = $row['category_id'];
                    $catName = $row['category_name'];
                    $catDesc = $row['category_description'];
                echo'<div class="jumbotron">
                        <h1 class="display-4">Welcome to <span>'.$catName.'</span> Forum</h1>
                        <p class="lead">'.$catDesc.'</p>
                        <hr class="my-4">
                        <p class="disclaimer">This is a peer to peer forum for sharing knowledge with each other. No spam/ Advertising/ self promote is allowed in the forum. Do not post copyright-infringing material. Do not post "offensive" posts, links or images. Do not cross post Questions. Kindly remain respectful to other members at all times. </p>
                        </div>';}
                        ?>
                        <!-- <p class="lead">
                            <a class="btn btn-primary btn-lg" href="#" role="button">Learn More</a>
                        </p> -->
            <?php
            if($login){
                $showAlert = false;
                $method = $_SERVER['REQUEST_METHOD'];
                if($method == 'POST'){
                    $th_title = $_POST['title'];
                    $th_title = str_replace("<","&lt;","$th_title");
                    $th_title = str_replace(">","&gt;","$th_title");
                    $th_desc = $_POST['desc'];
                    $th_desc = str_replace("<","&lt;","$th_desc");
                    $th_desc = str_replace(">","&gt;","$th_desc");
                    $user_id = $_POST['sno'];
                    if($th_title != "" && $th_desc != ""){
                        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$user_id', current_timestamp());";
                        $res = mysqli_query($conn, $sql);
                        $showAlert = true;
                        if($showAlert){
                        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Your thread has been added! Please wait for the community to respond.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';}
                    }
                }
            }
            ?>
            <!-- Threadlist Questions from here.-->
            <div class="heading-btn">
                <h1 class="browse-heading">Browse Threads</h1>
                <?php 
            if($login){ echo
            '<p class="btnadd">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#askQuestion"
                    aria-expanded="false" aria-controls="askQuestion">
                    Post a Question
                </button>
            </p>';}
            else{ echo
                '<p class="btnadd text-dark bg-warning p-3"><strong>
               Please Login to Ask a Question from Community </strong>
            </p>';
            }
            ?>
            </div>
            <?php if($login){
                $sno = $_SESSION['user_id'];
            echo '<div class="collapse" id="askQuestion">
                <div class="card card-body">
                    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Question Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Write your problem title here.." required>
                            <div id="emailHelp" class="form-text">Keep your title as crisp and short as possible.</div>

                        </div>
                        <input type="hidden" name="sno" value="'.$sno.'">
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description:</label>
                            <textarea class="form-control" id="desc" rows="4" name="desc"
                                placeholder="Elaborate your Question here in detail" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Post Question</button>
                        </div>
                    </form>
                </div>
            </div>';
            }
            ?>
            <div class="threads">
                <div class="thread-cat">
                    <h3 class="th-cat"> <?php echo $catName; ?></h3>
                    
                    <table class="table table-hover table-striped m-0">
                    <tbody>
                        <?php 
                    $id =  $_GET['catid'];
                    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id ";
                    $res = mysqli_query($conn, $sql);
                    $noResult = true;
                    while($row = mysqli_fetch_assoc($res)){
                        $noResult = false;
                        $id = $row['thread_id'];
                        $title = $row['thread_title'];
                        $desc = $row['thread_desc'];
                        $threadTime = $row['timestamp'];
                        $user_id = $row['thread_user_id'];
                        $sql2 = "SELECT username FROM `users_23` WHERE user_id='$user_id'";
                        $res2 = mysqli_query($conn, $sql2);
                        $row = mysqli_fetch_assoc($res2);
                        $user = $row['username'];
                        
                        $sql_replies = "SELECT * FROM `comments` WHERE thread_id = $id";
                        $res_replies = mysqli_query($conn, $sql_replies);
                        $replies = mysqli_num_rows($res_replies);
                        
                        $sql_last_activity = "SELECT * FROM `comments` WHERE thread_id = $id ORDER BY `comment_id` DESC LIMIT 1";
                        $res_last_activity = mysqli_query($conn, $sql_last_activity);
                        $row_last_activity = mysqli_fetch_assoc($res_last_activity);
                        if($row_last_activity){
                        $last_activity_by = $row_last_activity['comment_by'];
                        $last_activity_time = $row_last_activity['comment_time'];
                       
                        
                        $sql_last_activity_by = "SELECT username FROM `users_23` WHERE user_id='$last_activity_by'";
                        $res_last_activity_by = mysqli_query($conn, $sql_last_activity_by);
                        $row_last_activity_by = mysqli_fetch_assoc($res_last_activity_by);
                        $user_last_activity = $row_last_activity_by['username'];
                        $activity = 'Last activity By: <a style="text-decoration:none; color:#7DBF4D; text-transform:capitalize; font-weight:600;" href="/OnlineForum/user.php?v='.$last_activity_by.'">'.$user_last_activity.'</a><br> at '.date("d/m/Y h:i:s A", strtotime($last_activity_time));
                    }
                    else{
                        $activity = "no activity";
                    }

                            
                        echo '
                        
                            <tr class="question ">
                                <th scope="row "><span class=""><img src="assets/images/user.png" alt=""></span></th>
                                <td><h3><a href="thread.php?thread_id='.$id.'">'.$title.'</a></h3>
                                
                                <p class="my-0 posted">Started by  <a href="/OnlineForum/user.php?v='.$user_id.'">'.$user.'</a> at '.date("d/m/Y h:i:s A", strtotime($threadTime)).'</p>
                                </td>
                                <td><p>Replies:</p></td>
                                <td><p>'.$replies.'</p></td>
                                <td>'.$activity.'</td>
                            </tr>';
                        }
                    
                    
                        echo'
                            </tbody>
                  
                    </table>';
                    if($noResult){
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No Threads Found</h1>
                  <p class="lead">Be the first to ask a Question.</p>
                </div>
              </div>';
            }?>
                </div>
            </div>
            </div>
        </div> <!-- _main div ended.-->
    </div> <!-- main div ended. Was started before side nav in sidenav file-->
    <?php require "partials/_footer.php" ?>
    <script src="app.js"></script>
    <script>
    console.log(isopen);
    </script>
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