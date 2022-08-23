<?php
// incluindo variáveis de ambiente, acesso e banco
include('../config.php');
include('acesso_com.php');
include('../connections/conn.php');

if ($_POST) {
    // Guardando o nome da imagem no banco de dados e o arquivo no diretório images
    if ($_FILES['imagem_produto']['name']) {
        $nome_img = $_FILES['imagem_produto']['name'];
        $tpm_img = $_FILES['imagem_produto']['tpm_name'];
        $pasta_img = "../images/" . $nome_img;
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
    $query = "update tbprodutos set id_tipo_produto = '". $id_tipo_produto. "', destaque_produto = '" . $destaque_produto . "', descri_produto = '" . $descri_produto . "', resumo_produto = '" . $resumo_produto . "', valor_produto = " . $valor_produto . ", imagem_produto = '" . $imagem_produto . "' where id_produto = " . $id_filtro . ";";

    $resultado = $conn->query($query);

    // Após a ação, a página será direcionada
    if ($conn->lastInsertId($query)) {
        header('location: produto_lista.php');
        // adicionar tratamento...
    } else {
        header('location: produto_lista.php');
    }

}
    // Consulta para recuperar dados do filtro da chamada da página...
    $id_alterar = $_GET['id_produto'];
    $query_busca = "select * from tbprodutos where id_produto = " . $id_alterar;
    $lista = $conn->query($query_busca);
    $linha = $lista->fetch(PDO::FETCH_ASSOC);
    $totalLinhas = $lista->rowCount();

    $consulta_fk = "select * from tbtipos";
    $lista_fk = $conn->query($consulta_fk);
    $linha_fk = $lista_fk->fetch(PDO::FETCH_ASSOC);
    $total_linhas_fk = $lista_fk->rowCount();
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
                    <a href="produto_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando Produtos
                </h2>
                <div class="thumbnail">
                    <!-- Abre Thumbnail -->
                    <div class="alert alert-danger" role="alert">
                        <form action="produto_atualiza.php" method="post" id="form_produto_atualiza" name="form_produto_atualiza" enctype="multipart/form-data">
                            <!-- Inserir o Campo id_produto OCULTO para Uso no Filtro -->
                            <input type="hidden" name="id_produto" id="id_produto" value="<?php echo $linha['id_produto']; ?>">
                            <!-- Select id_tipo_produto -->
                            <label for="id_tipo_produto"> Tipo: </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="id_tipo_produto" id="id_tipo_produto" class="form-control" required>
                                    <?php do { ?>
                                        <option value="<?php echo $linha_fk['id_tipo']; ?>"
                                            <?php
                                                if (!strcmp($linha_fk['id_tipo'], $linha['id_tipo_produto'])) {
                                                    echo 'selected=\"selected\"';
                                                }
                                            ?>>
                                            <?php echo $linha_fk['rotulo_tipo']; ?>
                                        </option>
                                    <?php } while ($linha_fk = $lista_fk->fetch(PDO::FETCH_ASSOC));
                                    $linhas_fk = $lista_fk->rowCount();
                                    if ($linhas_fk > 0) {
                                        $linhas_fk = $lista_fk->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_ABS, 0);
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <!-- Radio destaque_produto -->
                            <label for="destaque_produto"> Destaque? </label>
                            <div class="input-group">
                                <label for="destaque_produto_s" class="radio-inline">
                                    <input type="radio" name="destaque_produto" id="destaque_produto" value="Sim" <?php echo $linha['destaque_produto'] == "Sim" ? "checked" : null; ?>>
                                    Sim
                                </label>
                                <label for="destaque_produto_n" class="radio-inline">
                                    <input type="radio" name="destaque_produto" id="destaque_produto" value="Não" <?php echo $linha['destaque_produto'] == "Não" ? "checked" : null; ?>>
                                    Não
                                </label>
                            </div>
                            <br>
                            <!-- Text descri_produto-->
                            <label for="descri_produto">Descrição:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" class="form-control" id="descri_produto" name="descri_produto" maxlength="100" required value="<?php echo $linha['descri_produto']; ?>" placeholder="Digite o título do produto...,">
                            </div>
                            <br>
                            <!-- Textarea de resumo_produto -->
                            <label for="resumo_produto">Resumo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                </span>
                                <textarea name="resumo_produto" id="resumo_produto" cols="50" rows="8" placeholder="Digite os detalhes do produto..." class="form-control">
                                    <?php echo $linha['resumo_produto']; ?>
                                </textarea>
                            </div>
                            <br>
                            <!-- Number valor_produto -->
                            <label for="valor_produto">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>
                                </span>
                                <input type="number" name="valor_produto" id="valor_produto" min="0" step="0.01" class="form-control" value="<?php echo $linha['valor_produto']; ?>">
                            </div>
                            <br>
                            <!-- file imagem_produto Atual -->
                            <label for="imagem_produto_atual">Imagem Atual:</label>
                            <img src="../images/<?php echo $linha['imagem_produto'] ?>" alt="" class="img-responsive" style="max-width:100%">
                            <input type="hidden" name="imagem_produto_atual" value="<?php echo $linha['imagem_produto']; ?>">
                            <br>
                            <!-- file imagem_produto Nova -->
                            <label for="imagem_produto">Nova Imagem (1200 x 800px):</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                </span>
                                <img src="" alt="" name="imagem" id="imagem" class="img-responsive">
                                <input type="file" name="imagem_produto" id="imagem_produto" class="form-control" accept="image/*">
                            </div>
                            <br>
                            <!-- Botão Enviar -->
                            <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                        </form> <!-- Fim do Formulário -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Script para a Imagem -->
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