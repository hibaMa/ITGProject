<?php
include_once "header.php";
?>
<div class="container">
    <h1 class="regTitle">Registration Form</h1>
    <form action="controller.php?action=register" method="post" enctype="multipart/form-data">
        <div> first name : <input name="Fname" type="text"/></div>
        <div>last name  : <input name="Lname" type="text"/></div>
        <div>Email : <input name="email" type="text" class="regEmail"/></div>
        <div>Password : <input name="pass" type="password"/></div>
        <div>city :
            <select name="city" id="">
                <option value="nablus">nablus</option>
                <option value="hebron">hebron</option>
                <option value="yafa">yafa</option>
            </select></div>
        <div>Birth Date :<input type="date" name="Birth" class="birth"></div>
        <div>
            Gender:
            <lable class="mailLable">Mail<input type="radio" name="gender" value="Mail" checked /></lable>
            <lable>Female<input type="radio" name="gender" value="Female"/></lable>
        </div>
        <div>image :<input type="file" name="userImg"></div>
        <div class="buttonDiv">
            <input type="submit" value="regester" class="button regBtn">
            <a  href="signIn.php" class="button">signIn</a>
        </div>
    </form>
</div>


