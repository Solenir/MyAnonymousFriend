<?php

include('database_connection.php');

session_start();

$query = "SELECT * FROM desabafo LEFT JOIN login ON desabafo.user_id = login.user_id ORDER BY desabafo_id DESC LIMIT 10";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
	$desabafos = "";
	
	foreach($result as $row)
	{
		$desabafos = $desabafos . "<div class=\"desabafo\"><div style=\"display: block;\"><span style=\"color: #000!important; margin: 0; padding: 0; font-weight: bold;\">".$row['username']."</span> <span style=\"font-size: 11.9px; font-style: italic; float: right; color: #000!important; margin: 0; padding: 0;\">".$row['timestamp']."</span></div>". $row['desabafo_texto']."</div>";
	}

	echo $desabafos;
?>
