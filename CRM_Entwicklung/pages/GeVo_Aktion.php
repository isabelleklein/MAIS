<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `GeVo_Aktion` SET `Aktion_Erstellt`='".$_POST['erstellt']."', `Aktion_Aktionsart`='".$_POST['art']."' , `Aktion_Infofeld`='".$_POST['info']."' , `Aktion_Referenz_MaT	S`='".$_POST['mats']."' , `Aktion_Notizen`='".$_POST['notiz']."' , `Aktion_Wiedervorlage`='".$_POST['wvorlage']."' , `Aktion_Status`='".$_POST['status']."' WHERE `Aktion_ID`='".$_SESSION['Aktion_ID']."'";
	do_sql_no_return($db, $sql, "550save");
	openlink("501");
}
if(isset($_POST['back'])){
	openlink("501");
}

if($_SESSION['Aktion_ID']==""){
	$_SESSION['Aktion_ID']=getID();
	$sql = "INSERT INTO `GeVo_Aktion` (`Aktion_ID`, `Aktion_GeVo_ID`, `Aktion_Erstellt`) VALUES ('".$_SESSION['Aktion_ID']."','".$_SESSION['GeVo_ID']."',".date("Ymd").")";
	do_sql_no_return($db, $sql, "550insert");
}

$sql = "SELECT t1.* FROM GeVo_Aktion as t1 WHERE t1.Aktion_ID = '".$_SESSION['Aktion_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>
<section>
	<h1 id="elements">Gevo-Aktion</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=550" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="12u$">
							<label for="erstellt">Erstellt am:</label>
							<input id="erstellt" name="erstellt" type="date" value="<?php echo $zeile['Aktion_Erstellt']?>" />
						</div>
						<div class="12u$">
							<label for="art">Aktionsart:</label>
							<div class="select-wrapper">
								<select id="art" name="art">
								<option value="0" <?php if ($zeile['Aktion_Aktionsart']=="0"){echo "selected";} ?>>- Aktionsart -</option>
								<option value="1" <?php if ($zeile['Aktion_Aktionsart']=="1"){echo "selected";} ?>>Art 1</option>
								<option value="2" <?php if ($zeile['Aktion_Aktionsart']=="2"){echo "selected";} ?>>Art 2</option>
								<option value="3" <?php if ($zeile['Aktion_Aktionsart']=="3"){echo "selected";} ?>>Art 3</option>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="info">Aktionsinfo:</label>
							<input id="info" name="info" placeholder="Aktionsinfo" type="text" value="<?php echo $zeile['Aktion_Infofeld']?>" />
						</div>
						<div class="12u$">
							<label for="mats">MAtS-Referenz:</label>
							<input id="mats" name="mats" placeholder="MAtS-Referenz" type="text" value="<?php echo $zeile['Aktion_Referenz_MaTS']?>" />
						</div>
						<div class="12u$">
							<label for="notiz">Notizen:</label>
							<textarea id="notiz" name="notiz" placeholder="Notizen" rows="6"><?php echo $zeile['Aktion_Notizen']?></textarea>
						</div>
						<div class="12u$">
							<label for="wvorlage">Wiedervorlage:</label>
							<input id="wvorlage" name="wvorlage" placeholder="" type="date" value="<?php echo $zeile['Aktion_Wiedervorlage']?>" />
						</div>
						<div class="12u$">
							<label for="status">Aktionsstatus:</label>
							<div class="select-wrapper">
								<select id="status" name="status">
								<option value="0" <?php if ($zeile['Aktion_Status']=="0"){echo "selected";} ?>>- Status -</option>
								<option value="1" <?php if ($zeile['Aktion_Status']=="1"){echo "selected";} ?>>offen</option>
								<option value="2" <?php if ($zeile['Aktion_Status']=="2"){echo "selected";} ?>>erledigt</option>
								</select> 
							</div>
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="aktion_id" value="<?php echo $zeile['Aktion_ID']?>"></div>
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