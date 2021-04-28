<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/libraries/slick-1.8.1/slick/slick.css">
    <link rel="stylesheet" href="assets/libraries/fontawesome-free-5.15.2-web/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Proza+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="partials/css/partials.css?v=<?php echo time(); ?>">
    <title>Contact Us | iTalk Community Forum</title>
</head>

<body>
    <?php require "partials/_header.php";?>
    <div class="main-container">
        <?php require "partials/_sidenav.php"?>
        <div class="_main" id="main">
            <!-- <div class="heading-c">
                <div class="heading-text">

                    <h1>We would love to hear from You</h1>
                </div>
            </div> -->
            <div class="container-fluid d-flex">
                
                <div class="flex-1 p-5">
                    <h1>We would love to hear from You</h1>
                    <p>Hve any question? We would love to hear from you. Please Drop us a line.</p>
                    <form method="POST" action="<?php echo $_SERVER['REQUEST_URI'];  ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name:</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject:</label><em> Max 40-characters</em>
                            <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea class="form-control" id="message" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="verification" class="form-label">Human Verification:</label>
                            <!-- <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp"> -->
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="submit" class="btn btn-primary">Reset Fields</button>
                        
                    </form>
                </div>
                <div class="flex-1 d-flex justify-content-center align-items-center flex-column">
                    <div class="social-c d-flex flex-column">
                        <h1>Get in touch:</h1>
                        <div><i class="fas fa-phone-alt p-3"></i><span>+92-330-1234567</span></div>
                        <div><i class="far fa-envelope p-3"></i><span>support@italk.com</span></div>
                        <div><i class="fas fa-map-marker-alt p-3"></i><span>1806, Bella Street. Lahore, Pakistan</span></div>
                        <!-- <div id="map"></div> -->
                    </div>
                </div>
            </div>

        </div><!-- _main ended -->
    </div><!-- main ended -->
    </div> <!-- main-container ended -->
    <?php require "partials/_footer.php"; ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=&v=weekly" async></script>
    <script src="app.js"></script>
    <script src="assets/libraries/jquery-3.5.1.min.js"></script>
    <script src="assets/libraries/slick-1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
        integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
        integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous">
    </script>

</body>

</html>