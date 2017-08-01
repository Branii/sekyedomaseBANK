<?php 
session_start();
//global $activity;


 $activity= $_POST['ACTIVITY'];

if($activity=='getdetails')
{
  
   getDetails();
                        
}

else if($activity=='showDetails')
{
	//showDetails($activity);
   if( !isset($_SESSION['sessionVar7']) ) 
            { echo "not set"; }
        else{
        	echo $_SESSION['sessionVar7'];
        }
}
else if($activity=='getshareholder')
{
   getShareholder();
}
else if($activity=='startpoll')
{
   startPoll();
}
else if($activity=='endpoll')
{
   endPoll();
}

function startPoll()
{
  include('../db.php');
  $id=$_POST['pollId'];
  $today = date('d M Y - H:i a');

  $update1 = mysqli_query($link, "UPDATE poll SET pollStartDateTime = '$today' where idpoll='$id'");
  if($update1==1)
    {echo $today;}
  else{echo "error: could not open poll now";}
}

function endPoll()
{
  include('../db.php');
  $id=$_POST['pollId'];
  $today = date('d M Y - H:i a');

  $update2 = mysqli_query($link, "UPDATE poll SET pollCloseDateTime = '$today' where idpoll='$id'");
  if($update2==1)
    {echo $today;}
  else{echo "error: could not close poll now";}
}

function getShareholder()
{
  include('../db.php');
  $id=$_POST['shareholderId'];

  //$count= 0;
  $result3 = mysqli_query($link, "SELECT * FROM shareholder where idshareholder='$id'");
  while($row3 = mysqli_fetch_array($result3))
      {
          $shareholderSurname=$row3['shareholderSurname'];
          $shareholderOtherNames=$row3['shareholderOtherNames'];
          $shareholderPhoto=$row3['shareholderPhoto'];
          $shareholderfullname = $shareholderOtherNames.' '.$shareholderSurname;
          //++$count;
      }
      echo $shareholderfullname.'::'.$shareholderPhoto;
}



function getDetails()
    {
    	include('../db.php');
        
        $id=$_POST['pollId'];
        //$message = "";
        $pollOption= "";
        $count= 0;
        $result = mysqli_query($link, "SELECT * FROM poll where idpoll='$id'");
        while($row = mysqli_fetch_array($result))
            {
                $pollStartDateTime=$row['pollStartDateTime'];
                $pollCloseDateTime=$row['pollCloseDateTime'];
                $pollTitle=$row['pollTitle'];
                $pollElectorateSize=$row['pollElectorateSize'];
                $pollType=$row['pollType'];
                $pollElectorateGroup=$row['pollElectorateGroup'];

                switch ($pollType) {
                  case 'motion_based':
                    # code...
                    $result1 = mysqli_query($link, "SELECT * FROM motionbasedpoll WHERE pollId = '$id' ");
                          while($row1 = mysqli_fetch_array($result1))
                              {
                               // $pollOption[$count] = $row1['motionBasedPollOption'];
                                 $pollOption= $pollOption.$row1['motionBasedPollOption'].';;';
                                ++$count;
                              }

                    break;
                  case 'position_based':
                    # code...
                    $result2 = mysqli_query($link, "SELECT * FROM positionbasedpoll WHERE pollId = '$id' ");
                          while($row2 = mysqli_fetch_array($result2))
                              {
                                //$pollOption[$count] = $row2['shareholderId'];
                                $pollOption= $pollOption.$row2['shareholderId'].';;';
                                ++$count;
                              }
                    break;
                  
                  default:
                    # code...
                    break;
                }
                

                    $message = $pollStartDateTime.'::'.$pollCloseDateTime.'::'.$pollTitle.'::'.$pollElectorateSize.'::'.$pollType.'::'.$pollElectorateGroup.'::'.$count.':;:'.$pollOption;
                    
            }

       $_SESSION['sessionVar7'] = $message;
       //$_SESSION['sessionVar8'] = $count;
        echo  $message;
                     


    }
                                

?>