<?php
    include "partials/_dbconnect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTalk Community Forum </title>
    <!-- bootstrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!--font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- google fonts links -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&family=Lato:wght@700&family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- material icons library link -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- custom css files  -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php require "partials/_header.php";?>
    <div class="main-container">
        <?php require "partials/_sidenav.php"?>

        <div class="_main" id="main">
            <div class="heading">
            <!-- errors definations for login and signup -->
                <?php 
                if(isset($_GET['login']) && $_GET['login'] == false){
                    $error= $_GET['err'];
                echo'<div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong>Error! </strong> '.$error.' Try again
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';}
                if(isset($_GET['login']) && $_GET['login'] == true){
                echo'<div class="alert alert-success alert-dismissible show" role="alert">
                    <strong>Success! </strong> Login Successful...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';}
                if(isset($_GET['register']) && $_GET['register'] == false){
                $error= $_GET['err'];
                echo'<div class="alert alert-danger alert-dismissible show" role="alert">
                    <strong>Error! </strong> '.$error.' Try again
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';}
                if(isset($_GET['register']) && $_GET['register'] == true){
                echo'<div class="alert alert-success alert-dismissible show" role="alert">
                    <strong>Success! </strong> Your account has been created successfully...
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';}?>
            <!-- home section starts from here -->
                <div class="heading-text">
                    <h1>iTalk Community Forum</h1>
                    <p>We love the people who code, this is the place made for coders to discuss programming related
                        issues and
                        errors.</p>
                    <form action="" class="d-flex items-center justify-center">
                        <div class="d-flex items-center"><span><i class="fas fa-search"></i></span><input type="search"
                                placeholder="search here">
                        </div>
                    </form>
                </div>
            </div> 
            <!-- Heading section ended -->
             <!--  -->
            <!-- categories body starts from here -->
            <div class="container-fluid">
                <div class="categories" id="categories">
                    <h1 class="text-prime text-center"> Browse Categories </h1>
                    <div class="wrapper">
                    <?php 
                    $sql = "SELECT * FROM `categories`";
                    $res = mysqli_query($conn, $sql);
                    if($res){
                        while($row = mysqli_fetch_assoc($res)){
                            $catId = $row['category_id'];
                            $catName = $row['category_name'];
                            $catDesc = $row['category_description'];
                            $cat_img = $row['category_img'];
                            if(strlen($catDesc) >= 80){
                                $catDesc = substr($catDesc, 0, 80)."<strong>...</strong>";
                            }                                  
                            echo'
                            <div class="category">
                                <div class="cat-img">
                                    <img src="'.$cat_img.'" alt="">
                                </div>
                                <div class="cat-body">
                                    <h5><a href="/OnlineForum/_threadlist.html?catid='.$catId.'"> '.$catName.'</a></h5>
                                    <p>' .$catDesc.'</p>
                                    <a class="btn" href="/OnlineForum/_threadlist.php?catid='.$catId.'">browse questions</a>
                                </div>
                            </div>   
                            ';
                            }}?>
                    </div>
                </div>
            </div> 
            <!-- categories section ended -->
        </div> 
        <!-- main section ended -->
    </div>
    </div> <!-- main-container ended -->
    <?php require "partials/_footer.php"; ?>

    <!-- custom script file -->
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