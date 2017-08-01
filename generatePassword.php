<?php 

include('verifyPassword.php');
function generatePassword()
{
	include('db.php');
	
	//get min password length
	$minlength = 5;
	$result = mysqli_query($link, "SELECT * FROM generaloptions where generalOptionsTitle= 'min_password_length'");
	     while($row = mysqli_fetch_array($result))
	       {
	        $minlength = $row['generalOptionsValue'];
	       }
	       $generatedpassword = random_str($minlength+5);
	       $status = verifyPassword($generatedpassword);
	       if ($status == true) {
	       	return $generatedpassword;
	       }
	       else{
	       	generatePassword();
	       }
}

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()')
	{
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}



?>