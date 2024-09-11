<?php
include 'validatoradmin.php';

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baloja";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Processar e limpar os dados do formulário
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $preco = isset($_POST['preco']) ? trim($_POST['preco']) : '';
    $altura = isset($_POST['altura']) ? trim($_POST['altura']) : '';
    $largura = isset($_POST['largura']) ? trim($_POST['largura']) : '';
    $comprimento = isset($_POST['comprimento']) ? trim($_POST['comprimento']) : '';
    $foto = isset($_POST['foto']) ? trim($_POST['foto']) : '';

    /*A função "trim" é usado para limpar espaços brancos/vazios.
    
    A função isset verifica se uma variável está definida e não é null.
    Costuma ser usado para ter certeza que o valor realmente exista.*/

    // Validação básica
    if (empty($nome) || empty($preco)) {
        echo "Nome e preço são obrigatórios.";
        exit();
    }

    // Preparar a declaração
    $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, altura, largura, comprimento, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddddd", $nome, $descricao, $preco, $altura, $largura, $comprimento, $foto);

    /* Signficado do "s" e "d". 
    "D" = é um parâmentro que é usado para valores numéricos que tenham casas decimais.
    "S" = é um string, sendo assim, é aonde que está pegando as informações do script.
    */ 

    // Executar a inserção
    if ($stmt->execute()) {
        echo "Sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fechar a declaração
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <a href="logoff.php">Sair</a>
</body>
</html>
