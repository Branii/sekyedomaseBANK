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

$bankname=clean($_POST['bankname']);
$branch=clean($_POST['branch']);
$accountnumber=clean($_POST['accountnumber']);
$shareholderId=$_POST['shareholderId'];

$update=mysqli_query($link, "INSERT INTO shareholderPaymentAlternative (shareholderPaymentAlternativeBankName, shareholderPaymentAlternativeBranch, shareholderPaymentAlternativeAccountNumber, shareholder_idshareholder)
VALUES
('$bankname','$branch','$accountnumber','$shareholderId')");
//header("location: index.php");

if($update == 1)
{
	//header("location: addshareholdersuccess.php");
    $result = mysqli_query($link, "SELECT * FROM shareholder WHERE idshareholder = '$shareholderId'");
     while($row = mysqli_fetch_array($result))
        {
            $shareholderSerialNo = $row['shareholderSerialNo'];
             header('location: shareholder_photo/index.php?shareholderSerialNo='.urldecode($shareholderSerialNo));
        }
   // header('location: crop_photo/index.php?shareholderid='.urldecode($shareholderId));
    
}
else{    
   //echo $update;
   header('location: shareholder_photo/index.php?shareholderSerialNo='.urldecode($shareholderSerialNo));
}
?>
