<?php
include '../../conexao.php';
include '../../validacao_adm.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT nome, email, telefone, data_nascimento FROM instrutores WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $email, $telefone, $data_nascimento);
    
    if ($stmt->fetch()) {
        echo '<h1>Editar Instrutor</h1>';
        echo '<form action="atualizar_instrutor.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        
        echo '<label for="nome">Nome:</label>';
        echo '<input type="text" name="nome" value="' . $nome . '" required><br>';
        
        echo '<label for="email">Email:</label>';
        echo '<input type="email" name="email" value="' . $email . '" required><br>';
        
        echo '<label for="telefone">Telefone:</label>';
        echo '<input type="text" name="telefone" value="' . $telefone . '" required><br>';
        
        echo '<label for="data_nascimento">Data de Nascimento:</label>';
        echo '<input type="date" name="data_nascimento" value="' . $data_nascimento . '" required><br>';
        
        echo '<label for="senha">Nova Senha:</label>';
        echo '<input type="password" name="senha"><br>';
        
        echo '<label for="confirmar_senha">Confirmar Nova Senha:</label>';
        echo '<input type="password" name="confirmar_senha"><br>';
        
        echo '<button type="submit" class="btn-submit">Atualizar</button>';
        echo '</form>';
    } else {
        echo 'Instrutor não encontrado.';
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\assets\css\editarlista_intrutores.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Editar - Lista de instrutores</title>
</head>
<body>
    <a href="home_adm.php" class="back-button">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</body>
</html>