							<!-- Content -->
								<section>
									<header class="main">
										<h2>Vermittler-Personen</h2>
									</header>
								</section>

								<!-- Table -->
								<h3>Personen-&Uuml;bersicht</h3>

								<?php 
									$sql = "SELECT * FROM Personen as t1 WHERE t1.Personen_Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
									$_SESSION['Personen_ID']="";	
									$db_erg = mysqli_query($db,$sql);
											
									if ( ! $db_erg ){
	  									die('Ungültige Abfrage: ' . mysqli_error($db));
									}
											
									if (mysqli_num_rows($db_erg)>=1){
										echo "<section>";										
										echo "<table border='1'>";
										echo "<thead>";
										echo "<th>Vorname</th>";
										echo "<th>Nachname</th>";
										echo "<th>Geb-Datum</th>";
										echo "<th>Titel</th>";
										echo "<th></th>";
										echo "</thead>";
												
										while ($zeile = mysqli_fetch_array( $db_erg)){	
		  									echo "<form action='?page=999' method='post'>";
		  									echo "<tr>";
		  									echo "<td>". $zeile['Personen_Vorname'] . "</td>";
		  									echo "<td>". $zeile['Personen_Nachname'] . "</td>";
		  									echo "<td>". $zeile['Personen_GEB'] . "</td>";
		  									echo "<td>". $zeile['Personen_Titel'] . "</td>";
		  									echo "<td><input type='hidden' name='pers_id' value='".$zeile['Personen_ID']."'></td>";
		  									echo "<td><input type='submit' name='personen' value='Details' />";
											echo "</tr>";
											echo "</form>";
										}
										echo "</table>";
										echo "</section>";
												
									}
								
									mysqli_free_result( $db_erg );
									
								?>
								<a href="?page=250" class="button">Neue Person hinzuf&Uuml;gen</a>
			
			
								