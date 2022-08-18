<?php
    include('acesso_com.php');

    include('../connections/conn.php');

    $remove = "DELETE from tbtipos where id_tipo = ".$_GET['id_tipo'];

    $conn->query($remove);

    header("Location: tipo_lista.php");
?>