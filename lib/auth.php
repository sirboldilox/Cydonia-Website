<?php //Authenitcation function

// Start Session for login and dynamic services

session_start();

// MySQL

$dbhost = "localhost";
$dbport = 0;
$dbuser = "webphp";
$dbpass = "logmeinplease";
$dbname = "cydoniaWebsite";

$mysqlcon = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

// Functions

function stringsanatize($instring)
{
        $instring = strip_tags($instring);
        $instring = htmlentities($instring);
        $instring = stripslashes($instring);
        $instring = mysql_real_escape_string($instring);

        return $instring;
}

function redirect()
{
        header("location:/index.php");
}


function isAdmin($username)
{
	// Get data from mysql
	$QUERY = "SELECT username,admin FROM users WHERE username='$username' ";

	$QueryReturn = mysql_query($QUERY);
	$rows = mysql_fetch_row($QueryReturn);

	if ( $rows && $rows[0] == $username && $rows[1] )
		return true;
	else
		return false;
}

function getDisplayname($username)
{
	 // Get data from mysql
        $QUERY = "SELECT username,displayname FROM users WHERE username='$username' ";

        $QueryReturn = mysql_query($QUERY);
        $rows = mysql_fetch_row($QueryReturn);

	// Check Row was returned, if so return displayname
	if ( $rows && $rows[1] )
		return $rows[1];
	else
		return "ERROR";
}

function authenticate($username,$password)
{
        // Sanatise user input for database
        $username = (stringsanatize($username));
        $password = stringsanatize($password);

        // Encrypt Password
        $password = sha1(md5($password));

        // Get data from mysql
        $QUERY = "SELECT username, password FROM users WHERE username='$username' ";

        $QueryReturn = mysql_query($QUERY);
        $rows = mysql_fetch_row($QueryReturn);

        if ($rows && $rows[0] == $username && $rows[1] == $password)
          return 1;

        else
          return 0;

}

function updatePass($username,$newpassword,$debug=0)
{
	// Encrypt Password
        $password = sha1(md5($newpassword));

        // Get data from mysql
        $QUERY = "UPDATE users SET password='$password' WHERE username='$username';";

	//echo($QUERY);
        $QueryReturn = mysql_query($QUERY);
        if($debug) var_dump($QueryReturn);

	//$rows = mysql_fetch_row($QueryReturn);

	return 1;
}

?>
