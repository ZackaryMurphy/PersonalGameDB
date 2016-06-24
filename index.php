<?php
	include('lib\zpgdb.php');
	
	$dbInterface = Zpgdb\InterfaceSingleton\ZpgdbInterfaceSingleton::getInstance();
	
	$name = $_GET['name'];
	$console = $_GET['cons'];
	$releaseYear = intval($_GET['release']);
	$owned = $_GET['own'];
	$special = $_GET['spec'];
	$wish = $_GET['wish'];
	
	try
	{
		$host = $dbInterface->getServerName();
		$dbname = $dbInterface->getDatabaseName();
		$user = $dbInterface->getUsername();
		$pass = $dbInterface->getPassword();
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
		$results = array();
		foreach($conn->query($dbInterface->composeQuery($name, $console, $releaseYear, $owned, $special, $wish)) as $row)
		{
			$results[] = json_encode($row);
		}
		$conn = null;
		echo json_encode($results);
	}
	catch (PDOException $e)
	{
		die();
	}
?>