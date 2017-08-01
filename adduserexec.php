<?php
include('db.php');
//$user_roleId = $_POST['user_roleId'];

function clean($str) {
        include('db.php');
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }

$userSurname=clean($_POST['userSurname']);
$userFirstname=clean($_POST['userFirstname']);
$userEmail=clean($_POST['userEmail']);
$userAddress=clean($_POST['userAddress']);
$userPassword1=clean($_POST['userPassword']);
$userPhone=clean($_POST['userPhone']);

//in future save salt in database
 
 //$salt = "shareholdersmgt2017"; previous admin salt
 $salt = "SRSusersPword2017";
 $userPassword = crypt($userPassword1, $salt);

$user_roleId=$_POST['userRoleId'];
$update=mysqli_query($link, "INSERT INTO user (userFirstname, userSurname, userEmail, userAddress, userPhone, userPassword, userRoleId)
VALUES
('$userFirstname','$userSurname','$userEmail','$userAddress','$userPhone', '$userPassword','$user_roleId')");
header("location: index.php");
//echo $update;
?>
