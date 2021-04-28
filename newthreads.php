<?php
    include "partials/_dbconnect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/libraries/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" href="assets/libraries/fontawesome-free-5.15.2-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/threadlist.css?v=<?php echo time(); ?>">
    <title>iTalk Community Forum </title>
    <style>
    #main {
        min-height: 70vh;
    }
    </style>
</head>

<body>

    <?php require "partials/_header.php";?>
    <div class="main-container">
        <?php require "partials/_sidenav.php"?>

        <div class="_main" id="main">

            <h1 class="browse-heading">Latest Threads:</h1>
            <div class="threads">
                <div class="thread-cat">
                    <table class="table table-hover table-striped m-0">
                        <tbody>
                            <?php 
                    $sql = "SELECT * FROM `threads`";
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
                        echo '
                        <tr class="question ">
                        <th scope="row "><span class=""><img src="assets/images/cat-1.png" alt=""></span></th>
                        <td><h3><a href="thread.php?thread_id='.$id.'">'.$title.'</a></h3>
                        
                        <p class="my-0 posted">Started by  <a href="/OnlineForum/user.php?v='.$user_id.'">'.$user.'</a> at '.$threadTime.'</p>
                        </td>
                        <td><p>Views:</p><p>Replies:</p></td>
                        <td><p>23</p><p>15</p></td>
                        <td>Today at '.$threadTime.'<br>Last activity By: <a style="text-decoration:none; color:#7DBF4D; text-transform:capitalize; font-weight:600;" href="/OnlineForum/user.php?v='.$user_id.'"> '.$user.'</a></td>
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
    }
    ?>
                </div>
            </div>
        </div> <!-- _main section ended -->
    </div>
    </div> <!-- main-container ended -->
    <?php require "partials/_footer.php"; ?>
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
    <script src="assets/libraries/slick-1.8.1/slick/slick.min.js"></script>

</body>

</html>