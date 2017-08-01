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
$firstname=clean($_POST['firstname']);
$gender=clean($_POST['gender']);
$address=clean($_POST['address']);
$phone=clean($_POST['phone']);
//$userroleId=clean($_POST['userroleId']);
$email=clean($_POST['email']);
$password1=clean($_POST['password']);

//in future save salt in database
 //$salt = "SRSusersPword2017";
 //$password = crypt($password1, $salt);

//get code from database
$result1 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_user_code'");
 while($row1 = mysqli_fetch_array($result1))
   {
    $uscode = $row1['generalOptionsValue'];
   }
//encode password
   $password = crypt($password1, $uscode);

 
 //save default photo
 if($gender == "female")
 {
    $photo =  "photo_DEFAULT_FEMALE.jpg";
}
else{$photo =  "photo_DEFAULT_MALE.jpg";}

$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "INSERT INTO user (userFirstName, userSurname, userGender, userEmail, userAddress, userPhone, userPassword, userPhoto, user_idUser)
VALUES
('$firstname','$surname','$gender', '$email','$address', '$phone','$password','$photo', '$currentUserId')");
//header("location: ../index.php");
echo $update;
if($update == 1)
{
	$result = mysqli_query($link, "SELECT idUser FROM user WHERE userEmail = '$email' AND userSurname = '$surname'");
	 while($row = mysqli_fetch_array($result))
        {
        	$userid = $row['idUser'];
            echo $userid;
            header('location: user_photo/index.php?userId='.urldecode($userid));
        }
	
}
else{echo "ERROR";}
?>
