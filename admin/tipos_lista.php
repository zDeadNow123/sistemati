<?php
    // Incluindo o sistema de autenticação
    include('acesso_com.php');

    // Incluindo o arquivo de conexão
    include('../connections/conn.php');

    // Selecionando dados
    $consulta = "select * from tb_tipos order by login_usuario asc";
    
    // Buscar a lista completa de produtos
    $lista = $conn->query($consulta);

    // Separar produtos por linha
    $linha = $lista->fetch(PDO::FETCH_ASSOC);
?>