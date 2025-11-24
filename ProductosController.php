<?php
require_once "conexion.php";

class ProductosController {

    // POST
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

    // GET
    public function listar() {
        global $pdo;

        $sql = "SELECT * FROM productos";
        $stmt = $pdo->query($sql);
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        http_response_code(200);
        echo json_encode($productos);
    }

    // PUT
    public function actualizar() {
        global $pdo;

        $data = json_decode(file_get_contents("php://input"), true);

        if(!isset($data["id"])){
            http_response_code(400);
            echo json_encode(["error" => "Debes enviar un ID"]);
            return;
        }

        $sql = "UPDATE productos SET 
                codigo = :codigo,
                producto = :producto,
                precio = :precio,
                cantidad = :cantidad
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":codigo", $data["codigo"]);
        $stmt->bindParam(":producto", $data["producto"]);
        $stmt->bindParam(":precio", $data["precio"]);
        $stmt->bindParam(":cantidad", $data["cantidad"]);
        $stmt->bindParam(":id", $data["id"]);

        if($stmt->execute()){
            http_response_code(200);
            echo json_encode(["mensaje" => "Producto actualizado"]);
        }
    }
}
?>
