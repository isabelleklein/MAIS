<?php include('side_navigation/nav_news.php');

	$datum = date(d . '/' . m . '/' . Y);	
	
	//GET-Variablen auslesen
	
	$err = $_GET['err'];
	
	if(!isset($_GET['err'])) {
		$err = "null";
		}
	
	$msg = $_GET['msg'];
	
	if(!isset($_GET['msg'])) {
		$msg = "null";
		}

	$ID = $_GET['id'];
	
	if(!isset($_GET['id'])) {
		$ID = "null";
		}	
	
	?>

<?php

// FKT-Aufruf und Events und Tagungen zaehlen		
		$event = getEvents();
		$anzahl_event = count($event);

		$congress = getCongress();
		$anzahl_congress = count($congress);
		
		$event_by_id = getEventByID($ID);
?>
		
<script type="text/javascript">		

function delete_confirm($id) {
 	check = confirm("Soll der Termin wirklich gelöscht werden?\n");
  	if(check==false)self.location.href="?page=202";
  	if(check==true)self.location.href="?page=204&id=" + $id;
 	}

function edit_confirm($id) {
 	check = confirm("Soll der Termin wirklich gegeändert werden?\n");
  	if(check==false)self.location.href="?page=202";
  	if(check==true)self.location.href="?page=205&id=" + $id;
 	}
 	
</script>

	<div id="content" class="clearfix">
	
	<?php 

		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){
			?><h2>Termine hinzuf&uuml;gen</h2>	
			
			<?php if($err == "del") {
		    	?><p class="good"> Der ausgew&auml;hlte Termin wurde gel&ouml;scht.</p><?php
		    		}?>
		    
		    <?php if($err == 5) {
		    	?><p class="error">  Der Termin konnte nicht gel&ouml;scht werden</p><?php
		    		}?>			
			
			<form name="add_event" action="?page=203" method="post">
				<ul id="events">
					<li>
						<?php if($err == "ok") {
							?><p class="good"> Ihr Termin wurde erfolgreich hinzugef&uuml;gt.</p><?php
								}?>
						
						<?php if($err == 1) {
							?><p class="error">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p><?php
								}?>
								
						<?php if($err == 2) {
							?><p class="error">  Ihr Termin konnte leider nicht hinzugef&uuml;gt werden</p><?php
								}?>
					
						<?php if($err == "null") {
							?><p class="clearfix"> Hier k&ouml;nnen Sie einen Termin hinzuf&uuml;gen!</p><?php
								}?>
						
						</li>
					<li id="title">
    					<label>Titel:&emsp;</label>
    					</li>
    				<li id="title_input">
    					<input type="text" name="title" id="title">
    					</li>
    				<li id="time">
    					<label>Datum:&emsp;</label>
    					<input type="text" id="time" name="time" onblur="if (this.value=='') this.value='<?php echo($datum);?>'" onfocus="if (this.value=='<?php echo($datum);?>') this.value='';" value="<?php echo($datum);?>"/>		
    					<script language="JavaScript">
    						new tcal ({
    						// form name
    						'formname': 'add_event',
    						// input name
    						'controlname': 'time'
    						});
    						</script>
    					<label id="art">Terminart:&emsp;</label>
    					<select id="termin_art" name="termin_art">
    						<option value="100" selected>Termin</option>
							<option value="200">Lehrgang</option>
    						<option value="300">Tagung</option>
    						<option value="400">sonstige Veranstaltung</option>
    						</select>

    					</li>
    				<li id="description">
    					<label>Beschreibung:&emsp;</label>
    					</li>
    				<li id="description_input">	
    					<textarea name="description" id="description"></textarea>
    					</li>
    				
    				<li>&emsp;</li>
    				<li id="button">
    					<input type="submit" value="hinzuf&uuml;gen" name="add">
    					<input type="reset" value="zur&uuml;cksetzen" name="reset">
    					</li>
					</ul>
				</form></p><?php		
						
						}
		
		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 300 OR $_SESSION['role'] == 400){
			?><h2>Termine im &Uuml;berblick </h2><?php
			if($anzahl_event == 0) {?><p>Zur Zeit sind leider keine Termine bekannt.</p><?php }	
			}
		?>	
				
		<p class="content">
		
		<?php
				
		for ($x = 0; $x < $anzahl_event; $x++){
    		?>
    		<h3 class="title"><?php echo changeLetter2($event[$x]['title']);
    		
    		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){?>
	    		<img class="delete_icon" src="img/icon/rotesX.png" title="L&ouml;schen" onclick="return delete_confirm('<?php echo $event[$x]['ID'];?>');">

	    		<img class="edit_icon" src="img/icon/edit.png" title="Editieren" onclick="return edit_confirm('<?php echo $event[$x]['ID'];?>');">

	    			<?php }?>
    			</h3><?php
    		?><p class="time"><?php echo modifyDate($event[$x]['date']);?></p><?php
    		?><p class="place"><?php echo changeLetter2($event[$x]['place']);?></hp><?php    		
			}
			
		if($anzahl_congress != 0) {
			?><hr><h3 class="title">Tagungen / sonstige Veranstaltungen</h3><?php
			}
			
		for ($x = 0; $x < $anzahl_congress; $x++){
    		?>
    		<p class="time"><?php echo modifyDate($congress[$x]['date']);
    		
    		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){?>
    			<img class="delete_icon" src="img/icon/rotesX.png" title="L&ouml;schen" onclick="return delete_confirm('<?php echo $congress[$x]['ID'];?>');">
    			
    			<img class="edit_icon" src="img/icon/edit.png" title="Editieren" onclick="return edit_confirm('<?php echo $congress[$x]['ID'];?>');">
			<?php }?>
    			</p><?php
    		?><p class="place"><?php echo changeLetter2($congress[$x]['place']);?></hp><?php
    		 		
			}			
			
			?>
				
		</p>

		
	
	</div> <!-- Content Ende -->
	
