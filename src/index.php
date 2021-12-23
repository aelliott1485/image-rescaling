<?php
//echo 'Hello world from my own Mac OS X server';
$req = urldecode(basename($_SERVER['REQUEST_URI']));
preg_match('#^(\w+)!(\d+)\.(png|jpg|gif)#i', $req, $matches);
if (!$matches) {
    die();
}
[$whole, $name, $size, $ext] = $matches;
$size = intval($size);
if (($size > 2000) || ($size % 50 != 0))
    die();
$f = $name . '.' . $ext;
list($width, $height) = getimagesize($f);
$src = imagecreatefromstring(file_get_contents($f));
$dst = imagescale($src, $size);
imagejpeg($dst, $req);
?>
