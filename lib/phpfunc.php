<?php

/* OLD NEWS FEED FUNCTION
function getnewsfeed($feedlen,$dir)
{
	// Check config exists 
	if(!file_exists($dir)) return 0;
	if(!file_exists("{$dir}config.txt")) return 0;

	// read config for feed count
	$file=fopen("{$dir}config.txt","r");
	$count=trim(fgets($file));
	fclose($file);

	$newsfeed=array();

	// retrive feed data 
	for($i=0;$i<$feedlen;$i++)
	{
		if(!file_exists($dir.$count.".txt"))
		{
			$newsfeed[$i]["header"]="Unavalible";
			$newsfeed[$i]["content"]="No content avalible";
		}
		else
		{
			$file=fopen($dir.$count.".txt","r");
			$text=fread($file,8196);
			$split1=array();
			$split2=array();

			$split1=explode("#h#",$text);
			$split2=explode("#d#",$split1[1]);

			$newsfeed[$i]["header"]=$split1[0];
			$newsfeed[$i]["date"]=$split2[0];
			$newsfeed[$i]["content"]=$split2[1];
			fclose($file);
		}

		if($count[3]=='0')
		{
			$count[3]='9';
			if($count[2]=='0')
			{
				$count[2]='9';
				if($count[1]=='0') $count[1]=9;
				else $count[1]=$count[1]-1;

			}
			else $count[2]=$count[2]-1;
		}
		else $count[3]=$count[3]-1;

	}
	//var_dump($newsfeed);
	return $newsfeed;

}
*/

// SQL NEWS FEED FUNCTION
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


/*Background Image Randomiser */
function getBackground($range,$dir)
{
	$n = rand(1,$range);
//	if(file_exists($dir.$n.".png"))
		return $dir.$n.".png";
//	else
//		return "No Image";
}


/* Minecraft Server Full Stat Query */
function full_stat($host, $port = 25565, $timeout = 1)
{
        //Set up our socket
        $fp = fsockopen("udp://" . $host, $port, $errno, $errstr, $timeout);

        if(!$fp)
                return false;

        // Get the challenge token; send 0xFE 0xFD 0x09 and a 4-byte session id
        $str1 = "\xFE\xFD\x09\x01\x02\x03\x04"; // Arbitrary session id at the end (4 bytes)
        fwrite($fp, $str1);
        $resp1 = fread($fp, 256);

        if($resp1[0] != "\x09") // Check for a valid response
                return false;

        // Parse the challenge token from string to integer
        $token = 0;
        for($i = 5; $i < (strlen($resp1) - 1); $i++)
        {
                $token *= 10;
                $token += $resp1[$i];
        }

        // Divide the int32 into 4 bytes
        $token_arr = array(     0 => ($token / (256*256*256)) % 256,
                                1 => ($token / (256*256)) % 256,
                                2 => ($token / 256) % 256,
                                3 => ($token % 256)
                        );
       // Get the full version of server status. ID and challenge tokens appended to command 0x00, payload padded to 8 bytes.
        $str = "\xFE\xFD\x00\x01\x02\x03\x04"
                . chr($token_arr[0]) . chr($token_arr[1]) . chr($token_arr[2]) . chr($token_arr[3])
                . "\x00\x00\x00\x00";
        fwrite($fp, $str);
        $data2 = fread($fp, 4096);
        $full_stat = substr($data2, 11);        // Strip the crap from the start

        $tmp = explode("\x00\x01player_\x00\x00", $full_stat);  // First, split the payload in two parts
        $t = explode("\x00", $tmp[0]);          // Divide the first part from every NULL-terminated string end into key1 val1 key2 val2...
        unset($t[count($t) - 1]);               // Unset the last entry, because the are two 0x00 bytes at the end
        $t2 = explode("\x00", $tmp[1]);         // Explode the player information from the second part

        $info = array();
        for($i = 0; $i < count($t); $i += 2)
        {
                if($t[$i] == "")
                        break;

                $info[$t[$i]] = $t[$i + 1];
        }

        $players = array();
        foreach($t2 as $one)
        {
                if($one == "")
                        break;

                $players[] = $one;
        }

        $full_stat = $info;
        $full_stat['players'] = $players;

        return $full_stat;
}

// Face Generator

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

// Player List
function getplayerlist($filename)
{
        /* Check config exists */
        if(!file_exists($filename)) return 0;

	$lines = file($filename, FILE_IGNORE_NEW_LINES);
 //      	var_dump($lines);
        return $lines;
}

?>
