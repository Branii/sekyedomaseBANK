<?php
require_once('../auth.php');
include('../db.php');
include_once "../try.php"; //error handling class written by romeo do not edit
$start = $_GET['start_date'];
$close = $_GET['close_date'];
$pollId = $_GET['pollId'];

include('../db.php');
$result = mysqli_query($link, "SELECT idpoll,pollTitle,pollElectorateGroup FROM poll WHERE idpoll='$pollId'");
$row = mysqli_fetch_array($result);
$title = $row['pollTitle'];
$electorategroup=$row['pollElectorateGroup'];
?>
<!--suppress ALL -->
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../assets/bootstrap_datetime_picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../assets/bootstrap_datetime_picker/css/bootstrap-datetimepicker..css"rel="stylesheet"media="screen">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/votingpositionbased.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../assets/js/jquery-3.2.1.js"></script>
    <script>
       function nii(){
           var title = document.getElementById("title").value;
           var start = document.getElementById("start").value;
           var end = document.getElementById("end").value;
           var pollid = document.getElementById("pollid").value;
           var count = 0;
           var pollId= pollid;
           var activity= "addcandidate";
           var usersB = document.getElementById("selected_list");
           var mylist = usersB.getElementsByTagName("div");
           var shId = new Array();
           for (var i=0; i < usersB.getElementsByTagName("div").length; i++)   {
               shId = mylist[i].id;
               window.location.href="updatepositionbasedpollexec.php?activity="+activity+"&pollid="+pollid+"&shId="+shId+"&title="+title+"&start="+start+"&end="+end;
               //alert('shid '+ shId );
               //alert('groupId '+ gid );
           }
            }
    </script>
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">POSITION-BASED POLL</div>

             <div class="pull-right image">
  <img class="img-circle head-user-image" src="https://s-media-cache-ak0.pinimg.com/736x/84/d2/0e/84d20eb6d69995bbbc178df518b1ea96.jpg"
  />
</div>
<div class="pull-right text-right">
  <p>  Abigail Affum<br/> Admin
    <br/>
    <a (click)="logout();" >Logout</a></p>
</div>

                <?php
                    /*
                require_once('../auth.php');
                include('../db.php');
                $polid = $_GET['pollId'];
                $result = mysqli_query($link, "SELECT idpoll FROM poll where idpol= '$polid'");
                $row = mysqli_fetch_row($result);
                $idpol = $row['idpoll'];
*/
                ?>

<div id="wrapper">
  <div id="ro" class="row">
    <div class="col-sm-4"></div>
    <div id="col" class="col-sm-4">
      <div id="box" class="form-group new-group-name">
        <div class="input-group input-group-md">
            <?php echo '
 <input type="hidden" placeholder="Enter Title" class="form-control" id="pollid" name="topic" required value="'.$pollId.'">
          <span class="input-group-addon gray"><span>Position Title</span></span>
          <div class="icon-addon addon-md">
              <!--title-->     <input type="text" placeholder="Enter Title" class="form-control" id="title" name="topic" required value="'.$title.'">
          </div>
        </div>

 <div class="form-group new-group-name">
                <label for="dtp_input1" class="col-md-2 control-label sidelabel">Start Date</label>
                <div id="nii" class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input id="start" class="form-controlll" size="16" type="text" value="'.$start.'" name="startdatetime" readonly required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" />
        </div>
        

         <div class="form-group new-group-name">
                <label for="dtp_input1" class="col-md-2 control-label sidelabell">End Date</label>
                <div id="niii" class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input id="end" class="form-controll" size="16" type="text" value="'.$close.'" name="startdatetime" readonly required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" />
        </div>
'?>

      </div>

    </div>
   <!-- <div class="col-sm-4"></div>-->
  </div>

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
               include('../db.php');
               $result3 = mysqli_query($link, "SELECT shareholderId FROM positionbasedpoll WHERE pollId ='$pollId'")
               or die(mysqli_error($link));
           $num = mysqli_num_rows($result3);
           if ($num >0) {
               $idString = "";
               while ($row = mysqli_fetch_array($result3)) {
                   $idString .= $row[0] . ",";
               }

               $idString = substr($idString, 0, strlen($idString) - 1);

               $result2 = mysqli_query($link, "SELECT shareholder.idshareholder, shareholder.shareholderSurname, shareholder.shareholderOtherNames FROM shareholder WHERE shareholder.idshareholder NOT IN ($idString)")
               or die(mysqli_error($link,"hlollkjkjdf"));

               while ($row = mysqli_fetch_assoc($result2)) {
                   echo '<li>';
                   //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
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
                  // document.getElementById('upd').style.visibility=hidden;
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
  Click to add candidates
</span></div>
        <div class="left-icon">
<button id="save" onclick="addPoll()" value="UPDATE">UPDATE</button></div><br>
           <button onclick="window.location.replace('polls.php')" value="Cancel">Back</button>

    </div>
  <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
    <!-- -->
    <div id="sidebar">
      <!--start of side bar-->
      <div>
        <div class="dark-background" id="candidates">CANDIDATES</div>
      </div>
     <ul id="selected_list">
                <li>
                    <?php
                    mysqli_report(MYSQLI_REPORT_OFF);
                    $msgg = new showmessage();
                    include('../db.php');


$result3 = mysqli_query($link, "SELECT shareholderId FROM positionbasedpoll WHERE pollId ='$pollId'") or die( mysqli_error() );
                    $num = mysqli_num_rows($result3);
                    if ($num >0) {
                    $idString = "";
                    while( $row = mysqli_fetch_array($result3) )
                    {
                        $idString .= $row[0].",";
                    }

                    $idString = substr($idString, 0, strlen($idString)-1 );

                    $result2 = mysqli_query($link, "SELECT shareholder.idshareholder, shareholder.shareholderSurname, shareholder.shareholderOtherNames FROM shareholder WHERE shareholder.idshareholder IN ($idString);" )
                    or die( mysqli_error ($link) );

                    while($row = mysqli_fetch_assoc($result2)){
                        echo '<li>';
                        //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                        $fullname = $row['shareholderSurname'] . " " . $row['shareholderOtherNames'];

                        echo '<td><div class="list-group-item clearfix" id="' . $row['idshareholder'] . '">' . $fullname . '</div> </li>';
                    }
                    } else {
                        //$msgg = new showmessage();
                        //$msgg->show();
                        ?>
                        <script>
                            // document.getElementById('upd').style.visibility=hidden;
                        </script>
                        <?php
                    }
                    ?>
                </li>
            </ul>
      <!--end of sidebar-->
        </div>
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
            addMember();
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

        var pollid = "<?php echo $pollId;?>";


        function addPoll()
        {
            var title = document.getElementById('title').value;
            var start = document.getElementById('start').value;
            var end = document.getElementById('end').value;
            //alert(topic);
            $.post('updatepositionbasedpollexec.php', {ACTIVITY: "addnewpoll", title:title,start:start,end:end,pollid:pollid},
                function(d,s){
                    //alert(d);
                    if(d != "ERROR")
                    {
                        //alert("adding candidates now");
                        pollid = d;
                        addCandidate(pollid);
                    }
                }
            );
        }

        function addCandidate()
        {
            //alert('in function ');
            var count = 0;
            //var pollId= pollid;
            var usersB = document.getElementById("selected_list");
            var mylist = usersB.getElementsByTagName("div");
            var shId = new Array();
            for (var i=0; i < usersB.getElementsByTagName("div").length; i++)   {
                var shId = mylist[i].id;

                 //alert('shid '+ shId );
                // alert('groupId '+ gid );
$.post('updatepositionbasedpollexec.php', {ACTIVITY:"addcandidate" ,shId:shId, pollId: pollid},
                    function(d,s){
                        //alert(d);
                    }
                );
                ++count;
            }

            if(count == usersB.getElementsByTagName("div").length)
            {
                //alert("redirecting");
                alert("Updated successfully");
                // endSave("continue", pollId);
                window.location.href='polls.php?alertseed';
            }




        function getpollid()
        {
            return pollid;
        }

        function endSave(c)
        {
            alert("here");

 $.post('updatepositionbasedpollexec.php', {ACTIVITY:"endsave" ,c: c, pollId: pollid},
                function(d,s){
                    // alert("redirecting");
                    alert('d '+d);
                }
            );

        }
        }
    </script>
    <style>
        #start-date,#start-time,#end-date,#end-time{
            width:50%;
        }
        #select-control{
            visibility: hidden
        }
        .divider{
            margin-top: 36px;
        }
        button{
            width: 80px;
            padding-left: 16px;
            padding-right:16px;
        }
        .polls-electorate{
            margin-top:88px;
            overflow-y: scroll;
        }
        p.electorates{
            color:#7f6000;
        }
        .form{
            padding:0px;
            margin:8px;
            //width: 200px;
        }
        .select{
            margin-left: 20px;
        }

        .sidelabel{
            position: relative;
            top:-60px;
            padding: 9px 12px;
            font-size: 14px;
            font-weight: normal;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            //border-radius: 4px;
            width:105px;
            height: 34px;
        }
        .sidelabell{
            position: relative;
            top:-120px;
            padding: 9px 12px;
            font-size: 14px;
            font-weight: normal;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            //border-radius: 4px;
            width:105px;
            height: 34px;
        }
        #title{
            width:308px;
        }
.form-controlll{
        position: relative;
    top:0px;
    width:230px;
    height: 34px;
   // border-radius: 3px;
    left:0px;
}
        .form-controll{
            position: relative;
            top:0px;
            width:230px;
            height: 34px;
            //border-radius:3px;
            left:0px;
        }
 #nii{
position: relative;
top: -60px;
     left:0px;
 }
#niii{
position: relative;
top: -120px;
    left:0px;
}
        #box{
            position: relative;
            width:550px;
            height:150px;
        }
        #ro{
            position: relative;
            width:1630px;
            height:190px;
        }
        #col{
            position: relative;
           // width:1630px;
            height:190px;
        }
    </style>

    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">

        function changeId(){
            var e = document.getElementById("select-control");
            var selectedid = e.options[e.selectedIndex].value;
            document.getElementById('group').value = selectedid;
            //alert(document.getElementById('group').value);
        }


        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });

        var rdBtn = document.getElementById("group");
        var rdBtnall_shareholders = document.getElementById("all_shareholders");
        var ischecked = true;
        rdBtn.addEventListener("click", function() {
            if (ischecked) {
                document.getElementById("select-control").style.visibility = "visible";
            }
        });
        rdBtnall_shareholders.addEventListener("click", function() {
            if (ischecked) {
                document.getElementById("select-control").style.visibility = "hidden";
            }
        });

    </script>
</body>

</html>