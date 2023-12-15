<?php 
    
    if(!isset($_REQUEST["classe"])){
        $class = "Principal";
        $method = "showViewPrincipal";
    }
    else{
        $class = $_REQUEST["classe"];
        $method = $_REQUEST["metodo"];
    }
    $class .= "Controller";
    require_once("biblioteca/controller/$class.php");
    $nowOnController = new $class();
    $nowOnController->$method();
?>