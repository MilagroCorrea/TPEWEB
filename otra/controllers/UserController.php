<?php

require_once "./views/UserView.php";
require_once "./models/UserModel.php";
require_once "./views/ProductView.php";

class UserController{

    private $view;
    private $model;
    private $view2;

    function __construct(){
        $this->view = new UserView();
        $this->model = new UserModel();
        $this->view2= new ProductView();
    }

    function Login(){
       $this->view->ShowLogin();
    }

    function Logout(){
        session_start();
        session_destroy();
        header("Location: " . LOGIN);
    }

    //toma los datos del front y registra usuario no administrador
    function register(){
        $user = $_POST["email"];
        $pass = $_POST["password"];
        $admin = 0;
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $userFromDB = $this->model->getUser($user);
            if(!$userFromDB){
                $password_hash = password_hash($pass, PASSWORD_DEFAULT);
                $this->model->addUser($user,$password_hash, $admin);
                session_start();
                $userFromDB = $this->model->getUser($user);
                $_SESSION['EMAIL'] = $user;
                $_SESSION["ID"] = $userFromDB->id_user;
                $_SESSION["ADMIN"] = $admin;
                header("Location: ".BASE_URL."productos");  
            }else{
                $user = $_POST['email'];
                $this->view->showRegistro('El usuario ya se encuentra registrado');
            }  
        }
    }

    public function showRegistro(){
        $this->view->showRegistro();
    }

//verifica si los datos ingresados son de un usuario registrado en el sitio
    function verifyUser(){
        $user = $_POST["email"];
        $pass = $_POST["password"];
        if(isset($user)){
            $userFromDB = $this->model->getUser($user);
            if(isset($userFromDB) && $userFromDB){
                $hash=$userFromDB->password;
                if(password_verify($pass, $hash)){
                    session_start();
                    $_SESSION['EMAIL'] = $userFromDB->email;
                    $_SESSION["ID"] = $userFromDB->id_user;
                    $_SESSION["ADMIN"] = $userFromDB->admin;

                    header("Location: ".BASE_URL."productos");
                //Si el admin es 1, muestra las funciones de administrador
                    /*if($_SESSION["ADMIN"]==1){ 
                        header("Location: ".BASE_URL."adminProductos");
                    //Si es cero, lo lleva la version comun
                    }else if($_SESSION["ADMIN"]==0){
                        header("Location: ".BASE_URL."productos");
                    }*/
                }else{
                    $this->view->showRegistro("Contraseña incorrecta");
                    }
                }
            else{
                $this->view->showRegistro("El usuario no existe");
                }
        }
    }
    //muestra la lista de los usuarios registrados
    function getUsers(){
        if($this->isLogged() && $_SESSION["ADMIN"]==1){
             $users = $this->model->getUsers();
             $this->view->showUsers($users);

        }else{
            header("Location: ".BASE_URL."productos");
            }
    }

    //chequea si hay una sesion iniciada
    function isLogged(){
        $isLogged = false;
        session_start();
        if (isset($_SESSION['EMAIL'])) {
            $isLogged = true;
        }
        return $isLogged;
    }

     //VER FUNCIONES USER ADMIN
    //un usuario administrador puede cambiar el rol de un usuario comun a usuario admin
    /*function ConvertirAdmin($params = null){
        //Verifica si esta logueado y si tiene rol de admin
        if($this->isLogged() && $_SESSION["ADMIN"]==1){
            $id_usuario = $params[':ID'];
            $this->model->ConvertirAdmin($id_usuario);
            //Vuelve a pedir el listado de usuarios actualizado y lo muestra en la vista
            $usuarios=$this->model->getUsers();
            $this->view->ShowUsers($usuarios);    
    }else{
        header("Location: ".BASE_URL."home");  
        }
    }

   
    //un usuario administrador puede quitarle las funciones de administrador a otro usuario administrador
     function QuitarAdmin($params = null){
        if($this->isLogged() && $_SESSION["ADMIN"]==1){
              $id_usuario = $params[':ID'];
              $this->model->QuitarAdmin($id_usuario);
              //Vuelve a pedir el listado de usuarios actualizado y lo muestra en la vista
              $usuarios=$this->model->GetUsers();
              $this->view->ShowUsers($usuarios);
        }else{
              header("Location: ".BASE_URL."home"); //cambiar el redireccionamiento
        }
    }
    //un usuario administrador puede borrar un usuario
    function BorrarUsuario($params = null){
        if($this->isLogged() && $_SESSION["ADMIN"]==1){
            $id_usuario = $params[':ID'];
            $this->model->EliminarUsuario($id_usuario);
            //Vuelve a pedir el listado de usuarios actualizado y lo muestra en la vista
            $usuarios=$this->model->GetUsers();
            $this->view->ShowUsers($usuarios);
        }else{
            header("Location: ".BASE_URL."home"); //cambiar el redireccionamiento
        }
    }*/
}
?>