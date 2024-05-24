<?php
    include("./class/clsXuLyFile.php");
    $xuLyFile = new clsXuLyFile();

    $urlfile = $_REQUEST['urlfile'];
    $part = explode('/', $urlfile);
    $filename = end($part);
    $xuLyFile->downloadFile($urlfile, $filename);
    $xuLyFile->changeLocation("index.php");
?>