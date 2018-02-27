<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/02/2018
 * Time: 21:40
 */

namespace Model;

class CategoryManager extends Manager
{
    public function __construct()
    {
        $this->db = new Manager();
    }

    public function getCategories()
    {

        $datas = $this->db->fetchAll("SELECT * FROM category ORDER BY name ASC");

        $i=0;
        foreach ($datas as $data) {
            $categories[$i] = new Category($data);
            $i++;
        }

        return $categories;
    }

    public function getCategoryById($id)
    {

        $data = $this->db->fetch("SELECT * FROM category WHERE id = :id", array('id' => $id));

        $category = new Category($data);

        return $category;
    }

    public function deleteCategoryById($id)
    {
        $this->db->execute("DELETE FROM category WHERE id = :id", array('id' => $id));

        // update categoryId to '0' on affected articles
        $article = new ArticleManager();
        $article->setNullArticleOnDeleteCategoryId($id);
    }

    public function addCategory(Category $category)
    {
        $this->db->execute("INSERT INTO category (name)
                            VALUES (:name)",array('name' => $category->getName()));
    }
}