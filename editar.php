<?php
// Iniciar sessão
session_start();

// Incluir a conexão com o banco de dados
include('conexao.php');

// Verificar se o ID do aluno foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar dados do aluno
    $sql = "SELECT id, nome, email, idade FROM alunos WHERE id = ?";
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

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
</head>
<body>
    <h1>Editar Aluno</h1>
    <form method="POST" action="processar_atualizacao.php">
        <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $aluno['email']; ?>" required><br>

        <label for="idade">Idade:</label>
        <input type="number" name="idade" value="<?php echo $aluno['idade']; ?>" required><br>

        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Voltar à lista de alunos</a>
</body>
</html>