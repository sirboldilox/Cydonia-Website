<?php // Core functions and classes used across all pages

/*
 * 	Background Image Randomiser 
 * 
 * 	Arguments[2]:
 * 		[1]: $range, maximum image number
 * 		[2]: $dir,	 directory containing backgrounds
 * 
 * 	Returns:
 * 		path to background image
 */
function getBackground($range,$dir)
{
	$n = rand(1,$range);
	return $dir.$n.".png";
}

/*
 * 	Player List reader
 * 
 *  Arguments:[1]
 * 		[1]: $filename, full path to the playerlist.txt file
 * 
 *  Returns:
 * 		$lines, array of playernames (strings) on sucess
 * 		FALSE,	on failure
 */
function getplayerlist($filename)
{
	// Check config exists 
    if(!file_exists($filename)) return 0;

	$lines = file($filename, FILE_IGNORE_NEW_LINES);
	return $lines;
}

/*
 * 	Face Generator
 *  
 *  Takes player skin and generates a .png image of the face.
 *  images are cached in folder "images/faces"; 
 * 
 * 	Arguments[3]:
 * 		[1]: $playername, players minecraft username
 * 		[2]: $width, width of the generated image
 * 		[3]: $height, height of the generated image
 * 
 *  Returns:
 * 		$cacheFace, file path to players face image
 */
function faceGen($playername, $width, $height)
{
	$cacheFace = "images/faces/{$playername}.png";

	if (!file_exists($cache_file) || time() - filemtime($cache_file) > 86400)
	{
		$skin = imagecreatefromstring(file_get_contents("http://skins.minecraft.net/MinecraftSkins/{$player_name}.png"));

	        $face = imagecreatetruecolor($width, $height);

	        imagecopyresized($face, $skin, 0, 0, 8, 8, $width, $height, 8, 8);
        	imagecopyresized($face, $skin, 0, 0, 40, 8, $width, $height, 8, 8);

	        imagepng($face, $cache_file);
	}
	return $cacheFace;
}

?>
