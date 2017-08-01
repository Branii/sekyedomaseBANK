<?php

  
  include('../db.php');
              $c = $_SESSION['SESS_USERROLE_LOGIN_TITLE'];
              $_SESSION['ACT_SH_TRANSACTION'] = 0;
              $_SESSION['ACT_SH_TRANSFER'] = 0;
              $_SESSION['ACT_SH'] = 0;
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
                    case '2':
                    case '7':
                    case '8':
                    case '10':
                     if ($_SESSION['ACT_SH'] == 0) {
                        global $shareholder;
                         $shareholder = '<div class="pull-left actions-top-page"><a href="shareholders.php">SHAREHOLDERS</a></div>';
                      $_SESSION['ACT_SH'] = 1; //shareholders
                      }
                        
                      break;
                    case '19':
                     if ($_SESSION['ACT_SH_TRANSACTION'] == 0) {
                        global $sharetransactionbtn;
                         $sharetransactionbtn = '<a class="create-transaction" data-toggle="modal" data-target="#myModal"><span class="icon-padding glyphicon glyphicon-plus"></span>New Transaction<span class="pull-right"></span></a>';
                      $_SESSION['ACT_SH_TRANSACTION'] = 1; //share transaction 
                      }
                        
                      break;
                    case '20':
                      if ($_SESSION['ACT_SH_TRANSFER'] == 0) {
                        global $sharetransferbtn;
                         $sharetransferbtn = '<a href="#" class="transfer-shares">
                                                <span class="icon-padding glyphicon glyphicon-send"></span>Transfer Shares <span class="pull-right"></span>
                                              </a>';
                      $_SESSION['ACT_SH_TRANSFER'] = 1; //share transfer
                      }
                      
                      break;
                    
                    default:
                      //do nothing
                      break;
                  }
                
                   
              }

              
            ?>