<?php
// calculator.php
// 202012191519

$result = eval("return " . $cmd[1] . ";");  //run calc.

return "\n> " . $content_terminal . "\n$ " . $content_command . "\n " . $result;

?>
