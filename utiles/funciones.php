<?php
/**
 * Este metodo se encarga de recibir POST o GET enviado del formulario y unificarlo en un solo arreglo
 * y no utilizamos el $_GET o $_POST
 * @return array
 */
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
    else
        if(!empty($_GET)) {
            $_AAux =$_GET;
        }
    if (count($_AAux)){
        foreach ($_AAux as $indice => $valor) {
            if ($valor=="")
                $_AAux[$indice] = 'null'	;
        }
    }
    return $_AAux;

}


spl_autoload_register(function ($clase) {
    //echo "Cargamos la clase  ".$clase."<br>" ;
    $directorys = array(
        $GLOBALS['ROOT'].'modelo/',
        $GLOBALS['ROOT'].'modelo/conector/',
        $GLOBALS['ROOT'].'control/',
    );
    // print_r($directorys) ;
    foreach($directorys as $directory){
        if(file_exists($directory.$clase . '.php')){
            // echo "se incluyo".$directory.$class_name . '.php';
            require_once($directory.$clase . '.php');
            return;
        }
    }
});

?>
