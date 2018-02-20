<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 14:14
 */
namespace Model;

use Controller\Article;
use Controller\User;

class ArticleManager extends Manager
{

    public function __construct()
    {
        $this->db = new Manager();
    }

    public function addArticle(Article $article, User $user)
    {
        $this->db->execute("INSERT INTO article (title, header_text, content, creation_date, id_user, id_category)
                            VALUES (:title, :header_text, :content, now(), :id_user, :id_category)",
            array(
                'title' => $article->getTitle(),
                'header_text' => $article->getHeaderText(),
                'content' => $article->getContent(),
                'id_user' => $user->getId(),
                'id_category' => $article->getIdCategory()
            ));
    }

}