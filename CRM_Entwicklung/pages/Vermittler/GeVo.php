<section>
	<header class="main">
		<h2>Vermittler-Gesch&auml;ftsvorf&auml;lle</h2>
	</header>
</section>
<?php 
									$sql = "SELECT t1.* FROM Vermittler as t2 INNER JOIN Vermittler_Konto as t3 ON t2.Vermittler_ID = t3.Vermittler_ID INNER JOIN GeVo_Vorgang as t1 ON t3.UV = t1.GeVo_ASNR WHERE t2.Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
									$_SESSION['GeVo_ID']="";	
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
		  									echo "<td>". $zeile['GeVo_ASNR'] . "</td>";
		  									echo "<td>". $zeile['GeVo_ASNR'] . "</td>";
		  									echo "<td>". $zeile['GeVo_Infofeld'] . "</td>";
		  									echo "<td>". $zeile['GeVo_Infofeld'] . "</td>";
		  									echo "<td><input type='hidden' name='gevo_id' value='".$zeile['GeVo_ID']."'></td>";
		  									echo "<td><input type='submit' name='gevo' value='Details' />";
											echo "</tr>";
											echo "</form>";
										}
										echo "</table>";
										echo "</section>";
												
									}
								
									mysqli_free_result( $db_erg );
									
		?>
								<a class="button" href="?page=501">Neuen Gesch&auml;ftsvorfall hinzuf&Uuml;gen</a> 