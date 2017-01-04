
<div id="login_section">

	<?php
		if (isset($_SESSION['user'])) {
	  		?><a href="?page=900">Abmelden</a>  | <a href="?page=702">Einstellungen</a><?php								
	  	    }
		else {
	    	?><a href="?page=901">Anmeldung</a>  | <a href="?page=902">Registrierung</a><?php
	    	}?>
	
	
	

	</div>