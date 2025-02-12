<?php
include_once 'Database.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $dono_id = $_POST['dono_id'];

    $clinica = new ClinicaVeterinaria();
    if ($clinica->cadastrarPet($nome, $especie, $raca, $dono_id)) {
        $mensagem = "Pet cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar o pet.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            margin: 0;
        }
        nav {
            background: #333;
            padding: 10px 0;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }
        nav ul li {
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px;
            transition: background 0.3s;
        }
        nav ul li a:hover {
            background: #575757;
            border-radius: 5px;
        }
        .container {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .mensagem {
            padding: 10px;
            color: white;
            background: #4CAF50;
            border-radius: 5px;
            margin-bottom: 15px;
            display: <?php echo $mensagem ? 'block' : 'none'; ?>;
        }
        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Cadastrar Pet</h1>
    <nav>
        <ul>
            <li><a href="cadastrar_cliente.php">Cadastrar Cliente</a></li>
            <li><a href="listar_clientes.php">Listar Clientes</a></li>
            <li><a href="cadastrar_pet.php">Cadastrar Pet</a></li>
            <li><a href="listar_pet.php">Listar Pets</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
            <li><a href="listar_agendamento.php">Listar Agendamentos</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Formulário de Cadastro de Pet</h2>
        
        <?php if ($mensagem): ?>
            <div class="mensagem"><?= $mensagem ?></div>
        <?php endif; ?>

        <form method="POST" action="cadastrar_pet.php">
            <input type="text" name="nome" placeholder="Nome do Pet" required>
            <input type="text" name="especie" placeholder="Espécie" required>
            <input type="text" name="raca" placeholder="Raça" required>
            <select name="dono_id" required>
                <option value="">Selecione o Dono</option>
                <?php
                $clinica = new ClinicaVeterinaria();
                $clientes = $clinica->listarClientes();
                foreach ($clientes as $cliente) {
                    echo "<option value='" . $cliente['id'] . "'>" . $cliente['nome'] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Cadastrar Pet</button>
        </form>
    </div>
</body>
</html>
