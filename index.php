<?php
  //Start session
  session_start();
  
  //Unset the variables stored in session
  unset($_SESSION['SESS_MEMBER_ID']);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>SMS-Login</title>
    <link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  </head>
<body>
 <nav class="">
    <div class="container-fluid">
      <div class="row nav-pane">
        <div class="pull-left current-page">SMS</div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </nav>

<div class="login-page">
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
                                <strong>Error!</strong> Incorrect username or password
                          </div>
                 </div>

            <?php endif; ?> 
  <div class="form style-form ">
    <p class="head">LOGIN</p>
    <form class="login-form" role="form" action="loginexec.php" method="post">
      <input type="text" placeholder="E-mail Address" name = "emailAddress" value="joanamensah@gmail.com" required/>
      <input type="password" placeholder="Password" name = "password" value="password" required/>
      <button type="submit">login</button>
    </form>
  </div>
</div>
<script src="js/bootstrap.js"> </script>

</body>
</html>