<?php
    require_once 'RouterClass.php';
    require_once 'controllers/ProductController.php';
    require_once 'controllers/CategoryController.php';
    require_once 'controllers/UserController.php';
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');
   
    $r = new Router();

    // rutas
    $r->addRoute("home", "GET", "ProductController", "Home");
    $r->addRoute("productos", "GET", "ProductController", "showAllProducts");
    $r->addRoute("filtrar/:ID", "GET", "ProductController", "showProductsByCategory");
    $r->addRoute("detail/:ID", "GET", "ProductController", "showDetailProduct");
    // acceso
    $r->addRoute("login", "GET", "UserController", "Login");
    $r->addRoute("logout", "GET", "UserController", "Logout");
    $r->addRoute("verify", "POST", "UserController", "verifyUser");

    ///////
    //Productos ABM
    $r->addRoute("insert", "POST", "ProductController", "insertProduct");
    $r->addRoute("delete/:ID", "GET", "ProductController", "deleteProduct");
    $r->addRoute("editar/:ID", "GET", "ProductController", "editProduct");
    $r->addRoute("update", "POST", "ProductController", "updateProduct");

    //Categorias ABM
    $r->addRoute("insertCategory", "POST", "CategoryController", "insertCategory");
    $r->addRoute("deleteCategory/:ID", "GET", "CategooryController", "deleteCategory");
    $r->addRoute("editCategory/:ID", "GET", "CategoryController", "editCategory");
    $r->addRoute("editCategory/updateCategory", "POST", "CategoryController", "updateCategory");

    //$r->addRoute("deleteImg/:ID", "POST", "ProductController", "deleteImg");

    //registro
    $r->addRoute("registrarse","GET","UserController","showRegistro");
    $r->addRoute("register","POST","UserController","register");

    //admin
   // $r->addRoute("borrarUser/:ID", "GET", "LoginController", "BorrarUser");
    $r->addRoute("usuarios", "GET", "UserController", "getUsers");
    //$r->addRoute("adminUsers", "POST", "UserController", "CambiarPermisos");
    //$r->addRoute("administrador", "POST", "LoginController", "AgregarAdmin");


    //Ruta por defecto.
    $r->setDefaultRoute("ProductController", "showAllProducts");
    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>
