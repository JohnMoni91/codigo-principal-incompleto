<?php
include 'db.php';

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'SIM') {
    header('Location: login.php?login=erro2');
    exit();
}
// Validação do cliente

// Contagem de itens da lista de desejos
$wishlist_count = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;

// Verificar se a lista de desejos está vazia
$is_wishlist_empty = empty($_SESSION['wishlist']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Desejos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/corujinha.png"/>
</head>
<body>
<?php 
include 'cabecalho.php';
?>
   
<div class="container mt-4">
    <h2>Lista de Desejos</h2>

    <?php if ($is_wishlist_empty): ?>
        <p>Sua lista de desejos está vazia.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['wishlist'] as $id => $item):
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nome']); ?></td>
                        <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                        <td>
                            <a href="remover_wishlist.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remover</a>
                            <a href="adicionar_carrinho.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Adicionar ao Carrinho</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include 'rodape.html'; ?>
</body>
</html>
