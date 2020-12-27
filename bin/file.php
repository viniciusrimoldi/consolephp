<?php
// bin/file.php
// 202012221545

$args = explode(" ", $cmd[1]);  //explode commands.
switch ($args[0]) {
    case "help":  //help message.
        $result = "Usage: file [OPTION] [FILE]" .
                "\nOptions:" .
                "\n    download [FILE]" .
                "\n    status   [FILE]" .
                "\n";
        break;
        
    case "download":  //download file server to client.
        
        $file_path = $dir_user . $args[1];  //path to check file exists in server.

        if (file_exists($file_path)) {
            $file_name = basename($file_path);
            $file_type = filetype($file_path);
            $file_size = filesize($file_path);

            header("Content-Type: " . $file_type);
            header("Content-Length: " . $file_size);
            header("Content-Disposition: attachment; filename=" . $file_name);
            readfile($file_path);
            $result = "File downloaded successfully";
        }
        else {
            $result = "File downloading failed";
        }        

        break;
    
    case "status":  //Status file.

        $file_path = $dir_user . $args[1];  //path to file in server.
    
        if (file_exists($file_path)) {
            $result = "File: " . basename($file_path) .
                    "\nPath: " . $file_path .
                    "\nType: " . filetype($file_path) .
                    "\nSize: " . filesize($file_path) .
                    "\nAccess: " . date("Y-m-d  H:i:s", fileatime($file_path)) . 
                    "\nModify: " . date("Y-m-d  H:i:s", filemtime($file_path)) .
                    "\nChange: " . date("Y-m-d  H:i:s", filectime($file_path));
        }
        else {
            $result = "File not found!";
        }  
        
        break;
    
    default:
        $result = "Option not found!";
}

return $content_terminal . "\n$ " . $content_command . "\n" . $result;
?>
