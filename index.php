<?php
$result='';
if(isset($_POST['sigIn_but'])) {
    $connection = new PDO('mysql:dbname=litvinovproject;host=localhost:3306', 'root', 'root');
    $query = 'INSERT INTO users(user_login, user_password) VALUES (?,?)';
    $errors='';
    #Проверка логина на наличие несоответствий
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $errors="Ошибка: логин может состоять только из букв английского алфавита и цифр";
    }
    if(strlen($_POST['login']) < 2 or strlen($_POST['login']) > 30)
    {
        $errors = "Ошибка: логин должен быть не меньше 3-х символов и не больше 30";
    }

    $selectQuery = "SELECT count(user_id) as count FROM users where user_login like '{$_POST['login']}'";
    $check = $connection->query($selectQuery)-> fetch();

    if ($errors === ''){
        if ($check['count'] ==0){
            $login = $_POST['login'];
            $password = trim($_POST['pass']);
            $insertQuery = $connection -> prepare($query);
            $insertQuery -> execute([$login,$password]);
            header("Location: main_page.php"); exit();
        }else{
            $checkQuery = "SELECT user_id FROM users where user_login like '{$_POST['login']}' and user_password like '{$_POST['pass']}'";
            $checkRow = $connection->query($checkQuery)-> fetch();
            print_r($checkRow['user_id']);
            $result = $checkRow['user_id'];
            echo $result;
            if (is_array($checkRow) ==1){
                header("Location: main_page.php"); exit();
            }else{
                $errors = "Ошибка: данный пользователь зарегестрирован, но пароль был введен неверно";
            }
        }
    }print '<b>'.$errors.'</b><br>';
}$new = $result;
print_r($new);
?>

<html lang="en">
    <head>
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class="sigIn_page">
            <form class="form-signIn" method="post">
                <h1 class="bigText">Please sign in</h1>
                <label for="inputLogin" class="labels">Login</label>
                <input name="login" type="text" id="inputLogin" class="inputSomething" placeholder="Login" required="" autofocus="">
                <label for="inputPassword" class="labels">Password</label>
                <input name="pass" type="password" id="inputPassword" class="inputSomething" placeholder="Password" required=""><br>
                <button name="sigIn_but" class="but" type="submit"> Sign in </button>
                <p class="smallText">© Litvinov cooperation 2020</p>
            </form>
        </div>
    </body>
</html>