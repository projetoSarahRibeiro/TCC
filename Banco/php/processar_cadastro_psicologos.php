<?php
include 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

    // Primeiro, insira no banco de dados
    $stmt = $conn->prepare("INSERT INTO psicologos (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        // Agora vamos enviar uma solicitação para a API
        $data = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $_POST['senha'], // Enviando senha em texto simples, normalmente você não faria isso
        ];

        $ch = curl_init('http://localhost/seu_projeto/api.php'); // URL da API
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);

        // Opcional: Você pode manipular a resposta da API aqui
        // echo $response;

        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar.";
    }

    $stmt->close(); // Fecha a consulta
}

$conn->close(); // Fecha a conexão com o banco
?>
