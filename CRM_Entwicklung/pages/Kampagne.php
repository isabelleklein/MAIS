						<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Kampangen</h1>
											<a href="javascript:AnzeigeUmschalten('new_Kampange');" class="button special">neue Kampange</a>
										</header>
									</div>
									
								</section>
								
								<section id="new_Kampange" style="display:none;">
									
									<form action="index.php?page=400" method="post">
										<table>
											<tr>
												<td>Kampangenname</td>
												<td><input type="text" name="Kampangenname"></td>
											</tr>
											<tr>
												<td>Kampangenart</td>
												<td><input type="text" name="Kampangenart"></td>
											</tr>
											<tr>
												<td>Kampangenbeginn</td>
												<td><input type="text" name="Beginn"></td>
											</tr>
											<tr>
												<td>Kampangenende</td>
												<td><input type="text" name="Ende"></td>
											</tr>
											<tr>
												<td>Kampangenerfasser</td>
												<td><input type="text" name="Erfasser"></td>
											</tr>
											<tr>
												<td>KampangenID</td>
												<td><input type="text" name="ID"></td>
											</tr>
											<tr>
												<td>Kampangenbeschreibung</td>
												<td><input type="text" name="Kampangenbeschreibung"></td>
											</tr>											
										</table>
										
										<input type="submit" value="Speichern">
									</form>
									
								</section>
								
															
									<?php
									if (isset($_POST['Kampangenname'])){
										$sql = "INSERT INTO Kampange (Kampange_ID, Kampange_Name, Kampange_Beginn, Kampange_Ende, Kampange_Art, Kampange_Erfasser, Kampange_Beschreibung ) VALUES('".$_POST['ID']."','".$_POST['Kampangenname']."','".$_POST['Beginn']."','".$_POST['Ende']."','".$_POST['Kampangenart']."','".$_POST['Erfasser']."','".$_POST['Kampangenbeschreibung']."');";							
											
										$result = mysqli_query($db, $sql) 
          											OR die("'".$sql."':".mysqli_error());		
									}
									?>


							<!-- Section Ausgabe-Tabelle Kampangen-->
								<section>
									<?php
										
										$sql = 'SELECT * FROM kampange';
									
										$db_erg = mysqli_query($db,$sql);
										
										if ( ! $db_erg ){
  											die('Ungültige Abfrage: ' . mysqli_error($db));
										}
										
										if (is_null($db_erg)){
										
											echo "Es wurden keine Kampangen gefunden";
										
										}else{
											
											?>
											<table border="1">
											<thead>
												<th>Art</th>
												<th>Beginn</th>
												<th>Ende</th>
												<th>Beschreibung</th>
												<th>Erfasser</th>
												<th>Name</th>
												<th></th>
											</thead>
											<?php 
											while ($zeile = mysqli_fetch_array( $db_erg)){	
	  											echo "<tr>";
	  											echo "<td>". $zeile['Kampange_Art'] . "</td>";
	  											echo "<td>". $zeile['Kampange_Beginn'] . "</td>";
	  											echo "<td>". $zeile['Kampange_Ende'] . "</td>";
	  											echo "<td>". $zeile['Kampange_Beschreibung'] . "</td>";
											  	echo "<td>". $zeile['Kampange_Erfasser'] . "</td>";
											  	echo "<td>". $zeile['Kampange_Name'] . "</td>";
											  	echo "<td><a href='#' class='button'>Details</a></td>";
											  	echo "</tr>";
											}
											echo "</table>";
										}
										mysqli_free_result( $db_erg );
																		
									?>
									
								</section>
								
								<script language="javascript" type="text/javascript" defer="defer">
								<!--
								function AnzeigeUmschalten( i )
								{
								   if ( document.getElementById(i).style.display == 'none' ) {
								      document.getElementById(i).style.display = '';
								   } else {
								      document.getElementById(i).style.display = 'none';
								   }
								}
								//-->
								</script>

							