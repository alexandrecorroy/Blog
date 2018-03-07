<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:41
 */

namespace Model;


class Category
{

    protected $id;
    protected $name;

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
    public function getName()
    {
        return htmlspecialchars($this->name);
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if($name!='')
        $this->name = $name;
    }



}