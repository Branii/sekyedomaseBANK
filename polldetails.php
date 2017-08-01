<?php
    require_once('../auth.php');
?>
<html>

<head>
<title>SMS-Polls</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link href="../assets/bootstrap_datetime_picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">MOTION-BASED POLL</div>

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
$member = mysqli_fetch_assoc($result);echo $member['userRoleTitle'];
                          }
                      }
                      ?>
                      <br/>
                      <a href="../index.php">Logout</a></p>
                </div>
            </div>

<form action="polldetailsexec.php" method="post">
  <div class="row polls-electorate">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <!--div class="form-group new-group-name">
            <div class="input-group input-group-md">
                <span class="input-group-addon gray"><span>Electorate Size</span></span>
                <div class="icon-addon addon-md">
                    <input type="number" class="form-control" id="electoratesize" name="electoratesize" placeholder="Must be more than 1" min="2" required>
                </div>
            </div>
        </div-->
        <p class=" head electorates ">SPECIFY ELECTORATE GROUP</p>

           <div class=" radio-left-buffer form">
          <div>
            <input type="radio" id="all_shareholders" name="radio" value="all_shareholders" checked />
            <label for="all_shareholders">   <span></span> All Shareholders  </label>
          </div>
          <!--div>
            <input type="radio" id="all_authorities" name="radio" value="all_authorities" />
            <label for="all_authorities">   <span></span> All Authorities</label>
          </div-->
          <div>
            <input type="radio" id="group" name="radio" value="group"/>
            <label for="group">   <span></span> Group </label>
          </div>
          <div class=" style-form  inner-left-buffer" id="groupselect">
              <select id="select-control" class="form-control"  onchange="changeId()"  name="shGroupName">
                <?php
                    include('../db.php');
                    $result = mysqli_query($link, "SELECT * FROM shgroup");
                    while($row = mysqli_fetch_array($result))
                        {
                            echo '<option value= '.$row['idShGroup'].'>'.$row['shGroupName'].'</option>';
                        }
                ?> 
                </select>
              
            </div>
          
        </div>
        <br/>
        <div class="form-group new-group-name">
                <label for="dtp_input1" class="col-md-2 control-label sidelabel">Start Date and Time</label>
                <div class="input-group date form_datetime col-md-5" data-date="2017-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" value="" name="startdatetime" readonly required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>
        </div>

        <div class="form-group new-group-name">
                <label for="dtp_input1" class="col-md-2 control-label sidelabel">Close Date and Time</label>
                <div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                    <input class="form-control" size="16" type="text" name="closedatetime" value="" readonly required>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
                <input type="hidden" id="dtp_input1" value="" /><br/>
           
        </div>
         <input type="hidden" id="pollid" name="pollid" value='<?php echo $_GET['pollid'];  ?>' />
     
    </div>
    <div class="col-sm-3"></div>
    
</div>

 <!--div class="col-xs-4 divider"> <button class="pull-left">cancel</button> </div-->
    <div class="col-xs-4 divider"> </div>
    <div class="col-xs-4 divider"> <button class="pull-right" type="submit">done</button> </div>
 </div>
 </form> 
        <!-- /.container-fluid -->
    </nav>
 

 <style>
     #start-date,#start-time,#end-date,#end-time{
    width:50%;


}
#select-control{
      visibility: hidden
    }
.divider{
    margin-top: 36px;
}
   button{
        width: 80px;
        padding-left: 16px;
        padding-right:16px;
    }
.polls-electorate{
    margin-top:88px;
    overflow-y: scroll;
}
p.electorates{
color:#7f6000;
}
.form{
    padding:0px;
margin:8px;
}
.select{
    margin-left: 20px;
}

.sidelabel{
  padding: 9px 12px;
  font-size: 14px;
  font-weight: normal;
  line-height: 1;
  color: #555;
  text-align: center;
  background-color: #eee;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 200px;
  height: 34px;
}

 </style>

<script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/bootstrap_datetime_picker/sample in bootstrap v3/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../assets/bootstrap_datetime_picker/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">

 function changeId(){
      var e = document.getElementById("select-control");
      var selectedid = e.options[e.selectedIndex].value;
      document.getElementById('group').value = selectedid;
      //alert(document.getElementById('group').value);
    }


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

 var rdBtn = document.getElementById("group");
 var rdBtnall_shareholders = document.getElementById("all_shareholders");
 var ischecked = true;
    rdBtn.addEventListener("click", function() {
        if (ischecked) {
            document.getElementById("select-control").style.visibility = "visible";
        }
    });
    rdBtnall_shareholders.addEventListener("click", function() {
        if (ischecked) {
            document.getElementById("select-control").style.visibility = "hidden";
        }
    });
  
</script>

</body>

</html>