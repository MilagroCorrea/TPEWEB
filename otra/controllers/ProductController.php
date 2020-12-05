<?php

require_once "./views/ProductView.php";
require_once "./models/ProductModel.php";
require_once "./models/CategoryModel.php";
require_once "./controllers/UserController.php";

class ProductController{

    private $view;
    private $model;
    private $modelCat;
    private $controller;

    function __construct(){
        $this->view = new ProductView();
        $this->model = new ProductModel();
        $this->modelCat = new CategoryModel();
        $this->controller = new UserController();
    }

    //Lista Productos
    function showAllProducts(){
        session_start();
        $accesoAdmin = 0;
        if (isset($_SESSION) && $_SESSION != null) {
            $accesoAdmin = $_SESSION['ADMIN'];
        }
        $products = $this->model->getProducts();
        $categories = $this->modelCat->getCategories();
        $this->view->showProducts($products, $categories, $accesoAdmin);

    }

    function showProductsByCategory($params = null){

        if (isset($params[':ID'])) {
            $accesoAdmin = 0;
            session_start();
            if (isset($_SESSION) && $_SESSION != null) {
                $accesoAdmin = $_SESSION['ADMIN'];
            }

            if ($params[':ID'] == 'Todos') {
                $products = $this->model->getProducts();
                $categories = $this->modelCat->getCategories();
                $this->view->showProductsView($products, $categories, $accesoAdmin);
            } else {
                $categoryID = $params[':ID'];
                $products = $this->model->getProductsByCategory($categoryID);
                $categories = $this->modelCat->getCategories();
                $this->view->showProductsView($products, $categories, $accesoAdmin);
            }
        }
    }

    //Insertar con imagen
    function getDestino(){
        $destino=null;
        if(isset($_FILES['img'])){
            $imagen=$_FILES['img']['tmp_name'];
            $destino = 'uploads/' . uniqid() . '.jpg';
            move_uploaded_file($imagen, $destino);
            $destino= basename($destino);
        }
        return $destino;
    }

    public function insertProduct(){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            if(($_POST['name'])!=null && ($_POST['description'])!=null && ($_POST['price'])!=null && ($_POST['stock'])!=null && ($_POST['id_category'])!=null){

                $destino= $this->getDestino();
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category = $_POST['id_category'];
                $this->model->addProduct($destino, $name, $description, $price, $stock, $category);
                    header("Location: ".BASE_URL."productos");
                }
                    header("Location: ".BASE_URL."productos");
                }else{
                    header("Location: ".BASE_URL."login");
        }
    }


    //DELETE
    /*function deleteProduct($params=null){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           ($parametros = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            $this->model->deleteProduct($id);
            header("Location: ".BASE_URL."productos");
        }     
    }*/

    public function deleteProduct($parametros = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $parametros[':ID'];
            $this->model->deleteProduct($id);
            $productos = $this->model->getProducts();
            $this->view->showProducts($productos);
        }else{
            header("Location: ".BASE_URL."Productos");        }
    }

   
    //Detalle producto
    function showDetailProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);
        
        $this->view->showProduct($product); 
    }

    //EDITAR
    //LLena los inputs
    function editProduct($params = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            $products = $this->model->getProduct($id);
            $categorias = $this->model->getCategories();
            $this->view->showEditProduct($products, $categorias);
        }else{
            header("Location: ".BASE_URL."productos");       
        }
    }

    //Verifica y edita
   /* function updateProduct($params = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            if(($_POST['name'])!= null && ($_POST['description'])!= null && ($_POST['price'])!= null && ($_POST['stock'])!= null) && ($_POST['id_category'])!= null){             
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category = $_POST['id_category'];
                $id = $_POST['id'];
                $this->model->EditProduct($name, $description, $price, $stock, $category, $id);
    
            }else{
                 header("Location: ".BASE_URL."productos"); }
            }
        }    
    }

  /*  //VER DESPUES
    //Filtro para el usuario no administrador y para el no registrado
    public function FiltrarTemporada(){
        $temporada = $_POST['filtroTemporada'];
        $productos=$this->model->GetProductosPorTemporada($temporada);
        $this->view->ShowProductosFiltrados($productos);
    }
    //Filtro para el usuario administrador, puede editar, eliminar o insertar temporadas
    public function FiltrarTemporadaAdmin(){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $temporada = $_POST['filtroTemporadaAdmin'];
            $productos=$this->model->GetProductosPorTemporada($temporada);
            $this->view->ShowProductosFiltradosAdmin($productos);
        }
        else{
            header("Location: ".BASE_URL."login");
        }
    }*/
}

