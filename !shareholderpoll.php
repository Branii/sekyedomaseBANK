<?php
    require_once('../auth.php');
    require_once('pollsaccess.php');
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/voting.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">POLLS</div>
                <div class="pull-left actions-top-page"><a href="<?php echo '../home.php?userrole='.$_SESSION['SESS_USERROLE_LOGIN_TITLE']; ?>" >HOME</a></div>

                <div class="pull-right">
                    <img class="img-circle head-user-image" src="http://elsewer.com/wp-content/uploads/2016/11/Nana-Araba-Ansah-elsewer.jpg"
                    />
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

        <div id="wrapper row">
            <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
                <div id="sidebar">
                    <!--side bar-->
                  <div>
                    <!--TODO search-->
                    <input type="text" placeholder="Search" class="form style-form dark-background " id="search">
                  </div>
                  <?php 
                      if (isset($addpollbtn)) {
                          echo $addpollbtn;
                      }
                  ?>

                   <ul id="full_list">
                    <?php
                            include('../db.php');
                            $result = mysqli_query($link, "SELECT * FROM poll ORDER BY idpoll desc");
                            while($row = mysqli_fetch_array($result))
                                {
                                  $startdate = $row['pollStartDateTime'];
                                  $closedate = $row['pollCloseDateTime'];
                                  
                                  /*
                                    NOTE : change $dateString value to
                                    $dateString = "+1 day";
                                    $dateString = "-1 day";
                                    OR
                                    $dateString = "now";
                                    to check other conditions.
                                  */

                                    $buttontext = " ";
                                  if(($startdate) > date('d M Y - H:i a')) {
                                     //echo "<strong>date is in the future</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-info">New</button>';
                                   }

                                   else if(($startdate) < date('d M Y - H:i a') && ($closedate) < date('d M Y - H:i a')) {
                                     //echo "<strong>date is in the past</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-danger">Closed</button>';
                                   }
                                   
                                  else if(($startdate) <= date('d M Y - H:i a') && ($closedate) > date('d M Y - H:i a')) {
                                     //echo "<strong>date is in the past</strong>";
                                    //echo 'sd: '.$startdate.' today: '.date('d M Y - H:i a').' cd: '.$closedate;
                                     $buttontext = '<button class="btn btn-xs btn-success">Open</button>';
                                   }

                                  //27 April 2017 - 08:00 pm ::::: dd MM yyyy - HH:ii a
                                    echo '<li>';
                                    echo '<div class="list-group-item clearfix" id="'.$row['idpoll'].'">'.$row['pollTitle'].'';
                                    echo '<span class="pull-right">';
                                    echo  $buttontext;
                                    echo ' </span> </div> </li>';
                                   
                                }
                        ?> 
                        
                        
                    </ul>
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
            <div id="main-wrapper"  class="col-sm-9 dark-background shareholder-detail">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-10 middle-content">
                            <div>
                            <!--details page-->
                            <div class="row">

                                <div id="polltitle" class="voting-title">Polls</div>
                                 <div id="mainrow1" style="visibility: hidden;" class="center-div">
                                  <div id="candidatediv" class="col-sm-3" >
                                      <img id="candidateimg_1" class="img-circle user-profile-image" src="http://elsewer.com/wp-content/uploads/2016/11/Nana-Araba-Ansah-elsewer.jpg"/>
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
                                            <input type="text" placeholder="Date Created" class="form-control dark-background text-white" id="start_date">
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
                                            <input type="text" placeholder="Date Created" class="form-control dark-background text-white" id="close_date">
                                        </div>
                                         <?php 
                                            if (isset($endpollbtn)) {
                                                echo $endpollbtn;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div>
                              <button onclick="window.location.replace('voting.php')">vote now</button>
                            </div>
                            <!--end of details page-->
                            </div>
                        </div>
                        <div class="col-sm-2 dark-background right-sidebar">
                            
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
 <script type="text/javascript">

var list = document.getElementById("full_list");


    list.addEventListener('click', function(ev)
    {
        var serviceID = ev.target.id;

        //alert(serviceID);
        getDetails(serviceID);  
        showDetails();
        
    });

  

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
                     
                     if (polltype == "motion_based") 
                     {
                     // alert("hiding");
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
                     else if (polltype == "position_based") 
                     {
                      //alert("showing");
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
                              clonecandidateimg[i].src = '../crop_photo/images/shareholderphotos/'+ shareholderinfo[1]+'';

                              clonecandidatename[i].id= newnameid;
                              clonecandidatename[i].innerHTML = shareholderinfo[0];

                              //clear innerhtml of outer div and append new inner div
                              clonecandidatediv[i].innerHTML = '';
                              clonecandidatediv[i].appendChild(clonecandidateimg[i]);
                              clonecandidatediv[i].appendChild(clonecandidatename[i]);
                              
                              }
                             );
                              alert();
                              if(i == 0)
                              {
                               // alert("clearing mainrow1");
                                mainrow1.innerHTML = '';
                              }

                              mainrow1.appendChild(clonecandidatediv[i]);
                              
                              
                              



                           }

                     }

                  
                    

            });
        }

       

        function getDetails(serviceID)
        {
        //alert(serviceID);

         $.post('getpoll.php',{ACTIVITY:'getdetails', pollId: serviceID},
              function(d,s){
                 // alert(d);
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