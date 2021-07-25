<?php
$sFile = './images/tree.jpg';
$nMaxWidth = 200;
$nMaxHeight = 200;

list($nOriWidth, $nOriHeight) = getimagesize($sFile);

$nImgRatio = $nOriWidth/$nOriHeight;
$nFinalRatio = $nMaxWidth/$nMaxHeight;

if ($nFinalRatio > $nImgRatio) {
    $nFinalWidth = $nMaxHeight * $nImgRatio;
    $nFinalHeight = $nMaxHeight;
} else {
    $nFinalHeight = $nMaxWidth/$nImgRatio;
    $nFinalWidth = $nMaxWidth;
}

$oOriginalImg = imagecreatefromjpeg($sFile);
$oNewImg = imagecreatetruecolor($nFinalWidth, $nFinalHeight);

imagecopyresampled(
    $oNewImg
    , $oOriginalImg
    , 0, 0
    , 0, 0
    , $nFinalWidth, $nFinalHeight
    , $nOriWidth, $nOriHeight
);

header('Content-Type: image/jpeg');
imagejpeg($oNewImg, null, 100);