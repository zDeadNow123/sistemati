<?php
    include('config.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SYS_NAME?></title>
    <link rel="stylesheet" href="css/meu_estilo.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body class="fundofixo">

    <!-- ÁREA DO MENU -->
    <?php
    include('menu_publico.php');
    ?>
    <a name="home"></a>
    <main class="container">
        <!-- ÁREA DO CAROUSEL -->
        <?php include('carousel.php'); ?>

        <!-- ÁREA DE DESTAQUES -->
        <a name="destaques">&nbsp;</a>
        <?php include('produtos_destaque.php'); ?>

        <!-- ÁREA DE PRODUTOS EM GERAL -->
        <a name="produtos">&nbsp;</a>
        <?php include('produtos_geral.php'); ?>
        <hr>

        <!-- ÁREA DE RODAPÉ -->
        <footer>
            <?php include('rodape.php'); ?>
            <a name="contato">&nbsp;</a>
        </footer>
    </main>
    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php


# TEXTO
// echo "vai que é sua... Tafareeeeeel!";
?>