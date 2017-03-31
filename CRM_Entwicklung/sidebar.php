
				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="?page=101&msg=s">
										<input type="text" name="query" id="query" placeholder="Vermittlersuche" />
									</form>
								</section>
								
								
								<!-- aktueller Vermittler -->
								<?php 
									if($_SESSION['Vermittler_ID'] != "") {
										
										$sql = "SELECT DISTINCT t1.Vermittler_ID, t2.ZAD_Name, t2.ZAD_PLZ, t2.ZAD_ORT FROM Vermittler AS t1 INNER JOIN ZAD AS t2 ON t1.Vermittler_ZAD = t2.ZAD_ZAD WHERE t1.Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
											
										$db_erg = mysqli_query($db,$sql);
												
										if ( ! $db_erg ){
		  									die('Ungültige Abfrage: ' . mysqli_error($db));
										}											
										
	
										echo "<section>";
										echo "<header class='major'>";
											echo "<h2>aktueller Vermittler</h2>";
										echo "</header>";
										while ($zeile = mysqli_fetch_array( $db_erg)){	
			  								echo "<p>". $zeile['Vermittler_ID'] ." ". $zeile['ZAD_Name'] ."<br>";
			  								echo $zeile['ZAD_PLZ'] ." ". $zeile['ZAD_ORT'] ."</p>";
			  							
			  							}	
			  							echo "</section>";							
									}					
								?>
								
							<!-- Menu -->
							<section>
								<nav id="menu">
									<header class="major">
										<h2>Navigation</h2>
									</header>
									<ul>
										<li><a href="?page=000">-Vorlage1-</a></li>
										<li><a href="?page=001">-Vorlage2-</a></li>
										<li><a href="?page=002">-Vorlage3-</a></li>
										<li><a href="?page=100">Dashboard</a></li>
										<li>
											<span class="opener">Vermittler</span>
											<ul>
												<li><a href="?page=200">Stammdaten</a></li>
												<li><a href="?page=201">Personen</a></li>
												<li><a href="?page=202">Konten</a></li>
												<li><a href="?page=203">Statistik</a></li>
												<li><a href="?page=204">Kontakt</a></li>
												<li><a href="?page=205">Aufgaben</a></li>
												<li><a href="?page=206">Kampagne</a></li>
												<li><a href="?page=207">Angebote</a></li>
												<li><a href="?page=208">Termine</a></li>
												<li><a href="?page=209">Vereinbarung/Vertr&auml;ge</a></li>
												<li><a href="?page=210">GeVo's</a></li>
											</ul>
										</li>
										<li><a href="?page=300">Statistiken</a></li>
										<li><a href="?page=400">Kampagne</a></li>
										<li><a href="?page=500">GeVo's</a></li>
										<li><a href="?page=600">Aufgaben</a></li>
									</ul>
								</nav>
							</section>
						
							<!-- Section 
								<section>
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">More</a></li>
									</ul>
								</section>-->

								<!-- Section -->
								<section>
									<header class="major">
										<h2>Ansprechpartner</h2>
									</header>
									<p>Hier kommt ein Text hin!</p>
									<ul class="contact">
										<li class="fa-envelope-o"><a href="#">information@untitled.tld</a></li>
										<li class="fa-phone">(000) 000-0000</li>
										<li class="fa-home">1234 Somewhere Road #8254<br />
										Nashville, TN 00000-0000</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; Mannheimer <a href="" class="copyright">Impressum</a></p>
								</footer>

						</div>
					</div>
