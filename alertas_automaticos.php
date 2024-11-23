<?php
include '../conexao.php'; // Conexão com o banco de dados

// Definição dos limites para disparar alertas
$frequencia_limite = 75; // Frequência mínima aceitável em porcentagem
$desempenho_limite = 60; // Nota média mínima aceitável
$feedback_limite = 5;    // Número mínimo de feedbacks por turma

// Função para enviar alertas por e-mail
function enviarAlerta($emailInstrutor, $mensagem) {
    $assunto = "Alerta Automático do Sistema";
    $headers = "From: no-reply@sistema.com";

    if (mail($emailInstrutor, $assunto, $mensagem, $headers)) {
        echo "Alerta enviado para $emailInstrutor: $mensagem <br>";
    } else {
        echo "Erro ao enviar alerta para $emailInstrutor <br>";
    }
}

// Consulta para buscar instrutores e suas turmas
$sqlInstrutores = "SELECT i.id AS instrutor_id, i.email AS instrutor_email, t.id AS turma_id, t.nome AS turma_nome
                   FROM instrutores i
                   JOIN turmas t ON t.instrutor_id = i.id";
$resultInstrutores = $mysqli->query($sqlInstrutores);

while ($instrutor = $resultInstrutores->fetch_assoc()) {
    $instrutorEmail = $instrutor['instrutor_email'];
    $turmaId = $instrutor['turma_id'];
    $turmaNome = $instrutor['turma_nome'];

    // Verificação de frequência média
    $sqlFrequencia = "SELECT AVG(frequencia) AS frequencia_media FROM alunos WHERE turma_id = $turmaId";
    $resultFrequencia = $mysqli->query($sqlFrequencia);
    $frequenciaMedia = $resultFrequencia->fetch_assoc()['frequencia_media'];

    if ($frequenciaMedia < $frequencia_limite) {
        $mensagem = "Alerta: A frequência média da turma '$turmaNome' está abaixo de $frequencia_limite%.";
        enviarAlerta($instrutorEmail, $mensagem);
    }

    // Verificação de desempenho médio
    $sqlDesempenho = "SELECT AVG(desempenho) AS desempenho_medio FROM alunos WHERE turma_id = $turmaId";
    $resultDesempenho = $mysqli->query($sqlDesempenho);
    $desempenhoMedio = $resultDesempenho->fetch_assoc()['desempenho_medio'];

    if ($desempenhoMedio < $desempenho_limite) {
        $mensagem = "Alerta: O desempenho médio da turma '$turmaNome' está abaixo de $desempenho_limite%.";
        enviarAlerta($instrutorEmail, $mensagem);
    }

    // Verificação de feedbacks
    $sqlFeedbacks = "SELECT COUNT(*) AS total_feedbacks FROM feedbacks WHERE turma_id = $turmaId";
    $resultFeedbacks = $mysqli->query($sqlFeedbacks);
    $totalFeedbacks = $resultFeedbacks->fetch_assoc()['total_feedbacks'];

    if ($totalFeedbacks < $feedback_limite) {
        $mensagem = "Alerta: A turma '$turmaNome' recebeu menos de $feedback_limite feedbacks dos alunos.";
        enviarAlerta($instrutorEmail, $mensagem);
    }
}

echo "Verificação de alertas concluída.";
?>
