<?php
require_once '../Controller/Pet.php';


// Verificar se foi solicitado deletar um pet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pet'])) {
    $id_pet = intval($_POST ['id_pet']);
    $pet = new Pet();
    
    if ($pet->excluir($pet_id)) {
        $mensagem = "Pet deletado com sucesso!";
    } else {
        $mensagem = "Erro ao deletar pet.";
    }
}

// Buscar todos os pets
$petts = new Pet();
$pets = $petts->buscar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>
    <link rel="stylesheet" href="style.css">
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
