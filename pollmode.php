<?php
    require_once('../auth.php');
?>
<html>

<head>
    <title>SMS-Poll Mode</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">NEW POLL</div>
                <div class="pull-left actions-top-page "><a href="polls.php">POLLS</a></div>
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

            <div class="row ">
        

    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <form class="login-form" action="pollmodeexec.php" method="post">
        <div class="form-btn-group top-buffer">
          <p class=" head center text-center">MODE</p>
          <div class="center radio-left-buffer radio-buttons form">
            <div>
              <input type="radio" id="motion_based" name="radio" value="motion_based" />
              <label for="motion_based">    <span></span>    Motion Based </label>
            </div>
            <div>
              <input type="radio" id="position_based" name="radio" value="position_based" checked />
              <label for="position_based">   <span></span> Position Based  </label>
            </div>
          </div>
        </div>
        <div class="col-xs-4 divider"> </div>
        <div class="col-xs-4 divider"> <button class="pull-right" type="submit">next</button> 
        </div>
      </form>
    </div>
    

                </div>
            </div>
  
        <!-- /.container-fluid -->
    </nav>
 <style>
     .radio-buttons {
    padding-left: 22%;}

    button{
        width: 80px;
        padding-left: 16px;
        padding-right:16px;
        margin-top: 30px;
    }

    .divider{
        margin-top:15%;
    }
 </style>
</body>

</html>