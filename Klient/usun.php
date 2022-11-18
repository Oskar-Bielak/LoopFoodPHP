<?php

include "connect.php"; // Using database connection file here
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
$id = $_GET['id']; // get id through query string

$del = mysqli_query($polaczenie,"CALL usuwanie('$id')"); // delete query

if($del)
{
    mysqli_close($polaczenie); // Close connection
    header("location:/Loop-Food/Aplikacja/Klient/panel-klient"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>