<?php
    require_once('../auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/addnewshareholder.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">
                <div class="pull-left current-page"><a href="addshareholder.php">NEW SHAREHOLDER</a></div>
                <div class="pull-left actions-top-page"><a href="shareholders.php">SHAREHOLDERS</a></div>
                
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
                <h3 class="center center-text buffer-small">REGISTER A NEW SHAREHOLDER</h3>
                                <div class="col-sm-1"></div>
<div class="center col-sm-5">
    <form action="addshareholderexec.php" method="post" role="form" name="bioform">
	<div class="form-group form" id="newshareholderform">
                <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="Last Name" class="form style-form " id="lastname" name="lastname" required>
                    <label for="lastname" class="required" rel="tooltip" title="lastname">*</label>
                </div>
                  <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="Other Names" class="form style-form " id="othernames" name="othernames" required>
                    <label for="othernames" class="required" rel="tooltip" title="othernames">*</label>
                </div>
                  <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="Title" class="form style-form " id="title" name="title">
                    <label for="title" class="required" rel="tooltip" title="title"></label>
                </div>
                  <div class="icon-addon addon-md bottom-buffer-small">
                  <select class="form-control" name="gender" required>
                    <option value= "none">[Select Gender]</option>
                    <option value= "male">Male</option>
                    <option value= "female">Female</option>    
                  </select>
                </div>
                <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="House Number" class="form style-form " id="houseno" name="houseno">
                    <label for="houseno" class="required" rel="tooltip" title="houseno">*</label>
                </div>
                <div class="icon-addon addon-md bottom-buffer-small" >
                    <input type="text" placeholder="City" class="form style-form " id="city" name="city" required>
                    <label for="city" class="required" rel="tooltip" title="city">*</label>
                </div>
                 
                  <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="Telephone No." class="form style-form " id="phone" name="phone" required>
                    <label for="phone" class="required" rel="tooltip" title="phone">*</label>
                </div>
                <div class="icon-addon addon-md bottom-buffer-small">
                    <input type="text" placeholder="Branch" class="form style-form " id="branch" name="branch" required>
                    <label for="branch" class="required" rel="tooltip" title="branch">*</label>
                </div>
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
                 <input type="hidden" class="form style-form " id="userRoleId" name="userRoleId" value="3">
                <button type="submit">next</button>
            </div>
            </form>
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