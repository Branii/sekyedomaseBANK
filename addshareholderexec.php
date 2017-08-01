<?php
//Start session
    session_start();
include('../db.php');
include('../emailing_module/sendmail.php');
//$user_roleId = $_POST['user_roleId'];

function clean($str) {
   // include('../emailing_module/sendmail.php');
        include('../db.php');
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }


$surname=clean($_POST['lastname']);
$othernames=clean($_POST['othernames']);
$title=clean($_POST['title']);
$gender=clean($_POST['gender']);
$houseno=clean($_POST['houseno']);
$city=clean($_POST['city']);
$phone=clean($_POST['phone']);
$branch=clean($_POST['branch']);
$email=clean($_POST['email']);
//$password1=clean($_POST['password']);

$fullname = $surname. "" .$othernames;

$password1=str_shuffle("sekyedomaseruralbank");


  //get code from database
    $result3 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_shareholder_code'");
     while($row3 = mysqli_fetch_array($result3))
       {
        $shcode = $row3['generalOptionsValue'];
       }
    //encode password
    $password = crypt($password1, $shcode);


 //autogenerate serial number
 $result = mysqli_query($link, "SELECT * FROM shareholder");
 $num_rows = mysqli_num_rows($result);

 //get serial number prefix  from database
$result2 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'serial_number_prefix'");
 while($row2 = mysqli_fetch_array($result2))
   {
    $prefix = $row2['generalOptionsValue'];
   }
    
    //make serials equal number
 $serialno = $prefix.date("m")."".$num_rows."".date("Y");

 //save default photo
 if($gender == "female")
 {
    $photo =  "photo_DEFAULT_FEMALE.jpg";
}
else{$photo =  "photo_DEFAULT_MALE.jpg";}

$user_roleId=$_POST['userRoleId'];
$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "INSERT INTO shareholder (shareholderSerialNo, shareholderSurname, shareholderOtherNames, shareholderTitle, shareholderGender, shareholderHouseNo, shareholderCity, shareholderPhone, shareholderBranch, shareholderEmail, shareholderPassword, shareholderPhoto, userRole_iduserRole, user_idUser)
VALUES
('$serialno','$surname','$othernames','$title','$gender', '$houseno','$city', '$phone','$branch','$email','$password','$photo','$user_roleId','$currentUserId')");
//header("location: ../index.php");
echo $update;
if($update == 1)
{
	$result = mysqli_query($link, "SELECT idshareholder FROM shareholder WHERE shareholderSerialNo = '$serialno' AND shareholderSurname = '$surname'");
	 while($row = mysqli_fetch_array($result))
        {
            $shareholderid = $row['idshareholder'];
            //echo $shareholderid;
            $update1=mysqli_query($link, "INSERT INTO authentication (systemActivities_idsystemActivities, userInitiated, systemFlags_idsystemFlags)
                VALUES
                ('1','$currentUserId','2')");
            if($update1 == 1)
            {
                $result1 = mysqli_query($link, "SELECT idauthentication FROM authentication ORDER BY idauthentication desc LIMIT 1");
                 while($row1 = mysqli_fetch_array($result1))
                    {
                        $authenticationid = $row1['idauthentication'];

                        $update2=mysqli_query($link, "INSERT INTO authentication_has_shareholder (authentication_idauthentication, shareholder_idshareholder)
                        VALUES
                        ('$authenticationid','$shareholderid')");
                    }
            }

            $date = date("m/d/y G.i:s");

            $subject  =   "Confirmation of your shareholder registration";
            //$message  =   "hello <i>how are you.</i>";
            $name     =   "Sekyedomase Rural Bank";


            $message  = '<html><body>';
            $message  .= '<div class="box" style="border: 3px solid #2F5597; width: 600px;">';
            $message  .= '<h1 style="background:#2F5597; color:#fff; font-size:20px; text-align:center; margin-top:0px; margin-bottom:0px; padding:20px;" >Sekyedomase Rural Bank</h1>';
            $message  .= '<h3 id="date" style="background:#2F5597; color:#fff; font-size:14px; text-align:center; margin-top:0px; padding:5px;" > '.$date.' </h3>';
            $message  .= '<table  class="box" cellpadding="20" align = "center">';
            $message  .= '<tr align = "center"><img src="www.thesheltersfoundation.dreambrander.com/img/small_shelter.jpg" alt="Sekyedomase Rural Bank" style="display: block;" ></tr>';
            $message  .= '<h3 style="background:#2F5597; color:#fff; font-size:14px; text-align:center; margin-top:0px; padding:5px;" >Confirm your shareholder registration</h3>';
            $message  .= '<tr><td style = "color:#391b00; text-align:center;">We ask that you take a minute to confirm that the email <br>address you provide in your shareholder registeration is correct.<br> All you need to do is click on the following link <strong><a href="http://localhost:8009/shareholder_management/index.php">confirm</a></strong><br>Please use the following details to confirm your registration.<br><br><br><strong>Username: '.$email.' </strong><br><strong>Password: '.$password1.'</strong></td></tr>';
            $message  .= '<tr><td style = "color:#391b00; text-align:center;">Click <a href = "http://www.example.com">here</a> to visit the sekyedomase Rural Bank <br> website.</td></tr>';
            $message  .= '</table>';
            $message  .= '</div>';
            $message  .= '</body></html>';

            header('location: addshareholderNOK.php?shareholderid='.urldecode($shareholderid));

            sendmail($email,$subject,$message,$fullname);

            /*if($mailsend==1){
                //echo '<h2>email sent.</h2>';
                // header('Location:http://www.thesheltersfoundation.dreambrander.com/index.php?alertsuccess='.urldecode("Sent"));
                exit();
            }
            else{
                //echo '<h2>There are some issue.</h2>';
                header('Location:http://www.thesheltersfoundation.dreambrander.com/index.php?alertfailure='.urldecode("Error. Please try again"));
                exit();
            }*/

        }
}
else{echo "ERROR";}
?>
