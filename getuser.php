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
            { echo ""; }
        else{
        	echo $_SESSION['sessionVar7'];
        }
}
else if($activity=='getCurrentUserPassword')
{
    //showDetails($activity);
   $currentUserId = $_SESSION['SESS_MEMBER_ID'];
   $result2 = mysqli_query($link, "SELECT * FROM user where idUser='$currentUserId '");
        while($row2 = mysqli_fetch_array($result2))
            {
                $userPassword=$row2['userPassword'];
                echo $userPassword;
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
        
        $id = $_POST['userId'];
        $_SESSION['sessionVar1'] = $id;
        $result = mysqli_query($link, "SELECT * FROM user where idUser='$id'");
        while($row = mysqli_fetch_array($result))
            {
                $userSurname=$row['userSurname'];
                $userFirstName=$row['userFirstName'];
                $userGender=$row['userGender'];
                $userAddress=$row['userAddress'];
                $userPhone=$row['userPhone'];
                $userEmail=$row['userEmail'];
                $userPhoto=$row['userPhoto'];
                $userRoleId=$row['userRoleId'];

                 $userFullname= $userSurname." ".$userFirstName;
                
                $result1 = mysqli_query($link, "SELECT * FROM userRole where iduserRole ='$userRoleId'");
                while($row1 = mysqli_fetch_array($result1))
                    {
                        $userRoleTitle=$row1['userRoleTitle'];
                    }
  

                    $message =''.$userFullname. '::'.$userGender.'::'.$userAddress.'::'.$userPhone.'::'.$userEmail.'::'.$userPhoto.'::'.$userRoleTitle;
                    $count = 0;
               
                  //  $message =''.$message.':count:'.$count.'';
                    $_SESSION['sessionVar7'] = $message;
                    $_SESSION['sessionVar8'] = $count;
                        echo  $message;
                     
            }

       


    }
                                

?>