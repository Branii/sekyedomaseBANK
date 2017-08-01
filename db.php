<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "shareholdersmgtdb";
$prefix = "";
$link = @mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

if (!$link) {
    die('Connect Error: ' . mysqli_connect_error());
}
//else{echo "done";}
?>