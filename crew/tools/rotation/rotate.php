<?php
$count = 0;
while ($count < 360){
$filename = 'orig.png';
$rotang = -$count; // Rotation angle
$source = imagecreatefrompng($filename) or die('Error opening file '.$filename);
imagealphablending($source, false);
imagesavealpha($source, true);
$rotation = imagerotate($source, $rotang, imageColorAllocateAlpha($source, 0, 0, 0, 127));
imagealphablending($rotation, false);
imagesavealpha($rotation, true);
header('Content-type: image/png');
imagepng($rotation, "rotate/{$count}.png");
imagedestroy($source);
imagedestroy($rotation);
$count = $count + 1;

}
?>