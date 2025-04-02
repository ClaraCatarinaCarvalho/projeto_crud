<?php
// Iniciar sessão
session_start();

// Incluir a conexão com o banco de dados
include('conexao.php');

// Verificar se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $idade = $_POST["idade"];

    // Atualizar dados do aluno no banco de dados
    $sql = "UPDATE alunos SET nome = ?, email = ?, idade = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nome, $email, $idade, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar aluno: " . $stmt->error;
    }

    $stmt->close();
}
?>