<?php 
	if($page == 900) {
		session_start();
		unset($_SESSION['user']);
		unset($_SESSION['user_id']);
		unset($_SESSION['role']);
		unset($_SESSION['register']);
		unset($_SESSION['add_news']);
		unset($role);
		include('side_navigation/nav_home.php');

		}
	if($page != 900) include('side_navigation/nav_home.php');?>


	<div id="content" class="clearfix">
	
		<h2><?php if($page == 900) echo 'Auf Wiedersehen Ihre '; if($page != 900) echo 'Herzlich willkommen bei der ';?>Geb&auml;udereiniger-Innung Rheinhessen-Pfalz</h2>
	
		<h3></h3>
	
		<p id="site-description">Sie finden hier viele interessante Informationen &uuml;ber das Geb&auml;udereinigerhandwerk. Wussten Sie, dass das Geb&auml;udereinigerhandwerk nach seiner Besch&auml;ftigtenzahl das zweitgr&ouml;&szlig;te Handwerk in Deutschland ist? </p>
		
						
		<p class="content">Das Geb&auml;udereiniger-Handwerk ist ein modernes und innovatives Dienstleistungshandwerk. Nach seiner Anerkennung als Vollhandwerk im Jahr 1934 hat sich das Geb&auml;udereiniger-Handwerk zu einem leistungsstarken Wirtschaftsbereich entwickelt. <br><br>
		Das Spektrum der im Geb&auml;udereiniger-Handwerk angebotenen Dienstleistungen umfasst neben der klassischen Geb&auml;udereinigung s&auml;mtliche Service- und Dienstleistungen in und an Geb&auml;uden. So geh&ouml;ren Catering-Services, Hol- und Bringdienste, Hausmeister-Dienste, Parkraumbewachung, Kantinenbewirtschaftung oder die Gr&uuml;nfl&auml;chenpflege und Winterdienst bereits zu den Standardangeboten vieler Unternehmen des Geb&auml;udereiniger-Handwerks. <br><br>
		<b>Geb&auml;udereiniger-Innung Rheinhessen-Pfalz</b><br><br>Hubert Fischer<br>Obermeister</p>

		
	
	</div> <!-- Content Ende -->
