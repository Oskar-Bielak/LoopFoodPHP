<?php
    session_start();
    require_once"connect.php";
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
    if($polaczenie->connect_errno!=0)
        {
             echo "Error".$polaczenie->connect_errno;
        }
    else
    {
        $login = $_POST['email'];
        $haslo = $_POST['haslo']; 
        $rola = $_POST['rola'];

        if(strlen($rola == 'Klient'))
        { 
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
             echo "Error".$polaczenie->connect_errno;
        }
        else
        {
        if($rezultat =@$polaczenie->query("SELECT * FROM klienci WHERE email='$login'"))
        {
        $ile_userow = $rezultat->num_rows;
        if($ile_userow>0)
        {
            $wiersz = $rezultat->fetch_assoc();
            
            if(password_verify($haslo, $wiersz['haslo']))
            {
                $_SESSION['zalogowany'] = true;

                
                $_SESSION['id_klient'] = $wiersz['id_klient'];
                $_SESSION['imie'] = $wiersz['imie'];
                $_SESSION['nazwisko'] = $wiersz['nazwisko'];
                $_SESSION['email'] = $wiersz['email'];
                $_SESSION['adres'] = $wiersz['adres'];
                $_SESSION['miasto'] = $wiersz['miasto'];
                $_SESSION['telefon'] = $wiersz['telefon'];
                $_SESSION['keyword'] = $wiersz['keyword'];
                
            
                unset($_SESSION['blad']);
                $rezultat->free_result(); 

                header('Location: /Loop-Food/Aplikacja/Klient/panel-klient');
            }
            else {
                $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                header('location: aplikacja-jedzienie');
            }
        } 
        else {
            $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
            header('location: aplikacja-jedzienie');
        }
        $polaczenie->close();
        } 
        }
        }   
          
        if(strlen($rola == 'Dostawca'))
        {
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        if($polaczenie->connect_errno!=0)
        {
             echo "Error".$polaczenie->connect_errno;
        }
        else
        {
        if($rezultat =@$polaczenie->query("SELECT * FROM dostawca WHERE email='$login'"))
        {
        $ile_userow = $rezultat->num_rows;
        if($ile_userow>0)
        {
            $wiersz = $rezultat->fetch_assoc();
            
            if(password_verify($haslo, $wiersz['haslo']))
            {
                $_SESSION['zalogowany'] = true;

                
                $_SESSION['id_dostawcy'] = $wiersz['id_dostawcy'];
                $_SESSION['imie'] = $wiersz['imie'];
                $_SESSION['nazwisko'] = $wiersz['nazwisko'];
                $_SESSION['email'] = $wiersz['email'];
                $_SESSION['lokalizacja'] = $wiersz['lokalizacja'];
                $_SESSION['telefon_dost'] = $wiersz['telefon_dost'];
                $_SESSION['keyword'] = $wiersz['keyword'];
            
                unset($_SESSION['blad']);
                $rezultat->free_result(); 

                header('Location: /Loop-Food/Aplikacja/Dostawca/panel-dostawcy');
            }
            else {
                $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                header('location: aplikacja-jedzienie');
            }
        } 
        else {
            $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
            header('location: aplikacja-jedzienie');
        }
        $polaczenie->close();
        } 
        }
        }
        if(strlen($rola == 'Restauracja'))
        {
            $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
            if($polaczenie->connect_errno!=0)
            {
                 echo "Error".$polaczenie->connect_errno;
            }
            else
            {
            if($rezultat =@$polaczenie->query("SELECT * FROM restauracja WHERE email='$login'"))
            {
            $ile_userow = $rezultat->num_rows;
            if($ile_userow>0)
            {
                $wiersz = $rezultat->fetch_assoc();
                
                if(password_verify($haslo, $wiersz['haslo']))
                {
                    $_SESSION['zalogowany'] = true;
    
                    
                    $_SESSION['id_restauracji'] = $wiersz['id_restauracji'];
                    $_SESSION['nazwa_restauracji'] = $wiersz['nazwa_restauracji'];
                    $_SESSION['email'] = $wiersz['email'];
                    $_SESSION['lokalizacja_res'] = $wiersz['lokalizacja_res'];
                    $_SESSION['adres_res'] = $wiersz['adres_res'];
                    $_SESSION['nip'] = $wiersz['nip'];
                    $_SESSION['telefon_res'] = $wiersz['telefon_res'];
                    $_SESSION['opis_restauracji'] = $wiersz['opis_restauracji'];
                    $_SESSION['keyword'] = $wiersz['keyword'];
                
                    unset($_SESSION['blad']);
                    $rezultat->free_result(); 
    
                    header('Location: /Loop-Food/Aplikacja/Restauracja/panel-restauracja');
                }
                else {
                    $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                    header('location: aplikacja-jedzienie');
                }
            } 
            else {
                $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                header('location: aplikacja-jedzienie');
            }
            $polaczenie->close();
            } 
            }
        }
    
    }
    
?>