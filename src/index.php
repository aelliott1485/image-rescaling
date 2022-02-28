<?php
$req = urldecode(basename($_SERVER['REQUEST_URI']));
preg_match('#^(\w+)!(\d+)\.(png|jpg|gif)#i', $req, $matches);
if (!$matches) {
    die();
}
[, $name, $size, $ext] = $matches;
$size = intval($size);
if (($size > 2000) || ($size % 50 != 0))
    die();
$src = imagecreatefromstring(file_get_contents($name . '.' . $ext));
$dst = imagescale($src, $size);
$function = 'image' . ($ext == 'jpg' ? 'jpeg' : strtolower($ext));
header('Content-Type: image/' . strtolower($ext));
$function($dst, $req);
$function($dst);    //send the image to the browser
