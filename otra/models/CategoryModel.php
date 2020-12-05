<?php

class CategoryModel{

    private $db;

    function __construct(){
        //1 abro la conexion
        $this->db =  new PDO('mysql:host=localhost;'.'dbname=db_products;charset=utf8', 'root', '');
    }

    function getCategories(){
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function addCategory($category){
        $query =  $this->db->prepare('INSERT INTO categories(name_caegory) VALUES (?)');
        $query->execute(array($category));
    }

    public  function deleteCategory($id){
        $query = $this->db -> prepare('DELETE FROM categories WHERE id =?');
        $query->execute(array($id));
    }

    function editCategory($name, $id){
        $query = $this->db ->prepare("UPDATE `categories` SET `name_caegory`= ? WHERE id=?") ;
        $query->execute(array($name, $id));
    }

    function getCategory($id){
        $query = $this->db->prepare("SELECT * FROM categories  WHERE id=?");
        $query->execute(array($id));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}



    