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

    $query = "INSERT INTO `tbtipos` (`sigla_tipo`, `rotulo_tipo`) VALUES ('$sigla_tipo', '$rotulo_tipo');";

    $resultado = $conn->query($query);

    // Após a ação, a página será direcionada
    if ($conn->lastInsertId($query)) {
        header('location: tipo_lista.php');
        // adicionar tratamento...
    } else {
        header('location: tipo_lista.php');
    }

}

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
                    Inserindo Tipos
                </h2>
                <div class="thumbnail">
                    <!-- Abre Thumbnail -->
                    <div class="alert alert-danger" role="alert">
                        <form action="tipo_inserir.php" method="post" id="form_tipo_inserir" name="form_tipo_inserir" enctype="multipart/form-data">
                            <label for="sigla_produto">Sigla:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="sigla_tipo" name="sigla_tipo" maxlength="3" required value="" placeholder="Sigla">
                            </div>
                            <label for="descri_produto">Rotulo:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="rotulo_tipo" name="rotulo_tipo" maxlength="100" required value="" placeholder="Rotulo">&nbsp;
                            </div>
                                <!-- Botão Enviar -->
                                <input type="submit" value="Inserir" name="enviar" id="enviar" class="btn btn-danger btn-block">
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