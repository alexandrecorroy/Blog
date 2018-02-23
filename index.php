<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 13:59
 */
session_start();

function __autoload($class_name)
{
    include $class_name. '.php';
}

$backend = new \Controller\Backend();

if (isset($_GET['action'])) {
    // backend
    if ($_GET['action'] == 'admin' && isset($_GET['page']))
    {

        if ($_GET['page'] == 'logout') {
            $content = $backend->logout();
        }
        if ($_GET['page'] == 'login') {
            if(isset($_SESSION['id']))
                $content = require "/View/backend/admin.php";
            else
            $content = $backend->login($_POST);
        }
        if ($_GET['page'] == 'signin') {
            if(isset($_SESSION['id']))
                $content = require "/View/backend/admin.php";
            else
            $content = $backend->signIn();
        }
        if ($_GET['page'] == 'dashboard') {
            if(isset($_SESSION['id']))
                $content = require "/View/backend/admin.php";
            else
                $content = $backend->verifUser($_POST);
        }
        if ($_GET['page'] == 'category') {
            if(isset($_GET['delete']))
                $content = $backend->category((int)$_GET['delete']);
            else
                $content = $backend->category($_POST);
        }
        if ($_GET['page'] == 'addOrEditArticle')
        {
            if(isset($_GET['edit']))
                $content = $backend->addOrEditArticle($_POST, $_GET['edit']);
            else
                $content = $backend->addOrEditArticle($_POST);
        }
        if ($_GET['page'] == 'listArticle')
        {
            if(isset($_GET['delete']))
                $content = $backend->listArticle($_GET['delete']);
            else
                $content = $backend->listArticle();
        }
    }
    // frontend
    else
    {
        echo 'frontend';
        exit;
    }

}
// erreurs 404 not fount
else {
    $content = header('HTTP/1.1 404 Not Found');
}

echo $content;
