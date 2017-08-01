<?php
    //Start session
  session_start();
  
  //Check whether the session variable SESS_MEMBER_ID is present or not
  if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
    header("location: index.php");
    //echo $_SESSION['SESS_MEMBER_ID'];
    exit();
  }
?>
<!DOCTYPE html>
<html>

<head>
  <title>SMS-Home</title>
  <link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap-theme.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
  <nav class="">
    <div class="container-fluid">
      <div class="row nav-pane">

        <div class="pull-left current-page">HOME</div>

        <div class="pull-right image">
          <?php
              include('db.php');
              $userId = $_SESSION['SESS_MEMBER_ID'];
              $result1 = mysqli_query($link, "SELECT * FROM shareholder where idshareholder= '$userId'");
        
                if($result1) {
                  if(mysqli_num_rows($result1) > 0) {
                      //Login Successful
                      $member = mysqli_fetch_assoc($result1);
                      $photo = $member['shareholderPhoto'];
                      
                    }
                }
                echo '<img class="img-circle head-user-image" src="'.$photo.'"/>';
            ?>
          
        </div>
        
        <div class="pull-right text-right">
          <p><?php echo $_SESSION['SESS_FULLNAME']; ?><br/> 
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
       <?php if(isset($_GET["alertsuccess"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Success!</strong> Message Sent
                          </div>
                 </div>

            <?php endif; ?> 
        <?php if(isset($_GET["alertfailure"])): ?>
                <div class="span4">
                <br>
                          <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Error!</strong> Message Not Sent
                          </div>
                 </div>

            <?php endif; ?> 

      <div class="row row-centered top-buffer main-home">

        <div class="col-sm- col-centered"></div>
        <?php
        
          function showicons($activity)
              {
                  switch ($activity) {
                    
                    case '1':
                    case '2':
                    case '7':
                    case '8':
                    case '10':
                     if ($_SESSION['ACT_SH'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="shareholders"><a href="shareholder_module/shareholders.php"><i class="fa fa-5x fa-users" aria-hidden="true"></i>
                          <p> SHAREHOLDERS </p></a>
                        </div>
                      ';
                      $_SESSION['ACT_SH'] = 1; //shareholders
                      }
                        
                      break;
                    case '3':
                    case '4':
                    case '9':
                      if ($_SESSION['ACT_POLL'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="polls"><a href="voting_module/polls.php"><i class="fa fa-5x fa-thumbs-up" aria-hidden="true"></i>
                          <p> POLLS </p></a>
                        </div>
                      ';
                      $_SESSION['ACT_POLL'] = 1; //polls
                      }
                      
                      break;
                    case '5':
                    case '6':
                      if ($_SESSION['ACT_LOGS'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="logs"><a href="user_module/users.php"><i class="fa fa-5x fa-th-list" aria-hidden="true"></i>
                          <p> LOGS </p></a>
                        </div>
                      ';
                      $_SESSION['ACT_LOGS'] = 1;//users
                      }
                      
                      break;
                    case '11':
                    case '12':
                      if ($_SESSION['ACT_FM'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="filemanager"><a href="file_manager_module/filemanager.php"><i class="fa fa-5x fa-book" aria-hidden="true"></i>
                          <p> FILE MANAGER </p></a>
                        </div>
                      ';
                      $_SESSION['ACT_FM'] = 1;//file manager
                      }
                      
                      break;
                    case '13':
                      if ($_SESSION['ACT_APP'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="approval"><a href="dual_authentication_module/approval.php"><i class="fa fa-5x fa-check-square-o" aria-hidden="true"></i>
                          <p> APPROVALS </p></a>
                        </div>
                      ';
                       $_SESSION['ACT_APP'] = 1;//approvals
                      }
                      
                      break;
                    case '14':
                      if ($_SESSION['ACT_OPT'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="options"><a href="options_module/generaloptions.php"><i class="fa fa-5x fa-cogs" aria-hidden="true"></i>
                          <p> OPTIONS</p></a>
                        </div>
                      ';
                       $_SESSION['ACT_OPT'] = 1;//options
                      }
                      
                      break;
                    case '15':
                      if ($_SESSION['ACT_ACC'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="useraccount"><a href="myaccount_module/shareholderaccount.php"><i class="fa fa-5x fa-home" aria-hidden="true"></i>
                          <p> MY ACCOUNT </p></a>
                        </div>
                      ';
                        $_SESSION['ACT_ACC'] = 1; //user account
                      }
                      
                      break;
                    case '18':
                      if ($_SESSION['ACT_ACC'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="shareholderaccount"><a href="myaccount_module/shareholderaccount.php"><i class="fa fa-5x fa-home" aria-hidden="true"></i>
                          <p> MY ACCOUNT </p></a>
                        </div>
                      ';
                        $_SESSION['ACT_ACC'] = 1; //shareholder account
                      }
                      
                      break;
                    case '16':
                      if ($_SESSION['VOTE'] == 0) {
                        echo '
                        <div class="col-sm-2 col-centered" id="shareholderpoll"><a href="voting_module/shareholderpoll.php"><i class="fa fa-5x fa-thumbs-down" aria-hidden="true"></i>
                          <p> VOTE </p></a>
                        </div>
                      ';
                        $_SESSION['VOTE'] = 1; //shareholder poll
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              include('db.php');
              $c = $_GET['userrole'];
              //$c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_SH'] = 0;
              $_SESSION['ACT_POLL'] = 0;
              $_SESSION['ACT_LOGS'] = 0;
              $_SESSION['ACT_FM'] = 0;
              $_SESSION['ACT_APP'] = 0;
              $_SESSION['ACT_OPT'] = 0;
              $_SESSION['ACT_ACC'] = 0;
              $_SESSION['VOTE'] = 0;
              if($c == "admin")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '1'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
                    showicons(14); //show options
                    showicons(18); //show account
              }
              else if($c == "ftdk")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '2'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
                    showicons(18); //show account
              }
              /*else if($c == "auth")
              {
                $result = mysqli_query($link,nt
              }*/
              else if($c == "shder")
              { 
                /*"SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '4'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
                    showicons(13); //show approval
                    showicons(15); //show account*/
              
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
                    showicons(18); //show account
                    showicons(16); //show vote
              }
              else if($c == "other")
              {
                $userroleid = $_SESSION['SESS_MEMBER_USERROLE'];
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '$userroleid'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
                    showicons(18); //show account
              }
              

            ?>
        
        <!--<div class="col-sm-2 col-centered" id="shareholders"><a href="shareholder_module/shareholders.php"><i class="fa fa-5x fa-pie-chart" aria-hidden="true"></i>
          <p> SHAREHOLDERS </p></a>
        </div>
        <div class="col-sm-2 col-centered" id="users"><a href="user_module/users.php"><i class="fa fa-5x fa-users" aria-hidden="true"></i>
          <p> USERS </p></a>
        </div>
        <div class="col-sm-2 col-centered" id="filemanager"><a href="file_manager_module/filemanager.php"><i class="fa fa-5x fa-book" aria-hidden="true"></i>
          <p> FILE MANAGER </p></a>
        </div>
        <div class="col-sm-2 col-centered" id="polls"><a href="voting_module/polls.php"><i class="fa fa-5x fa-thumbs-up" aria-hidden="true"></i>
          <p> POLLS </p></a>
        </div>
        <div class="col-sm-2 col-centered" id="myaccount"><a href="myaccount_module/myaccount.php"><i class="fa fa-5x fa-home" aria-hidden="true"></i>
          <p> MY ACCOUNT </p></a>
        </div>
        <div class="col-sm-2 col-centered" id="options"><a href="options_module/generaloptions.php"><i class="fa fa-5x fa-cogs" aria-hidden="true"></i>
          <p> OPTIONS</p></a>
        </div>
        <div class="col-sm-2 col-centered" id="approval"><a href="dual_authentication_module/approval.php"><i class="fa fa-5x fa-check-square-o" aria-hidden="true"></i>
          <p> APPROVALS </p></a>
        </div>-->
        <div class="col-sm- col-centered"></div>

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

      window.onload = function() {
        var c = '<?php echo $_GET['userrole'] ?>';
        sortAccess(c);
      };

       function sortAccess(c)
        {
          //alert(c);
          //pass user role through switch and show or hide controls

          if(c == "admin")
          {
            <?php
              include('../db.php');
              $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '1'");
              while($row = mysqli_fetch_array($result))
                  {
                    $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];
                  }
            ?>
            document.getElementById('approval').style.visibility = "hidden";
          }
          else if(c == "ftdk")
          {
            alert(c);
            document.getElementById('users').style.visibility = "hidden";
            document.getElementById('polls').style.visibility = "hidden";
            document.getElementById('filemanager').style.visibility = "hidden";
            document.getElementById('options').style.visibility = "hidden";
            document.getElementById('approval').style.visibility = "hidden";
          }
          else if(c == "auth")
          {
            alert(c);
            document.getElementById('users').style.visibility = "hidden";
            document.getElementById('options').style.visibility = "hidden";
          }
          else if(c == "shder")
          {
            alert(c);
            document.getElementById('shareholders').style.visibility = "hidden";
            document.getElementById('users').style.visibility = "hidden";
            document.getElementById('options').style.visibility = "hidden";
            document.getElementById('approval').style.visibility = "hidden";
          }
          else if(c == "shderadmin")
          {
            alert(c);
            document.getElementById('approval').style.visibility = "hidden";
          }
          else if(c == "shderftdk")
          {
            alert(c);
            document.getElementById('users').style.visibility = "hidden";
            document.getElementById('polls').style.visibility = "hidden";
            document.getElementById('options').style.visibility = "hidden";
            document.getElementById('approval').style.visibility = "hidden";
          }
          else if(c == "shderauth")
          {
            alert(c);
            document.getElementById('users').style.visibility = "hidden";
            document.getElementById('options').style.visibility = "hidden";
          }
          

        } 
            //Store the password field objects into variables ...
           /* var pass1 = document.getElementById('password');
            var pass2 = document.getElementById('passwordconfirm');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field 
            //and the confirmation field
            if(pass1.value == pass2.value){
                //The passwords match. 
                //Set the color to the good color and inform
                //the user that they have entered the correct password 
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }

   case "ftdk":
            //code here
            alert("default1");
            break;

            case "auth":
            //code here
            alert("default2");
            break;

            case "shder":
            //code here
            alert("default3");
            break;

            case "shderadmin":
            //code here
            alert("default4");
            break;

            case "shderftdk":
            //code here
            alert("default5");
            break;

            case "shderauth":
            //code here
            alert("default6");
            break;

            */
 
    </script>



</body>

</html>