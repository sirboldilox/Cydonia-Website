<?php

// SQL NEWSFEED FUNCTION
function getnewsfeed($feedlen,$dir)
{
	// Get data from mysql
        $QUERY = "SELECT headder,username,postdate,content FROM newsfeed ORDER BY postdate DESC LIMIT $feedlen ";

        $QueryReturn = mysql_query($QUERY);

	$i = 0;
	while(1)
	{
		$rows = mysql_fetch_row($QueryReturn);
		//var_dump($rows);

		if($rows)
		{  // Setup return array
			$newsfeed[$i]["header"]=$rows[0];
			$newsfeed[$i]["username"]=$rows[1];
        		$newsfeed[$i]["date"]=$rows[2];
        		$newsfeed[$i]["content"]=$rows[3];
			$i++;
		}
		else break;
	}
       	// var_dump($newsfeed);
        return $newsfeed;
}

?>
