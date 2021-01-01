<?php
// bin/translate.php
// 202012270710

/*
  This code use external API google: https://github.com/vitalets/google-translate-api
*/

$args = explode(" ", $cmd[1], 3);  //explode commands.
$source_lang = $args[0];
$transl_lang = $args[1];
$text_source = str_replace(" ", "+", $args[2]);

$url_base = "https://translate.googleapis.com/translate_a/single?client=gtx";
$url_transl = $url_base . "&sl=" . $source_lang . "&tl=" . $transl_lang ."&dt=t" . "&q=" . $text_source;  //build url with langs and text to translate.

$content_url = file_get_contents($url_transl);  //capture source page translate with data.

$json_content = json_decode($content_url);      //convert json to array.
$json_from = iconv("UTF-8", "ISO-8859-1", $json_content[0][0][1]);            //text original.
$json_to = $json_content[0][0][0];              //text tranlated.

$result = "  ORIGIN: " . $json_from . "\n  TRANSL: " . $json_to . "\n";

return $content_terminal . "\n$ " . $content_command . "\n" . $result;
?>
