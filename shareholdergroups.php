<?php
    require_once('../auth.php');
    require_once('shareholdergroupaccess.php');
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/masterdetail.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            


<div class="row nav-pane">

    <div class="pull-left current-page">GROUPS</div>
    <div class="pull-left actions-top-page"><a href="shareholders.php">SHAREHOLDERS</a></div>
    <?php 
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
      <?php if(isset($_GET["alertsed"])): ?>
          <div class="span4">
              <br>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success!</strong>Poll Created
              </div>
          </div>

      <?php endif; ?>
      <?php if(isset($_GET["alertseed"])): ?>
          <div class="span4">
              <br>
              <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Success!</strong>Poll Updated
              </div>
          </div>

      <?php endif; ?>
      <?php if(isset($_GET["alertdeletesuccess"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success!</strong> group removed
                          </div>
                 </div>

            <?php endif; ?> 
        <?php if(isset($_GET["alertfailure"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error!</strong> Details not updated
                          </div>
                 </div>

            <?php endif; ?>

  <div class="col-sm-3 left-sidebar" id="sidebar-wrapper">
    <div id="sidebar">
      <!--start of side bar-->
     
        
      
      <?php 
        if (isset($addshareholdergpbtn)) {
            echo $addshareholdergpbtn;
        }
      ?>
      <input type="text" placeholder="Search" class="search form style-form" id="search">
      <ul class="list" id="full_list">
            <?php
                    include('../db.php');
                    $result = mysqli_query($link, "SELECT * FROM shGroup ORDER BY shGroupName");
                    while($row = mysqli_fetch_array($result))
                        {
                            echo '<li>';
                          //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                            
                            
                            echo '<div class="list-group-item clearfix" id="'.$row['idShGroup'].'">'.$row['shGroupName'].'</div> </li>';
                           
                           
                        }
                ?> 
                
                
            </ul>
            <ul class="pagination"></ul> 
      <!--end of side bar-->
    </div>
  </div>
  <div id="main-wrapper" class="col-sm-9 light-background shareholder-detail">
    <div id="main">
      <div class="row" id="details" hidden="true">
        <div class="col-sm-11 middle-content">
          <!--start of detail section-->
          <div class="row">
            <!--start of one member-->
            <ul id="memberlist">
              <li id="member">
                <div id="outerdiv" class="col-sm-3">
                  <div id="innerdiv" class="margin-12">
                    <img class="img-circle user-profile-image-small center" id="profileimage" name="profileimage" src="https://s-media-cache-ak0.pinimg.com/736x/84/d2/0e/84d20eb6d69995bbbc178df518b1ea96.jpg"  />
                    <div class="center-text text-center" id="profilename" name="profilename">name</div>
                  </div>
                  <!--end of detail section-->
                </div>
            </li>
            
            </ul>
            
      </div>
    </div>
    <div class="col-sm-1 light-background right-sidebar">
    <?php 
        if (isset($editshareholdergpbtn)) {
            echo $editshareholdergpbtn;
        }
      ?>
      <?php 
        if (isset($delshareholdergpbtn)) {
            echo $delshareholdergpbtn;
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

var serviceID = 0;
var list = document.getElementById("full_list");


    list.addEventListener('click', function(ev)
    {
        serviceID = ev.target.id;
        document.getElementById('details').hidden =false;

       // alert(serviceID);
        getDetails(serviceID);
        showDetails();
        
    });

    function editSelectedGroup()
    {
      var editshareholder = document.getElementById('editgroup');
      editshareholder.onclick = window.location.replace("editgroup.php?groupid="+serviceID);
    }
    function deleteSelectedGroup()
    {
      var txt;
      var r = confirm("Are you sure you want to delete this group? This action would permanently remove all related records with it!");
      if (r == true) {
          //txt = "You pressed OK!";
          var deletegroup = document.getElementById('deletegroup');
          deletegroup.onclick = window.location.replace("deletegroupexec.php?groupid="+serviceID);
      } else {
          txt = "You pressed Cancel!";
      }
      
    }
  

     function showDetails()
        {
            
            
            $.post('getshareholdergroup.php',{ACTIVITY:'showDetails'},
                function(d,s){
                  //alert(d);
                     var shareholder = d.split(':::');
                     
                     //alert(shareholder.length);
                     var profilepic = new Array();
                     var profilename = new Array();
                     var clonepic = new Array();
                     var clonemembername = new Array();
                     var clonemember = new Array();
                     var cloneouterdiv = new Array();
                     var clonelist = new Array();

                     var ulist = document.getElementById('memberlist');
                      if(shareholder.length == 1)
                          {
                            ulist.style.visibility = "hidden";
                          }
                      else{ulist.style.visibility = "visible";}
                     

                    for(var i=1; i< shareholder.length; i++)
                     {
                          var details = shareholder[i].split('::'); 
                          //profilepic[i] = details[1];
                          //profilename[i] = details[0];

                          var pic = document.getElementById('profileimage');
                          clonepic[i] = pic.cloneNode(true);
                          clonepic[i].src = '../'+ details[1]+'';

                          var membername = document.getElementById('profilename');
                          clonemembername[i] = membername.cloneNode(true);
                          clonemembername[i].innerHTML = details[0];

                          var member = document.getElementById("innerdiv");
                          clonemember[i] = member.cloneNode(true);
                          clonemember[i].innerHTML = '';
                          
                          var outerdiv = document.getElementById("outerdiv")
                          cloneouterdiv[i] = outerdiv.cloneNode(true);
                          cloneouterdiv[i].innerHTML = '';

                          var list = document.getElementById('member');
                          clonelist[i]= list.cloneNode(true);
                          clonelist[i].innerHTML = '';

                          if(i == 1)
                          {
                            ulist.innerHTML = '';
                          }


                          ulist.appendChild(clonelist[i]);
                          
                          clonelist[i].appendChild(cloneouterdiv[i]);
                          
                          cloneouterdiv[i].appendChild(clonemember[i]);
                          
                          clonemember[i].appendChild(clonepic[i]);
                          clonemember[i].appendChild(clonemembername[i]);

 
                     }


                    

            });
        }



        function getDetails(serviceID)
        {
        //alert(serviceID);

         $.post('getshareholdergroup.php',{ACTIVITY:'getdetails', shareholderGroupId: serviceID},
              function(d,s){
                  //alert(d);
           }
           );
        }



</script>

</body>

</html>

