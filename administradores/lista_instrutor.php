<?php
include '../conexao.php';
include '../validacao_adm.php';

$sql = "SELECT id, nome, email, telefone, data_nascimento FROM instrutores";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos instrutores
    echo '<h1>Lista de Instrutores</h1>';
    echo '<table border="1">';
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

    // Exibe cada instrutor
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['telefone'] . '</td>';
        echo '<td>' . $row['data_nascimento'] . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar-instrutor/editar_instrutor.php?id=' . $row['id'] . '">Editar</a> | ';
        echo '<a href="editar-instrutor/excluir_instrutor.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este instrutor?\')">Excluir</a>';
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

<!-- Link para adicionar novo instrutor -->
<a href="cadastro_instrutor.php">Cadastrar Novo Instrutor</a>
<a href="../logout.php">sair</a>