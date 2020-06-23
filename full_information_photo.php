<html>
    <head>
        <title> Сервис загрузки изображений от Ильича</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
        require_once 'process.php';
        $connection = connection();

        $update=$connection->query("UPDATE images SET views = views+0.5 where img_id = {$_POST['hide']}")->execute();

        $row = $connection ->query("SELECT img_name FROM images WHERE img_id = {$_POST['hide']}")->fetch(PDO::FETCH_ASSOC);

        $views = $connection->query("SELECT views from images WHERE  img_id = {$_POST['hide']}")->fetch(PDO::FETCH_ASSOC);?>
        <form>
            <img src="<?=$row['img_name']?>" alt="no photo" height="500"><br>
            <b>Кол-во просмотров: <?=$views['views']?></b><br>
        </form>

        <form  method="post" action="process.php">
            <button name="return_button" class="photo_butt" type="submit"> Back </button>
        </form>
    </body>
</html>