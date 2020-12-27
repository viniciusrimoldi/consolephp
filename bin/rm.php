<?php
// bin/rm.php
// 202012241740

date_default_timezone_set($def_user_timezone);
$date_current = date("YmdHi");

$file_name = basename($cmd[1]);
$path_orig = $dir_user . $cmd[1];
$path_trash = $GLOBALS['dir_trash'] . $date_current . "." . $file_name;

if (rename($path_orig, $path_trash)) {
    $result = "Removed!";
}
else
{
    $result = "ERROR: not removed!";
}

return $content_terminal . "\n$ " . $content_command . "\n" . $result;
?>
