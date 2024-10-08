<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="inserir_usuario.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        
        <input type="submit" value="Cadastrar">
    </form>
    <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
</body>
</html>
