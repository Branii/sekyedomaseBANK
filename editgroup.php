<?php
require_once('../auth.php');
include_once "../try.php"; //error handling class written by romeo do not edit
$groupId = $_GET['groupid'];
include('../db.php');
$result = mysqli_query($link, "SELECT idShGroup,shGroupName FROM shgroup WHERE idShGroup='$groupId'");
$row = mysqli_fetch_array($result);

$shGroupName = $row['shGroupName'];

?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/groupregistration.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
<nav class="">
    <div class="container-fluid">



        <div class="row nav-pane">


            <div class="pull-left current-page">CREATE SHAREHOLDER GROUP</div>



            <div class="pull-right image">
                <img class="img-circle head-user-image" src="https://s-media-cache-ak0.pinimg.com/736x/84/d2/0e/84d20eb6d69995bbbc178df518b1ea96.jpg"  />
            </div>
            <div class="pull-right text-right">
                <p>  Abigail Affum<br/> Admin
                    <br/>
                    <a (click)="logout();" >Logout</a></p>
            </div>
        </div>




        <?php echo '
        <div id="wrapper">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="form-group new-group-name">
                        <h4 class="center center-text buffer-small">EDIT GROUP NAME</h4>
                           <div class="input-group input-group-md">
              <span class="input-group-addon gray"><span>GROUP NAME</span></span>
              <div class="icon-addon addon-md">
                  <!--startDate-->     <input type="text" placeholder="Start Date" class="form-control" id="start" name="topic" value="'.$shGroupName.'" >
              </div>
          </div>
                        
                        
                        <input type="hidden" name="shareholdergroup" id="shareholdergroup" value="">
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
       ';
        ?>


        <!--<div class="row">-->
        <div class="col-sm-1"></div>
        <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
            <!---->
            <div id="sidebar">
                <!--start of sidebar-->
                <div>
                    <input type="text" placeholder="Search" class="form style-form dark-background " id="search">
                </div>

                <ul id="full_list">

                    <?php
                    mysqli_report(MYSQLI_REPORT_OFF);
                    $msgg = new showmessage();
                    $groupId = $_GET['groupid'];

                        include('../db.php');

$result3 = mysqli_query($link, "SELECT shareholderId FROM shareholder_shgroup WHERE shGroupId = '$groupId'") or die(mysqli_errno($link));
$num = mysqli_num_rows($result3);
                        if ($num >0) {
                            $idString = "";
                            while ($row = mysqli_fetch_array($result3)) {
                                $idString .= $row[0] . ",";
                            }

                            $idString = substr($idString, 0, strlen($idString) - 1);
                            $result2 = mysqli_query($link, "SELECT shareholder.idshareholder, shareholder.shareholderSurname, shareholder.shareholderOtherNames 
FROM shareholder WHERE shareholder.idshareholder NOT IN ($idString)")
                            or die(mysqli_error($link));

                            if ($result2 == false) {
                                printf("error occured", $result3->close());
                                exit();
                            }
                            while ($row = mysqli_fetch_assoc($result2)) {
                                echo '<li>';

                                $fullname = $row['shareholderSurname'] . " " . $row['shareholderOtherNames'];
                                echo '<td><div class="list-group-item clearfix" id="' . $row['idshareholder'] . '">' . $fullname . '</div> </li>';

                            }
                        } else {

                            $result = mysqli_query($link, "SELECT * FROM shareholder ORDER BY shareholderSurname");
                            while($row = mysqli_fetch_array($result))
                            {
                                echo '<li>';
                                //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                                $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];

                                echo '<td><div class="list-group-item clearfix" id="'.$row['idshareholder'].'">'.$fullname.'</div> </li>';


                            }

                            //$msgg = new showmessage();
                            //$msgg->show();
                            ?>
                    <script>
             document.getElementById('upd').style.visibility=hidden;
                    </script>
                    <?php
                        }


                    ?>

                </ul>
                <!--end of sidebar-->
            </div>
        </div>
        <div class="col-sm-2 icons text-center">
            <div class="right-icon">
            <span>
  Click to add members
</span></div>
            <div class="left-icon">
                <button onclick="update()" id="upd">Update </button></div><br><br>
            <button onclick="window.location.replace('shareholdergroups.php')" value="Cancel">Back</button>
        </div>

        <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
            <!-- -->
            <div id="sidebar">
                <!--start of side bar-->
                <div>
                    <div class="dark-background ">Group members</div>
                </div>
                <ul id="selected_list">

                    <?php
                    include('../db.php');
                    $result = mysqli_query($link, "SELECT * FROM shareholder ORDER BY shareholderSurname");
                    while($row = mysqli_fetch_array($result))
                    {

                        $result1 = mysqli_query($link, "SELECT * FROM shareholder_shgroup WHERE shGroupId = '$groupId'");
                        while ($row1 = mysqli_fetch_array($result1)){
                            $shid1 = $row1['shareholderId'];
                            $shid = $row['idshareholder'];

                            if($shid == $shid1) {

                                echo '<li>';
                                //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                                $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];

                                echo '<td><div class="list-group-item clearfix" id="'.$row['idshareholder'].'">'.$fullname.'</div> </li>';
                            }
                        }

                    }
                    ?>

                </ul>
                <!--end of sidebar-->
            </div>
        </div>

        <div class="col-sm-1"></div>

        <!--</div>-->
    </div>

    </div>
    <!-- /.container-fluid -->
</nav>

<script src="../assets/js/jquery-3.2.1.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="../assets/js/jquery.metisMenu.js"></script>

<!-- CUSTOM SCRIPTS -->
<script src="../assets/js/custom.js"></script>
<script type="text/javascript">

    var usersA = document.getElementById("full_list");
    var usersB = document.getElementById("selected_list");

    var onclickA;
    var onclickB = function() {
        usersA.appendChild(this);
        this.onclick = onclickA;
        var mylist = usersB.getElementsByTagName("div");
        var shId = mylist[i].id;
        update();
        return false;
    };
    onclickA = function() {
        usersB.appendChild(this);
        this.onclick = onclickB;
        return false;
    };

    for (var i=0; i < usersA.getElementsByTagName("li").length; i++)
        usersA.getElementsByTagName("li")[i].onclick = onclickA;
    for (var i=0; i < usersB.getElementsByTagName("li").length; i++)
        usersB.getElementsByTagName("li")[i].onclick = onclickB;


    var groupid = "<?php echo $_GET['groupid'];?>";


    function update()
    {
        var groupname= document.getElementById('start').value;

        $.post('editshareholdergroupexec.php', {activity:"update",groupId: groupid,groupName: groupname},
            function(d,s){
                //alert(d);
                if(d != "ERROR")
                {
                    //alert("adding candidates now");
                    groupid = d;
                    insert(groupid);
                }
            }
        );
    }

    function insert() {
        //alert("hello"+groupid);

        var count = 0;
        //var pollId= pollid;
        var usersB = document.getElementById("selected_list");
        var mylist = usersB.getElementsByTagName("div");
        var shId = new Array();
        for (var i = 0; i < usersB.getElementsByTagName("div").length; i++) {
            var shId = mylist[i].id;

            //alert('shid '+ shId );
            // alert('groupId '+ gid );
            $.post('editshareholdergroupexec.php', {activity:"insert", shId: shId, groupId: groupid},
                function (d, s) {
                    //alert(d);
                }
            );
            ++count;
        }

        if(count === usersB.getElementsByTagName("div").length)
        {
            //alert("redirecting");
            alert("Updated successfully");
            // endSave("continue", pollId);
            window.location.href='shareholdergroups.php?alertseed';
        }

        function endSave(c)
        {
            //alert("here");

            $.post('editshareholdergroupexec.php', {activity:"endsave" ,c: c, groupid: groupid},
                function(d,s){
                    // alert("redirecting");
                    //alert('d '+d);
                }
            );

        }

    }


</script>
</body>
</html>