<?php
// The implementation is VERY INEFFICIENT!!
$raw_file_name = $_GET ["raw_file"];

$file = fopen ($raw_file_name, "r") or die ("Unable to open " . $raw_file_name . "!");
$file_size = filesize ($raw_file_name);
$file_contents = fread ($file, $file_size);
fclose ($file);

$array_contents = unpack ("C*", $file_contents);

$image_size = floor (sqrt ($file_size / 3));
$image = imagecreatetruecolor ($image_size, $image_size);

$index = 1;

for ($y = 0; $y < $image_size; $y++)
{
	for ($x = 0; $x < $image_size; $x++)
	{
		imagesetpixel ($image, $x, $y, imagecolorallocate ($image, $array_contents [$index ++], $array_contents [$index ++], $array_contents [$index ++]));
	}
}
 
header ("Content-Type: image/png");
imagepng ($image);
imagedestroy ($image);
?>
