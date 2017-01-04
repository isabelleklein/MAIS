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

	$news_by_id = getNewsByID($ID);
	$_SESSION['picture_path'] = $news_by_id[3];
	
?>
<script type="text/javascript">		

function accept_confirm($id) {
 	check = confirm("Soll der Artikel wirklich gegeändert werden?\n");
  	if(check==false)self.location.href="?page=201&id=" + $id;
  	if(check==true)self.location.href="?page=210&id=" + $id;
 	}
 	
function accept_delete_picture($id) {
 	check = confirm("Soll das Bild wirklich gelöscht werden?\n");
  	if(check==false)self.location.href="?page=201&id=" + $id;
  	if(check==true)self.location.href="?page=201&msg=dp&id=" + $id;
 	}
 	
</script>

	<div id="content" class="clearfix">	

	<h2>Artikel &auml;ndern</h2>

			
			<form name="add_news" action="?page=210&id=<?php echo $ID; ?>" method="post" enctype="multipart/form-data" >
				<ul id="news">
					<li>
						<?php if($msg == "dp") {
							unlink($news_by_id[3]);
							$news_by_id[3] = "";
							$delete = deletePicture($news_by_id[0], 'news', 'news_picture_path');
							?><p class="good">Ihr Bild wurde gel&ouml;scht.</p><?php
								}?>
			
						<?php if($err == "ok") {
							?><p class="good"> Ihr Artikel wurde erfolgreich ge&auml;ndert.</p><?php
								}?>
						
						<?php if($err == 1) {
							?><p class="error">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p><?php
								}?>
								
						<?php if($err == 2) {
							?><p class="error">  Ihr Artikel konnte leider nicht ge&auml;ndert werden.</p><?php
								}?>
					
						<?php if($err == "null") {
							?><p class="clearfix"> Hier k&ouml;nnen Sie den Artikel bearbeiten!</p><?php
								}?>
								
						<?php if($err == "11") {
							?>
							<p class="error">  Ihr Newsartikel konnte leider nicht ge&auml;ndert werden</p>
							<p class="error">Sie k&ouml;nnen nur Bilder in folgenden Formaten hochladen jpg, png und gif.</p><?php
								}?>	
														
						<?php if($err == "22") {
							?>
							<p class="error">  Ihr Newsartikel konnte leider nicht ge&auml;ndert werden</p>
							<p class="error">Ihr Foto bzw. Bild darf nicht gr&ouml;sser sein als <b>100</b> KByte.</p><?php
								}?>
						</li>
					<li id="title">
    					<label>Titel:&emsp;</label>
    					</li>
    				<li id="title_input">
    					<input type="text" name="title" id="title" value="<?php echo changeLetter2($news_by_id[1]);?>">
    					</li>
    				
    				<?php if($news_by_id[3] != ""){ ?><li id="picture">
    					<label>aktuelles Bild:&emsp;</label>
    					</li>
    				<li id="picture_output">
    					<img class="pointer" title="Klicken Sie auf das Bild um dieses zu l&ouml;schen." id="picture_output" alt="Bild zum Artikel"src="<?php echo $news_by_id[3]; ?>" onclick="return accept_delete_picture('<?php echo $news_by_id[0];?>');"/>
    					</li> <?php } ?>
    				<li id="file_upload" title="Die Bildergr&ouml;ße ist auf 100KB beschr&auml;nkt. Weitere Informationen finden Sie in der Info-Box. ">
    					<label>Bild ausw&auml;hlen:&emsp;</label>
						<input type="file" name="datei"/>
    					</li>
    				<li id="description">
    					<label>Text:&emsp;</label>
    					</li>
    				<li id="description_input">	
    					<textarea name="description" id="description"><?php echo changeEnterToSpace(changeLetter2($news_by_id[2]));?></textarea>
    					</li>
    				
    				<li>&emsp;</li>
    				<li id="button">
    					<input type="submit" value="&auml;ndern" name="add" onclick="return accept_confirm('<?php echo $news_by_id[0];?>');">
    					<input type="button" value="zur&uuml;ck" onclick="location='?page=200'; return false;"/>
    					</li>
					</ul>
				</form></p>
					
	</div> <!-- Content Ende -->
	
