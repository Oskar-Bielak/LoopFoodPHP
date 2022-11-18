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
        

        <title>Restauracje</title>
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
    require_once "connect.php";
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    $zapytanie = "SELECT id_restauracji,nazwa_restauracji,lokalizacja_res,adres_res,nip,opis_restauracji FROM restauracja";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
   
for ($i = 1; $i <= $ile; $i++) 
{
    $row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['nazwa_restauracji'];
        $a2 = $row['lokalizacja_res'];
        $a3 = $row['adres_res'];
        $a4 = $row['nip'];
        $a5 = $row['opis_restauracji'];
        $id = $row['id_restauracji']
?>
<div class="col-4 artykul" style="margin-top: 50px;padding-top :20px; padding-bottom :20px;">
    <p>Nazwa: </br> <?php echo $a1; ?></p>
    <p>lokalizacja: </br> <?php echo $a2; ?></p>
    <p>Adres: </br> <?php echo $a3; ?></p>
    <p>NIP: </br> <?php echo $a4; ?></p>
    <p>Opis: </br> <?php echo $a5; ?></p>
    <a href="posiłek.php?id=<?php echo $id; ?>"><button type='button' class='btn btn-outline-success'>Wybierz</button></a>    
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