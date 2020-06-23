<html>
    <head>
        <meta charset="utf-8">
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <?php
        require_once 'process.php';
        $connection = connection();
        $selectQuery = "SELECT img_name, img_id FROM images";
        $selectRows = $connection->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($selectRows as $selectRow):?>
        <form method="post" action="full_information_photo.php">
            <img src='<?=$selectRow['img_name']?>'height="120">
            <input type="submit" name="moreInfo" value="More Info">
            <input type="hidden" name="hide" value="<?=$selectRow['img_id']?>">
        </form>
        <?php endforeach;?>
    </body>
    <form method="post" action="process.php">
        <button name="back_button" class="photo_butt" type="submit"> back </button>
    </form>
</html>