<?php
    // Incluindo o sistema de autenticação
    include('acesso_com.php');

    // Incluindo o arquivo de conexão
    include('../connections/conn.php');

    // Selecionando dados
    $consulta = "select * from tbtipos order by sigla_tipo asc";

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
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
    <title>Tipos (<?php echo $total_linhas;?>) - Lista</title>
</head>
<body >
    <?php include('menu_adm.php'); ?>

    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Tipos</h2>
        <table class="table table-condensed table-hover tbopacidade">
            <!-- thead >th*8 -->
            <thead>
                <th class="hidden">id</th>
                <th>Sigla</th>
                <th>Rotulo</th>
                <th>
                    <a href="tipo_inserir.php" class="btn btn-block btn-primary btn-xs">
                        <span class="hidden-xs">Adicionar<br></span>
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </th>
            </thead><!-- Fecha linha de cabeçalho da tabela -->

            <!-- tbody>tr>td*8 -->
            <tbody> <!-- Corpo da tabela -->
            <!-- Abre a estrutura de repetição -->
            <?php do {?>
                <tr> <!-- Linha da tabela -->
                    <td>
                        <span class="hidden-xs"><?php echo $linha['sigla_tipo']; ?></span>
                    </td>
                    <td>
                        <span class="hidden-xs"><?php echo $linha['rotulo_tipo']; ?></span>
                    </td>

                    <td>
                        <a href="tipo_atualiza.php?id_tipo=<?php echo $linha['id_tipo']; ?>" class="btn btn-warning btn-block btn-xs">
                            <span class="hidden-xs">Alterar</span>
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <button class="btn btn-danger btn-block btn-xs delete" role="button" role="button" data-nome="<?php echo $linha['rotulo_tipo']; ?>" data-id="<?php echo $linha['id_tipo']; ?>">
                            <span class="hidden-xs">Excluir</span>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                    </td>
                </tr><!-- Fecha linha da tabela -->
                <?php } while($linha = $lista -> fetch(PDO::FETCH_ASSOC)); ?>
            </tbody><!-- Fecha corpo da tabela -->
        </table>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</br></button>
                    <h4 class="modal-title text-danger">Atenção!</h4>
                </div>

                <div class="modal-body">
                    <p class="">Deseja realmente <strong>excluir</strong> o item?</p>
                    <h3><span class="text-danger nome"></span></h3>
                </div>

                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">Confirmar</a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div><!-- Fecha Modal -->

    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    
    <!-- Script para o Modal -->
    <script type="text/javascript">
        $('.delete').on('click', function() {
        // busca o valor do atributo data-nome (botão excluir)
        var nome = $(this).data("nome");
        // busca o valor do atributo data-id (botão excluir)
        var id = $(this).data("id");

        // insere o nome do item na confirmação do modal
        $('span.nome').text(nome);
        // envia o id através do link do botão confirmar
        $('a.delete-yes').attr('href','tipo_excluir.php?id_tipo='+id);
        // Abre o modal
        $('#myModal').modal('show');
    });
    </script>
</body>
</html>