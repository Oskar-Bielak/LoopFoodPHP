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
        

        <title>Dodaj</title>
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
<div class="col-12 row">
        <div class="col-4">
        </div>
        <div class="col-md-4 panel">
        <h3>Formularz dodawania jedzenia</h3>
        <br />
        <form action ="d_potrawa.php"method="post">
		<label for="nazwa">Podaj Nazwe potrawy</label>
        <input type="nazwa" class="form-control" name="nazwa" aria-describedby="podpowiedzimie" placeholder="Wpisz Nazwe Potrawy">
        <br />
        <label for="opis">Podaj Opis potrawy</label>
        <input type="opis" class="form-control" name="opis" aria-describedby="podpowiedzimie" placeholder="Wpisz Opis">
        <br />
        <label for="cena">Podaj Cena</label>
        <input type="number" class="form-control" name="cena" aria-describedby="podpowiedzimie" value="0" min="0" max="1000">
        <br />
        <label for="dlug">Podaj Długość przygotowania</label>
        <input type="number" class="form-control" name="dlugosc_wyk" aria-describedby="podpowiedzimie" value="0" min="0" max="1000">
        <br />
        <button type="submit" class="btn btn-dark">Dodaj</button>
            
        
        </form>
        <div class="col-4">
        </div>
    
    
    </div>
    
</div>
</main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>