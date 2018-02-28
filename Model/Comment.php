<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:41
 */

namespace Model;


use Helper\Helper;

class Comment
{

    protected $id;
    protected $title;
    protected $content;
    protected $creationDate;
    protected $editDate;
    protected $idArticle;
    protected $idUser;
    protected $isValidated;

    public function __construct($data = null)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->creationDate = $data['creation_date'];
        $this->editDate = $data['edit_date'];
        $this->idArticle = $data['id_article'];
        $this->idUser = $data['id_user'];
        $this->isValidated = $data['is_validated'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = htmlentities($title);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = htmlentities($content);
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        $helper = new Helper();
        return $helper->formatDate($this->creationDate);
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getEditDate()
    {
        $helper = new Helper();
        return $helper->formatDate($this->editDate);
    }

    /**
     * @param mixed $editDate
     */
    public function setEditDate($editDate)
    {
        $this->editDate = $editDate;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getisValidated()
    {
        return $this->isValidated;
    }

    /**
     * @param mixed $isValidated
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;
    }



}