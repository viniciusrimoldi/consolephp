<?php
// bin/little.php
// (application manager)
// 202012231505

// Variables: Repository applications.
$url_html = "https://github.com/viniciusrimoldi/consolephp/tree/main/bin";
$url_raw = "https://raw.githubusercontent.com/viniciusrimoldi/consolephp/main/bin/";


$args = explode(" ", $cmd[1]);  //capture args.
switch ($args[0]) {
    case "search":  //search new binnary in repository.
        $pattern = "/viniciusrimoldi/consolephp/blob/main/bin/" . $args[1];
        if (strpos(file_get_contents($url_html), $pattern)) {
            $result = $content_terminal . "\n$ " . $content_command . "\nResult:\n  > " . $args[1] . ".php\n\n(Use $ little install \"name_bin.php\" to install)";
        }
        else {
            $result = $content_terminal . "\n$ " . $content_command . "\nResult:\n  > " . $args[1] . " not found!";
        }
        break;



    case "install":  //install binnary to user.
        $url = $url_raw . $args[1];
        $path_bin = $GLOBALS['dir_bin'] . $args[1];

        
        if (file_put_contents($path_bin, file_get_contents($url))) {
            $result = $content_terminal . "\n$ " . $content_command . "\nBinary <" . $args[1] . "> installed!";
        }
        else {
            $result = $content_terminal . "\n$ " . $content_command . "\nERROR: Binary <" . $args[1] . "> not installed!";
        }

        break;


    default:
        $result = "Option not found!";
}

return $result;
?>
