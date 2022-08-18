<?php
    include('acesso_com.php');

    include('../connections/conn.php');

    $remove = "DELETE from tbprodutos where id_produto = ".$_GET['id_produto'];

    $conn->query($remove);

    header("Location: produto_lista.php");
?>