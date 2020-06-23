<?php
function connection(){
    return new PDO('mysql:dbname=litvinovproject;host=localhost:3306', 'root', 'root');
}

function authorization(){
    $pdo = connection();
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
    $check = $pdo->query($selectQuery)-> fetch();
    if ($check['count']==0 and $errors === ''){
        $login = $_POST['login'];
        $password = trim($_POST['pass']);
        $insertQuery = $pdo -> prepare($query);
        $insertQuery -> execute([$login,$password]);
        header("Location: main_page.php"); exit();
    } else{
        $checkQuery = "SELECT user_id FROM users where user_login like '{$_POST['login']}' and user_password like '{$_POST['pass']}'";
        $checkRow = $pdo->query($checkQuery)-> fetch();
        setcookie("userID", $checkRow['user_id']);
        if (is_array($checkRow) ==1){
            header("Location: main_page.php"); exit();
        }else{
            $errors = "Ошибка: данный пользователь зарегестрирован, но пароль был введен неверно";
        }
    }
    print '<b>'.$errors.'</b><br>';
}

function uploading_photos(){
    if (!is_dir("images")){
        mkdir("images", 8777,true);
    }
    $connection = connection();
    $query = 'INSERT INTO images(img_name, uploaded_user_id, views) VALUES (?,?,?)';

    $path = 'images';
    if(!empty($_FILES['docs']['name'])){
        $docs = $_FILES['docs'];
        foreach ($docs['tmp_name'] as $index =>$tmpPath){
            $name = basename($_FILES["docs"]["name"][$index]);
            if (!array_key_exists($index,$docs['name'])){
                continue;
            }
            move_uploaded_file($tmpPath,$path.DIRECTORY_SEPARATOR.$name);
            $insertQuery = $connection -> prepare($query);
            $insertQuery -> execute([$path.DIRECTORY_SEPARATOR.$name,$_COOKIE['userID']],'0');
        }
    }
    header('Location: main_page.php');
}
function photoDeleter(){
    $connection =connection();
    $deleteQuery="DELETE FROM images where img_id = {$_POST['deleteHidden']}";
    $delete = $connection->query($deleteQuery)->execute();
    print_r($delete);
}

#Страничка регистрации
if (isset($_POST['sigIn_but'])){
    authorization();
}

#Главная страничка
if(isset($_POST['upload_photos'])) {
    header("Location: uploading_images.php"); exit();
}
elseif (isset($_POST['all_photos'])) {
    header("Location: all_photos.php"); exit();
}
elseif (isset($_POST['my_photos'])){
    header("Location: user_photos.php"); exit();
}

#Страничка загрузки фотографий
if (isset($_POST['upload_but'])){
    uploading_photos();
}
if(isset($_POST['back_but'])) {
    header("Location: main_page.php"); exit();
}

#Страничка со всеми загруженными фотографиями
if(isset($_POST['back_button'])) {
    header("Location: main_page.php"); exit();
}
if (isset($_POST['return_button'])){
    header("Location: main_page.php");
}

#Страничка со всеми загруженными фотографиями определенного пользователя
if (isset($_POST['deletePhoto'])){
    photoDeleter();;
}
