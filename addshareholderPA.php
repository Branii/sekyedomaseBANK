<?php
    require_once('../auth.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>SMS-Add Shareholder</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">NEW SHAREHOLDER</div>

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

            
                <div id="wrapper row" class="wrapper-row">
                    <div id="main-page"> 
                      <div class="col-sm-3"></div>
                      <div class="col-sm-5">
                        <form action="addshareholderPAexec.php" method="post" role="form" name="bioform">
                        	<div class="form-group form" id="newshareholderform">
                          <h3 class="head center center-text buffer-small">REGISTER A NEW SHAREHOLDER</h3>
                          <h4 class="head center center-text buffer-small">Payment Alternative (optional)</h4>
                          <div class="icon-addon addon-md bottom-buffer-small">
                              <input type="text" placeholder="Bank Name" class="form style-form " id="bankname" name="bankname">
                          </div>
                            <div class="icon-addon addon-md bottom-buffer-small">
                              <input type="text" placeholder="Branch" class="form style-form " id="branch" name="branch" >
                          </div>
                            
                          <div class="icon-addon addon-md bottom-buffer-small">
                              <input type="text" placeholder="Acount Number" class="form style-form " id="accountnumber" name="accountnumber">
                          </div>
                           
                           <input type="hidden" class="form style-form " id="shareholderId" name="shareholderId" value='<?php echo $_GET["shareholderid"]; ?>'>
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
   

</body>

</html>