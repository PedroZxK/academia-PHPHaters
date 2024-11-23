<?php
include '../conexao.php';
include '../validacao_adm.php';

$sql = "SELECT id, nome, email, telefone, data_nascimento FROM instrutores";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo '<h1>Lista de Instrutores</h1>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Email</th>';
    echo '<th>Telefone</th>';
    echo '<th>Data de Nascimento</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['telefone'] . '</td>';
        echo '<td>' . $row['data_nascimento'] . '</td>';
        echo '<td>';
        echo '<a href="editar-instrutor/editar_instrutor.php?id=' . $row['id'] . '" class="action-btn edit-btn">Editar</a> ';
        echo '<a href="editar-instrutor/excluir_instrutor.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este instrutor?\')" class="action-btn delete-btn">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há instrutores cadastrados.';
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\assets\css\lista_intrutores.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
    <title>Lista de instrutores</title>
</head>
<body>

   <a href="home_adm.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>
<a href="cadastro_instrutor.php" class="add-btn">Cadastrar Novo Instrutor</a>
</body>
</html>

