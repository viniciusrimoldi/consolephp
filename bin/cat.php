<?php
// bin/cat.php
// 202012181523

$file_r = $dir_user . $cmd[1];

$file_open = fopen($file_r, "r") or die("Unable to open file!");
$text = fread($file_open,filesize($file_r));
fclose($file_open);

return $content_terminal . "\n$ " . $content_command . "\n" . $text;

?>
