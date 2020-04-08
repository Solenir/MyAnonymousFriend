<?php

include('database_connection.php');
session_start();

$data = array(
	':user_id'		=>	$_SESSION['user_id'],
	':desabafo_texto'		=>	$_POST['desabafo'],
);

$query = "
INSERT INTO desabafo 
(user_id, desabafo_texto) 
VALUES (:user_id, :desabafo_texto)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
	echo "true";
}
else {
	echo "false";
}

?>
