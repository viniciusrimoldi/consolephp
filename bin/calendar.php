<?php
// bin/calendar.php
// 202012191400

// Variables today.
$day = date("d");
$month = date("m");
$year = date("Y");


// Capture the day week of the 1st.
$first_day = mktime(00, 00, 00, $month, 01, $year);
$first_name_day = date("l", $first_day);


// Construct print month.
if ($first_name_day == "Sunday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n 01 02 03 04 05 06 07";
    $wc = "\n 08 09 10 11 12 13 14";
    $wd = "\n 15 16 17 18 19 20 21";
    $we = "\n 22 23 24 25 26 27 28";
    $wf = "\n 29 30 31";
}
elseif ($first_name_day == "Monday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n    01 02 03 04 05 06";
    $wc = "\n 07 08 09 10 11 12 13";
    $wd = "\n 14 15 16 17 18 19 20";
    $we = "\n 21 22 23 24 25 26 27";
    $wf = "\n 28 29 30 31";
}
elseif ($first_name_day == "Tuesday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n       01 02 03 04 05";
    $wc = "\n 06 07 08 09 10 11 12";
    $wd = "\n 13 14 15 16 17 18 19";
    $we = "\n 20 21 22 23 24 25 26";
    $wf = "\n 27 28 29 30 31";
}
elseif ($first_name_day == "Wednesday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n          01 02 03 04";
    $wc = "\n 05 06 07 08 09 10 11";
    $wd = "\n 12 13 14 15 16 17 18";
    $we = "\n 19 20 21 22 23 24 25";
    $wf = "\n 26 27 28 29 30 31";
}
elseif ($first_name_day == "Thursday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n             01 02 03";
    $wc = "\n 04 05 06 07 08 09 10";
    $wd = "\n 11 12 13 14 15 16 17";
    $we = "\n 18 19 20 21 22 23 24";
    $wf = "\n 25 26 27 28 29 30 31";
}
elseif ($first_name_day == "Friday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n                01 02";
    $wc = "\n 03 04 05 06 07 08 09";
    $wd = "\n 10 11 12 13 14 15 16";
    $we = "\n 17 18 19 20 21 22 23";
    $wf = "\n 24 25 26 27 28 29 30";
    $wg = "\n 31";
}
elseif ($first_name_day == "Saturday") {
    $wa = "\n Su Mo Tu We Th Fr Sa";
    $wb = "\n                   01";
    $wc = "\n 02 03 04 05 06 07 08";
    $wd = "\n 09 10 11 12 13 14 15";
    $we = "\n 16 17 18 19 20 21 22";
    $wf = "\n 23 24 25 26 27 28 29";
    $wg = "\n 30 31";
}

$print_days = $wa . $wb . $wc . $wd . $we . $wf . $wg;


// Ajust 30 and 31 days according to month.
if ($month == "02") {
    $find = array("29","30","31");
    $replace = array("  ","  ","  ");
    $print_days = str_replace($find, $replace, $print_days);
}
elseif ($month == "04") {
    $print_days = str_replace("31", "  ", $print_days);
}
elseif ($month == "06") {
    $print_days = str_replace("31", "  ", $print_days);
}
elseif ($month == "09") {
    $print_days = str_replace("31", "  ", $print_days);
}
elseif ($month == "11") {
    $print_days = str_replace("31", "  ", $print_days);
}


// Highlights today.
$find = $day;
$replace = $day . "*";
$print_days = str_replace($find, $replace, $print_days);


// Named month and year to header.
$name_month = array ("null","January","February","March","April","May","June","July","August","September","October","November","December");
$print_month = $name_month[$month];

return $content_terminal . "\n$" . $content_command . "\n    " . $print_month . " " . $year . $print_days . "\n";

?>
