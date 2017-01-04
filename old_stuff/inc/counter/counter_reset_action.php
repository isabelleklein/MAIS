<?php
	session_start();

	include('db_connection.php');        

	$oldpass = sha1($_POST['oldpass']);
	$newpass = sha1($_POST['newpass']);
	         
	$sql = "DELETE FROM counter"; 
     		
    $result = mysql_query($sql) or die (mysql_error()); 

	header("Location: settings.php?page=11&msg=reset");
    
	?>