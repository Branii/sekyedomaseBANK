<?php 
session_start();
//global $activity;

function clean($str) {
        include('../db.php');
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysqli_real_escape_string($link, $str);
    }

     $activity=clean($_POST['ACTIVITY']);

     switch ($activity) {
         case 'addnewpoll':
             # code...
         addnewpoll();
             break;
         case 'addcandidate':
             # code...
         addcandidate();
             break;
         case 'endsave':
             # code...
         endsave();
             break;
         
         default:
             # code...
             break;
     }

     
     function addnewpoll()
     {
        $pollTitle=clean($_POST['pollTitle']);

        $today = date("Y-m-d H:i:s"); 

        //$currentUserId = $_SESSION['SESS_MEMBER_ID'];

        include('../db.php');

        $update=mysqli_query($link, "INSERT INTO poll (pollDateTimeCreated, pollTitle, pollType)
        VALUES
        ('$today','$pollTitle','position_based')");
       // echo $update;
        if($update == 1)
        {
            $result = mysqli_query($link, "SELECT idpoll FROM poll ORDER BY idpoll desc LIMIT 1");
             $row = mysqli_fetch_array($result);
                  $pollid = $row['idpoll'];
                    echo  $pollid;
            
        }
        else{echo "ERROR";}
     }

     function addcandidate()
     {
        $pollId=clean($_POST['pollId']);
        $shId=clean($_POST['shId']);
        include('../db.php');

        $update1=mysqli_query($link, "INSERT INTO positionbasedPoll (pollId, shareholderId)
             VALUES
             ('$pollId','$shId')");
       
        if($update1 == 1)
           {
             echo $update1;
           } 
          else{echo  "ERROR";}


     }

     function endsave()
     {
        $pollid=clean($_POST['pollId']);
        $action=clean($_POST['c']);

        if($action == "continue")
        {
            header('location: polldetails.php?pollid='.urldecode($pollid));
            exit();
        }
            else{
                header('Location:polls.php?alertfailure='.urldecode("Error in Poll Creation"));
                 exit();
            }

     }


   



                                

?>