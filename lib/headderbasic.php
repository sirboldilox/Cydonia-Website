<?php // PHP Functions Headder File

/*  To be included by every webpage using dynamic contents.
 *  Links other function files.
 *  Includes MySQL login details.
 */

require_once("auth.php");
require_once("phpfunc.php");

$nerf_stat_counter = 0;

/************************************************
 *		  Functions			*
 ************************************************/

///////////////////////////
// HTML Headder template //
///////////////////////////

/* Read Minecraft server status from "status.txt" and set image accordingly */
$fh = fopen("/opt/minecraft/FTB/UltimateServer/status.txt","r");
$MCstatus = fgets($fh);
fclose($fh);

if (strcmp($MCstatus,"TRUE\n")==0) { $MCicon = "/images/mcicon.png"; }
else { $MCicon = "/images/mcicongrey.png"; }

$stats = full_stat(localhost);

/* Get Random Background image */

$backimage = getBackground(9,"/images/backgrounds/");


echo <<<_END

<!DOCTYPE html>
<html>
<meta charset="UTF-8" />
<meta name="google" content="notranslate">
<meta http-equiv="Content-Language" content="en" />

<head>
 <link rel="stylesheet" type="text/css" href="/css/reset.css">
 <link rel="stylesheet" type="text/css" href="/css/style.css">
 <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
 <title>Cydonia MC</title>
</head>

<body style=background-image:url($backimage) no-repeat center scroll;>

_END;
?>
