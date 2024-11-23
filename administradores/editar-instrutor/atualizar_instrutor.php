<?php
include '../../conexao.php';
include '../../validacao_adm.php';

// Verifica se o ID do instrutor foi passado
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    
    // Verifica se foi fornecida uma nova senha
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $confirmar_senha = isset($_POST['confirmar_senha']) ? $_POST['confirmar_senha'] : '';

    // Valida a confirmação de senha
    if ($senha !== '' && $senha !== $confirmar_senha) {
        echo 'As senhas não coincidem. Tente novamente.';
        exit();
    }

    // Se uma nova senha foi fornecida, faz o hash da senha
    if ($senha !== '') {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    }

    // Prepara a query de atualização dos dados
    if ($senha !== '') {
        // Se a senha foi alterada, inclui a atualização da senha
        $stmt = $mysqli->prepare("UPDATE instrutores SET nome = ?, email = ?, telefone = ?, data_nascimento = ?, senha = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nome, $email, $telefone, $data_nascimento, $senha_hash, $id);
    } else {
        // Se a senha não foi alterada, não inclui a senha na query
        $stmt = $mysqli->prepare("UPDATE instrutores SET nome = ?, email = ?, telefone = ?, data_nascimento = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nome, $email, $telefone, $data_nascimento, $id);
    }

    // Executa a query
    if ($stmt->execute()) {
        echo '<script>alert("Instrutor atualizado com sucesso!"); window.location.href="../lista_instrutor.php";</script>';
    } else {
        echo 'Erro ao atualizar instrutor: ' . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>
