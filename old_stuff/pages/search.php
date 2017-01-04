<?php 
	include('side_navigation/nav_search.php');
		
	//Auslesen der POST und GET-Variablen
	$msg = $_GET['msg'];

	if(!isset($_GET['msg'])) {
		$msg = "null";
		}
		
	$cid = $_GET['cid'];

	if(!isset($_GET['cid'])) {
		$cid = "null";
		}

	if(isset($_GET['all'])) {
		unset($_SESSION['query']);
		}
		
	if(isset($_POST['query'])) {
		$query = $_POST['query'];
		unset($_SESSION['query']);
		}
		else {
			$query = $_SESSION['query'];
			}
		
	
	// Aktuelle Seite
	$seite = $_GET["s"]; 

	// Variable nicht gesetzt, dann $seite = 1
	if(!isset($seite)) { 
   		$seite = 1; 
   		} 

	?>

	<div id="content" class="clearfix">
	
		<h2>Suche</h2>
		
		<?php
			//Anzeige bei Reiter = Suche
			if($_GET['page'] == 801) {?>
				<form method="post" action="?page=801&msg=s">
					<input type="text" id="query" name="query" value="Suchbegriff" onblur="if (this.value=='') this.value='Suchbegriff'" onfocus="if (this.value=='Suchbegriff') this.value='';"/>
					<input class="button" type="submit" name="Submit" value="Suchen" id="Submit" title="Suchlauf nach einer Reinigungsfirma"/>
					</form>	
					
				<hr>
				
				<?php } 
			
			//Anzeige bei Reiter = Firmenliste
			if($_GET['page'] == 802) {?>
				<h3>Firmenliste</h3>
				<?php }
			
			//Anzeige bei Reiter = Detailansicht
			if($_GET['page'] == 803) {?>
				<h3>Detailansicht</h3>
				<?php 
				$company = changeLetter2(getCompanyByID($cid));?>
					
					<?php if($company[11]!= "") {?>
						<img id="company_pic" alt="Bild zum Unternehemn" src="<?php echo $company[11]; ?>" />
						<?php } ?>				

				<ul id="details">
    				<li id="head"><?php echo $company[1];?></li>
    				<li class="body"><?php echo changeLetter2($company[5]);?></li>
    				<li class="body"><?php echo $company[3]; echo("&emsp;"); echo changeLetter2($company[4]);?></li>
    				<li class="body"><label>Kontakt:&emsp;</label>  <?php echo changeLetter2($company[2]);?></li>
    				<li class="body"><label>Tel.:&emsp;</label>  <?php echo $company[6];?></li>
    				<li class="body"><label>Fax:&emsp;</label>  <?php echo $company[7];?></li>
    				<li class="body"><a href="mailto:<?php echo $company[8];?>"><?php echo $company[8];?></a></li>
    				<li class="body"><a href="<?php echo $company[9];?>" target="_blank" ><?php echo $company[9];?></a></li>
    				<li class="body"><?php echo changeLetter2($company[10]);?></li>
    				</ul>
				<?php }?>
				
			
		<?php
			if($_GET['msg']=='s'){
				?>
				<div id="search_final">
					<?php	
					//Einträge pro Seite beschränken
					$eintraege_pro_seite = 5; 

					//Startwert für Datenbankabfrage ermitteln
					$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;
					 
					// FKT-Aufruf Artikel zaehlen		
						$request = getSearchRequestLimited($query, $start, $eintraege_pro_seite);
						$anzahl_request = count($request);
					// Anzahl der Einträge
						$anzahl_entry = count(getSearchRequest($query));
					
					if (!isset($request)){
						echo "Ihre Suche nach <b>'$query'</b> war leider nicht erfolgreich!";
						}
						else {
							if($query != ""){
								echo "Ihre Suche nach <b>'$query'</b> ergab $anzahl_entry Treffer!";
								$_SESSION['query'] = $query;
								}
							}						
						
					for ($x = 0; $x < $anzahl_request; $x++){
			    		?>	
							<ul title="Um zur Detailansicht zu gelangen bitte klicken" class="pointer" onclick=window.location="?page=803&cid=<?php echo $request[$x]['ID'];?>">
								<li id="head"><?php echo changeLetter2($request[$x]['name']);?></li>
								<li class="body"><?php echo changeLetter2($request[$x]['street']);?></li>
								<li class="body"><?php echo $request[$x]['zip']; echo("&emsp;"); echo changeLetter2($request[$x]['place']);?></li>
								<li class="body"><label>Tel.:&emsp;</label>  <?php echo $request[$x]['phone'];?></li>
								<li class="body"><label>Fax:&emsp;</label>  <?php echo $request[$x]['fax'];?></li>
								</ul>
								<?php if($request[$x]['picture'] != "") {?>
									<img id="list" alt="Bild zum Unternehemn" src="<?php echo $request[$x]['picture']; ?>" />
									<?php }
									else {
										$picture = rand(1,12);?>
										<img id="list" alt="Aufgaben der Innung" src="img/search/<?php echo($picture)?>.png" />													<?php } 		
						}			
						?>
					
					</div>
					<?php } ?>
		
		<br>
				
		<p class="content"></p>
		
	<?php 	if ($msg == 's') {
	// Seitenzahlen 
	
	//Errechnen wieviele Seiten es geben wird 
	$all = $anzahl_entry / $eintraege_pro_seite; 

	//Ausgabe der Seitenlinks: 
	echo "<div align=\"center\">"; 
	echo "<b>Seite:</b> "; 


	//Ausgabe der Links zu den Seiten 
	for($a=0; $a < $all; $a++) { 
   		$b = $a + 1; 

   		//Wenn der User sich auf dieser Seite befindet, keinen Link ausgeben 
   		if($seite == $b) { 
      		echo "  <b>$b</b> "; 
      		} 

  		//Aus dieser Seite ist der User nicht, also einen Link ausgeben 
  		else { 
      		echo "  <a href=\"?page=802&msg=s&s=$b\">$b</a> "; 
      		} 


   		} 
	echo "</div>"; }?>

		
	
	</div> <!-- Content Ende -->