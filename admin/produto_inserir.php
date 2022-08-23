<?php
    // sistema de autenticação
    include('acesso_com.php');
    // variáveis de ambiente
    include('../config.php');
    // conexãocom banco
    include('../connections/conn.php');

    $campos_insert = "id_tipo_produto, destaque_produto, descri_produto, resumo_produto, valor_produto, imagem_produto";

    if ($_FILES['imagem_produto']['name']) {
        $nome_img = $_FILES['imagem_produto']['name'];
        $tpm_img = $_FILES['imagem_produto']['tpm_name'];
        $pasta_img = "../images/" . $nome_img;
        move_uploaded_file($tpm_img, $pasta_img);
    } else {
        $nome_img = $_POST['imagem_produto_atual'];
    }

    // chave estrangeira tipo
    $query_tipo = "select * from tbtipos order by rotulo_tipo asc";
    $lista_fk = $conn->query($query_tipo);
    $linha_fk = $lista_fk->fetch(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SYS_NAME; ?> - Inserir Produtos</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>
<body class="fundo">
    <?php
        include('menu_adm.php');
    ?>

    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-2 col-md-8">
                <h4 class="breadcrumb text-warning">
                    <a href="produto_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Produtos
                </h4>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="produto_inserir.php" id="form_produto_inserir" name="form_produto_inserir" method="post" enctype="multipart/form-data">
                            <!-- Seleciona o Tipo do Produto -->
                            <label for="id_tipo_produto">Tipos:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-task"></span>
                                </span>
                                <select name="id_tipo_produto" id="" class="form-control" required>
                                    <?php do {?>
                                        <option value="<?php echo $linha_fk['id_tipo']; ?>">
                                            <?php echo $linha_fk['rotulo_tipo']; ?>
                                        </option>
                                    <?php } while($linha_fk = $lista_fk -> fetch(PDO::FETCH_ASSOC));
                                        $linha_fk = $lista_fk->rowCount();
                                        if($linha_fk > 0) {
                                            $linha_fk = $lista_fk->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_ABS, 0);
                                        }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <label for="destaque_produto">Destaque:</label>
                            <div class="input-group">
                                <label for="destaque_produto_s" class="radio-inline">
                                    <input type="radio" name="destaque_produto" id="destaque_produto" value="Sim">Sim
                                </label>
                                <label for="destaque_produto_n" class="radio-inline">
                                    <input type="radio" name="destaque_produto" id="destaque_produto" value="Não" checked>Não
                                </label>
                            </div><!-- Fecha a div do radio Button -->
                            <br>
                            <label for="descri_produto">Descrição:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                    <input type="text" class="form-control" name="descri_produto" id="descri_produto" placeholder="Digite o título do produto" maxlength="100" required>
                                </span>
                            </div>
                            <br>
                            <label for="resumo_produto">Resumo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                </span>
                                <textarea name="resumo_produto" id="resumo_produto" cols="30" rows="8" placeholder="Digite os detalhes do produto" class="form-control"></textarea>
                            </div>
                            <br>
                            <label for="valor_produto">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                                </span>
                                <input type="text" class="form-control" id="valor_produto" min="0" step="0.01">
                            </div>
                            <br>
                            <label for="imagem_produto">Imagem:</label>
                            <div class="input-group">
                                <span class="input-group-addon" aria-hidden="true">
                                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                </span>
                                <img src="" alt="" name="imagem" id="imagem" class="img-responsive">
                                <input type="file" class="form-control" name="imagem_produto" id="imagem_produto" accept="image/*">
                            </div>
                            <br>
                            <input type="submit" value="Cadastrar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        document.getElementById("imagem_produto").onchange = function() {
            var reader = new FileReader();
            if (this.files[0].size > 1048576) {
                alert("A imagem deve ter no máximo 1MB");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            };
            // Verifica se o Input do tipo file possui Dado
            if (this.files[0].type.indexOf("image") == -1) {
                alert("Formato inválida, selecione uma imagem!");
                $("#imagem").attr("src", "blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            };
            reader.onload = function(e) {
                // Obter dados carregados e Renderizar a Miniatura
                var imgp = document.getElementById("imagem");
                imgp.src = e.target.result;
                $("#imagem").show();
            };
            reader.readAsDataURL(this.files[0]);

        };
    </script>

    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>