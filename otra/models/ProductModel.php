<?php

class ProductModel
{
    private $db;
    function __construct(){

        $this->db = new PDO('mysql:host=localhost;' . 'dbname=db_products;charset=utf8', 'root', '');
    }


    function getProducts(){

        $query = $this->db->prepare('SELECT * FROM products JOIN categories ON products.id_category = categories.id_category');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function getProduct($id_producto){

        $query = $this->db->prepare('SELECT * FROM products JOIN categories ON categories.id_category = products.id_category and products.id_product=?');
        $query->execute(array($id_producto));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getProductsByCategory($category){

        $query = $this->db->prepare('SELECT image, name, description, name_caegory FROM products JOIN categories ON categories.id_category = products.id_category and products.id_category=?');
        $query->execute(array($category));
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function addProduct($image, $name, $description, $precio, $stock, $categoria){

        $query = $this->db->prepare('INSERT INTO products(image, name, description, price, stock, id_category) 
        VALUES(?,?,?,?,?,?)');
        $query->execute(array($image, $name, $description, $precio, $stock, $categoria));
    }


    function deleteProduct($id){

        $query = $this->db->prepare("DELETE FROM products WHERE id_product=?");
        $query->execute(array($id));
    }


    function EditProduct($name, $description, $price, $stock, $category, $id){

        $query = $this->db->prepare('UPDATE products SET name=?, description=?, price=?, stock=?, id_category=? WHERE id_product=?');
        $query->execute(array($name, $description, $price, $stock, $category, $id));
    }
   

    /*function deleteImg($id){
        $query = $this->db->prepare("DELETE image FROM products WHERE id=?");
        $query->execute(array($id));
      }*/


    function getImage($id){

        $query = $this->db->prepare("SELECT products.image FROM products WHERE id=?  "); 
        $query->execute(array($id));
        $img = $query->fetch(PDO::FETCH_OBJ); 
        return $img;
    }

    
}
