<?php

	include('inc/functions/function_collection.php');
	
	//Post-Variablen auslesen
	$company_name = changeLetter($_POST['company_name']);
    $company_contact = changeLetter($_POST['company_contact']);
    $company_zip = changeLetter($_POST['company_zip']);
    $company_place = changeLetter($_POST['company_place']);
    $company_street = changeLetter($_POST['company_street']);
    $company_phone = changeLetter($_POST['company_phone']);
    $company_fax = changeLetter($_POST['company_fax']);
    $company_email = $_POST['company_email'];
    $company_homepage = changeLetter($_POST['company_homepage']);
    $company_abstract = changeLetter($_POST['company_abstract']);  
    
    //Überprüfen der Email-adressen auf Gültigkeit
		
	$result_user = checkMailSyntax($user_email);
	$result_company = checkMailSyntax($company_email);
    
    //CompanyID ermitteln
   	$user = getUserInformation($_SESSION['user_id']);
	$company = getCompanyInformation($user[7]);

	if(isset($_POST['change_password'])){ // Der abschicken button wurde gedrückt.
		include('change_password.php');
		}
		
		
	if(isset($_POST['submit_settings'])){ // Der abschicken button wurde gedrückt.
		// Funktion zum ändern erstellen
		
		//überprüfen ob E-mail und Unternehmensname schon vergeben!
		$checked = checkCompany($company_email, $company_name);
	  	if ($checked != 0) {
			header("Location: ?page=702&msg=nok");	  	    
			}
	  	    else {
	  	    	//Email des Unternehmens gültig?
	    		if($result_company == 0){
	    			header("Location: ?page=702&msg=cm");
	    			}
	    			else{
						//Bild hochladen
	    				if(isset($_FILES['datei']['name']) AND $_FILES['datei']['name'] != '') {
	    				 
		    				//erlaubte dateitypen
		    				$erlaubt =  array(1 => "image/x-icon",2 => "image/jpg",3 => "image/png",4 => "image/gif",5 => "image/jpeg");
		    				//maximale dateigroesse
		    				$max = 100000;
		    				//generirte name des Bildes
		    				$rand = $_FILES['datei']['name'];
		    				$random = substr(md5(rand(0000000000, 9999999999)), 0, 10);
		    				$type = explode('/',$_FILES['datei']['type']);
		    				
		    				$picture_name = $random . '.' . $type[1];
		    				
		    				//Verzeichnis vohin die Bilder gespeichert werden sollen
		    				$verzeichnis = "img/uploads/company/";
		    				
		    				
		    				$error = checkPicture($erlaubt,$max);
		    				if($error != 0) {
		    					header("Location: ?page=702&msg=$error");
		    					die();
		    					}
		    					else {
		    						$path = "";
		    						}
						
		    				
		    				$filename = $verzeichnis.$picture_name;
		    				//leerzeichen durch nix ersetzen(fur URL wichtig)
		    				$filename = str_replace(" ","",$filename);
		    				
		    				
		    				if (move_uploaded_file($_FILES['datei']['tmp_name'], $filename)){
		    					$path = $filename;
		    					
		    					if($company[11] != '') unlink($company[11]);
		    					unset($_SESSION['picture_path']);	
		    					}
		    				}
		    				else {
	    						$path = $_SESSION['picture_path'];
	    						unset($_SESSION['picture_path']);
		    					}
		        		
				  		$result = changeCompany($company_name,$company_contact,$company_zip,$company_place,$company_street,$company_phone,$company_fax,$company_email,$company_homepage,$company_abstract,$path, $company[0]);    
				  		if (!$result) {
							header("Location: ?page=702&msg=nok");	  	    
							}
				  		    else {
				    	    	header("Location: ?page=702&msg=ok");
				    	    	}   
					}	} 	
		}
	
	?>