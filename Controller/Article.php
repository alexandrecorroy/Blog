<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 17:19
 */
namespace Controller;

class Article
{

    protected $id;
    protected $title;
    protected $creationDate;
    protected $editDate;
    protected $headerText;
    protected $content;
    protected $idUser;
    protected $idCategory;


    public function __construct(array $data = null)
    {
        $this->id = intval($data['id']);
        $this->title = $data['title'];
        $this->creationDate = $data['creation_date'];
        $this->editDate = $data['edit_date'];
        $this->headerText = $data['header_text'];
        $this->content = $data['content'];
        $this->idUser = intval($data['id_user']);
        $this->idCategory = intval($data['id_category']);
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param mixed $idCategory
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = intval($idCategory);
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
        if($title!='')
        $this->title = htmlentities($title);
    }

    /**
     * @return mixed
     */
    public function getEditDate()
    {
        return $this->editDate;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        if($content!='')
        $this->content = htmlentities($content);
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
    public function getCreationDate()
    {
        return $this->creationDate;
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
    public function getHeaderText()
    {
        return $this->headerText;
    }

    /**
     * @param mixed $headerText
     */
    public function setHeaderText($headerText)
    {
        if($headerText!='')
        $this->headerText = htmlentities($headerText);
    }




}