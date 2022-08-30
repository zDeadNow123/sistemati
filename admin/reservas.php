<?php
    include('acesso_com.php');
    include('../connections/conn.php');

    // Selecionando dados
    $consulta = "select * from tbreservas order by status = 'Expirado', status = 'Negado', status = 'Aprovado'";

    // Buscar a lista completa de produtos
    $lista = $conn->query($consulta);
    
    // Separar produtos por linha
    $linha = $lista->fetch(PDO::FETCH_ASSOC);
    
    // Contar número de linhas da lista
    $total_linhas = $lista->rowCount();

    if($_GET) {
        $idReserva = $_GET['id_reserva'];
        
        if($_GET['status'] == "Aprovado") {
            $mesaReserva = $_GET['numero_mesa'];

            $query = "update tbreservas set n_mesa_reserva = $mesaReserva where id_reserva = '$idReserva'";
            $resultado = $conn->query($query);
    
            $query = "update tbreservas set status = 'Aprovado' where id_reserva = '$idReserva'";
            $resultado = $conn->query($query);
    
            header("Location: reservas.php");
        } else if($_GET['status'] == "Negado") {
            $query = "update tbreservas set status = 'Negado' where id_reserva = '$idReserva'";
            $resultado = $conn->query($query);
    
            header("Location: reservas.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuleta Quente - Reservas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/meu_estilo.css" type="text/css">
</head>
<body>
    <?php include('menu_adm.php'); ?>
    <main class="container">
  
        <h2 class="breadcrumb alert-danger">Lista de Reservas</h2>
        <div class="dropdown-filtro">
            <label for="filter-by">Filtrar por:</label>
    
            <select name="filter-by" id="filter-by">
                <option value="todos">Todos</option>
                <option value="pendentes">Pendentes</option>
                <option value="aprovados">Aprovados</option>
                <option value="negados">Negados</option>
                <option value="expirados">Expirados</option>
                <option value="cancelados">Cancelados</option>
            </select>
        </div>
        <table class="table table-condensed table-hover tbopacidade">
            <!-- thead >th*8 -->
            <thead>
                <th class="hidden">id</th>
                <th>ID Reserva</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Data Reserva</th>
                <th>Horário</th>
                <th>Nº Pessoas</th>
                <th>Nº Mesa</th>
                <th>Motivo</th>
                <th>Status</th>
                <th></th>
            </thead><!-- Fecha linha de cabeçalho da tabela -->
            <tbody> <!-- Corpo da tabela -->
            <?php do {?>
                <tr class="<?php
                        switch($linha['status']) {
                            case 'Pendente':
                                echo $linha['status'];
                                break;
                            case 'Aprovado':
                                echo $linha['status'];
                                break;
                            case 'Negado':
                                echo $linha['status'];
                                break;
                            case 'Expirado':
                                echo $linha['status'];
                                break;
                            case 'Cancelado':
                                echo $linha['status'];
                                break;
                        }
                    ?>">
                    <td>
                        <?php echo $linha['id_reserva']; ?>
                    </td>
                    <td>
                        <?php echo $linha['nome']; ?>
                    </td>
                    <td>
                        <?php echo $linha['cpf']; ?>
                    </td>
                    <td>
                        <?php echo $linha['telefone']; ?>
                    </td>
                    <td>
                        <?php echo $linha['email']; ?>
                    </td>
                    <td>
                        <?php echo $linha['data_reserva']; ?>
                    </td>
                    <td>
                        <?php echo $linha['horario_reserva']; ?>
                    </td>
                    <td>
                        <?php echo $linha['n_pessoas_reserva']; ?>
                    </td>
                    <td>
                        <?php echo $linha['n_mesa_reserva']; ?>
                    </td>
                    <td>
                        <?php echo $linha['motivo']; ?>
                    </td>
                    <td>
                        <?php
                            switch($linha['status']) {
                                case 'Pendente':
                                    echo "<p style='color: orange;'>".$linha['status']."</p>";
                                    break;
                                case 'Aprovado':
                                    echo "<p style='color: green;'>".$linha['status']."</p>";
                                    break;
                                case 'Negado':
                                    echo "<p style='color: red;'>".$linha['status']."</p>";
                                    break;
                                case 'Expirado':
                                    echo "<p style='color: grey;'>".$linha['status']."</p>";
                                    break;
                                case 'Cancelado':
                                    echo "<p style='color: grey;'>".$linha['status']."</p>";
                                    break;
                            }
                        ?>
                    </td>
                    <td style="display: flex; align-items: center; gap: 5px;">
                        <?php if($linha['status'] == 'Pendente') {?>
                            <a href="#" class="btn btn-success btn-xs" id="btn-confirmar" data-id="<?php echo $linha['id_reserva']; ?>">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            </a>
                            <a href="#" class="btn btn-danger btn-xs" id="btn-negar" data-id="<?php echo $linha['id_reserva']; ?>">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        <?php } ?>

                        <?php if($linha['status'] != 'Pendente') {?>
                            <a href="#" class="btn btn-primary btn-xs" id="btn-alterar" data-id="<?php echo $linha['id_reserva']; ?>">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } while($linha = $lista -> fetch(PDO::FETCH_ASSOC)); ?>
            </tbody><!-- Fecha corpo da tabela -->
        </table>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="confirmarReserva" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</br></button>
                    <h4 class="modal-title text-danger">Digite o número da mesa.</h4>
                </div>

                <div class="modal-body">
                    <input class="form-control" type="text" name="numero_mesa" id="numero_mesa">
                </div>

                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-success" id="btn-inside-confirmar">Confirmar</a>
                    <button type="button" class="btn btn-danger btn-inside-cancelar" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div><!-- Fecha Modal -->

    <!-- LINKS DOS ARQUIVOS BOOTSTRAP -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script para o Modal -->
    <script>
        let id;

        $('#btn-confirmar').on('click', function() {
            id = $(this).data('id');
            $('#confirmarReserva').modal('show');
        });

        $('#btn-inside-confirmar').on('click', function() {
            if(numero_mesa.value.length > 0) {
                $(this).attr('href','reservas.php?id_reserva='+id+'&numero_mesa='+numero_mesa.value+'&status=Aprovado');
            } else {
                alert('Digite a mesa primeiro');
            }
        });

        $('#btn-negar').on('click', function() {
            id = $(this).data('id');
            $(this).attr('href','reservas.php?id_reserva='+id+'&status=Negado');
        });


        const select = document.getElementById("filter-by");
        select.addEventListener('change', function() {  

            const pendentes = document.querySelectorAll('.Pendente');
            const aprovados = document.querySelectorAll('.Aprovado');
            const negados = document.querySelectorAll('.Negado');
            const expirados = document.querySelectorAll('.Expirado');
            const cancelados = document.querySelectorAll('.Cancelado');

            let select2 = select.options[select.selectedIndex].value;

            switch(select2) {
                case 'todos':
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'table-row';
                    });
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'table-row';
                    });
                    negados.forEach(negado => {
                        negado.style.display = 'table-row';
                    });
                    expirados.forEach(expirado => {
                        expirado.style.display = 'table-row';
                    });
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'table-row';
                    });
                break;
                case 'pendentes':
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'table-row';
                    });
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'none';
                    });
                    negados.forEach(negado => {
                        negado.style.display = 'none';
                    });
                    expirados.forEach(expirado => {
                        expirado.style.display = 'none';
                    });
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'none';
                    });
                break;
                case 'aprovados':
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'table-row';
                    });
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'none';
                    });
                    negados.forEach(negado => {
                        negado.style.display = 'none';
                    });
                    expirados.forEach(expirado => {
                        expirado.style.display = 'none';
                    });
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'none';
                    });
                break;
                case 'negados':
                    negados.forEach(negado => {
                        negado.style.display = 'table-row';
                    });
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'none';
                    });
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'none';
                    });
                    expirados.forEach(expirado => {
                        expirado.style.display = 'none';
                    });
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'none';
                    });
                break;
                case 'expirados':
                    expirados.forEach(expirado => {
                        expirado.style.display = 'table-row';
                    });
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'none';
                    });
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'none';
                    });
                    negados.forEach(negado => {
                        negado.style.display = 'none';
                    });
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'none';
                    });
                break;
                case 'cancelados':
                    cancelados.forEach(cancelado => {
                        cancelado.style.display = 'table-row';
                    });
                    pendentes.forEach(pendente => {
                        pendente.style.display = 'none';
                    });
                    aprovados.forEach(aprovado => {
                        aprovado.style.display = 'none';
                    });
                    negados.forEach(negado => {
                        negado.style.display = 'none';
                    });
                    expirados.forEach(expirado => {
                        expirado.style.display = 'none';
                    });
                break;
            }
        })  

    </script>
</body>
</html>