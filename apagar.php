<?php
// Incluir a conexão com o banco de dados
include('conexao.php');

// Verificar se o ID do aluno foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar dados do aluno
    $sql = "SELECT nome FROM alunos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
    } else {
        echo "Aluno não encontrado.";
        exit;
    }
} else {
    echo "ID do aluno não especificado.";
    exit;
}

// Processar a exclusão do aluno
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Apagar o aluno do banco de dados
    $delete_sql = "DELETE FROM alunos WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id);

    if ($delete_stmt->execute()) {
        // Redirecionar para a lista de alunos após a exclusão
        header("Location: index.php?msg=Aluno removido com sucesso!");
        exit();
    } else {
        echo "Erro ao remover aluno: " . $delete_stmt->error;
    }

    $delete_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Aluno</title>
</head>
<body>
    <h1>Remover Aluno</h1>
    <p>Você tem certeza que deseja remover o aluno <strong><?php echo $aluno['nome']; ?></strong>?</p>
    
    <form method="POST" action="apagar.php?id=<?php echo $id; ?>">
        <button type="submit">Sim, Remover</button>
    </form>
    
    <a href="index.php">Cancelar e voltar à lista</a>
</body>
</html>