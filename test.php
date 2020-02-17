<?php

echo "Vada structure will be entered here<br> Thesis<br>Example/Rule<br> Etc.";

$name = "vada";

echo "|<br>The $name project<br>";

echo '<a href="https://www.google.com">google</a>';

$flag_trigger = "no";

if ($flag_trigger == "no")
{
echo "<br> Present a dialogue box.";	
}
else
{
	echo "<br> This flag has not been triggered <br>"; 
}


$vada_logic = array('Thesis ','Reason');

//echo $vada_logic[0]; 

$vada_logic = array('Thesis'=>'purusa','Reason'=>' is permanent');

echo $vada_logic['Thesis'];
echo $vada_logic ['Reason'];

?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
  </head>
  <body>
    <form>
      <select>
        <option value="books">Books</option>
        <option value="html">HTML</option>
        <option value="css">CSS</option>
        <option value="php">PHP</option>
        <option value="js">JavaScript</option>
      </select>
    </form>
  </body>
</html>