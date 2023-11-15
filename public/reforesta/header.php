<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>PhotographItem-Responsive Theme</title>

  	<!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  	<!-- Bootstrap core css -->
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<!-- Magnific-popup css -->
  	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
  	<!-- Font Awesome icons -->
  	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top">

<!-- Navigation Bar -->
   <nav class="navbar navbar-fixed-top navbar-default">
     <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a  class="navbar-brand page-scroll" href="index.php">
              <img src="images/logo/logo.JPG" alt="logo">
            </a>
         </div>
         <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
              <li class="<?=basename($_SERVER['PHP_SELF']) == "index.php" ? "active": ""?> lien"><a href="index.php"><i class="fa fa-home sr-icons"></i> Home</a></li>
              <li class="<?=basename($_SERVER['PHP_SELF']) == "about.php" ? "active": ""?> lien"><a href="about.php"><i class="fa fa-bookmark sr-icons"></i> About</a></li>
              <li class="<?=basename($_SERVER['PHP_SELF']) == "blog.php" ? "active": ""?> lien"><a href="blog.php"><i class="fa fa-file-text sr-icons"></i> Blog</a></li>
              <li class="<?=basename($_SERVER['PHP_SELF']) == "contact.php" ? "active": ""?> lien"><a href="contact.php"><i class="fa fa-user sr-icons"></i> User</a></li>
              <li class="<?=basename($_SERVER['PHP_SELF']) == "our_species.php" ? "active": ""?> lien"><a href="our_species.php"><i class="fa fa-tree sr-icons"></i> Our Species</a></li>
            </ul>
         </div>
     </div>
   </nav>
<!-- End of Navigation Bar -->