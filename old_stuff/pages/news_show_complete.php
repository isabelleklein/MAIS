<?php include('side_navigation/nav_news.php');

	
	//GET-Variablen auslesen

	$ID = $_GET['id'];
	
	if(!isset($_GET['id'])) {
		$ID = "null";
		}	
	

// FKT-Aufruf Artikel		
		$news = getNewsByID($ID);
?>
<script type="text/javascript">		

function delete_confirm($id) {
 	check = confirm("Soll der Artikel wirklich gelöscht werden?\n");
  	if(check==false)self.location.href="?page=208&id=" + $id;
  	if(check==true)self.location.href="?page=207&id=" + $id;
 	}

function edit_confirm($id) {
 	check = confirm("Soll der Artikel wirklich gegeändert werden?\n");
  	if(check==false)self.location.href="?page=208&id=" + $id;
  	if(check==true)self.location.href="?page=201&id=" + $id;
 	}
 	
</script>

	<div id="content" class="clearfix">
	
		<h2><?php echo changeLetter2($news[1]);
		if($_SESSION['role'] == 200 OR $_SESSION['role'] == 100){?>
	    	<img class="delete_icon" src="img/icon/rotesX.png" title="L&ouml;schen" onclick="return delete_confirm('<?php echo $news[0];?>');">

	    	<img class="edit_icon" src="img/icon/edit.png" title="Editieren" onclick="return edit_confirm('<?php echo $news[0];?>');">

	    	<?php }?>
			</h2>
		<?php if($news[3]!= "") {?>
			<img id="news_pic" alt="Bild zum Artikel" src="<?php echo $news[3]; ?>" />
			<?php } ?>	
		<p class="content">
			<?php echo changeLetter2($news[2]);?>
			</p>

		<input class="button_back" type="button" value="zur&uuml;ck" onclick="location='?page=200'; return false;"/>
	
	</div> <!-- Content Ende -->
	
