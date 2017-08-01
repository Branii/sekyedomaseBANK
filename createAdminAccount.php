<html>

<head>
  <!--link rel="stylesheet" type="text/css" href="css/bootstrap.css"-->
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
  <div class="login-page">
    <div class="form">
      <p class="head">ADMIN ACCOUNT SETUP</p>
      <form class="login-form" action="adduserexec.php" method="post" role="form">
        <input type="text" placeholder="First Name" name = "userFirstname"/>
        <input type="text" placeholder="Last Name" name = "userSurname"/>
        <input type="text" placeholder="Address" name = "userAddress"/>
        <input type="text" placeholder="Phone No." name = "userPhone"/>
        <input type="email" placeholder="E-mail" name = "userEmail"/>
        <input type="password" placeholder="Password" name = "userPassword"/>
        <input type="password" placeholder="Confirm Password" name = "userPasswordConfirm"/>
        <input type="hidden" name = "userRoleId" value="1" />
         <!--i future autogenerate password and send to user email -->
         <!--Password Confirm:<br><input type="text" name="userPasswordConfirm" class="ed"><br> -->
        <button>done</button>

      </form>
    </div>
  </div>
  </script>

</body>

</html>