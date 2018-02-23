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

    public function __construct($data = null)
    {
        $this->id=$data['id'];
        $this->name=$data['name'];
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
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        if($name!='')
        $this->name = htmlentities($name);
    }



}