<?php
require 'Router.php';

$router = new Router();

$router->add('/', function () {
    header('Location: /view/home.php');
});
$router->add('/home', function () {
    header('Location: /view/home.php');
});
$router->add('/about', function () {
    header('Location: /view/about.php');
});
$router->add('/login', function () {
    header('Location: /view/login.php');
});
$router->add('/register', function () {
    header('Location: /view/register.php');
});
$router->add('/species', function () {
    header('Location: /view/our_species.php');
});
$router->add('/contact', function () {
    header('Location: /view/contact.php');
});
$router->add('/achievements', function () {
    header('Location: /view/achievements.php');
});
$router->add('/blog', function () {
    header('Location: /view/blog.php');
});

$router->run();
?>
