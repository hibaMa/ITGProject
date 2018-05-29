<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/28/2018
 * Time: 2:35 PM
 */

function addImage(){
    if(isset($_POST['name']) && isset($_FILES['img'])){
        $error=$_FILES['img']['error'];
        if($error) redirect("form.php?error=" .  $error);
        if($_POST['name'].trim("")=="" || $_FILES['img']["size"]==0){
            redirect("form.php?error=" ."fill all spaces");
        }else{
            $fileInfo["name"]=$_POST['name'];
            $img=$_FILES['img'];
            $temp=$img['tmp_name'];
            $type=strtolower(end(explode('.',$img['name'])));
            $new_filename = uniqid('', true) . '.' . $type;
            $fileToUpload="images/" . $new_filename;;
            if($img['size']>500000){
                redirect("form.php?error=" ."large file");
            }
            $allowed = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($type, $allowed)) {
                if(move_uploaded_file($temp,$fileToUpload)){
                    $fileInfo["img"]=$fileToUpload;
                    $result=addImage_db($fileInfo);
                    if(!$result){
                        redirect("form.php?goodSMS=added successfully");
                    }else{
                        redirect("form.php?error=" . $result);
                    }
                }else{
                    redirect("form.php?error=" .  "failed to upload ");
                }
            }else  redirect("form.php?error=" . "wrong file type!");
        }
    }else{
        redirect("form.php?error=" . "error");
    }
}

?>