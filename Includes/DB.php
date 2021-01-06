<?php
$DSN='mysql:host = localhost; dbname=kfartebenit';/*!<This variable defines the servername and database name we want to connect to*/
$ConnectingDB = new PDO($DSN,'root','');/*!< This variable establishes the connection to the database using PDO php built in function which we passed the $DSN variable and the password to */
?>
