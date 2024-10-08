<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="verificar_login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="senha">Senha:</label>
        <input type="senha" name="senha" required>
        
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
