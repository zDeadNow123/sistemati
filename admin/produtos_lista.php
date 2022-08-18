<?php
    // Incluindo o sistema de autenticação
    include('acesso_com.php');

    // Incluindo o arquivo de conexão
    include('../connections/conn.php');

    // Selecionando dados
    $consulta = "select * from vw_tbprodutos order by descri_produto asc";

    // Buscar a lista completa de produtos
    $lista = $conn->query($consulta);

    // Separar produtos por linha
    $linha = $lista->fetch(PDO::FETCH_ASSOC);

    // Contar número de linhas da lista
    $total_linhas = $lista->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text">;
    <title>Produtos (<?php echo $total_linhas;?>) - Lista</title>
</head>
<body class="fundofixo">
    <?php include('menu_adm.php'); ?>

    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Produtos</h2>
        <table class="table table-condensed table-hover tbopacidade">
            <!-- thead >th*8 -->
            <thead>
                <th class="hidden">id</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Resumo</th>
                <th>Valor</th>
                <th>Imagem</th>
                <th>
                    <a href="produtos_inserir.php" class="btn btn-block btn-primary btn-xs">
                        <span class="hidden-xs">Adicionar<br></span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
            </thead><!-- Fecha linha de cabeçalho da tabela -->

            <!-- tbody>tr>td*8 -->
            <tbody> <!-- Corpo da tabela -->
                <tr> <!-- Linha da tabela -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr><!-- Fecha linha da tabela -->
            </tbody><!-- Fecha corpo da tabela -->
        </table>
    </main>
</body>
</html>