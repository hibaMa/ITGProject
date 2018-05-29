<?php

function connect_db()
{
    $server = "localhost";
    $dbuser = "root";
    $dbpass = "123456";
    $dbname = "test";

    $conn = new mysqli($server, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        return false;
    } else {
        return $conn;
    }

}

function addImage_db($fileInfo){
    $conn = connect_db();
    $prepare = $conn->prepare('INSERT INTO `testtable`(`id`, `img`, `name`) VALUES (null,?,?)');
    $prepare->bind_param('ss',$fileInfo['name'],$fileInfo['img']);
    $prepare->execute();
    if (!$prepare->errno) {
        return false;
    } else return $prepare->errno;

}

function regester_db($userInfo){

    $conn = connect_db();
    $prepare = $conn->prepare('INSERT INTO `user`(`id`, `first_name`, `last_name`, `city`, `email`, `pass`, `gender`, `img`, `Birth`) VALUES (null,?,?,?,?,?,?,?,?)');
    $prepare->bind_param('ssssssss',$userInfo['fname'],$userInfo['lname'], $userInfo["city"],$userInfo["email"], $userInfo["pass"], $userInfo["gender"],$userInfo["img"],$userInfo["Birth"]);
    $prepare->execute();
    if (!$prepare->errno) {
        return false;
    } else return $prepare->errno;

}

function signIn_db($userInfo){
    $conn = connect_db();
    $prepare = $conn->prepare('SELECT * FROM `user` WHERE `email`=? AND `pass`=?');
    $prepare->bind_param('ss',$userInfo["email"], $userInfo["pass"]);
    $prepare->execute();
    if (!$prepare->errno) {
        $result = $prepare->get_result();
        return $result->num_rows;
    } else return false;
}

function  updateUserInfo_db($userInfo){
    $conn = connect_db();
    $prepare = $conn->prepare('UPDATE `user` SET `first_name`=?, `last_name`=?, `city`=?, `gender`=?, `img`=?, `Birth`=? WHERE `email`=?');
    $prepare->bind_param('sssssss',$userInfo['fname'],$userInfo['lname'], $userInfo["city"], $userInfo["gender"],$userInfo["img"],$userInfo["Birth"],$userInfo["email"]);
    $prepare->execute();
    if (!$prepare->errno) {
        return false;
    } else return "error".$prepare->errno;
}

function getUserByEmail_db($email){
    $conn = connect_db();
    $prepare = $conn->prepare('SELECT * FROM `user` WHERE `email`=?');
    $prepare->bind_param('s',$email);
    $prepare->execute();
    if (!$prepare->errno) {
        $result=$prepare->get_result();
        return $result->fetch_assoc();
    } else return "error".$prepare->errno;
}
?>
