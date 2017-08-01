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

//$electoratesize=clean($_POST['electoratesize']);
$electorategroup=clean($_POST['radio']);
$shGroupName=clean($_POST['shGroupName']);
$startdatetime=clean($_POST['startdatetime']);
$closedatetime=clean($_POST['closedatetime']);
$pollid=clean($_POST['pollid']);


$currentUserId = $_SESSION['SESS_MEMBER_ID'];

$update=mysqli_query($link, "UPDATE poll SET pollStartDateTime = '$startdatetime' , pollCloseDateTime = '$closedatetime', pollElectorateGroup='$electorategroup', pollStatus='new' WHERE idpoll = '$pollid'");
//header("location: ../index.php");
//echo $update;
if($update == 1)
{
    header('Location:polls.php?alertsuccess='.urldecode("Poll Created"));
    exit();     
}
else
    {
        echo "ERROR";
        header('Location:polls.php?alertfailure='.urldecode("Poll Not Created"));
        exit(); 
    }
?>
