<html lang="en">
    <head>
        <title>Сервис загрузки изображений от Ильича</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class="sigIn_page">
            <form class="form-signIn" method="post" action="process.php">
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