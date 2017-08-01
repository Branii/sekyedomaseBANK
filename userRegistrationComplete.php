<?php
    require_once('../auth.php');
?>
<html>
  <head>
    <title>SMS-Registration Complete</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="user_photo/css/style.css">
  </head>
<body>
<nav class="">
    <div class="container-fluid">
      <div class="row nav-pane">
        <div class="pull-left current-page">USER</div>
        <div class="pull-right image">
                    <?php
                      include('../db.php');
                      $userId = $_SESSION['SESS_MEMBER_ID'];
                      $result1 = mysqli_query($link, "SELECT * FROM user where idUser= '$userId'");
                
                        if($result1) {
                          if(mysqli_num_rows($result1) > 0) {
                              //Login Successful
                              $member = mysqli_fetch_assoc($result1);
                              $photo = $member['userPhoto'];
                              
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
    </div>
    <!-- /.container-fluid -->
  </nav>
  <div id="wrapper row" class="wrapper-row">
    <div id="main-page">
  <div class="container-fluid">
    <div class="login-page">
      <div class="form center">
        <p class="head center-text">USER REGISTRATION COMPLETE!</p>
            <div class="row">
              <div class="col-xs-2">   </div>   
              <div class="col-xs-8"><span onclick="window.location.replace('adduser.php')" class="upload_btn">Register New User</span></div>
              <div class="col-xs-2">   </div> 
            </div>
            <br>
            <div class="row">
              <div class="col-xs-2">   </div>   
              <div class="col-xs-8"><span onclick="window.location.replace('users.php')" class="upload_btn">View All Users</span></div>
              <div class="col-xs-2">   </div> 
            </div>  
      </div>
    </div>
  </div>
  </div>
  </div>
<script src="../js/bootstrap.js"> </script>

</body>
</html>