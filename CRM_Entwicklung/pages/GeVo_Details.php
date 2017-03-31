<?php

if(strlen($_SESSION['GeVo_ID'])>31){
	$herkunft = substr($_SESSION['GeVo_ID'],30,4);
	$_SESSION['GeVo_ID']=substr($_SESSION['GeVo_ID'],0,30);
}

if(isset($_POST['speichern'])){
	$sql = "UPDATE `GeVo_Vorgang` SET `GeVo_ASNR`='".$_POST['asnr']."', `GeVo_GS`='".$_POST['gs']."', `GeVo_Vorgangsart`='".$_POST['art']."', `GeVo_Bearbeitungsart`='".$_POST['bart']."', `GeVo_Infofeld`='".$_POST['info']."', `GeVo_Prio`='".$_POST['prio']."', `GeVo_Person_Verantwortlich`='".$_POST['verant']."', `GeVo_Beginn`='".$_POST['beginn']."', `GeVo_Status`='".$_POST['status']."', `GeVo_Wiedervorlage`='".$_POST['wvorlage']."', `GeVo_Wiedervorlageinfo`='".$_POST['grund']."', `GeVo_Referenz_MaTS`='".$_POST['mats']."', `GeVo_Bearbeitungszeit`='".$_POST['zeit']."', `GeVo_Notiz`='".$_POST['notiz']."' WHERE `GeVo_ID`='".$_SESSION['GeVo_ID']."'";
	do_sql_no_return($db, $sql, "501save");
	if($_POST['herkunft']=="VERM"){
		openlink("210");
	}else{
		openlink("500");
	}
}
if(isset($_POST['back'])){
	if($_POST['herkunft']=="VERM"){
		openlink("210");
	}else{
		openlink("500");
	}
}
if($_SESSION['GeVo_ID']==""){
	$_SESSION['GeVo_ID']=getID();
	if($_GET['her']=='v'){
		$sql = "INSERT INTO `GeVo_Vorgang` (`GeVo_ID`, `GeVo_Eingang`) VALUES ('".$_SESSION['GeVo_ID']."',".date("Ymd").")";
	}
	else{
		$sql = "INSERT INTO `GeVo_Vorgang` (`GeVo_ID`, `GeVo_Eingang`) VALUES ('".$_SESSION['GeVo_ID']."',".date("Ymd").")";

	}
	if (mysqli_query($db,$sql)) {
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}			
}

$sql ="SELECT t3.*, t4.ZAD_Name, t1.Vermittler_ID FROM ZAD as t4 RIGHT JOIN (Vermittler_Konto as t1 RIGHT JOIN (Konten as t2 RIGHT JOIN GeVo_Vorgang as t3 ON t2.Konten_UV = t3.GeVo_ASNR) ON t1.UV = t2.Konten_UV) ON t4.ZAD_ZAD = t2.Konten_ZAD WHERE t3.GeVo_ID = '".$_SESSION['GeVo_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>
<section>
	<h1 id="elements">Gevo-Details</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=501" method="post"> 
				<div class="box">
					<div class="row uniform">				
						<div class="6u 12u$(small)">
							<label for="asnr">ASNR</label>
							<input id="asnr" name="asnr" placeholder="ASNR" type="text" value="<?php echo $zeile['GeVo_ASNR']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="gs">GS</label>
							<input id="gs" name="gs" placeholder="GS" type="text" value="<?php echo $zeile['GeVo_GS']?>" />
						</div>
						<div class="12u$">
							<label for="vermittler">Vermittler</label>
							<input id="vermittler" name="vermittler" placeholder="Vermittlername" type="text" value="<?php echo $zeile['ZAD_Name']?>" />
						</div>
						<div class="12u$">
							<label for="art">Vorgangsart:</label>
							<?php
								$sql_option = "SELECT * FROM Index_GeVo_Vorgangsart";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['GeVo_Vorgangsart'] == "0" ? "selected":"").">- Vorgangsart-</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Vorgangsart_ID"]."' ".($zeile['GeVo_Vorgangsart'] == $row["Vorgangsart_ID"] ? "selected":"").">".$row["Vorgangsart_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="art" name="art">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="bart">Bearbeitungsart:</label>
							<?php
								$sql_option = "SELECT * FROM Index_GeVo_Bearbeitungsart";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['GeVo_Bearbeitungsart'] == "0" ? "selected":"").">- Bearbeitungsart-</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Bearbeitungsart_ID"]."' ".($zeile['GeVo_Bearbeitungsart'] == $row["Bearbeitungsart_ID"] ? "selected":"").">".$row["Bearbeitungsart_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="bart" name="bart">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="info">Vorgangsinfo</label>
							<input id="info" name="info" placeholder="Vorgangsinfo" type="text" value="<?php echo $zeile['GeVo_Infofeld']?>" />
						</div>
						<div class="12u$">
							<label for="prio">Priorit&auml;t</label>
							<input id="prio" name="prio" placeholder="Priorität" type="text" value="<?php echo $zeile['GeVo_Prio']?>" />
						</div>
						<div class="12u$">
							<label for="eingang">Eingang am</label>
							<input id="eingang" name="eingang" type="date" value="<?php echo $zeile['GeVo_Eingang']?>" />
						</div>
						<div class="12u$">
							<label for="verant">Zust&auml;ndig</label>
							<input id="verant" name="verant" placeholder="Verantwortlicher" type="text" value="<?php echo $zeile['GeVo_Person_Verantwortlich']?>" />
						</div>
						<div class="12u$">
							<label for="beginn">Begonnen am:</label>
							<input id="beginn" name="beginn"type="date" value="<?php echo $zeile['GeVo_Beginn']?>" />
						</div>
						<div class="12u$">
							<label for="status">Status</label>
							<input id="status" name="status" placeholder="Status" type="text" value="<?php echo $zeile['GeVo_Status']?>" />
						</div>
						<div class="12u$">
							<label for="wvorlage">Wiedervorlage</label>
							<input id="wvorlage" name="wvorlage" type="date" value="<?php echo $zeile['GeVo_Wiedervorlage']?>" />
						</div>
						<div class="12u$">
							<label for="grund">Wiedervorlage-Info</label>
							<input id="grund" name="grund" placeholder="Grund" type="text" value="<?php echo $zeile['GeVo_Wiedervorlageinfo']?>" />
						</div>
						<div class="12u$">
							<label for="mats">MAtS-Referenz</label>
							<input id="mats" name="mats" placeholder="MAtS-Referenz" type="text" value="<?php echo $zeile['GeVo_Referenz_MaTS']?>" />
						</div>
						<div class="12u$">
							<label for="zeit">ca. Bearbeitungszeit</label>
							<input id="zeit" name="zeit" placeholder="Bearbeitungszeit" type="text" value="<?php echo $zeile['GeVo_Bearbeitungszeit']?>" />
						</div>
						<div class="12u$">
							<label for="notiz">Notizen</label>
							<textarea id="notiz" name="notiz" placeholder="Notizen" rows="6"><?php echo $zeile['GeVo_Notiz']?></textarea>
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="gevo_id" value="<?php echo $zeile['GeVo_ID']?>"></div>
				<div class="12u$"><input type="hidden" name="herkunft" value="<?php echo $herkunft?>"></div>
				<div class="12u$">
					<ul class="actions">
						<li><input class="special" type="submit" value="Speichern" name="speichern" /></li>
						<li><input type="submit" value="Zur&uuml;ck" name="back"/></li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</section>
<?php 
	}
?>

<section>
	<h2>Gevo-Aktionen</h2>

<?php

$sql = "SELECT t1.* FROM GeVo_Aktion as t1 WHERE t1.Aktion_GeVo_ID = '".$_SESSION['GeVo_ID']."'";
$_SESSION['Aktion_ID']="";	
$db_erg = mysqli_query($db,$sql);
		
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
		
if (mysqli_num_rows($db_erg)>=1){
	echo "<section>";										
	echo "<table border='1'>";
	echo "<thead>";
	echo "<th>Datum</th>";
	echo "<th>Aktionstyp</th>";
	echo "<th>Aktionsinfo</th>";
	echo "<th>MAtS-Vorgang</th>";
	echo "<th>Ersteller</th>";
	echo "<th>Stauts</th>";
	echo "<th>Erledigt</th>";
	echo "<th></th>";
	echo "</thead>";
			
	while ($zeile = mysqli_fetch_array( $db_erg)){	
		echo "<form action='?page=999' method='post'>";
		echo "<tr>";
		echo "<td>". $zeile['Aktion_Erstellt'] . "</td>";
		echo "<td>". $zeile['Aktion_Aktionsart'] . "</td>";
		echo "<td>". $zeile['Aktion_Infofeld'] . "</td>";
		echo "<td>". $zeile['Aktion_Referenz_MaTS'] . "</td>";
		echo "<td>". $zeile['Aktion_Person_Anlage'] . "</td>";
		echo "<td>". $zeile['Aktion_Status'] . "</td>";
		echo "<td>". $zeile['Aktion_Erledigt'] . "</td>";
		echo "<td><input type='hidden' name='aktion_id' value='".$zeile['Aktion_ID']."'></td>";
		echo "<td><input type='submit' name='aktion' value='Details' />";
		echo "</tr>";
		echo "</form>";
	}
	echo "</table>";
	echo "</section>";
			
}

mysqli_free_result( $db_erg );
								
?>									
	<a class="button" href="?page=550">Neue Aktion hinzuf&Uuml;gen</a> 
</section>