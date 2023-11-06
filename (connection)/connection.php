<?php
$databaseHost = '127.0.0.1:3306';
$databaseName = 'MD18101';
$databaseUsername = 'root';
$databasePassword = 'tomheo0823304995aA@';

try {
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", 
						$databaseUsername, $databasePassword);
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}