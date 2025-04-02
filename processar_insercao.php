<?php
// Iniciar sessão
session_start();

// Incluir a conexão com o banco de dados
include('conexao.php');

// Verificar se os dados foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $idade = $_POST["idade"];

    // Adicionar aluno à sessão
    $novo_aluno = array(
        'nome' => $nome,
        'email' => $email,
        'idade' => $idade
    );

    // Verificar se já existem alunos na sessão
    if (!isset($_SESSION['alunos'])) {
        $_SESSION['alunos'] = array(); // Inicializar a sessão se ainda não existir
    }

    // Adicionar aluno à lista de alunos na sessão
    $_SESSION['alunos'][] = $novo_aluno;

    // Inserir aluno na base de dados
    $sql = "INSERT INTO alunos (nome, email, idade) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $email, $idade);

    if ($stmt->execute()) {
        // Redirecionar para a lista de alunos após a inserção
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao adicionar aluno: " . $stmt->error;
    }

    $stmt->close();
}
?>