
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
		  									echo "<tr>";
		  									echo "<td>". $zeile['Personen_Vorname'] . "</td>";
		  									echo "<td>". $zeile['Personen_Nachname'] . "</td>";
		  									echo "<td>". $zeile['Personen_GEB'] . "</td>";
		  									echo "<td>". $zeile['Personen_Titel'] . "</td>";
		  									
											echo "<td><a href='?page=250' class='button' onclick='document.write('".person_detail($zeile['Personen_ID'])."')' >Details</a></td>";
											echo "</tr>";
										}
										echo "</table>";
										echo "</section>";
												
									}
								
									mysqli_free_result( $db_erg );
									
								?>
						
								<!-- <a href="?page=250" class="button" onclick="document.open('<?php neue_person() ?>')" >neue Person hinzuf&Uuml;gen</a>
								-->
								<a href="?page=250" class="button" onclick="javascript:new_person()" >neue Person hinzuf&Uuml;gen</a>
			

<script type="text/javascript">
	function new_person(){
		<?php
			$_SESSION['Personen_ID']="123456";

		?>
	}


</script>
<?php

	function neue_person()
	{
		$_SESSION['Personen_ID']="123456";
		
	}
	
	function person_detail($personen_id)
	{
		$_SESSION['Personen_ID']=$personen_id;
	}


?>
			
								