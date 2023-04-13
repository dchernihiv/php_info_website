<?php
/** login page template **/

require_once 'function/function.php';

if (isset($_POST['submit'])) {
    $result = findUser($_POST['login'], $_POST['password']);
    if (count($result) != 0) {
        $hash = md5( getRandomString() );
        $ip = null;
        if ($_POST['ip']) {
            $ip = $_SERVER['SERVER_ADDR'];
        }
        $addInfo = updateUser($hash, $ip, $result[0]['id']);
        if ($addInfo) {
            setcookie('id', $result[0]['id'], time() + 60*60*24*30, '/');
            setcookie('hash', $hash, time() + 60*60*24*30, '/');
            header('Location: admin');
            exit();
        } else echo ('Произошла ошибка обновления данных пользователя');
    } else echo 'Не верный ввод данных';
}
?>

<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta name="description" content="heating equipment">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/login.css">
    </header>
    <body>
        <main>
            <div class="content">
                <aside></aside>
                <section>
                    <h3>Аутентификация:</h3>
                    <form method="POST">
                        <label for="text">Укажите логин:</label>
                        <input id="text" type="text" name="login" required><br><br>

                        <label for="password">Укажите пароль:</label>
                        <input id="password" type="password" name="password" required><br><br>

                        <label for="ip">Прикрепить ip</label>
                        <input id="ip" type="checkbox" name="ip" checked><br><br>
                        
                        <input class="btn" type="submit" name="submit" value="Log in"><br><br>
                    </form>
                    <button class="btn" type="button" onclick="window.location.href='/'">На главную</button>
                    <button class="btn_reset" type="button" onclick="window.location.href='/logout'">Logout<br><br>
                </section>
            </div>
        </main>
        <footer></footer>
    </body>
</html>