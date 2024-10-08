<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografar a senha

    // Sanitização
    $nome = $conn->real_escape_string($nome);
    $email = $conn->real_escape_string($email);

    // Verifica se o email já está cadastrado
    $stmt = $conn->prepare("SELECT id_psi FROM psicologos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Email já cadastrado!";
    } else {
        // Prepara a consulta SQL para inserção
        $stmt = $conn->prepare("INSERT INTO psicologos (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senha);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
