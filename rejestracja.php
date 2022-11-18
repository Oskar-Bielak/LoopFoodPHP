<?php

session_start();

if(isset($_POST['email']))
{
    //Udana walidacja? Założmy, że tak!
    $wszystko_OK=true;

    $imie = $_POST['imie'];

    if((strlen($imie)<3) || (strlen($imie)>25))
    {
        $wszystko_OK = false;
        $_SESSION['e_imie']="Imię musi posiadac od 3 do 25 liter";		
    }
    if(ctype_alnum($imie)==false)
    {
        $wszystko_OK = false;
        $_SESSION['e_imie']="Imię musi składac sie z liter";
    }

    $nazwisko = $_POST['nazwisko'];

    if((strlen($nazwisko)<2) || (strlen($nazwisko)>25))
    {
        $wszystko_OK = false;
        $_SESSION['e_nazwisko']="Nazwisko musi posiadac od 2 do 25 liter";		
    }

    $adres = $_POST['adres'];

    if((strlen($adres)<3) || (strlen($adres)>45))
    {
        $wszystko_OK = false;
        $_SESSION['e_adres']="Adres musi posiadac od 4 do 45 znaków";		
    }

    $miasto = $_POST['miasto'];

    if((strlen($miasto)<1) || (strlen($miasto)>35))
    {
        $wszystko_OK = false;
        $_SESSION['e_miasto']="Miasto musi posiadac od 3 do 35 znakow";		
    }

    $numer = $_POST['numer'];

    if((strlen($numer)<8) || (strlen($numer)>10))
    {
        $wszystko_OK = false;
        $_SESSION['e_numer']="Numer Telefonu posiada 9 liczb";		
    }

    $keyword = $_POST['keyword'];

    if((strlen($keyword)<10) || (strlen($keyword)>45))
    {
        $wszystko_OK = false;

        $_SESSION['e_keyword']="Numer Keyword musi miec wiecej niz 10 znakow";		
    }

    $email = $_POST['email'];
    $emailB= filter_var($email,FILTER_SANITIZE_EMAIL);
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
    {
        $wszystko_OK = false;
        $_SESSION['e_email']= "Podaj poprawny adres email";
    }

    //hasło

    $haslo = $_POST['haslo'];
    $haslo1 = $_POST['haslo1'];
    if((strlen($haslo)<8)||(strlen($haslo)>20))
    {
        $wszystko_OK = false;
        $_SESSION['e_haslo']= "Hasło musi posiadac od 8 do 20 znaków";
    }
    if($haslo!=$haslo1)
    {
        $wszystko_OK = false;
        $_SESSION['e_haslo']= "Hasło nie sa identyczne";
    }

    $haslo_hash=password_hash($haslo,PASSWORD_DEFAULT);
    
    // akceptacja regulaminu
    if(!isset($_POST['regulamin']))
    {
        $wszystko_OK = false;
        $_SESSION['e_regulamin']= "Zaakceptuj Regulamin";	
    }
    //polaczenie
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    
    try
    {
        $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno()); 
        }
        else 
        {
            $rezultat = $polaczenie->query("SELECT id_klient FROM klienci WHERE email='$email'");
            if(!$rezultat) throw new Exception($polaczenie->error);
            $ile_takich_maili = $rezultat-> num_rows;
            if($ile_takich_maili>0)
            {
                $wszystko_OK = false;
                $_SESSION['e_email']= "Istnieje konto z przypisanym tym emailem";
            }
        

            
        if ($wszystko_OK==true)
        {
    //Dodajemy osobe do bazy
        if($polaczenie->query("INSERT INTO klienci VALUES (NULL,'$imie','$nazwisko','$email','$adres','$miasto','$numer','$haslo_hash','$keyword')"))
        {
            $_SESSION['udane']=true;
            header('Location:aplikacja-jedzienie');
        }
        else {
            throw new Exception($polaczenie->error);
        }
        
        }
        $polaczenie->close();
    }
    }
    catch(Exception $e)
    {
        echo'<span style="color=red;"> Błąd serwera! Przepraszamy za niedogodnosci i prosimy o rejestracje w innym terminie!</span>';
        echo'<br />Informacja developerska:'.$e;
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        

        <title>Rejestracja</title>
        <meta name="description" content="Zajmujemy sie dostawa jedzenia." />
        <meta name="keywords" content="dostawa do domu, jedzenie na wynos, aplikacja do jedzenia"/>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="shortcut icon" href="img/logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <style>
            body{
                background-image: url(img/tlo_logo.jpg);
                background-position: center top;
                
                
            }
        </style>
</head>

<body>
<div class="col-12 conteiner">
    <div class="logos"><a href="aplikacja-jedzienie"><img src="img/logo.png" style="height: 40%; width: 40%; margin-left: 30%;" alt="Loop-Food"/></a></div>
    <div class="col-12 row">
        <div class="col-4">
        </div>
        <div class="col-md-4 panel">
        <h3>Formularz dla klienta</h3>
        <form method="post">
		<label for="imie">Podaj Imię</label>
        <input type="imie" class="form-control" name="imie" aria-describedby="podpowiedzimie" placeholder="Wpisz Imię">
        <small id="podpowiedzimie" class="form-text text-muted">Imię musi posiadac od 3 do 25 liter</small>
		<?php
			if(isset($_SESSION['e_imie']))
			{
				echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
				unset($_SESSION['e_imie']);
			}
		?>

        <label for="nazwisko">Podaj Nazwisko</label>
        <input type="nazwisko" class="form-control" name="nazwisko" aria-describedby="podpowiedznazwisko" placeholder="Wpisz Nazwisko">
        <small id="podpowiedzEmail" class="form-text text-muted">Nazwisko musi posiadac od 3 do 25 liter</small>
		<?php
			if(isset($_SESSION['e_nazwisko']))
			{
				echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
				unset($_SESSION['e_nazwisko']);
			}
		?>
		<label for="email">Podaj Email</label>
        <input type="email" class="form-control" name="email" aria-describedby="podpowiedzemail" placeholder="Wpisz Email">
        <small id="podpowiedzEmail" class="form-text text-muted">Adres email musi posiadac @.</small>
		<?php
			if(isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>

        <label for="adres">Podaj Adres</label>
        <input type="adres" class="form-control" name="adres" aria-describedby="podpowiedzadres" placeholder="Wpisz Adres">
        <small id="podpowiedzAdres" class="form-text text-muted">Adres dostawy</small>
		<?php
			if(isset($_SESSION['e_adres']))
			{
				echo '<div class="error">'.$_SESSION['e_adres'].'</div>';
				unset($_SESSION['e_adres']);
			}
		?>

        <label for="email">Podaj Miasto</label>
        <input type="miasto" class="form-control" name="miasto" aria-describedby="podpowiedzmiasto" placeholder="Wpisz miasto">
        <small id="podpowiedzmiasto" class="form-text text-muted">Miasto w ktorym mieszkasz.</small>
		<?php
			if(isset($_SESSION['e_miasto']))
			{
				echo '<div class="error">'.$_SESSION['e_miasto'].'</div>';
				unset($_SESSION['e_miasto']);
			}
		?>

		<label for="numer">Podaj Numer Telefonu</label>
        <input type="numer" class="form-control" name="numer" aria-describedby="podpowiedznumer" placeholder="Wpisz Numer Telefonu">
        <small id="podpowiedznumer" class="form-text text-muted">Numer Telefonu posiada 9 liczb</small>
        <?php
			if(isset($_SESSION['e_numer']))
			{
				echo '<div class="error">'.$_SESSION['e_numer'].'</div>';
				unset($_SESSION['e_numer']);
			}
		?>
		
		<label for="password">Podaj Hasło</label>
        <input type="password" class="form-control" name="haslo" aria-describedby="podpowiedzhaslo" placeholder="Wpisz Hasło">
        <small id="podpowiedzhaslo" class="form-text text-muted">Hasło musi posiadac od 8 do 20 znaków.</small>
		<?php
			if(isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>
		<label for="password">Podaj Ponownie Hasło</label>
        <input type="password" class="form-control" name="haslo1" aria-describedby="podpowiedzhaslo" placeholder="Wpisz Ponownie Hasło">
        <small id="podpowiedzhaslo" class="form-text text-muted">Hasło musi być identyczne jak wyżej.</small>
        
        <label for="keyword">Podaj Keyword</label>
        <input type="numer" class="form-control" name="keyword" aria-describedby="podpowiedzkeyword" placeholder="Wpisz Keyword">
        <small id="podpowiedzkeyword" class="form-text text-muted">Numer Keyword jest najwazniejszy musi miec wiecej niz 10 znaków.</small>
        <?php
			if(isset($_SESSION['e_numer']))
			{
				echo '<div class="error">'.$_SESSION['e_numer'].'</div>';
				unset($_SESSION['e_numer']);
			}
		?>
		<label>
		<medium><input class="form-check-input position-static" type="checkbox" name="regulamin" value="option1" aria-label="Pusty checkbox" >Akceptuje <a href="regulamin-strony"> Regulamin.</a></medium>
		<?php
			if(isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>
		</label>
        <br/>
                <button type="submit" class="btn btn-dark">Dołacz do nas</button>
            
        
        </form>
        <div class="col-4">
        </div>
    
    
    </div>
    <br /><br /><br /><br />
    <div class="col-12 footer" style="text-align: center; color:black;">
        <p>Loop-Food &copy Wszelkie prawa zastrzeżone.<p>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>