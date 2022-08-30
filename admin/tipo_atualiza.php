<?php
// incluindo variáveis de ambiente, acesso e banco
include('../config.php');
include('acesso_com.php');
include('../connections/conn.php');

if ($_POST) {
    // receber os dados do formulário
    // organizar os campos na mesma ordem
    $rotulo_tipo = $_POST['rotulo_tipo'];
    $sigla_tipo = $_POST['sigla_tipo'];

    // Campo do form para filtrar o registro
    $id = $_POST['id_tipo'];

    // Consulta (query) SQL para inserção dos dados
    $query = "update tbtipos set sigla_tipo = '$sigla_tipo', rotulo_tipo = '$rotulo_tipo' where id_tipo = " . $id . ";";

    $resultado = $conn->query($query);

    // Após a ação, a página será direcionada
    if ($conn->lastInsertId($query)) {
        header('location: tipo_lista.php');
        // adicionar tratamento...
    } else {
        header('location: tipo_lista.php');
    }

}
    // Consulta para recuperar dados do filtro da chamada da página...
    $id_alterar = $_GET['id_tipo'];
    $query_busca = "select * from tbtipos where id_tipo = " . $id_alterar;
    $lista = $conn->query($query_busca);
    $linha = $lista->fetch(PDO::FETCH_ASSOC);
    $totalLinhas = $lista->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
    <title><?php echo SYS_NAME ?></title>
</head>

<body class="">
    <?php include('menu_adm.php'); ?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="tipo_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando Tipos
                </h2>
                <div class="thumbnail">
                    <!-- Abre Thumbnail -->
                    <div class="alert alert-danger" role="alert">
                        <form action="tipo_atualiza.php" method="post" id="form_tipo_atualiza" name="form_tipo_atualiza" enctype="multipart/form-data">
                            <input type="hidden" name="id_tipo" id="id_tipo" value="<?php echo $linha['id_tipo']; ?>">
                            <label for="sigla_produto">Sigla:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sigla_tipo" name="sigla_tipo" maxlength="3" required value="" placeholder="Sigla">
                            </div>
                            <label for="descri_produto">Rotulo:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="rotulo_tipo" name="rotulo_tipo" maxlength="100" required value="" placeholder="Rotulo">&nbsp;
                            </div>
                                <!-- Botão Enviar -->
                                <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                        </form> <!-- Fim do Formulário -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>