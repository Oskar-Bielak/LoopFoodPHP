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

        

        if($rezultat =@$polaczenie->query("SELECT * FROM admin WHERE email='$login'"))
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
                    $_SESSION['nr_telefonu'] = $wiersz['nr_telefonu'];
                    $_SESSION['email'] = $wiersz['email'];
                
                    unset($_SESSION['blad']);
                    $rezultat->free_result(); 

                    header('Location: /Loop-Food/Aplikacja/Admin/panel-sterowania');
                }
                else {
                    $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                    header('location: /Loop-Food/Aplikacja/Admin/admin');
                }
            } 
            else {
                $_SESSION['blad']= '<span style="color:red">Nieprawidlowe login lub hasło ! <span>';
                header('location: /Loop-Food/Aplikacja/Admin/admin');
            }
        }

        $polaczenie->close();
    }

?>