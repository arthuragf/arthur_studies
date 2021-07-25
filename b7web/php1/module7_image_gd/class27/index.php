<?php
//creates a square with 300x300;
$oImg = imagecreatetruecolor(300,300);
//defines color as red
$nColor = imagecolorallocate($oImg, 255, 0, 0);
//red background
imagefill($oImg, 0, 0, $nColor);
//proccess to just show the image without saving it
//header("Content-Type: image/jpeg");
//imagejpeg($oImg, null, 100);

//proccess to save the image on disk
imagejpeg($oImg,'./images/new_square.jpg',100);

//proccess to save png file on dis
imagepng($oImg,'./images/new_square.png');