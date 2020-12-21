<?php
// bin/grep.php
// 202012200830

$pattern = "/" . $cmd[1] . "/i";
$path = $dir_user . "docs/f";
$result = preg_grep($pattern, file($path));

//print_r(file($path));

return $content_terminal . "\n$ " . $content_command . "\n" . implode($result);

?>
