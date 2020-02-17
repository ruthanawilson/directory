<?php

$servername = "localhost";
$dBUsername = "leafy";
$dBPassword = "vada";
$dBName = "loginsystem";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn)
{
	die("Connection failed: ".mysqli_connect_error());
}