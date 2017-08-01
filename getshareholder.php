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
else if($activity=='getCount')
{
   if( !isset($_SESSION['sessionVar8']) ) 
            { echo 0; }
        else{
            echo $_SESSION['sessionVar8'];
        }
}
else if($activity=='getJobs')
{
   if( !isset($_SESSION['sessionVar9']) ) 
            { echo 0; }
        else{
            echo $_SESSION['sessionVar9'];
        }
}
else if($activity=='deleteJobAssignment')
{
include('../db.php');

    $item= $_POST['item'];
    $item1 = explode(" - ", $item);
    $client = $item1[0];
    $services = $item1[1];
    $clientId = $servicesId = $jobId = 0;
    $userId = $_SESSION['sessionVar1'];

//getting client id with client name
    $result6 = mysqli_query($link, "SELECT * FROM db_client where db_clientName='$client'");
    while($row6 = mysqli_fetch_array($result6))
        {
            $clientId=$row6['db_clientId'];    
        }

        //getting service id with service title
        $result7 = mysqli_query($link, "SELECT * FROM db_services where db_servicesTitle='$services'");
    while($row7 = mysqli_fetch_array($result7))
        {
            $servicesId=$row7['db_servicesId'];
        }

        //getting job id with client id and service id
     $result8 = mysqli_query($link, "SELECT * FROM db_job where db_client_db_clientId='$clientId' AND db_services_db_servicesId = '$servicesId'");
    while($row8 = mysqli_fetch_array($result8))
    {
        $jobId=$row8['db_jobId'];
    }

//delete user job from user job table
   if( !isset($_SESSION['sessionVar1']) ) 
            { echo "error"; }
        else{
            $result8 = mysqli_query( $link,  "DELETE FROM db_job_has_db_user WHERE db_job_db_jobId='$jobId' AND db_user_db_userId='$userId'");
           // $_SESSION['sessionVar1'] = "";
            echo $result8;
        }
}




function getDetails()
    {
    	include('../db.php');
        
        $id = $_POST['shareholderId'];
        $_SESSION['sessionVar1'] = $id;
        $jobs = "";
        $result = mysqli_query($link, "SELECT * FROM shareholder where idshareholder='$id'");
        while($row = mysqli_fetch_array($result))
            {
                $shareholderSerialNo=$row['shareholderSerialNo'];
                $shareholderSurname=$row['shareholderSurname'];
                $shareholderOtherNames=$row['shareholderOtherNames'];
                $shareholderTitle=$row['shareholderTitle'];
                $shareholderGender=$row['shareholderGender'];
                $shareholderHouseNo=$row['shareholderHouseNo'];
                $shareholderCity=$row['shareholderCity'];
                $shareholderPhone=$row['shareholderPhone'];
                $shareholderBranch=$row['shareholderBranch'];
                $shareholderEmail=$row['shareholderEmail'];
                $shareholderPhoto=$row['shareholderPhoto'];

                 $shareholderFullname= "".$shareholderTitle." ".$shareholderOtherNames." ".$shareholderSurname;
                
                $result1 = mysqli_query($link, "SELECT * FROM shareholderNextOfKin where shareholder_idshareholder ='$id'");
                while($row1 = mysqli_fetch_array($result1))
                    {
                        $shareholderNextOfKinSurname=$row1['shareholderNextOfKinSurname'];
                        $shareholderNextOfKinOtherNames=$row1['shareholderNextOfKinOtherNames'];
                        $shareholderNextOfKinAddress=$row1['shareholderNextOfKinAddress'];
                        $shareholderNextOfKinCity=$row1['shareholderNextOfKinCity'];

                        $shareholderNextOfKinFullname = "".$shareholderNextOfKinOtherNames." ".$shareholderNextOfKinSurname;
                    }

                $result2 = mysqli_query($link, "SELECT * FROM shareholderPaymentAlternative where shareholder_idshareholder ='$id'");
                while($row2 = mysqli_fetch_array($result2))
                    {
                        $shareholderPaymentAlternativeBankName=$row2['shareholderPaymentAlternativeBankName'];
                        $shareholderPaymentAlternativeBranch=$row2['shareholderPaymentAlternativeBranch'];
                        $shareholderPaymentAlternativeAccountNumber=$row2['shareholderPaymentAlternativeAccountNumber'];

                    }    

                    $message =''.$shareholderSerialNo. '::'.$shareholderFullname.'::'.$shareholderGender.'::'.$shareholderHouseNo.'::'.$shareholderCity. '::'.$shareholderPhone.'::'.$shareholderBranch.'::'.$shareholderEmail.'::'.$shareholderNextOfKinFullname.'::'.$shareholderNextOfKinAddress.'::'.$shareholderNextOfKinCity.'::'.$shareholderPaymentAlternativeBankName.'::'.$shareholderPaymentAlternativeBranch.'::'.$shareholderPaymentAlternativeAccountNumber.'::'.$id.'::'.$shareholderPhoto.'';
                    $count = 0;
               
                  //  $message =''.$message.':count:'.$count.'';
                    $_SESSION['sessionVar7'] = $message;
                    $_SESSION['sessionVar8'] = $count;
                        echo  $message;
                     
            }

       


    }
                                

?>