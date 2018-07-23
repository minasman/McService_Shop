<?php
	$dsn = 'mysql:host=localhost;dbname=StaggStoreData';
	$username = 'dhmcd0401';
	$password = 'mcd12345';
	
	try {
		$db = new PDO($dsn, $username, $password);
		}	catch (PDOException $e)	{
			#error_message = $e->getMessage();
			include('database_error.php');
			exit();
		}

?>

