<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 14:14
 */
namespace Model;

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
        $userManager = new UserManager();
        $categoryManager = new CategoryManager();

        $datas = $this->db->fetchAll("SELECT * FROM article ORDER BY id DESC");

        $i=0;
        foreach ($datas as $data) {
            $articles[$i]['article'] = new Article($data);
            $articles[$i]['user'] = $userManager->getUserById($articles[$i]['article']->getIdUser());
            $articles[$i]['category'] = $categoryManager->getCategoryById($articles[$i]['article']->getIdCategory());
            $i++;
        }

        return $articles;
    }

    public function getArticlesWithLimit($limit, $offset, $idCategory = null)
    {
        $userManager = new UserManager();
        $categoryManager = new CategoryManager();

        if ($idCategory==null)
            $datas = $this->db->fetchAll("SELECT * FROM article ORDER BY id DESC LIMIT $limit OFFSET $offset");
        else
            $datas = $this->db->fetchAll("SELECT * FROM article WHERE id_category = :idCategory ORDER BY id DESC LIMIT $limit OFFSET $offset", array('idCategory' => $idCategory));


        $i=0;
        foreach ($datas as $data) {
            $articles[$i]['article'] = new Article($data);
            $articles[$i]['user'] = $userManager->getUserById($articles[$i]['article']->getIdUser());
            $articles[$i]['category'] = $categoryManager->getCategoryById($articles[$i]['article']->getIdCategory());
            $i++;
        }

        return $articles;
    }

    public function countArticles()
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM article");

        return $i['COUNT(*)'];
    }

    public function countArticlesByCategory($id)
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM article WHERE id_category = :id", array('id' => $id));

        return $i['COUNT(*)'];
    }

    public function getArticleById($id)
    {
        $userManager = new UserManager();
        $categoryManager = new CategoryManager();

        $data = $this->db->fetch("SELECT * FROM article WHERE id = :id", array('id' => $id));

        $article['article'] = new Article($data);
        $article['user'] = $userManager->getUserById($article['article']->getIdUser());
        $article['category'] = $categoryManager->getCategoryById($article['article']->getIdCategory());

        return $article;
    }


    public function deleteArticleById($id)
    {
        $this->db->execute("DELETE FROM article WHERE id = :id", array('id' => $id));
    }

    public function setNullArticleOnDeleteCategoryId($id)
    {
        $this->db->execute("UPDATE article
                                    SET id_category = 0
                                    WHERE id_category = :id",
            array(
                'id' => $id
            ));
    }


}