<?php
//require_once('../auth.php');
//require_once('useraccess.php');
include('db.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="nii.css">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/users.css">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--  <script src="jquery-3.1.1.min.js"></script>-->
</head>

<body>
<nav class="">
    <div class="container-fluid">
        <div class="row nav-pane">
            <div class="pull-left current-page">LOGS</div>
            <div class="pull-left actions-top-page">
                <a href="<?php
                $result = mysqli_query($link, "SELECT * FROM userrole");
                $row = mysqli_fetch_array($result);
                $_SESSION['SESS_USERROLE_LOGIN_TITLE']=$row["userRoleTitle"];
echo 'home.php?userrole='.$_SESSION['SESS_USERROLE_LOGIN_TITLE']; ?>">HOME</a></div>

            <div class="pull-right image">
                <img class="img-circle head-user-image" src="https://s-media-cache-ak0.pinimg.com/736x/84/d2/0e/84d20eb6d69995bbbc178df518b1ea96.jpg"/>
            </div>
            <div class="pull-right text-right">
                <p><?php
                $result1 = mysqli_query($link, "SELECT * FROM shareholder");
                    $row = mysqli_fetch_array($result1);
                    $_SESSION['SESS_FULLNAME'] = '' . $row['shareholderSurname'] . ' ' . $row['shareholderOtherNames'] . '';
                    $_SESSION['SESS_MEMBER_USERROLE']= $row['userRole_iduserRole'];
                 echo $_SESSION['SESS_FULLNAME']; ?><br/>
                    <?php
                    include('db.php');
                    $userRoleId = $_SESSION['SESS_MEMBER_USERROLE'];
                    $result = mysqli_query($link, "SELECT * FROM userRole where iduserRole= '$userRoleId'");

                    if($result) {
                        if(mysqli_num_rows($result) > 0) {
                            //Login Successful
                            $member = mysqli_fetch_assoc($result);
                            echo $member['userRoleTitle'];
                        }
            }
?>
                    <br/>
                    <a href="index.php">Logout</a></p>
            </div>
        </div>
        <div id="wrapper row">
            <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
                <div id="sidebar">
                    <!--start of side bar-->
                    <div>
                        <input type="text" placeholder="Search" class="form style-form dark-background " id="search">
                    </div>
                    <?php
                    if (isset($adduserbtn)) {
                        echo $adduserbtn;
                    }
                    ?>
                    <ul id="full_list">
                        <?php
                        include('db.php');
                        $result = mysqli_query($link, "SELECT idactivitylog,activitylogDate FROM activitylog");
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '<li>';
                            //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                            $fullname = $row['activitylogDate'];

                            echo '<div class="list-group-item clearfix" id="'.$row['idactivitylog'].'">'.$fullname.'</div> </li>';


                        }
                        ?>


                    </ul>

                </div>
                <!--end of sidebar-->
            </div>
        </div>
        <div id="main-wrapper" class="col-sm-9 dark-background shareholder-detail">
            <div id="main">
                <div class="row">
                    <div class="col-sm-11 middle-content">
                        <div>
                            <!--start of details-->
                            <div class="row">
                                <!-- else noneSelected-->
                                <div *ngIf="selectedShareholder;">

                                    <div class="col-sm-7">
                                        <div class=" style-form form">
                                            <!--else noOtherNames-->
                                            <!--*ngIf="(selectedShareholder | async)?.otherNames; "-->

                                            <p id="fullname" class="middle-content-name">Activity logs </p>
                                            <div id="actions">
 Activity records will show here
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end of details-->
                        </div>
                    </div>

                    <div class="col-sm-1 dark-background right-sidebar">
                        <?php
                        if (isset($edituserbtn)) {
                            echo $edituserbtn;
                        }
                        if (isset($deluserbtn)) {
                            echo $deluserbtn;
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- /.container-fluid -->
</nav>

<script src="assets/js/jquery-3.2.1.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>

<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
<script type="text/javascript">


    var list = document.getElementById("full_list");


    list.addEventListener('click', function(ev)
    {
        serviceID = ev.target.id;
         //alert(serviceID);
        getDetails();
        showDetails();
    });

    function actions() {
        var xml = new XMLHttpRequest;
        xml.onreadystatechange = function () {
            if (xml.readyState === 4 && xml.status === 200) {
                var nii=xml.responseText;
               alert(nii)
               // document.getElementsById("actions").innerHTML = xml.responseText;
            }
            xml.open("GET","logsexec.php?logID=" + serviceID, true);
            xml.send();
        }
    }
  /*  function showDetails() {

        document.getElementById('details').style.visibility = "visible";
        $.post('logsexec.php', {ACTIVITY: 'showDetails'},
            function (d, s) {
                var values = d;
                document.getElementById('actions').innerHTML = d;

            });
    }*/
    var serviceID;
        function getDetails() {

  $.post('logsexec.php',{ACTIVITY:'getdetails',logID: serviceID},
                function(d,s){
                    document.getElementById('actions').innerHTML = d;
                }
  )}
</script>

</body>

</html>