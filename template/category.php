<?php
/** category page template **/

require_once 'function/function.php';

$out = '';
foreach( $result as $element) {
    $out .= '<article>';
    $out .= '<h3>'.$element['title'].'</h3>';
    $out .= '<p>'.$element['min_descr'].'</p>';
    $out .= '<p>'.$element['description'].'</p>';
    $out .= '<div><img src="/static/image/'.$element['image'].'"></div>';
    $out .= '</article>';
}
?>

<!DOCTYPE html>
<html lang="ru">
    <header>
        <meta name="description" content="heating equipment">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/category.css">
    </header>
    <body>
        <main>
            <div class="content">
                <aside>
                    <div><button type="button" class="read" onclick="window.location.href = '/'">На главную</button></div>
                </aside>
                <section>
                    <?php echo $out; ?>
                </section>
            </div>
        </main>
        <footer></footer>
    </body>
</html>
