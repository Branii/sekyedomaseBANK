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

    include('db.php');
    $logID = $_POST["logID"];
#
$result = mysqli_query($link, "SELECT systemactivities.idsystemActivities,systemActivitiesAction,  activitylog.systemActivities_idsystemActivities,activitylogDetail FROM systemactivities,activitylog WHERE systemactivities.idsystemActivities='$logID' AND activitylog.systemActivities_idsystemActivities='$logID'") or die(mysqli_error($link));
    echo "<table border='1'>";
    echo "<tr><td style='padding: 20px'>System Activities ID</td><td style='padding: 20px'>Activity Log Details</td><!--<td style='padding: 20px'>Perfomed by</td>--> </tr>";
    $row = mysqli_fetch_array($result);
    ?>
    <tr>
 <td style='padding: 20px'><?php echo $row["systemActivities_idsystemActivities"]; ?></td>
 <td style='padding: 20px'  font><?php echo $row["systemActivitiesAction"]; ?></td>
 <!--<td style='padding: 20px'><?php /*echo $row["shareholderSurname"]." ".$row["shareholderOtherNames"]; */?></td>-->
    </tr>
    <?php
    echo "</table>";

?>