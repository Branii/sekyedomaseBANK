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
$groupId=$_GET['groupid'];

// delete first group members 


$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "DELETE FROM shareholder_shgroup WHERE shGroupId ='$groupId'");





//header("location: ../index.php");
echo $update;
if($update == 1)
{
    $update1=mysqli_query($link, "DELETE FROM shgroup WHERE idShGroup ='$groupId'");
        if($update1 == 1)
        {
          header('location: shareholdergroups.php?alertdeletesuccess='.urldecode("success"));
        }
        
}
else{echo "ERROR";}
?>
