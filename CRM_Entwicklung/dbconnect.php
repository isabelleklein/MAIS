<?php
$db = mysqli_connect("localhost","root","","mannheimer");

if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
?>