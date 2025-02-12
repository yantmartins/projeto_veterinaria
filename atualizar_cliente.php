<?php

include 'Database.php';
$database = new Database();
$conn = $database->connect();

if (isset($_POST['id'], $_POST['nome'], $_POST['telefone'], $_POST['email'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];


    $sql = "UPDATE clientes SET nome = :nome, telefone = :telefone, email = :email WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id, 'nome' => $nome, 'telefone' => $telefone, 'email' => $email]);

    
    header('Location: listar_clientes.php');
}
?>
