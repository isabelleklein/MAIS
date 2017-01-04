<?php include('side_navigation/nav_member.php');?>

	<div id="content" class="clearfix">
	
		<h2>Stellengesuche</h2>
	
		Mit Hilfe dieses Formulars erstellen Sie eine Anfrage f�r ein Stellengesuch 		welche daraufhin unter dem Men�punkt<br> <b>"Aus-/Weiterbildung -> Stellenmarkt"</b> 			eingestellt wird. 

				
		<p class="content"></p>

		<?php

// Grundlegende Einstellungen:
$Mail = "info@staiber-solution.com"; //Hier die eigene E-Mail Adresse einf�gen.
$Betreff = "Anfrage - Stellengesuch"; //Hier Betreff der E-Mail angeben, welche an die E-Mail Adresse versandt wird.
$Name = "Geb�udereiniger Rheinhessen-Pfalz"; //Dein Name
$Homepage = "www.gebaeudereiniger-rheinhessen-pfalz.de"; // Deine Website

//Empfaengeremail f�r Links auf anderen Seiten

$_SESSION['contact_mail'] = $Mail;


// Hier folgt zu allererst das Formular
// Als action wird $_SERVER['PHP_SELF'] angegeben, das die aktuelle Seite angibt.
// Als Method w�hle ich POST.
// Ich habe mir gedacht f�r ein Kontaktformular braucht man 3 Felder: Name, E-Mail und Nachricht.
// Das Formular soll immer angezeigt werden, deshalb ist es au�erhalb des PHP-Bereichs, wo die If { .. } ELSE { .. } Abfrage ist.
// Des weiteren habe ich noch zwei Buttons: Abschicken (type="submit") und Zur�cksetzen (type="reset") reingegeben.
// Damit h�tten wir das Formular:

// Wenn (der submit Button gedr�ckt wurde){ dann weitermachen }
// Sonst { Einen Fehler ausgeben }
  
if(isset($_POST['abschicken'])){ // Der abschicken button wurde gedr�ckt.
   
	if(empty($_POST['Name']) OR empty($_POST['Mail']) OR empty($_POST['Eintrag']) OR empty($_POST['Telefon'])){ // Wenn eins der Felder nicht ausgef�llt wurde, dann wird darauf hingewiesen, dass man alle Felder ausf�llen muss.
    	echo ("<p class=\"error\">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p>");
    	}

    	else{ // Wenn alle Felder ausgef�llt wurden, dann wird das Mail verschickt:
      		  // Vorher gebe ich den einzelnen POST Daten k�rzere Namen.

      		$Abs_Mail = $_POST['Mail']; 
      		$Abs_Name = $_POST['Name'];
      		$Abs_Firma = $_POST['Firma'];
     		$Abs_Telefon = $_POST['Telefon'];
      		$Abs_Nachricht = $_POST['Eintrag'];
      		$Abs_Adresse = $_POST['Adresse'];
      		$Abs_PLZ = $_POST['PLZ'];
      		//Nun werde ich eine kleine pers�nliche Nachricht hinzuf�gen. Nat�rlich kann diese individuell angepasst werden..
      		$Nachricht = "Guten Tag $Name!\n\n Name $Abs_Name\n Firma $Abs_Firma\n 
      		Adresse $Abs_Adresse\n PLZ $Abs_PLZ\n Telefon $Abs_Telefon\n Anfrage \n$Abs_Nachricht\n";
 
      		//Nun kommt die Mail funktion:
      		$senden = mail($Mail, $Betreff, $Nachricht,"From: $Abs_Mail");
 

     		if($senden){ // Wenn die Mail versandt wurde, dann diesen Text ausgeben:
        		echo ("<p class=\"good\"> Ihre Mail wurde erfolgreich an uns versandt. Vielen Dank f�r Ihre Anfrage</p>");
      			}
 
      			else { //Sonst diesen :
        			echo ("<p class=\"error\">  Ihre Mail konnte leider nicht an uns versandt werden. Probieren Sie es sp&auml;ter noch einmal</p>");
      				}
      
    			}
  			}
  
  	else{ //Der abschicken button wurde nicht gedr�ckt
    	echo("<p class=\"clearfix\"> </p>");
  		}
?>
	
<form action="?page=706" method="POST">
	<table id="contact">
		<tr><td>Firma</td><td><input type="text" name="Firma"></td></tr>
		<tr><td>Ansprechpartner*</td><td><input type="text" name="Name"></td></tr>
		<tr><td>Adresse</td><td><input type="text" name="Adresse"></td></tr>
		<tr><td>PLZ / Ort</td><td><input type="text" name="PLZ"></td></tr>
		<tr><td>E-Mail*</td><td><input type="text" name="Mail"></td></tr>
		<tr><td>Telefon*</td><td><input type="int" name="Telefon"></td></tr>
		<tr><td>Ihr Stellengesuch*</td><td><textarea name="Eintrag" cols="50" rows="10"></textarea></td></tr>
		<tr><td><input type="submit" value="abschicken" name="abschicken"></td><td><input type="reset" value="zur&uuml;cksetzen" name="reset"></td></tr>
		</table>
	</form></p>

</p>
<p class="clearfix">Personenbezogene Daten, welche von Ihnen durch unsere Formulare oder per E-Mail an uns �bermittelt werden, werden nur zu dem entsprechenden Zweck (z.B. Kontaktaufnahme) intern gespeichert und verarbeitet. Dies geschieht im Einklang mit den geltenden Datenschutzgesetzen. Eine anderweitige Verwendung Ihrer Daten, insbesondere eine Weitergabe an Dritte, erfolgt nicht.</p>
	
	</div> <!-- Content Ende -->
