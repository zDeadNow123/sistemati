<?php
    // incluindo variáveis de ambiente, acesso e banco
    include('../config.php');
    include('acesso_com.php');
    include('../connections/conn.php');

    if($_POST) {
        // Guardando o nome da imagem no banco de dados e o arquivo no diretório images
        if($_FILES['imagem_produto']['name']) {
            $nome_img = $_FILES['imagem_produto']['name'];
            $tpm_img = $_FILES['imagem_produto']['tpm_name'];
            $pasta_img = "../images/".$nome_img;
            move_uploaded_file($tpm_img, $pasta_img);

        } else {
            $nome_img = $_POST['imagem_produto_atual'];
        }
        
        // receber os dados do formulário
        // organizar os campos na mesma ordem
        $id_tipo_produto = $_POST['id_tipo_produto'];
        $destaque_produto = $_POST['destaque_produto'];
        $descri_produto = $_POST['descri_produto'];
        $resumo_produto = $_POST['resumo_produto'];
        $valor_produto = $_POST['valor_produto'];
        $imagem_produto = $nome_img;

        // Campo do form para filtrar o registro
        $id_filtro = $_POST['id_produto'];

        // Consulta (query) SQL para inserção dos dados
        $query = "update tbprodutos set destaque_produto = '".$destaque_produto."', descri_produto = '".$descri_produto."', resumo_produto = '".$resumo_produto."', valor_produto = ".$valor_produto.", imagem_produto = '".$imagem_produto."' where id_produto = ".$id_filtro.";";

        $resultado = $conn->query($query);

        // Após a ação, a página será direcionada
        if ($conn->prepare($query)) {
            header('location: produto_lista.php');
            // adicionar tratamento...
        } else {
            header('location: produto_lista.php');
        }

        // Consulta para recuperar dados do filtro da chamada da página...
        $id_alterar = $_GET['id_produto'];
        $query_busca = "select * from tbprodutos where id_produto = ".$id_alterar;
        $lista = $conn->query($query_busca);
        $linha = $lista->fetch(PDO::FETCH_ASSOC);
        $totalLinhas = $lista->rowCount();

        $consulta_fk = "select * from ".Tabelas::tbtipos;
        $lista_fk = $conn->query($consulta_fk);
        $linha_fk = $lista_fk->fetch(PDO::FETCH_ASSOC);
        $total_linhas_fk = $lista_fk->rowCount();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SYS_NAME?> - Admin (Alterar)</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>
<body>
    <?php include('menu_adm.php'); ?>

    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
                <h2 class="breadcrumb text-danger">
                    <a href="produto_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando produtos
                </h2>
            </div>
        </div>
    </main>
</body>
</html>