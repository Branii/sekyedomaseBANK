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

$topic=clean($_POST['topic']);
$optioncount=clean($_POST['count']);
$options = array();

/*for($i=0; $i< $optioncount; ++$i )
{
    $options[$i] = clean($_POST['option_'.$i+1]);
}*/

$today = date("Y-m-d H:i:s"); 

$currentUserId = $_SESSION['SESS_MEMBER_ID'];

$update=mysqli_query($link, "INSERT INTO poll (pollDateTimeCreated, pollTitle, pollType, userId)
VALUES
('$today','$topic','motion_based','$currentUserId')");
//header("location: ../index.php");
//echo $update;
if($update == 1)
{
    $result = mysqli_query($link, "SELECT idpoll FROM poll ORDER BY idpoll desc LIMIT 1");
	 $row = mysqli_fetch_array($result);
          $pollid = $row['idpoll'];
     
       
        for($i=0; $i< $optioncount; ++$i )
        {
            $offset = $i+1;
            $options[$i] = clean($_POST['option_'.$offset]);

             $update1=mysqli_query($link, "INSERT INTO motionbasedPoll (motionBasedPollOption, pollId)
             VALUES
             ('$options[$i]','$pollid')");
             //echo $update1;
        }

       if($update1 == 1)
       {
        header('location: polldetails.php?pollid='.urldecode($pollid));
       }    
        else{echo "ERROR";}	
        
	
}
else{echo "ERROR";}
?>
