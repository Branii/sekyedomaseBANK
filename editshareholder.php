<?php
    require_once('../auth.php');
?>
<html>

<head>
    <title>SMS- Edit Shareholder</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/editshareholder.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

                <div class="pull-left current-page">EDIT SHAREHOLDER</div>

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
                    <?php
                        include('../db.php');
                        $currentUserId = $_SESSION['SESS_MEMBER_ID'];
                        $shid = $_GET['shareholderid'];
                        $result = mysqli_query($link, "SELECT * FROM shareholder WHERE idshareholder = '$shid'");
                        while($row = mysqli_fetch_array($result))
                            {
                                $row['shareholderGender'];
                                if ($row['shareholderGender']=="male") {
                                    # code...
                                    $selectedgender = '<select class="form-control" name="gender" required>
                                                <option value= "none">[Select Gender]</option>
                                                <option value= "male" selected >Male</option>
                                                <option value= "female">Female</option>    
                                              </select>';
                                }
                                else if ($row['shareholderGender']=="female") {
                                    # code...
                                    $selectedgender = '<select class="form-control" name="gender" required>
                                                <option value= "none">[Select Gender]</option>
                                                <option value= "male">Male</option>
                                                <option value= "female" selected>Female</option>    
                                              </select>';
                                }
                                else{
                                    $selectedgender = '<select class="form-control" name="gender" required>
                                                <option value= "none" selected>[Select Gender]</option>
                                                <option value= "male">Male</option>
                                                <option value= "female">Female</option>    
                                              </select>';
                                }

                              $result1 = mysqli_query($link, "SELECT * FROM shareholdernextofkin WHERE shareholder_idshareholder = '$shid'");
                                while($row1 = mysqli_fetch_array($result1))
                                    {
                                        $row1['shareholderNextOfKinSurname'];
                                      $result2 = mysqli_query($link, "SELECT * FROM shareholderpaymentalternative WHERE shareholder_idshareholder = '$shid'");
                                        while($row2 = mysqli_fetch_array($result2))
                                            {
                                                $bankname = $row2['shareholderPaymentAlternativeBankName'];   
                                                
                                       
                                       
                                    
                            echo'
                            <div class="picture-placehoder center">
                                <img class="profile-image" id="profileimage" name="profileimage" src="../'.$row['shareholderPhoto'].'"/>
                            </div>

                            <div class="row">
                                <div class="col-xs-2"> </div>
                                <div class="col-xs-8"> 
                                    <label class="fileContainer">  <span class="center upload-btn"><a href="crop_photo/index.php?shareholderSerialNo='.urldecode($row['shareholderSerialNo']).'"> Upload a Picture</a></span>
                                        <!--input class="center" type="file" name="pic" accept="image/*"-->
                                    </label>
                                </div>
                                <div class="col-xs-2"> </div>
                            </div>
                                <div class="center-text">(Image size limit-5mb)</div>
                            <form action="editshareholderexec.php" method="post" role="form" name="bioform">
                                 <div class="row ">
                            <div class="col-sm-1"></div>
                            <div class="center col-sm-5">
                    
                                <div class="form-group form" id="newshareholderform">
                                <h4 class="center center-text buffer-small">BIODATA</h4>
                                             <input type="hidden"  value="'.$_GET['shareholderid'].'" id="shareholderid" name="shareholderid" >
                                            <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Surname" value="'.$row['shareholderSurname'].'" class="form style-form " id="lastname" name="lastname" required>
                                                <label for="lastname" class="required" rel="tooltip" title="lastname">*</label>
                                            </div>
                                              <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Other Names" value="'.$row['shareholderOtherNames'].'" class="form style-form " id="othernames" name="othernames" required>
                                                <label for="othernames" class="required" rel="tooltip" title="othernames">*</label>
                                            </div>
                                              <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Title" value="'.$row['shareholderTitle'].'" class="form style-form " id="title" name="title">
                                                <label for="title" class="required" rel="tooltip" title="title"></label>
                                            </div>
                                              <div class="icon-addon addon-md bottom-buffer-small">
                                              '.$selectedgender.'
                                            </div>
                                            <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="House Number" value="'.$row['shareholderHouseNo'].'" class="form style-form " id="houseno" name="houseno">
                                                <label for="houseno" class="required" rel="tooltip" title="houseno">*</label>
                                            </div>
                                            <div class="icon-addon addon-md bottom-buffer-small" >
                                                <input type="text" placeholder="City" value="'.$row['shareholderCity'].'" class="form style-form " id="city" name="city" required>
                                                <label for="city" class="required" rel="tooltip" title="city">*</label>
                                            </div>
                                             
                                              <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Telephone No." value="'.$row['shareholderPhone'].'" class="form style-form " id="phone" name="phone" required>
                                                <label for="phone" class="required" rel="tooltip" title="phone">*</label>
                                            </div>
                                            <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Branch" value="'.$row['shareholderBranch'].'" class="form style-form " id="branch" name="branch" required>
                                                <label for="branch" class="required" rel="tooltip" title="branch">*</label>
                                            </div>
                                             <div class="icon-addon addon-md bottom-buffer-small">
                                                <input type="text" placeholder="Email" value="'.$row['shareholderEmail'].'" class="form style-form " id="email" name="email" required>
                                                <label for="email" class="required" rel="tooltip" title="email">*</label>
                                            </div>
                                             <input type="hidden" class="form style-form " id="userRoleId" name="userRoleId" value="3">
                                            
                                        </div>
                            
                        </div>
                            

                            <div class="col-sm-5">
                                <div class="form-group form" id="newshareholderform">
                                <h4 class="center center-text buffer-small">NEXT OF KIN (OPTIONAL)</h4>
                                    <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Last Name" value="'.$row1['shareholderNextOfKinSurname'].'" class="form style-form " id="noklastname" name="noklastname">
                                    </div>
                                      <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Other Names" class="form style-form" value="'.$row1['shareholderNextOfKinOtherNames'].'" id="nokothernames" name="nokothernames" >
                                    </div>
                                      
                                    <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Address" class="form style-form" value="'.$row1['shareholderNextOfKinAddress'].'" id="address" name="address">
                                    </div>
                                    <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="City" class="form style-form" value="'.$row1['shareholderNextOfKinCity'].'" id="city" name="city">
                                    </div>
                                <br>
                                <h4 class="center center-text buffer-small">PAYMENT ALTERNATIVE (OPTIONAL)</h4>
                                    <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Bank Name" value="'.$row2['shareholderPaymentAlternativeBankName'].'"" class="form style-form " id="bankname" name="bankname">
                                    </div>
                                      <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Branch" value="'.$row2['shareholderPaymentAlternativeBranch'].'" class="form style-form " id="pabranch" name="pabranch" >
                                    </div>
                                      
                                    <div class="icon-addon addon-md bottom-buffer-small">
                                        <input type="text" placeholder="Acount Number" value="'.$row2['shareholderPaymentAlternativeAccountNumber'].'" class="form style-form " id="accountnumber" name="accountnumber">
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-12 buttons">
                 <div class="pull-left cancel-button">
                                        <button onclick="window.location.replace("shareholders.php")" >cancel</button>
                                    </div>
                                   
                                     <div class="pull-right  done-button">
                                        <button type="Submit">done</button>
                                    </div>
                             </div>
                               </div>
                             
                            </form>
                   
                  ';}} }
                ?> 
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

</body>

</html>