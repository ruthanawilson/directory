<?php

//connect to database
$conn = mysqli_connect('localhost', 'leafy', 'vada', 'u240763051_6dszd');

//check connection
if(!$conn){
	echo 'Connection Error: ' . mysqli_connect_error();
}

?>