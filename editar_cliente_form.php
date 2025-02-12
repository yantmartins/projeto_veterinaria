<?php
include 'Database.php';
$database = new Database();
$conn = $database->connect();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <h1>Editar Cliente</h1>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="listar_clientes.php">Editar Clientes</a></li>
            <li><a href="cadastrar_cliente.php">Cadastrar Cliente</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Editar Dados do Cliente</h2>

        <form action="atualizar_cliente.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required>

            <input type="submit" value="Atualizar Cliente">
        </form>
    </div>
</body>
</html>
