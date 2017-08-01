<?php

  
  include('../db.php');
              $c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_ADD_SHGP'] = 0;
              $_SESSION['ACT_DEL_SHGP'] = 0;
              $_SESSION['ACT_EDIT_SHGP'] = 0;
              $_SESSION['ACT_GROUP_SHGP'] = 0;
              $_SESSION['ACT_MSG_SHGP'] = 0;
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
                    
                    case '7':
                     if ($_SESSION['ACT_ADD_SHGP'] == 0) {
                        global $addshareholdergpbtn;
                         $addshareholdergpbtn = '<a href="addshareholdergroupname.php" class="list-group-item clearfix dark-background create-user">
                                                  <span class="glyphicon glyphicon-plus"></span> Create New group <span class="pull-right"></span>
                                                </a>';
                      $_SESSION['ACT_ADD_SHGP'] = 1; //add shareholders group
                      }
                        
                      break;
                    case '8':
                      if ($_SESSION['ACT_EDIT_SHGP'] == 0) {
                        global $editshareholdergpbtn;
                         $editshareholdergpbtn = '<div><i id="editgroup" onclick="editSelectedGroup();" class="fa fa-2x fa-pencil" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_EDIT_SHGP'] = 1; //edit shareholders group
                      }
                      
                      break;
                    case '10':
                      if ($_SESSION['ACT_MSG_SHGP'] == 0) {
                        global $msgshareholdergpbtn;
                         $msgshareholdergpbtn = '<div class="pull-left actions-top-page"><a href="../messaging_module/sendmessagemode.php">SEND MESSAGE</a></div>';
                      $_SESSION['ACT_MSG_SHGP'] = 1;//message shareholders group
                      }
                      
                      break;
                    case '17':
                      if ($_SESSION['ACT_DEL_SHGP'] == 0) {
                        global $delshareholdergpbtn;
                         $delshareholdergpbtn = '<div><i id="deletegroup" onclick="deleteSelectedGroup();" class="fa fa-2x fa-trash" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_DEL_SHGP'] = 1;//delete shareholders group
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              
            ?>