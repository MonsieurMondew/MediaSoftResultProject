<?php
if(isset($_POST['upload_photos'])) {
    header("Location: uploading_images.php"); exit();
}
?>

<html>
    <head>
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class="main_page">
            <form class="form-main" method="post">
                <button name="all_photos" class="butt" type="submit"> all photos </button>
                <button name="upload_photos" class="butt" type="submit"> upload photos </button>
                <button name="my_photos" class="butt" type="submit"> my photos </button>
            </form>
        </div>
    </body>
</html>