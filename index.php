<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <title>Hirapara Associates</title>

    <!-- Favicon -->
    <link href="" rel="icon" />

    <!-- Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- google icons Files -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- fontawesome 5 Link-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fontawesome_5/fontawesome.min.css"
    />

    <!-- google fonts Files -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />

    <!-- slick slider CSS Files -->
    <link href="css/slick.css" rel="stylesheet" />
    <link href="css/slick-theme.css" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/animate.css" />
  </head>
  <body>
    <!-- header section -->
    <?php require_once('layout/header.php') ?>
    <!-- Banner section -->
   <?php require_once('layout/banner.php') ?>
   
   <!-- who we are section start section -->
   <?php require_once('layout/whowearesection.php') ?>
   <?php require_once('layout/founder.php') ?>
   <?php require_once('layout/practice.php') ?>
   
   <?php require_once('layout/contact.php') ?>
   <?php require_once('layout/footer.php') ?>

    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Additional Javascript -->
    <script src="js/custom.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/client-slick.js"></script>
    <script type="text/javascript" src="fontawesome_5/all.min.js"></script>
    <script
      type="text/javascript"
      src="fontawesome_5/fontawesome.min.js"
    ></script>
    <script src="js/wow.min.js"></script>

    <script>
      new WOW().init();
    </script>
    <script>
      jQuery("#banner-slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3500,
        pauseOnHover: false,
        dots: true,
      });
    </script>
  </body>
</html>
