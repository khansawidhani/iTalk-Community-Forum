<?php 
include "_dbconnect.php";
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/libraries/fontawesome-free-5.15.2-web/css/all.min.css">
    <link rel="stylesheet" href="/OnlineForum/partials/css/header.css?v=<?php echo time(); ?>">
    
    <title>Document</title>
</head>

<body>
    <header>
        <div class="top-line"></div>
        <nav class="d-flex items-center justify-between">
            <div class="left d-flex">
                <button id="sidenavBtn"><i class="fas fa-bars"></i></button>
                <a class="" href="/OnlineForum/index.php"> iTalk <span>Community</span></a>
                <form action="/OnlineForum/query.php" method="GET" class="d-flex items-center">
                    <div class="d-flex items-center"><span><i class="fas fa-search"></i></span><input type="search"
                            placeholder="search here" name="query">
                    </div>
                </form>
            </div>
            <?php if(!$login){
            echo'<div class="right d-flex">
                    <button class="btn d-flex items-center" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="fas fa-lock i-h"></i><span class="i-h">Login</span>
                </button>
                    <button class="btn d-flex items-center" data-bs-toggle="modal" data-bs-target="#signupModal">
                    <i class="fas fa-clipboard-list i-h"><span class="i-h"> Register</i></span>
                </button></div>
                ';}

            else{
            echo'<div class="right d-flex items-center">
                    <p class="" > Welcome '.$_SESSION['username'].' </p>
                    <a class="btn d-flex items-center" href="/OnlineForum/partials/_logout.php" ><span class="i-h"> Logout </span>
                    <i class="fas fa-sign-out-alt i-h"></i></a>
                    </div>';}?>
            <?php

            ?>
            
        </nav>
    </header>
    <?php
    $showError = false;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $action = $_POST['action'];
        switch($action) {
            case 'signup': 
                $register=false;
                $s_username= $_POST['signupusername'];
                $s_email= $_POST['signupemail'];
                $s_password= $_POST['signuppassword'];
                $s_cpassword= $_POST['cpassword'];
                $sqlexist = "SELECT * FROM `users_23` WHERE `username` = '$s_username' ";
                $result = mysqli_query($conn, $sqlexist);
                $isResult = mysqli_num_rows($result);
                if($isResult <= 0 ){
                    $sqlemail= "SELECT * FROM `users_23` WHERE `email` = '$s_email' ";
                    $result = mysqli_query($conn, $sqlemail);
                    $isResult = mysqli_num_rows($result);
                    if($isResult <= 0 ){
                        if($s_password == $s_cpassword){
                            $hash = password_hash($s_password, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO `users_23` (`username`, `email`, `password`, `timestamp`) VALUES ('$s_username', '$s_email', '$hash', current_timestamp());";
                            $res = mysqli_query($conn, $sql);
                            if($res){
                                $register = true;
                                header("location:/OnlineForum/index.php?register=$register");
                            }
                        }
                        else{
                            $resgister = false;
                            $showError = "Passwords do not match.";
                            header("location:/OnlineForum/index.php?register=$register&err=$showError");
                        }
                    }
                    else{
                        $register=false;
                        $showError = "Email already in use";
                        header("location:/OnlineForum/index.php?register=$register&err=$showError");
                    }
                }
                else{
                    $resgister = false;
                    $showError = "Username already exist.";
                    header("location:/OnlineForum/index.php?register=$register&err=$showError");
                }
                break;
                case 'login':
                    $login=false;
                    $l_username= $_POST['loginusername'];
                    $l_password= $_POST['loginpassword'];
                    $sqllogin = "SELECT * FROM `users_23` WHERE `username` = '$l_username' ";
                    $result=mysqli_query($conn, $sqllogin);
                    $isResult= mysqli_num_rows($result);
                    $isusernameexist = false;
                    if($isResult == 1){
                        $isusernameexist = true;
                        while($row=mysqli_fetch_assoc($result)){
                            if(password_verify($l_password, $row['password'])){
                                $user_id = $row['user_id'];
                                $login=true;
                                session_start();
                                $_SESSION['login'] = true;
                                $_SESSION['username'] = $l_username;
                                $_SESSION['user_id'] = $user_id;
                                // header("location:/OnlineForum/partials/test.php?user=$user_id");
                                header("location:/OnlineForum/index.php");
                            }
                            else{
                                $login=false;
                                $showError="You have entered a wrong password.";
                                header("location:/OnlineForum/index.php?login=$login&err=$showError");                   
                            }
                        }
                    }  
                    else{
                        $isusernameexist=false;
                        $login=false;
                        $showError="Username does not exist.";
                        header("location:/OnlineForum/index.php?login=$login&err=$showError");
                    }
            break;
        }
    }
    ?>
    <!-- Signup Modal -->
<div class="modal fade" id="signupModal" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup to iTalk Community</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php $_SERVER['REQUEST_URI']?>">
                    <input type="hidden" name="action" value="signup">
                    <div class="mb-3">
                        <label for="signupusername" class="form-label" autocomplete>Username:</label>
                        <input type="text" class="form-control" id="signupusername" name="signupusername" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" name="signupemail" id="signupemail" placeholder="name@example.com"
                            aria-describedby="emailHelp" autocomplete>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="signuppassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="signuppassword" id="signuppassword"
                            placeholder="Password" autocomplete>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword"
                            placeholder="Confirm Password" autocomplete>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Signup</button>
            </div>
            </form>
        </div>
    </div>
</div>
    <!-- Login Modal -->
<div class="modal fade" id="loginModal" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iTalk Community</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php $_SERVER['REQUEST_URI']?>">
                    <input type="hidden" name="action" value="login">
                    <div class="mb-3">
                        <label for="loginusername" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="loginusername" name="loginusername" autocomplete>
                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="loginpassword" id="loginpassword" autocomplete>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="../app.js"></script>
</body>
</html>
