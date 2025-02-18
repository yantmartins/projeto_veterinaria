<?php

include 'Database.php';
$database = new Database();
$conn = $database->connect();

$mensagem = ""; 
if (isset($_GET['deletar'])) {
    $agendamento_id = $_GET['deletar'];

    $sql = "DELETE FROM agendamentos WHERE id = :id";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([':id' => $agendamento_id])) {
        $mensagem = "Agendamento deletado com sucesso!";
    } else {
        $mensagem = "Erro ao deletar agendamento.";
    }
}

$sql = "SELECT agendamentos.*, pets.nome AS pet FROM agendamentos INNER JOIN pets ON agendamentos.pet_id = pets.id";
$stmt = $conn->query($sql);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Lista de Agendamentos</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
            <li><a href="listar_agendamento.php">Listar Agendamentos</a></li>
        </ul>
    </nav>

    <div class="container">
        <?php if ($mensagem): ?>
            <div class="alert"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <h2>Lista de Agendamentos</h2>
        
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pet</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <tr>
                        <td><?php echo $agendamento['id']; ?></td>
                        <td><?php echo $agendamento['pet']; ?></td>
                        <td><?php echo $agendamento['data']; ?></td>
                        <td><?php echo $agendamento['hora']; ?></td>
                        <td><?php echo $agendamento['descricao']; ?></td>
                        <td>
                            <a href="editar_agendamento_form.php?id=<?php echo $agendamento['id']; ?>"> Editar</a> | 
                            <a href="?deletar=<?php echo $agendamento['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar este agendamento?')"> Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
