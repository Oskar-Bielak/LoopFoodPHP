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
        

        <title>Zmiany osobowe</title>
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
        <a class="navbar-brand" href="panel-dostawcy">
        <img src="img/logo.png" width="70" height="50" alt=""></a>
        <nav class="navbar navbar-light navbar-expand-lg">
        <button class="navbar-toggler flex-row-reverse" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
                    <li class="nav-item">
						<a class="nav-link" href="dodaj">Dodaj Zlecenie</a>
                    </li>
                    <li class="nav-item">
						<a class="nav-link" href="historia">Historia Zamowień</a>
                    </li>
                    
					<li class="nav-item">
						<a class="nav-link" href="zmiany">Zmiany Osobowe</a>
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
    <div class="col-12 conteiner">
    <div class="col-12 row">
        <div class="col-4">
        </div>
        <div class="col-md-4 panel">
        <h3>Zmiana w danych</h3>
        <form action="z_danych.php" method="post">
		<label for="imie">Podaj Imię</label>
        <input type="imie" class="form-control" name="imie" aria-describedby="podpowiedzimie" value="<?php echo $_SESSION['imie'] ?>">
        <small id="podpowiedzimie" class="form-text text-muted">Imię musi posiadac od 3 do 25 liter</small>
		

        <label for="nazwisko">Podaj Nazwisko</label>
        <input type="nazwisko" class="form-control" name="nazwisko" aria-describedby="podpowiedznazwisko" value="<?php echo $_SESSION['nazwisko'] ?>">
        <small id="podpowiedzEmail" class="form-text text-muted">Nazwisko musi posiadac od 3 do 25 liter</small>
		
		<label for="email">Podaj Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="podpowiedzemail" value="<?php echo $_SESSION['email'] ?>">
        <small id="podpowiedzEmail" class="form-text text-muted">Adres email musi posiadac @.</small>
       
        
        <label for="email">Podaj Miasto</label>
        <input type="lokalizacja" class="form-control" name="lokalizacja" aria-describedby="podpowiedzmiasto" value="<?php echo $_SESSION['lokalizacja'] ?>">
        <small id="podpowiedzmiasto" class="form-text text-muted">Miasto w ktorym mieszkasz.</small>
		

		<label for="numer">Podaj Numer Telefonu</label>
        <input type="numer" class="form-control" name="numer" aria-describedby="podpowiedznumer" value="<?php echo $_SESSION['telefon_dost'] ?>">
        <small id="podpowiedznumer" class="form-text text-muted">Numer Telefonu posiada 9 liczb</small>
        
        <br/>
                <button type="submit" class="btn btn-dark">Zmień</button>
            
        
        </form>
        </div>
        <div class="col-4">
        </div>
    
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>