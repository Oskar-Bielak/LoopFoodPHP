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
        

        <title>Panel Restauracji</title>
        <meta name="description" content="Zajmujemy sie dostawa jedzenia." />
        <meta name="keywords" content="dostawa do domu, jedzenie na wynos, aplikacja do jedzenia"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="shortcut icon" href="img/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>

<body>
        <div class="alert alert-success alert-dismissible fade show" style="text-align: center;"role="alert">
            <strong>Witaj!</strong> <?php echo $_SESSION['nazwa_restauracji'] ?> Miłego Dnia.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
        <h3 style="padding-left:30px;">Zlecenia przyjęte: </h3>
        <br /><br />
        <?php
    
       
        ?>
    <table class="table contain">
<thead>
    <tr>
      <th scope="col">Pozycja</th>
      <th scope="col">Nazwa Potrawy</th>
      <th scope="col">Imie Dostawcy</th>
      <th scope="col">Telefon Dostawcy</th>
      <th scope="col">ID Klienta</th>
      <th scope="col">Telefon Klienta</th>
      <th scope="col">Przy Odbiorze</th>
    </tr>
  </thead>
 
    <?php
    $id_rest=$_SESSION['id_restauracji'];
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    
    
    $zapytanie = "SELECT d.id_zlecenia, k.id_klient, m.nazwa_potrawy, dost.imie, dost.telefon_dost, k.telefon FROM dostawca as dost,restauracja as r,menu_restauracji as m,dost_zlecenie as d,klienci as k WHERE r.id_restauracji=d.id_restauracji and k.id_klient=d.id_klient and m.id_potrawy=d.koszyk and r.id_restauracji=$id_rest and d.realizacja = 'W trakcie' and d.realizacja_res = 'W trakcie'";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
for ($i = 1; $i <= $ile; $i++) 
{
		
    $row = mysqli_fetch_assoc($rezultat);
    $a1 = $row['nazwa_potrawy'];
    $a2 = $row['imie'];
    $a3 = $row['telefon_dost'];
    $a4 = $row['id_klient'];
    $a5 = $row['telefon'];
    $id = $row['id_zlecenia']
    
?>
<tbody>
  <tr>
    <th scope="row"><?php echo $i; ?></th>
    <td ><?php echo $a1; ?></td>    
    <td><?php echo $a2; ?></td>
    <td><?php echo $a3; ?></td>
    <td><?php echo $a4; ?></td>
    <td><?php echo $a5; ?></td>
    <td><a href="koniec_potrawy.php?id=<?php echo $id; ?>"><button type='button' class='btn btn-outline-dark'>Zakończ</button></td>
  </tr>
</tbody>

<?php


}
echo "</table>";
$polaczenie -> close(); ?>
    <main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>