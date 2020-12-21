<?php
// bin/date.php
// 202012191353

date_default_timezone_set($def_user_timezone);  //timezone user.
$x = date("d/m/Y  H:i:s");                      //generate date current.

return $content_terminal . "\n$ " . $content_command . "\nToday is " . $x;

?>
