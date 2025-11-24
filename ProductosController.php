<?php
require_once "conexion.php";

class ProductosController {

    public function crear() {
        global $pdo;

        $data = json_decode(file_get_contents("php://input"), true);

        $sql = "INSERT INTO productos(codigo, producto, precio, cantidad)
                VALUES(:codigo, :producto, :precio, :cantidad)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":codigo", $data["codigo"]);
        $stmt->bindParam(":producto", $data["producto"]);
        $stmt->bindParam(":precio", $data["precio"]);
        $stmt->bindParam(":cantidad", $data["cantidad"]);

        if($stmt->execute()){
            http_response_code(201);
            echo json_encode(["mensaje" => "Producto creado"]);
        }
    }
