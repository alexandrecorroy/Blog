<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 17:41
 */
namespace Model;

class User
{
    private $_id;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_idRole;

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
    public function getPseudo()
    {
        return htmlspecialchars($this->_pseudo);
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->_pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return htmlspecialchars($this->_email);
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getIdRole()
    {
        return $this->_idRole;
    }

    /**
     * @param mixed $idRole
     */
    public function setIdRole($idRole)
    {
        $this->_idRole = intval($idRole);
    }
}
