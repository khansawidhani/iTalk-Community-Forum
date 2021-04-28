<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/OnlineForum/partials/css/sidenav.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid main">
        <section class="side-slider" id="side_nav">
            <a class="d-flex items-center" href="/OnlineForum/index.php"><i class="fas fa-home"></i><span>
                    Home</span></a>
            <a class="d-flex items-center" href="/OnlineForum/trending.php"><i class="fab fa-hotjar"></i><span>Trending
                </span></a>
            <button class="d-flex items-center justify-between" id="navDrop"><span class="d-flex items-center"><i
                        class="material-icons">forum</i>Forums</span><i
                    class="material-icons">keyboard_arrow_down</i></button>
            <div class="dropdown" id="dropdown" style="display: none;">
                <a class="d-flex items-center" href="/OnlineForum/index.php#categories">All Categories </a>
                <a class="d-flex items-center" href="/OnlineForum/newthreads.php">Lattest Threads</a>
            </div>
            <a class="d-flex items-center" href="/OnlineForum/about.php"><i
                    class="fas fa-address-card"></i><span>About</span></a>
            <a class="d-flex items-center" href="/OnlineForum/contact.php"><i
                    class="material-icons">contact_page</i><span>Contact</span></a>
        </section>
        <script>
        
    
        console.log("test");
        </script>
        <script src="../app.js"></script>
</body>

</html>