<?php 
	
	include('side_navigation/nav_news.php');

	include('function_collection.php');

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

	$event_by_id = getEventByID($ID);

?>
<script type="text/javascript">		

function accept_confirm($id) {
 	check = confirm("Soll der Termin wirklich gegeändert werden?\n");
  	if(check==false)self.location.href="?page=205&id=" + $id;
  	if(check==true)self.location.href="?page=209&id=" + $id;
 	}
 	
</script>

	<div id="content" class="clearfix">	

	<h2>Termin &auml;ndern</h2>

			<form name="add_event" action="?page=209&id=<?php echo $ID; ?>" method="post">
				<ul id="events">
					<li>
						<?php if($err == "ok") {
							?><p class="good"> Ihr Termin wurde erfolgreich ge&auml;ndert.</p><?php
								}?>
						
						<?php if($err == 1) {
							?><p class="error">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p><?php
								}?>
								
						<?php if($err == 2) {
							?><p class="error">  Ihr Termin konnte leider nicht hinzugef&uuml;gt werden</p><?php
								}?>
					
						<?php if($err == "null") {
							?><p class="clearfix"> Hier k&ouml;nnen Sie den Termin &auml;ndern!</p><?php
								}?>
						</li>
					<li id="title">
    					<label>Titel:&emsp;</label>
    					</li>
    				<li id="title_input">
    					<input type="text" name="title" id="title" value="<?php echo changeLetter2($event_by_id[1]);?>">
    					</li>
    				<li id="time">
    					<label>Datum:&emsp;</label>
    					<input type="text" id="time" name="time" onblur="if (this.value=='') this.value='<?php echo changeDateForEdit($event_by_id[2]);?>'" onfocus="if (this.value=='<?php echo changeDateForEdit($event_by_id[2]);?>') this.value='';" value="<?php echo changeDateForEdit($event_by_id[2]);?>"/>		
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
    						<option value="100" <?php if($event_by_id['4'] == 100) echo('selected');?>>Termin</option>
    						<option value="200" <?php if($event_by_id['4'] == 200) echo('selected');?>>Lehrgang</option>    										<option value="300" <?php if($event_by_id['4'] == 300) echo('selected');?>>Tagung</option>
    						<option value="400" <?php if($event_by_id['4'] == 400) echo('selected');?>>sonstige Veranstaltung</option>
    						</select>

    					</li>
    				<li id="description">
    					<label>Beschreibung:&emsp;</label>
    					</li>
    				<li id="description_input">	
    					<textarea name="description" id="description"><?php echo changeEnterToSpace(changeLetter2($event_by_id[3]));?></textarea>
    					</li>
    				
    				<li>&emsp;</li>
    				<li id="button">
    					<input type="submit" value="&auml;ndern" name="add" onclick="return accept_confirm('<?php echo $event_by_id[0];?>');">
    					<input type="button" value="zur&uuml;ck" onclick="location='?page=202'; return false;"/>
    					</li>
					</ul>
				</form></p>
					
	</div> <!-- Content Ende -->
	
