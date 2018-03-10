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
    private $_id;
    private $_title;
    private $_content;
    private $_creationDate;
    private $_editDate;
    private $_idArticle;
    private $_idUser;
    private $_isValidated;

    public function __construct($valeurs = array())
    {
        if (is_array($valeurs)) {
            $this->hydrate($valeurs);
        }
    }

    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            $methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));

            if (is_callable(array($this, $methode))) {
                $this->$methode($valeur);
            }
        }
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return htmlspecialchars($this->_title);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return htmlspecialchars($this->_content);
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        $helper = new Helper();
        return $helper->formatDate($this->_creationDate);
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getEditDate()
    {
        $helper = new Helper();
        return $helper->formatDate($this->_editDate);
    }

    /**
     * @param mixed $editDate
     */
    public function setEditDate($editDate)
    {
        $this->_editDate = $editDate;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->_idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle)
    {
        $this->_idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->_idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->_idUser = $idUser;
    }

    /**
     * @return mixed
     */
    public function getIsValidated()
    {
        return $this->_isValidated;
    }

    /**
     * @param mixed $isValidated
     */
    public function setIsValidated($isValidated)
    {
        $this->_isValidated = $isValidated;
    }
}
