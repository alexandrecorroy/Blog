<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:40
 */

namespace Model;


use Controller\Category;

class CategoryManager extends Manager
{
    public function __construct()
    {
        $this->db = new Manager();
    }

    public function getCategories()
    {

        $datas = $this->db->fetchAll("SELECT * FROM category ORDER BY name ASC");

        foreach ($datas as $data) {
            $categories[$data['id']] = new Category();
            $categories[$data['id']]->setId($data['id']);
            $categories[$data['id']]->setName($data['name']);
        }

        return $categories;
    }

    public function deleteCategoryById($id)
    {
        $this->db->execute("DELETE FROM category WHERE id = :id", array('id' => $id));
    }

    public function addCategory(Category $category)
    {
        $this->db->execute("INSERT INTO category (name)
                            VALUES (:name)",array('name' => $category->getName()));
    }
}