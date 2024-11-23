<?php
include '../conexao.php';
include '../validacao_aluno.php';
require '../vendor/autoload.php'; // Caminho para o autoload do PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$tipo_relatorio = $_GET['tipo_relatorio'] ?? '';

if (!$tipo_relatorio) {
    die('Tipo de relatório não especificado.');
}

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Define o título da planilha
switch ($tipo_relatorio) {
    case 'presenca':
        $sheet->setCellValue('A1', 'Relatório de Presença dos Alunos');
        // Exemplo de consulta para presença
        $sql = "SELECT nome, frequencia FROM alunos";
        $resultado = $mysqli->query($sql);
        $row = 2; // Começa a preencher da linha 2

        while ($aluno = $resultado->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $aluno['nome']);
            $sheet->setCellValue('B' . $row, $aluno['frequencia']);
            $row++;
        }
        break;

    case 'atividades':
        $sheet->setCellValue('A1', 'Relatório de Atividades Realizadas');
        // Exemplo de consulta para atividades
        $sql = "SELECT nome, atividade, data_realizada FROM atividades";
        $resultado = $mysqli->query($sql);
        $row = 2;

        while ($atividade = $resultado->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $atividade['nome']);
            $sheet->setCellValue('B' . $row, $atividade['atividade']);
            $sheet->setCellValue('C' . $row, $atividade['data_realizada']);
            $row++;
        }
        break;

    case 'desempenho':
        $sheet->setCellValue('A1', 'Relatório de Desempenho dos Alunos');
        // Exemplo de consulta para desempenho
        $sql = "SELECT nome, desempenho FROM alunos";
        $resultado = $mysqli->query($sql);
        $row = 2;

        while ($aluno = $resultado->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $aluno['nome']);
            $sheet->setCellValue('B' . $row, $aluno['desempenho']);
            $row++;
        }
        break;

    default:
        die('Tipo de relatório inválido.');
}

// Define o cabeçalho para download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="relatorio_' . $tipo_relatorio . '.xlsx"');
header('Cache-Control: max-age=0');

// Salva o arquivo Excel e faz o download
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
