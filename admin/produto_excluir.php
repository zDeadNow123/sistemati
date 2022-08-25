<?php
    include('acesso_com.php');

    include('../connections/conn.php');

    // Removendo (Força Bruta)
    $remove = "DELETE from tbprodutos where id_produto = ".$_GET['id_produto'];

    // Removendo (desativando) utilizando método acumulador
    // $remove = "update tbprodutos set deletado = default where id_produto = $id_prod;";

    $conn->query($remove);

    header("Location: produto_lista.php");

?>