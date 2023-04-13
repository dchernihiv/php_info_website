<?php
/** admin page template **/

require_once 'function/function.php';
require_once 'function/function_db.php';

if (!getUser()) {
    header('Location: login'); 
}
$out = '';
foreach( $result as $element) {
    $out .= '<article>';
    $out .= '<h4>'.$element['title'].'</h4>';
    $out .= '<p>'.$element['min_descr'].'</p>';
    $out .= '<div><img src="/static/image/'.$element['image'].'" alt="'.$element['title'].'" width="150"></div>';
    $out .= '<div id="btn">';
    $out .= '<button class="read" onclick="article(event,' . $element['id'].')">Удалить статью</button>';
    $out .= '<span><button class="read" onclick="article(event,'. $element['id'].')">Обновить статью</button><span>';
    $out .= '</div>';
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
            function article(event, id) {
                if (event.currentTarget.innerHTML == 'Удалить статью') {
                    const del = confirm('Удалить статью?');
                    if (del) {
                        window.location.href= '/admin/delete/' + id;
                    }
                } else {
                    const del = confirm('Обновить статью?');
                    if (del) {
                        window.location.href= '/admin/update/' + id;
                    }
                }
            }
        </script>
        <link rel="stylesheet" href="/style/admin.css">
    </header>
    <body>
        <main class="content">
            <aside></aside>
            <section>
                <h3>Админ панель:</h3>
                <button class="btn" type="button" onclick="window.location.href='/admin/create'">Создать новую статью</button>
                <?php echo $out; ?>
                <button class="btn_main" type="button" onclick="window.location.href='/'">На главную</button>
            </section>
        </main>
        <footer></footer>
    </body>
</html>



