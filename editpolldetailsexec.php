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
include('../db.php');
$electoratesize=$_POST['electoratesize'];
$electorategroup=$_POST['radio'];
$shGroupName=$_POST['shGroupName'];
$startdatetime=$_POST['startdatetime'];
$closedatetime=$_POST['closedatetime'];
$pollid=clean($_POST['pollid']);

echo $startdatetime."<br/>";
echo $closedatetime."<br/>";
echo $electoratesize."<br/>";
echo $electorategroup."<br/>";
echo $pollid."<br/>";

$currentUserId = $_SESSION['SESS_MEMBER_ID'];

$update=mysqli_query($link, "UPDATE poll SET pollStartDateTime = '$startdatetime' , pollCloseDateTime = '$closedatetime',pollElectorateGroup='$electorategroup', pollStatus='new' WHERE idpoll = '$pollid'")or die(mysqli_error($link));
//header("location: ../index.php");
//$update=1;
echo $update;
if($update == 1)
{
    header('Location:polls.php?alertisuccess='.urldecode("Poll Updated"));
    exit();
}
else
    {
echo "ERROR";
 header('Location:polls.php');
        exit();
    }
?>
