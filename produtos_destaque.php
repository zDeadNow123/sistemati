<?php
include('connections/conn.php');

$consulta = "SELECT * from vw_tbprodutos where destaque_produto = 'sim' and deletado is null order by descri_produto";

$lista = $conn->query($consulta);
$linha = $lista->fetch(PDO::FETCH_ASSOC);
$totalLinhas = $lista->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos em Destaque</title>
    <link rel="stylesheet" href="css/meu_estilo.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body class="fundofixo">
    <main class="container">
        <h2 class="breadcrumb alert-danger">Destaques</h2>
        <div class="row">
            <!-- linha de produto -->

            <!-- Inicio estrutura de repetição -->
            <!-- Abre thumbnail / card -->
            <?php do { ?>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto'] ?>">
                            <img src="images/<?php echo $linha['imagem_produto']; ?>" alt="" class="img-responsive img-rounded">
                        </a>
                        <div class="caption text-right">
                            <h3 class="text-danger">
                                <strong><?php echo $linha['descri_produto']; ?></strong>
                            </h3>
                            <p class="text-warning">
                                <?php echo $linha['rotulo_tipo']; ?>
                            </p>
                            <p class="text-left">
                                <?php echo mb_strimwidth($linha['resumo_produto'], 0, 42, '...'); ?>
                            </p>
                            <p>
                                <button class="btn btn-default disabled" role="button" style="cursor:default;">
                                    <?php echo number_format($linha['valor_produto'], 2, ',', '.'); ?>
                                </button>
                                <a href="produto_detalhe.php?id_produto=<?php echo $linha['id_produto']; ?>" class="btn btn-danger" role="button">
                                    <span class="hidden-xs">Saiba mais...</span>
                                    <span class="visible-xs glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a>
                            </p>
                        </div><!-- Final caption -->
                    </div>
                </div> <!-- Fecha thumbnail / card -->
            <?php } while ($linha = $lista->fetch(PDO::FETCH_ASSOC)); ?>
            <!-- Final estrutura de repetição -->
        </div><!-- final linha de produto -->
    </main>

    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>