<?php
    require_once('../auth.php');
?>
<html>

<head>
    <title>SMS-Motion-based Poll</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/votingmotionbased.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
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
                              $member = mysqli_fetch_assoc($result);
                              echo $member['userRoleTitle'];
                            }
                        }
                        ?>
            <br/>
            <a href="../index.php">Logout</a></p>
                </div>
            </div>
    <form action="motionbasedpollexec.php" method="post">
      <div class="row motion-based">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="form-group new-group-name">
                <div class="input-group input-group-md">
                    <span class="input-group-addon gray"><span>Topic</span></span>
                    <div class="icon-addon addon-md">
                        <input type="text" placeholder="Enter Title" class="form-control" id="topic" name="topic" required>
                    </div>

                </div>
            </div>
            <p class="add-options center text-center">ADD OPTIONS</p>
            <div id="options">
            <div class="form-group new-group-name">
                <div class="input-group input-group-md">
                    <span class="input-group-addon gray"><span>Option 1</span></span>
                    <div class="icon-addon addon-md">
                        <input type="text" placeholder="Enter Option 1" class="form-control" id="option_1" name="option_1" required>
                    </div>
                </div>
            </div>
            <div id="div1" class="form-group new-group-name">
                <div id="div2" class="input-group input-group-md">
                    <span id="span1" class="input-group-addon gray">
                        <span id="optionno">Option 2</span>
                    </span>
                    <div id="div3" class="icon-addon addon-md">
                        <input type="text" placeholder="Enter Option 2" class="form-control" id="option_2" name="option_2" required>
                    </div>
                </div>
            </div>
            
            </div>
             <input type="hidden"  id="count" name="count"  value="2">
            <div class="text-center add-new-option">
                <span class="fa-stack fa-2x fa-lg" id="addoption"><a>
                  <i class="fa fa-circle-thin fa-stack-2x"></i>
                  <i class="fa fa-plus fa-stack-1x "></i></a>
                </span>
                <span class="text">ADD MORE OPTIONS</span>
            </div>
        </div>
        <div class="col-sm-4"></div>
    
</div>

 <div class="col-xs-4 divider"> <button class="pull-left"onclick="window.location.replace('polls.php')" value="Cancel">cancel</button> </div>
    <div class="col-xs-4 divider"> </div>
    <div class="col-xs-4 divider"> <button class="pull-right" type="submit">save and continue</button> </div>
            </div>
    </form>
  
        <!-- /.container-fluid -->
    </nav>

    <script src="../assets/js/jquery-3.2.1.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
    
         <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>

    <script type="text/javascript">

var addoption = document.getElementById("addoption");

    var count = 2;
    var countinput = document.getElementById('count');
    
    addoption.addEventListener('click', function(ev)
    {
        //var serviceID = ev.target.id;
        count = count+1;
        countinput.value = count;
        //alert(count);  
        addOption(count);
        getCount(count);
        
    });

    function getCount()
    {
        return count;
    }
  

     function addOption(i)
        {
                    
                    var clonediv1 = new Array();
                    var clonediv2 = new Array();
                    var clonespan1 = new Array();
                    var cloneoptionno = new Array();
                    var clonediv3 = new Array();
                    var cloneoption_2 = new Array();

                     var optionsdiv = document.getElementById('options');

                     //clone div 1
                     var div1 = document.getElementById('div1');
                     clonediv1[i] = div1.cloneNode(true);

                     //clone div 2
                     var div2 = document.getElementById('div2');
                     clonediv2[i] = div2.cloneNode(true);

                     //clone span 1
                     var span1 = document.getElementById('span1');
                     clonespan1[i] = span1.cloneNode(true);

                     //clone optionno and update innerhtml
                     var optionno = document.getElementById('optionno');
                     cloneoptionno[i] = optionno.cloneNode(true);
                     cloneoptionno[i].innerHTML = 'Option '+ i;

                     //clone div 3
                     var div3 = document.getElementById('div3');
                     clonediv3[i] = div3.cloneNode(true);

                     //clone option_2 and update id and name
                     var option_2 = document.getElementById('option_2');
                     cloneoption_2[i] = option_2.cloneNode(true);
                     cloneoption_2[i].id = 'option_'+i;
                     cloneoption_2[i].name = 'option_'+i;
                     cloneoption_2[i].placeholder = 'Enter Option '+i;
                     //alert(cloneoption_2[i].id);

                     //clear clonediv3 and append new input(cloneoption2)
                     clonediv3[i].innerHTML = '';
                     clonediv3[i].appendChild(cloneoption_2[i]);

                      //clear clonespan1 and append span(cloneoptionno)
                     clonespan1[i].innerHTML = '';
                     clonespan1[i].appendChild(cloneoptionno[i]);

                     //clear clonediv3 and append clonespan1 and clonediv3
                     clonediv2[i].innerHTML = '';
                     clonediv2[i].appendChild(clonespan1[i]);
                     clonediv2[i].appendChild(clonediv3[i]);

                     clonediv1[i].innerHTML = '';
                     clonediv1[i].appendChild(clonediv2[i]);

                     optionsdiv.appendChild(clonediv1[i]);


            
        }

       

</script>
 
</body>

</html>