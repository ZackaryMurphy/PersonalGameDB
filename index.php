<?php
	include('lib\zpgdb.php');
	
	$dbInterface = Zpgdb\InterfaceSingleton\ZpgdbInterfaceSingleton::getInstance();
	
	$name = $_GET['name'];
	$console = $_GET['cons'];
	$releaseYear = intval($_GET['release']);
	$owned = boolval($_GET['own']);
	$special = boolval($_GET['spec']);
	$wish = boolval($_GET['wish']);
	
	try
	{
		$host = $dbInterface->getServerName();
		$dbname = $dbInterface->getDatabaseName();
		$user = $dbInterface->getUsername();
		$pass = $dbInterface->getPassword();
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
		$results = array();
		foreach($conn->query('SELECT * from '.$dbInterface->getTableName()) as $row)
		{
			/*
			foreach($row as $value)
			{
				$resultString .= ($value . ' ');
			}*/
			$results[] = json_encode($row);
			//echo json_encode($row);
		}
		$conn = null;
		echo json_encode($results);
	}
	catch (PDOException $e)
	{
		//echo "Error: " . $e->getMessage() ."<br/>";
		die();
	}
?>