<?php
header('Content-Type: application/json');
include 'conexao.php'; // Inclui a conexão com o banco de dados

// Obtém o método da requisição
$request_method = $_SERVER['REQUEST_METHOD'];

// Função para obter todos os psicólogos ou crianças
function get_users($tipo) {
    global $conn;
    $table = $tipo == 'psicologos' ? 'psicologos' : 'criancas';
    $stmt = $conn->prepare("SELECT * FROM $table");
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
}

// Função para criar um novo psicólogo ou criança
function create_user($tipo) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    
    if ($tipo == 'psicologo') {
        $stmt = $conn->prepare("INSERT INTO psicologos (nome, email, senha) VALUES (?, ?, ?)");
        $senha = password_hash($data['senha'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $data['nome'], $data['email'], $senha);
    } else {
        $stmt = $conn->prepare("INSERT INTO criancas (nome_cria, email_cria, senha_cria) VALUES (?, ?, ?)");
        $senha = password_hash($data['senha_cria'], PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $data['nome_cria'], $data['email_cria'], $senha);
    }

    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuário criado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao criar usuário: " . $stmt->error]);
    }
}

// Função para atualizar um psicólogo ou criança
function update_user($tipo, $id) {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    if ($tipo == 'psicologo') {
        $stmt = $conn->prepare("UPDATE psicologos SET nome = ?, email = ? WHERE id_psi = ?");
        $stmt->bind_param("ssi", $data['nome'], $data['email'], $id);
    } else {
        $stmt = $conn->prepare("UPDATE criancas SET nome_cria = ?, email_cria = ? WHERE id_cria = ?");
        $stmt->bind_param("ssi", $data['nome_cria'], $data['email_cria'], $id);
    }

    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuário atualizado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar usuário: " . $stmt->error]);
    }
}

// Função para deletar um psicólogo ou criança
function delete_user($tipo, $id) {
    global $conn;
    $table = $tipo == 'psicologos' ? 'psicologos' : 'criancas';
    $stmt = $conn->prepare("DELETE FROM $table WHERE " . ($tipo == 'psicologos' ? 'id_psi' : 'id_cria') . " = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuário deletado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao deletar usuário: " . $stmt->error]);
    }
}

// Controlador da API
switch ($request_method) {
    case 'GET':
        if (isset($_GET['tipo'])) {
            get_users($_GET['tipo']);
        } else {
            echo json_encode(["error" => "Tipo não especificado!"]);
        }
        break;
    case 'POST':
        if (isset($_GET['tipo'])) {
            create_user($_GET['tipo']);
        } else {
            echo json_encode(["error" => "Tipo não especificado!"]);
        }
        break;
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        if (isset($_PUT['tipo']) && isset($_PUT['id'])) {
            update_user($_PUT['tipo'], $_PUT['id']);
        } else {
            echo json_encode(["error" => "Tipo ou ID não especificados!"]);
        }
        break;
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE['tipo']) && isset($_DELETE['id'])) {
            delete_user($_DELETE['tipo'], $_DELETE['id']);
        } else {
            echo json_encode(["error" => "Tipo ou ID não especificados!"]);
        }
        break;
    default:
        echo json_encode(["error" => "Método não suportado!"]);
        break;
}

$conn->close();
?>
