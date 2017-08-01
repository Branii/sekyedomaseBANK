<?php
    require_once('../auth.php');
    require_once('pollsaccess.php');
?>
<html>

<head>
    <title>SMS-Voting</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/voting.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">VOTING</div>
                <div class="pull-left actions-top-page action-top-page-menu-selected"><a href="shareholderpoll.php">POLLS</a></div>

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
                <!--a href="../index.php">Logout</a--></p>
            </div>
            </div>


<!--details page-->
<div id="wrapper row" class="wrapper-row">
    <div id="main-page">
      <div class="row light-background">
      <?php

          include('../db.php');
          $pollid=$_GET['pollId'];

          $result = mysqli_query($link, "SELECT * FROM poll where idpoll='$pollid'");
          while($row = mysqli_fetch_array($result)) {
              $pollTitle = $row['pollTitle'];
              echo '<div id="polltitle" class="voting-title">'.$pollTitle.'</div>';
               echo '<div class="option-row">';
              $result1 = mysqli_query($link, "SELECT * FROM motionbasedpoll WHERE pollId = '$pollid' ");
              while($row1 = mysqli_fetch_array($result1))
              {
                  // $pollOption[$count] = $row1['motionBasedPollOption'];
                  $pollOption= $row1['motionBasedPollOption'];
                  $optionId= $row1['idmotionBasedPoll'];

                  echo '
                  <div class="col-sm-2">
                    <div id="option_1" class="voting-option">'.$pollOption.'</div>
                      <div id="addVote" class="vote-icon" onclick= "countVote('.$pollid.','.$optionId.')">
                       <span id="addvotespan" class="fa-stack fa-3x fa-lg">
                        <i id='.$pollid.' class="fa fa-circle  fa-stack-2x"></i>
                        <i id='.$pollOption.' class="fa fa-thumbs-up fa-stack-1x "></i>
                       </span>
                      </div>
                  </div>
              ';
              }
               echo '</div>';
          }

          ?>
      </div>
  </div>
</div>

<!--end of details page-->
                            
        </div>
  
        <!-- /.container-fluid -->
    </nav>
 

 <style>
   .vote-text{
    width:100%;
    text-align: center;
}
.option-row{
  margin:auto;
}
.voting-title{
    color: #999999;
    font-size: 2.5em;
    text-align: center;
    margin: 50px;
}
.vote-icon{
    color:white;
    width:100%;
    text-align: center;
    margin-top:8px;
}
.fa-thumbs-up{
    color:#595959;
}

.candidate-image{
    width: 60%;
    margin: 30px 20%;
    margin-top: 30px;
    margin-right: 20%;
    margin-bottom: 30px;
    margin-left: 20%;
}
   .voting-option{
       color: #d29500;
       font-size: 25px;
       /* margin-left: 20px;*/
       text-align: center;
   }

   #addvotespan{
    cursor: pointer;

}

 </style>
    <script src="../assets/js/jquery-3.2.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
<script type="text/javascript">


    function countVote(pollid, pollOption) {
        var addVote = document.getElementById("addVote");
        addVote.onclick = window.location.replace("motionbasedaddvote.php?pollId=" + pollid + "&pollOption=" + pollOption);
        return false;


    }

</script>

</body>

</html>