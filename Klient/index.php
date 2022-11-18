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
        

        <title>Panel Klient</title>
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
            <strong>Witaj!</strong> <?php echo $_SESSION['imie'] ?> Zyczymy owocnych zakupów.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
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
        <br /><br />
        <h3 style="padding-left:30px;">Koszyk</h3>
        <br /><br />
        <?php
        $id=$_SESSION['id_klient'];
       
        ?>
    <table class="table contain">
<thead>
    <tr>
      <th scope="col">Pozycja</th>
      <th scope="col">Nazwa Potrawy</th>
      <th scope="col">Cena</th>
      <th scope="col">Czas dostawy</th>
      
      <th scope="col">Usuń</th>
    </tr>
  </thead>
 
    <?php
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    
    
    $zapytanie = "SELECT z.id_zlecenia, m.nazwa_potrawy, m.cena, m.dlugosc_wyk FROM menu_restauracji as m,zlecenie as z,klienci as k WHERE k.id_klient=z.id_klient and m.id_potrawy=z.koszyk and k.id_klient=$id";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
    $cena=0;    
    $czas=0;
for ($i = 1; $i <= $ile; $i++) 
{
		
		$row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['nazwa_potrawy'];
        $a2 = $row['cena'];
        $cena = $a2 + $cena;
        $a3 = $row['dlugosc_wyk'];
        $id = $row['id_zlecenia'];
        $czas;
        if($a3>$czas){
            $czas=$a3;
        }
        else{
            $czas=$czas;
        }
		
?>
<tbody>
  <tr>
    <th scope="row"><?php echo $i; ?></th>
    <td >1x <?php echo $a1; ?></td>    
    <td><?php echo $a2; ?> zł</td>
    <td><?php echo $a3; ?>  min</td>
    <td><a href="usun.php?id=<?php echo $id; ?>"><button type='button' class='btn btn-outline-danger'>Usuń</button></a></td>
  </tr>
</tbody>
<?php
}
$ilosc=$i-1;
$czas=$czas+15;
$cena=$cena+20;
if($i>1){
    $polaczenie -> close(); 
?>

<thead>
    <tr>
      <th scope="col">Podsumowanie</th>
      <th scope="col">Ilość <?php echo $ilosc;?> </th>
      <th scope="col"><?php echo $cena; ?> zł</th>
      <th scope="col"><?php echo $czas; ?> min</th>
      <?php
      $_SESSION['cena'] = $cena;
      $_SESSION['czas'] = $czas;
      $_SESSION['ilosc'] = $ilosc;
      ?>
      <th scope="col"><a href="zaplac.php"><button type='button' class='btn btn-outline-success'>Zapłać</button></a></th>
    </tr>
  </thead>
  </table>
<?php

}
else{    
    echo<<<END
    </table>
    END;
}
?> 
        <br /><br />
        <h3 style="padding-left:30px;">W trakcie realizacji</h3>
        <br /><br />
        <table class="table contain">
        <thead>
        <tr>
            <th scope="col">Nr.Zlecenia</th>
            <th scope="col">Nazwa Potrawy</th>
            <th scope="col">Nazwa Restauracji</th>
            <th scope="col">Numer Restauracji</th>
            <th scope="col">Imię Dostawcy</th>
            <th scope="col">Numer Dostawcy</th>
        </tr>
        </thead>
        <?php
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    
    
    $zapytanie = "SELECT d.id_zlecenia, m.nazwa_potrawy, r.nazwa_restauracji, r.telefon_res, dost.imie, dost.telefon_dost FROM dostawca as dost, restauracja as r,menu_restauracji as m,dost_zlecenie as d,klienci as k WHERE dost.id_dostawcy=d.id_dostawcy and r.id_restauracji=d.id_restauracji and k.id_klient=d.id_klient and m.id_potrawy=d.koszyk and k.id_klient=$id and d.realizacja = 'W trakcie'";
    $rezultat = $polaczenie->query($zapytanie);
    $ile = mysqli_num_rows($rezultat);
    $cena=0;    
    $czas=0;
    for ($i = 1; $i <= $ile; $i++) 
    {
		
		$row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['nazwa_potrawy'];
        $a2 = $row['nazwa_restauracji'];
        $a4 = $row['telefon_res'];
        $a5 = $row['imie'];
        $a6 = $row['telefon_dost'];
		
?>
<tbody>
<tr>
    <th scope="row"><?php echo $i; ?></th>
    <td >1x <?php echo $a1; ?></td>
    <td ><?php echo $a2; ?></td>
    <td ><?php echo $a4; ?></td>
    <td ><?php echo $a5; ?></td>
    <td ><?php echo $a6; ?></td>  
</tr>
</tbody>
    


<?php 
    }
    echo "</table>";
$polaczenie -> close(); ?>
        
        <br /><br />
        <h3 style="padding-left:30px;">Informacje o koncie</h3>
        <br /><br />
        <div class="col row">
        <div class="col-3"></div>
        <div class="col-6 panel">
            <p>Imię i Nazwisko: <br /> <?php echo $_SESSION['imie'] ?> <?php echo $_SESSION['nazwisko'] ?></p>
            <p>Email: <br /><?php echo $_SESSION['email'] ?></p>
            
            <p>Adres: <br /><?php echo $_SESSION['adres'] ?></p>
            
            <p>Miasto: <br /><?php echo $_SESSION['miasto'] ?></p>
            
            <p>Telefon: <br /><?php echo $_SESSION['telefon'] ?></p>
            
            <p>Keyword: <br /><?php echo $_SESSION['keyword'] ?></p>
            
            
            <p>Jesli adres sie nie zgadza lub jakies dane osobowe w zakładze Zmiany osobowe zmienisz to. </p>

        </div>
        <div class="col-3"></div>
        </div>
    </div> 
 
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>