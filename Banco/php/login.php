<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="verificar_login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br><br>

        <label for="tipo_usuario">Tipo de Usuário:</label>
        <select name="tipo_usuario" required>
            <option value="psicologos">Psicólogo</option>
            <option value="crianca">Criança</option>
        </select><br><br>

        <input type="submit" value="Entrar">
    </form>

    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
</body>
</html>
