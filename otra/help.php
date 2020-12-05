$destino=null;
    if(isset($_FILES['img'])){
        $imagen=$_FILES['img']['tmp_name'];
        $destino = 'uploads/' . uniqid() . '.jpg';
        move_uploaded_file($imagen, $destino);

       
        $destino= basename($destino);
        //var_dump($destino);
        //die();
    }