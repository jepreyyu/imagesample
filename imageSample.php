<?php
//for ($x = 1000; $x <= 1500; $x++) 
//{

$image = 'https://hpihris.hondaph.com/MediaFiles/EmployeeId/0107.jpg';
$imageData = base64_encode(file_get_contents($image));
echo"<img src='data:image/jpeg;base64,".$imageData."' style='height:150px; width:150px;border:solid;border-radius:10px'>" ;
//}

?>