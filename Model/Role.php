<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03/03/2018
 * Time: 21:19
 */

namespace Model;

class Role
{
    private $_id;
    private $_name;

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
    public function getName()
    {
        return htmlspecialchars($this->_name);
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }
}
