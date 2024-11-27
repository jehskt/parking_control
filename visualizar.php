<?php

require_once("class/database.php");

$conn = new Database();
$link = $conn->getConexao();

try {
    $query = "SELECT * FROM registros ORDER BY id DESC";
    $stmt = $link->prepare($query);
    $stmt->execute();
    $registros = $stmt->fetchAll();
} catch (Exception $e) {
    die("Erro ao carregar os registros: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Visualizar Registros</title>

</head>

<body>
    <h1>
        <img src="./class/img/alucomaxx_logo_tagged_white_1.png" alt="Logo AlucoMaxx">
        Registros de Entrada e Saída
    </h1>
    <div class="nav-links">
        <a href="index.php">Registrar Entrada</a>
        <a href="saida.php">Registrar Saída</a>
        <a href="visualizar.php">Registros de Entrada e saida</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa</th>
                <th>Nome</th>
                <th>Empresa</th>
                <th>Hora de Entrada</th>
                <th>Hora de Saída</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($registros)): ?>
                <tr>
                    <td colspan="5">Nenhum registro encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?php echo $registro['id']; ?></td>
                        <td><?php echo $registro['placa']; ?></td>
                        <td><?php echo $registro['nome']; ?></td>
                        <td><?php echo $registro['empresa']; ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($registro['hora_entrada'])); ?></td>
                        <td><?php echo $registro['hora_saida'] ? date('d/m/Y H:i:s', strtotime($registro['hora_saida'])) : 'Ainda dentro'; ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($registro['criado_em'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
<footer>
    <p>&copy; 2024 AlucoMaxx. Todos os direitos reservados.</p>
</footer>

</html>