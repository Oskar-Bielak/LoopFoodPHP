<?php
session_start();
require_once "connect.php";	
mysqli_report(MYSQLI_REPORT_STRICT);
include "connect.php"; // Using database connection file here
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
$id = $_GET['id']; // get id through query string
$id_dost=$_SESSION['id_dostawcy'];

$upt = mysqli_query($polaczenie,"CALL dodaj_dostawce('$id_dost','$id')"); // update id_dostawcy

if($upt)
{
    mysqli_close($polaczenie); // Close connection
    header("location:/Loop-Food/Aplikacja/Dostawca/panel-dostawcy"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>