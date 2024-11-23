<?php
include '../conexao.php';
include '../validacao_instrutor.php';

// Consultas para coletar dados

// Frequência média por turma
$sqlFrequencia = "SELECT t.nome AS turma, AVG(a.frequencia) AS frequencia_media 
                  FROM turmas t
                  JOIN alunos a ON t.id = a.turma_id
                  GROUP BY t.id";
$resultFrequencia = $mysqli->query($sqlFrequencia);

// Desempenho médio (notas) por turma
$sqlDesempenho = "SELECT t.nome AS turma, AVG(a.desempenho) AS media_desempenho 
                  FROM turmas t
                  JOIN alunos a ON t.id = a.turma_id
                  GROUP BY t.id";
$resultDesempenho = $mysqli->query($sqlDesempenho);

// Quantidade de feedbacks por turma
$sqlFeedbacks = "SELECT t.nome AS turma, COUNT(f.id) AS total_feedbacks 
                 FROM turmas t
                 LEFT JOIN feedbacks f ON t.id = f.turma_id
                 GROUP BY t.id";
$resultFeedbacks = $mysqli->query($sqlFeedbacks);

// Converte os dados em arrays para o Chart.js
$frequenciaData = [];
$desempenhoData = [];
$feedbackData = [];

while ($row = $resultFrequencia->fetch_assoc()) {
    $frequenciaData[] = ['turma' => $row['turma'], 'frequencia' => $row['frequencia_media']];
}

while ($row = $resultDesempenho->fetch_assoc()) {
    $desempenhoData[] = ['turma' => $row['turma'], 'nota_media' => $row['media_desempenho']];
}

while ($row = $resultFeedbacks->fetch_assoc()) {
    $feedbackData[] = ['turma' => $row['turma'], 'feedbacks' => $row['total_feedbacks']];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analítico</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/css/dashboard_analitico.css">
    <link rel="shortcut icon" href="..\assets\img\logourl.png" type="image/x-icon">
</head>
<body>
    <h1>Dashboard Analítico</h1>

    <section>
        <h2>Frequência Média por Turma</h2>
        <canvas id="frequenciaChart"></canvas>
    </section>

    <section>
        <h2>Desempenho Médio por Turma</h2>
        <canvas id="desempenhoChart"></canvas>
    </section>

    <section>
        <h2>Total de Feedbacks por Turma</h2>
        <canvas id="feedbackChart"></canvas>
    </section>

    <script>
        // Dados para o gráfico de frequência
        const frequenciaLabels = <?php echo json_encode(array_column($frequenciaData, 'turma')); ?>;
        const frequenciaValores = <?php echo json_encode(array_column($frequenciaData, 'frequencia')); ?>;
        
        const frequenciaChart = new Chart(document.getElementById('frequenciaChart'), {
            type: 'bar',
            data: {
                labels: frequenciaLabels,
                datasets: [{
                    label: 'Frequência Média (%)',
                    data: frequenciaValores,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Dados para o gráfico de desempenho
        const desempenhoLabels = <?php echo json_encode(array_column($desempenhoData, 'turma')); ?>;
        const desempenhoValores = <?php echo json_encode(array_column($desempenhoData, 'nota_media')); ?>;

        const desempenhoChart = new Chart(document.getElementById('desempenhoChart'), {
            type: 'bar',
            data: {
                labels: desempenhoLabels,
                datasets: [{
                    label: 'Nota Média',
                    data: desempenhoValores,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });

        // Dados para o gráfico de feedback
        const feedbackLabels = <?php echo json_encode(array_column($feedbackData, 'turma')); ?>;
        const feedbackValores = <?php echo json_encode(array_column($feedbackData, 'feedbacks')); ?>;

        const feedbackChart = new Chart(document.getElementById('feedbackChart'), {
            type: 'pie',
            data: {
                labels: feedbackLabels,
                datasets: [{
                    label: 'Total de Feedbacks',
                    data: feedbackValores,
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ]
                }]
            }
        });
    </script>
</body>
</html>
