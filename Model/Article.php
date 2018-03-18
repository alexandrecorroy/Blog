<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 17:19
 */
namespace Model;

use Helper\Helper;

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


    public function __construct($valeurs = array())
    {
        if(is_array($valeurs))
            $this->hydrate($valeurs);
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
            $methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));

            if (is_callable(array($this, $methode)))
            {
                $this->$methode($valeur);
            }
        }
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
        return htmlspecialchars($this->title);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if($title!='')
        $this->title = htmlspecialchars($title);
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
    public function getContent()
    {
        return strip_tags($this->content, '<strike><sup><sub><a><p><br><li><table><tbody><tr><th><td></tr><u><i><b><span><h1><h2><h3><h4><h5><h6>');
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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
    public function getHeaderText()
    {
        return htmlspecialchars($this->headerText);
    }

    /**
     * @param mixed $headerText
     */
    public function setHeaderText($headerText)
    {
        $this->headerText = $headerText;
    }




}