<?php
include '../conexao.php';
include '../validacao_aluno.php';

// Consulta para pegar os planos de treino e seus status de conclusão
$sql = "SELECT id, nome, descricao, valor, concluido FROM planos";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Planos de Treino</title>
    <link rel="stylesheet" href="../assets/css/estilo_planos.css"> <!-- Referência ao CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
    <h1>Lista de Planos de Treino</h1>

    <?php if ($result->num_rows > 0): ?>
        <form method="POST" action="marcar_conclusao.php">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Concluído</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['nome']; ?></td>
                            <td><?= $row['descricao']; ?></td>
                            <td><?= number_format($row['valor'], 2, ',', '.'); ?></td>
                            <td><input type="checkbox" name="concluido[]" value="<?= $row['id']; ?>" <?= $row['concluido'] == 1 ? 'checked' : ''; ?>></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit">Salvar Alterações</button>
        </form>
    <?php else: ?>
        <p>Não há planos cadastrados.</p>
    <?php endif; ?>

    <a href="home_aluno.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>

    <?php $mysqli->close(); ?>
</body>
</html>
