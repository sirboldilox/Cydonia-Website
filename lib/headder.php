<?php // PHP Main Headder File

/*  To be included by every webpage using dynamic contents.
 *  Links other library files.
 *  Includes HTML template for all pages.
 */

require_once "Auth/core.php";
require_once "Core/core.php";
require_once "Minecraft/core.php";
require_once "phpfunc.php";

require_once "config.php";

$nerf_stat_counter = 0;

///////////////////////////
// HTML Headder template //
///////////////////////////

/* Read Minecraft server status from "status.txt" and set image accordingly */
$fh = fopen($MC_Server_Root . "status.txt","r");
$MCstatus = fgets($fh);
fclose($fh);

if (strcmp($MCstatus,"TRUE\n")==0) 
	$MCicon = "/images/mcicon.png";
else 
	$MCicon = "/images/mcicongrey.png";

$stats = full_stat(localhost);
$backimage = getBackground(9,"/images/backgrounds/");

echo <<<_END

	<!DOCTYPE html>
	<html>
	<meta charset="UTF-8" />
	<meta name="google" content="notranslate">
	<meta http-equiv="Content-Language" content="en" />

	<head>
 		<link rel="stylesheet" type="text/css" href="/css/reset.css">
 		<link rel="stylesheet" type="text/css" href="/css/core.css">
 		<link rel="icon" href="/images/favicon.ico" type="image/x-icon">
		<title>Cydonia MC</title>
	</head>

	<body style=background-image:url($backimage) no-repeat center scroll;>

    <div id="container">
		<div id="banner">
			<div id = "bannerimage">
				<a href="/" ><img src="/images/cydoniamc.png" alt="Cydonia MC" height="75" width="418"></a>
         </div>

         <div class="headdericon">
            <a href="ts3server://cydonia.co/?PORT"><img src="/images/ts3icon.png" alt="ts3icon" height="64" width="64"/></a>
         </div>

         <div class="headdericon">
            <a href="http://www.facebook.com/CydoniaGaming"> <img src="/images/facebookicon.png" alt="facebookicon" height="64" width="64"/></a>
         </div>

         <div class="headdericon">
            <a href="http://www.blicko.com/cydonia-670"> <img src="/images/blickoicon.png" alt="blickoicon" height="64" width="64"/></a>
         </div>

         <div class="headdericon" >
            <img src=$MCicon alt="mcstatusicon" height="64" width="64" >
         </div>
		</div>

		<div id="navMenu">
			<ul>
				<li><a href="/index.php" > Home </a></li>
				<li><a href="/worldmap" > World Map </a></li>
				<li><a href="/gallery.php" > Gallery </a></li>
				<li><a href="/players.php" > Players </a></li>
				<li><a href="/help.php" > Help </a></li>

_END;

	/* Display Login Button or Username */
	if(isset($_SESSION["username"]))
	{
		echo("<li id='userbutton' class='right'><a href='#'>" .$_SESSION["displayname"]. "</a>");
			echo("<ul id='subNav'>");
				if($_SESSION["admin"])
				  echo("<li><a href='/admin/index.php'> Admin </a></li>");
				echo("<li><a href='/account.php'> User Settings </a></li>");
				echo("<li><a href='/logout.php'> Logout </a></li>");
			echo("</ul>");
		echo("</li></ul>");
	}
	else
	{
		echo("<li class='right'><a href='/login.php'> Login </a></li> </ul>");
	}

	echo "</div></div>";

?>
