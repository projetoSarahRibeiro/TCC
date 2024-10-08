<?php
$servername = "localhost";
$nome = "nome";
$senha = "sua_senha";
$dbname = "seu_banco_de_dados";

$conn = new mysqli($servername, $nome, $senha, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
