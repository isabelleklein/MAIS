<?php include('side_navigation/nav_login.php');
	
	//GET-Variablen auslesen
	
	$msg = $_GET['msg'];
	
	if(!isset($_GET['msg'])) {
		$msg = null;
		}

	?>


<div id="content" class="clearfix">

	<h2>Passwort vergessen?</h2>
	
	<form method="post" action="?page=909">
	
		<?php if($msg == "error") {
		?><p class="error">E-Mailadresse ist ung&uuml;ltig! Bitte geben Sie erneut Ihre Emailadresse ein.</p>
		
			<strong>Email:&emsp;</strong> 
			<input name="email" type="text" id="email">
			<input type="submit" name="submit" id="submit_forgot" value="Verschicken"><?php
			}?>
			
		<?php if($msg == "send") {
		?><p class="good">Eine Email mit Ihrem neuen Passwort wurde soeben versendet.</p><a href="?page=100"><input id="home" name="home" type="submit" value="Zur Startseite"></a><?php
			}?>
			
		<?php if($msg == null) {
		?><p>Bitte geben Sie ihre E-Mailadresse ein.</p>
		
			<strong>Email:&emsp;</strong> 
			<input name="email" type="text" id="email">
			<input type="submit" name="submit" id="submit_forgot" value="Verschicken">	<?php	}?>
	
		</form>
	</div> <!-- Content Ende -->
	
