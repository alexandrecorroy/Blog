<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28/02/2018
 * Time: 13:14
 */

namespace Model;


class AdminRequest
{

    protected $id;
    protected $idUser;
    protected $request;
    protected $status;

    public function __construct($data = null)
    {
        $this->id = intval($data['id']);
        $this->idUser = intval($data['id_user']);
        $this->request = $data['request'];
        $this->status = intval($data['status']);
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
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = htmlentities($request);
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }



}