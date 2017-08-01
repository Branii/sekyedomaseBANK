<?php
require_once('../auth.php');
require_once('useraccess.php');
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/addnewshareholder.css">
    <link rel="stylesheet" type="text/css" href="../css/editshareholder.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
<nav class="">
    <div class="container-fluid">
        <div class="row nav-pane">
            <div class="pull-left current-page">EDIT USER</div>
            <div class="pull-left actions-top-page"><a href="users.php">USERS</a></div>
            <div class="pull-left actions-top-page"><a href="<?php echo '../home.php?userrole='.$_SESSION['SESS_USERROLE_LOGIN_TITLE']; ?>" >HOME</a></div>

            <div class="pull-right">
                <img class="img-circle head-user-image" src="http://elsewer.com/wp-content/uploads/2016/11/Nana-Araba-Ansah-elsewer.jpg"/>
            </div>

            <div class="pull-right text-right">
                <p><?php echo $_SESSION['SESS_FULLNAME']; ?><br/>
                    <br/>
                    <a href="../index.php">Logout</a></p>
            </div>
        </div>

        <h3 class="center center-text buffer-small">EDIT SELECTED USER</h3>
        <?php

        $userid = $_GET['userId'];

        include('../db.php');
        $userRoleId = $_SESSION['SESS_MEMBER_USERROLE'];
        $result = mysqli_query($link, "SELECT * FROM user where idUser= '$userid'");

        $row = mysqli_fetch_array($result);

        $firstname = $row['userFirstName'];
        $lastname = $row['userSurname'];
        $gender = $row['userGender'];
        $address = $row['userAddress'];
        $phone= $row['userPhone'];
        $mail = $row['userEmail'];


echo'

        <div class="row ">

            <div class="picture-placehoder center">
                <img class="profile-image" id="profileimage" name="profileimage" src="crop_photo/images/userphotos/'.$row['userPhoto'].'"/>
            </div>

            <div class="row">
                <div class="col-xs-2"> </div>
                <div class="col-xs-8">
                    <label class="fileContainer">  <span class="center upload-btn"><a href="crop_photo/index.php?userId='.urldecode($row['idUser']).'"> Upload a Picture</a></span>
                        <!--input class="center" type="file" name="pic" accept="image/*"-->
                    </label>
                </div>
                <div class="col-xs-2"> </div>   
            </div>
            
            <div class="center-text">(Image size limit-5mb)</div>



            
                <form action="edituserexec.php?userid='.$userid.'" method="post" role="form" name="userdetails">
                <div class="col-sm-1"></div>
                <div class="center col-sm-5">

                    <div class="form-group form" id="newuserform">
                        <div class="icon-addon addon-md bottom-buffer-small">
                            <input type="text" placeholder="Last Name" class="form style-form " id="lastname" name="lastname" value="'.$lastname.'">
                            <label for="lastname" class="required" rel="tooltip" title="lastname"></label>
                        </div>
                        <div class="icon-addon addon-md bottom-buffer-small">
                            <input type="text" placeholder="First Name" class="form style-form " id="firstname" name="firstname" value="'.$firstname.'">
                            <label for="firstname" class="required" rel="tooltip" title="firstname"></label>
                        </div>
                        <div class="icon-addon addon-md bottom-buffer-small">
                            <select class="form-control" name="gender" required>
                                <option value= "none">'.$gender.'</option>
                                <option value= "male">Male</option>
                                <option value= "female">Female</option>
                            </select>
                        </div>
                        <div class="icon-addon addon-md bottom-buffer-small">
                            <input type="text" placeholder="Address" class="form style-form " id="address" name="address" value="'.$address.'">
                            <label for="address" class="required" rel="tooltip" title="address"></label>
                        </div>
                        <div class="icon-addon addon-md bottom-buffer-small">
                            <input type="text" placeholder="Telephone No." class="form style-form " id="phone" name="phone" value="'.$phone.'">
                            <label for="phone" class="required" rel="tooltip" title="phone"></label>
                        </div>

                        <div class="icon-addon addon-md bottom-buffer-small">
                            <input type="text" placeholder="Email" class="form style-form " id="email" name="email" value="'.$mail.'">
                            <label for="email" class="required" rel="tooltip" title="email"></label>
                        </div>

                        <button type="submit">update</button>
                    </div>
                </form>

            </div>

        </div>';
?>
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
  /*  function checkPass()
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
    }*/
</script>

</body>

</html>