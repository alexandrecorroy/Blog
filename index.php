<?php
session_start();

require 'vendor/autoload.php';

$backend = new \Controller\Backend();
$frontend = new \Controller\Frontend();

$content = header("HTTP/1.0 404 Not Found");

// backend pages
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'admin' && isset($_GET['page']))
    {

        if ($_GET['page'] == 'logout') {
            $content = $backend->logout();
        }
        if ($_GET['page'] == 'login') {
            if(isset($_SESSION['id']))
                if($_SESSION['role']>0)
                    $content = $backend->dashboard();
                else
                    header("Location: index.php?action=admin&page=my_comments");
            else
                $content = $backend->login($_POST);
        }
        if ($_GET['page'] == 'signup') {
            if(isset($_SESSION['id']))
                $content = $backend->dashboard();
            else
                $content = $backend->signUp();
        }
        if ($_GET['page'] == 'dashboard') {
            if(isset($_SESSION['id']))
                if($_SESSION['role']>0)
                    $content = $backend->dashboard();
                else
                    header("Location: index.php?action=admin&page=my_comments");
            else
                $content = $backend->verifUser($_POST);
        }
        if ($_GET['page'] == 'admin_request')
        {
            if($_SESSION['role'] == 0)
                $content = $backend->adminRequest($_POST);
        }
        if ($_GET['page'] == 'my_comments')
        {
            if(isset($_GET['delete']))
                $content = $backend->myComments($_GET['delete']);
            else
                $content = $backend->myComments();
        }
        if ($_GET['page'] == 'edit_my_comment' AND isset($_GET['edit']))
        {
            $content = $backend->editMyComment($_GET['edit'], $_POST);
        }

        if(isset($_SESSION['id']))
        {
            if($_SESSION['role']>0)
            {
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
                if ($_GET['page'] == 'list_no_validated_comments')
                {
                    if(isset($_GET['id']) AND isset($_GET['do']))
                        $content = $backend->listNoValidatedComment($_GET['do'], $_GET['id']);
                    else
                        $content = $backend->listNoValidatedComment();
                }
            }
            if($_SESSION['role']>1)
            {
                if ($_GET['page'] == 'user_list')
                {
                    if(isset($_GET['delete']))
                        $content = $backend->listUser($_GET['delete']);
                    else
                        $content = $backend->listUser();
                }
                if ($_GET['page'] == 'super_admin_response')
                {

                    if(isset($_GET['response']) and isset($_GET['id']))
                        $content = $backend->superAdminResponse($_GET['response'], $_GET['id']);
                    else
                        $content = $backend->superAdminResponse();
                }
                if ($_GET['page'] == 'category') {
                    if(isset($_GET['delete']))
                        $content = $backend->category((int)$_GET['delete']);
                    else
                        $content = $backend->category($_POST);
                }
            }
        }



    }
}
// frontend pages
elseif (isset($_GET['page']))
{
    if ($_GET['page'] == 'show_article' && isset($_GET['id']))
        $content = $frontend->showArticle($_GET['id'], $_POST);

    if ($_GET['page'] == 'category' && isset($_GET['id']))
        if(isset($_GET['p']))
            $content = $frontend->index($_GET['p'], $_GET['id']);
        else
            $content = $frontend->index(1, $_GET['id']);

    if ($_GET['page'] == 'contact')
        $content = $frontend->contact($_POST);

}
elseif (isset($_GET['p']))
{
    if (ctype_digit($_GET['p']))
    {
        $content = $frontend->index(intval($_GET['p']));
    }
}
elseif (empty($_GET))
{
    // index
    $content = $frontend->index();
}

echo $content;
