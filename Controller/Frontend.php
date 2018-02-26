<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;


use Model\ArticleManager;
use Model\Comment;
use Model\CommentManager;
use Model\UserManager;

CONST LIMIT = 10;

class Frontend
{

    static public function countPages()
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->countArticles();

        return ceil($articles/10);
    }

    public function index($page = 1)
    {

        $offset = ($page*10)-LIMIT;
        if ($offset<0)
            $offset=0;
        if($page>self::countPages() OR $page==0)
        {
            header( "HTTP/1.1 404 Not Found" );
            exit;
        }


        $userManager = new UserManager();
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticlesWithLimit(LIMIT, $offset);
        $pages = self::countPages();
        require "/View/frontend/index.php";
    }

    public function showArticle($id, $post = null)
    {
        if(!empty($post))
        {
            if($post['title'] == '' || $post['content'] == '')
            {
                $_SESSION['alerte'] = 'Tous les champs sont obligatoires !';
            }
            else
            {
                $commentManager = new CommentManager();
                $userManager = new UserManager();
                $user = $userManager->getUserById($_SESSION['id']);
                $comment = new Comment();

                $comment->setTitle($post['title']);
                $comment->setContent($post['content']);
                $comment->setIdUser($user->getId());
                if($user->getRole() == 'admin' || $user->getRole() == 'superadmin')
                    $comment->setIsValidated(1);
                else
                    $comment->setIsValidated(0);
                $comment->setIdArticle($id);

                $commentManager->addComment($comment);

                if($user->getRole() == 'admin' || $user->getRole() == 'superadmin')
                    $_SESSION['info'] = 'Commentaire ajouté !';
                else
                    $_SESSION['info'] = 'Commentaire en attente de validation par un administrateur !';
            }


        }

        $commentManager = new CommentManager();
        $totalComments = $commentManager->countCommentsByArticle(intval($id));

        if($commentManager->countCommentsByArticle(intval($id))>0)
            $comments = $commentManager->listCommentsByArticle($id);

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        require "/View/frontend/show_article.php";
    }

}