<?php

if(strlen($_SESSION['Aufgaben_ID'])>31){
	$herkunft = substr($_SESSION['Aufgaben_ID'],30,4);
	$_SESSION['Aufgaben_ID']=substr($_SESSION['Aufgaben_ID'],0,30);
}

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Aufgaben` SET `Aufgaben_Titel`='".$_POST['titel']."', `Aufgaben_Beschreibung`='".$_POST['besch']."', `Aufgaben_GUB`='".$_POST['gub']."', `Aufgaben_Verantwortlicher`='".$_POST['verant']."', `Aufgaben_Status`='".$_POST['status']."', `Aufgaben_Wiedervorlage`='".$_POST['wvl']."' WHERE `Aufgaben_ID`='".$_SESSION['Aufgaben_ID']."'";
	do_sql_no_return($db, $sql, "501save");
	if($_POST['herkunft']=="VERM"){
		openlink("205");
	}else{
		openlink("600");
	}
}
if(isset($_POST['back'])){
	if($_POST['herkunft']=="VERM"){
		openlink("205");
	}else{
		openlink("600");
	}
}
if($_SESSION['Aufgaben_ID']==""){
	$_SESSION['Aufgaben_ID']=getID();
	if($_GET['her']=='v'){
		$sql = "INSERT INTO `Aufgaben` (`Aufgaben_ID`, `Aufgaben_GUV`, `Aufgaben_Erfasser`, `Aufgaben_Vermittler_ID`) VALUES ('".$_SESSION['Aufgaben_ID']."',".date("Ymd").",'".$_SESSION['user_id']."','".$_SESSION['Vermittler_ID']."')";
	}
	else{
		$sql = "INSERT INTO `Aufgaben` (`Aufgaben_ID`, `Aufgaben_GUV`, `Aufgaben_Erfasser`) VALUES ('".$_SESSION['Aufgaben_ID']."',".date("Ymd").",'".$_SESSION['user_id']."')";

	}
	if (mysqli_query($db,$sql)) {
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}			
}

$sql ="SELECT t1.* FROM Aufgaben as t1 WHERE t1.Aufgaben_ID = '".$_SESSION['Aufgaben_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>
<section>
	<h1 id="elements">Aufgaben-Details</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=601" method="post"> 
				<div class="box">
					<div class="row uniform">				
						<div class="12u$">
							<label for="titel">Titel:</label>
							<input id="titel" name="titel" placeholder="Titel" type="text" value="<?php echo $zeile['Aufgaben_Titel']?>" />
						</div>
						<div class="12u$">
							<label for="besch">Beschreibung:</label>
							<textarea id="besch" name="besch" placeholder="Beschreibung" rows="6"><?php echo $zeile['Aufgaben_Beschreibung']?></textarea>
						</div>
						<div class="12u$">
							<label for="gub">Termin:</label>
							<input id="gub" name="gub" type="date" value="<?php echo $zeile['Aufgaben_GUB']?>" />
						</div>
						<div class="12u$">
							<label for="verant">Verantwortlicher:</label>
							<input id="verant" name="verant" placeholder="Verantwortlicher" type="text" value="<?php echo $zeile['Aufgaben_Verantwortlicher']?>" />
						</div>
						<div class="12u$">
							<label for="status">Status:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Aufgaben_Status";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Aufgaben_Status'] == "0" ? "selected":"").">- Status-</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Status_ID"]."' ".($zeile['Aufgaben_Status'] == $row["Status_ID"] ? "selected":"").">".$row["Status_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="status" name="status">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="wvl">Wiedervorlage:</label>
							<input id="wvl" name="wvl" type="date" value="<?php echo $zeile['Aufgaben_Wiedervorlage']?>" />
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="aufgaben_id" value="<?php echo $zeile['Aufgaben_ID']?>"></div>
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
