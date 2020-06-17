<?php
require_once 'index.php';
$user_id = $new;
if (!is_dir("images")){
    mkdir("images", 8777,true);
}

$connection = new PDO('mysql:dbname=litvinovproject;host=localhost:3306', 'root', 'root');
$query = 'INSERT INTO images(img_name, uploaded_user_id) VALUES (?,?)';

$path = 'images/';
$errors = '';
if(!empty($_FILES['docs']['name'])){
    $docs = $_FILES['docs'];
    foreach ($docs['tmp_name'] as $index =>$tmpPath){
        $name = basename($_FILES["docs"]["name"][$index]);
        if (!array_key_exists($index,$docs['name'])){
            continue;
        }

        if(!move_uploaded_file($tmpPath, "$path/$name")){
            $errors='Файлы не были загружены :с';
        }
        else{
            $errors='Файлы успешно загружены! с:';
            $insertQuery = $connection -> prepare($query);
            $insertQuery -> execute(["$path/$name",$user_id]);
        }
        print '<b>'.$errors.'</b>';

    }
}
?>

<html>
    <head>
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="docs[]" multiple class="documents">
        <input type="submit" value="Загрузить" class="documents">
        <button name="back_but" class="documents" type="submit"> back </button>
        <p class="smallText">© Litvinov cooperation 2020</p>
    </form>
    </body>
</html>

<?php
if(isset($_POST['back_but'])) {
    header("Location: main_page.php"); exit();
}
?>