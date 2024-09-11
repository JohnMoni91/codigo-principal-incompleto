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
    /*A função "trim" é usado para limpar espaços brancos/vazios.
    
    A função isset verifica se uma variável está definida e não é null.
    Costuma ser usado para ter certeza que o valor realmente exista.*/

    /* Signficado do "s" e "d". 
    "D" = é um parâmentro que é usado para valores numéricos que tenham casas decimais.
    "S" = é um string, sendo assim, é aonde que está pegando as informações do script.
    */ 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $preco = isset($_POST['preco']);
    $altura = isset($_POST['altura']);
    $largura = isset($_POST['largura']);
    $comprimento = isset($_POST['comprimento']);
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);

    // Verifica se o diretório 'uploads/' existe
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Tenta mover o arquivo para o diretório de uploads
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Preparar e executar a consulta SQL
        $stmt = $conn->prepare("INSERT INTO produtos (nome, descricao, preco, altura, largura, comprimento, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Verifique se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }

        $stmt->bind_param("ssiddds", $nome, $descricao, $preco, $altura, $largura, $comprimento, $foto);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao inserir produto: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao fazer upload da foto.";
    }

    $conn->close();
}
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
