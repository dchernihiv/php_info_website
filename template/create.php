<?php

/** create page template **/

$btn = 'Создать';

$result = [
    "id" => '',
    "cat_title" => '',
    "cid" => '',
    "title" => '',
    "url" => '',
    "min_descr" => '',
    "description" => '',
    "image" => '',
];

if (isset($_POST['submit'])) {

    $id = trim($_POST['id']);
    $cat_title = explode('/', trim($_POST['cid']))[0];
    $cid = getCid($category);
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $min_descr = trim($_POST['min_descr']);
    $description = trim($_POST['description']);
    move_uploaded_file($_FILES['image']['tmp_name'], 'static/image/' . $_FILES['image']['name']);
    $image = $_FILES['image']['name'];

    $create = createArticle($id, $cat_title, $cid, $title, $url, $min_descr, $description, $image);
    if ($create) {
        header('Location: /admin');
    } else {
        echo 'Ошибка создания статьи';
    }
}

require_once '_form.php';


