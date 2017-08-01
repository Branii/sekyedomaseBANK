<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="nii.css">
</head>
<body>

</body>
</html>
<?php
session_start();
//global $activity;

$logID= $_POST['logID'];

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "shareholdersmgtdb";
$prefix = "";
$link = @mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

if (!$link) {
    die('Connect Error: ' . mysqli_connect_error());
}
    $logID = $_POST["logID"];
#
$result =mysqli_query($link,"SELECT activitylogDetail FROM activitylog WHERE idactivitylog='$logID'")or die(mysqli_error($link));
$row = mysqli_fetch_array($result);
$nice = $row['activitylogDetail'];
$sep_id = explode(" ",$nice);
$new_id = $sep_id[3];
$result=mysqli_query($link,"SELECT shareholderSurname,shareholderOtherNames FROM shareholder WHERE idshareholder='$new_id'")or die(mysqli_error($link));
$row = mysqli_fetch_array($result);
$myid =  $row["shareholderSurname"]." ".$row["shareholderOtherNames"];

$result = mysqli_query($link, "SELECT systemactivities.idsystemActivities,systemActivitiesAction,activitylog.systemActivities_idsystemActivities,activitylogDetail,shareholder_idshareholder,shareholder.idshareholder,shareholderSurname,shareholderOtherNames FROM systemactivities,activitylog,shareholder WHERE systemactivities.idsystemActivities='$logID' AND activitylog.systemActivities_idsystemActivities='$logID' AND activitylog.shareholder_idshareholder = shareholder.idshareholder") or die(mysqli_error($link));
    echo "<table border='1'>";
    echo "<tr><th style='padding: 20px'>System Activities ID</th><th style='padding: 20px'>Activity Log Details</th><th style='padding: 20px'>System Activities Actions</th><th style='padding: 20px'>Perfomed by</th> </tr>";
    $row = mysqli_fetch_array($result);
    ?>
    <tr>
 <td style='padding: 20px'><?php echo "#".$row["systemActivities_idsystemActivities"]; ?></td>
<td style='padding: 20px'  font><?php echo $myid; ?></td>
 <td style='padding: 20px'  font><?php echo $row["systemActivitiesAction"]; ?></td>
 <td style='padding: 20px'><?php echo $row["shareholderSurname"]." ".$row["shareholderOtherNames"]; ?></td>
    </tr>
    <?php
    echo "</table>";

#braniiblack
?>