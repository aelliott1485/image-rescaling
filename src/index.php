<?php
//echo 'Hello world from my own Mac OS X server';
$req = urldecode(basename($_SERVER['REQUEST_URI']));
preg_match('#^(?P<name>[^!]+)!(?P<size>\d+)\.(?P<ext>png|jpg|gif)#i', $req, $matches);
if (!$matches) {
    die();
}
$size = intval($matches['size']);
if (($size > 2000) || ($size % 50 != 0))
    die();
$f = $matches['name'] . '.' . $matches['ext'];
list($width, $height) = getimagesize($f);
$src = imagecreatefromstring(file_get_contents($f));
$dst = imagescale($src, $size);
imagejpeg($dst, $req);
?>
