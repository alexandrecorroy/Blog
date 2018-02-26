<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:38
 */

namespace Controller;


use Model\ArticleManager;
use Model\UserManager;

class Frontend
{

    public function index()
    {
        $userManager = new UserManager();
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticles();
        require "/View/frontend/index.php";
    }

}