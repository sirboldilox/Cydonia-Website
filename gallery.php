<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

// Headder template and functions
require_once "./lib/headder.php";

// CONTENT
echo("<div id='content'>");


	for($i=1;$i<10;$i++)
	{
        	$image = "{$i}.png";
                echo("<a href='/images/backgrounds/{$image}'><img style='border:6px solid black; margin:10px;' src='/images/thumbnails/{$image}' height='240' width='427' ></a>");
        }


echo("</div>");
// END OF CONTENT

// Footer contents and closing.
require_once "./settings/footer.php";

?>
