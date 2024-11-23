<?php
include '../../conexao.php';
include '../../validacao_instrutor.php';

// Consulta para pegar todos os dados dos equipamentos cadastrados
$sql = "SELECT id, nome, tipo, quantidade, descricao FROM equipamentos";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Exibe os dados dos equipamentos
    echo '<h1>Lista de Equipamentos</h1>';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nome</th>';
    echo '<th>Tipo</th>';
    echo '<th>Quantidade</th>';
    echo '<th>Descrição</th>';
    echo '<th>Ações</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Exibe cada equipamento
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nome'] . '</td>';
        echo '<td>' . $row['tipo'] . '</td>';
        echo '<td>' . $row['quantidade'] . '</td>';
        echo '<td>' . $row['descricao'] . '</td>';
        echo '<td>';
        // Links para editar ou excluir
        echo '<a href="editar_equipamento.php?id=' . $row['id'] . '">Editar</a> | ';
        echo '<a href="excluir_equipamento.php?id=' . $row['id'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este equipamento?\')">Excluir</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Não há equipamentos cadastrados.';
}

$mysqli->close();
?>

<!-- Links para adicionar novo equipamento -->
<a href="cadastro_equipamento.php">Cadastrar Novo Equipamento</a>
<a href="alterar_equipamentos.php">Home Alterar Equipamentos</a>
