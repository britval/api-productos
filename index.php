<?php
require_once "ProductosController.php";

$metodo = $_SERVER['REQUEST_METHOD'];

$controller = new ProductosController();

switch($metodo){
    case 'POST':
        $controller->crear();
        break;
    case 'GET':
        $controller->listar();
        break;
    case 'PUT':
        $controller->actualizar();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
}
?>
