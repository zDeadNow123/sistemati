<?php
// incluindo variáveis de ambiente, acesso e banco
include('../config.php');
include('acesso_com.php');
include('../connections/conn.php');

if ($_POST) {
    // Campo do form para filtrar o registro
    $id = $_POST['id_usuario'];

    $login_usuario = $_POST['login_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $nivel_usuario = $_POST['nivel_usuario'];

    $query = "INSERT INTO `tbusuarios` (`login_usuario`, `senha_usuario`, `nivel_usuario`) VALUES ('$login_usuario', '$senha_usuario', '$nivel_usuario');";

    $resultado = $conn->query($query);

    // Após a ação, a página será direcionada
    if ($conn->lastInsertId($query)) {
        header('location: usuario_lista.php');
        // adicionar tratamento...
    } else {
        header('location: usuario_lista.php');
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
                    <a href="usuario_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Usuários
                </h2>
                <div class="thumbnail">
                    <!-- Abre Thumbnail -->
                    <div class="alert alert-danger" role="alert">
                        <form action="usuario_inserir.php" method="post" id="form_usuario_atualiza" name="form_usuario_atualiza" enctype="multipart/form-data">
                            <label for="sigla_produto">Login:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="login_usuario" name="login_usuario" maxlength="100" required placeholder="Usuário">
                            </div>
                            <label for="descri_produto">Senha:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="senha_usuario" name="senha_usuario" maxlength="100" required placeholder="Nova Senha">&nbsp;
                            </div>
                            <label for="nivel_usuario">Nivel:</label>
                            <select name="nivel_usuario" id="nivel_usuario">
                                <option value="sup">Superior</option>
                                <option value="com">Comercial</option>
                                <option value="cli">Cliente</option>
                            </select>
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