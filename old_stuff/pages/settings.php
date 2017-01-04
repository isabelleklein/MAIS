<?php include('side_navigation/nav_member.php');?>


<script type="text/javascript">		

function accept_delete_picture($pic) {
 	check = confirm("Soll das Bild wirklich gelöscht werden?\n");
  	if(check==false)self.location.href="?page=702";
  	if(check==true)self.location.href="?page=702&msg=dp";
 	}
 	
</script>

	<div id="content" class="clearfix">
	
		<h2>Einstellungen</h2>

	<?php 				
		$user = getUserInformation($_SESSION['user_id']);
		
		$company = getCompanyInformation($user[7]);
		$_SESSION['picture_path'] = $company[11];
		?>
		
	<?php if($msg == "11") {
    	?><p class="error">Sie k&ouml;nnen nur Bilder in folgenden Formaten hochladen jpg, png und gif.</p><?php
    		}?>	
    								
    <?php if($msg == "22") {
    	?><p class="error">Ihr Foto bzw. Bild darf nicht gr&ouml;sser sein als <b>100</b> KByte.</p><?php
    		}?>
	
	<?php if($msg == "ok") {
		?><p class="good">Ihre Einstellungen wurden ge&auml;ndert.</p><?php
			}?>

	<?php if($msg == "dp") {
		unlink($company[11]);
		$company[11] = "";
		$delete = deletePicture($company[0], 'company', 'company_picture');
		?><p class="good">Ihr Bild wurde gel&ouml;scht.</p><?php
			}?>
			
	<?php if($msg == "nok") {
		?><p class="error">Ihre Einstellungen konnten leider nicht ge&auml;ndert werden. Versuchen Sie es sp&auml;ter noch einmal.</p><?php
			}?>
			
	<?php if($msg == "pok") {
		?><p class="good">Ihr Passwort wurden ge&auml;ndert.</p><?php
			}?>
			
	<?php if($msg == "pnok") {
		?><p class="error">Ihr Passwort konnte leider nicht ge&auml;ndert werden. Ihre Passw&ouml;ter sind eventuell nicht identisch.</p><?php
			}?>
	
	<?php if($msg == "cm") {
		?><p class="error">Die Email des Unternehmens ist ung&uuml;tig.</p><?php
			}?>
				
	<form method="post" action="?page=910" enctype="multipart/form-data">
		
		<h3>Angaben zum Benutzer</h3>
		
		<table id="register_user" class="clearfix">
    		<tr>
    			<td>Benutzername:&emsp;</td> 
    			<td><input class="reg" type="text" name="user_name" id="user_name" onblur="if (this.value=='') this.value='<?php echo($user[1]);?>'" onfocus="if (this.value=='<?php echo($user[1]);?>') this.value='';" value="<?php echo($user[1]);?>" disabled="true"/></td> 
    		</tr>
    		<tr>
    			<td>Email&emsp;</td> 
    			<td><input class="reg" type="text" name="user_email" id="user_email" onblur="if (this.value=='') this.value='<?php echo($user[2]);?>'" onfocus="if (this.value=='<?php echo($user[2]);?>') this.value='';" value="<?php echo($user[2]);?>" disabled="true"/></td> 
    		</tr>
    		<tr <?php if($msg == "pnok") { echo "class=\"error_table\"";} ?>>
    			<td>neues Password:&emsp;</td> 
    			<td><input class="reg" type="password" name="user_pass1" id="user_pass1" onblur="if (this.value=='') this.value='******'" onfocus="if (this.value=='******') this.value='';" value="******"/></td> 
    		</tr>
    		<tr <?php if($msg == "pnok") { echo "class=\"error_table\"";} ?>>
    			<td>neues Password best&auml;tigen:&emsp;</td> 
    			<td><input class="reg" type="password" name="user_pass2" id="user_pass2" onblur="if (this.value=='') this.value='******'" onfocus="if (this.value=='******') this.value='';" value="******"/></td> 
    		</tr>
    		</table>

    	<table id="buttons">
    		<tr>
    			<td>&emsp;</td>
				<td>
					<input type="submit" id="change_password" name="change_password" value="Passwort &auml;ndern" /></td>
				</tr>
			</table>

<?php if($_SESSION['role'] == 300) {?>   		
    	<h3>Angaben zum Unternehmen</h3>
    		
    	<table id="register_company" class="clearfix">	
    		<tr>
    			<td>Unternehmen:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_name" id="company_name" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[1]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[1]);?>') this.value='';" value="<?php echo changeLetter2($company[1]);?>"/></td> 
    		</tr>
    		<tr>
    			<td>Ansprechpartner:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_contact" id="company_contact" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[2]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[2]);?>') this.value='';" value="<?php echo changeLetter2($company[2]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Postleitzahl:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_zip" id="company_zip" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[3]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[3]);?>') this.value='';" value="<?php echo changeLetter2($company[3]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Ort:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_place" id="company_place" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[4]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[4]);?>') this.value='';" value="<?php echo changeLetter2($company[4]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Stra&szlig;e:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_street" id="company_street" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[5]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[5]);?>') this.value='';" value="<?php echo changeLetter2($company[5]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Telefon:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_phone" id="company_phone" onblur="if (this.value=='') this.value='<?php echo($company[6]);?>'" onfocus="if (this.value=='<?php echo($company[6]);?>') this.value='';" value="<?php echo($company[6]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Faxnummer:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_fax" id="company_fax" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[7]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[7]);?>') this.value='';" value="<?php echo changeLetter2($company[7]);?>" /></td> 
    		</tr>
    		<tr <?php if($msg == "cm") { echo "class=\"error_table\"";} ?>>
    			<td>Email-Adresse:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_email" id="company_email" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[8]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[8]);?>') this.value='';" value="<?php echo changeLetter2($company[8]);?>" /></td> 
    		</tr>
    		<tr>
    			<td>Homepage:&emsp;</td> 
    			<td><input class="reg" type="text" name="company_homepage" id="company_homepage" onblur="if (this.value=='') this.value='<?php echo changeLetter2($company[9]);?>'" onfocus="if (this.value=='<?php echo changeLetter2($company[9]);?>') this.value='';" value="<?php echo changeLetter2($company[9]);?>" /></td> 
    		</tr>
    		<?php if($company[11] != ""){ ?>
    		<tr>
    			<td>aktuelles Bild:&emsp;</td> 
    			<td><img class="pointer" title="Klicken Sie auf das Bild um dieses zu l&ouml;schen." id="company_pic_preview" alt="Bild des Unternehmens" src="<?php echo $company[11];?>" onclick="return accept_delete_picture('<?php echo $company[11];?>');"/></td> 
    		</tr> <?php } ?>
    		</table>
    			
    		<p <?php if($msg == "11" OR $msg == "22") { echo "class=\"error\"";} ?> id="upload" title="Die Bildergr&ouml;ße ist auf 100KB beschr&auml;nkt. Weitere Informationen finden Sie in der Info-Box. ">Bild ausw&auml;hlen:&emsp;<input type="file" name="datei" /></p>
    	
    	<table id="register_company" class="clearfix">	
    		<tr>
    			<td>Kurzbeschreibung:&emsp;</td> 
    			<td>&emsp;</td> 
    		</tr>
    		</table>
    	<textarea name="company_abstract" id="company_abstract" /><?php echo changeLetter2($company[10]);?></textarea>

    	<table id="buttons">
    		<tr>
    			<td>&emsp;</td>
				<td>
					<input type="submit" id="submit_settings" name="submit_settings" value="&Auml;ndern" />
					<input type="reset" id="reset_settings" name="reset" value="Abbrechen" />
					</td>
				</tr>
			</table>
		<?php } ?>
		</form> 

		
	
	</div> <!-- Content Ende -->
