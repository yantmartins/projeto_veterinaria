<?php
// Conectar com o banco de dados
include 'Database.php';
$database = new Database();
$conn = $database->connect();

$mensagem = ""; // Variável para mensagens de sucesso ou erro

// Verificar se foi solicitado deletar um pet
if (isset($_GET['deletar'])) {
    $pet_id = $_GET['deletar'];

    // SQL para deletar o pet
    $sql = "DELETE FROM pets WHERE id = :id";
    $stmt = $conn->prepare($sql);

    // Executar o comando de deletação
    if ($stmt->execute([':id' => $pet_id])) {
        $mensagem = "Pet deletado com sucesso!";
    } else {
        $mensagem = "Erro ao deletar pet.";
    }
}

// Buscar todos os pets
$sql = "SELECT pets.*, clientes.nome AS dono FROM pets INNER JOIN clientes ON pets.dono_id = clientes.id";
$stmt = $conn->query($sql);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>
    <link rel="stylesheet" href="style.css"> <!-- Importa o CSS -->
</head>
<body>
    <h1>Lista de Pets</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
            <li><a href="listar_pet.php">Listar Pets</a></li>
        </ul>
    </nav>

    <div class="container">
        <?php if ($mensagem): ?>
            <div class="alert"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <h2>Lista de Pets</h2>
        
        <!-- Tabela para exibir os pets -->
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Dono</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pets as $pet): ?>
                    <tr>
                        <td><?php echo $pet['id']; ?></td>
                        <td><?php echo $pet['nome']; ?></td>
                        <td><?php echo $pet['especie']; ?></td>
                        <td><?php echo $pet['raca']; ?></td>
                        <td><?php echo $pet['dono']; ?></td>
                        <td>
                            <a href="editar_pet_form.php?id=<?php echo $pet['id']; ?>">Editar</a> | 
                            <a href="?deletar=<?php echo $pet['id']; ?>" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
