<?php
$download_path=$_POST["project_file_path"];
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$download_path");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
readfile($download_path);
?>
