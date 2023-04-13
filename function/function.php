<?php
require_once 'function_db.php';

function update_image_name($imgName)
{
    $random_name = '';
    for ($j = 0; $j < 8; $j++) {
        $random_name .= mt_rand(0, 9);
    }
    $new_name = $random_name . '_' . $imgName;
    $name = rename('static/image/' . $imgName, 'static/image/' . $new_name);
    if (!$name) return false;
    else return $new_name;
}

function loginExist($login)
{
    $query = 'select login from users where login = "' . $login . '"';
    $result = select($query);
    if (count($result) !== 0) {
        return false;
    }
    return true;
}

function createUser($login, $password)
{
    $login = trim($login);
    $password = md5(trim($password));
    $query = 'insert into users (login, password) values ("' . $login . '", "' . $password . '")';
    return modify_db($query);
}

function findUser($login, $password)
{
    $login = trim($login);
    $password = md5(trim($password));
    $query = 'select id, login, password from users where login ="' . $login . '" && password ="' . $password . '"';
    return select($query);
}

function getRandomString()
{
    $template = 'QWERTASDFZXClkjhcvbet123456789';
    $rand_string = '';
    for ($i = 0; $i <= 10; $i++) {
        $randElement = mt_rand(0, strlen($template));
        $rand_string .= substr($template, $randElement, 1);
    }
    return $rand_string;
}

function updateUser($hash, $ip, $id)
{
    if (is_null($ip)) {
        $query = 'update users set hash = "' . $hash . '" where id = ' . $id;
    } else {
        $query = 'update users set hash = "' . $hash . '", ip=INET_ATON("' . $ip . '") where id = ' . $id;
    }
    return modify_db($query);
}

function getUser()
{
    if (isset($_COOKIE['id']) && isset($_COOKIE['hash'])) {
        $query = 'select id, login, hash, inet_ntoa(ip) as ip from users where id =' . intval($_COOKIE['id']);
        $user = select($query);
        if (count($user) === 0) {
            return false;
        } else {
            if ($_COOKIE['hash'] !== $user[0]['hash']) {
                clearCookie();
                return false;
            }
            if (!is_null($user[0]['ip'])) {
                if ($user[0]['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    clearCookie();
                    return false;
                }
            }
            $_GET['login'] = $user[0]['login'];
            return true;
        }
    } else {
        clearCookie();
        return false;
    }
}

function clearCookie()
{
    setcookie('id', '', time() - 60 * 60 * 24 * 30, '/');
    setcookie('hash', '', time() - 60 * 60 * 24 * 30, '/');
    unset($_GET['login']);
}

// Delete files from file system after they are deleted in data base
function deleteFile($file)
{
    $dir = opendir('static/image');
    $array = [];
    while (($elem = readdir($dir)) !== false) {
        if ($elem != '.' && $elem != '..') {
            $array[] = $elem;
        }
    }
    closedir($dir);

    $cross = array_values(array_intersect($array, array_values($file)));
    if (count($cross) !== 0) {
        for ($i = 0; $i < count($cross); $i++) {
            unlink('static/image/' . $cross[$i]);
        }
    }
}

function getCid($category)
{
    $cid = '';
    if (!count($category)) {
        $cid = 1;
    } else {
        for ($i = 0; $i < count($category); $i++) {
            if ($category[$i]['cat_title'] === explode('/', $_POST['cid'])[0]) {
                $cid = explode('/', trim($_POST['cid']))[1];
                break;
            } elseif ($i < count($category) + 1) continue; 
        }
        if (!$cid) {
            $cid_array = array_column($category, 'cid');
            $cid = max($cid_array) + 1;
        }   
    }
    return $cid;
}

function createArticle($id, $cat_title, $cid, $title, $url, $min_descr, $description, $image)
{
    $name = update_image_name($image);
    $query = 'insert into info (id, cat_title, cid, title, url, min_descr, description, image)
    values (' . $id . ',"' . $cat_title . '",' . $cid . ',"' . $title . '","' . $url . '","' . $min_descr . '","' . $description . '","' . $name . '")';
    $res = modify_db($query);
    if ($res) return true;
    else return false;
}

function updateArticle($id, $cat_title, $cid, $title, $url, $min_descr, $description, $image)
{
    $query = 'update info set id=' . $id . ', cat_title="' . $cat_title . '", cid=' . $cid . ', title="' . $title . '",
    url="' . $url . '", min_descr="' . $min_descr . '", description="' . $description . '", image="' . $image . '"
    where id=' . $id;
    $res = modify_db($query);

    $query = 'select image from info';
    $file = select($query);
    deleteFile($file);

    if ($res) return true;
    else return false;
}

function logout()
{
    clearCookie();
    header('Location: /');
}
