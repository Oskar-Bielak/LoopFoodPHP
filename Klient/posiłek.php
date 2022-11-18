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
        

        <title>Menu</title>
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
        <a class="navbar-brand" href="panel-klient">
        <img src="img/logo.png" width="70" height="50" alt=""></a>
        <nav class="navbar navbar-light navbar-expand-lg">
        <button class="navbar-toggler flex-row-reverse" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				   
					<li class="nav-item">
						<a class="nav-link" href="zamow">Restauracja</a>
					</li>
                    
                    <li class="nav-item">
						<a class="nav-link" href="historia">Historia Zamowienia</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="zmiany">Zmiany osobowe</a>
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
    <div class="row " style="text-align: center; padding:0px;">
    <?php

    include "connect.php"; // Using database connection file here
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    $id = $_GET['id'];
    $_SESSION['restauracja'] = $id;
    require_once "connect.php";
    
    $zapytanie = "SELECT r.id_restauracji, m.id_potrawy, m.nazwa_potrawy, m.opis_potrawy, m.cena, m.dlugosc_wyk FROM menu_restauracji as m, restauracja as r WHERE m.id_restauracji = r.id_restauracji AND r.id_restauracji = $id";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
   
for ($i = 1; $i <= $ile; $i++) 
{
    $row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['id_restauracji'];
        $a2 = $row['id_potrawy'];
        $a3 = $row['nazwa_potrawy'];
        $a4 = $row['opis_potrawy'];
        $a5 = $row['cena'];
        $a6 = $row['dlugosc_wyk']
?>
<div class="col-4 artykul" style="margin-top: 50px;padding-top :20px; padding-bottom :20px;">
    <p>Nazwa: </br> <?php echo $a3; ?></p>
    <p>Opis: </br> <?php echo $a4; ?></p>
    <p>Cena: </br> <?php echo $a5; ?> zł</p>
    <p>Długość wykonania: </br> <?php echo $a6; ?> min</p>
    <a href="dodaj.php?id=<?php echo $a2; ?>"><button type='button' class='btn btn-outline-success'>Wybierz</button></a>    
</div>
<?php
}
    ?>
    </div>
</div>
</main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>