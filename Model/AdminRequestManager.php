<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28/02/2018
 * Time: 13:14
 */

namespace Model;


class AdminRequestManager extends Manager
{

    public function __construct()
    {
        $this->db = new Manager();
    }

    public function addAdminRequest(AdminRequest $adminRequest)
    {
        $this->db->execute("INSERT INTO admin_request (id_user, request, status)
                            VALUES (:id_user, :request, :status)",array(
                                'id_user' => $adminRequest->getIdUser(),
                                'request' => $adminRequest->getRequest(),
                                'status' => $adminRequest->getStatus()
            ));
    }

    public function getAdminRequest(User $user)
    {
        $request = $this->db->fetch("SELECT * FROM admin_request WHERE id_user = :id_user", array('id_user' => $user->getId()));
        return new AdminRequest($request);
    }

    public function getAdminRequestById($id)
    {
        $request = $this->db->fetch("SELECT * FROM admin_request WHERE id = :id", array('id' => $id));
        return new AdminRequest($request);
    }

    public function getAdminRequests()
    {
        $userManager = new UserManager();

        $datas = $this->db->fetchAll("SELECT * FROM admin_request WHERE status = 0");

        $i = 0;
        foreach ($datas as $data)
        {
            $requests[$i]['request'] = new AdminRequest($data);
            $requests[$i]['user'] = $userManager->getUserById($requests[$i]['request']->getIdUser());
            $i++;
        }

        if ($datas!=null)
            return $requests;
        else
            return $requests = null;
    }

    public function deleteAdminRequestById($id)
    {
        $this->db->execute("DELETE FROM admin_request WHERE id = :id", array('id' => $id));
    }

    public function rejectAdminRequestById($id)
    {
        $this->db->execute("UPDATE admin_request
                                    SET status = 1
                                    WHERE id = :id",
            array(
                'id' => $id
            ));
    }

    public function countAdminRequestInStandBy()
    {
        $i = $this->db->fetch("SELECT COUNT(*) FROM admin_request WHERE status = 0");

        return $i['COUNT(*)'];
    }

}
