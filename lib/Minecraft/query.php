<?php
/*
 *	Minecraft Server query functions
 *
 */
 
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

?>
