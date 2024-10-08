<?php
header('Content-Type: application/json');

// Dados simulados
$data = [
    'psicologos' => [
        ['id_psi' => 1, 'nome' => 'Dr. João', 'email' => 'joao@example.com'],
        ['id_psi' => 2, 'nome' => 'Dra. Maria', 'email' => 'maria@example.com'],
    ],
    'criancas' => [
        ['id_cria' => 1, 'nome_cria' => 'Pedro', 'email_cria' => 'pedro@example.com'],
        ['id_cria' => 2, 'nome_cria' => 'Ana', 'email_cria' => 'ana@example.com'],
    ],
];

echo json_encode($data);
?>
