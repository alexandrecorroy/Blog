<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;


use Model\ArticleManager;
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
            }
            // if $_POST -> add
            else
            {
                $category = new Category();
                $category->setName($data['name']);
                $categories->addCategory($category);
            }

        }


        $categories = $categories->getCategories();
        require "/View/Backend/category.php";
    }

    public function listArticle()
    {

    }

    public function addArticle($post)
    {
        if(!
        empty($post))
        {
            $userManager = new UserManager();
            $user = $userManager->getUserById($_SESSION['id']);
            $article = new Article($post);

            $articleManager = new ArticleManager();

            $articleManager->addArticle($article, $user);
        }

        require "/View/Backend/article_form.php";
    }

}