<?php

  
  include('../db.php');
              $c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_ADD_POLL'] = 0;
              $_SESSION['ACT_DEL_POLL'] = 0;
              $_SESSION['ACT_EDIT_POLL'] = 0;
              $_SESSION['ACT_START_END_POLL'] = 0;
              if($c == "admin")
              {
                $result = mysqli_query($link, "SELECT * FROM userrole_has_systemactivities where userRole_iduserRole = '1'");
                while($row = mysqli_fetch_array($result))
                    {
                      $activity = $row['systemActivities_idsystemActivities'];
                      showicons($activity);
                      showicons(17); //delete account
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
                    
                    case '3':
                     if ($_SESSION['ACT_ADD_POLL'] == 0) {
                        global $addpollbtn;
                         $addpollbtn = '<a href="pollmode.php" class="list-group-item clearfix dark-background create-user">
                                        <span class="glyphicon glyphicon-plus"></span> Create New Poll <span class="pull-right"></span>
                                      </a>';
                      $_SESSION['ACT_ADD_POLL'] = 1; //add shareholders group
                      }
                        
                      break;
                    case '4':
                      if ($_SESSION['ACT_EDIT_POLL'] == 0) {
                        global $editpollbtn;
                         $editpollbtn = '<div><i class="fa fa-2x fa-pencil"id="dellpoll" onclick="editSelectedpoll()" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_EDIT_POLL'] = 1; //edit shareholders group
                      }
                      
                      break;
                    case '9':
                      if ($_SESSION['ACT_START_END_POLL'] == 0) {
                        global $startpollbtn;
                        global $endpollbtn;
                         $startpollbtn = '<span class="input-group-addon color-green" onClick = "startPoll()"><span>Open Now</span></span>';
                         $endpollbtn = '<span class="input-group-addon color-red" onClick = "endPoll()"><span>Close Now</span></span>';
                      $_SESSION['ACT_START_END_POLL'] = 1; //edit shareholders group
                      }
                      
                      break;
                    case '17':
                      if ($_SESSION['ACT_DEL_POLL'] == 0) {
                        global $delpollbtn;
                         $delpollbtn = '<div><i class="fa fa-2x fa-trash"   id="editpoll" onclick="deleteSelectedpoll()" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_DEL_POLL'] = 1;//delete shareholders group
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              
            ?>