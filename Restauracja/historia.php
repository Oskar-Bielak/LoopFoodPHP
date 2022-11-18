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
<!DOCTYPE html>
<html lang="pl">

<head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        

        <title>Historia</title>
        <meta name="description" content="Zajmujemy sie dostawa jedzenia." />
        <meta name="keywords" content="dostawa do domu, jedzenie na wynos, aplikacja do jedzenia"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="shortcut icon" href="img/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
<header>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="panel-restauracja">
        <img src="img/logo.png" width="70" height="50" alt=""></a>
        <nav class="navbar navbar-light navbar-expand-lg">
        <button class="navbar-toggler flex-row-reverse" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
                    <li class="nav-item">
						<a class="nav-link" href="dodaj">Dodaj potrawe</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="menu">Menu</a>
                    </li>
                    
					<li class="nav-item">
						<a class="nav-link" href="historia">Historia Zamowień</a>
					</li>
                    
                    
                    <li class="nav-item">
						<a class="nav-link" href="logout.php">Wyloguj się</a>
					</li>
				
                </ul>
            </div>
    </nav>
    </nav>
    </header>
    <main>
    <div id="col-12 conteiner">
        <br /><br />
        <h3 style="padding-left:30px;">Historia zamowień:</h3>
        <br /><br />
        <table class="table contain">
        <thead>
        <tr>
            <th scope="col">Nr.Zlecenia</th>
            <th scope="col">Nazwa Potrawy</th>
            <th scope="col">ID Dostawcy</th>
            <th scope="col">Telefon Dostawcy</th>
            <th scope="col">Imię Klienta</th>
            <th scope="col">Numer Klienta</th>
            <th scope="col">Cena</th>
        </tr>
        </thead>
        <?php
        $id_rest=$_SESSION['id_restauracji'];
        $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    
    
    $zapytanie = "SELECT d.id_zlecenia, m.nazwa_potrawy, dost.id_dostawcy,m.cena, dost.telefon_dost, k.id_klient, k.telefon, k.imie FROM dostawca as dost, restauracja as r,menu_restauracji as m,dost_zlecenie as d,klienci as k WHERE dost.id_dostawcy=d.id_dostawcy and r.id_restauracji=d.id_restauracji and k.id_klient=d.id_klient and m.id_potrawy=d.koszyk and r.id_restauracji=$id_rest and d.realizacja = 'Zakonczone'";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
    $ilosc = 0;
    $cena = 0;
    $zysk = 0;
for ($i = 1; $i <= $ile; $i++) 
    {
		
		$row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['nazwa_potrawy'];
        $a2 = $row['id_dostawcy'];
        $a4 = $row['telefon_dost'];
        $a5 = $row['imie'];
        $a6 = $row['telefon'];
        $a7 = $row['cena'];
        $cena = $a7 + $cena;
        $ilosc =$i + $ilosc;
		
?>
<tbody>
<tr>
    <th scope="row"><?php echo $i; ?></th>
    <td >1x <?php echo $a1; ?></td>
    <td ><?php echo $a2; ?></td>
    <td ><?php echo $a4; ?></td>
    <td ><?php echo $a5; ?></td>
    <td ><?php echo $a6; ?></td>
    <td ><?php echo $a7; ?> zł</td>    
</tr>
</tbody>

<?php
}
$polaczenie -> close();
$ilosc = $ilosc-1;
$zysk= $cena*0.15;
if($i>1){

?>


  </table>
<?php

}
else{    
    echo<<<END
    </table>
    END;
}
?>
<div class="col-12 row" style="margin-top:50px;">
<div class="col-4">
        </div>
        <div class="col-md-4 panel">
<h3>Podsumowanie: </h3>
<p>Ilość zamowień: <?php echo $ilosc; ?></p>
<p>Kwota zysku: <?php echo $cena; ?></p>
<p>Prowizja dla twórców aplikacji: <?php echo $zysk; ?> zł</p>
</div>
<div class="col-4"></div>
</div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>