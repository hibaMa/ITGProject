<?php
include_once "header.php";
?>
<html>
<body>
<?php
if(isset($_SESSION['user'])){
include_once "header.php";
?>
<a href="controller.php?action=signOut">signOut</a>
<form action="controller.php?action=addImage" method="post" enctype="multipart/form-data">
    file name :<input type="text" name="name">
    <br><br>
    file :<input type="file" name="img">
    <br><br>
    <input type="submit" value="submit"/>
</form>
</body>
</html>
<?php
 }else redirect("signIn.php");
?>
