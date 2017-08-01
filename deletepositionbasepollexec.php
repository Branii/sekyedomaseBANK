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
$pollId = $_GET['pollId'];
?>
<script>
   // alert('<?php// echo $pollId; ?>');
</script>
<?php
// delete participant

$currentUserId = $_SESSION['SESS_MEMBER_ID'];
$update=mysqli_query($link, "DELETE FROM poll WHERE idpoll ='$pollId'");
$update=mysqli_query($link, "DELETE FROM positionbasedpoll WHERE pollId ='$pollId'");
//$update=mysqli_query($link, "DELETE FROM positionbasedpoll WHERE pollId ='$pollId'");




//header("location: ../index.php");
echo $update;
if($update == 1)
{
    $update1=mysqli_query($link, "DELETE FROM poll WHERE idpoll ='$pollId'");
    if($update1 == 1)
    {
       header('location: polls.php?alertmysuccess='.urldecode("success"));
    }else{
        header('location: polls.php?alertmyfailure='.urldecode("success"));
    }

}
else{echo "ERROR";}
?>
