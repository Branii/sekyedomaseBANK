<?php
    require_once('../auth.php');
?>
<html>
  <head>
    <title>SMS-Voting Complete</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../shareholder_module/shareholder_photo/css/style.css">
  </head>
<body>
<nav class="">
    <div class="container-fluid">
      <div class="row nav-pane">
        <div class="pull-left current-page">POLLS</div>
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
    </div>
    <!-- /.container-fluid -->
  </nav>
  <div id="wrapper row" class="wrapper-row">
    <div id="main-page">
      <div class="container-fluid">
        <div class="login-page">
          <div class="form center">
            <p class="head center-text">VOTING COMPLETE!</p>
                <div class="row">
                  <div class="col-xs-2">   </div>   
                  <div class="col-xs-8"><span onclick="window.location.replace('shareholderpoll.php')" class="upload_btn">Back to Polls</span></div>
                  <div class="col-xs-2">   </div> 
                </div>
                <br> 
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="../assets/bootstrap/js/bootstrap.js"> </script>
<script src="../assets/bootstrap/js/bootstrap.min.js"> </script>

</body>
</html>