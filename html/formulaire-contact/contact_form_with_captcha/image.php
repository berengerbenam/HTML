<?php
$rand = $_GET['mot'];
// creation de l image
$font = "Sketch Nice.ttf"; // font style
$dir = 'fonts/';
$image = imagecreatefrompng('bg.png');
$text_color = imagecolorallocate($image,0,0,0);
//imagestring($image,5,5,5,$rand,$text_color);
imagettftext ($image, 22, 0, 1, 30, $text_color, $dir.$font, $rand);
// affichage de l image
header('Content-type:image/png');
imagepng($image);

?>