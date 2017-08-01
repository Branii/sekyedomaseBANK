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
        <div class="form-group new-group-name">
               <h3 class="center center-text buffer-small">ADD GROUP MEMBERS</h3>
            
        </div>
    </div>
    <div class="col-sm-4"></div>
    </div>
  

    <!--<div class="row">-->
    <div class="col-sm-1"></div>
    <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
        <!---->
        <div id="sidebar">
            <!--start of sidebar-->
            <div>
                <input type="text" placeholder="Search" class="form style-form dark-background " id="search">
            </div>
            
            <ul id="full_list">
            <?php
                    include('../db.php');
                    $result = mysqli_query($link, "SELECT * FROM shareholder ORDER BY shareholderSurname");
                    while($row = mysqli_fetch_array($result))
                        {
                            echo '<li>';
                          //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                            $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];
                            
                            echo '<td><div class="list-group-item clearfix" id="'.$row['idshareholder'].'">'.$fullname.'</div> </li>';
                           
                           
                        }
                ?> 
                
                
            </ul>
            <!--end of sidebar-->
        </div>
    </div>
    <div class="col-sm-2 icons text-center">
        <div class="right-icon">
            <span>
  Click to add members
</span></div>
        <div class="left-icon">
           <button onclick="addMember('<?php echo $_GET["shgroupid"]; ?>')">Save</button></div><br/><br/>
        <button onclick="window.location.replace('shareholdergroups.php')" value="Cancel">Back</button>
    </div>
    <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
        <!-- -->
        <div id="sidebar">
            <!--start of side bar-->
            <div>
                <div class="dark-background ">Group members</div>
            </div>
            <ul id="selected_list">
                <li>
                    
                </li>
            </ul>
            <!--end of sidebar-->
        </div>
    </div>

    <div class="col-sm-1"></div>

    <!--</div>-->
</div>
  
        </div>
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

      var usersA = document.getElementById("full_list");
      var usersB = document.getElementById("selected_list");

      var onclickA;
      var onclickB = function() {
              usersA.appendChild(this);
              this.onclick = onclickA;
              var mylist = usersB.getElementsByTagName("div");
              var shId = mylist[i].id;
              addMember();
              return false;
          };
      onclickA = function() {
              usersB.appendChild(this);
              this.onclick = onclickB;
              return false;
          };

      for (var i=0; i < usersA.getElementsByTagName("li").length; i++)
          usersA.getElementsByTagName("li")[i].onclick = onclickA;
      for (var i=0; i < usersB.getElementsByTagName("li").length; i++)      
          usersB.getElementsByTagName("li")[i].onclick = onclickB;

     
       

        function addMember(gid)
        {
          //alert('in function ');
            alert("Poll created successfully");
            window.location.href='shareholdergroups.php?alertsed';
          var groupId= gid;
          var usersB = document.getElementById("selected_list");
          var mylist = usersB.getElementsByTagName("div");
          var shId = new Array();
              for (var i=0; i < usersB.getElementsByTagName("div").length; i++)   {   
                var shId = mylist[i].id;
              
             // alert('shid '+ shId );
             // alert('groupId '+ gid );
              $.post('addgroupmembersexec.php', {shId: shId, groupId: groupId},
                    function(d,s){
                        //alert(d);
                 }

                 );


            }
           
          
         }






</script>

</body>

</html>