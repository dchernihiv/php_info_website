<?php
/** registration page template **/

require_once 'function/function.php';

if (isset($_POST['submit'])) {
    try {
        if (strlen($_POST['login']) < 5 || strlen($_POST['login']) > 10) {
            throw new Exception('Логин не соответствует необходимой длинне от 5 до 10 символов');  
        }
        if (!loginExist($_POST['login'])) {
            throw new Exception('Логин существует');  
        }
        createUser($_POST['login'], $_POST['password']);
        header('Location: login');
        exit;
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta name="description" content="heating equipment">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/registration.css">
    </header>
    <body>
        <main>
            <div class="content">
                <aside></aside>
                <section>
                    <h3>Регистрация:</h3>
                    <form method="POST">
                        <label for="text">Введите логин:</label>
                        <input id="text" type="text" name="login" required><br><br>

                        <label for="password">Введите пароль:</label>
                        <input id="password" type="password" name="password" required><br><br>

                        <input class="btn" type="submit" name="submit" value="Зарегистрироваться"><br><br>
                    </form>
                    <button class="btn" type="button" onclick="window.location.href='/'">На главную</button>
                </section>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
