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

$activity=clean($_POST['ACTIVITY']);

switch ($activity) {
    case 'addnewpoll':
        # code...
        addnewpoll();
        break;
    case 'addcandidate':
        # code...
        addcandidate();
        break;
    case 'endsave':
        # code...
        endsave();
        break;

    default:
        # code...
        break;
}


    function addnewpoll(){
    $title=$_POST['title'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $pollid=$_POST['pollid'];
    $today = date("Y-m-d H:i:s");

    $currentUserId = $_SESSION['SESS_MEMBER_ID'];

    include('../db.php');

    $update=mysqli_query($link, "UPDATE poll SET pollTitle='$title',pollStartDateTime = '$start' , pollCloseDateTime = '$end', pollStatus='new' WHERE idpoll = '$pollid'")or die(mysqli_error($link));

    // echo $update;
    if($update == 1)
    {
        $try=mysqli_query($link, "DELETE FROM positionbasedpoll WHERE pollId='$pollid'") or die (mysqli_error($link));
if($try==1){
    //echo "deleted";
        $result = mysqli_query($link, "SELECT idpoll FROM poll ORDER BY idpoll desc LIMIT 1");
        $row = mysqli_fetch_array($result);
        $pollid = $row['idpoll'];
        echo  $pollid;

}
    }
    else{echo "ERROR";}
}


        function addcandidate(){
    $pollid=clean($_POST['pollId']);
    ?>
<!--<script>
    //alert('<?php /*echo $pollid */?>');
</script>-->
<?php
    $shId=clean($_POST['shId']);

    include('../db.php');
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "shareholdersmgtdb";
    $prefix = "";
    $link = @mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

    if (!$link) {
        die('Connect Error: ' . mysqli_connect_error());
    }

$update1=mysqli_query($link, "INSERT INTO positionbasedPoll (pollId, shareholderId)VALUES('$pollid','$shId')") or die(mysqli_error($link));

        if ($update1 == 1) {
            echo "Inserted";
        } else {
            echo "ERROR";
        }

    //}
}

        function endsave(){
            $pollid=clean($_POST['pollId']);
            $action=clean($_POST['c']);

            if($action == "continue") {
                echo "hello";
        header('location:editpolldetails.php?pollid='.urldecode($pollid));
        exit();
        }else{
        header('Location:polls.php?alertfailure='.urldecode("Error in Poll Creation"));
        exit();
    }

}

?>