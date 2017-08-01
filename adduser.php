<?php
    require_once('auth.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dreambrander Office Dashboard</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
          
        <?php  
         include('header.php');
         include('sidebar.php');
          ?>
          <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Add New User</h2>   
                    </div>
                </div>
                 <hr />
                <div class="col-md-6">
                <form action="adduserexec.php" method="post" role="form">
                    Surname:<br><input type="text" name="userSurname" class="form-control"><br>
                    Other Names:<br><input type="text" name="userOtherNames" class="form-control"><br>
                    E-mail Address:<br><input type="text" name="userEmail" class="form-control"><br>
                    Password:<br><input type="password" name="userPassword" class="form-control"><br>
                    <!--i future autogenerate password and send to user email -->
                    <!--Password Confirm:<br><input type="text" name="userPasswordConfirm" class="ed"><br> -->
                    
                        User Role: <br>
                        <select class="form-control" name="userRoleId">
                        <?php
                            include('db.php');
                            $result = mysqli_query($link, "SELECT * FROM db_user_role");
                            while($row = mysqli_fetch_array($result))
                                {
                                    echo '<option value= '.$row['db_user_roleId'].'>'.$row['db_user_roleTitle'].'</option>';
                                }
                        ?> 
                        </select>
                    <br>
                    
                    <input type="submit" value="Save" id="buttonSave" class="btn btn-default">
               
				</div>     
            </div>
        </div>
       
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
