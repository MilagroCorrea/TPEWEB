<?php
require_once './models/CommentModel.php';
require_once 'ApiController.php';
require_once './controllers/UserController.php';

class ApiCommentController extends ApiController {
  
    function __construct() {
        parent::__construct();
        $this->model = new CommentModel();
        $this->view = new APIView();
        $this->controller= new UserController();
    }
    //lista comentarios de un producto
    public function showCommentsByProduct($params = null) {
        $id_product = $params[':ID'];
        $comments = $this->model->getCommentsByProduct($id_product);
        if (!empty($comments)) {
            $this->view->response($comments, 200);
        }
    }
    //un usuario que no es administrador puede insertar un comentario
    function addComment(){
        $body = $this->getData();
        var_dump($body);
        die();
       if($this->controller->isLogged()){
            $id_user =  $_SESSION["ID"];
            if($body->comment && $body->puntuacion){
                $result = $this->model->addComment($body->comment,$body->puntuacion,$id_user,$body->id_product);
                if($result > 0){
                    $this->view->response("El comentario fue insertado", 200);
                }else{
                    $this->view->response("El comentario no se pudo insertar", 404);
                }
            }
        }
    } 
    /*public function InsertarComentario($params = null){
        $body = $this->getData();
        if($this->controller->isLogged() && $_SESSION["ADMIN"]==0){
            $id_usuario =  $_SESSION["ID"];
            if($body->comentario && $body->valoracion){
                $result = $this->model->InsertarComentario($body->comentario,$body->valoracion,$id_usuario,$body->id_producto);
                if($result > 0){
                    $this->view->response("El comentario fue insertado", 200);
                }else{
                    $this->view->response("El comentario no se pudo insertar", 404);
                }
            }
        }
    }   */ 
    //el usuario administrador puede borrar un comentario
    public function deleteComment($params = null) {
       // if($this->controller->isLogged() && $_SESSION["ADMIN"]==1){
            $id = $params[':ID'];
            $result =  $comment = $this->model->deleteComment($id);
        if($result > 0){
            $this->view->response("El comentario con id=$id fue eliminado", 200);
        }else{
            $this->view->response("El comentario con id=$id no existe", 404);
        }
    //}    
}


}