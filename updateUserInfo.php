<?php
include_once "header.php";

if( isset($_SESSION['user'])){
    if( isset($_GET['userEmail'])) {
        $userInfo = getUserByEmail($_GET['userEmail']);
    }
?>
<div class="container">
    <form action="controller.php?action=update&userEmail=<?php echo $_GET['userEmail']?>" method="post" enctype="multipart/form-data">
        <div><img src="<?php echo $userInfo["img"]?>" width="100px" height="100px"></div>
        <div> first name : <input name="Fname" type="text" value="<?php echo $userInfo["first_name"]?>"/></div>
        <div>last name  : <input name="Lname" type="text"  value="<?php echo $userInfo["last_name"]?>"/></div>
        <div>city :
            <select name="city" id="" >
                <option value="nablus" <?php if($userInfo["city"]=="nablus")echo "selected"; ?>>nablus</option>
                <option value="hebron" <?php if($userInfo["city"]=="hebron")echo "selected"; ?>>hebron</option>
                <option value="yafa" <?php if($userInfo["city"]=="yafa")echo "selected"; ?>>yafa</option>
            </select></div>
        <div>
            Gender:
            <span class="gender">
            <label>Mail<input type="radio" name="gender" value="Mail" <?php if($userInfo["gender"]=="Mail")echo "checked"; ?>/></label>
            <label>Female<input type="radio" name="gender" value="Female"  <?php if($userInfo["gender"]=="Female")echo "checked"; ?>/></label>
            </span>
        </div>
        <div>image :<input type="file" name="userImg"></div>
        <div>Birth Date :<input type="date" name="Birth" value="<?php echo $userInfo["Birth"]?>"></div>
        <div>
            <input type="submit" value="update" class="button regBtn">
            <a href="controller.php?action=signOut" class="button">signOut</a>
        </div>
    </form>
</div>
<?php
}else redirect("signIn.php");
?>