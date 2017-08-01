<?php
    require_once('../auth.php');
?>
<html>

<head>
    <title>SMS-Polls</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/votingpositionbased.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">POSITION-BASED POLL</div>

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
        <div class="input-group input-group-md">
          <span class="input-group-addon gray"><span>Position Title</span></span>
          <div class="icon-addon addon-md">
            <input type="text" placeholder="Enter Title" class="form-control" id="topic" name="topic" required>
          </div>

        </div>
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
        <input type="text" placeholder="Search" class="search form style-form" id="search">
      </div>
       <ul class="list" id="full_list">
            <?php
                    include('../db.php');
                    $result = mysqli_query($link, "SELECT * FROM shareholder WHERE userRole_iduserRole = '3' ORDER BY shareholderSurname");
                    while($row = mysqli_fetch_array($result))
                        {
                            echo '<li>';
                          //  echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['db_clientId'].'</td>';
                            $fullname = $row['shareholderSurname']." ".$row['shareholderOtherNames'];
                            
                            echo '<td><div class="list-group-item clearfix" id="'.$row['idshareholder'].'">'.$fullname.'</div> </li>';
                           
                           
                        }
                ?> 
                
                
            </ul>
            <ul class="pagination"></ul> 
      <!--end of sidebar-->
    </div>
  </div>
  <div class="col-sm-2 icons text-center">
        <div class="right-icon">
            <span>
  Click to add candidates
</span></div>
        <div class="left-icon">
           <button onclick="addPoll(); " class="medium-button">Save</button></div><br>
           <button onclick="window.location.replace('polls.php')" class="medium-button" value="Cancel">cancel</button>

    </div>
  <div class="col-sm-4 left-sidebar" id="sidebar-wrapper">
    <!-- -->
    <div id="sidebar">
      <!--start of side bar-->
      <div>
        <div class="candidates-title" id="candidates">Candidates</div>
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
    <!-- for pagination-->
    <script src="../assets/js/jquery.min.js"></script>  
    <script src="../assets/js/list.min.js"></script>
     <script type="text/javascript">

      var monkeyList = new List('sidebar', {
      valueNames: ['list-group-item clearfix'],
      page: 10,
      pagination: true
    });

      var usersA = document.getElementById("full_list");
      var usersB = document.getElementById("selected_list");

      var onclickA;
      var onclickB = function() {
        //alert("clicked");
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

      var pollid;
       function addPoll()
       {
        var topic = $('#topic').val();
        if (topic != "") 
        {
          $.post('positionbasedpollexec.php', {ACTIVITY: "addnewpoll", pollTitle: topic},
                    function(d,s){
                        //alert(d);
                        if(d != "ERROR")
                        {
                          //alert("adding candidates now");
                          pollid = d;
                          addCandidate(d);
                        }
                 }
                 );
        }
        else{
          alert("Please enter Poll Title");
        }
         
       }

        function addCandidate(pollid)
        {
          //alert('in function ');
          var count = 0;
          var pollId= pollid;
          var usersB = document.getElementById("selected_list");
          //alert("users no: "+usersB.getElementsByTagName("div").length);
          //alert("count "+count);
          var mylist = usersB.getElementsByTagName("div");
          var shId = new Array();
              for (var i=0; i < usersB.getElementsByTagName("div").length; i++)   {   
                var shId = mylist[i].id;
              
             // alert('shid '+ shId );
             // alert('groupId '+ gid );
              $.post('positionbasedpollexec.php', {ACTIVITY:"addcandidate", shId: shId, pollId: pollId},
                    function(d,s){
                      
                 }
                 );
                ++count;
               // alert("user no: "+i);
               // alert("count "+count);
            }
            
            if(count == usersB.getElementsByTagName("div").length)
            {
             // alert("redirecting");
            // endSave("continue", pollId);
            setTimeout(function(){window.location.href='polldetails.php?pollid='+pollId},5000);
            //window.location.replace("polldetails.php?pollid=" +pollId);
            
            }
            else{
                  
              //alert("Error: Please Retry");
                // endSave("error", pollId);
              }
           
          
         }

         function getpollid()
         {
            return pollid;
         }

         function endSave(c, pollId)
         {
          alert("here");

          $.post('positionbasedpollexec.php', {ACTIVITY:"endsave" ,c: c, pollId: pollId},
                    function(d,s){
                      alert("redirecting");
                      alert('d '+d);
                 }
                 );
          
         }

</script>
 
</body>

</html>