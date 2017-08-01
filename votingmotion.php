<?php
    require_once('../auth.php');
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body class="">
    <nav class="">
        <div class="container-fluid">
            <div class="row nav-pane">

               <div class="pull-left current-page">VOTING</div>
                <div class="pull-left actions-top-page action-top-page-menu-selected"><a href="shareholderpoll.php">POLLS</a></div>

             <div class="pull-right image">
  <img class="img-circle head-user-image" src="https://s-media-cache-ak0.pinimg.com/736x/84/d2/0e/84d20eb6d69995bbbc178df518b1ea96.jpg"
  />
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
<div class="row  dark-background">

    <div class="voting-title">Vice President of the Board</div>
    <div class="col-sm-2"></div>
    <div class="col-sm-2">
        <img class="img-circle candidate-image" src="https://pacdn.500px.org/5912688/db94abcbb3e4b9860dc05997af169df571154768/1.jpg?14"
        />
        <div class="vote-text">Abigail Affum</div>
        <div class="vote-icon">
      <span class="fa-stack fa-3x fa-lg">
  <i class="fa fa-circle  fa-stack-2x"></i>
  <i class="fa fa-thumbs-up fa-stack-1x "></i>
</span></div>
    </div>
    <div class="col-sm-2">
        <img class="img-circle candidate-image" src="https://s-media-cache-ak0.pinimg.com/564x/2e/e6/32/2ee63259eee0a08fb6d5a7064a336354.jpg"
        />
        <div class="vote-text">Abigail Affum</div>
        <div class="vote-icon">
      <span class="fa-stack fa-3x fa-lg">
  <i class="fa fa-circle  fa-stack-2x"></i>
  <i class="fa fa-thumbs-up fa-stack-1x "></i>
</span></div>

    </div>
    <div class="col-sm-2">
        <img class="img-circle candidate-image" src="https://s-media-cache-ak0.pinimg.com/736x/8e/3c/51/8e3c51c5fe9ce4a8a66ad7daa2b8ec18.jpg"
        />
        <div class="vote-text">Abigail Affum</div>
        <div class="vote-icon">
      <span class="fa-stack fa-3x fa-lg">
  <i class="fa fa-circle  fa-stack-2x"></i>
  <i class="fa fa-thumbs-up fa-stack-1x "></i>
</span></div>

    </div>
    <div class="col-sm-2">
        <img class="img-circle candidate-image" src="https://pacdn.500px.org/5912688/db94abcbb3e4b9860dc05997af169df571154768/1.jpg?14"
        />
        <div class="vote-text">Abigail Affum</div>
        <div class="vote-icon">
      <span class="fa-stack fa-3x fa-lg">
  <i class="fa fa-circle  fa-stack-2x"></i>
  <i class="fa fa-thumbs-up fa-stack-1x "></i>
</span></div>

    </div>
    <div class="col-sm-2"></div>
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
.voting-title{
    color: White;
    font-size: 48px;
    font-weight: 400;
    text-align: center;
    margin: 50px;
}

.dark-background{
    padding-bottom: 1000px;
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

 </style>

</body>

</html>