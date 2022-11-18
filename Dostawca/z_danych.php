<?php
session_start();
require_once "connect.php";	
mysqli_report(MYSQLI_REPORT_STRICT);
        $id=$_SESSION['id_dostawcy'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $lokalizacja = $_POST['lokalizacja'];
        $numer = $_POST['numer'];
        $email = $_POST['email'];
        
include "connect.php";      
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->query("UPDATE dostawca SET `imie` = '$imie', `nazwisko` = '$nazwisko', `email` = '$email', `lokalizacja` = '$lokalizacja', `telefon_dost` = '$numer' WHERE `id_dostawcy` = '$id';")) // add query
{
    mysqli_close($polaczenie); // Close connection
    header("location:/Loop-Food/Aplikacja/Klient/panel-klient"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
$polaczenie
?>
