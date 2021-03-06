<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;

use Helper\Helper;
use Model\ArticleManager;
use Model\CategoryManager;
use Model\Comment;
use Model\CommentManager;
use Model\UserManager;

class Frontend
{
    const LIMIT = 10;

    public static function showCategories()
    {
        $categoryManager = new CategoryManager();
        return $categoryManager->getCategories();
    }

    public static function countPages($idCategory = null)
    {
        $articleManager = new ArticleManager();
        if ($idCategory===null) {
            $articles = $articleManager->countArticles();
        } else {
            $articles = $articleManager->countArticlesByCategory($idCategory);
        }
        return ceil($articles/10);
    }

    public function index($page = 1, $idCategory = null)
    {
        $offset = ($page*10)-$this::LIMIT;
        if ($offset<0) {
            $offset=0;
        }
        if ($page>self::countPages() || $page==0) {
            throw new \Exception("Cette page n'existe pas !");
        }


        $userManager = new UserManager();
        $articleManager = new ArticleManager();
        if ($idCategory===null) {
            $articles = $articleManager->getArticlesWithLimit(intval($this::LIMIT), intval($offset));
            $pages = self::countPages();
        } else {
            $articles = $articleManager->getArticlesWithLimit(intval($this::LIMIT), intval($offset), intval($idCategory));
            $pages = self::countPages($idCategory);
        }

        if ($articles===null) {
            throw new \Exception('Pas d\'articles à afficher !');
        }

        require "View/frontend/index.php";
    }

    public function showArticle($id, $post = null)
    {
        if (!empty($post)) {
            if ($post['title'] == '' || $post['content'] == '') {
                $_SESSION['alerte'] = 'Tous les champs sont obligatoires !';
            } else {
                $commentManager = new CommentManager();
                $userManager = new UserManager();
                $user = $userManager->getUserById($_SESSION['id']);
                $comment = new Comment();

                $comment->setTitle($post['title']);
                $comment->setContent($post['content']);
                $comment->setIdUser($user->getId());
                if ($user->getIdRole()>0) {
                    $comment->setStatus(1);
                } else {
                    $comment->setStatus(0);
                }
                $comment->setIdArticle($id);

                $commentManager->addComment($comment);

                if ($user->getIdRole()>0) {
                    $_SESSION['info'] = 'Commentaire ajouté !';
                } else {
                    $_SESSION['info'] = 'Commentaire en attente de validation par un administrateur !';
                }
            }
        }

        $commentManager = new CommentManager();
        $totalComments = $commentManager->countCommentsByArticle(intval($id));

        if ($commentManager->countCommentsByArticle(intval($id))>0) {
            $comments = $commentManager->listCommentsByArticle($id);
        }

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        if (!$article['article']->getTitle()) {
            throw new \Exception('L\'article demandé n\'existe pas !');
        }

        require "View/frontend/show_article.php";
    }

    public function contact($post = null)
    {
        if (!empty($post)) {
            if ($post['name']=='' || $post['email']=='' || $post['message'] == '' || $post['subject'] =='') {
                $_SESSION['alerte'] = 'Tous les champs sont obligatoires !';
            } else {
                $helper = new Helper();
                $helper->sendMail($post['name'], $post['email'], $post['subject'], $post['message']);
                $_SESSION['info'] = 'Le message a bien été envoyé !';
            }
        }



        require "View/frontend/contact.php";
    }
}
