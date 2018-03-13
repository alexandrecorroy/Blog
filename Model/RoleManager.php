<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03/03/2018
 * Time: 21:25
 */

namespace Model;

class RoleManager extends Manager
{
    public function __construct()
    {
        $this->db = new Manager();
    }

    public function getNameRoleById($id)
    {
        $data = $this->db->fetch("SELECT * FROM role WHERE id = :id", array('id' => $id));

        return new Role($data);
    }
}
