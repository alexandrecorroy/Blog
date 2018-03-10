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
        $data = $this->db->fetch("SELECT * FROM user WHERE pseudo = :pseudo", array(
            'pseudo' => $post['pseudo']
        ));

        return $user = new User($data);
    }

    public function getUserById($id)
    {
        $data = $this->db->fetch("SELECT * FROM user WHERE id = :id", array('id' => $id));

        return $user = new User($data);
    }

    public function deleteUserById(User $user)
    {
        $this->db->execute("DELETE FROM user WHERE id = :id", array('id' => $user->getId()));
    }

    public function addUser(User $user)
    {
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $this->db->execute("INSERT INTO user (pseudo, email, password)
                            VALUES (:pseudo, :email, :password)", array('pseudo' => $user->getPseudo(), 'email' => $user->getEmail(), 'password' => $password));
    }

    public function setRoleAdminUserById($id)
    {
        $this->db->execute(
            "UPDATE user
                                    SET id_role = 1
                                    WHERE id = :id",
            array(
                'id' => $id
            )
        );
    }

    public function getAllUser()
    {
        $datas = $this->db->fetchAll("SELECT * FROM user WHERE id_role != 2");

        $roleManager = new RoleManager();
        $users = null;
        $i = 0;
        foreach ($datas as $data) {
            $users[$i]['user'] = new User($data);
            $users[$i]['role'] = $roleManager->getNameRoleById($users[$i]['user']->getIdRole());
            $i++;
        }

        return $users;
    }
}
