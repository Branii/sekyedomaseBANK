<?php

$activity = $_POST['ACTIVITY'];
if (isset($_POST['ACTIVITY'])) {
	if($activity=="verify")
	{
		$password1 = $_POST['password'];
		$res = verifyPassword($password1);
		//echo $res;
	}
}

function verifyPassword($password){
	$verificationstatus = false;
		//check for length
		$passlength = checkLength($password);
	       if ($passlength ==  false) {
	       	$verificationstatus = false;
	       	echo "password too short";
	       }
	       else{// length verified
	       		// check for number
	       		$hasnumber = checkForNumber($password);
	       		if ($hasnumber == 0) {
	       			# no number
	       			$verificationstatus = false;
       				echo "password has no number";
	       		}

	       		else{// number verified
	       			//check for uppercase letter
	       			$hasuppercase = checkForUppercase($password);
	       			if ($hasuppercase == 0) {
		       			# no number
		       			$verificationstatus = false;
	       				echo "password has no uppercase letter";
	       			}
	       			else{// uppercase letter verified
	       				//check for special character
	       				$hasspecialchar = checkForSpecialchar($password);
	       				if ($hasspecialchar == 0) {
			       			# no special character
			       			$verificationstatus = false;
		       				echo "password has no special character";
	       				}
	       				else{
	       					$verificationstatus = true;
	       					echo "true";
	       					//return $verificationstatus;
	       				}

	       			}

	       		}
	       }
   return $verificationstatus;
}

function checkLength($password){
	//get min password length
	include('db.php');
	$passlength = false;
	//$minlength = 0;
	$result = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'min_password_length'");
	     while($row = mysqli_fetch_array($result))
	       {
	        $minlength = $row['generalOptionsValue'];
	       
		       if (strlen($password) >= $minlength) {
		       	$passlength = true;
		       }
		   }
   return $passlength;
}

function checkForNumber($password){
	$hasnumber = 0;
	//get requirements- number
	include('db.php');
	$result1 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_require_number'");
	     while($row1 = mysqli_fetch_array($result1))
	       {
	        $requirenumber = $row1['generalOptionsValue'];
	       
		       if($requirenumber==1)
		       {//require number
		       		if(1 === preg_match('~[0-9]~', $password)){
					    #has numbers
					    $hasnumber = 1;
					}
		       }
		       else{ //require no number
		       		$hasnumber = 2;
		       }
		   }
	       return $hasnumber;
}

function checkForUppercase($password){
	$hasuppercase = 0;
	//get requirements- uppercase
	include('db.php');
	$result2 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_require_uppercase_letter'");
	     while($row2 = mysqli_fetch_array($result2))
	       {
	        $requireuppercase = $row2['generalOptionsValue'];
	       
		       if($requireuppercase==1)
		       {//require uppercase
		       		if(1 === preg_match('~[A-Z]~', $password)){
					    #has uppercase
					    $hasuppercase = 1;
					}
		       }
		       else{ //require no uppercase
		       		$hasuppercase = 2;
		       }
		   }
	       return $hasuppercase;
}

function checkForSpecialchar($password){
	$hasspecialchar = 0;
	//get requirements- specialchar
	include('db.php');
	$result3 = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'password_require_special_character'");
	     while($row3 = mysqli_fetch_array($result3))
	       {
	        $requirespecialchar = $row3['generalOptionsValue'];
	       
		       if($requirespecialchar==1)
		       {//require specialchar
		       		if(1 === preg_match('!@#$%^&*()', $password)){
					    #has specialchar
					    $hasspecialchar = 1;
					}
		       }
		       else{ //require no specialchar
		       		$hasspecialchar = 2;
		       }
		   }
	       return $hasspecialchar;
}

?>