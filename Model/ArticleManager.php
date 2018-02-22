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

        return $this->db->lastId();
    }

    public function editArticle(Article $article)
    {

        $this->db->execute("UPDATE article
                                    SET title = :title, header_text = :header_text, content = :content, edit_date = now(), id_category = :id_category
                                    WHERE id = :id",
            array(
                'title' => $article->getTitle(),
                'header_text' => $article->getHeaderText(),
                'content' => $article->getContent(),
                'id_category' => $article->getIdCategory(),
                'id' => $article->getId()
            ));

        return $this->db->lastId();
    }


    public function getArticles()
    {

        $datas = $this->db->fetchAll("SELECT * FROM article ORDER BY id DESC");

        $i=0;
        foreach ($datas as $data) {
            $articles[$i] = new Article($data);
            $i++;
        }

        return $articles;
    }

    public function countArticles()
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM article");

        return $i['COUNT(*)'];
    }

    public function getArticleById($id)
    {

        $article = $this->db->fetch("SELECT * FROM article WHERE id = :id", array('id' => $id));

        $article = new Article($article);

        return $article;
    }


    public function deleteArticleById($id)
    {
        $this->db->execute("DELETE FROM article WHERE id = :id", array('id' => $id));
    }


}