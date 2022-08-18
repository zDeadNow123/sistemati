<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
</head>
<body>
    <nav class="nav navbar-inverse">
        <div class="container-fluid">
            <!-- Agrupamento para exibição em Mobile -->
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#defaultNavbar" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">
                    <img src="../images/logochurrascopequeno.png" alt="">
                </a>
            </div><!-- Fecha Agrupamento para exibição em Mobile -->
            <!-- Nav a direita -->
            <div class="collapse navbar-collapse" id="defaultNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button type="button" class="btn btn-danger navbar-btn disabled">
                            Olá, <?php echo $_SESSION['login_usuario']; ?>
                        </button>
                    </li>
                    <li class="active"><a href="index.php">Admin</a></li>
                    <li><a href="produto_lista.php">Produtos</a></li>
                    <li><a href="tipo_lista.php">Tipos</a></li>
                    <li><a href="usuario_lista.php">Usuários</a></li>
                    <li class="active">
                        <a href="../index.php">
                            <span class="glyphicon glyphicon-home"></span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <span class="glyphicon glyphicon-log-out"></span>
                        </a>
                    </li>
                </ul>
            </div><!-- Fecha a Nav direita -->
        </div>
    </nav><!-- Fecha barra de navegação-->
</body>
</html>