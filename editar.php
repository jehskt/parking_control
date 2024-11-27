<?php
require_once("class/database.php");

$conn = new Database();
$link = $conn->getConexao();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o registro no banco
    $query = "SELECT * FROM registros WHERE id = :id";
    $stmt = $link->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $registro = $stmt->fetch();

    if (!$registro) {
        echo "<p style='color: red;'>Registro não encontrado.</p>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $placa = strtoupper(trim($_POST['placa']));
    $nome = trim($_POST['nome']);
    $empresa = trim($_POST['empresa']);

    try {
        $query = "UPDATE registros SET placa = :placa, nome = :nome, empresa = :empresa WHERE id = :id";
        $stmt = $link->prepare($query);
        $stmt->bindParam(':placa', $placa);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':empresa', $empresa);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<p style='color: green;'>Registro atualizado com sucesso!</p>";
        echo "<a href='visualizar.php'>Voltar</a>";
        exit;
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erro ao atualizar o registro: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Editar Registro</title>
</head>
<body>
    <h1>Editar Registro</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" value="<?php echo $registro['placa']; ?>" required>
        <br>
        <br>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $registro['nome']; ?>" required>
        <br>
        <br>
        <label for="empresa">Empresa:</label>
        <input type="text" id="empresa" name="empresa" value="<?php echo $registro['empresa']; ?>" required>
        <br>
        <br>
        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
