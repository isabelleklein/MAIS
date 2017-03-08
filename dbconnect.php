<?php
$db = mysqli_connect("localhost","mannheimer","mannheimer","mannheimer");


if(!$db)
{
  exit("Verbindungsfehler: ".mysqli_connect_error());
}
?>