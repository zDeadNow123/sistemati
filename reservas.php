<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuleta Quente</title>
    <link rel="stylesheet" href="css/meu_estilo.css" type="text/css">
    <!--link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"-->

    <link href= "css/bootstrap.min.css" rel="stylesheet">
    <link href= "css/datepicker.css" rel="stylesheet">
    
</head>
<body style="height: 100vh;">
    <?php include('menu_publico.php'); ?>

    <main class="container" style="display: flex; justify-content: center; flex-direction: column; width: 1200px; margin-bottom: 0.5cm;">
        <section style="display: flex; flex-direction: column; justify-content: center; align-items: center; background-color: white; margin-bottom: 1cm; height: 508.875px;">
            <h1 style="text-align: center; margin-bottom: 20px;">Regras da Reserva</h1>
            <p style="margin-left: 20%; margin-right: 20%;">1. A reserva deve ser realizada com no mínimo 1 dia de antecedência (24 horas) e no máximo 90 dias.</p>
            <p style="margin-left: 20%; margin-right: 20%;">2. Reservas diárias limitadas. 1 Reserva diária para o titular do CPF.</p>
            <p style="margin-left: 20%; margin-right: 20%;">3. Caso a reserva possua mais de 5 pessoas, o titular recebe uma sobremesa gratuita.</p>

            <div class="botoes" style="display: flex; justify-content: center; gap: 10px; margin-top: 1cm;">
                <a class="btn btn-info reserve" href="#" role="button">Reservar</a>
                <a class="btn btn-info consreserve" href="#" role="button">Consultar Reserva(s)</a>
            </div>
        </section>
        <footer class="container" style="margin-bottom: 0.5cm;">
            <?php include('rodape.php'); ?>
        </footer>
    </main>
    

    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="tipo_inserir.php" method="post" id="form_tipo_inserir" name="form_tipo_inserir" enctype="multipart/form-data">
                        <label for="nome">Nome Completo:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="3" required value="" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="cpf">CPF:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cpf" name="cpf" maxlength="3" required value="" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="email">E-mail:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="rotulo_tipo" name="email" maxlength="100" required value="" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="sigla_produto">Telefone:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="sigla_tipo" name="telefone" maxlength="3" required value="" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="sigla_produto">Data:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" data-date-format="dd/mm/yy" id="datetimepicker99" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="sigla_produto">Nº Pessoas:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="sigla_tipo" name="n_pessoas_reserva" maxlength="2" required value="" placeholder="Obrigatório">
                        </div>
                        <br>
                        <label for="sigla_produto">Motivo:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="motivo" name="motivo" maxlength="100" required value="" placeholder="Opcional">
                        </div>
                        <br>

                        <div style="display: flex; gap: 10px;">
                            <input type="submit" value="Reservar" name="enviar" id="enviar" class="btn btn-danger">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form> <!-- Fim do Formulário -->
                </div>
            </div>
        </div>
    </div>

    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script type="text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <!--script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script-->
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/bootstrap-datepicker.pt-BR.js" charset="UTF-8"></script>


    <script>
        $('#datetimepicker99').datepicker();
            $('#btn2').click(function(e){
                e.stopPropagation();
                $('#datetimepicker99').datepicker();
            });    
    </script>

    
    <script>
        $('.reserve').on('click', function() {
            // busca o valor do atributo data-nome (botão excluir)
            //let nome = $(this).data('nome');
            // busca o valor do atributo data-id (botão excluir)
            //let id = $(this).data('id');
            // insere o nome do item na confirmação do modal
            //$('span.nome').text(nome);
            // envia o id através do link do botão confirmar
            //$('a.delete-yes').attr('href','produto_excluir.php?id_produto='+id);
            // Abre o modal
            $('#myModal').modal('show');
        });
    </script>
</body>
</html>