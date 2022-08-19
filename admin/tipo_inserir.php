<?php
// Incluindo o sistema de autenticação
include('acesso_com.php');

// Incluindo o arquivo de conexão
include('../connections/conn.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Inserir Produto</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>

<body class="fundofixo">

    <?php include('menu_adm.php'); ?>

    <main class="container">
        <form>
            <div class="form-row ">
                <div class="col-sm-3 my-1">
                    <label for="inlineFormInputName">Sigla</label>
                    <input type="text" class="form-control" placeholder="Jane Doe">
                </div>
                
                <div class="col-sm-3 my-1">
                    <label for="inlineFormInputGroupUsername">Rotulo</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                </div>

                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </main>


    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>