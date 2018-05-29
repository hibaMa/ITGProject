<?php
session_start();
function regester(){
    if(isset($_POST["Fname"]) && isset($_POST["city"]) && isset($_POST["pass"])&&
        isset($_POST["Lname"]) && isset($_POST["email"]) && isset($_POST["Birth"])){

        if($_POST["Fname"].trim(" ")=="" ||  $_POST["pass"].trim(" ")=="" ||
           $_POST["Lname"].trim(" ")=="" || $_POST["email"].trim(" ")==""|| $_POST["Birth"].trim(" ")=="") {

            redirect("register.php?error=" . "fill all spaces");
        }

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            redirect("register.php?error=" . "invalid email");

        }

        $userInfo["img"]=uploadUserImage("register.php");
        $userInfo["fname"]=$_POST["Fname"];
        $userInfo["lname"]=$_POST["Lname"];
        $userInfo["city"]=$_POST["city"];
        $userInfo["email"]=$_POST["email"];
        $userInfo["pass"]=sha1($_POST["pass"]);
        $userInfo["gender"]=$_POST["gender"];
        $userInfo["Birth"]=$_POST["Birth"];

        $result=regester_db($userInfo);
        if($result){
            redirect("register.php?error=adding " . $result);
        }else{
            redirect("register.php?goodSMS=added successfully");
        }

    }
    else redirect("register.php?error=" .  "setError");



}

function signIn(){
    if(isset($_POST["pass"])&& isset($_POST["email"])){
        if($_POST["pass"].trim(" ")=="" || $_POST["email"].trim(" ")=="") {
            redirect("signIn.php?error=" . "fill all spaces");
        }
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            redirect("signIn.php?error=" . "invalid email");
        }

        $userInfo["email"]=$_POST["email"];
        $userInfo["pass"]=sha1($_POST["pass"]);

        $result=signIn_db($userInfo);
        if(!$result){
            redirect("signIn.php?error=wrong email or password");
        }else{
            $_SESSION['user']=$userInfo["email"];
            redirect("updateUserInfo.php?goodSMS=welcome&userEmail=".$_POST["email"]);
        }
    }
    else redirect("signIn.php?error=" .  "error");
}

function signOut(){
    session_unset();
    session_destroy();
    redirect("welcome.php");
}

function uploadUserImage($page){
    if(isset($_FILES['userImg'])){
        $error=$_FILES['userImg']['error'];
        if($error) redirect($page."?error=File error" .  $error."&userEmail=".$_GET["userEmail"]);
        if($_FILES['userImg']["size"]==0){
            redirect($page."?error=" ."fill all spaces"."&userEmail=".$_GET["userEmail"]);
        }else{
            $img=$_FILES['userImg'];
            $temp=$img['tmp_name'];
            $type=strtolower(end(explode('.',$img['name'])));
            $new_filename = uniqid('', true) . '.' . $type;
            $fileToUpload="UserImages/" . $new_filename;;
            if($img['size']>500000){
                redirect($page."?error=" ."large file"."&userEmail=".$_GET["userEmail"]);
            }
            $allowed = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($type, $allowed)) {
                if(move_uploaded_file($temp,$fileToUpload)){
                    return $fileToUpload;
                }else{
                    redirect($page."?error=" .  "failed to upload "."&userEmail=".$_GET["userEmail"]);
                }
            }else  redirect($page."?error=" . "wrong file type!"."&userEmail=".$_GET["userEmail"]);
        }
    }else{
        redirect($page."?error=" . "setImageError"."&userEmail=".$_GET["userEmail"]);
    }
}

function update(){
    if(isset($_POST["Fname"]) && isset($_POST["city"])&&
        isset($_POST["Lname"]) && isset($_GET["userEmail"]) && isset($_POST["Birth"])){

        if($_POST["Fname"].trim(" ")=="" || $_POST["Lname"].trim(" ")=="" ||
            $_GET["userEmail"].trim(" ")==""|| $_POST["Birth"].trim(" ")=="") {
            redirect("updateUserInfo.php?error=" . "fill all spaces"."&userEmail=".$_GET["userEmail"]);
        }

        if (!filter_var($_GET["userEmail"], FILTER_VALIDATE_EMAIL)) {
            redirect("updateUserInfo.php?error=" . "invalid email"."&userEmail=".$_GET["userEmail"]);
        }

        $userInfo["img"]=uploadUserImage("updateUserInfo.php");
        $userInfo["fname"]=$_POST["Fname"];
        $userInfo["lname"]=$_POST["Lname"];
        $userInfo["city"]=$_POST["city"];
        $userInfo["gender"]=$_POST["gender"];
        $userInfo["Birth"]=$_POST["Birth"];
        $userInfo["email"]=$_GET["userEmail"];

        $result=updateUserInfo_db($userInfo);
        if(!$result){
            redirect("updateUserInfo.php?goodSMS=updated successfully"."&userEmail=".$_GET["userEmail"]);
        }else{
            redirect("updateUserInfo.php?error=adding " . $result."&userEmail=".$_GET["userEmail"]);
        }
    }
    else redirect("updateUserInfo.php?error=" .  "make sure to fill all spaces set"."&userEmail=".$_GET["userEmail"]);

}

function getUserByEmail($email){
    return getUserByEmail_db($email);
}
?>
