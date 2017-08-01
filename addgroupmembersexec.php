<?php 
session_start();
//global $activity;

function clean($str) {
        include('../db.php');
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }


    $groupid=clean($_POST['groupId']);
    $shid=clean($_POST['shId']);
    //echo 'shid '.$shid;
     //echo 'groupid '.$groupid;

    include('../db.php');

    //$groupid=3;
    //$shid=2;

    $result1 = mysqli_query($link, "SELECT * FROM shareholder_shGroup WHERE shareholderId = '$shid' AND shGroupId = '$groupid' ");
    if(mysqli_num_rows($result1) < 1)
    {

     $update = mysqli_query($link, "INSERT INTO shareholder_shGroup (shareholderId, shGroupId) VALUES ('$shid','$groupid')");
        //header("location: ../index.php");
        //echo $update;
    }
    //echo "done";



                                

?>