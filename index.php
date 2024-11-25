<?php

date_default_timezone_set('America/Sao_Paulo');

require_once("class/database.php");
require_once("funcoes.php");

$conn = new Database();
$link = $conn->getConexao();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber a placa do formulário
    $placa = strtoupper(trim($_POST['placa']));

    // Validar o formato da placa (Mercosul ou antiga) estouro 
    if (preg_match('/^[A-Z]{3}[0-9]{1}[A-Z]{1}[0-9]{2}$/', $placa) || 
        preg_match('/^[A-Z]{3}[0-9]{4}$/', $placa)) {
        
        // Inserir no banco de dados
        $sql = "INSERT INTO registros (placa, entrada) VALUES (:placa, NOW())";
        $stmt = $link->prepare("INSERT INTO registros (placa, hora_entrada) VALUES (:placa, NOW())");
        $stmt->bindParam(':placa', $placa);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Entrada registrada com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao registrar entrada.</p>";
        }
    } else {
        echo "<p style='color: red;'>Formato de placa inválido!</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrar Entrada</title>
</head>
<body>
    <h1>
    <img src="img/logo.png" alt="Logo AlucoMaxx">
        Registrar Entrada de Veículo
    </h1>
    
    <div class="nav-links">
        <a href="index.php">Registrar Entrada</a>
        <a href="saida.php">Registrar Saída</a>
        <a href="visualizar.php">Registros de Entrada e saida</a>
    </div>
    <hr>
    <form method="POST">
        <label for="placa">Placa do Veículo:</label>
        <input type="text" id="placa" name="placa" maxlength="7" required>
        <button type="submit">Registrar</button>
    </form>
    <footer>
    <p>&copy; 2024 AlucoMaxx. Todos os direitos reservados.</p>
</footer>

</body>
</html>