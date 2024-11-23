<?php
include '../conexao.php';
include '../validacao_adm.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home do Administrador</title>
    <link rel="stylesheet" href="..\assets\css\homeadm.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h1>O que você deseja fazer?</h1>
        <div class="actions">
            <a href="cadastro_instrutor.php" class="button">Cadastrar Instrutor</a>
            <a href="lista_instrutor.php" class="button">Listar Instrutores</a>
            <a href="../logout.php" class="button logout">Sair</a>
        </div>
    </div>
</body>
</html>
