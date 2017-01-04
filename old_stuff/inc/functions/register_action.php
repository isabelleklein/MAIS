<?php
	session_start();
	
	include('function_collection.php');
		
	
	//Überprüfen der Email-adressen auf Gültigkeit
		
	$result_user = checkMailSyntax($user_email);
	$result_company = checkMailSyntax($company_email);
	
    //POST-Variablen befüllen
    
    $user_name = $_POST['user_name'];
    $user_name = strtolower($user_name);
    $user_email = $_POST['user_email'];
    $user_email = strtolower($user_email);
    $pass1 = $_POST['user_pass1'];
    $pass2 = $_POST['user_pass2'];
    
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
    
    $_SESSION['register'] = $user_name . '#' . $user_email . '#' . $company_name . '#' . $company_contact . '#' . $company_zip . '#' . $company_place . '#' . $company_street . '#' . $company_phone . '#' . $company_fax . '#' . $company_email . '#' . $company_homepage . '#' . $company_abstract;
	
	
	//Email des Benutzers gültig?
	if($result_user == 0){
	    header("Location: ?page=902&msg=um");
	    }
	    else{
	    	//Email des Unternehmens gültig?
	    	if($result_company == 0){
	    		header("Location: ?page=902&msg=cm");
	    		}
	    		else{
    				//Datenbankverbindung aufbauen
    				$dbname = 'db348734303';
    				$link = mysql_connect('db2922.1und1.de','dbo348734303', 'london2010');
    				$db = mysql_select_db($dbname,$link);
    				
    				//Variableninhalt prüfen
    				
    				if($_POST['user_name'] == '' | $_POST['user_email'] == '' | $_POST['user_pass1'] == '' | $_POST['user_pass2'] == '' | $_POST['company_name'] == '' | $_POST['company_contact'] == '' | $_POST['company_email'] == '' | $_POST['company_phone'] == ''){
	
    				    header("Location: ?page=902&msg=empty?$test");
    				    }
    					else {
						    
						    //Passwort überprüfen und verschlüsseln
    				
						    if($pass1 != $pass2){
						        header("Location: ?page=102&msg=pass_error");
						        }
						    else {
						        $password = $pass1;
						    
						        $sha1pass = sha1($password);
						        
						        // Prüfen, ob company und user schon vorhanden
						        
								$company_exist = checkCompany($company_name, $company_email); 
								$user_exist = checkUser($user_name, $user_email);
								
						           
						        if ($company_exist != 0) {
						        	header("Location: ?page=902&msg=ce");
						        	}
									else {
								        if ($user_exist == 0) {
								        
											//Bild hochladen
											
											//ini_set('display_errors', true);
											//error_reporting(E_ALL); 
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
												header("Location: ?page=902&msg=$error");
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
												}	
																			       
									        insertCompany($company_name, $company_contact, $company_zip, $company_place, $company_street, $company_phone, $company_fax, $company_email, $company_homepage, $company_abstract, $path);
									    
									        $company_id = getCompanyID($company_name, $company_email);
									        
									        insertUser($user_name, $user_email, $sha1pass, $company_id);
									        
									        sendMail($user_email, $company_name);
									        
									        unset($_SESSION['register']);		    	    	
									        header("Location: ?page=902&reg=done");
									        }
									        else {
									            header("Location: ?page=902&msg=ue");
									            }
									    	}
									    }
   						}
   				}
   		}
    ?>