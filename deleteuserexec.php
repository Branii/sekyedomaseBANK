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
$userId=$_GET['userId'];

// delete first from group, position-based poll, shareholder authentication, share transactions, next of kin and payment alternative tables


$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "DELETE FROM user WHERE idUser ='$userId'");





//header("location: ../index.php");
echo $update;
if($update == 1)
{
    $update1=mysqli_query($link, "DELETE FROM user WHERE idUser ='$userId'");
    if($update1 == 1)
    {
        header('location: users.php?alertdeletesuccess='.urldecode("success"));
    }

}
else{echo "ERROR";}
?>
