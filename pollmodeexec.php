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

$mode=clean($_POST['radio']);

if($mode == "position_based")
{
	header('location: positionbasedpoll.php');
}
else if($mode == "motion_based")
{
    header('location: motionbasedpoll.php');
}


?>
