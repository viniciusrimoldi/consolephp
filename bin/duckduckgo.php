<?php
// bin/duckduckgo.php
// 202012191852

$term = $cmd[1];
$url = 'https://lite.duckduckgo.com/lite/?q=' . str_replace(" ", "+", $term);

$source = file_get_contents($url);

$xa = str_replace("\n","",$source);

$find = array(
    "#(<head.*?>).*?(</head>)#",
    "#(<form.*?>).*?(</form>)#",
    "#(<td valign=\"top\">).*?(</td>)#",
    "(</a>)",
    );
$replace = array (
    "",
    "",
    "\n\n----------------------------------------------------------------\n",
    "</a>[link]",
    );

$xb = preg_replace($find, $replace, $xa);

$result = strip_tags($xb);


/*
$result = strip_tags($xb);  //apaga tags html e mantem texto entre elas.
$xb = preg_replace('#(<head.*?>).*?(</head>)#', "", $xa); //troca conteudo entre <head> </head> por nada.
$result = strip_tags($xa,<p>);  //allow <p>
*/

return $result;

?>
