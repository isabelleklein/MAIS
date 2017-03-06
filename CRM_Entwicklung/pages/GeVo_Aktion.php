<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `GeVo_Aktion` SET `Aktion_Erstellt`='".$_POST['erstellt']."', `Aktion_Status`='1' WHERE `Aktion_ID`='".$_SESSION['Aktion_ID']."'";
	if (mysqli_query($db,$sql)) {
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	header("Location: ?page=501");
}
if(isset($_POST['back'])){
	header("Location: ?page=501");
}
			if($_SESSION['Aktion_ID']==""){
				require_once('Vermittler\function.php');	
				$new_id = new new_id();	
				$_SESSION['Aktion_ID']=$new_id->id_berechnen();
				$sql = "INSERT INTO `GeVo_Aktion` (`Aktion_ID`, `Aktion_GeVo_ID`) VALUES ('".$_SESSION['Aktion_ID']."','".$_SESSION['GeVo_ID']."')";
				if (mysqli_query($db,$sql)) {
				} else {
    				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}			
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
		<!-- class="6u 12u$(medium)" bedeutet halbe Seite-->
		<!-- class="12u 12u$(medium)" bedeutet ganze Seite-->
		<div class="12u 12u$(medium)">
			<!-- Form -->
			<form action="?page=550" method="post"> 
				<div class="box">
					<div class="row uniform">
						
						<div class="4u 12u$(small)">
							<label for="erstellt">Erstellt</label>
							<input id="erstellt" name="erstellt" placeholder="User" type="text" value="<?php echo $zeile['Aktion_Erstellt']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="status">Status</label>
							<input id="status" name="status" placeholder="Status" type="text" value="<?php echo $zeile['Aktion_Status']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="erledigt">erledigt</label>
							<input id="erledigt" name="erledigt" placeholder="02.03.1990" type="date" value="<?php echo $zeile['Aktion_Erledigt']?>" />
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