<?php
// bin/ed.php
// 202012201900

// Global variables.
date_default_timezone_set($def_user_timezone);
$date_current = date("YmdHi");
$path_logs = $GLOBALS['dir_tmp'] . "ed.logs";


// Funcao para esconder comentarios e comandos internos do ed.
function f_hide($arg_a, $arg_b) {
    return preg_replace("#(\.ed\..*?\[\[).*?(\]\])#", "", $GLOBALS['content_terminal']);
}

// Funcao para gerar e salvar logs.
function f_logs($log) {
    $file_l = $GLOBALS['path_logs'];
    $file_open = fopen($file_l, "a") or die("Unable to open file!");
    fwrite($file_open, $log);
    fclose($file_open);
}

// Funcao para visualizacao do arquivo texto.
function f_view($file_a, $file_b) {
    $file_v = $GLOBALS['dir_user'] . $file_a;

    $file_open = fopen($file_v, "r") or die("Unable to open file!");
    $text_view = fread($file_open,filesize($file_v));
    fclose($file_open);
    
    $msg_log = ".ed.info.comment[[Open <" . $file_a . "> to view! (" . $GLOBALS['date_current'] . ")]]\n";
    f_logs($msg_log);

    return  $text_view;
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
    
    $msg_log = ".ed.info.comment[[Wrote file <" . $file_a . "> ! (" . $GLOBALS['date_current'] . ")]]\n";
    f_logs($msg_log);
}


// Menu de opcoes de argumentos e seu direcionamento
$args = explode(" ", $cmd[1]);  //captura argumentos.
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

return $result;

?>
