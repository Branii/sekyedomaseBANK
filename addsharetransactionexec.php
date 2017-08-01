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

$shareholderId=clean($_POST['shareholderId']);
$datetime=clean($_POST['datetime']);
$shareamount=clean($_POST['shareamount']);

//in future get share price from database
$shareprice = clean($_POST['shareprice']);;


$user_roleId=$_POST['userRoleId'];
$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "INSERT INTO sharetransactionlog (shareTransactionLogDate, shareTransactionLogSharePrice, shareTransactionLogShareAmount, shareholder_idshareholder)
VALUES
('$datetime','$shareprice','$shareamount','$shareholderId')");
//header("location: ../index.php");
echo $update;
if($update == 1)
{
	header('location: sharetransactions.php?shareholderid='.urldecode($shareholderId));	
}
else{echo "ERROR";}
?>
