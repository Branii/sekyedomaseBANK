<?php
    require_once('../auth.php');
    require_once('sharetransactionaccess.php');
?>
<html>

<head>
<meta charset="utf-8" />
<title>SMS-Share Transactions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/shareholdertransaction.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="../assets/bootstrap_datetime_picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
     <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
</head>

<body>
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">SHARE TRANSACTIONS</div>
                 <?php 
                    if (isset($shareholder)) {
                        echo $shareholder;
                    }
                 ?>

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
            <div id="wrapper row" class="">
                    <div id="main-page">
                      <div class="row light-background main-content">

                      <?php if(isset($_GET["alertsuccess"])): ?>
                            <div class="span4">
                            <br>
                                      <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Success!</strong> Password Changed
                                      </div>
                             </div>

                        <?php endif; ?> 
                    <?php if(isset($_GET["alertfailure"])): ?>
                            <div class="span4">
                            <br>
                                      <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>Error!</strong> Incorrect Password
                                      </div>
                             </div>

                        <?php endif; ?> 


                        <div class="col-sm-3">

                        </div>
                        <div class="col-sm-6 middle-content">
                            <div class="row">
                             <div class="middle-div">
                                    <div class=" form-width style-form form">
                                        <p class="head center-text">Share Transactions</p>
                                        <div class="menu-buttons">
                                            <?php 
                                            if (isset($sharetransactionbtn)) {
                                                echo $sharetransactionbtn;
                                            }
                                            if (isset($sharetransferbtn)) {
                                                echo $sharetransferbtn;
                                            }
                                            
                                             ?>
                                        </div>
                                        <?php
                                            include('../db.php');
                                            $currentUserId = $_SESSION['SESS_MEMBER_ID'];
                                            $shid = $_GET['shareholderid'];
                                            $result = mysqli_query($link, "SELECT * FROM sharetransactionlog WHERE shareholder_idshareholder = '$shid' order by idsharetransactionlog desc");
                                            while($row = mysqli_fetch_array($result))
                                                {
                                                    
                                                    //$fullname = $row['userSurname']." ".$row['userFirstName'];
                                                    

                                                    echo '<table class="menu-buttons"><tbody>';
                                                    echo '<th class="table-head add-padding">Date</th>';
                                                    echo '<th class="table-head" id="logdate">'.$row['shareTransactionLogDate'].'</th>';
                                                    echo '<tr class="table-row">';
                                                    echo '<td class="table-column">Price per Share </td>';
                                                    echo '<td id="pricepershare">'.$row['shareTransactionLogSharePrice'].'</td></tr>';
                                                    echo '<tr class="table-row">';
                                                    echo '<td class="table-column">Number of Shares </td>';
                                                    echo '<td id="shareno">'.$row['shareTransactionLogShareAmount'].'</td></tr>';
                                                    echo '<tr class="table-row">';
                                                    echo '<td class="table-column">Total Amount </td>';
                                                    echo '<td id="totalamount">'.$row['shareTransactionLogSharePrice'] * $row['shareTransactionLogShareAmount'].'</td></tr>';
                                                    echo '</tbody></table>';
                                                   
                                                   
                                                }
                                        ?> 
                                        
                                    </div>
                                </div>
         
                             
                                
                            </div>
                        </div>
                         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Client Details</h4>
                                    </div>
                                     <form action="addsharetransactionexec.php" method="post" role="form">
                                        <div class="modal-body">
                                          
                                            <input type="hidden" id="shareholderId" name="shareholderId" value="<?php echo $_GET['shareholderid'];?>" class="form-control"><br>
                                            Date:<div class="input-group date form_datetime" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                                <input class="form-control" size="16" type="text" name="datetime" value="" readonly required>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                            </div><br>
                                            Current Share Price (GHc):<br><input type="number" id="shareprice" step="0.01" name="shareprice" value="0.5" class="form-control" readonly><br>
                                            Number of Shares being Purchased:<br><input type="number" min="0" id="shareamount" name="shareamount" value="" class="form-control" required><br>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button  type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                     </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="..assets/js/jquery.metisMenu.js"></script>
    
         <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>

    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
            showMeridian: 1
        });

      
    </script>
</body>

</html>