<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `GeVo_Vorgang` SET `GeVo_Eingang`='2000-01-01', `GeVo_Beginn`='2000-01-01' WHERE `GeVo_ID`='".$_SESSION['GeVo_ID']."'";
	if (mysqli_query($db,$sql)) {
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	header("Location: ?page=210");
}
if(isset($_POST['back'])){
	header("Location: ?page=210");
}
		
			if($_SESSION['GeVo_ID']==""){
				$_SESSION['GeVo_ID']=getID();
				$sql = "INSERT INTO `GeVo_Vorgang` (`GeVo_ID`, `GeVo_ASNR`) VALUES ('".$_SESSION['GeVo_ID']."','12345')";
				if (mysqli_query($db,$sql)) {
				} else {
    				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}			
			}
			
			$sql = "SELECT t1.* FROM GeVo_Vorgang as t1 WHERE t1.GeVo_ID = '".$_SESSION['GeVo_ID']."'";
			$db_erg = mysqli_query($db,$sql);
			if ( ! $db_erg ){
	  			die('Ungültige Abfrage: ' . mysqli_error($db));
			}
			while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>

<section>
	<h1 id="elements">Gevo-Details</h1>
	<div class="row 200%">
		<!-- class="6u 12u$(medium)" bedeutet halbe Seite-->
		<!-- class="12u 12u$(medium)" bedeutet ganze Seite-->
		<div class="12u 12u$(medium)">
			<!-- Form -->
			<form action="?page=501" method="post"> 
				<div class="box">
					<div class="row uniform">
						
						<div class="4u 12u$(small)">
							<label for="eingang">Eingang</label>
							<input id="eingang" name="eingang" placeholder="02.03.1990" type="date" value="<?php echo $zeile['GeVo_Eingang']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="beginn">Beginn</label>
							<input id="beginn" name="beginn" placeholder="02.03.1990" type="date" value="<?php echo $zeile['GeVo_Beginn']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="erledigt">erledigt</label>
							<input id="erledigt" name="erledigt" placeholder="02.03.1990" type="date" value="<?php echo $zeile['GeVo_Erledigt']?>" />
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="gevo_id" value="<?php echo $zeile['GeVo_ID']?>"></div>
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
										echo "<th>Feld1</th>";
										echo "<th>Feld2</th>";
										echo "<th>Feld3</th>";
										echo "<th>Feld4</th>";
										echo "<th></th>";
										echo "</thead>";
												
										while ($zeile = mysqli_fetch_array( $db_erg)){	
		  									echo "<form action='?page=999' method='post'>";
		  									echo "<tr>";
		  									echo "<td>". $zeile['Aktion_ID'] . "</td>";
		  									echo "<td>". $zeile['Aktion_GeVo_ID'] . "</td>";
		  									echo "<td>". $zeile['Aktion_ID'] . "</td>";
		  									echo "<td>". $zeile['Aktion_ID'] . "</td>";
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