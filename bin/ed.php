<?php
// bin/ed.php
// 202012201900

// Text previous terminal.
$text_terminal = $text_all . "\n$ " . $cmd_all;

$content_terminal = $text_all;
$content_command = $cmd_all;

// Date and time now.
date_default_timezone_set($def_user_timezone);
$date_current = date("YmdHi");

// Funcao para esconder comentarios e comandos internos do ed.
function f_hide($arg_a, $arg_b) {
    return preg_replace("#(\.ed\..*?\[\[).*?(\]\])#", "", $GLOBALS['content_terminal']);
}

// Funcao para visualizacao do arquivo texto.
function f_view($file_a, $file_b) {
    $file_v = $GLOBALS['dir_user'] . $file_a;

    $file_open = fopen($file_v, "r") or die("Unable to open file!");
    $text_view = fread($file_open,filesize($file_v));
    fclose($file_open);

    return ".ed.info.comment[[Open <" . $file_a . "> to view! (" . $GLOBALS['date_current'] . ")]]\n" . $text_view;
}

// Funcao que executa os comandos internos.
function f_run_internal($arg_a, $arg_b) {
    $msg_sucess = ".ed.info.comment[[Run internal commands! (" . $GLOBALS['date_current'] . ")]]\n";
    if (preg_match("#\.ed\.run\.internal\[\[save\]\]#", $GLOBALS['content_terminal'])) {
        preg_match("#(\.ed\.file\.path\[\[).*?(\]\])#", $GLOBALS['content_terminal'], $find_path_name);
        $path_name_temp = explode('[[', $find_path_name[0]);
        $path_name_finish = explode(']]', $path_name_temp[1]);
        return $msg_sucess . f_write($path_name_finish[0], 0);
    }
}

// Funcao para escrever um arquivo.
function f_write($file_a, $file_b) {
    $file_w = $GLOBALS['dir_user'] . $file_a;

    $file_open = fopen($file_w, "w") or die("Unable to open file!");
    fwrite($file_open, $GLOBALS['content_terminal']);
    fclose($file_open);

    return ".ed.info.comment[[File <" . $file_a . "> wrote! (" . $GLOBALS['date_current'] . ")]]\n" . $GLOBALS['content_terminal'];
}


$args = explode(" ", $cmd[1]);  //Captura argumentos.
//if (count($args) == 3) {  //checa se existem 03 argumentos.

    switch ($args[0]) {
        case "h":  //hide comments of the ed.
            $result = f_hide($args[1], $args[2]);
            break;

        case "r":  //run commands in file.
            $result = f_run_internal($args[1], $args[2]);
            break;
        
        case "v":  //view file.
            $result = f_view($args[1], $args[2]);
            break;

        case "w":  //write file.
            $result = f_write($args[1], $args[2]);
            break;
        
        default:
            $result = "Option not found!";
    }

//}
//else {
//    $result = "Falta argumento";
//}

return $result;

?>
