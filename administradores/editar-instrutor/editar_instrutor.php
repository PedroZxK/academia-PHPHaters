<?php
include '../../conexao.php';
include '../../validacao_adm.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtém os dados do instrutor a ser editado
    $stmt = $mysqli->prepare("SELECT nome, email, telefone, data_nascimento FROM instrutores WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $telefone, $data_nascimento);
    
    if ($stmt->fetch()) {
        // Exibe o formulário com os dados atuais do instrutor
        echo '<h1>Editar Instrutor</h1>';
        echo '<form action="atualizar_instrutor.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        
        // Campo para editar o nome
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        
        // Campo para editar o e-mail
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" value="' . $email . '" required><br>';
        
        // Campo para editar o telefone
        echo '<label for="telefone">Telefone:</label>';
        echo '<input type="text" name="telefone" value="' . $telefone . '" required><br>';
        
        // Campo para editar a data de nascimento
        echo '<label for="data_nascimento">Data de Nascimento:</label>';
        echo '<input type="date" name="data_nascimento" value="' . $data_nascimento . '" required><br>';
        
        // Campo para alterar a senha
        echo '<label for="senha">Nova Senha:</label>';
        echo '<input type="password" name="senha"><br>';
        
        // Confirmação de senha
        echo '<label for="confirmar_senha">Confirmar Nova Senha:</label>';
        echo '<input type="password" name="confirmar_senha"><br>';
        
        echo '<button type="submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Instrutor não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>
