<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 14:13
 */
namespace Model;

class Manager
{
    protected $db;

    // initiate DB
    public function __construct()
    {
        $this->db = new \PDO("mysql:host=localhost;dbname=blog", "root", "");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->db->exec("SET NAMES UTF8");
    }

    // return list
    public function fetchAll($query, $data = array())
    {
        $query = $this->db->prepare($query);
        $query -> execute($data);
        $res   = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $res;
    }

    // return one
    public function fetch($query, $data = array())
    {
        $query = $this->db->prepare($query);
        $query -> execute($data);
        $res   = $query->fetch(\PDO::FETCH_ASSOC);

        return $res;
    }


    public function execute($query, $data = array())
    {
        $query = $this->db->prepare($query);
        $query -> execute($data);
    }

    // return last id
    public function lastId()
    {
        return $this->db->lastInsertId();
    }

}