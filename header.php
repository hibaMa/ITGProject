<?php
if(isset($_GET['goodSMS'])){
    echo "<div class='goodSMS SMS'>". "Done!".$_GET['goodSMS']."<br><br></div>";
}
if(isset($_GET['error'])){
    echo "<div class='errorSMS SMS'>"."Error!".$_GET['error']."<br><br></div>";
}
include_once "controller.php";
?>
<link rel="stylesheet"  href="form.css" >