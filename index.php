<?php
// Project:  consolephp.
// File:     index.php
// Created:  202012151914

// File configs user.
include "users/user01/configs/inputrc.php";


// Command and terminal text in variables.
$content_terminal =  $_POST['d_terminal'];  //captura todas as linhas do terminal.
$content_command =  $_POST['i_cmd'];  //captura texto da  linha de comando.
$cmd = explode(" ", $content_command, 2);  //$cmd[0] = comando; $cmd[1] = argumentos.


// Search cmd in /bin directory.
$bin_check = 0;  //control binnary exist.
$glob_bin = $dir_bin . "*";
$list_bin = glob($glob_bin);

foreach($list_bin as $name_bin){
    $search_bin = $dir_bin . $cmd[0] . ".php";  //path full name search cmd searched.
    if ($search_bin == $name_bin) {             //search cmd in directory bin.
        $p_terminal = include $name_bin;        //run bin and print result in the terminal.
        $bin_check = 1;
    }
}


// Print error msg if not found bin.
if ($bin_check == "0") {
    $p_terminal = $content_terminal . "\n$ " . $content_command . ": command not found!";
}


// Construct list commands executables to <datalist>.
$glob_bin = $dir_bin . "*";
$list_bin = glob($glob_bin);

$find = array($dir_bin,".php");
$replace = array("","");

foreach($list_bin as $name_bin){
    $divlist = $divlist . "<option value=\"" . str_replace($find, $replace, $name_bin) . "\">";
}

?>

<html>
    <head>
        <title>Console PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <link rel="stylesheet" href="
        <?php echo $theme_terminal; ?> ">
    <body>
        <form method="post" action="" id="test"> 
            <textarea id="terminal" name="d_terminal"  ><?php echo $p_terminal; ?></textarea>
            <br>
            <input id="commandline" type="text" name="i_cmd" value="" list="commands" autofocus/>
        </form>
        <datalist id="commands">
            <?php echo $divlist; ?>
        </datalist>
    </body>
</html>
