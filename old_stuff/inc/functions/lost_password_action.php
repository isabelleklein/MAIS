<?php

	include('function_collection.php');

	$email = $_POST[email];



clean_user_input($email);

$rs_search = mysql_query("select user_email from users where user_email='$_POST[email]'");
$user_count = mysql_num_rows($rs_search);

if ($user_count != 0){
    $newpass = md5(rand(100000,999999));
    $newpass = substr($newpass, 0 , 8);
    $updatepass = sha1($newpass);
	
   	mysql_query("UPDATE users SET user_pw = '$updatepass'
     			WHERE user_email = '$email'");
    

	//E-Mailparts erstellen
	
	$header = "AUTO-RESPONSE: Ihr Passwort wurde zurückgesetzt";
	$server = $_SERVER['HTTP_HOST'];
	$host = ereg_replace('www.','',$server);
	$from = "From: \"Gebäudereiniger Innung Rheinhessen-Pfalz\" <no-reply@$host>\r\n";
	
	$content = "Guten Tag, \n \n Ihr neues Password: $newpass \n\n\n Mit freundlichen Grüßen, \n\n Gebäudereiniger Innung Rheinhessen-Pfalz";	
	

	//E-Mail versenden
	
	mail($email, $header, $content, $from);
		
  
	     
	header("Location: ?page=908&msg=send");			
   	
   	}
   	else {
   		header("Location: ?page=908&msg=error");   	
   		}

   ?>