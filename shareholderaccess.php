<?php

  
  include('../db.php');
              $c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_ADD_SH'] = 0;
              $_SESSION['ACT_DEL_SH'] = 0;
              $_SESSION['ACT_EDIT_SH'] = 0;
              $_SESSION['ACT_GROUP_SH'] = 0;
              $_SESSION['ACT_MSG_SH'] = 0;
              if($c == "admin")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '1'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                      showicons(17); //show account
                    }
              }
              else if($c == "ftdk")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '2'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "auth")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '4'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "shder")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "other")
              {
                $userroleid = $_SESSION['SESS_MEMBER_USERROLE'];
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '$userroleid'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "shderadmin")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '1' OR userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                      showicons(17); //show account
                    }
              }
              else if($c == "shderftdk")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '2' OR userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "shderauth")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '4' OR userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }
              else if($c == "shderother")
              {
                $shuserroleid = $_SESSION['SESS_MEMBER_USERROLE'];
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '$shuserroleid' OR userRole_iduserRole = '3'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                    }
              }

        
          function showicons($activity)
              {
                  switch ($activity) {
                    
                    case '1':
                     if ($_SESSION['ACT_ADD_SH'] == 0) {
                        global $addshareholderbtn;
                         $addshareholderbtn = '<a href="addshareholder.php" class="list-group-item clearfix dark-background create-user"><span class="glyphicon glyphicon-plus"></span> New Shareholder <span class="pull-right"></a></span>';
                      $_SESSION['ACT_ADD_SH'] = 1; //add shareholders 
                      }
                        
                      break;
                    case '2':
                      if ($_SESSION['ACT_EDIT_SH'] == 0) {
                        global $editshareholderbtn;
                         $editshareholderbtn = '<div><i id="editshareholder" onclick="editSelectedShareholder();" class="fa fa-2x fa-pencil" aria-hidden="true"></i><div>';
                      $_SESSION['ACT_EDIT_SH'] = 1; //edit shareholders 
                      }
                      
                      break;
                    case '7':
                    case '8':
                      if ($_SESSION['ACT_GROUP_SH'] == 0) {
                        global $groupshareholderbtn;
                         $groupshareholderbtn = '<div class="pull-left actions-top-page"><a href="shareholdergroups.php">GROUPS</a></div>';
                      $_SESSION['ACT_GROUP_SH'] = 1;//group shareholders
                      }
                      
                      break;
                    case '10':
                      if ($_SESSION['ACT_MSG_SH'] == 0) {
                        global $msgshareholderbtn;
                         $msgshareholderbtn = '<div class="pull-left actions-top-page"><a href="../messaging_module/sendmessagemode.php">SEND MESSAGE</a></div>';
                      $_SESSION['ACT_MSG_SH'] = 1;//message shareholders
                      }
                      
                      break;
                    case '17':
                      if ($_SESSION['ACT_DEL_SH'] == 0) {
                        global $delshareholderbtn;
                         $delshareholderbtn = '<div><i id="deleteshareholder" onclick="deleteSelectedShareholder();" class="fa fa-2x fa-trash" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_DEL_SH'] = 1;//delete shareholders
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              
            ?>