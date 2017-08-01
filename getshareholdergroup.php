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
else if($activity=='getCount')
{
   if( !isset($_SESSION['sessionVar8']) ) 
            { echo 0; }
        else{
            echo $_SESSION['sessionVar8'];
        }
}





function getDetails()
    {
    	include('../db.php');
        
        $id=$_POST['shareholderGroupId'];
        $message = "";
        $result = mysqli_query($link, "SELECT * FROM shareholder_shGroup where shGroupId='$id'");
        while($row = mysqli_fetch_array($result))
            {
                $shareholderId=$row['shareholderId'];

                 $result1 = mysqli_query($link, "SELECT * FROM shareholder WHERE idshareholder = '$shareholderId' ");
                          while($row1 = mysqli_fetch_array($result1))
                              {
                                $shareholderName = $row1['idshareholder'];
                                $shareholderFullname = "".$row1['shareholderTitle']." ".$row1['shareholderOtherNames']." ".$row1['shareholderSurname'];
                                $shareholderPhoto = $row1['shareholderPhoto'];
                            }

                    $message = $message.':::'.$shareholderFullname. '::'.$shareholderPhoto;
                    $count = 0;
            }

       $_SESSION['sessionVar7'] = $message;
       $_SESSION['sessionVar8'] = $count;
        echo  $message;
                     


    }
                                

?>