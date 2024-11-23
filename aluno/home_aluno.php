<?php
include '../conexao.php';
include '../validacao_aluno.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Aluno</title>
    <link rel="stylesheet" href="..\assets\css\cadastro_instrutor.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
    <style>
        /* Estilo da página */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .home-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h1 {
            font-size: 20px;
            color: #333333;
            margin-bottom: 20px;
        }

        .home-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .home-links a {
            text-decoration: none;
            color: #ffffff;
            background-color: #4caf50;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .home-links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>O que você deseja fazer?</h1>
        <div class="home-links">
            <a href="lista_planos.php">Listar Planos</a>
            <a href="../logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
