<?php
$sFile = './images/honey.jpg';
$nWidth = 500;
$nHeight = 500;
$nX = 0;
$nY = 0;

list($nOrinWidth, $nOriHeight) = getimagesize($sFile);

$nImgRatio = $nOrinWidth/$nOriHeight;
$nFinalRatio = $nWidth/$nHeight;

if ($nFinalRatio > $nImgRatio) {
    $nFinalWidth = $nHeight * $nImgRatio;
    $nFinalHeight = $nHeight;
} else {
    $nFinalHeight = $nWidth/$nImgRatio;
    $nFinalWidth = $nWidth;
}

if ($nFinalWidth < $nWidth) {
    $nFinalHeight = $nWidth/$nImgRatio;
    $nFinalWidth = $nWidth;
    $nY = ($nFinalHeight - $nHeight)/2*-1;
} else {
    $nFinalWidth = $nHeight * $nImgRatio;
    $nFinalHeight = $nHeight;
    $nX = ($nFinalWidth - $nWidth)/2*-1;
}

$oOriginalImg = imagecreatefromjpeg($sFile);
$oNewImg = imagecreatetruecolor($nWidth, $nHeight);

imagecopyresampled(
    $oNewImg
    , $oOriginalImg
    , $nX, $nY
    , 0, 0
    , $nFinalWidth, $nFinalHeight
    , $nOrinWidth, $nOriHeight
);

header('Content-Type: image/jpeg');
imagejpeg($oNewImg, null, 100);