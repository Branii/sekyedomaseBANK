<?php
    require_once('../auth.php');
    require_once('shareholderaccess.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>SMS-Shareholders</title>
    <link rel="stylesheet" type="text/css" href="../jquery-3.1.1.min.js">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/masterdetail.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function () {
        alert("hello");
    });
</script>

</head>
<body>
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">SHAREHOLDERS</div>
                <?php 
                if (isset($groupshareholderbtn)) {
                    echo $groupshareholderbtn;
                }
                if (isset($msgshareholderbtn)) {
                    echo $msgshareholderbtn;
                }
                ?>
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

    <?php if(isset($_GET["alertsuccess"])): ?>
                <div class="span4">
                <br>
                          <div id="result" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success!</strong> Details Saved
                          </div>
                 </div>

            <?php endif; ?> 
        <?php if(isset($_GET["alertdeletesuccess"])): ?>
                <div class="span4">
                <br>
                          <div id="result" class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success!</strong> Shareholder Removed
                          </div>
                 </div>

            <?php endif; ?> 
        <?php if(isset($_GET["alertfailure"])): ?>
                <div class="span4">
                <br>
                          <div id="result" class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error!</strong> Details not updated
                          </div>
                 </div>

            <?php endif; ?> 

    <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
        <div id="sidebar">
            <!--start of side bar-->
                <?php 
                if (isset($addshareholderbtn)) {
                    echo $addshareholderbtn;
                }
                 ?>
                 <input type="text" placeholder="Search" class="search form style-form" id="search">
                    <ul class="list" id="full_list">
                    <?php
                            include('../db.php');
                            $result = mysqli_query($link, "SELECT * FROM shareholder ORDER BY shareholderSurname");
                            while($row = mysqli_fetch_array($result))
                                {
                                    echo '<li>';
                                  //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                                    
                                    $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];
                                    echo '<div class="list-group-item clearfix" id="'.$row['idshareholder'].'">'.$fullname.'</div> </li>';
                                   
                                   
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
                        <div class="row" >
                            <!-- else noneSelected-->
                            <div>
                                <div class="col-sm-4">
                                    <img class="img-circle user-profile-image" id="profileimage" name="profileimage" src="http://elsewer.com/wp-content/uploads/2016/11/Nana-Araba-Ansah-elsewer.jpg"/>
                                    <button class="share-transaction" id="transactionid" onclick="sharetransactionopen();">share transactions</button>
                                    
                                </div>
                                <div class="col-sm-7">
                                    <div class=" style-form form">
                                        <!--else noOtherNames-->
                                        <!--*ngIf="(selectedShareholder | async)?.otherNames; "-->
                                        <p id="fullname" class="middle-content-name">Shareholder Details </p>
                                        <form method="post" role="form" class="details-form">
                                            <label>Shareholder No.</label>
                                                <input type="text" class="form style-form " id="serialno" name="serialno" readonly>
                                                <label>Gender</label>
                                                <input type="text" class="form style-form " id="gender" name="gender" readonly>

                                                <label>House No.</label>
                                                <input type="text" class="form style-form " id="houseno" name="houseno" readonly>
                                                
                                                <label>City</label>
                                                <input type="text" class="form style-form " id="city" name="city" readonly>
                                             
                                                <label>Phone</label>
                                                <input type="text"  class="form style-form " id="phone" name="phone" readonly>

                                                <label>Branch</label>
                                                <input type="text" class="form style-form " id="branch" name="branch" readonly>

                                                <label>E-mail</label>
                                                <input type="text" class="form style-form " id="email" name="email" readonly>

                                                <label>NEXT OF KIN INFORMATION</label><br>
                                                <label>Name</label>
                                                <input type="text" class="form style-form " id="name" name="name" readonly>

                                                <label>Address</label>
                                                <input type="text" class="form style-form " id="address" name="address" readonly>

                                                <label>Town/City</label>
                                                <input type="text"  class="form style-form " id="nokcity" name="nokcity" readonly>

                                                <label>PAYMENT ALTERNATIVE</label><br>
                                                <label>Bank Name</label>
                                                <input type="text" class="form style-form " id="bankname" name="bankname" readonly>

                                                <label>Branch</label>
                                                <input type="text" class="form style-form " id="pabranch" name="pabranch" readonly>

                                                <label>Account Number</label>
                                                <input type="text"  class="form style-form " id="accountnumber" name="accountnumber" readonly>

                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end of details-->
                    </div>
                </div>

                <div class="col-sm-1 light-background right-sidebar">

                    <!--div>
                        <i class="fa fa-2x fa-envelope" aria-hidden="true"></i></div-->
                    <?php 
                    if (isset($editshareholderbtn)) {
                        echo $editshareholderbtn;
                    }
                    if (isset($delshareholderbtn)) {
                        echo $delshareholderbtn;
                    }
                    ?>
                   
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

var serviceID=0;

var list = document.getElementById("full_list");
    list.addEventListener('click', function(ev)
    {
        serviceID = ev.target.id;
        //alert(serviceID);
        document.getElementById('details').hidden =false;
       // alert(serviceID);
        getDetails(serviceID);  
        showDetails();
        
    });


    function editSelectedShareholder()
    {
      var editshareholder = document.getElementById('editshareholder');
      //alert(serviceID);
      editshareholder.onclick = window.location.replace("editshareholder.php?shareholderid="+serviceID);
    }
    function deleteSelectedShareholder()
    {
      var txt;
      var r = confirm("Are you sure you want to delete this shareholder? This action would permanently remove all related records with it!");
      if (r == true) {
          //txt = "You pressed OK!";
          var deleteshareholder = document.getElementById('deleteshareholder');
          deleteshareholder.onclick = window.location.replace("deleteshareholderexec.php?shareholderid="+serviceID);
      } else {
          txt = "You pressed Cancel!";
      }
      
    }

    function sharetransactionopen()
    {
      var sharetransbutton = document.getElementById('transactionid');
      sharetransbutton.onclick = window.location.replace("sharetransactions.php?shareholderid="+serviceID);
    }



     function showDetails()
        {
            
            document.getElementById('details').style.visibility ="visible";
            $.post('getshareholder.php',{ACTIVITY:'showDetails'},
                function(d,s){
                     var values = d.split('::');
                $('#serialno').val(values[0]);
                //document.getElementById('profileimage').src = 'crop_photo/images/shareholderphotos/photo_'+ values[0]+'.jpg';
               // document.getElementById('profileimage').src = 'crop_photo/images/shareholderphotos/'+ values[15]+'';
               document.getElementById('profileimage').src = '../'+ values[15]+'';

                document.getElementById('fullname').innerHTML = values[1];
                $('#gender').val(values[2]);
                $('#houseno').val(values[3]);
                $('#city').val(values[4]);
                $('#phone').val(values[5]);
                $('#branch').val(values[6]);
                $('#email').val(values[7]);
                $('#name').val(values[8]);
                $('#address').val(values[9]);
                $('#nokcity').val(values[10]);
                 $('#bankname').val(values[11]);
                $('#pabranch').val(values[12]);
                $('#accountnumber').val(values[13]);
            });
            //document.write("You will be redirected to main page in 10 sec."); setTimeout('Redirect()', 10000);
           // showClientAddress();
        }

        function getDetails(serviceID)
        {
        
       $.post('getshareholder.php',{ACTIVITY:'getdetails',shareholderId: serviceID},
            function(d,s){
               // alert(d);
         }
         );
        }

</script>

</body>

</html>