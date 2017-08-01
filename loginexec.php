<?php
	
    //Start session
    session_start();
    
    //Connect to mysql server
    require "db.php";
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        include('db.php');
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }
    /*function encodeuser($pw) // function to encode as user
    {
        include('db.php');
        //get code from database
        $result1 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle = 'password_user_code'");
         while($row1 = mysqli_fetch_array($result1))
           {
            $uscode = $row1['generalOptionsValue'];
           }
        //encode password
        $encodedpassword = crypt($pw, $uscode);
        return $encodedpassword;
    }*/

    function encodeshareholder($pw) // function to encode as shareholder
    {
        include('db.php');
        //get code from database
        $result2 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_shareholder_code'");
         while($row2 = mysqli_fetch_array($result2))
           {
            $shcode = $row2['generalOptionsValue'];
           }
        //encode password
        $encodedpassword = crypt($pw, $shcode);
        return $encodedpassword;
    }
    
    //Sanitize the POST values
    $emailAddress = clean($_POST['emailAddress']);
  
    $password1 = clean($_POST['password']);
   

    //first encode as a user
    //$userpassword = encodeuser($password1);


    //encode as shareholder
    $shareholderpassword = encodeshareholder($password1);

    // define the status of the user
    $userstatus = "0";
    $shareholderstatus = "0";
    $status = $userstatus.''.$shareholderstatus;

   

    //search if shareholder
    $result1 = mysqli_query($link, "SELECT * FROM shareholder where shareholderEmail= '$emailAddress' and shareholderPassword = '$shareholderpassword'");
    
    if($result1) {
        if(mysqli_num_rows($result1) > 0) 
        {
         
            session_regenerate_id();
            $member = mysqli_fetch_assoc($result1);
            $_SESSION['SESS_MEMBER_ID'] = $member['idshareholder'];
            $_SESSION['SESS_MEMBER_USERROLE'] = $member['userRole_iduserRole'];
            $_SESSION['SESS_FULLNAME'] = ''.$member['shareholderSurname'].' '.$member['shareholderOtherNames'].'';
            //session_write_close();

            $userrole =  $_SESSION['SESS_MEMBER_USERROLE'];

            switch ($userrole) {
                case 1:
                    # admin
                 $_SESSION['SESS_USERROLE_LOGIN_TITLE'] = "admin";
                 header('location: home.php?userrole='.urldecode($_SESSION['SESS_USERROLE_LOGIN_TITLE']));
                    break;

                case 2:
                    # frontdesk
                $_SESSION['SESS_USERROLE_LOGIN_TITLE'] = "ftdk";
                header('location: home.php?userrole='.urldecode($_SESSION['SESS_USERROLE_LOGIN_TITLE']));
                    break;
                case 3:
                    # shareholder
                 $_SESSION['SESS_USERROLE_LOGIN_TITLE'] = "shder";
                 header('location: home.php?userrole='.urldecode($_SESSION['SESS_USERROLE_LOGIN_TITLE']));
                    break;
                
                default:
                    # other
                 $_SESSION['SESS_USERROLE_LOGIN_TITLE'] = "other";
                 header('location: home.php?userrole='.urldecode($_SESSION['SESS_USERROLE_LOGIN_TITLE']));
                    break;
            }
        }
    }
     
    
    //Create query
   /* $result = mysqli_query($link, "SELECT * FROM user where userEmail= '$emailAddress' and userPassword = '$password'");
    
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            //Login Successful
            session_regenerate_id();
            $member = mysqli_fetch_assoc($result);
            $_SESSION['SESS_MEMBER_ID'] = $member['idUser'];
            $_SESSION['SESS_MEMBER_USERROLE'] = $member['userRoleId'];
            $_SESSION['SESS_FULLNAME'] = ''.$member['userSurname'].' '.$member['userFirstName'].'';
            session_write_close();
            $userrole =  $_SESSION['SESS_MEMBER_USERROLE'];

            switch ($userrole) {
                case 1:
                    # admin
                header("location: home.php");
                    break;

                case 2:
                    # frontdesk
                header("location: frontdesk_user_module/home.php");
                    break;
                case 3:
                    # shareholder
                header("location: shareholder_user_module/home.php");
                    break;
                case 4:
                    # authority
                header("location: authority_user_module/home.php");
                    break;
                
                default:
                    # code...
                    break;
            }

            
        }else {
            //Login failed
            header("location: index.php");
            exit();
        }
    }else {
        die("Query failed");
    }*/
?>

