<?php
include 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_cria = $_POST['nome_cria'];
    $email_cria = $_POST['email_cria'];
    $senha_cria = password_hash($_POST['senha_cria'], PASSWORD_DEFAULT); // Criptografa a senha

    // Prepara a consulta SQL para inserir a criança
    $stmt = $conn->prepare("INSERT INTO criancas (nome_cria, email_cria, senha_cria) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome_cria, $email_cria, $senha_cria);

    // Executa a inserção e verifica se foi bem-sucedida
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar.";
    }

    $stmt->close(); // Fecha a consulta
}

$conn->close(); // Fecha a conexão com o banco
?>
