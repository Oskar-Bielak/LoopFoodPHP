<?php
session_start();
require_once "connect.php";	
mysqli_report(MYSQLI_REPORT_STRICT);
        $id=$_SESSION['id_restauracji'];
        $nazwa = $_POST['nazwa'];
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];
        $dlugosc = $_POST['dlugosc_wyk'];
        
        

include "connect.php";      
$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->query("INSERT INTO menu_restauracji VALUES (NULL,'$nazwa','$opis','$cena','$dlugosc','$id')")) // add query
{
    mysqli_close($polaczenie); // Close connection
    header("location:/Loop-Food/Aplikacja/Restauracja/panel-restauracja"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}

?>
