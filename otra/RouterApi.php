<?php
require_once 'RouterClass.php';
require_once 'api/ApiCommentController.php';

$router = new Router();

// RUTEO API REST

//$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentController', 'showComment');
$router->addRoute('comentarios/:ID', 'DELETE', 'ApiCommentController', 'deleteComment');
$router->addRoute('comentarios', 'POST', 'ApiCommentController', 'addComment');
$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentController', 'showCommentsByProduct');


//run
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 