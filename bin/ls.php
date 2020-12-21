<?php
// bin/ls.php
// 202012171800

$arg = $dir_user . $cmd[1] . '/*';  //path to list.
$fileList = glob($arg);             //get a list of file paths with glob().
$text = "\n";                       //variable to list results.

foreach($fileList as $filename){                                //loop through the array that glob returned.
   $text = $text . str_replace($dir_user, "", $filename) . "  ";  //simply print them out onto the screen.
}

return $content_terminal . "\n$ " . $content_command . "\n" . $text;

?>
