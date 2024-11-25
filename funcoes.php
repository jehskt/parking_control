<?php

require_once("class/database.php");

// Função para registrar entrada automaticamente (chamada pela câmera)
function registrarEntradaAutomatica($placa) {
    $conn = new Database();
    $link = $conn->getConexao();
    $hora_entrada = date('Y-m-d H:i:s');  // Hora atual

    try {
        $query = "INSERT INTO registros (placa, hora_entrada) VALUES (:placa, :hora_entrada)";
        $stmt = $link->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':hora_entrada', $hora_entrada);
        $stmt->execute();

        echo "Entrada registrada com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao registrar entrada automática: " . $e->getMessage();
    }
}

// Função para registrar saída automaticamente (chamada pela câmera)
function registrarSaidaAutomatica($placa) {
    $conn = new Database();
    $link = $conn->getConexao();
    $hora_saida = date('Y-m-d H:i:s');  // Hora atual

    try {
        $query = "UPDATE registros SET hora_saida = :hora_saida WHERE placa = :placa AND hora_saida IS NULL";
        $stmt = $link->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':hora_saida', $hora_saida);
        $stmt->execute();

        echo "Saída registrada com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao registrar saída automática: " . $e->getMessage();
    }
}
?>
