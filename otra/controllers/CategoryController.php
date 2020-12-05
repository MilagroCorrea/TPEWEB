<?php

require_once "./views/ProductView.php";
require_once "./models/CategoryModel.php";
require_once "./controllers/UserController.php";

class CategoryController{

    private $view;
    private $model;
    private $controller;

    function __construct(){
        $this->view = new ProductView();
        $this->model = new CategoryModel();
        $this->controller = new UserController();
    }

    //el usuario administrador puede:

    //INSERT
    public function insertCategory(){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            if(($_POST['name_caegory'])!= null){   
            $category = $_POST['name_caegory'];
            $this->model->addCategory($category);
            header("Location: " . BASE_URL . "productos");
            }else{
                header("Location: ".BASE_URL."login");
        }
      
    }
    //DELETE
    /*public function deleteCategory($params = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            $this->model->deleteCategory($id);
            header("Location: ".BASE_URL."productos");      
        }else{
            header("Location: ".BASE_URL."productos");
        }
    } */
    //UPDATE

    function editCategory($params = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            if(($_POST['name_caegory'])!= null){   
            $categoria = $this->model->getCategories($id);
            $this->view->showUpdateCategory($categoria);
        }else{
            header("Location: ".BASE_URL."productos");
        }
        }
        else{
            header("Location: ".BASE_URL."login");
        }
    }
    
    function updateCategory($params = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $_POST['id_cat'];
            $categoriesSaved = $this->model->getCategories();
            foreach (($categoriesSaved) as $cat ) {
        
                if(strtoupper($cat)==strtoupper($name)){
                    $this->view->showError("la categoria ya existe"); 
                    return;
                }
            }
            $this->model->editCategory($name,$id);
            header("Location: " . BASE_URL . "productos");  
        }
    }

    //si esta registrado le muestra con la barra de navegacion con logout, sino con login
   /* function ShowTemporada($parametros = null){
        $id = $parametros[':ID'];
        $temporada = $this->model->GetTemporada($id);
        if($this->controller->isLogged()){    
            $this->view->ShowTemporadaUnica($temporada);
        }else{
            $this->view->ShowTemporadaUnicaNoUsuario($temporada);
        }
    }
    //le da la posibilidad al usuario admin para editar la temporada o eliminarla
    function ShowTemporadaAdmin($parametros = null){
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $parametros[':ID'];
            $temporada = $this->model->GetTemporada($id);
            $this->view->ShowTemporadaAdm($temporada);
        }else{
            header("Location: ".BASE_URL."Home");
        }
        }*/
    }
}