<?php
session_start();
require_once "connect.php";	
mysqli_report(MYSQLI_REPORT_STRICT);


if(!isset($_SESSION['zalogowany']))
	{
		header('Location: /Loop-Food/Aplikacja/aplikacja-jedzienie');
		exit();
	}
?>
<?php
include "connect.php"; // Using database connection file here
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);

$klient = $_SESSION['id_klient'];


$del = mysqli_query($polaczenie,"CALL zaplacone('$klient')"); // delete query

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