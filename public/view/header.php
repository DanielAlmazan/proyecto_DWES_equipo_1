<?php
    // This array is used as a reference to create the navigation bar
    // It is used to create the $fileNamesAndTitles array and the $faIcons array
    // This is for reducing mistakes
    $fileNames = [
        "home.php",
        "user.php",
        "about.php",
        "blog.php",
        "contact.php",
        "our_species.php",
        "achievements.php",
    ];
    // This array is used to create the navigation bar
    // The key is the filename and the value is the title
    $titles = [
        $fileNames[0] => "Home",
        $fileNames[1] => "User",
        $fileNames[2] => "About",
        $fileNames[3] => "Blog",
        $fileNames[4] => "Contact",
        $fileNames[5] => "Our Species",
        $fileNames[6] => "Achievements",
    ];

    // This array is used to create the icons
    // The key is the title and the value is the icon
    $faIcons = [
        $fileNames[0] => "home",
        $fileNames[1] => "user",
        $fileNames[2] => "bookmark",
        $fileNames[3] => "file-text",
        $fileNames[4] => "phone",
        $fileNames[5] => "tree",
        $fileNames[6] => "trophy"
    ];

    $fileName = basename($_SERVER["PHP_SELF"]);
    if (!isset($pageTitle)) {
        $pageTitle = $titles[$fileName];
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $pageTitle ?></title>

    <!-- Bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../res/bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../res/css/style.css">
    <!-- Magnific-popup css -->
    <link rel="stylesheet" type="text/css" href="../res/css/magnific-popup.css">
    <!-- Font Awesome icons -->
    <link rel="stylesheet" type="text/css" href="../res/font-awesome/css/font-awesome.min.css">
    <!-- Lint to our own stylesheet -->
    <link rel="stylesheet" type="text/css" href="../res/css/ownStyle.css">

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
            <a class="navbar-brand page-scroll" href="home.php">
                <img src="../res/images/logo/logo.JPG" alt="logo">
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
                <?php
                    // This loop will create the navigation bar using the array $fileNamesAndTitles
                    foreach ($titles as $fileName => $title) {
                        // The basename() function returns the filename from a path
                        // If the filename is the same as the current page, then the class "active" is added to the <li> tag
                        $active = $fileName == basename($_SERVER['PHP_SELF']) ? "active" : "";

                        // The $fileName variable is used to create the link
                        // The $title variable is used to create the text inside the <a> tag
                        // The $faIcons array is used to create the icons
                ?>
                <li class='<?=$active?>'><a href='<?=$fileName?>'><i class="sr-icons fa  fa-<?=$faIcons[$fileName]?>"></i> <?=$title?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Navigation Bar -->