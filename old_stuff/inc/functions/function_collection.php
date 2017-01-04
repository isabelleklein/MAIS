<?php
	
	session_start();
	
	//Datenbankverbindung aufbauen
	$dbname = 'db348734303';
	$link = mysql_connect('db2922.1und1.de','dbo348734303', 'london2010');
	$db = mysql_select_db($dbname,$link);	


	function getEventByID($ID){
		$sql = "SELECT * FROM events WHERE event_id = $ID";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$event_by_id = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
		   	}
		   	
		return $event_by_id;
		}

	function changeDateForEdit($date){
	    //Datumausgabe aendern
    	$mod_date = substr($date, 0, 10);

    	$mod_date = explode('-',$mod_date);

    	$year = $mod_date[0];
    	$month = $mod_date[1];
    	$day = $mod_date[2];
    	

    	$mod_date = $day . '/' . $month . '/' . $year;	
    	
    	return $mod_date;
		}

	function getEvents(){
		$sql = "SELECT * FROM events WHERE event_date >= NOW() AND event_type = '100' ORDER BY event_date ASC";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$event[] = array('ID' => $row[0], 'title' => $row[1], 'date'=> $row[2], 'place'=> $row[3], 'type'=> $row[4],'createTime'=> $row[5], 'author_id'=> $row[6]);
		   	}
		   	
		return $event;
	
		}
		
	function getCongress(){
		$sql = "SELECT * FROM events WHERE event_date >= NOW() AND event_type = '200' OR event_type = '300' OR event_type = '400' ORDER BY event_date ASC";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$congress[] = array('ID' => $row[0], 'title' => $row[1], 'date'=> $row[2], 'place'=> $row[3], 'type'=> $row[4],'createTime'=> $row[5], 'author_id'=> $row[6]);
		   	}
		   	
		return $congress;
		}
	
	function changeMonth($getMonth) {
		switch ($getMonth){
			case 1:
				$month = 'Januar';
			    break;
			case 2:
				$month = 'Februar';
			    break;
			case 3:
				$month = 'M&auml;rz';
			    break;
			case 4:
				$month = 'April';
			    break;
			case 5:
				$month = 'Mai';
			    break;
			case 6:
				$month = 'Juni';
			    break;
			case 7:
				$month = 'Juli';
				break;
			case 8:
				$month = 'August';
				break;
			case 9:
				$month = 'September';
				break;
			case 10:
				$month = 'Oktober';
				break;
			case 11:
				$month = 'November';
				break;
			case 12:
				$month = 'Dezember';
				break;
			default:
				$month = 'Fehler';
			    break;
			}
		return $month;
		}
		
	function modifyDate($date){
	    //Datumausgabe aendern
    	$mod_date = substr($date, 0, 10);

    	$mod_date = explode('-',$mod_date);

    	$year = $mod_date[0];
    	$month = $mod_date[1];
    	$day = $mod_date[2];
    	
    	$mod_month = changeMonth($month);

    	$mod_date = $day . '. ' . $mod_month . ' ' . $year;	
    	
    	return $mod_date;
		}	
		
	function getCompanyByID($cid) {
		$sql_get_id = "SELECT * FROM company WHERE company_id = '$cid'";
		mysql_query($sql_get_id);
		$result = mysql_query($sql_get_id) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$company = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11]);
		   	}
		   	
		return $company;
		}


//Funktion für die Ausgabe von Umlauten aus der Datenbank
	function changeLetter($text){
		$suchen   = array('Ä', 'Ü', 'Ö', 'ä', 'ö', 'ü', 'ß');
		$ersetzen = array('%AE', '%UE', '%OE', '%ae', '%oe', '%ue', '%ss');
		$text     = str_replace($suchen, $ersetzen, $text);
		
		return $text;
		}
		
	function changeLetter2($text){
		$suchen   = array('%AE', '%UE', '%OE', '%ae', '%oe', '%ue', '%ss');
		$ersetzen = array('&Auml;', '&Uuml;', '&Ouml;', '&auml;', '&ouml;', '&uuml;', '&szlig;');
		$text     = str_replace($suchen, $ersetzen, $text);
		
		return $text;
		}
	
	function changeEnterToSpace($text){
		$suchen   = array('<br />');
		$ersetzen = array('');
		$text     = str_replace($suchen, $ersetzen, $text);
		
		return $text;
		}
		
	function getUserInformation($user_id){
		$sql_get_id = "SELECT * FROM users WHERE user_id = '$user_id'";
		mysql_query($sql);
		$result = mysql_query($sql_get_id) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$user = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7]);
		   	}
		   	
		return $user;	
		}
		
	function getCompanyInformation($company_id){
		$sql_get_id = "SELECT * FROM company WHERE company_id = '$company_id'";
		mysql_query($sql);
		$result = mysql_query($sql_get_id) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$company = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10], $row[11]);
		   	}
		   	
		return $company;
		}	
	
	function checkMailSyntax($email){
  		$email = htmlspecialchars($email); // eMail-Adresse
  
  		if(!preg_match('/^([A-Za-z0-9\.\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~]){1,64}\@{1}([A-Za-z0-9\.\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~]){1,248}\.{1}([a-z]){2,6}$/', $email))
   			return $i=0;
  
  		list($localPart, $domainPart) = explode('@', $email, 2);
  
  		// Domain existiert nicht => Ungültig
  		if(@!fsockopen($domainPart, 80))
   			return $i=0;
  
  		return $i=1; 
 		}
		
	function insertCompany($name, $contact, $zip, $place, $street, $phone, $fax, $email, $homepage, $abstract, $path) {
		$sql_company = "INSERT INTO `company` ( `company_id` , `company_name` , `company_contact` , `company_plz` , `company_place` , `company_street` , `company_phone` , `company_fax` , `company_email` , `company_homepage` , `company_abstract`, `company_picture` )
VALUES (
'', '$name', '$contact', '$zip', '$place', '$street', '$phone', '$fax', '$email', '$homepage', '$abstract', '$path')";

		mysql_query($sql_company);
		}
		
	function insertUser($name, $email, $password, $companyID) {
		$sql_user = "INSERT INTO `users` ( `user_id` , `user_name` , `user_email` , `user_pw` , `user_active` , `user_role_id` , `user_createtime` , `user_company_id` )VALUES ('', '$name', '$email', '$password', '1', '300', NOW(), '$companyID');";

		mysql_query($sql_user);
		}
		
	function getCompanyID($name, $email) {
		$sql_get_id = "SELECT company_id FROM company WHERE company_email = '$email' AND company_name = '$name'";
		mysql_query($sql_get_id);
		$result = mysql_query($sql_get_id) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
		   	$company_id = $row[0];
		   	}
		   	
		return $company_id;
		}
		
	function checkCompany($name,$email){
		$sql_company_exist = "SELECT company_id FROM company WHERE company_email = '$email' OR company_name = '$name'"; 
		        	
		$result_company_exist = mysql_query($sql_company_exist) or die (mysql_error());
		$num_company_exist = mysql_num_rows($result_company_exist); 	
		
		//$num_company_exist = 0 existiert nicht!!!
		return $num_company_exist;
		
		}
		
	function checkUser($name,$email){
		$sql_user_exist = "SELECT user_id FROM users WHERE user_email = '$email' OR user_name = '$name'"; 
		        	
		$result_user_exist = mysql_query($sql_user_exist) or die (mysql_error());
		$num_user_exist = mysql_num_rows($result_user_exist); 	
		
		//$num_user_exist = 0 existiert nicht!!!
		return $num_user_exist;
		
		}
		
	function sendMail($email, $company_name){
		//E-Mailparts erstellen
		    	
		$header = "Registrierung erfolgreich";
		$server = $_SERVER['HTTP_HOST'];
		$host = ereg_replace('www.','',$server);
		$from = "From: \"Gebäudereiniger-Innung Rheinhessen-Pfalz\" <no-reply@$host>\r\n";
		    	
		$message = "Herzlich Willkommen $company_name \n\nIhre Registrierung auf der Internetpräsenz der Gebäudereiniger-Innung Rheinhessen-Pfalz \n wurde erfolgreich abgeschlossen.\n\nÜber den internen Mitgliederbereich haben Sie nun Einsicht in alle relevanten Dokumente,\nrund um unser Handwerk.\n\nBei organisatorischen Rückfragen wenden Sie sich bitte an:\ninfo@gebäudereiniger-rheinhessen-pfalz.de\n\nBei administrativen Fragen wenden Sie sich bitte an:\ninfo@staiber-solution.com\n\nMit freundlichen Grüßen\n\nGebäudereiniger-Innung Rheinhessen-Pfalz";
					
		//E-Mail versenden
			
		mail($email, $header, $message, $from);
		
		}	

	function clean_user_input($email) {
		$email = trim($email);	
		$email = strtolower($email);
		
		return $email;
		}
		
	function modifyDateDB($date){
		//Datum aufbereiten
   		$date = explode('/', $date);

    	$day = $date[0];
    	$month = $date[1];
    	$year = $date[2];

    	$modify_date = $year . '-' . $month . '-' . $day .  ' ' . '23:59:59'; 
    	
    	return $modify_date;
		}
		
	function insertEvent($title, $date, $description, $art, $id) {
		$sql_event = "INSERT INTO `events` ( `event_id` , `event_title` , `event_date` , `event_place` , `event_type`, `event_createtime`, `event_author_id`)
VALUES ('', '$title', '$date', '$description', '$art', NOW(), '$id')";

		$result = mysql_query($sql_event);
		
		return $result;
		}
		
	function updateEvent($eid, $title, $date, $description, $art, $id) {
		$sql_event = "UPDATE `events` SET event_title = '$title', event_date = '$date', event_place = '$description', event_type = '$art', event_createtime = NOW(), event_author_id = '$id' WHERE event_id = '$eid'";

		$result = mysql_query($sql_event);
		
		return $result;
		}
		
		
	function deleteEvent($id) {
		$sql_event = "DELETE from events WHERE event_id = '$id'";

		$result = mysql_query($sql_event);
		
		return $result;
		}				

	function insertNews($title, $description, $id, $path) {
		$sql_news = "INSERT INTO `news` ( `news_id` , `news_title` , `news_content`, `news_picture_path`, `news_createtime`, `news_author_id`)
VALUES ('', '$title', '$description', '$path', NOW(), '$id')";

		$result = mysql_query($sql_news);
		
		return $result;
		}

	function updateNews($nid, $title, $description, $id, $path) {
		$sql_event = "UPDATE `news` SET news_title = '$title', news_content = '$description', news_createtime = NOW(), news_author_id = '$id', news_picture_path = '$path' WHERE news_id = '$nid'";

		$result = mysql_query($sql_event);
		
		return $result;
		}		
		
	function deleteNews($id) {
		$delete_pic = getNewsByID($id);
		unlink($delete_pic[3]);
		
		$sql_news = "DELETE from news WHERE news_id = '$id'";

		$result = mysql_query($sql_news);
		
		return $result;
		}	
		
	function getNews(){
		$sql = "SELECT * FROM news ORDER BY news_createtime DESC";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$news[] = array('ID' => $row[0], 'title' => $row[1], 'content'=> $row[2],'picture_path'=> $row[3],'createTime'=> $row[4], 'author_id'=> $row[5]);
		   	}
		   	
		return $news;
	
		}

	function getNewsByID($ID){
		$sql = "SELECT * FROM news WHERE news_id = $ID";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$news_by_id = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
		   	}
		   	
		return $news_by_id;
		}
		
	function getNewsTitle(){
		$sql = "SELECT * FROM news ORDER BY news_createtime DESC Limit 6";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$news_title[] = array('ID' => $row[0], 'title' => $row[1], 'content'=> $row[2], 'picture_path'=> $row[3], 'createTime'=> $row[4], 'author_id'=> $row[5]);
		   	}
		   	
		return $news_title;
		}

	function getEventDate(){
		$sql = "SELECT * FROM events WHERE event_date >= NOW() ORDER BY event_date ASC";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$event[] = array('ID' => $row[0], 'title' => $row[1], 'date'=> $row[2], 'place'=> $row[3], 'type'=> $row[4],'createTime'=> $row[5], 'author_id'=> $row[6]);
		   	}
		   	
		return $event;
	
		}
		
	function getSearchRequest($query){
		$sql = "SELECT * FROM company WHERE company_plz LIKE '%$query%' OR company_name LIKE '%$query%' OR company_place LIKE '%$query%' ORDER BY company_name ASC";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$request[] = array('ID' => $row[0], 'name' => $row[1], 'contact'=> $row[2],'zip'=> $row[3], 'place'=> $row[4], 'street'=> $row[5], 'phone'=> $row[6], 'fax'=> $row[7], 'email'=> $row[8], 'hp'=> $row[9], 'abstract'=> $row[10], 'picture'=> $row[11]);
		   	}
		   	
		return $request;
	
		}

	function getSearchRequestLimited($query, $start, $eintraege_pro_seite){
		$sql = "SELECT * FROM company WHERE company_plz LIKE '%$query%' OR company_name LIKE '%$query%' OR company_place LIKE '%$query%' ORDER BY company_name ASC LIMIT $start, $eintraege_pro_seite";
		mysql_query($sql);
		$result = mysql_query($sql) or die (mysql_error());
		    	
		while ( $row = mysql_fetch_array($result) )	{
			$request[] = array('ID' => $row[0], 'name' => $row[1], 'contact'=> $row[2],'zip'=> $row[3], 'place'=> $row[4], 'street'=> $row[5], 'phone'=> $row[6], 'fax'=> $row[7], 'email'=> $row[8], 'hp'=> $row[9], 'abstract'=> $row[10], 'picture'=> $row[11]);
		   	}
		   	
		return $request;
	
		}
		
	function checkPicture($erlaubt,$max) {
		$error = 0;
	//uberprufe ob nicht zu gross und ob richtige dateiende
	    if (array_search($_FILES['datei']['type'],$erlaubt) == "0"){
   			$error = "11";
	    	//$error = "Sie können nur Bilder hochladen.";
	        }
	  	if ($_FILES['datei']['size'] > $max){
			$error = "22";
	    	//$error = "Ihr Foto bzw. Bild darf nicht gr&ouml;sser sein als <b>{$max}</b> Byte.";
	        }
	        
	    return $error;
	              
		} 

	function changePassword($password, $uid) {
		$sql_event = "UPDATE `users` SET user_pw = '$password'WHERE user_id = '$uid'";

		$result = mysql_query($sql_event);
		
		return $result;
		}
		

	function changeCompany($name,$contact,$zip,$place,$street,$phone,$fax,$email,$homepage,$abstract,$path, $id) {
		$sql = "UPDATE `company` SET company_name = '$name', company_contact = '$contact', company_plz = '$zip', company_place = '$place', company_street = '$street', company_phone = '$phone', company_fax = '$fax', company_email = '$email', company_homepage = '$homepage', company_abstract = '$abstract', company_picture = '$path' WHERE company_id = '$id'";

		$result = mysql_query($sql);
		
		return $result;
		}
	
	function deletePicture($id, $table, $row) {
		$table_id = $table . '_id';
		$sql = "UPDATE `$table` SET $row = '' WHERE $table_id = '$id'";

		$result = mysql_query($sql);
		
		return $result;
		}
		
			?>