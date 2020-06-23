<html>
    <head>
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
    <form method="post" enctype="multipart/form-data" action="process.php">
        <input type="file" name="docs[]" multiple class="documents">
        <button name="upload_but" class="documents" type="submit"> Upload </button>
        <button name="back_but" class="documents" type="submit"> Back </button>
        <p class="smallText">© Litvinov cooperation 2020</p>
    </form>
    </body>
</html>