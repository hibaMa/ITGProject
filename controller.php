<?php
include_once "model.php";
include_once "userFun.php";
include_once "formFun.php";
if(isset($_GET['action'])){
    $action=$_GET['action'];
    switch($action) {
        case "addImage":
            addImage();
            break;
        case "signIn":
            signIn();
            break;
        case "register":
             regester();
            break;
        case "update":
            update();
            break;
        case "signOut":
            signOut();
            break;
    }
}

function redirect($url){
    header('Location: '.$url, true,'302');
    exit();
}

?>