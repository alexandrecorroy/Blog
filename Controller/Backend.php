<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;


use Helper\Helper;
use Model\AdminRequest;
use Model\AdminRequestManager;
use Model\Article;
use Model\ArticleManager;
use Model\Category;
use Model\CategoryManager;
use Model\CommentManager;
use Model\User;
use Model\UserManager;

class Backend
{

    public function logout()
    {
        session_destroy();
        $_SESSION['alerte'] = "Vous êtes bien déconnecté !";
        require "View/backend/login.php";
    }

    public function signUp()
    {
        require "View/backend/signup.php";
    }

    public function login($post)
    {
        if(!empty($post))
        {
            if($post['pseudo']=='' OR $post['email']=='' OR $post['password']=='')
            {
                $_SESSION['alerte'] = 'Tous les champs sont requis !';
                require "View/backend/signup.php";
            }
            else
            {
                $userManager = new UserManager();
                $user = new User($post);
                $userManager->addUser($user);
                require "View/backend/login.php";
            }

        }
        else
        {
            require "View/backend/login.php";
        }

    }

    public function verifUser($post)
    {
        $user = new UserManager();
        $user = $user->getUser($post);

        if(password_verify($post['password'], $user->getPassword()))
        {
            $_SESSION['pseudo'] = $user->getPseudo();
            $_SESSION['id'] = $user->getId();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['role'] = $user->getIdRole();

            $this::dashboard();
        }
        else
        {
            $_SESSION['alerte'] = 'Mot de passe et/ou login incorrect !';
            header("Location: index.php?action=admin&page=login");
            exit;
        }
    }

    public function dashboard()
    {
        $articleManager = new ArticleManager();
        $commentManager = new CommentManager();
        $categoryManager = new CategoryManager();

        $yms = array();
        $now = date('Y-m');

        for($x = 11; $x >= 0; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
            $ymDb = $ym.'-01';
            $ymFrance = date('m-Y', strtotime($now . " -$x month"));
            $articles = $articleManager->countArticlesByMonth($ymDb);
            $comments = $commentManager->countCommentsByMonth($ymDb);
            $yms[$x] = [
                'date' => $ym,
                'articles' => intval($articles),
                'commentaires' => intval($comments)
            ];
        }

        $countArticles = $articleManager->countArticles();
        $countValidatedComments = $commentManager->countCommentsValidated();
        $countCategories = $categoryManager->countCategories();
        $countUnvalidatedComments = $commentManager->countCommentsUnvalidated();
        require "View/backend/dashboard.php";
    }

    public function category($data = null)
    {
        $categories = new CategoryManager();

        // Test $data existe
        if($data != null)
        {
            // if int -> delete
            if(is_int($data))
            {
                $id = $data;
                $categories->deleteCategoryById($id);
                $_SESSION['info'] = "Catégorie supprimée !";
            }
            // if $_POST -> add
            else
            {
                if($data['name']!='')
                {
                    $category = new Category();
                    $category->setName($data['name']);
                    $categories->addCategory($category);
                    $_SESSION['info'] = "Catégorie ajoutée !";
                }
                else
                {
                    $_SESSION['alerte'] = "Le nom de la catégorie ne peut être vide !";
                }

            }

        }


        $categories = $categories->getCategories();
        require "View/backend/category.php";
    }

    public function listArticle($id = null)
    {
        $articleManager = new ArticleManager();
        if($id != '')
        {
            $articleManager->deleteArticleById(intval($id));
            $_SESSION['info'] = "Article supprimé !";
        }
        $articles = $articleManager->getArticles();
        $i = $articleManager->countArticles();

        require "View/backend/article_list.php";
    }

    public function addOrEditArticle($post, $id = null)
    {
        $categories = new CategoryManager();
        $categories = $categories->getCategories();
        $userManager = new UserManager();
        $user = $userManager->getUserById($_SESSION['id']);
        $articleManager = new ArticleManager();

        if(!empty($post))
        {
            if($post['title'] == '' || $post['content'] == '' || $post['headerText'] == '' || $post['idCategory'] == '')
            {
                $_SESSION['alerte'] = "Tous les champs sont obligatoires !";
            }
            elseif ($id != null)
            {

                $article = $articleManager->getArticleById(intval($id));

                $article['article']->setTitle($post['title']);
                $article['article']->setHeaderText($post['headerText']);
                $article['article']->setContent($post['content']);
                $article['article']->setIdCategory($post['idCategory']);

                $articleManager->editArticle($article['article']);

                $_SESSION['info'] = 'Article n°'.$article['article']->getId().' correctement mise a jour ! <a target="_blank" href="index.php?page=show_article&id='.$article['article']->getId().'">Voir l\'article</a>';

            }
            else
            {
                $newArticle = new Article();
                $newArticle->setTitle($post['title']);
                $newArticle->setHeaderText($post['headerText']);
                $newArticle->setContent($post['content']);
                $newArticle->setIdCategory($post['idCategory']);


                $articleManager = $articleManager->addArticle($newArticle, $user);

                $_SESSION['info'] = 'Article n°'.$articleManager.' correctement ajouté ! <a target="_blank" href="index.php?page=show_article&id='.$articleManager.'">Voir l\'article</a>';
            }

        }

        if ($id != null)
            $article = $articleManager->getArticleById(intval($id));

        require "View/backend/article_form.php";
    }

    public function adminRequest($post = null)
    {
        $userManager = new UserManager();
        $requestManager = new AdminRequestManager();
        $user = $userManager->getUserById($_SESSION['id']);

        if($post!=null)
        {
            if($post['request']=='')
                $_SESSION['alerte'] = 'Il faut écrire vos motivations !';
            else
            {
                $request = new AdminRequest();
                $request->setIdUser($user->getId());
                $request->setRequest($post['request']);
                $request->setStatus(0);

                $requestManager->addAdminRequest($request);
                $_SESSION['info'] = 'La demande a bien été envoyée !';
            }


        }



        $request = $requestManager->getAdminRequest($user);

        require "View/backend/admin_request.php";
    }

    public function superAdminResponse($response = null, $id = null)
    {

        if($response!= null AND $id!=null)
        {
            $adminRequestManager = new AdminRequestManager();
            if($response=='true')
            {
                $userManager = new UserManager();
                $adminRequest = $adminRequestManager->getAdminRequestById(intval($id));

                $adminRequestManager->deleteAdminRequestById(intval($id));
                $userManager->setRoleAdminUserById($adminRequest->getIdUser());

                $user = $userManager->getUserById($adminRequest->getIdUser());

                $helper = new Helper();
                $helper->sendMail($user->getPseudo(), $user->getEmail(), 'Devenir administrateur', 'Votre demande pour devenir administrateur a été acceptée !');


                $_SESSION['info'] = 'La demande a bien été acceptée !';
            }
            else
            {

                $adminRequestManager->rejectAdminRequestById(intval($id));
                $_SESSION['info'] = 'La demande a bien été refusée !';

            }
        }

        $requestManager = new AdminRequestManager();
        $requests = $requestManager->getAdminRequests();

        require "View/backend/super_admin_response.php";
    }

    public function myComments($idToDelete = null)
    {

        $user = new UserManager();
        $user = $user->getUserById($_SESSION['id']);

        $commentManager = new CommentManager();

        if(!is_null($idToDelete))
            if(self::canDeletedOrEditThisComment($idToDelete, $_SESSION['id']))
            {
                $commentManager->deleteCommentById($idToDelete);
                $_SESSION['info'] = 'Votre commentaire a bien été supprimé !';
            }
                $comments = $commentManager->listCommentsByUserId($user);

        require "View/backend/my_comments.php";
    }

    //        test if comment owner is me
    static public function canDeletedOrEditThisComment($idComment, $idUserInSession)
    {

        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentById($idComment);

        $idUserInComment = $comment->getIdUser();
        if(intval($idUserInComment)==intval($idUserInSession))
            return true;
        else
            echo 'Le hack c\est pas bien !';
            die;
    }

    public function editMyComment($idArticle, $post = null)
    {

        if(self::canDeletedOrEditThisComment($idArticle, $_SESSION['id']))
        {
            $commentManager = new CommentManager();
            $comment = $commentManager->getCommentById($idArticle);

            if($post!=null)
            {
                if($post['title']=='' OR $post['content'] =='')
                    $_SESSION['alerte'] = 'Tous les champs sont obligatoires !';
                else
                {
                    $comment->setTitle($post['title']);
                    $comment->setContent($post['content']);

                    if($_SESSION['role']>0)
                        $comment->setIsValidated(0);

                    $commentManager->editComment($comment);
                    $_SESSION['info'] = 'Le commentaire a bien été modifié !';
                }
            }

            require "View/backend/edit_my_comment.php";
        }
    }

    public function listNoValidatedComment($action = null, $idComment = null)
    {
        $commentManager = new CommentManager();

        if($action!=null AND $idComment!=null)
        {

            if($action=='validate')
            {
                $commentManager->valideComment($idComment);
                $_SESSION['info'] = 'Commentaire validé !';
            }
            elseif($action=='delete')
            {
                $commentManager->deleteCommentById($idComment);
                $_SESSION['info'] = 'Commentaire supprimé !';
            }
        }

        $comments = $commentManager->listCommentsNoValidated();

        require "View/backend/comments_no_validated.php";
    }

    public function listUser($idToDelete = null)
    {
        $userManager = new UserManager();
        if($idToDelete!=null and $idToDelete!='')
        {
            $user = $userManager->getUserById($idToDelete);
            if($user->getRole()<2);
            {
                $userManager->deleteUserById($user);
                $_SESSION['info'] = 'Membre supprimé !';
            }
        }


        $users = $userManager->getAllUser();
        require "View/backend/user_list.php";
    }

    static public function checkForAdminRequest()
    {
        if(isset($_SESSION['id']))
        {
            if($_SESSION['role']>1)
            {
                $adminRequestManager = new AdminRequestManager();

                if(intval($adminRequestManager->countAdminRequestInStandBy())>0)
                    return true;
            }

        }

    }

}
