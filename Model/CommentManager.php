<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 15:50
 */
namespace Model;

class CommentManager extends Manager
{
    public function __construct()
    {
        $this->db = new Manager();
    }

    public function addComment(Comment $comment)
    {
        $this->db->execute("INSERT INTO comment (title, content, creation_date, id_article, id_user, is_validated)
                            VALUES (:title, :content, now(), :id_article, :id_user, :is_validated)",
            array(
                'title' => $comment->getTitle(),
                'content' => $comment->getContent(),
                'id_article' => $comment->getIdArticle(),
                'id_user' => $comment->getIdUser(),
                'is_validated' => $comment->getisValidated(),
            ));
    }
}