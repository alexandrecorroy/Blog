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
        $this->db->execute(
            "INSERT INTO comment (title, content, creation_date, id_article, id_user, status)
                            VALUES (:title, :content, now(), :id_article, :id_user, :status)",
            array(
                'title' => $comment->getTitle(),
                'content' => $comment->getContent(),
                'id_article' => $comment->getIdArticle(),
                'id_user' => $comment->getIdUser(),
                'status' => $comment->getStatus(),
            )
        );
    }

    public function countCommentsByArticle($id)
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM comment WHERE id_article = :id AND status = 1", array('id' => $id));

        return $i['COUNT(*)'];
    }

    public function countCommentsByMonth($month)
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM comment WHERE status = 1 AND MONTH(creation_date) = MONTH(:month)", array('month'=>$month));

        return $i['COUNT(*)'];
    }

    public function countCommentsValidated()
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM comment WHERE status = 1");

        return $i['COUNT(*)'];
    }

    public function countCommentsUnvalidated()
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM comment WHERE status = 0");

        return $i['COUNT(*)'];
    }

    public function listCommentsByArticle($id)
    {
        $userManager = new UserManager();

        $datas = $this->db->fetchAll("SELECT * FROM comment WHERE id_article = :id AND status = 1 ORDER BY id DESC", array('id' => $id));

        $comments=null;
        $i = 0;
        foreach ($datas as $comment) {
            $comments[$i]['comment'] = new Comment($comment);
            $comments[$i]['user'] = $userManager->getUserById($comments[$i]['comment']->getIdUser());
            $i++;
        }


        return $comments;
    }

    public function listCommentsByUserId(User $user)
    {
        $datas = $this->db->fetchAll("SELECT * FROM comment WHERE id_user = :idUser ORDER BY id DESC", array('idUser' => $user->getId()));

        $comments = null;
        $i=0;
        foreach ($datas as $data) {
            $comments[$i] = new Comment($data);
            $i++;
        }

        return $comments;
    }

    public function getCommentById($id)
    {
        $data = $this->db->fetch("SELECT * FROM comment WHERE id = :id", array('id' => $id));
        $comment = new Comment($data);
        return $comment;
    }

    public function deleteCommentById($id)
    {
        $this->db->execute("DELETE FROM comment WHERE id = :id", array('id' => $id));
    }

    public function valideComment($id)
    {
        $this->db->execute(
            "UPDATE comment
                                    SET status = 1
                                    WHERE id = :id",
            array(
                'id' => $id
            )
        );
    }

    public function editComment(Comment $comment)
    {
        $this->db->execute(
            "UPDATE comment
                                    SET title = :title, content = :content, edit_date = now(), status = :status
                                    WHERE id = :id",
            array(
                'content' => $comment->getContent(),
                'title' => $comment->getTitle(),
                'id' => $comment->getId(),
                'status' => $comment->getStatus()
            )
        );
    }

    public function listCommentsNoValidated()
    {
        $datas = $this->db->fetchAll("SELECT * FROM comment WHERE status = 0 ORDER BY id ASC");

        $userManager = new UserManager();

        $comments=null;
        $i=0;
        foreach ($datas as $data) {
            $comments[$i]['comment'] = new Comment($data);
            $comments[$i]['user'] = $userManager->getUserById($comments[$i]['comment']->getIdUser());
            $i++;
        }

        return $comments;
    }
}
