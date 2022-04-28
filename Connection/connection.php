<?php 
	// session_start();
    $Host = "localhost";
    $User = "root";
    $Password = "";
    $Database = "fitness-app-db";

try
{
$con=mysqli_connect($Host, $User, $Password, $Database);
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
