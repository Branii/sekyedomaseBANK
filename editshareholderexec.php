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
$shareholderId=$_POST['shareholderid'];
$surname=clean($_POST['lastname']);
$othernames=clean($_POST['othernames']);
$title=clean($_POST['title']);
$gender=clean($_POST['gender']);
$houseno=clean($_POST['houseno']);
$city=clean($_POST['city']);
$phone=clean($_POST['phone']);
$branch=clean($_POST['branch']);
$email=clean($_POST['email']);
$password1=clean($_POST['password']);

$noksurname=clean($_POST['noklastname']);
$nokothernames=clean($_POST['nokothernames']);
$nokaddress=clean($_POST['address']);
$nokcity=clean($_POST['city']);


$pabankname=clean($_POST['bankname']);
$pabranch=clean($_POST['pabranch']);
$paaccountnumber=clean($_POST['accountnumber']);



$user_roleId=$_POST['userRoleId'];
$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "UPDATE shareholder SET shareholderSurname = '$surname', shareholderOtherNames='$othernames', shareholderTitle='$title', shareholderGender='$gender', shareholderHouseNo='$houseno', shareholderCity='$city', shareholderPhone='$phone', shareholderBranch='$branch', shareholderEmail='$email' WHERE idshareholder = '$shareholderId'");





//header("location: ../index.php");
echo $update;
if($update == 1)
{
    $update1=mysqli_query($link, "UPDATE shareholdernextofkin SET shareholderNextOfKinSurname = '$noksurname', shareholderNextOfKinOtherNames='$nokothernames', shareholderNextOfKinAddress='$nokaddress', shareholderNextOfKinCity='$nokcity' WHERE shareholder_idshareholder = '$shareholderId'");
            if($update1 == 1)
            {
               $update2=mysqli_query($link, "UPDATE shareholderpaymentalternative SET shareholderPaymentAlternativeBankName = '$pabankname', shareholderPaymentAlternativeBranch='$pabranch', shareholderPaymentAlternativeAccountNumber='$paaccountnumber' WHERE shareholder_idshareholder = '$shareholderId'");
            
                if($update2 == 1)
                {
                  header('location: shareholders.php?alertsuccess='.urldecode("success"));
                }
        	}	
}
else{echo "ERROR";}
?>
