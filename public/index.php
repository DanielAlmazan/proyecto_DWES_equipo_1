<?php

require_once ("./controller/EventController.php");
require_once ("./controller/SpeciesController.php");
require_once ("./controller/UserController.php");


define('VIEWS_PATH', __DIR__ . '/view');
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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
$router->add('add-event', function () {
    header('Location: /view/newEvent.php');
});

$router->run();
require_once ("controller/SpeciesController.php");
?>
