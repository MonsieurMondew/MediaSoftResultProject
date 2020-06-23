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
$selectQuery = "SELECT img_name, img_id FROM images WHERE uploaded_user_id LIKE '{$_COOKIE['userID']}'";
$selectRows = $connection->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);
foreach ($selectRows as $selectRow):?>
    <form method="post" action="full_information_photo.php">
        <img src='<?=$selectRow['img_name']?>' width="120" height="120"> <br>
        <button name="moreInfo" type="submit"> More Info</button> <br>
        <input type="hidden" name="hide" value="<?=$selectRow['img_id']?>">
    </form>
    <form method="post" action="process.php">
        <button name="deletePhoto" type="submit">Delete</button>
        <input type="text" name="deleteHidden" value="<?=$selectRow['img_id']?>">
    </form>
<?php endforeach;?>
<form method="post" action="process.php">
    <button name="back_button" class="photo_butt" type="submit"> back </button>
</form>
</body>
</html>