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

$groupname=clean($_POST['groupname']);

// check if group name is unique  
$result = mysqli_query($link, "SELECT * FROM shGroup WHERE shGroupName = '$groupname'");
    if(mysqli_num_rows($result) < 1)
    {
        $update=mysqli_query($link, "INSERT INTO shGroup (shGroupName) VALUES ('$groupname')");
        //header("location: ../index.php");
        echo $update;
        if($update == 1)
        {
            $result1 = mysqli_query($link, "SELECT idShGroup FROM shGroup WHERE shGroupName = '$groupname'");
             while($row1 = mysqli_fetch_array($result1))
                {
                    $shgroupid = $row1['idShGroup'];
                    echo $shgroupid;
                    header('location: addshareholdergroup.php?shgroupid='.urldecode($shgroupid));
                }
            
        }
        else{echo "ERROR";}
    }
      else{echo "group name already exists";}


?>
