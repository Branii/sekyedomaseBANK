

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

//$groupname=clean($_POST['groupName']);
$groupid=clean($_POST['groupId']);
//$shid=clean($_POST['shId']);
//echo 'shid '.$shid;
//echo 'groupid '.$groupid;

$activity=clean($_POST['activity']);

switch ($activity) {
    case 'update':
        # code...
        updadate();
        break;
    case 'insert':
        # code...
        insert();
        break;
    default:
        # code...
        break;
}
function updadate(){
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "shareholdersmgtdb";
    $prefix = "";
    $link = @mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

    if (!$link) {
        die('Connect Error: ' . mysqli_connect_error());
    }
    $groupname=clean($_POST['groupName']);
    $groupid=clean($_POST['groupId']);

    $nii = mysqli_query($link,"UPDATE shgroup SET shGroupName='$groupname' WHERE idShGroup='$groupid'")or die(mysqli_error($link));
    if($nii==1) {
        $try = mysqli_query($link, "DELETE FROM shareholder_shgroup WHERE shGroupId='$groupid'") or die (mysqli_error($link));
        if ($try == 1) {
            $result = mysqli_query($link, "SELECT idShGroup FROM shgroup WHERE idShGroup='$groupid'ORDER BY idShGroup desc LIMIT 1");

            $row = mysqli_fetch_array($result);
            $shGroupId = $row['idShGroup'];
            echo $shGroupId;
        } else {
            echo "ERROR";
        }
    }
}


function insert(){
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "shareholdersmgtdb";
    $prefix = "";
    $link = @mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

    if (!$link) {
        die('Connect Error: ' . mysqli_connect_error());
    }
    $groupid=clean($_POST['groupId']);
    $shid=clean($_POST['shId']);

    mysqli_query($link,"INSERT INTO shareholder_shgroup(shareholderId,shGroupId)VALUES ('$shid','$groupid')")or die(mysqli_error($link));
    //echo "insected successful";
}

function endsave(){
    $pollid=clean($_POST['groupid']);
    $action=clean($_POST['c']);

    if($action == "continue") {
        echo "hello";
       // header('location:editpolldetails.php?pollid='.urldecode($pollid));
        exit();
    }else{
       // header('Location:polls.php?alertfailure='.urldecode("Error in Poll Creation"));
        exit();
    }

}