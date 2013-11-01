<?php // PHP Functions Headder File

/*  To be included by every webpage using dynamic contents.
 *  Links other function files.
 *  Includes MySQL login details.
 */

require_once("./lib/auth.php");
require_once("./lib/phpfunc.php");

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

    <div id="container">
	<div id="banner" style="text-align:center;">
		<div id = "bannerimage" style="width:100%;">
                        <a href="/" ><img src="/images/matt-text.png" alt="title" height="75" width="1280"></a>
                </div>
	</div>

	<div id="navMenu">
		<ul>
			<li> <a>Vote for me!</a> </li>
			<li> <a>Vote for me!</a> </li>
			<li> <a>Vote for me!</a> </li>
			<li> <a>Vote for me!</a> </li>
			<li> <a>Vote for me!</a> </li>
		</ul>
	</div>
	<div id="content">
	<img style="float:left; margin-top:40px; padding:5px; border:solid 1px; background-color:rgba(245,245,245,0.6);"src="/images/sirboldilox.png" alt="sirboldilox" height="292" width="192"/>

	<div class="post" style="float:left; width:50%; margin:60px;">
		<div class="headder"><h4 class="title"> Why me? <h2></div>
		<p class="content"> + I'm a Returner <br><br> + I'm trustworthy
  		<br><br> + I can be organised <br><br> + I can get around an excel spreadsheet <br><br> + Wing the rest.   </p>
	</div>
	</div>

_END;

echo "</div></div>";

// Footer contents and closing.
require_once "./settings/footer.php";


?>
