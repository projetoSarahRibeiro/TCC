<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Sanitizando os dados
    $email = $conn->real_escape_string($email);

    if ($tipo_usuario == 'psicologo') {
        $sql = "SELECT * FROM psicologos WHERE email = ?";
    } else if ($tipo_usuario == 'crianca') {
        $sql = "SELECT * FROM criancas WHERE email_cria = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        if (password_verify($senha, $usuario['senha']) || password_verify($senha, $usuario['senha_cria'])) {
            echo "Login realizado com sucesso!";
            // Redirecionar para página apropriada
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Email não encontrado!";
    }

    $stmt->close();
}
$conn->close();
?>
