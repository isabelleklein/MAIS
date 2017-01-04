<?php include('side_navigation/nav_contact.php');?>

	<div id="content" class="clearfix">
	
		<h2>Kontakt</h2>
	
		Haben Sie Fragen zu unseren Dienstleistungen, stehen wir Ihnen jederzeit gerne telefonisch zur Verfügung.<br> Telefon: 0621 - 59 11 40<br> 
		Oder nutzen Sie für die Kontaktaufnahme unser unten stehendes Formular. Bitte beachten Sie, dass wir Angaben in den mit * gekennzeichneten Feldern für die Bearbeitung Ihrer Anfrage benötigen.

				
		<p class="content"></p>

		<?php

// Grundlegende Einstellungen:
$Mail = "info@dlz-handwerk.de"; //Hier die eigene E-Mail Adresse einfügen.
$Betreff = "Anfrage - GebäudereinigerInnung"; //Hier Betreff der E-Mail angeben, welche an die E-Mail Adresse versandt wird.
$Name = "Gebäudereiniger Rheinhessen-Pfalz"; //Dein Name
$Homepage = "www.gebaeudereiniger-rheinhessen-pfalz.de"; // Deine Website

//Empfaengeremail für Links auf anderen Seiten

$_SESSION['contact_mail'] = $Mail;


// Hier folgt zu allererst das Formular
// Als action wird $_SERVER['PHP_SELF'] angegeben, das die aktuelle Seite angibt.
// Als Method wähle ich POST.
// Ich habe mir gedacht für ein Kontaktformular braucht man 3 Felder: Name, E-Mail und Nachricht.
// Das Formular soll immer angezeigt werden, deshalb ist es außerhalb des PHP-Bereichs, wo die If { .. } ELSE { .. } Abfrage ist.
// Des weiteren habe ich noch zwei Buttons: Abschicken (type="submit") und Zurücksetzen (type="reset") reingegeben.
// Damit hätten wir das Formular:

// Wenn (der submit Button gedrückt wurde){ dann weitermachen }
// Sonst { Einen Fehler ausgeben }
  
if(isset($_POST['abschicken'])){ // Der abschicken button wurde gedrückt.
   
	if(empty($_POST['Name']) OR empty($_POST['Mail']) OR empty($_POST['Eintrag']) OR empty($_POST['Telefon'])){ // Wenn eins der Felder nicht ausgefüllt wurde, dann wird darauf hingewiesen, dass man alle Felder ausfüllen muss.
    	echo ("<p class=\"error\">  Bitte f&uuml;llen Sie alle Felder korrekt aus!</p>");
    	}

    	else{ // Wenn alle Felder ausgefüllt wurden, dann wird das Mail verschickt:
      		  // Vorher gebe ich den einzelnen POST Daten kürzere Namen.

      		$Abs_Mail = $_POST['Mail']; 
      		$Abs_Name = $_POST['Name'];
      		$Abs_Firma = $_POST['Firma'];
     		$Abs_Telefon = $_POST['Telefon'];
      		$Abs_Nachricht = $_POST['Eintrag'];
      		//Nun werde ich eine kleine persönliche Nachricht hinzufügen. Natürlich kann diese individuell angepasst werden..
      		$Nachricht = "Guten Tag $Name!\n\n Name $Abs_Name\n Firma $Abs_Firma\n Telefon $Abs_Telefon\n Anfrage \n$Abs_Nachricht\n";
 
      		//Nun kommt die Mail funktion:
      		$senden = mail($Mail, $Betreff, $Nachricht,"From: $Abs_Mail");
 

     		if($senden){ // Wenn die Mail versandt wurde, dann diesen Text ausgeben:
        		echo ("<p class=\"good\"> Ihre Mail wurde erfolgreich an uns versandt. Vielen Dank für Ihre Anfrage</p>");
      			}
 
      			else { //Sonst diesen :
        			echo ("<p class=\"error\">  Ihre Mail konnte leider nicht an uns versandt werden. Probieren Sie es sp&auml;ter noch einmal</p>");
      				}
      
    			}
  			}
  
  	else{ //Der abschicken button wurde nicht gedrückt
    	echo("<p class=\"clearfix\"> Hier k&ouml;nnen Sie uns eine Anfrage &uuml;ber diese Website mailen!</p>");
  		}
?>
	
<form action="?page=500" method="POST">
	<table id="contact">
		<tr><td>Name*</td><td><input type="text" name="Name"></td></tr>
		<tr><td>Firma</td><td><input type="text" name="Firma"></td></tr>
		<tr><td>E-Mail*</td><td><input type="text" name="Mail"></td></tr>
		<tr><td>Telefon*</td><td><input type="int" name="Telefon"></td></tr>
		<tr><td>Ihre Anfrage*</td><td><textarea name="Eintrag" cols="50" rows="10"></textarea></td></tr>
		<tr><td><input type="submit" value="abschicken" name="abschicken"></td><td><input type="reset" value="zur&uuml;cksetzen" name="reset"></td></tr>
		</table>
	</form></p>

</p>
<p class="clearfix">Personenbezogene Daten, welche von Ihnen durch unsere Formulare oder per E-Mail an uns übermittelt werden, werden nur zu dem entsprechenden Zweck (z.B. Kontaktaufnahme) intern gespeichert und verarbeitet. Dies geschieht im Einklang mit den geltenden Datenschutzgesetzen. Eine anderweitige Verwendung Ihrer Daten, insbesondere eine Weitergabe an Dritte, erfolgt nicht.</p>
	
	</div> <!-- Content Ende -->
