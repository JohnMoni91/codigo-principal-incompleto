<?php
include 'validatoradmin.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'cabecalho.php' ?>

    <div id="criarproduto">
        <form action="processa_criar_produto.php" method="post" enctype="multipart/form-data">
            <div class="containercriarprodutosform">
                <div class="formcriarprodutos">
                    <label for="nome">Nome
                        <input type="text" class="inputcriarprodutos" id="nome" name="nome" placeholder="Nome">
                    </label>
                    <label for="descricao">Descrição
                        <textarea class="inputcriarprodutos" id="descricao" name="descricao" rows="5" cols="30" placeholder="Descrição"></textarea>
                    </label>
                    <label for="preco">Preço
                        <input type="number" step="0.02" name="preco" class="inputcriarprodutos" placeholder="Preço">
                    </label>
                </div>
                <div class="formcriarprodutos">
                    <label for="altura">Altura
                        <input type="number" class="inputcriarprodutos" name="altura" placeholder="Altura" step="0.02">
                    </label>
                    <label for="largura">Largura
                        <input type="number" class="inputcriarprodutos" name="largura" placeholder="Largura" step="0.02">
                    </label>
                    <label for="comprimento">Comprimento
                        <input type="number" class="inputcriarprodutos" name="comprimento" placeholder="Comprimento" step="0.02">
                    </label>
                </div>
                <div class="imagemdoformcriarprodutos">
                    <label>
                        <input type="file" id="imagem" name="foto">
                        <img id="preview" src="" class="imagemdoformcriarprodutos" alt="Pré-visualização da imagem">
                    </label>
                </div>
            </div>
            <input type="submit" class="inputcriarprodutos submitdocriarprodutos" value="Criar Produto">
            <a href="logoff.php" class="btn btn-danger">Logoff</a>
        </form>
    </div>

    <script>
        const inputImagem = document.getElementById('imagem');
        const previewImagem = document.getElementById('preview');

        inputImagem.addEventListener('change', () => {
        const arquivoImagem = inputImagem.files[0];

        if (arquivoImagem) {
            const reader = new FileReader();

            reader.onload = (e) => {
            previewImagem.src = e.target.result;
            };

            reader.readAsDataURL(arquivoImagem);
        } else {
            previewImagem.src = "";
        }
        });
    </script>
<?php include 'rodape.html' ?>
</body>

</html>
