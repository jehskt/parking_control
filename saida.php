<?php

date_default_timezone_set('America/Sao_Paulo');


require_once("class/database.php");
require_once("funcoes.php");

$conn = new Database();
$link = $conn->getConexao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = strtoupper(trim($_POST['placa'])); // Garantir que a placa esteja em maiúsculas e sem Ramelar espaços extras
    $hora_saida = date('Y-m-d H:i:s');  // Hora atual

    // Estouro!!  Verificar se a placa está registrada no banco de dados e se ainda não tem uma hora de saída
    try {
        // Verifica se existe a placa sem hora de saída registrada
        $query = "SELECT * FROM registros WHERE placa = :placa AND hora_saida IS NULL";
        $stmt = $link->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->execute();

        // Se existir, registra a hora de saída
        if ($stmt->rowCount() > 0) {
            $updateQuery = "UPDATE registros SET hora_saida = :hora_saida WHERE placa = :placa AND hora_saida IS NULL";
            $updateStmt = $link->prepare($updateQuery);
            $updateStmt->bindParam(':placa', $placa);
            $updateStmt->bindParam(':hora_saida', $hora_saida);
            $updateStmt->execute();
            echo "<p style='color: green;'>Saída registrada com sucesso!</p>";
        } else {
            // Caso não haja um veículo com a placa registrada como ai dentro... lá ele
            echo "<p style='color: red;'>Placa não encontrada ou já registrou a saída.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erro ao registrar saída: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrar Saída</title>
</head>
<body>
    <h1>
    <img src="./class/img/alucomaxx_logo_tagged_white_1.png" alt="Logo AlucoMaxx">
        Registrar Saída de Veículo
    </h1>
    <div class="nav-links">
        <a href="index.php">Registrar Entrada</a>
        <a href="saida.php">Registrar Saída</a>
        <a href="visualizar.php">Registros de Entrada e Saída</a>
    </div>
    <hr>
    <form method="POST">
        <label for="placa">Placa do Veículo:</label>
        <input type="text" id="placa" name="placa" maxlength="7" required>
        <button type="submit">Registrar Saída</button>
    </form>
</body>
</html>
