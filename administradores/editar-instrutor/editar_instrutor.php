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
    <link rel="shortcut icon" href=".\assets\img\logourl.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Editar - Lista de instrutores</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="email"],
input[type="date"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
input[type="password"]:focus {
    border-color: #4CAF50;
    outline: none;
}

button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

form input[type="password"] {
    background-color: #f9f9f9;
}

form input[type="password"]:focus {
    background-color: #fff;
}

form a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #4CAF50;
    text-decoration: none;
}

form a:hover {
    text-decoration: underline;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #333;
    text-decoration: none;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}

.back-button {
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 24px;
    color: #333;
    text-decoration: none;
}

.back-button:hover {
    color: #4CAF50;
}
</style>
<body>
    <a href="../lista_instrutor.php" class="back-button">
        <i class="fas fa-arrow-left"></i> 
    </a>
</body>
</html>