<?php
session_start();
require_once "connect.php";	
mysqli_report(MYSQLI_REPORT_STRICT);
        $id=$_SESSION['id_klient'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $adres = $_POST['adres'];
        $miasto = $_POST['miasto'];
        $numer = $_POST['numer'];
        $email = $_POST['email'];
        
include "connect.php";      
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->query("UPDATE klienci SET `imie` = '$imie', `nazwisko` = '$nazwisko', `email` = '$email', `adres` = '$adres', `miasto` = '$miasto', `telefon` = '$numer' WHERE `id_klient` = '$id';")) // add query
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
