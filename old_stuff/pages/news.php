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
		
//alte Formular Einträge auslesen
	
	if(isset($err)){
		$input = $_SESSION['add_news'];
		$input = explode('#',$input);
		$title = changeLetter2($input[0]);
		$description = changeLetter2($input[1]);
		}

// FKT-Aufruf Artikel zaehlen		
		$news = getNews();
		$anzahl_news = count($news);
?>
		
<script type="text/javascript">		

function delete_confirm($id) {
 	check = confirm("Soll der Artikel wirklich gelöscht werden?\n");
  	if(check==false)self.location.href="?page=200";
  	if(check==true)self.location.href="?page=207&id=" + $id;
 	}

function edit_confirm($id) {
 	check = confirm("Soll der Artikel wirklich gegeändert werden?\n");
  	if(check==false)self.location.href="?page=200";
  	if(check==true)self.location.href="?page=201&id=" + $id;
 	}
 	
</script>

	<div id="content" class="clearfix">
	
	<?php 

		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){
			?><h2>Newsartikel hinzuf&uuml;gen</h2>	
			
			
			<form name="add_news" action="?page=206" method="post" enctype="multipart/form-data">
				<ul id="news">
					<li>
						
						<?php if($err == "del") {
					    	?><p class="good"> Der ausgew&auml;hlte Newsartikel wurde gel&ouml;scht.</p><?php
					    		}?>
					    
					    <?php if($err == 5) {
					    	?><p class="error">  Der Newsartikel konnte nicht gel&ouml;scht werden</p><?php
					    		}?>
		    		
						<?php if($err == "ok") {
							?><p class="good"> Ihr Newsartikel wurde erfolgreich hinzugef&uuml;gt.</p><?php
								}?>
						
						<?php if($err == 1) {
							?><p class="error">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p><?php
								}?>
								
						<?php if($err == 2) {
							?><p class="error">  Ihr Newsartikel konnte leider nicht hinzugef&uuml;gt werden</p><?php
								}?>
					
						<?php if($err == "null") {
							?><p class="clearfix"> Hier k&ouml;nnen Sie einen Newsartikel hinzuf&uuml;gen!</p><?php
								}?>

						<?php if($err == "11") {
							?>
							<p class="error">  Ihr Newsartikel konnte leider nicht hinzugef&uuml;gt werden</p>
							<p class="error">Sie k&ouml;nnen nur Bilder in folgenden Formaten hochladen jpg, png und gif.</p><?php
								}?>	
														
						<?php if($err == "22") {
							?>
							<p class="error">  Ihr Newsartikel konnte leider nicht hinzugef&uuml;gt werden</p>
							<p class="error">Ihr Foto bzw. Bild darf nicht gr&ouml;sser sein als <b>100</b> KByte.</p><?php
								}?>		
												
						</li>
					<li id="title">
    					<label>Titel:&emsp;</label>
    					</li>
    				<li id="title_input">
    					<input type="text" name="title" id="title" value="<?php echo $title; ?>">
    					</li>
    				<li id="file_upload">
    					<label>Bild ausw&auml;hlen:&emsp;</label>
						<input type="file" name="datei"/>

    					</li>	
    				<li id="description">
    					<label>Text:&emsp;</label>
    					</li>
    				<li id="description_input">	
    					<textarea name="description" id="description"><?php echo $description; ?></textarea>
    					</li>
    				
    				<li>&emsp;</li>
    				<li id="button">
    					<input type="submit" value="hinzuf&uuml;gen" name="add">
    					<input type="reset" value="zur&uuml;cksetzen" name="reset">
    					</li>
					</ul>
				</form>
				
				<hr>
				<?php		
						
						}
		
		if($_SESSION['role'] == 100 OR $_SESSION['role'] == 200 OR $_SESSION['role'] == 300 OR $_SESSION['role'] == 400){
			?><h2>Aktuelles im &Uuml;berblick </h2><?php	
			}
			
		if($anzahl_news == 0){
			?><p>Es sind leider keine Artikel vorhanden.</p><?php
			}
		?>	
				
		<p class="content">
		
		<?php
				
		for ($x = 0; $x < $anzahl_news; $x++){
    		?>
    		<h3 class="title"><?php echo changeLetter2($news[$x]['title']);
    		
    		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){?>
	    		<img class="delete_icon" src="img/icon/rotesX.png" title="L&ouml;schen" onclick="return delete_confirm('<?php echo $news[$x]['ID'];?>');">

	    		<img class="edit_icon" src="img/icon/edit.png" title="Editieren" onclick="return edit_confirm('<?php echo $news[$x]['ID'];?>');">

	    			<?php }?>
    			</h3><?php
    		?><p class="place"><?php echo substr(changeEnterToSpace(changeLetter2($news[$x]['content'])),0, 500) . "..." ;?></p><p class="pointer" id="link_complete_news" title="Klicken Sie hier, um den Newsartikel vollst&auml;ndig zu lesen." onclick=window.location="?page=208&id=<?php echo $news[$x]['ID'];?>">&raquo;weiterlesen</p><?php    		
			
			}			
			
			?>
				
		</p>
	
	</div> <!-- Content Ende -->
	
