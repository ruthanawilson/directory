<?php

// Session is started.
session_start();

// Name of the template file.
$template_file = 'couples-template.php';

// Root folder if working in subdirectory. Name is up to you ut must match with server's folder.
$base_path = '/couple/';

// Path to the directory where you store the "couples-template.php" file.
$template_path = '../template/';

// Path to the directory where php will store the auto-generated couple's pages.
$couples_path = '../couples/';

// Posted data.
$data['groom-name'] = str_replace(' ', '', $_POST['groom-name']);
$data['bride-name'] = str_replace(' ', '', $_POST['bride-name']);
// $data['groom-surname'] = $_POST['groom-surname'];
// $data['bride-surname'] = $_POST['bride-surname'];
$data['wedding-date'] = $_POST['wedding-date'];
$data['email'] = $_POST['email'];
$data['code'] = str_replace(array('/', '-', ' '), '', $_POST['wedding-date']).strtoupper(substr($data['groom-name'], 0, 1)).urlencode('&').strtoupper(substr($data['bride-name'], 0, 1));

// Data array (Should match with data above's order).
$placeholders = array('{groom-name}', '{bride-name}', '{wedding-date}', '{email}', '{code}');

// Get the couples-template.php as a string.
$template = file_get_contents($template_path.$template_file);

// Fills the template.
$new_file = str_replace($placeholders, $data, $template);

// Generates couple's URL and makes it frendly and lowercase.
$couples_url = str_replace(' ', '', strtolower($data['groom-name'].'-'.$data['bride-name'].'.php'));

// Save file into couples directory.
$fp = fopen($couples_path.$couples_url, 'w');
fwrite($fp, $new_file);
fclose($fp);

// Set the variables to pass them to success page.
$_SESSION['couples_url'] = $couples_url;
// If working in root directory.
$_SESSION['couples_path'] = str_replace('.', '', $couples_path);
// If working in a sub directory.
//$_SESSION['couples_path'] = substr_replace($base_path, '', -1).str_replace('.', '',$couples_path);

header('Location: success.php');

?>