<?php
// bin/screen.php
// 202012311835


/* --------------------------- FUNCTIONS --------------------------- */

// Function to list screens wrotes.
function f_list() {
    $arg = $GLOBALS['dir_tmp'] . "screen/*";  //path to list.
    $fileList = glob($arg);                   //get a list of file paths with glob().
    $text = "\n";                             //variable to list results.

    foreach($fileList as $filename){             //loop through the array that glob returned.
    $text = $text . basename($filename) . "\n";  //simply print them out onto the screen.
    }

    return $GLOBALS['content_terminal'] . "\n$ " . $GLOBALS['content_command'] . "\n" . $text; 
}

// Function to read screen saved.
function f_read($file_a, $file_b) {
    $file_v = $GLOBALS['dir_tmp'] . "screen/" . $file_a;

    $file_open = fopen($file_v, "r") or die("Unable to open file!");
    $text_view = fread($file_open,filesize($file_v));
    fclose($file_open);

    return $text_view;
}

// Function to write screen current.
function f_write($file_a, $file_b) {
    $file_w = $GLOBALS['dir_tmp'] . "screen/" . $file_a;

    $file_open = fopen($file_w, "w") or die("Unable to open file!");
    fwrite($file_open, $GLOBALS['content_terminal']);
    fclose($file_open);

    return $GLOBALS['content_terminal'];
}


/* --------------------------- MENU --------------------------- */

// Options and arguments.
$args = explode(" ", $cmd[1]);  //get arguments.
switch ($args[0]) {

    case "l":  //list screen saved.
        $result = f_list();
        break;

    case "g":  //go to screen number.
        $result = f_read($args[1], $args[2]);
        break;

    case "w":  //wrote screen number.
        $result = f_write($args[1], $args[2]);
        break;
    
    default:
        $result = "Option not found!";
}

return $result;

?>
