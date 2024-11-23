<?php
session_start();

include '../conexao.php';

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error_message = 'Por favor, preencha todos os campos do formulário.';
    } else {
        $sql = "SELECT id, email, senha FROM alunos WHERE email = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $dbEmail, $dbPassword);

            if ($stmt->fetch() && password_verify($password, $dbPassword)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['aluno_id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $dbEmail;

                header('Location: home_aluno.php');
                exit();
            } else {
                $error_message = 'Credenciais incorretas.';
            }
            $stmt->close();
        } else {
            $error_message = 'Erro ao preparar a declaração: ' . $mysqli->error;
        }
    }
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Aluno</title>
    <link rel="stylesheet" href="..\assets\css\login_alunos.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <!-- Botão de voltar -->
        <a href="../index.php" class="back-arrow">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Login de Aluno</h1>

        <form action="" method="POST" class="login-form">
            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?= htmlspecialchars($error_message); ?></p>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>

        <div class="links">
            <a href="recuperar_senha.php">Esqueceu a senha?</a>
        </div>
    </div>
</body>
</html>
