<?php
include_once "header.php";
?>
<div class="container">
    <h1 class="signTitle">Sign in Form</h1>
    <form action="controller.php?action=signIn" method="post">
        <div>Email : <input name="email" type="text" class="signEmail"/></div>
        <div>Password : <input name="pass" type="password"/></div>
        <div><input type="submit" value="signIn" class="button regBtn">
    </form>
</div>
