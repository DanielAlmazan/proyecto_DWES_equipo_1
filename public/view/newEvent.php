<?php
session_start();
$pageTitle = "Add Event";
require_once("header.php");
?>
<main>
    <form action="">
        <label>
            Name
            <input type="text" name="name" id="name" placeholder="Enter the event's name">
        </label>
    </form>
</main>

<?php
require_once('footer.php');
?>