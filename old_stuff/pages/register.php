<?php include('side_navigation/nav_login.php');?>

<?php

	//GET-Variablen auslesen
	
	$msg = $_GET['msg'];
	
	if(!isset($_GET['msg'])) {
		$msg = "null";
		$user_name = 'Benutzername';
		$user_email = 'Email';
		$company_name = 'Muster GmbH';
		$company_contact = 'Max Mustermann';
		$company_zip = '12345';
		$company_place = 'Musterhausen';
		$company_street = 'Musterstra&szlig;e 99';
		$company_phone = '01234/567890';
		$company_fax = '01234/567890';
		$company_email = 'Max.Mustermann@muster.com';
		$company_homepage = 'www.muster.de';
		$company_abstract = '';
		}
			
	// Eingaben bei Fehler auslesen	
	if(isset($_GET['msg'])) {
		$input = $_SESSION['register'];
		$input = explode('#',$input);
		$user_name = changeLetter2($input[0]);
		$user_email = changeLetter2($input[1]);
		$company_name = changeLetter2($input[2]);
		$company_contact = changeLetter2($input[3]);
		$company_zip = changeLetter2($input[4]);
		$company_place = changeLetter2($input[5]);
		$company_street = changeLetter2($input[6]);
		$company_phone = changeLetter2($input[7]);
		$company_fax = changeLetter2($input[8]);
		$company_email = changeLetter2($input[9]);
		$company_homepage = changeLetter2($input[10]);
		$company_abstract = changeLetter2($input[11]);
		}

		
	$reg = $_GET['reg'];
	
	if(!isset($_GET['reg'])) {
		$reg = "null";
		}
		
	?> 

<div id="content" class="clearfix">

	<h2>Registrierung</h2>

	<?php if($msg == "11") {
    	?>
    	<p class="error">Sie k&ouml;nnen nur Bilder in folgenden Formaten hochladen jpg, png und gif.</p><?php
    		}?>	
    								
    <?php if($msg == "22") {
    	?>
    	<p class="error">Ihr Foto bzw. Bild darf nicht gr&ouml;sser sein als <b>100</b> KByte.</p><?php
    		}?>	
	
	<?php if($msg == "pass_error") {
		?><p class="error">Die beiden Passw&ouml;rter stimmen nicht &uuml;berein.</p><?php
			}?>
			
	<?php if($msg == "ue") {
		?><p class="error">Die gew&uuml;nschte E-Mailadresse oder der Benutzername ist bereits registriert.</p><?php
			}?>
	
	<?php if($msg == "ce") {
		?><p class="error">Das Unternehmen ist bereits registriert.</p><?php
			}?>
			
	<?php if($msg == "um") {
		?><p class="error">Die Email des Benutzers ist ung&uuml;tig.</p><?php
			}?>
			
	<?php if($msg == "cm") {
		?><p class="error">Die Email des Unternehmens ist ung&uuml;tig.</p><?php
			}?>
			
	<?php if($msg == "empty") {
		?><p class="error">Bitte f&uuml;llen Sie die ########## best&auml;tigen.</p><?php
			}?>
			
	<?php if($reg == "done") {
		?><p class="good">Ihre Registrierung wurde erfolgreich abgeschlossen. In K&uuml;rze erhalten Sie eine Best&auml;tigungsemail.</p><?php
			}?>
		

	<form method="post" action="?page=905" enctype="multipart/form-data">
		
		<h3>Angaben zum Benutzer</h3>
		
		<table id="register_user" class="clearfix">
    		<tr>
    			<td>Benutzername:&emsp;</td> 
    			<td <?php if($msg == "ue") echo 'class="error_table"';?>><input class="reg" type="text" name="user_name" id="user_name" onblur="if (this.value=='') this.value='<?php echo $user_name; ?>'" onfocus="if (this.value=='<?php echo $user_name; ?>') this.value='';" value="<?php echo $user_name; ?>"/></td> 
    		</tr>
    		<tr>
    			<td>Email&emsp;</td> 
    			<td <?php if($msg == "ue") echo 'class="error_table"';?><?php if($msg == "um") echo 'class="error_table"';?> ><input class="reg" type="text" name="user_email" id="user_email" onblur="if (this.value=='') this.value='<?php echo $company_email; ?>'" onfocus="if (this.value=='<?php echo $company_email; ?>') this.value='';" value="<?php echo $company_email; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Password:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?><?php if($msg == "pass_error") echo 'class="error_table"';?>><input class="reg" type="password" name="user_pass1" id="user_pass1" onblur="if (this.value=='') this.value='******'" onfocus="if (this.value=='******') this.value='';" value="******"/></td> 
    		</tr>
    		<tr>
    			<td>Password best&auml;tigen:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?><?php if($msg == "pass_error") echo 'class="error_table"';?>><input class="reg" type="password" name="user_pass2" id="user_pass2" onblur="if (this.value=='') this.value='******'" onfocus="if (this.value=='******') this.value='';" value="******"/></td> 
    		</tr>	
    		</table>
    		
    	<h3>Angaben zum Unternehmen</h3>
    		
    	<table id="register_company" class="clearfix">	
    		<tr>
    			<td>Unternehmen:&emsp;</td> 
    			<td <?php if($msg == "ce") echo 'class="error_table"';?>><input class="reg" type="text" name="company_name" id="company_name" onblur="if (this.value=='') this.value='<?php echo $company_name; ?>'" onfocus="if (this.value=='<?php echo $company_name; ?>') this.value='';" value="<?php echo $company_name; ?>"/></td> 
    		</tr>
    		<tr>
    			<td>Ansprechpartner:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_contact" id="company_contact" onblur="if (this.value=='') this.value='<?php echo $company_contact; ?>'" onfocus="if (this.value=='<?php echo $company_contact; ?>') this.value='';" value="<?php echo $company_contact; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Postleitzahl:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_zip" id="company_zip" onblur="if (this.value=='') this.value='<?php echo $company_zip; ?>'" onfocus="if (this.value=='<?php echo $company_zip; ?>') this.value='';" value="<?php echo $company_zip; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Ort:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_place" id="company_place" onblur="if (this.value=='') this.value='<?php echo $company_place; ?>'" onfocus="if (this.value=='<?php echo $company_place; ?>') this.value='';" value="<?php echo $company_place; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Stra&szlig;e:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_street" id="company_street" onblur="if (this.value=='') this.value='<?php echo $company_street; ?>'" onfocus="if (this.value=='<?php echo $company_street; ?>') this.value='';" value="<?php echo $company_street; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Telefon:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_phone" id="company_phone" onblur="if (this.value=='') this.value='<?php echo $company_phone; ?>'" onfocus="if (this.value=='<?php echo $company_phone; ?>') this.value='';" value="<?php echo $company_phone; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Faxnummer:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_fax" id="company_fax" onblur="if (this.value=='') this.value='<?php echo $company_fax; ?>'" onfocus="if (this.value=='<?php echo $company_fax; ?>') this.value='';" value="<?php echo $company_fax; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Email-Adresse:&emsp;</td> 
    			<td <?php if($msg == "ce") echo 'class="error_table"';?><?php if($msg == "cm") echo 'class="error_table"';?>><input class="reg" type="text" name="company_email" id="company_email" onblur="if (this.value=='') this.value='<?php echo $company_email; ?>'" onfocus="if (this.value=='<?php echo $company_email; ?>') this.value='';" value="<?php echo $company_email; ?>" /></td> 
    		</tr>
    		<tr>
    			<td>Homepage:&emsp;</td> 
    			<td <?php if($msg == "empty") echo 'class="error_table"';?>><input class="reg" type="text" name="company_homepage" id="company_homepage" onblur="if (this.value=='') this.value='<?php echo $company_homepage; ?>'" onfocus="if (this.value=='<?php echo $company_homepage; ?>') this.value='';" value="<?php echo $company_homepage; ?>" /></td> 
    		</tr>
    		</table>
    			
    		<p id="upload">Bild ausw&auml;hlen:&emsp;<input type="file" name="datei"/></p>
    	
    	<table id="register_company" class="clearfix">	
    		<tr>
    			<td>Kurzbeschreibung:&emsp;</td> 
    			<td>&emsp;</td> 
    		</tr>
    		</table>			

    	<textarea name="company_abstract" id="company_abstract"  <?php if($msg == "empty") echo 'class="error_table"';?>/><?php echo $company_abstract; ?></textarea>

    	<table id="buttons">
    		<tr>
    			<td>&emsp;</td>
				<td>
					<input type="submit" id="submit_register" name="submit" value="Registrieren" />
					<input type="reset" id="reset_register" name="reset" value="Abbrechen" />
					</td>
				</tr>
			</table>
		</form> 
	
	
	</div> <!-- Content Ende -->
