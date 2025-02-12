<?php
include 'Database.php';

$database = new Database();
$conn = $database->connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM agendamentos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$agendamento) {
        echo "Agendamento não encontrado!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $descricao = $_POST['descricao'];

    $stmt = $conn->prepare("UPDATE agendamentos SET data = :data, hora = :hora, descricao = :descricao WHERE id = :id");
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':hora', $hora);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar_agendamento.php");
        exit;
    } else {
        echo "Erro ao atualizar agendamento.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Agendamento</h1>
    <div class="container">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $agendamento['id'] ?>">
            
            <label>Data:</label>
            <input type="date" name="data" value="<?= $agendamento['data'] ?>" required>
            
            <label>Hora:</label>
            <input type="time" name="hora" value="<?= $agendamento['hora'] ?>" required>
            
            <label>Descrição:</label>
            <textarea name="descricao" required><?= $agendamento['descricao'] ?></textarea>
            
            <button type="submit">Salvar Alterações</button>
            <a href="listar_agendamento.php" class="cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>
