<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

// Headder template and functions
require_once "./lib/headder.php";

// Get Player List
$players = getplayerlist("/opt/minecraft/FTB/UltimateServer/player-list.txt");

// CONTENT
echo("<div id='content'>");

?>

            <div id="ranking">

                        <table border="1">
                        <tr>
                        <th> Player Name </th>
                        <th> Status      </th>
                        </tr>

<?php   // Build Player List table sorted by Online/Offline then by order in the playerlist

                             	if($players)
                                { $i=0; $offline=array();  $n=0;

                                        for($i=0;$i<count($players);$i++)
                                        { $online=0; $j=0;
                                                for($j=0;$j<count($stats["players"]);$j++)
                                                {
                                                        if(strcmp($stats["players"][$j],$players[$i])==0)
                                                        {
                                                                $online = 1;
                                                        }
                                                }

                                                if($online)
                                                {
                                                        echo("<tr>");
                                                        echo("<td>");
                                                        echo("<img class='face' src='./images/players/faces/{$players[$i]}.png'></img>");
                                                        echo("<p class='player'>");
                                                        echo($players[$i]);
                                                        echo("</p></td>");
                                                        echo("<td class='green-text'> Online </td>");
                                                }
                                                else
                                                {
                                                        $offline[$n]=$players[$i];
                                                        $n++;
                                                }
                                        }
                                        for($i=0;$i<count($offline);$i++)
                                        {
                                                echo("<tr>");
                                                echo("<td>");
                                                echo("<img class='face' src='./images/players/faces/{$offline[$i]}.png'></img>");
                                                echo("<p class='player'>");
                                                echo($offline[$i]);
                                                echo("</p></td>");
                                                echo("<td class='red-text'> Offline </td>");

                                        }
				}
				else echo("<tr><td> No Data in Whitelist </td><td></td></tr>");



echo("</table></div></div>");
// END OF CONTENT

// Footer contents and closing.
require_once "./settings/footer.php";

?>
