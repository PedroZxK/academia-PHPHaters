<?php
// Inclui o autoload do Composer para carregar o PhpSpreadsheet
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include '../conexao.php';
include '../validacao_instrutor.php';

// Criação da planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Relatório de Presença');

// Configuração de cabeçalhos das colunas
$sheet->setCellValue('A1', 'ID do Aluno');
$sheet->setCellValue('B1', 'Nome');
$sheet->setCellValue('C1', 'Presenças');
$sheet->setCellValue('D1', 'Desempenho');

// Estilização dos cabeçalhos (opcional)
$headerStyle = [
    'font' => ['bold' => true],
    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
    'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
];
$sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

// Consulta ao banco de dados para obter os dados dos alunos
$sql = "SELECT id, nome, presencas, desempenho FROM alunos";
$result = $mysqli->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    $row = 2; // Início da linha para dados (abaixo dos cabeçalhos)

    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $data['id']);
        $sheet->setCellValue('B' . $row, $data['nome']);
        $sheet->setCellValue('C' . $row, $data['presencas']);
        $sheet->setCellValue('D' . $row, $data['desempenho']);
        $row++;
    }
} else {
    echo 'Nenhum dado encontrado.';
    exit();
}

// Ajuste automático das larguras das colunas (opcional)
foreach (range('A', 'D') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Define o nome do arquivo
$filename = 'relatorio_presenca.xlsx';

// Configurações de cabeçalho para download do arquivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Gera e baixa o arquivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
