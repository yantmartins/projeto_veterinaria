<?php

include 'Database.php';
$database = new Database();
$conn = $database->connect();

$mensagem = ""; 


if (isset($_GET['deletar'])) {
    $cliente_id = $_GET['deletar'];

    
    $sql = "DELETE FROM clientes WHERE id = :id";
    $stmt = $conn->prepare($sql);

    
    if ($stmt->execute([':id' => $cliente_id])) {
        $mensagem = "Cliente deletado com sucesso!";
    } else {
        $mensagem = "Erro ao deletar cliente.";
    }
}


$sql = "SELECT * FROM clientes";
$stmt = $conn->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Lista de Clientes</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="cadastrar_cliente.php">Cadastrar Cliente</a></li>
            <li><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
        </ul>
    </nav>

    <div class="container">
        <?php if ($mensagem): ?>
            <div class="alert"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <h2>Lista de Clientes</h2>
        
        
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['telefone']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                        <td>
                            <a href="editar_cliente_form.php?id=<?php echo $cliente['id']; ?>">Editar</a> | 
                            <a href="?deletar=<?php echo $cliente['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
