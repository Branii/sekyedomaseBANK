<?php
    require_once('../auth.php');
?>
<html>

<head>
    <title>SMS-Add Shareholder Group</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/groupregistration.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">
          <div class="pull-left current-page">CREATE SHAREHOLDER GROUP</div>
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




<div id="wrapper">
    <div class="row"> 
       
                                

  <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="form-group new-group-name"><br>
        <h3 class="center center-text buffer-small">SET GROUP NAME</h3><br>
        <form action="addshareholdergroupnameexec.php" method="post" role="form">
            <div class="input-group input-group-md">
                <span class="input-group-addon gray"><span>New Group</span></span>
                <div class="icon-addon addon-md">
                    <input type="text" placeholder="Group Name" class="form-control" id="groupname" name="groupname" required>
                </div>

            </div><br><br>
             <button type="submit" style="position: relative;left:60px;">next</button>
            </form>
<button type="cancel" style="position: relative;bottom:46px;"onclick="window.location.replace('shareholdergroups.php')">cancel</button>
        </div>
    </div>
    <div class="col-sm-4"></div>
    </div>
  

    <!--</div>-->
</div>
  
        </div>
        <!-- /.container-fluid -->
    </nav>

    
</body>

</html>