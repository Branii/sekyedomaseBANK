<?php
    require_once('../auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>SMS-Add User</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/addnewshareholder.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">
                <div class="pull-left current-page">NEW USER</div>
                <div class="pull-left actions-top-page"><a href="users.php">USERS</a></div>
                <div class="pull-left actions-top-page"><a href="<?php echo '../home.php?userrole='.$_SESSION['SESS_USERROLE_LOGIN_TITLE']; ?>" >HOME</a></div>

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

            <div id="wrapper row" class="wrapper-row">
            <div id="main-page">   
            <div class="col-sm-3"></div>
            <div class="center col-sm-6">
                <form  action="adduserexec.php" method="post" role="form" name="bioform">

              	<div class="form-group form" id="newuserform">
                <h3 class="head center center-text buffer-small">ADD A NEW USER</h3>
                  <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="text" placeholder="Last Name" class="form style-form " id="lastname" name="lastname" required>
                      <label for="lastname" class="required" rel="tooltip" title="lastname">*</label>
                  </div>
                    <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="text" placeholder="First Name" class="form style-form " id="firstname" name="firstname" required>
                      <label for="firstname" class="required" rel="tooltip" title="firstname">*</label>
                  </div>
                    <div class="icon-addon addon-md bottom-buffer-small">
                    <select class="form-control" name="gender" required>
                      <option value= "none">[Select Gender]</option>
                      <option value= "male">Male</option>
                      <option value= "female">Female</option>    
                    </select>
                  </div>
                  <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="text" placeholder="Address" class="form style-form " id="address" name="address">
                      <label for="address" class="required" rel="tooltip" title="address">*</label>
                  </div>
                    <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="text" placeholder="Telephone No." class="form style-form " id="phone" name="phone" required>
                      <label for="phone" class="required" rel="tooltip" title="phone">*</label>
                  </div>
                  <!--div class="icon-addon addon-md bottom-buffer-small">
                    <select class="form-control" name="userroleId" required>
                      <option value="null">[Assign User Role]</option>
                    <?php
                       /* include('../db.php');
                        $result = mysqli_query($link, "SELECT * FROM userRole");
                        while($row = mysqli_fetch_array($result))
                            {
                                echo '<option value= '.$row['iduserRole'].'>'.$row['userRoleTitle'].'</option>';
                            }*/
                    ?>  
                    </select>
                  </div-->
                   <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="text" placeholder="Email" class="form style-form " id="email" name="email" required>
                      <label for="email" class="required" rel="tooltip" title="email">*</label>
                  </div>
                   <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="password" placeholder="Password" class="form style-form " id="password" name="password" required>
                      <label for="password" class="required" rel="tooltip" title="password">*</label>
                  </div>
                  <div class="icon-addon addon-md bottom-buffer-small">
                      <input type="password" placeholder="Password Confirm" class="form style-form " id="passwordconfirm" onkeyup="checkPass(); return false;"required>
                      <label for="passwordconfirm" class="required" rel="tooltip" title="passwordconfirm">*</label>
                  </div>
                  <button type="submit">next</button>
              </div>
            </form>
        </div>
             <div class="col-sm-3"></div> 
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
    <script type="text/javascript">
       function checkPass()
        {
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('password');
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
}  
    </script>

</body>

</html>