<?php
//Start session
session_start();
include('../db.php');
//$user_roleId = $_POST['user_roleId'];

function clean($str) {
    include('../db.php');
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysqli_real_escape_string($link, $str);
}
$userid = $_GET['userid'];
$surname=clean($_POST['lastname']);
$firstname=clean($_POST['firstname']);
$address=clean($_POST['address']);
$gender=clean($_POST['gender']);
$phone=clean($_POST['phone']);
$email=clean($_POST['email']);



$user_roleId=$_POST['userRoleId'];
$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "UPDATE user SET userSurname = '$surname', userFirstName='$firstname', userEmail='$email', userGender='$gender', userAddress='$address', userPhone='$phone' WHERE idUser = '$userid'");


//header("location: ../index.php");
echo $update;
if($update == 1)
{

    header('location: users.php?alertsuccess='.urldecode("success"));
}
else{echo "ERROR";}
?>
