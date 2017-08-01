<?php
    require_once('../auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left actions-top-page"><a href="shareholders.php">SHAREHOLDERS</a></div>
                <div class="pull-left current-page"><a href="addshareholder.php">NEW SHAREHOLDER</a></div>
                 <div class="pull-left actions-top-page"><a href="shareholdergroups.php">GROUPS</a></div>
                <div class="pull-left actions-top-page"><a href="../messaging_module/sendmessagemode.php">SEND MESSAGE</a></div>
                <div class="pull-left actions-top-page"><a href="../home.php">HOME</a></div>
                
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

            <div class="row ">
                <h3 class="center center-text buffer-small">REGISTRATION COMPLETE</h3>
  
                 
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
   

</body>

</html>