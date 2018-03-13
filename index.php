<?php
session_start();

require 'vendor/autoload.php';

if (!isset($_SESSION['token'])) {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    $_SESSION['token'] = $token;
}


$backend = new \Controller\Backend();
$frontend = new \Controller\Frontend();
$helper = new \Helper\Helper();

$helper->sessionHijackingProtection();

$content = 404;

// backend pages
try {
    if (isset($_GET['action'])) {
        if (isset($_SESSION['id'])) {
            if ($_GET['action'] == 'admin' && isset($_GET['page'])) {

                //dispatch accueil dashboard
                if ($_GET['page'] == 'login') {
                    if($_SESSION['role'] == 0)
                        $content = $backend->myComments();
                    else
                        $content = $backend->dashboard();
                }

                // pages communes
                if ($_GET['page'] == 'logout') {
                    $content = $backend->logout();
                }

                if ($_GET['page'] == 'my_comments') {
                    if (isset($_GET['delete']) && isset($_GET['token'])) {
                        $content = $backend->myComments($_GET['delete'], $_GET['token']);
                    } else {
                        $content = $backend->myComments();
                    }
                }

                if ($_GET['page'] == 'edit_my_comment' && isset($_GET['edit'])) {
                    $content = $backend->editMyComment($_GET['edit'], $_POST);
                }

                // page abonné
                if ($_SESSION['role'] == 0) {
                    if ($_GET['page'] == 'admin_request') {
                        $content = $backend->adminRequest($_POST);
                    }
                }

                // pages admin - super admin
                if ($_SESSION['role'] > 0) {
                    if ($_GET['page'] == 'dashboard') {
                        $content = $backend->dashboard();
                    }
                    if ($_GET['page'] == 'addOrEditArticle') {
                        if (isset($_GET['edit'])) {
                            $content = $backend->addOrEditArticle($_POST, $_GET['edit']);
                        } else {
                            $content = $backend->addOrEditArticle($_POST);
                        }
                    }
                    if ($_GET['page'] == 'listMyArticles') {
                        if (isset($_GET['delete']) && isset($_GET['token'])) {
                            $content = $backend->listArticles($_GET['delete'], $_GET['token'], $_SESSION['id']);
                        } else {
                            $content = $backend->listArticles(null, null, $_SESSION['id']);
                        }
                    }
                    if ($_GET['page'] == 'list_no_validated_comments') {
                        if (isset($_GET['id']) && isset($_GET['do'])) {
                            $content = $backend->listNoValidatedComment($_GET['do'], $_GET['id']);
                        } else {
                            $content = $backend->listNoValidatedComment();
                        }
                    }
                }

                // pages superadmin
                if ($_SESSION['role'] > 1) {
                    if ($_GET['page'] == 'user_list') {
                        if (isset($_GET['delete']) && isset($_GET['token'])) {
                            $content = $backend->listUser($_GET['delete'], $_GET['token']);
                        } else {
                            $content = $backend->listUser();
                        }
                    }
                    if ($_GET['page'] == 'listArticles') {
                        if (isset($_GET['delete']) && isset($_GET['token'])) {
                            $content = $backend->listArticles($_GET['delete'], $_GET['token']);
                        } else {
                            $content = $backend->listArticles();
                        }
                    }
                    if ($_GET['page'] == 'super_admin_response') {
                        if (isset($_GET['response']) && isset($_GET['id']) && isset($_GET['token'])) {
                            $content = $backend->superAdminResponse($_GET['response'], $_GET['id'], $_GET['token']);
                        } else {
                            $content = $backend->superAdminResponse();
                        }
                    }
                    if ($_GET['page'] == 'category') {
                        if (isset($_GET['delete']) && isset($_GET['token'])) {
                            $content = $backend->category((int)$_GET['delete'], $_GET['token']);
                        } else {
                            $content = $backend->category($_POST);
                        }
                    }
                }
            }
        }

        // pages connexion / inscription
        else {
            if ($_GET['page'] == 'login') {
                $content = $backend->verifUser($_POST);
            }

            if ($_GET['page'] == 'signup') {
                if (isset($_SESSION['id'])) {
                    $content = $backend->dashboard();
                } else {
                    $content = $backend->signUp($_POST);
                }
            }
        }
    }
    // frontend pages
    else {
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'show_article' && isset($_GET['id'])) {
                $content = $frontend->showArticle($_GET['id'], $_POST);
            }

            if ($_GET['page'] == 'category' && isset($_GET['id'])) {
                if (isset($_GET['p'])) {
                    $content = $frontend->index($_GET['p'], $_GET['id']);
                } else {
                    $content = $frontend->index(1, $_GET['id']);
                }
            }

            if ($_GET['page'] == 'contact') {
                $content = $frontend->contact($_POST);
            }
        }

        if (isset($_GET['p'])) {
            if (ctype_digit($_GET['p'])) {
                $content = $frontend->index(intval($_GET['p']));
            }
        }

        // index
        if (empty($_GET)) {
            $content = $frontend->index();
        }
    }

    // Affichage du contenu
    if($content != 404)
        echo $content;
    else
        throw new Exception('La page demandée n\'existe pas !');

} catch (\Exception $e) {
    $errorMessage = $e->getMessage();
    $categories = $frontend::showCategories();
    require('View/frontend/error_messages.php');
}
