<?php
require_once 'conexao.php';

// Função para enviar alerta por e-mail para o instrutor
function enviarAlertaInstrutor($emailInstrutor, $mensagem) {
    $assunto = "Alerta Automático: Notificação de Turma";
    $headers = "From: sistema@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($emailInstrutor, $assunto, $mensagem, $headers)) {
        echo "Alerta enviado para o instrutor: $emailInstrutor\n";
    } else {
        echo "Falha ao enviar alerta para o instrutor: $emailInstrutor\n";
    }
}

// Critérios de alerta
$frequenciaMinima = 75;  // Frequência mínima aceitável
$minimoFeedbacks = 3;    // Mínimo de feedbacks por aluno
$notaMinima = 6;         // Nota mínima para desempenho

// Consulta para verificar alertas em cada turma
$sqlTurmas = "
    SELECT t.id AS turma_id, t.nome AS turma_nome, i.id AS instrutor_id, i.email AS instrutor_email
    FROM turmas t
    JOIN instrutores i ON t.instrutor_id = i.id
";
$resultTurmas = $mysqli->query($sqlTurmas);

if ($resultTurmas) {
    while ($turma = $resultTurmas->fetch_assoc()) {
        $turmaId = $turma['turma_id'];
        $instrutorEmail = $turma['instrutor_email'];
        
        // Verificação de baixa frequência
        $sqlFrequencia = "
            SELECT AVG(frequencia) AS media_frequencia
            FROM alunos
            WHERE turma_id = $turmaId
        ";
        $resultFrequencia = $mysqli->query($sqlFrequencia);
        $frequencia = $resultFrequencia->fetch_assoc()['media_frequencia'];

        if ($frequencia < $frequenciaMinima) {
            $mensagem = "Alerta: A turma '{$turma['turma_nome']}' apresenta baixa frequência média de alunos ({$frequencia}%).";
            enviarAlertaInstrutor($instrutorEmail, $mensagem);
        }

        // Verificação de falta de feedback
        $sqlFeedback = "
            SELECT COUNT(*) AS total_feedbacks
            FROM feedbacks
            WHERE turma_id = $turmaId
        ";
        $resultFeedback = $mysqli->query($sqlFeedback);
        $totalFeedbacks = $resultFeedback->fetch_assoc()['total_feedbacks'];

        if ($totalFeedbacks < $minimoFeedbacks) {
            $mensagem = "Alerta: A turma '{$turma['turma_nome']}' apresenta falta de feedback dos alunos.";
            enviarAlertaInstrutor($instrutorEmail, $mensagem);
        }

        // Verificação de baixo desempenho
        $sqlDesempenho = "
            SELECT AVG(nota) AS media_notas
            FROM desempenho
            WHERE turma_id = $turmaId
        ";
        $resultDesempenho = $mysqli->query($sqlDesempenho);
        $mediaNotas = $resultDesempenho->fetch_assoc()['media_notas'];

        if ($mediaNotas < $notaMinima) {
            $mensagem = "Alerta: A turma '{$turma['turma_nome']}' apresenta baixo desempenho geral dos alunos (média de notas: {$mediaNotas}).";
            enviarAlertaInstrutor($instrutorEmail, $mensagem);
        }
    }
} else {
    echo "Erro ao buscar turmas: " . $mysqli->error;
}

$mysqli->close();
?>
