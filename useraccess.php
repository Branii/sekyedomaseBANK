<?php

  
  include('../db.php');
              $c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_ADD_USER'] = 0;
              $_SESSION['ACT_DEL_USER'] = 0;
              $_SESSION['ACT_EDIT_USER'] = 0;
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
                    
                    case '5':
                     if ($_SESSION['ACT_ADD_USER'] == 0) {
                        global $adduserbtn;
                         $adduserbtn = '<a href="adduser.php" class="list-group-item clearfix dark-background create-user">
                                          <span class="glyphicon glyphicon-plus"></span> Add New User <span class="pull-right"></span>
                                        </a>';
                      $_SESSION['ACT_ADD_USER'] = 1; //add shareholders group
                      }
                        
                      break;
                    case '6':
                      if ($_SESSION['ACT_EDIT_USER'] == 0) {
                        global $edituserbtn;
                         $edituserbtn = '<div><i class="fa fa-2x fa-pencil" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_EDIT_USER'] = 1; //edit shareholders group
                      }
                      
                      break;
                    case '17':
                      if ($_SESSION['ACT_DEL_USER'] == 0) {
                        global $deluserbtn;
                         $deluserbtn = '<div><i (click)="onDeleteSelectedShareholder();" class="fa fa-2x fa-trash" aria-hidden="true"></i></div>';
                      $_SESSION['ACT_DEL_USER'] = 1;//delete shareholders group
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              
            ?>