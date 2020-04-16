<?php

// $servername = "localhost:3306";
// $username = "iamgroot";
// $password = "root";
// $dbname = "full30_masks";

$servername = "104.225.1.56";
$username = "full30_masks";
$password = "rC6W3rQ98J";
$dbname = "full30_masks";

// Try and connect using the info above.
$con = mysqli_connect($servername, $username, $password, $dbname);

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>
