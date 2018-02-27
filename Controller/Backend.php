<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;


use Model\Article;
use Model\ArticleManager;
use Model\Category;
use Model\CategoryManager;
use Model\UserManager;

class Backend
{

    public function logout()
    {
        session_destroy();
        $_SESSION['alerte'] = "Vous êtes bien déconnecté !";
        require "/View/backend/login.php";
    }

    public function signIn()
    {
        require "/View/backend/signin.php";
    }

    public function login($post)
    {
        if($post)
        {
            $user = new UserManager();
            $user->addUser($post);
        }
        require "/View/backend/login.php";
    }

    public function verifUser($post)
    {
        $user = new UserManager();
        $user = $user->getUser($post);

        if($user->getId())
        {
            $_SESSION['pseudo'] = $user->getPseudo();
            $_SESSION['id'] = $user->getId();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['role'] = $user->getRole();

            require "/View/backend/admin.php";
        }
        else
        {
            $_SESSION['alerte'] = 'Mot de passe et/ou login incorrect !';
            header("Location: index.php?action=admin&page=login");
            exit;
        }
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
        require "/View/backend/category.php";
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

        require "/View/backend/article_list.php";
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

        require "/View/backend/article_form.php";
    }

}