<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

// Headder template and functions
require_once "./lib/headder.php";

//  Get News Feed
$newsfeedlen=4;
$dir="/usr/share/nginx/www/lib/newsfeed/";

$newsfeed = getnewsfeed($newsfeedlen);

// CONTENT
echo("<div id='content'>");


	// Newsfeed
	echo("<div id=\"newsfeed\">");

                for($i=0;$i<$newsfeedlen;$i++)
                {
                    if($newsfeed[$i])
		    {
			echo("<div class='post'>");
                        echo("<div class='headder'>");
                        echo("<h4 class='title'>{$newsfeed[$i]["header"]}</h4>");
                        echo("<h4 class='date'>{$newsfeed[$i]["date"]}</h4>");
                        echo("</div>");
                        echo("<p class='content'>{$newsfeed[$i]["content"]}");
                        echo("<br><br>=> {$newsfeed[$i]["username"]}");

			if($_SESSION["admin"]) echo("<div class='right'> Delete <a></div> ");

			echo("</p></div>");
                   }
		}
	echo "</div>";


// Side info pannel
?>

	<div id="sidepanel">
        	<div class="post">

                	<div class="headder">
                		<h4 class="title"> Quick Info </h4>
                	</div>

			<p class="content"> Minecraft Server address:
	                <br> www.cydonia.co
        	        <br>
               		<br> Data to be updated
               		<br>
                	<br>
                	<br>                	
			<br>
               	 	<br>
                	<br>
	               	<br>
                	</p>
           	</div>

		<div class="post"> <!-- Who's Online -->
                        <div class="headder">
                	        <h4 class="title"> Who's online? </h4>
                        </div>

                        <ul class="content">

<?php                   if(count($stats["players"]))
                        {
                       		$i=0;
                                for($i=0;$i<count($stats["players"]);$i++)
                          	{
                                	echo("<li>");
                                       	echo("<img class='face' src='/images/players/faces/{$stats["players"][$i]}.png'></img>");
                                        echo("<p class='player'>");
                                        echo($stats["players"][$i]);
                                        echo("</p>");
                                        echo("</li>");
                                }
                         }
                         elseif (!$stats) echo("<tr><td>Server offline</td><td></td></tr>");
                         else echo("<tr><td> No players online </td><td></td><tr>");

		echo("</ul></div>"); // End of Who's Online

	if(isset($_SESSION["username"])) //If Admin display edit panel.
	{
		if($_SESSION["admin"])
		{
			echo(" <div class='post' > ");
				echo(" <div class='headder'><h4 class='title'> Editing </h4></div>");
				echo("<form class='content'> Edit Mode: <input type='radio' name='editmode' value='on'> ON ");

				echo("<input type='radio' name='editmode' value='off'> OFF </form>");

			echo(" </div> ");
		}
	}

	echo("<div>");
	// END of Side Pannel
echo("</div>");
// END OF CONTENT

// Footer contents and closing.
require_once "./settings/footer.php";

?>
