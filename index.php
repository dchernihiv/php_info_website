<?php

require_once 'function/function_db.php';
require_once 'function/function.php';

@$route = explode('/', $_GET['route']);

switch ($route) {
  case ($route[0] === ''):
    $query = 'select title, url, min_descr, image from info';
    $result = select($query);
    require_once 'template/main.php';
    break;

  case ( $route[0] == 'article' && isset($route[1]) ):
    $query = 'select cid, title, min_descr, description, image from info where url = "'.$route[1].'"';
    $result = select($query);
    require_once 'template/article.php';
    break;

  case ( $route[0] == 'category' && isset($route[1]) ):
    $query='select * from info where cid ='.$route[1];
    $result = select($query);
    require_once 'template/category.php';
    break;

  case ( $route[0] == 'registration'):
    require_once 'template/registration.php';
    break;

  case ( $route[0] == 'login'):
    require_once 'template/login.php';
    break;

  case @($route[0] == 'admin' && $route[1] == 'create'):
    if (getUser()) {
      $query = 'select cat_title, cid from info';
      $category = select($query);
      require_once 'template/create.php';
    } else{
      header('Location: /');
    }
    break;

  case @( $route[0] == 'admin' && $route[1] == 'update' && isset($route[2]) ):
    if (getUser()) {
      $query = 'select * from info where id='.$route[2];
      $result = select($query)[0];
      $query = 'select cat_title, cid from info';
      $category = select($query);
      require_once 'template/update.php';
    } else{
      header('Location: /');
    }
    break;

  case @( $route[0] == 'admin' && $route[1] == 'delete' && isset($route[2])):
    if (getUser()) {
      $query = 'select image from info where id = '.$route[2];
      $file = select($query)[0];
      $query = 'delete from info where id = '.$route[2];
      $result = modify_db($query);
      deleteFile($file);
      header('Location: /admin');
    } else{
      header('Location: /');
    }
    break;

  case ( $route[0] == 'admin'):
    $query = 'select * from info';
    $result = select($query);
    require_once 'template/admin.php';
    break;

  case ( $route[0] == 'logout'):
    require_once 'template/logout.php';
    break;

  default :
  require_once 'template/404.php';
  break;
} 




