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

$surname=clean($_POST['lastname']);
$othernames=clean($_POST['othernames']);
$address=clean($_POST['address']);
$city=clean($_POST['city']);
$shareholderId=$_POST['shareholderId'];

$update=mysqli_query($link, "INSERT INTO shareholderNextOfKin (shareholderNextOfKinSurname, shareholderNextOfKinOtherNames, shareholderNextOfKinAddress,  shareholderNextOfKinCity, shareholder_idshareholder)
VALUES
('$surname','$othernames','$address','$city','$shareholderId')");
//header("location: index.php");
//echo $update;
if($update == 1)
{
	header('location: addshareholderPA.php?shareholderid='.urldecode($shareholderId));
    
}
else{    
  echo "ERROR: ".$update;
}
?>
