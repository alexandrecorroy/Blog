<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/02/2018
 * Time: 14:13
 */
namespace Model;

class UserManager extends Manager
{

    public function __construct()
    {
        $this->db = new Manager();
    }

    public function getUser($post)
    {

        $data = $this->db->fetch("SELECT * FROM user WHERE pseudo = :pseudo AND password = :password", array(
            'pseudo' => $post['pseudo'],
            'password' => $post['password'])
        );

        return $user = new User($data);
    }

    public function getUserById($id)
    {
        $data = $this->db->fetch("SELECT * FROM user WHERE id = :id", array('id' => $id));

        return $user = new User($data);
    }

    public function deleteUserById($id)
    {

    }

    public function addUser($post)
    {
        $this->db->execute("INSERT INTO user (pseudo, email, password)
                            VALUES (:pseudo, :email, :password)", array('pseudo' => $post['pseudo'], 'email' => $post['email'], 'password' => $post['password']));
    }

}