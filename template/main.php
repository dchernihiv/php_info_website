<?php
/** main page template **/

require_once 'function/function.php';

$out = '';
foreach( $result as $element) {
    $out .= '<article>';
    $out .= '<h3 style="text-align: center;">'.$element['title'].'</h3>';
    $out .= '<p>'.$element['min_descr'].'</p>';
    $out .= '<img src="/static/image/'.$element['image'].'" alt="'.$element['title'].'" width="250" height="150">';
    $out .= '<div id="read"><button type="button" class="read" onclick="window.location.href = \'/article/'.$element['url'].'\'">Читать полностью</button></div>';
    $out .= '</article>';
}
?>

<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta name="description" content="heating equipment">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
            function func(event) {
                if (event.target.innerHTML == 'Регистрация') {window.location.href = 'registration';}
                if (event.target.innerHTML == 'Аутентификация') {window.location.href = 'login';}
            }
        </script>
        <link rel="stylesheet" href="/style/template.css">
    </header>
    <body>
        <header>
            <div id="background"></div>
        </header>
        <main>
            <div class="content">
                <aside>
                    <div>
                        <button type="button" class="btn" onclick="func(event)">Регистрация</button>
                        <button type="button" class="btn" onclick="func(event)">Аутентификация</button>
                    </div>
                </aside>
                <section>
                    <?php echo $out; ?>
                </section>
            </div>
        </main>
        <footer></footer>
    </body>
</html>



