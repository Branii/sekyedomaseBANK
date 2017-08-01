<?php
    require_once('../auth.php');
    require_once('pollsaccess.php');
?>
<html>

<head>
<title>SMS-Polls</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/masterdetail.css">
<link rel="stylesheet" type="text/css" href="../css/voting.css">
<link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">POLLS</div>
                <div class="pull-left actions-top-page"><a href="<?php echo '../home.php?userrole='.$_SESSION['SESS_USERROLE_LOGIN_TITLE']; ?>" >HOME</a></div>

                <div class="pull-right image">
                    <?php
                      include('../db.php');
                      $userId = $_SESSION['SESS_MEMBER_ID'];
                      $result1 = mysqli_query($link, "SELECT * FROM shareholder where idshareholder= '$userId'");

                        if($result1) {
                          if(mysqli_num_rows($result1) > 0) {
                              //Login Successful
                              $member = mysqli_fetch_assoc($result1);
                              $photo = $member['shareholderPhoto'];

                            }
                        }
                        echo '<img class="img-circle head-user-image" src="../'.$photo.'"/>';
                    ?>
                </div>
                <div class="pull-right text-right">
                     <p><?php echo $_SESSION['SESS_FULLNAME']; ?><br/>
                    <?php
                    include('../db.php');
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
                      <a href="../index.php">Logout</a></p>
                </div>
            </div>
            <?php if(isset($_GET["alertseed"])): ?>
                <div class="span4">
                    <br>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> Poll Updated
                    </div>
                </div>
            <?php endif; ?>
            <?php if(isset($_GET["alertmysuccess"])): ?>
                <div class="span4">
                    <br>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> Poll deleted
                    </div>
                </div>
            <?php endif; ?>

             <?php if(isset($_GET["alertsuccess"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success!</strong> Poll Created
                          </div>
                 </div>

            <?php endif; ?>
        <?php if(isset($_GET["alertfailure"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-failure">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error!</strong> Poll Not Created
                          </div>
                 </div>

            <?php endif; ?>

        <div id="wrapper row" class="wrapper-row">
            <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
                <div id="sidebar">
                    <!--side bar-->

                  <?php
                      if (isset($addpollbtn)) {
                          echo $addpollbtn;
                      }
                  ?>
                  <input type="text" placeholder="Search" class="search form style-form" id="search">
                   <ul class="list" id="full_list">
                    <?php
                            include('../db.php');
                            $result = mysqli_query($link, "SELECT * FROM poll ORDER BY idpoll desc");
                            while($row = mysqli_fetch_array($result))
                                {
                                  $startdate = $row['pollStartDateTime'];
                                  $closedate = $row['pollCloseDateTime'];

                                  $buttontext = " ";
                                  if(($startdate) > date('d M Y - H:i a')) {
                                     //echo "<strong>date is in the future</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-info" id="'.$row['idpoll'].'">New</button>';
                                   }
                                   else if(($startdate) == date('d M Y - H:i a') || ($closedate) > date('d M Y - H:i a') ) {
                                     //echo "<strong>date is in the past</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-success" id="'.$row['idpoll'].'">Open</button>';
                                   }
                                   else if(($startdate) == "" && ($closedate) == "" ) {
                                     $buttontext = '<button class="btn btn-xs btn-warning" id="'.$row['idpoll'].'">Unset</button>';
                                   }
                                   else if(($startdate) < date('d M Y - H:i a') && ($closedate) == "" ) {
                                     //echo "<strong>date is in the past</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-success" id="'.$row['idpoll'].'">Open</button>';
                                   }


                                   else if(($closedate) <= date('d M Y - H:i a')) {
                                     //echo "<strong>date is in the past</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-danger" id="'.$row['idpoll'].'">Closed</button>';
                                   }

                                  //27 April 2017 - 08:00 pm ::::: dd MM yyyy - HH:ii a
                                    echo '<li>';
                                    echo '<div class="list-group-item clearfix" id="'.$row['idpoll'].'">'.$row['pollTitle'].'';
                                    echo '<span class="pull-right" id="span'.$row['idpoll'].'">';
                                    echo  $buttontext;
                                    echo ' </span> </div> </li>';

                                }


                        ?>


                    </ul>
                    <ul class="pagination"></ul>
                <!--
                <a href="#" class="list-group-item clearfix">President of Board
                      <span class="pull-right">
                        <button class="btn btn-xs btn-info">New</button>
                      </span>
                      </a>

                <a href="#" class="list-group-item clearfix">PRO of Board
                      <span class="pull-right">
                        <button class="btn btn-xs btn-danger">
                Closed        </button>
                      </span>
                    </a>-->

                    <!--end of side bar-->
                </div>
            </div>
            <div id="main-wrapper"  class="col-sm-9 light-background shareholder-detail">
                <div id="main">
                    <div class="row" id="details" hidden="true">
                        <div class="col-sm-10 middle-content">
                            <div>
                            <!--details page-->
                            <div class="row">

                                <div id="polltitle" class="voting-title">Vice President of the Board</div>
                                 <div id="mainrow1" style="visibility: hidden;" class="center-div">
                                  <div id="candidatediv" class="col-sm-3" >
                                      <img id="candidateimg_1" class="img-circle candidate-profile-image" src="http://elsewer.com/wp-content/uploads/2016/11/Nana-Araba-Ansah-elsewer.jpg"/>
                                      <div id="candidatename_1" class="vote-text">Abigail Affum</div>
                                  </div>
                                </div>
                                <div id="mainrow" style="visibility: hidden;" class="center-div">
                                  <div id="optiondiv" class=" option-border col-sm-3" >
                                      <div id="option_1" class="voting-option">yes</div>
                                  </div>
                                </div>
                            </div>

                            <div class="start-end-date">
                                <div class="form-group">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon gray"><span>Start Date</span></span>
                                        <div class="icon-addon addon-md">
                                            <input type="text" placeholder="Start date" class="form-control text-white" id="start_date" readonly>
                                        </div>
                                         <?php
                                            if (isset($startpollbtn)) {
                                                echo $startpollbtn;
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon gray"><span>End Date</span></span>
                                        <div class="icon-addon addon-md">
                                            <input type="text" placeholder="End Date" class="form-control text-white" id="close_date" readonly>
                                        </div>
                                         <?php
                                            if (isset($endpollbtn)) {
                                                echo $endpollbtn;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--end of details page-->
                            </div>
                        </div>
                        <div class="col-sm-2 light-background right-sidebar">

                             <?php
                                if (isset($editpollbtn)) {
                                    echo $editpollbtn;
                                }
                                if (isset($delpollbtn)) {
                                    echo $delpollbtn;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- for pagination-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/list.min.js"></script>
 <script type="text/javascript">

 var monkeyList = new List('sidebar', {
      valueNames: ['list-group-item clearfix'],
      page: 12,
      pagination: true
    });


var list = document.getElementById("full_list");

var serviceID;
    list.addEventListener('click', function(ev)
    {
        serviceID = ev.target.id;

        //alert(serviceID);
        document.getElementById('details').hidden =false;
        getDetails(serviceID);
        showDetails();

    });

    function startPoll()
        {

         $.post('getpoll.php',{ACTIVITY:'startpoll', pollId: serviceID},
              function(d,s){
                 //alert(d);
                 var span = document.getElementById('span'+serviceID);
                 span.innerHTML = '<button class="btn btn-xs btn-success" id="'+serviceID+'">Open</button>';
                 $('#start_date').val(d);
           }
           );
        }

    function endPoll()
        {
         $.post('getpoll.php',{ACTIVITY:'endpoll', pollId: serviceID},
              function(d,s){
                 //alert(d);
                 var span = document.getElementById('span'+serviceID);
                 span.innerHTML = '<button class="btn btn-xs btn-danger" id="'+serviceID+'">Closed</button>';
                 $('#close_date').val(d);
           }
           );
        }



     function showDetails()
        {
            $.post('getpoll.php',{ACTIVITY:'showDetails'},
                function(d,s){
                  //alert(d);
                     var message = d.split(':;:');
                     var pollinfo = message[0];
                     //alert(message[1]);

                     var pollinfodetails = pollinfo.split('::');

                     document.getElementById('polltitle').innerHTML = pollinfodetails[2];

                     //$('#polltitle').val(pollinfodetails[2]);
                     $('#start_date').val(pollinfodetails[0]);
                     $('#close_date').val(pollinfodetails[1]);

                     var polltype = pollinfodetails[4];
                     var count = pollinfodetails[6];
                     //alert(count);
                     var polloptions = message[1];
                     var polloptionsdetails = polloptions.split(';;');
                     //alert(polloptionsdetails[0]);
                     //alert(count);

                     if (polltype == "position_based")
                     {
                     // alert("hiding");
                     document.getElementById('mainrow1').style.visibility= "visible";
                        document.getElementById('mainrow').style.visibility= "hidden";



                          var clonecandidatediv = new Array();
                          var clonecandidateimg = new Array();
                          var clonecandidatename = new Array();
                          var mainrow1 = document.getElementById('mainrow1');

                          if(count == 0)
                          {
                            mainrow1.style.visibility = "hidden";
                          }
                          else{mainrow1.style.visibility = "visible";}

                           for(var i=0; i<count; i++)
                           {


                            $.post('getpoll.php',{ACTIVITY:'getshareholder', shareholderId: polloptionsdetails[i]},
                            function(d1,s){
                                    //alert(d1);
                                var shareholderinfo = d1.split('::');
                              //alert(shareholderinfo[0]);
                              //alert(shareholderinfo[1]);

                            //clone outer div
                              var candidatediv = document.getElementById('candidatediv');
                              clonecandidatediv[i] = candidatediv.cloneNode(true);
                              //clone img div
                              var candidateimg = document.getElementById('candidateimg_1');
                              clonecandidateimg[i] = candidateimg.cloneNode(true);
                              //clone name div
                              var candidatename = document.getElementById('candidatename_1');
                              clonecandidatename[i] = candidatename.cloneNode(true);


                              //change to new id of inner div and update option
                              var offset = i+1;
                              var newimgid = 'candidateimg_'+offset;
                              var newnameid = 'candidatename_'+offset;
                              clonecandidateimg[i].id= newimgid;
                              clonecandidateimg[i].src = '../'+ shareholderinfo[1]+'';

                              clonecandidatename[i].id= newnameid;
                              clonecandidatename[i].innerHTML = shareholderinfo[0];

                              //clear innerhtml of outer div and append new inner div
                              clonecandidatediv[i].innerHTML = '';
                              clonecandidatediv[i].appendChild(clonecandidateimg[i]);
                              clonecandidatediv[i].appendChild(clonecandidatename[i]);
                                if(i == 0)
                                {
                                    mainrow1.innerHTML = '';
                                }
                                mainrow1.appendChild(clonecandidatediv[i]);
                              }
                             );
                               clonecandidatediv[i].innerHTML = '';
                               mainrow1.appendChild(clonecandidatediv[i])
                              //alert();
                              //setTimeout("hold",5000);

                           }

                     }
                     else if (polltype == "motion_based")
                     {
                      //alert("showing");
                        document.getElementById('mainrow').style.visibility= "visible";
                      document.getElementById('mainrow1').style.visibility= "hidden";

                     // document.getElementById('option_1').innerHTML= polloptionsdetails[0];

                      var cloneoptiondiv = new Array();
                      var cloneinneroptiondiv = new Array();
                      var mainrow = document.getElementById('mainrow');
                      if(count == 0)
                          {
                            mainrow.style.visibility = "hidden";
                          }
                      else{mainrow.style.visibility = "visible";}

                       for(var i=0; i< count; i++)
                       {
                        //clone outer div
                          var optiondiv = document.getElementById('optiondiv');
                          cloneoptiondiv[i] = optiondiv.cloneNode(true);
                          //clone inner div
                          var inneroptiondiv = document.getElementById('option_1');
                          cloneinneroptiondiv[i] = inneroptiondiv.cloneNode(true);


                          //change to new id of inner div and update option
                          var offset = i+1;
                          var newid = 'option_'+offset;
                          cloneinneroptiondiv[i].id= newid;
                          cloneinneroptiondiv[i].innerHTML = polloptionsdetails[i];

                          //clear innerhtml of oouter div and append new inner div
                          cloneoptiondiv[i].innerHTML = '';
                          cloneoptiondiv[i].appendChild(cloneinneroptiondiv[i]);

                          if(i == 0)
                          {
                            mainrow.innerHTML = '';
                          }

                          mainrow.appendChild(cloneoptiondiv[i]);
                       }

                     }
            });
        }


 function editSelectedpoll() {
     //var
     var start_date = document.getElementById('start_date').value;
     var close_date = document.getElementById('close_date').value;
     var delpoll = document.getElementById('deletepoll');
     // alert(serviceID);
     delpoll.onclick = window.location.replace("editpositionbasedpoll.php?pollId="+serviceID+"&start_date="+ start_date +"&close_date="+ close_date);
 }

 function deleteSelectedpoll() {
     var txt;
     //alert(serviceID);
     var r = confirm("Are you sure you want to delete this poll? This action would permanently remove all related records with it!");
     if (r == true) {
         //txt = "You pressed OK!";
         var editpoll = document.getElementById('editpoll');
         editpoll.onclick = window.location.replace("deletepositionbasepollexec.php?pollId="+serviceID);
     } else {
         txt = "You pressed Cancel!";
     }

 }


        function getDetails(serviceID)
        {
        //alert(serviceID);

         $.post('getpoll.php',{ACTIVITY:'getdetails', pollId: serviceID},
              function(d,s){
                  //alert(d);
           }
           );
        }



</script>
<style>
     .text-white {

    color: #999;}

     .center-div {

    text-align: center;
    margin-top: 20px;}


 </style>

</body>

</html>