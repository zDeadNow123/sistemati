<?php
    include('acesso_com.php');

    include('../connections/conn.php');

    $remove = "DELETE from tbusuarios where id_usuario = ".$_GET['id_usuario'];

    $conn->query($remove);

    header("Location: usuario_lista.php");
?>