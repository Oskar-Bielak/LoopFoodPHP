<!DOCTYPE html>
<html lang="pl">

<head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        

        <title>Zapomniałem Hasła</title>
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
            <h3>Zapomniałem Hasła</h3>
            <br />
            <form action="zapomnialem1.php" method="post">
            <p>Wybierz użytkownika</p>
            <select class="form-control">
            <option>Klient</option>
            <option>Dostawca</option>
            <option>Restauracja</option>
            </select>
            <br />
            
            <div class="form-group">
            <label for="Email">Adres Email</label>
            <input type="email" class="form-control" id="Email" aria-describedby="podpowiedzEmail" placeholder="Wpisz Email">
            <small id="podpowiedzEmail" class="form-text text-muted">W powyższym polu wpisujesz swój adres email.</small>
            </div>
            <div class="form-group">
            <label for="odpowiedz">Key Word</label>
            <input type="text" class="form-control" id="KeyWord" aria-describedby="podpowiedzEmail" placeholder="Wpisz Key Word">
            </div>
            <button type="submit" class="btn btn-dark">Przypomnij</button>
            </form>
        </div>
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