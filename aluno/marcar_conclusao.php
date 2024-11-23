<?php
include '../conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o array $_POST['concluido'] foi enviado
    if (isset($_POST['concluido'])) {
        $concluidos = $_POST['concluido'];
        echo '<pre>';
        print_r($concluidos);  // Depuração: Exibe os planos marcados
        echo '</pre>';
        
        // Primeiramente, desmarcamos todos os planos
        $sql_update = "UPDATE planos SET concluido = 0";
        if ($mysqli->query($sql_update) === TRUE) {
            echo "Todos os planos foram desmarcados.<br>";
        } else {
            echo "Erro ao desmarcar planos: " . $mysqli->error . "<br>";
        }

        // Agora, marcamos os planos que foram enviados (marcados)
        if (count($concluidos) > 0) {
            $ids = implode(",", $concluidos);  // Cria uma lista com os IDs dos planos marcados
            $sql_update = "UPDATE planos SET concluido = 1 WHERE id IN ($ids)";
            if ($mysqli->query($sql_update) === TRUE) {
                echo "Planos marcados como concluídos com sucesso.<br>";
            } else {
                echo "Erro ao atualizar os planos concluídos: " . $mysqli->error . "<br>";
            }
        }

        // Redireciona de volta para a página de lista após o envio
        header('Location: lista_planos.php');
        exit;
    } else {
        echo 'Nenhum plano foi marcado para alteração.<br>';
    }
}

$mysqli->close();
?>
