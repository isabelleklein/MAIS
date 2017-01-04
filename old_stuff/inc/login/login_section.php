<?php include('side_navigation/nav_login.php');?>

<?php
	
	//Ermittelt die aktuelle URL 
	$server= $_SERVER['PHP_SELF'];
	$server_array = explode('/',$server);
	$server = $server_array[1];
	
	$actions = $_SERVER['QUERY_STRING'];
	$url = $server . '?' . $actions;
	$_SESSION['url'] = $url;
	
	//GET Variablen auslesen
	$msg = $_GET['msg'];
	
	if(!isset($_GET['msg'])) {
		$msg = "null";
		}
	
	?>

	<div id="content" class="clearfix">
	
		<h2>Anmeldung</h2>
		
		<?php if ($msg == 'log') {
			?><p class="error">Sie m&uuml;ssen sich zu erst anmelden um den Mitgliederbereich zu betreten.</p><?php
			
			}?>
			
		<?php if ($msg == 'fail') {
			?><p class="error">Der Zugriff auf den internen Bereich wurde Ihnen verweigert. Korrigieren Sie bitte Ihre Eingaben.</p><?php
			
			}?>
		
	
		<form method="post" action="?page=906">	
			<ul id="login">
				<li>Hier k&ouml;nnen Sie sich mit ihrem Benutzernamen oder EMail einloggen.</li>
				<li>
					<input id="email" name="email" size="45" maxlength ="255" onblur="if (this.value=='') this.value='E-Mail/Username'" onfocus="if (this.value=='E-Mail/Username') this.value='';" type="text" value="E-Mail/Username" />
					</li>
				<li>Bitte geben Sie nun noch ihr Passwort ein.</li>
				<li>
					<input id="pwd" name="pwd" size="45" maxlength="40" onblur="if (this.value=='') this.value='******'" onfocus="if (this.value=='******') this.value='';" type="password" value="******" />
					</li>
				
				<li>
					<input name="submit" type="submit" id="submit" value="Login" />
				</li>
				
				<li>
					<a href="?page=908">Passwort vergessen?</a>
				</li>
				</ul>
			</form>


		
	
	</div> <!-- Content Ende -->
