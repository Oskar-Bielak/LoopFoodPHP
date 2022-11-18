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
        

        <title>Koszyk</title>
        <meta name="description" content="Zajmujemy sie dostawa jedzenia." />
        <meta name="keywords" content="dostawa do domu, jedzenie na wynos, aplikacja do jedzenia"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="shortcut icon" href="img/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>
<body>
    <div id="col-12 conteiner">
        <div class="col row" style="margin-top: 150px;">
            <div class="col-3"></div>
            <div class="col-6 panel">
                <h3> Podsumowanie: </h3\><br /><br /><br />
                <medium>Ilość elemntow w koszku: </medium>
                <medium><?php echo $_SESSION['ilosc'] ?></medium><br /><br />
                <medium>Koszt zamówienia: </medium>
                <medium><?php echo $_SESSION['cena'] ?> zł</medium><br /><br />
                <medium>Czas dostawy zamowienie:</medium>
                <medium><?php echo $_SESSION['czas'] ?> min</medium><br /><br />
                <a href="przyjecie.php"><button type="button" class="btn btn-outline-success btn-lg">Płatność internetowa</button></a>
                <a href="panel-klient"><button type="button" class="btn btn-outline-danger btn-lg">Wróć</button></a>
                
            
            </div>
            <div class="col-3"></div>
        </div>
    </div> 


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>