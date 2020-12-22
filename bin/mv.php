<?php
// bin/mv.php
// 202012221755

$args = explode(" ", $cmd[1]);  //explode commands.        
$path_orig = $dir_user . $args[0];
$path_dest = $dir_user . $args[1];

if (rename($path_orig, $path_dest)) {
    $result = "Successfully moved!";
}
else
{
    $result = "Error: not moved!";
}

return $content_terminal . "\n$ " . $content_command . "\n" . $result;

?>
