<?php
include 'Database.php';

$database = new Database();
$conn = $database->connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM pets WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        echo "Pet não encontrado!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];

    $stmt = $conn->prepare("UPDATE pets SET nome = :nome, especie = :especie, raca = :raca WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':especie', $especie);
    $stmt->bindParam(':raca', $raca);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar_pet.php");
        exit;
    } else {
        echo "Erro ao atualizar pet.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Pet</h1>
    <div class="container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $pet['id'] ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= $pet['nome'] ?>" required>
            
            <label>Espécie:</label>
            <input type="text" name="especie" value="<?= $pet['especie'] ?>" required>
            
            <label>Raça:</label>
            <input type="text" name="raca" value="<?= $pet['raca'] ?>" required>
            
            <button  type="submit">Salvar Alterações</button>
            <a href="listar_pet.php" class="cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>
