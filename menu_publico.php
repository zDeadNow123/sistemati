<?php 
    // incluindo arquivo de conexão

    include ('connections/conn.php');

    $tbtipos = "tbtipos";
    $ordenar = "rotulo_tipo";
    $consulta = "SELECT * FROM $tbtipos ORDER BY $ordenar";
    //$consulta = "SELECT * FROM vw_tbprodutos ORDER BY $ordenar";

    $listaTipos = $conn -> query($consulta);
    $linhaTipo = $listaTipos -> fetch(PDO::FETCH_ASSOC);
    //$totalLinhas = $listaTipos -> num_rows;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <!-- ABRE A BARRA DE NAVEGAÇÃO -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <!-- AGRUPAMENTO MOBILE -->
            <div class="navbar-header">
                <button type="button" class="nav-toggle collapsed" data-toggle="collapse" data-target="#menuPublico" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="index.php" class="navbar-brand">
                    <img src="images/logochurrascopequeno.png"/>
                </a>

            </div><!-- FECHA AGRUPAMENTO MOBILE -->

            <!-- NAV DIREITA -->
            <div class="collapse navbar-collapse" id="menuPublico">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="index.php">
                            <span class="glyphicon glyphicon-home"></span>
                        </a>
                    </li>
                    <li><a href="index.php#destaques">Destaques</a></li>
                    <li><a href="index.php#produtos">Produtos</a></li>
                    <!-- DROPDOWN -->
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Tipos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <!-- ABRE ESTRUTURA DE REPETIÇÃO -->
                            <?php do {?>
                                <li>
                                    <a href="produtos_por_tipo.php?id_tipo=<?php echo $linhaTipo['id_tipo']?>"><?php
                                        echo $linhaTipo['rotulo_tipo']
                                    ?></a>
                                </li>
                            <?php } while ($linhaTipo = $listaTipos -> fetch(PDO::FETCH_ASSOC)) ?>
                        </ul>
                    </li>
                    <li></li>
                    <li></li>
                </ul>
            </div><!-- FECHA NAV DIREITA -->
        </div><!-- FECHA CONTAINER-FLUID -->
    </nav>
</body>
</html>