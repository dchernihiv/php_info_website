<?php
/** update page template **/

$btn = 'Обновить';

if (isset($_POST['submit'])) {

    $id = trim($_POST['id']);
    $cat_title = explode('/', trim($_POST['cid']))[0];
    $cid = explode('/', trim($_POST['cid']))[1];
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $min_descr = trim($_POST['min_descr']);
    $description = trim($_POST['description']);
 
    if ($_FILES['image']['tmp_name']) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'static/image/'.$_FILES['image']['name']); 
        $image = update_image_name( $_FILES['image']['name'] );
        unlink('static/image/' . $result['image']);
    } else {
        $image = $result['image'];
    }

    $update = updateArticle($id, $cat_title, $cid, $title, $url, $min_descr, $description, $image);
    if ($update) {
        header('Location: /admin'); 
    } else {
        echo 'Ошибка обновления статьи';
    }
    
} 

require_once '_form.php';
