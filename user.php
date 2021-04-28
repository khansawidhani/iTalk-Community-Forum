<?php
require 'partials/_dbconnect.php';
$user_id = $_GET['v'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account | iTalk Community Forum</title>

    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- material icons library link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- google fonts apis  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&family=Lato:wght@700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- custom css files  -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/user.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require "partials/_header.php"; ?>
    <div class="main-container">
        <?php require "partials/_sidenav.php" ?>

        <div class="_main" id="main">
            <div class="user">
                <div class="user-left">
                    <div>
                        <img src="assets/images/user.png" alt="">
                    </div>
                    <div class="user-activity">
                        <?php
                        // for threads count
                        $sql_thread_count = "SELECT * FROM `threads` WHERE thread_user_id = $user_id";
                        $res_thread_count = mysqli_query($conn, $sql_thread_count);
                        $thread_count = mysqli_num_rows($res_thread_count);
                        //for comments count
                        $sql_comment_count = "SELECT * FROM `comments` WHERE comment_by = $user_id";
                        $res_comment_count = mysqli_query($conn, $sql_comment_count);
                        $comment_count = mysqli_num_rows($res_comment_count);
                        echo '<ul>
                            <li><strong>Questions : </strong> ' . $thread_count . ' </li>
                            <li><strong>Answers : </strong> ' . $comment_count . ' </li>
                        </ul>';
                        ?>
                    </div>
                    <div class="user-data">
                        <ul>
                            <li><span class="icon"><i class="fas fa-map-marker-alt"></i></span> United States </li>
                            <li><span class="icon"><i class="fas fa-history"></i></span> Member since 1 year ago </li>
                            <li><span class="icon"><i class="far fa-clock"></i></span> Last Active 3m ago </li>
                            <li><span class="icon"><i class="far fa-eye"></i></span> 300 Profile views </li>



                        </ul>
                    </div>

                </div>
                <div class="user-right">
                    <?php
                    $sql = "SELECT * FROM `users_23` WHERE `user_id` = $user_id";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        $username = $row['username'];
                        $desc = $row['user_description'];
                    }
                    echo '<h1>' . $username . '</h1>
                            <p>' . $desc . '</p>';
                    ?>
                    <div class="user-threads">
                        <?php
                        // for threads 
                        $sql_thread = "SELECT * FROM `threads` WHERE thread_user_id=$user_id ";
                        $res_thread = mysqli_query($conn, $sql_thread);
                        while ($row_thread = mysqli_fetch_assoc($res_thread)) {
                            $thread_title = $row_thread['thread_title'];
                            $thread_time = $row_thread['timestamp'];
                            $thread_id = $row_thread['thread_id'];

                        ?>
                            <!-- user threads -->
                            <h2>Latest Threads Started by <?php echo $username; ?></h2>
                            <table class="table table-hover table-striped m-0">
                                <tbody>
                                    <tr>
                                    <?php
                                    echo '
                    <td class="thread"><a href="thread.php?thread_id='. $thread_id.'">' . $thread_title . ' </a></td>
                    <td>' . date("d/m/Y h:i:s A", strtotime($thread_time)) . '</td>';
                                }
                                    ?>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <?php
                    // for comments
                    $sql_comment = "SELECT * FROM `comments` WHERE comment_by = $user_id";
                    $res_comment = mysqli_query($conn, $sql_comment);
                    while ($row_comment = mysqli_fetch_assoc($res_comment)) {
                        $comment = $row_comment['comment_content'];
                        $comment_time = $row_comment['comment_time'];
                        if (strlen($comment) >= 80) {
                            $comment = substr($comment, 0, 70)."<strong>... </strong>";
                        }
                        echo '
                            <div class="user-comments">
                    <h2>Latest Answers by ' . $username . '</h2>
                    <table class="table table-hover table-striped m-0">
                    <tbody>
                    <tr>
                    <td class="comments"><a href="#">' . $comment . ' </a></td>
                    <td>' . date("d/m/Y h:i:s A", strtotime($comment_time)) . '</td>
                    
                    </tr>';
                    } ?>

                    <!-- user comments  -->



                    </tbody>
                    </table>


                </div>

            </div>
        </div>

    </div>
    <!-- main section ended -->
    </div>
    </div> <!-- main-container ended -->
    <?php require "partials/_footer.php"; ?>

    <!-- custom script file -->
    <script src="app.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="assets/libraries/jquery-3.5.1.min.js"></script>
</body>

</html>