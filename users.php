<?php
    require_once('../auth.php');
    require_once('useraccess.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>SMS-Users</title>
    <link rel="stylesheet" type="text/css" href="nii.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/masterdetail.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    

</head>

<body>
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">LOGS</div>
  <!--              <div class="pull-left actions-top-page"><label style="cursor:pointer" onclick="act()">VIEW ALL LOGS</label></div>-->
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

             <div id="wrapper row" class="wrapper-row">
                <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
                    <div id="sidebar">
                        <!--start of side bar-->
                        <?php
                            //if (isset($adduserbtn)) {
                             //   echo $adduserbtn;
                            //}
                        ?>
                       <input type="text" placeholder="Search" class="search form style-form " id="search">
                      <ul class="list" id="full_list">
                          <?php
                          //include('db.php');
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
                        <ul class="pagination"></ul>    
                    </div>
            <!--end of sidebar-->
        </div>
   
    <div id="main-wrapper" class="col-sm-9 light-background shareholder-detail">
        <div id="main">
            <div class="row" id="details" hidden="true">
                <div class="col-sm-11 middle-content">
                    <div>
                        <!--start of details-->
                        <div class="row">
                            <!-- else noneSelected-->
                            <div *ngIf="selectedShareholder;">
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
                        <!--end of details-->
                    </div>
                </div>


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
    <script src="assets/js/jquery.metisMenu.js"></script>
    
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
        document.getElementById('details').hidden =false;
       // alert(serviceID);
        getDetails(serviceID);
        //showDetails();
        //actions();
    });



     function showDetails()
        {
            $.post('getuser.php',{ACTIVITY:'showDetails'},
                function(d,s){
                     var values = d.split('::');

                document.getElementById('profileimage').src = '../'+ values[5]+'';

                document.getElementById('fullname').innerHTML = values[0];
                $('#gender').val(values[1]);
                $('#address').val(values[2]);
                $('#phone').val(values[3]);
                $('#email').val(values[4]);
                $('#userrole').val(values[6]);
            });
            //document.write("You will be redirected to main page in 10 sec."); setTimeout('Redirect()', 10000);
           // showClientAddress();
        }

        function getDetails()
        {
        
       $.post('logsexec.php',{logID: serviceID},
            function(d,s){
                document.getElementById('actions').innerHTML = d;
         }
         );
        }

function deleteUser()
        {
        var table = document.querySelector('table');
            table.addEventListener('click', function(ev)
            {
                var serviceID = ev.target.id;
                var info = 'id=' + serviceID;
                alert("Sure you want to delete this client? This will delete all the contacts and jobs under this client!");
         $.ajax({
           type: "GET",
           url: "deleteuser.php",
           data: info,
           success: function(){
           }
         });
                 $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                .animate({ opacity: "hide" }, "slow");
         }
         );
     // document.write("You will be redirected to main page in 10 sec."+ view_id); 
        }
</script>
<script>
    function act() {
        alert("hello");
        var xml = new XMLHttpRequest;
        // xml.onreadystatechange() = function () {
        // if (xml.readyState === 4 && xml.status === 200) {
        var nnii=xml.responseText;
//document.getElementById("nii").innerHTML=nnii;
        alert(nnii);
        //  }
        xml.open("GET","logsexek.php?logID=" + serviceID, true);
        xml.send();
    }
    }

</script>
</body>
</html>