<?php

/*  MySQL connection settings
 * 
 *  Starts a connection to the MySQL server and moves to the
 *  required database.
 */

$dbhost = "localhost";
$dbport = 0;
$dbuser = "webphp";
$dbpass = "logmeinplease";
$dbname = "cydoniaWebsite";

$mysqlcon = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

?>
